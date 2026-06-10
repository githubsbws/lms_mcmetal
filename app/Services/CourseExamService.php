<?php

namespace App\Services;

use App\Models\Choice;
use App\Models\Course;
use App\Models\CourseExamEssayAnswer;
use App\Models\CourseScore;
use App\Models\ExamTimeLog;
use App\Models\Grouptesting;
use App\Models\Passcourse;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseExamService
{
    const STATUS_ACTIVE = 'y';
    const PASS_THRESHOLD_PERCENT = 70;

    public function getMultipleChoiceExam(int $courseId)
    {
        $userId = Auth::id();
        // 1. Eager Loading ดึงกลุ่มข้อสอบ คำถาม และช้อยส์ทั้งหมดรวดเดียว ดักสถานะ Active
        $course = Course::with([
            'groupTesting' => function ($q) {
                $q->where('active',self::STATUS_ACTIVE)
                ->with([
                    'questions' => fn($q) => $q->where('ques_type',2)->where('active','y')
                    ->with(['choices'])
                    ]);
            },
            'courseScore' => function ($q) use ($userId) {
                $q->where('user_id', $userId)
                  ->where('pass_year', now()->year);
            },
            'lesson' => function($q) use ($userId) {
                $q->where('active', 'y')->with([
                    'learn' => fn($subQ) => $subQ->where('user_id', $userId)->where('pass_year', now()->year)
                ]);
            }
        ])->findOrFail($courseId);

        // 2. คำนวณเงื่อนไขความปลอดภัย (Guard Clauses)
        $totalLessons  = $course->lesson->count();
        $passedLessons = $course->lesson->filter(fn($l) => $l->learn->first()?->lesson_status === 'pass')->count();

        $userScores     = $course->courseScore;
        $hasPassed      = $userScores->where('score_status', 'pass')->isNotEmpty();
        $attemptedCount = $userScores->count();
        $maxAttempts    = 1 + (int)($course->course_retest_amount ?? 0);
        $hasQuestions   = $course->groupTesting?->questions?->isNotEmpty() ?? false;

        $examSession = $this->getOrCreateExamSession($userId, $courseId,2);

        // 5. ฝากข้อมูลเข้าไปใน $course ตรงๆ เลย
        $course->exam_session = $examSession;
        $course->remaining_seconds = now()->diffInSeconds($examSession->expire_at, false);

        // 3. ตรวจสอบสิทธิ์แบบเด็ดขาด หากไม่ผ่านเงื่อนไขให้โยน Exception ออกไป
        if (!$hasQuestions) {
            throw new \Exception('หลักสูตรนี้ยังไม่มีการจัดเตรียมข้อสอบปรนัย');
        }
        if ($totalLessons === 0 || $passedLessons < $totalLessons) {
            throw new \Exception('คุณต้องเรียนให้ครบทุกบทเรียนก่อนเข้าสอบ');
        }
        if ($hasPassed) {
            throw new \Exception('คุณสอบผ่านหลักสูตรนี้ไปแล้ว ไม่ต้องสอบซ้ำ');
        }
        if ($attemptedCount >= $maxAttempts) {
            throw new \Exception('คุณใช้สิทธิ์สอบซ่อมครบกำหนดแล้ว กรุณาติดต่อแอดมิน');
        }

        return $course;
    }

    public function getEssayExam(int $courseId)
    {
        $userId = Auth::id();

        $course = Course::with([
            'groupTesting' => function ($q) {
                $q->where('active',self::STATUS_ACTIVE)
                ->with([
                    'questions' => fn($q) => $q->where('ques_type',3)
                    ->with(['images'])
                    ]);
            },
            'courseScore' => function ($q) use ($userId) {
                $q->where('user_id', $userId)
                ->where('pass_year', now()->year);
            },
            'lesson' => function($q) use ($userId) {
                $q->where('active', 'y')->with([
                    'learn' => fn($subQ) => $subQ->where('user_id', $userId)->where('pass_year', now()->year)
                ]);
            }
        ])->findOrFail($courseId);

        // --- ก๊อปปี้ Logic Guard Clauses เดิมมาดักความปลอดภัยตรงนี้ ---
        $totalLessons  = $course->lesson->count();
        $passedLessons = $course->lesson->filter(fn($l) => $l->learn->first()?->lesson_status === 'pass')->count();
        $userScores     = $course->courseScore;
        $hasPassed      = $userScores->where('score_status', 'pass')->isNotEmpty();
        $attemptedCount = $userScores->count();
        $maxAttempts    = 1 + (int)($course->course_retest_amount ?? 0);
        $hasQuestions   = $course->groupTesting?->questions?->isNotEmpty() ?? false;

        $examSession = $this->getOrCreateExamSession($userId, $courseId,3);

        // 5. ฝากข้อมูลเข้าไปใน $course ตรงๆ เลย
        $course->exam_session = $examSession;
        $course->remaining_seconds = now()->diffInSeconds($examSession->expire_at, false);

        if (!$hasQuestions) { throw new \Exception('หลักสูตรนี้ยังไม่มีการจัดเตรียมข้อสอบบรรยาย'); }
        if ($totalLessons === 0 || $passedLessons < $totalLessons) { throw new \Exception('คุณต้องเรียนให้ครบทุกบทเรียนก่อนเข้าสอบ'); }
        if ($hasPassed) { throw new \Exception('คุณสอบผ่านหลักสูตรนี้ไปแล้ว ไม่ต้องสอบซ้ำ'); }
        if ($attemptedCount >= $maxAttempts) { throw new \Exception('คุณใช้สิทธิ์สอบซ่อมครบกำหนดแล้ว กรุณาติดต่อแอดมิน'); }

        return $course;
    }

    public function essayExamAnswerSubmit(int $courseId,$request)
    {
        $userId = Auth::id();
        $answers = $request->input('answers'); // [ques_id => text]

        $timeout = $request->input('is_timeout');
        $examSessionId = $request->input('exam_session_id');
        //ดึงเวลาสอบมาดู
        $examSession = ExamTimeLog::where('id', $examSessionId)
        ->where('user_id', $userId)
        ->firstOrFail();

        $isActuallyTimeout = ($timeout == 1 || now()->gt($examSession->expire_at));
        return DB::transaction(function () use ($userId, $courseId, $answers, $isActuallyTimeout, $examSession) {
            // 1. วนลูปบันทึกคำตอบลงตารางใหม่ (Insert Only)
            if($isActuallyTimeout){
                $status = 'fail';
                $sessionStatus = 'timeout';
            }else{
                $status = 'wait';
                $sessionStatus = 'completed';
                foreach ($answers as $quesId => $text) {
                    // สร้าง Record ใหม่ทุกครั้ง ไม่มีการ Update ของเก่า
                        CourseExamEssayAnswer::create([
                        'user_id'     => $userId,
                        'course_id'   => $courseId,
                        'ques_id'     => $quesId,
                        'answer_text' => $text,
                        'status'      => 'wait', // รอ Admin ตรวจ
                        'created_date' => now()
                    ]);
                }
                // 2. ปรับปรุงสถานะในตารางสรุปผล (Table ที่น้องใช้เก็บคะแนน)
                // ตรงนี้เรา UpdateOrCreate ได้ เพราะมันคือ 'สถานะปัจจุบัน' ของพนักงาน
            }
            $examSession->update([
                'status' => $sessionStatus,
            ]);

            return CourseScore::create([
                'course_id'   => $courseId,
                'user_id'     => $userId,
                'type'        => 3,
                'score_status' => $status,
                'active'      => self::STATUS_ACTIVE,
                'create_date'  => now(),
                'pass_year'   => now()->year,
                // score จะยังเป็น null หรือ 0 ตามที่เราตั้ง Default ใน Migration
            ]);


        });
    }

    public function multipleExamAnswerSubmit(int $courseId,$request)
    {
        $userId = Auth::id();
        $answers = $request->input('answers'); // [ques_id => choice_id]
        $timeout = $request->input('is_timeout');
        $examSessionId = $request->input('exam_session_id');
        //ดึงเวลาสอบมาดู
        $examSession = ExamTimeLog::where('id', $examSessionId)
        ->where('user_id', $userId)
        ->firstOrFail();

        //นับคะแนนเต็ม
        $maxScoreCount = $this->getMaxScore($courseId);

        // 2. เช็คเงื่อนไข "ตกทันที" (ส่งมาว่า Timeout OR เวลาใน DB หมดแล้วจริง)
        $isActuallyTimeout = ($timeout == 1 || now()->gt($examSession->expire_at));
        return DB::transaction(function () use ($userId, $courseId, $answers, $isActuallyTimeout, $examSession, $maxScoreCount) {
            if ($isActuallyTimeout) {
                $currentScore = 0;
                $maxScore = $maxScoreCount; // หรือจะนับจำนวนข้อสอบจริงส่งมาก็ได้
                $status = 'fail';
                $sessionStatus = 'timeout';
            } else {
                // Logic ตรวจคำตอบปกติ
                $selectedChoiceIds = array_values($answers);
                $maxScore = $maxScoreCount; // หรือดึงจำนวนข้อสอบจริงจาก DB จะแม่นยำกว่า

                $correctChoicesCount = Choice::whereIn('choice_id', $selectedChoiceIds)
                    ->where('choice_answer', 1)
                    ->where('choice_type', 2)
                    ->where('active', self::STATUS_ACTIVE)
                    ->count();

                $currentScore = $correctChoicesCount;
                $percent = ($maxScore > 0) ? ($currentScore / $maxScore) * 100 : 0;
                $status = ($percent >= self::PASS_THRESHOLD_PERCENT) ? 'pass' : 'fail';
                $sessionStatus = 'completed';
            }

            // 3. บันทึกคะแนนสอบ (CourseScore)
            $score = CourseScore::create([
                'course_id'    => $courseId,
                'user_id'      => $userId,
                'type'         => 2,
                'score_number' => $currentScore,
                'score_total'  => $maxScore,
                'score_status' => $status,
                'active'       => self::STATUS_ACTIVE,
                'create_date'  => now(),
                'pass_year'    => now()->year,
            ]);

            // 4. อัปเดตตารางรอบการสอบ (ExamResult) เพื่อ "ปิดรอบ"
            $examSession->update([
                'status' => $sessionStatus,
            ]);

            // 5. ถ้าสอบผ่าน ให้สร้างบันทึกใน PassCourse
            if ($status === 'pass') {
                Passcourse::create(
                    [
                        'passcours_cours' => $courseId,
                        'passcours_user'  => $userId,
                        'academic_year'   => now()->year,
                        'passcours_status' => 'wait',
                    ]
                );
            }

            return $score;
        });
    }

    private function getOrCreateExamSession(int $userId, int $courseId, int $type)
    {
        // 1. ดึงรอบการสอบล่าสุด (ID สูงสุด) ของ User ในวิชานี้
        $latestExam = ExamTimeLog::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->latest('id')
            ->first();

        /**
         * 2. ตรวจสอบเงื่อนไขว่าต้อง "สร้างรอบใหม่" หรือไม่?
         * เงื่อนไขที่จะสร้างใหม่คือ:
         * - ไม่เคยสอบวิชานี้เลย ($latestExam เป็น null)
         * - รอบล่าสุดสอบเสร็จไปแล้ว (status === 'completed')
         * - รอบล่าสุดเวลาหมดไปแล้ว (now() > expires_at)
         */

        $isExpired = $latestExam ? now()->gt($latestExam->expire_at) : false;

        if ($latestExam && $latestExam->status === 'in_progress' && $isExpired) {

            // 1. ปิด Log เดิม
            $latestExam->update(['status' => 'timeout']);

            // 2. บันทึกตกทันที (กินสิทธิ์สอบซ่อม 1 ครั้ง)
            CourseScore::create([
                'course_id'    => $courseId,
                'user_id'      => $userId,
                'type'         => $type,
                'score_number' => 0,
                'score_total'  => $this->getMaxScore($courseId), // หรือใส่จำนวนข้อสอบจริง
                'score_status' => 'fail',
                'active'       => self::STATUS_ACTIVE,
                'create_date'  => now(),
                'pass_year'    => now()->year,
            ]);

            // 3. โยน Exception ออกไปเพื่อบอก Controller ว่า "ดีดคนนี้ออกไปซะ!"
            throw new \Exception('หมดเวลาทำข้อสอบแล้ว ระบบได้บันทึกผลการสอบว่า ไม่ผ่าน');
        }

        if (!$latestExam || $latestExam->status !== 'in_progress' || $isExpired) {

            // 🚨 กรณีพิเศษ: ถ้าอันเก่าสถานะยัง 'in_progress' แต่เวลาหมด (Expired)
            // ให้เราแวะไปปิดสถานะมันเป็น 'timeout' ก่อนเพื่อความเรียบร้อย
            if ($latestExam && $latestExam->status === 'in_progress' && $isExpired) {
                $latestExam->update(['status' => 'timeout']);
            }

            // 3. สร้างรอบการสอบใหม่ (Insert ลง DB)
            return ExamTimeLog::create([
                'user_id'    => $userId,
                'course_id'  => $courseId,
                'start_at' => now(),
                'expire_at' => now()->addHour(), // addHour() ตั้งเวลา 1 ชม. (หรือตามที่น้องกำหนด)
                'status'     => 'in_progress',
            ]);
        }

        // 4. ถ้ายังมีรอบที่ค้างอยู่ (และยังไม่หมดเวลา) ก็คืนค่ารอบเดิมกลับไปทำต่อ
        return $latestExam;
    }

    private function getMaxScore(int $courseId)
    {
        return Question::whereHas('groupTesting', function($q) use ($courseId) {
            $q->where('course_id', $courseId)
            ->where('active', self::STATUS_ACTIVE);
        })
        ->where('ques_type', 2)
        ->where('active', self::STATUS_ACTIVE)
        ->count();
    }
}
