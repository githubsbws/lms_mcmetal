<?php

namespace App\Services;

use App\Enums\LessonStatus;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportPotentialService
{
    const STATUS_ACTIVE = 'y';

    public function getPotentialData(Request $request)
    {
        if (!$request->anyFilled(['search', 'course_id', 'section_id', 'line_id'])) {
            return collect(); // ส่งคืน Collection ว่างเปล่า
        }
        $currentYear = now()->year;
        $userAuth = auth()->user();

        // เริ่มต้นที่ Course และกรองเฉพาะคอร์สที่ต้องการเหมือนเดิม
        $query = Course::where('active', self::STATUS_ACTIVE);

        if ($request->filled('course_id') && $request->course_id != 0) {
            $query->where('course_id', $request->course_id);
        }

        $userFilter = function($q) use ($request, $userAuth) {
            if ($request->filled('team_id') && $request->team_id != 0) {
                $q->where('team_id', $request->team_id);
            }

            if ($request->line_id != 0) {
                $q->whereHas('orgchart', fn($org) => $org->where('parent_id', $request->line_id));
            } elseif ($request->section_id != 0) {
                $q->whereHas('orgchart', function($org) use ($request) {
                    $lineIds = DB::table('orgchart')
                        ->where('parent_id', (string)$request->section_id)
                        ->pluck('id')
                        ->map(fn($id) => (string)$id) // cast ทุกตัวเป็น string
                        ->toArray();

                    $org->whereIn('parent_id', $lineIds);
                });
            } else {
                $q->where('department_org_id', $userAuth->department_org_id);
            }

            if ($request->filled('search')) { // เปลี่ยนตามชื่อ input ที่น้องใช้ (เช่น search หรือ fullname)
                $searchTerm = $request->search;

                $q->where(function($query) use ($searchTerm) {
                    // 1. เช็คใน table users (Username / Employee ID)
                    $query->where('username', 'like', '%' . $searchTerm . '%')
                        // 2. มุดไปเช็คใน table Profiles (ชื่อ-นามสกุล)
                        ->orWhereHas('Profiles', function($p) use ($searchTerm) {
                            $p->where(function($pName) use ($searchTerm) {
                                $pName->where('firstname', 'like', '%' . $searchTerm . '%')
                                        ->orWhere('lastname', 'like', '%' . $searchTerm . '%');
                            });
                        });
                });
            }
        };
        // ใช้ whereHas กรอง "ผู้เรียน" ตามเงื่อนไขการค้นหา
        $query->whereHas('passcourse', function($q) use ($currentYear, $userFilter) {
            $q->where('passcours_status',LessonStatus::Success->value);
            $q->where('academic_year', $currentYear);
            $q->whereHas('user',$userFilter);

            $q->has('scoreAssessment');

        });


        // อย่าลืมดึงข้อมูลพ่วง (Eager Load) ให้ครบเหมือนเดิม
        $results = $query->with([
            'courseWeight',
            'passcourse' => function($q) use ($currentYear, $userFilter, $request) {
                $q->where('passcours_status',LessonStatus::Success->value);
                $q->where('academic_year', $currentYear);
                $q->whereHas('user', $userFilter); // กรองพนักงานที่จะดึงมาโชว์ในตาราง

                $q->with([
                    'user.Profiles',
                    'user.orgchart',
                    'user.Team',
                    'scoreAssessment',
                    'user.scores' => function($scoreQuery) use ($request, $currentYear) {
                        $scoreQuery->where('pass_year',$currentYear);
                        // ดึงคะแนนเฉพาะคอร์สนี้
                        if ($request->filled('course_id') && $request->course_id != 0) {
                            $scoreQuery->where('course_id', $request->course_id);
                        }
                    }
                ]);
            }
        ])->get();

        return $this->mapPotentialReport($results);
    }

    private function mapPotentialReport($potentialData)
    {
        foreach ($potentialData as $course) {
            $weight = $course->courseWeight;

            foreach ($course->passcourse as $pass) {
                // 1. คำนวณคะแนนรวมครั้งเดียวเก็บไว้ในตัวแปร
                $totalScore = $this->calculateFinalScore($pass, $weight);
                $pass->calculated_total_score = $totalScore;

                // 2. เตรียมข้อมูล Icon และ Grade ของทั้ง 5 ช่องไว้เป็น Array
                $evalTypes = [
                    'knowledge'    => $weight->eval_knowledge,
                    'skill'        => $weight->eval_skill,
                    'attitude'     => $weight->eval_attitude,
                    'problem_solv' => $weight->eval_problem_solv,
                    'awareness'    => $weight->eval_awareness,
                ];

                $mappedEvals = [];
                foreach ($evalTypes as $key => $isEval) {
                    $mappedEvals[$key] = $this->getGradeData($totalScore, $isEval);
                }

                // 3. ยัดข้อมูลที่ปรุงเสร็จแล้วกลับเข้าไปใน Object $pass
                $pass->display_evals = $mappedEvals;
            }
        }
        return $potentialData;
    }

    private function calculateFinalScore($passcourse, $weight)
    {
        if (!$weight) return 0;
        $sumScaledScore = 0;

        // 1. คำนวณฝั่ง Assessment (Type 1-4)
        $weightMap = [
            1 => $weight->q_a_weight,
            2 => $weight->operate_weight,
            3 => $weight->assign_weight,
            4 => $weight->observe_weight,
        ];

        foreach ($weightMap as $type => $wValue) {
            if (!is_null($wValue)) {
                $score = $passcourse->scoreAssessment
                                    ->where('type_course_score_weight', $type)
                                    ->sum('score');
                $sumScaledScore += $score;
            }
        }

        // 2. คำนวณฝั่ง Exam
        if (!is_null($weight->exam_weight)) {
            $exam = $passcourse->user->scores->where('course_id', $passcourse->passcours_cours)->first();
            if ($exam && $exam->score_total > 0) {
                $examPercent = ($exam->score_number / $exam->score_total) * 100;
                $sumScaledScore += ($examPercent * $weight->exam_weight) / 100;
            }
        }

        return $sumScaledScore;
    }

    private function getGradeData($score, $isEval)
    {
        if (!$isEval) return ['grade' => 0];

        if ($score >= 80) return ['grade' => 3];
        if ($score >= 60) return ['grade' => 2];
        return ['grade' => 1];
    }
}
