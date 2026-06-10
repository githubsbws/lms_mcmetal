<?php

namespace App\Services;

use App\Enums\LessonStatus;
use App\Models\Course;
use App\Models\Orgcourse;
use App\Models\Passcourse;
use App\Models\Users;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class CourseService
{
    const STATUS_ACTIVE = 'y';
    const FAIL_STATUS = 'fail';
    // app/Services/CourseService.php
    public function getCoursesForUser(Users $user)
    {
        // 1. Base Query พร้อม Eager Loading ที่สะอาดขึ้น
        $query = Course::with([
            'lesson' => function($q) use ($user) {
                $q->where('active', 'y')
                ->with([
                    'file' => fn($q) => $q->where('active', self::STATUS_ACTIVE)
                        ->with([
                            // ← eager load learn_file ของ user นี้
                            'learnFile' => fn($q) => $q->whereHas('learn',
                                fn($q) => $q->where('user_id', $user->id)
                                            ->where('pass_year', now()->year),
                            )
                        ]),
                    'filedoc' => fn($q) => $q->where('active', self::STATUS_ACTIVE)
                        ->with([
                            'learnFileDoc' =>fn($q) => $q->whereHas('learn',
                                fn($q) => $q->where('user_id', $user->id)
                                            ->where('pass_year', now()->year)
                            ),
                        ]),
                    // ← eager load learn ของ user นี้
                    'learn' => fn($q) => $q->where('user_id', $user->id)
                                            ->where('pass_year', now()->year),
                ]);
            },
            'passcourse' => fn($q) => $q->where('passcours_user', $user->id)
                                ->where('academic_year', now()->year),

            'courseScore' => fn($q) => $q->where('user_id', $user->id)->where('active',self::STATUS_ACTIVE)->where('pass_year',now()->year),

            'groupTesting' => fn($q) => $q->where('active',self::STATUS_ACTIVE)
                            ->with([
                            'questions' => fn($subQ) => $subQ->select('ques_id', 'group_id', 'ques_type','ques_title','active') // เลือกเฉพาะฟิลด์ที่ใช้ประหยัด RAM
        ]),
        ])
        ->where('course_online.active', self::STATUS_ACTIVE);

        // 2. Branching Logic
        if ($user->team_id === Users::TEAM_NEWEMP) {
            return $this->applyRoadmapCriteria($query, $user);
        }

        return $this->applyOrgCriteria($query, $user);
    }

    private function applyRoadmapCriteria($query, $user) : LengthAwarePaginator|iterable
    {
        $lineId = $user->Orgchart?->line?->id ?? null;

        if (!$lineId) return collect(); // Defensive: ไม่มี Line ID ไม่ให้เห็นคอร์ส

        $allRoadmapCourses = DB::table('roadmap_course')
        ->join('roadmap', 'roadmap_course.roadmap_id', '=', 'roadmap.id')
        ->where('roadmap.line_id', $lineId)
        ->where('roadmap_course.active', self::STATUS_ACTIVE)
        ->orderBy('roadmap_course.order')
        ->select(
            'roadmap_course.course_id',
            'roadmap_course.order',
            'roadmap_course.milestone_days'
        )
        ->get();

        // 2. ดึง course ที่ผ่านแล้วของ user ปีนี้
        $allowedStatuses = ['pass', 'wait'];
        $passedCourseIds = Passcourse::where('passcours_user', $user->id)
            ->where('academic_year', now()->year)
            ->whereIn('passcours_status',$allowedStatuses)
            ->pluck('passcours_cours');

        // 3. คำนวณวันที่ทำงานมาแล้ว
        $daysWorked = (int) now()->diffInDays($user->work_start);

        // 4. คำนวณ is_locked แต่ละ course
        $lockedMap = $allRoadmapCourses->mapWithKeys(function ($rc) use (
            $allRoadmapCourses, $passedCourseIds, $daysWorked
        ) {
            return [
                $rc->course_id => !$this->isCourseUnlocked(
                    $rc,
                    $allRoadmapCourses,
                    $passedCourseIds,
                    $daysWorked
                )
            ];
        });

        $courses = $query
            ->join('roadmap_course', 'course_online.course_id', '=', 'roadmap_course.course_id')
            ->join('roadmap', 'roadmap_course.roadmap_id', '=', 'roadmap.id')
            ->where('roadmap.line_id', $lineId)
            ->where(function($q) use ($daysWorked, $passedCourseIds, $allRoadmapCourses) {
                // แสดง milestone ปกติเสมอ
                $q->where('roadmap_course.milestone_days', '!=', 999);

                // แสดง 999 เมื่อครบเงื่อนไขเท่านั้น
                $requiredCourseIds = $allRoadmapCourses
                    ->where('milestone_days', '!=', 999)
                    ->pluck('course_id');

                $allPassed = $requiredCourseIds->every(
                    fn($id) => $passedCourseIds->contains($id)
                );

                if ($daysWorked >= 120 && $allPassed) {
                    $q->orWhere('roadmap_course.milestone_days', 999);
                }
            })
            ->orderBy('roadmap_course.order', 'asc')
            ->select('course_online.*', 'roadmap_course.order', 'roadmap_course.milestone_days')
            ->paginate(5);

        $courses->each(function ($course) use ($lockedMap) {
            $course->is_locked = $lockedMap[$course->course_id] ?? false;
            });
            $this->attachCourseProgress($courses);
            return $courses;

    }

    private function applyOrgCriteria($query, $user)
    {
        $orgCourseIds = Orgcourse::where('orgchart_id', $user->org_id)->pluck('course_id');

        if ($orgCourseIds->isEmpty()) {
            return collect();
        }

        $courses = $query
        ->whereIn('course_online.course_id', $orgCourseIds)
        ->where('course_online.start_date', '<=', now())  // เริ่มแล้ว
        ->where('course_online.end_date', '>=', now())    // ยังไม่หมด
        ->paginate(5);

        $courses->each(function ($course) {
            $course->is_locked = false;
        });
        $this->attachCourseProgress($courses);

        return $courses;
    }

    private function isCourseUnlocked(
        $roadmapCourse,
        $allRoadmapCourses,
        $passedCourseIds,
        int $daysWorked
    ): bool {

        if($roadmapCourse->milestone_days === 999) {
            return true;
        }
        // milestone → จำนวนวันขั้นต่ำที่ต้องทำงานมาแล้ว
        $milestoneMap = [
            30  => 0,   // วันที่ 1-30
            60  => 31,  // วันที่ 31-60
            90  => 61,  // วันที่ 61-90
            119 => 91,  // วันที่ 91-119
        ];
        // เช็ค 1: milestone
        $requiredDays = $milestoneMap[$roadmapCourse->milestone_days] ?? 0;
        if ($daysWorked < $requiredDays) {
            return false;
        }

        // เช็ค 2: order — course ก่อนหน้าต้องผ่านแล้ว
        if ($roadmapCourse->order > 1) {
            $prevCourse = $allRoadmapCourses->where('milestone_days', '!=', 999)
                                            ->filter(fn($rc) => $rc->order < $roadmapCourse->order)
                                            ->sortByDesc('order')
                                            ->first();
            if ($prevCourse && !$passedCourseIds->contains($prevCourse->course_id)) {
                return false;
            }
        }

        return true;
    }

    private function attachCourseProgress($courses): void
    {
        $courses->each(function ($course) {
            $totalLessons  = $course->lesson->count();
            $hasQuestions = $course->groupTesting?->questions?->isNotEmpty() ?? false;

            $examStep = $hasQuestions ? 1 : 0;
            $totalSteps    = $totalLessons + $examStep; // +1 ข้อสอบ

            $passedLessons = $course->lesson
                ->filter(fn($lesson) => $lesson->learn->first()?->lesson_status === 'pass')
                ->count();

            $userScores = $course->courseScore->sortBy('score_id');

            // 2. เช็คว่ามีประวัติการสอบที่สถานะเป็น 'pass' ไหม
            $hasPassed = $userScores->where('score_status', 'pass')->isNotEmpty();
            $hasWait = $userScores->where('score_status', 'wait')->isNotEmpty();
            $examPassed = $hasPassed ? 1 : 0;

            $attemptedCount = $userScores->count();
            $maxAttempts = 1 + (int)($course->course_retest_amount ?? 0);


            $course->progress = $totalSteps > 0
                ? (int) round(($passedLessons + $examPassed) / $totalSteps * 100)
                : 0;
            // 5. บันทึกสถานะการสอบลงตัวแปร Object เพื่อส่งให้ Blade ใช้ง่ายๆ
            $course->all_exam_scores = $userScores;
            $course->exam_has_passed = $hasPassed; // ผ่านแล้วหรือยัง
            $course->score_has_wait  = $hasWait; //รอคะแนนสอบ
            $course->exam_attempts   = $attemptedCount; // สอบไปแล้วกี่ครั้ง
            $course->exam_max_attempts = $maxAttempts; // สอบได้สูงสุดกี่ครั้ง
            $course->has_questions = $hasQuestions; // มีข้อสอบไหม

            // 6. เงื่อนไขการเข้าสอบ: ต้องเรียนครบ AND ยังไม่เคยสอบผ่าน AND จำนวนครั้งที่สอบยังไม่เกินสิทธิ์
            $course->can_exam = ($totalLessons > 0 && $passedLessons >= $totalLessons)
                                && !$hasPassed
                                && ($attemptedCount < $maxAttempts)
                                && $hasQuestions;

            $examType = $course->groupTesting?->questions->first()?->ques_type;
            $course->exam_type = $examType; // 2=ปรนัย, 3=อัตนัย
        });
    }

    public function completeCourse(int $userId, int $courseId): void
    {
        DB::transaction(function () use ($userId, $courseId) {

            // เช็คว่าผ่านแล้วหรือยัง ป้องกัน double submit
            $exists = Passcourse::where('passcours_user', $userId)
                            ->where('passcours_cours', $courseId)
                            ->where('academic_year', now()->year)
                            ->exists();
            if ($exists) return;

            Passcourse::create([
                'passcours_cours'  => $courseId,
                'passcours_user'   => $userId,
                'passcours_status' => 'wait',
                'academic_year'    => now()->year,
            ]);
        });
    }

    public function resetCourseLearn(int $userId, int $courseId): void
    {
        // มัดรวมกระบวนการลบทั้งหมดไว้ใน Transaction เดียว หากมีตารางไหนพัง จะไม่ลบค้างคา
        DB::transaction(function () use ($userId, $courseId) {

            $currentYear = now()->year;

            // 1. หาข้อมูลในตาราง learn ที่ตรงกับ user, course และปีปัจจุบัน
            $learnIds = DB::table('learn') // เปลี่ยนเป็นชื่อตารางจริงของน้อง เช่น tbl_learn หรือ learns
                ->where('user_id', $userId)
                ->where('course_id', $courseId)
                ->where('pass_year', $currentYear)
                ->pluck('learn_id'); // ดึงมาเฉพาะ ID เป็น Array เพื่อเอาไปลบตารางลูกต่อ

            if ($learnIds->isNotEmpty()) {

                // 2. นำ learn_id ทั้งหมดที่เจอ ไปไล่ลบตารางย่อย (learn_file และ learn_file_doc)
                DB::table('learn_file')
                    ->whereIn('learn_id', $learnIds)
                    ->where('pass_year', $currentYear)
                    ->delete();

                DB::table('learn_file_doc')
                    ->whereIn('learn_id', $learnIds)
                    ->where('pass_year', $currentYear)
                    ->delete();

                // ลบตารางหลัก (learn) ออกหลังจากลบตารางลูกเสร็จแล้ว
                DB::table('learn')
                    ->whereIn('learn_id', $learnIds)
                    ->delete();
            }

            // 3. ไปที่ตาราง coursescore หาข้อมูลที่ตรงกับ user, course, ปีปัจจุบัน และสถานะเป็น fail แล้วลบทิ้งทั้งหมด
            DB::table('coursescore') // เปลี่ยนเป็นชื่อตารางจริงของน้อง เช่น tbl_coursescore
                ->where('user_id', $userId)
                ->where('course_id', $courseId)
                ->where('pass_year', $currentYear)
                ->where('score_status', self::FAIL_STATUS) // ดักลบเฉพาะพวกที่เป็น fail ตามโจทย์
                ->delete();

        });
    }

}
