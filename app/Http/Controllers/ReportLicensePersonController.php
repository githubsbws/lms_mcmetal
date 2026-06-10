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
use App\Models\Course;
use App\Models\Passcourse;
use App\Models\ScoreAssessment;
use App\Models\OperationMachine;
use App\Models\ParameterSetting;
use App\Models\LicensePerson;

use App\Helpers\ChildOrgHelper;

class ReportLicensePersonController extends Controller
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

    public function report_license(Request $request)
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
            | Operate Machines
            |--------------------------------------------------------------------------
            */

            $operateMachines = OperationMachine::where(
                    'active',
                    'y'
                )
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Parameter Settings
            |--------------------------------------------------------------------------
            */

            $parameterSettings = ParameterSetting::where(
                    'active',
                    'y'
                )
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Licenses
            |--------------------------------------------------------------------------
            */

            $licenseCourses = Course::where('active', 'y')
                ->where(function($q){
                    $q->whereNotNull('op_mac_id')
                    ->orWhereNotNull('par_st_id');
                })
                ->get()
                ->keyBy('course_id');

            
            /*
            |--------------------------------------------------------------------------
            | PassCourses
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
            | AssessmentScores
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
            

            $licenseSkills = collect();

                foreach($passCourses as $pass){

                    $course = $licenseCourses
                        ->get($pass->passcours_cours);

                    if(!$course){
                        continue;
                    }

                    $percent = $assessmentScores
                        ->get($pass->passcours_id, collect())
                        ->sum(function($item){
                            return (float)$item->score;
                        });

                    // skill matrix
                    $skill = $this->getSkillLevel($percent);

                    // convert to license
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
                    ->groupBy('user_id');
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

            return view("admin.report.report_license", [

                'users' => $users,
                'operateMachines' => $operateMachines,
                'parameterSettings' => $parameterSettings,
                'licenses' => $licenses,

                'departments' => $departments,
                'sections' => $sections,
                'lines' => $lines,
                'teams' => $teams,

                'line_id' => $line_id,
                'section_id' => $section_id,
                'team_id' => $team_id
            ]);

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
}
