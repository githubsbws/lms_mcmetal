<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Orgchart;
use App\Models\Orgcourse;
use App\Models\Lesson;
use App\Models\OrgchartUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    function dashboard(){
        $minutes = 3;

        $course = Cache::remember('course_' . Auth::id(), $minutes, function () {
            // ดึง orgchart ที่ผู้ใช้งานสังกัด
            $user_orgcharts = OrgchartUser::where('user_id', Auth::id())->pluck('orgchart_id');

            if ($user_orgcharts->isNotEmpty()) {
                $org_chart_ids = collect();

                foreach ($user_orgcharts as $org_id) {
                    $org = Orgchart::where('id', $org_id)->where('active', 'y')->first();
                    if (!$org) continue;

                    $level = $org->level;
                    $parent_id = $org->parent_id;

                    if ($level == 1) {
                        $ids = Orgchart::where('active', 'y')
                                    ->where('level', '>=', $level)
                                    ->where('parent_id', $parent_id)
                                    ->pluck('id');
                    } elseif ($level == 2) {
                        $ids = Orgchart::where('active', 'y')
                                    ->where(function($query) use ($org_id, $level) {
                                        $query->where('id', $org_id)
                                                ->orWhere(function($q) use ($org_id, $level) {
                                                    $q->where('level', '>', $level)
                                                    ->where('parent_id', $org_id);
                                                });
                                    })
                                    ->pluck('id');
                    } else {
                        $ids = Orgchart::where('active', 'y')
                                    ->where('id', $org_id)
                                    ->pluck('id');
                    }

                    $org_chart_ids = $org_chart_ids->merge($ids);
                }

                $org_chart_ids = $org_chart_ids->unique()->values();
            } elseif (Auth::user()->department_id == 1) {
                // admin เห็นทั้งหมด
                $org_chart_ids = Orgchart::where('active', 'y')->pluck('id');
            } else {
                $org_chart_ids = collect([0]); // ไม่เห็นอะไรเลย
            }

            // ดึง course
            $orgcourse = Orgcourse::whereIn('orgchart_id', $org_chart_ids)
                                ->where('active', 'y')
                                ->pluck('course_id');

            return Course::where('active','y')
                        ->whereIn('course_id', $orgcourse)
                        ->orderBy('course_id','DESC')
                        ->get();
        });

        if (Auth::check()) {
            return view('dashboard.dashboard', ['course' => $course]);
        }

        return view('auth.login');
    }
}
