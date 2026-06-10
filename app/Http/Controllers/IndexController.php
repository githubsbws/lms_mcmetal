<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    const STATUS_ACTIVE = 'y';
    function index()
    {
        $news_desc = News::where('expired_date', '>=', now())->orderBy('cms_id', 'DESC')->limit(6)->get();

        if (Auth::user()) {
            $course = $this->getCourseShow(auth()->user());

            return view("index.index", [
                'news_desc' => $news_desc,
                'course_detail' => $course
            ]);
        }
        return view("index.index", [
            'news_desc' => $news_desc,
        ]);
    }

    private function getCourseShow(?Users $user): Collection
    {
        // 1. Security: ดักจับกรณี Null Pointer และ Return Type ต้องชัดเจน
        if (!$user || !$user->org_id) {
            return collect();
        }

        // 2. Standards: เริ่มตั้งต้น Query Builder แบบฐานข้อมูลเดียว (Single Source of Truth)
        $query = Course::query()
            ->with(['teacher:teacher_id,teacher_name']) // Speed: ดึงเฉพาะคอลัมน์ที่ใช้จริง ลดการโหลด Data
            ->limit(6);

        // 3. Speed & Architecture: ใช้ Subquery แทนการ pluck() เพื่อลดการใช้ Memory
        if ($user->team_id == 6) {

            $query->whereIn('course_id', function ($subQuery) use ($user) {
                $subQuery->select('rc.course_id')
                    ->from('roadmap_course as rc')
                    ->join('roadmap as r', 'rc.roadmap_id', '=', 'r.id')
                    ->join('orgchart as o', 'r.line_id', '=', DB::raw('CAST(tbl_o.parent_id AS INTEGER)'))
                    ->where('o.id', $user->org_id)
                    ->where('rc.active', self::STATUS_ACTIVE)
                    ->orderBy('rc.order');
            });

        } else {

            $query->whereIn('course_id', function ($subQuery) use ($user) {
                $subQuery->select('course_id')
                    ->from('org_course') // เช็คชื่อตารางตรงนี้ให้ตรงกับ Database จริงด้วย
                    ->where('orgchart_id', $user->org_id);
            });

        }

        return $query->get();
    }
}
