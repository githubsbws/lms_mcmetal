<?php

namespace App\Console\Commands;

use App\Jobs\SendSupervisorSummaryMailJob;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendWeeklySupervisorNotify extends Command
{
    protected $signature   = 'app:send-weekly-supervisor-notify';
    protected $description = 'Send weekly supervisor notification email';

    public function handle()
    {
        $bosses = Users::whereHas('orgchart', function($q) {
            $q->where('title', 'LIKE', '%Supervisor%')
              ->orWhere('title', 'LIKE', '%Group Leader%');
        })->with('orgchart')->get();

        // $this->info('พบหัวหน้า: ' . $bosses->count() . ' คน');

        foreach ($bosses as $boss) {
            $lineId = $boss->orgchart->parent_id ?? null;

            $this->info('Boss: ' . $boss->name . ' | lineId: ' . $lineId);

            if (!$lineId) {
                $this->warn('ไม่มี lineId ข้ามไป');
                continue;
            }

            $staffListForMail = [];
            $openingCourses   = []; // ← ประกาศก่อนเสมอ

            // $subordinates = Users::with(['profiles'])
            //     ->whereHas('orgchart', fn($q) => $q->where('parent_id', $lineId))
            //     ->where('id', '!=', $boss->id)
            //     ->whereDoesntHave('orgchart', function($q) {
            //         $q->where('title', 'LIKE', '%Supervisor%')
            //           ->orWhere('title', 'LIKE', '%Group Leader%');
            //     })->get();
            $subordinates = Users::with(['profiles'])
            ->whereHas('orgchart', fn($q) => $q->where('parent_id', $lineId))
            ->get();

            // $this->info('ลูกน้อง: ' . $subordinates->count() . ' คน');

            if ($subordinates->isNotEmpty()) {
                // ดึง org_id ทุกตัวในสาย ไม่ซ้ำกัน
                $orgIds = $subordinates->pluck('org_id')->unique()->values()->toArray();
                $openingCourses = $this->checkOpeningCourses($orgIds);
            }

            $this->info('openingCourses: ' . count($openingCourses) . ' คอส');

            foreach ($subordinates as $staff) {
                if ($staff->team_id == 6) {
                    $items = $this->checkNewStaffRoadmap($staff, $lineId);
                } else {
                    $items = $this->checkClosingCourses($staff);
                }

                if (!empty($items)) {
                    $staffListForMail = array_merge($staffListForMail, $items);
                }
            }

            // $this->info('staffListForMail: ' . count($staffListForMail) . ' คน');

            if (!empty($staffListForMail) || !empty($openingCourses)) {
                SendSupervisorSummaryMailJob::dispatch($boss, $staffListForMail, $openingCourses);
                $this->info('Dispatched job for: ' . $boss->email);
            }
        }

        // $this->info('เสร็จสิ้น');
    }

    private function checkOpeningCourses(array $orgId): array
    {
        $now = Carbon::today();

        return DB::table('org_course')
            ->join('course_online', 'org_course.course_id', '=', 'course_online.course_id')
            ->where('org_course.orgchart_id', $orgId)
            ->where('course_online.active', 'y')
            ->whereBetween('course_online.start_date', [
                $now->copy()->addDays(13)->toDateString(),
                $now->copy()->addDays(14)->toDateString(),
            ])
            ->select('course_online.course_title', 'course_online.start_date')
            ->get()
            ->map(fn($c) => [
                'course_title' => $c->course_title,
                'start_date'   => Carbon::parse($c->start_date)->format('d/m/Y'),
            ])
            ->toArray();
    }

    private function checkClosingCourses(Users $staff): array
    {
        $items = [];
        $now   = Carbon::today();

        $courses = DB::table('org_course')
            ->join('course_online', 'org_course.course_id', '=', 'course_online.course_id')
            ->where('org_course.orgchart_id', $staff->org_id)
            ->where('course_online.active', 'y')
            ->whereBetween('course_online.end_date', [
                $now->copy()->addDays(13)->toDateString(),
                $now->copy()->addDays(14)->toDateString(),
            ])
            ->get();

        foreach ($courses as $course) {
            if (!$this->isPassed($staff->id, $course->course_id)) {
                $items[] = $this->formatRow($staff, 'general');
            }
        }

        return $items;
    }

    private function checkNewStaffRoadmap(Users $staff, int $lineId): array
    {
        $items = [];
        $now   = Carbon::today();

        $roadmapCourses = DB::table('roadmap_course')
            ->join('roadmap', 'roadmap_course.roadmap_id', '=', 'roadmap.id')
            ->join('course_online', 'roadmap_course.course_id', '=', 'course_online.course_id')
            ->where('roadmap.line_id', $lineId)
            ->where('roadmap_course.active', 'y')
            ->select('roadmap_course.course_id', 'roadmap_course.milestone_days', 'course_online.course_title')
            ->get();

        foreach ($roadmapCourses as $rc) {
            $deadline = Carbon::parse($staff->work_start)->addDays($rc->milestone_days);

            if ($now->between(
                $deadline->copy()->subDays(14),
                $deadline->copy()->subDays(13)
            )) {
                if (!$this->isPassed($staff->id, $rc->course_id)) {
                    return [$this->formatRow($staff, 'new')];
                }
            }
        }

        return [];
    }

    private function isPassed(int $userId, int $courseId): bool
    {
        return DB::table('passcours')
            ->where('passcours_user', $userId)
            ->where('passcours_cours', $courseId)
            ->where('academic_year', now()->year)
            ->whereIn('passcours_status', ['wait', 'pass'])
            ->exists();
    }

    private function formatRow(Users $staff, string $type = 'general'): array
    {
        return [
            'staff_id'       => $staff->username,
            'staff_fullname' => trim(
                ($staff->profiles->firstname ?? 'ไม่ระบุ') . ' ' .
                ($staff->profiles->lastname  ?? '')
            ),
            'staff_type' => $type,
        ];
    }
}
