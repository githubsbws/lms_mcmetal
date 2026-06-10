<?php
namespace App\Services;

use App\Models\Users;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;

class OrgAuthorizationService
{
    /**
     * สรุป Logic:
     * 1. พนักงานใหม่ -> เช็ค tbl_roadmap (ผ่าน Parent Org ID)
     * 2. พนักงานทั่วไป -> เช็ค tbl_course_org (ผ่าน Direct Org ID)
     */
    public function canAccessLesson(Users $user, Lesson $lesson): bool
    {
        $courseId = $lesson->course_id;

        // --- CASE A: พนักงานใหม่ (New Staff) ---
        if ($user->team_id == Users::TEAM_NEWEMP) {
            return $this->checkRoadmapAccess($user, $courseId);
        }

        // --- CASE B: พนักงานทั่วไป (General Staff) ---
        return $this->checkGeneralCourseAccess($user, $courseId);
    }

    private function checkRoadmapAccess(Users $user, int $courseId): bool
    {
        // พนักงานใหม่ ต้องเอา parent_id ของ org ตัวเอง ไปเช็คใน tbl_roadmap
        $parentOrgId = $user->Orgchart?->parent_id;

        if (!$parentOrgId) return false;

        // เช็คใน tbl_roadmap ว่า Course นี้ถูกจัดอยู่ใน Roadmap ของ Org ระดับบนหรือไม่
        return DB::table('roadmap')
        ->join('roadmap_course', 'roadmap.id', '=', 'roadmap_course.roadmap_id')
        ->where('roadmap.line_id', $parentOrgId)
        ->where('roadmap_course.course_id', $courseId)
        ->where('roadmap.active', 'y')
        ->exists();
    }

    private function checkGeneralCourseAccess(Users $user, int $courseId): bool
    {
        // พนักงานทั่วไป เช็คผ่าน course_org ตามปกติ
        return DB::table('org_course')
            ->where('orgchart_id', $user->org_id)
            ->where('course_id', $courseId)
            ->exists();
    }
}
