<?php

namespace App\Http\Controllers;

use App\Models\Conditions;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Facades\AuthFacade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use App\Models\Users;
use App\Models\Orgchart;
use App\Models\Team;
use App\Models\Passcourse;
use App\Models\ScoreAssessment;
use App\Models\Course;

use App\Helpers\ChildOrgHelper;

class PersonalAssessmentController extends Controller
{
    public function index(Request $request)
    {
        if(AuthFacade::useradmin()){

            $line_id = $request->line_id;
            $section_id = $request->section_id;
            $team_id = $request->team_id;

            $userDetail = auth()->user();

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
                ->where('users.status', 1);

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
                ->orderBy('users.id', 'DESC')
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Department
            |--------------------------------------------------------------------------
            */

            $departments = Orgchart::where(
                    'id',
                    $userDetail->department_org_id
                )
                ->first();

            /*
            |--------------------------------------------------------------------------
            | Sections
            |--------------------------------------------------------------------------
            */

            $sections = Orgchart::where(
                    'parent_id',
                    $userDetail->department_org_id
                )
                ->where('active','y')
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Lines
            |--------------------------------------------------------------------------
            */

            $lines = collect();

            if($section_id){

                $lines = Orgchart::where(
                        'parent_id',
                        (string)$section_id
                    )
                    ->where('active','y')
                    ->get();
            }

            /*
            |--------------------------------------------------------------------------
            | Teams
            |--------------------------------------------------------------------------
            */

            $teams = Team::where('active','y')->get();

            return view(
                'admin.report.personalassessment.index',
                compact(
                    'users',
                    'departments',
                    'sections',
                    'lines',
                    'teams',
                    'line_id',
                    'section_id',
                    'team_id'
                )
            );
        }

        return redirect()->route('login.admin');
    }

     public function getLines($section_id)
    {
        $lines = Orgchart::where(
                'parent_id',
                (string)$section_id
            )
            ->where('active', 'y')
            ->get(['id', 'title']);

        return response()->json($lines);
    }
    
    public function detail($id)
    {
        if(AuthFacade::useradmin()){

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
                    ->sum(function($item){
                        return (float)$item->score;
                    });

                $operateScore = $scores
                    ->where('type_course_score_weight', 2)
                    ->sum(function($item){
                        return (float)$item->score;
                    });

                $assignScore = $scores
                    ->where('type_course_score_weight', 3)
                    ->sum(function($item){
                        return (float)$item->score;
                    });

                $observeScore = $scores
                    ->where('type_course_score_weight', 4)
                    ->sum(function($item){
                        return (float)$item->score;
                    });

                $totalScore =
                    $qaScore +
                    $operateScore +
                    $assignScore +
                    $observeScore;

                /*
                |--------------------------------------------------------------------------
                | Skill Matrix
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

                    'course_name' => $course->course_title,

                    'assessment_date' =>
                        $pass->create_date,

                    'training_hours' =>
                        $course->course_point ?? '-',

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

            return view(
                'admin.report.personalassessment.detail',
                compact(
                    'user',
                    'assessments'
                )
            );
        }

        return redirect()->route('login.admin');
    }

}
