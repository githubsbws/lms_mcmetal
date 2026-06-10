<?php

namespace App\Http\Controllers;

use App\Models\Conditions;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use App\Exports\ReportUserExport;
use App\Exports\ReportLicenseExport;
use App\Exports\PersonalAssessmentDetailExport;
use App\Models\Users;
use App\Models\Course;
use App\Models\Passcourse;
use App\Models\ScoreAssessment;
use App\Models\OperationMachine;
use App\Models\ParameterSetting;
use App\Models\Orgchart;
use App\Models\LicensePerson;
use App\Models\PersonalAssessment;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\ChildOrgHelper;

class ReportExcelController extends Controller
{
    private function getSkillLevel($percent)
    {
        if ($percent == 100) return 5;
        if ($percent >= 80) return 4;
        if ($percent >= 60) return 3;
        if ($percent >= 25) return 2;
        if ($percent >= 0) return 1;

        return 0;
    }
    public function export(Request $request)
    {
        $cate_id = $request->cate_id;
        $line_id = $request->line_id;
        $section_id = $request->section_id;
        $team_id = $request->team_id;

        $usersQuery = Users::join(
                    'profiles',
                    'profiles.user_id',
                    '=',
                    'users.id'
                )
                ->leftJoin(
                    'orgchart',
                    'orgchart.id',
                    '=',
                    'users.org_id'
                )
                ->leftJoin(
                    'team',
                    'team.id',
                    '=',
                    'users.team_id'
                )
                ->where('users.status', '1');

         if($section_id){

                $orgIds = collect([$section_id])
                    ->merge(
                        ChildOrgHelper::getAllChildOrgIds([$section_id])
                    );

                $usersQuery->whereIn(
                    'users.org_id',
                    $orgIds
                );
            }

        if($line_id){

                $orgIds = collect([$line_id])
                    ->merge(
                        ChildOrgHelper::getAllChildOrgIds([$line_id])
                    );

                $usersQuery->whereIn(
                    'users.org_id',
                    $orgIds
                );
            }

        if($team_id){
            $usersQuery->where('users.team_id', $team_id);
        }

        $users = $usersQuery
            ->select(
                'users.*',
                'profiles.firstname',
                'profiles.lastname'
            )
            ->orderBy('users.id', 'DESC')
            ->get();

        $coursesQuery = Course::join(
                'category',
                'category.cate_id',
                '=',
                'course_online.cate_id'
            )
            ->where('course_online.active','y');

        if($cate_id){
            $coursesQuery->where(
                'course_online.cate_id',
                $cate_id
            );
        }

        $courses = $coursesQuery
            ->select(
                'course_online.course_id',
                'course_online.course_title',
                'course_online.cate_id',
                'category.cate_title as cate_name'
            )
            ->orderBy('course_online.course_id')
            ->get();

        $groupedCourses = $courses->groupBy('cate_name');

        /*
        |--------------------------------------------------------------------------
        | Pass Course
        |--------------------------------------------------------------------------
        */

        $passCourses = Passcourse::whereIn(
                'passcours_cours',
                $courses->pluck('course_id')
            )
            ->whereIn(
                'passcours_user',
                $users->pluck('id')
            )
            ->where(
                'passcours_status',
                'pass'
            )
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Score Assessment
        |--------------------------------------------------------------------------
        */

        $assessmentScores = ScoreAssessment::whereIn(
                'passcours_id',
                $passCourses->pluck('passcours_id')
            )
            ->where(
                'active',
                'y'
            )
            ->get()
            ->groupBy('passcours_id');

        /*
        |--------------------------------------------------------------------------
        | Key Map
        |--------------------------------------------------------------------------
        */

        $passCourses = $passCourses->keyBy(function($item){
            return $item->passcours_user
                .'_'.
                $item->passcours_cours;
        });


        return Excel::download(
            new ReportUserExport(
                $users,
                $groupedCourses,
                $passCourses,
                $assessmentScores
            ),
            'report_user.xlsx'
        );
    }

    public function report_license_export(Request $request)
    {
        $line_id = $request->line_id;
        $section_id = $request->section_id;
        $team_id = $request->team_id;

        /*
        |--------------------------------------------------------------------------
        | Users Query
        |--------------------------------------------------------------------------
        */

        $usersQuery = Users::with([
                'Orgchart',
                'Team'
            ])
            ->join(
                'profiles',
                'profiles.user_id',
                '=',
                'users.id'
            )
            ->leftJoin(
                'orgchart',
                'orgchart.id',
                '=',
                'users.org_id'
            )
            ->leftJoin(
                'team',
                'team.id',
                '=',
                'users.team_id'
            )
            ->where(
                'users.status',
                1
            );

        /*
        |--------------------------------------------------------------------------
        | Section Filter
        |--------------------------------------------------------------------------
        */

        if($section_id){

            $orgIds = collect([$section_id])
                ->merge(
                    ChildOrgHelper::getAllChildOrgIds([$section_id])
                );

            $usersQuery->whereIn(
                'users.org_id',
                $orgIds
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Line Filter
        |--------------------------------------------------------------------------
        */

        if($line_id){

            $orgIds = collect([$line_id])
                ->merge(
                    ChildOrgHelper::getAllChildOrgIds([$line_id])
                );

            $usersQuery->whereIn(
                'users.org_id',
                $orgIds
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Team Filter
        |--------------------------------------------------------------------------
        */

        if($team_id){

            $usersQuery->where(
                'users.team_id',
                $team_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        $users = $usersQuery
            ->select(
                'users.*',
                'profiles.firstname',
                'profiles.lastname'
            )
            ->orderBy(
                'users.id',
                'DESC'
            )
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Master 
        |--------------------------------------------------------------------------
        */

        $operateMachines = OperationMachine::where(
                'active',
                'y'
            )
            ->get();

        $parameterSettings = ParameterSetting::where(
                'active',
                'y'
            )
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Course ที่เกี่ยวกับ License
        |--------------------------------------------------------------------------
        */

        $licenseCourses = Course::where(
                'active',
                'y'
            )
            ->where(function($q){

                $q->whereNotNull('op_mac_id')
                ->orWhereNotNull('par_st_id');

            })
            ->get()
            ->keyBy(
                'course_id'
            );

        /*
        |--------------------------------------------------------------------------
        | Pass Course
        |--------------------------------------------------------------------------
        */

        $passCourses = Passcourse::whereIn(
                'passcours_cours',
                $licenseCourses->pluck('course_id')
            )
            ->whereIn(
                'passcours_user',
                $users->pluck('id')
            )
            ->where(
                'passcours_status',
                'pass'
            )
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Score Assessment
        |--------------------------------------------------------------------------
        */

        $assessmentScores = ScoreAssessment::whereIn(
                'passcours_id',
                $passCourses->pluck('passcours_id')
            )
            ->where(
                'active',
                'y'
            )
            ->get()
            ->groupBy(
                'passcours_id'
            );

        /*
        |--------------------------------------------------------------------------
        | Build License From Skill Matrix
        |--------------------------------------------------------------------------
        */

        $licenseSkills = collect();

        foreach($passCourses as $pass){

            $course = $licenseCourses
                ->get(
                    $pass->passcours_cours
                );

            if(!$course){
                continue;
            }

            $percent = $assessmentScores
                ->get(
                    $pass->passcours_id,
                    collect()
                )
                ->sum(function($item){

                    return (float)$item->score;

                });

            // ใช้ logic เดียวกับหน้า table
            $skill = $this->getSkillLevel(
                $percent
            );

            // convert skill -> license
            if($skill >= 4){

                $licenseLevel = 3;

            }
            elseif($skill >= 2){

                $licenseLevel = 2;

            }
            else{

                $licenseLevel = 1;

            }

            $licenseSkills->push((object)[

                'user_id' => $pass->passcours_user,

                'operation_machine_id' => $course->op_mac_id,

                'parameter_setting_id' => $course->par_st_id,

                'license_level' => $licenseLevel

            ]);
        }

        $licenses = $licenseSkills
            ->groupBy(
                'user_id'
            );

        /*
        |--------------------------------------------------------------------------
        | Export
        |--------------------------------------------------------------------------
        */

        return Excel::download(

            new ReportLicenseExport(

                $users,

                $operateMachines,

                $parameterSettings,

                $licenses

            ),

            'report_license.xlsx'
        );
    }

    public function detail_export($id)
    {
        $user = Users::with([
                'Profiles',
                'Orgchart',
                'Department'
            ])
            ->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | Pass Course
        |--------------------------------------------------------------------------
        */

        $passCourses = Passcourse::where(
                'passcours_user',
                $id
            )
            ->where(
                'passcours_status',
                'pass'
            )
            ->orderBy('passcours_id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Courses
        |--------------------------------------------------------------------------
        */

        $courses = Course::whereIn(
                'course_id',
                $passCourses->pluck('passcours_cours')
            )
            ->get()
            ->keyBy('course_id');

        /*
        |--------------------------------------------------------------------------
        | Score Assessment
        |--------------------------------------------------------------------------
        */

        $scoreAssessments = ScoreAssessment::whereIn(
                'passcours_id',
                $passCourses->pluck('passcours_id')
            )
            ->where(
                'active',
                'y'
            )
            ->get()
            ->groupBy('passcours_id');

        /*
        |--------------------------------------------------------------------------
        | Build Assessment
        |--------------------------------------------------------------------------
        */

        $assessments = collect();

        foreach($passCourses as $pass){

            $course = $courses[
                $pass->passcours_cours
            ] ?? null;

            if(!$course){
                continue;
            }

            $scores = $scoreAssessments->get(
                $pass->passcours_id,
                collect()
            );

            $qaScore = $scores
                ->where('type_course_score_weight', 1)
                ->sum(fn($item) => (float)$item->score);

            $operateScore = $scores
                ->where('type_course_score_weight', 2)
                ->sum(fn($item) => (float)$item->score);

            $assignScore = $scores
                ->where('type_course_score_weight', 3)
                ->sum(fn($item) => (float)$item->score);

            $observeScore = $scores
                ->where('type_course_score_weight', 4)
                ->sum(fn($item) => (float)$item->score);

            $totalScore =
                $qaScore +
                $operateScore +
                $assignScore +
                $observeScore;

            /*
            |--------------------------------------------------------------------------
            | License / Skill Matrix
            |--------------------------------------------------------------------------
            */

            if($totalScore >= 80){
                $level = 3;
            }
            elseif($totalScore >= 60){
                $level = 2;
            }
            else{
                $level = 1;
            }

            $assessments->push((object)[

                'course_name' =>
                    $course->course_title,

                'assessment_date' =>
                    $pass->create_date,


                'qa_score' =>
                    $qaScore,

                'operate_score' =>
                    $operateScore,

                'assign_score' =>
                    $assignScore,

                'observe_score' =>
                    $observeScore,

                'total_score' =>
                    $totalScore,

                'level' =>
                    $level
            ]);
        }

        return Excel::download(

            new PersonalAssessmentDetailExport(

                $user,

                $assessments

            ),

            'personal_assessment_'.$user->username.'.xlsx'
        );
    }
}
