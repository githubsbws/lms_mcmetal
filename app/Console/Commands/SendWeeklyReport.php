<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Course;
use App\Models\Learn;
use App\Models\Passcourse;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\WeeklyReportMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendWeeklyReport extends Command
{
    protected $signature = 'report:weekly';

    protected $description = 'Send Weekly Learning Report';

    public function handle()
    {
        Log::info('Start Weekly Report');
        
        $weeklyScores = DB::table('coursescore')
            ->join('users', 'users.id', '=', 'coursescore.user_id')
            ->join('course_online', 'course_online.course_id', '=', 'coursescore.course_id')
            ->select(
                'users.username',
                'course_online.course_title',
                'coursescore.score_number',
                'coursescore.score_total',
                'coursescore.score_status',
                'coursescore.exam_type',
                'coursescore.create_date'
            )
            ->where('coursescore.active', 'y')
            ->whereBetween('coursescore.create_date', [
                now()->subDays(7),
                now()
            ])
            ->orderByDesc('coursescore.create_date')
            ->get();
        
        $pass = $weeklyScores->where('score_status', 'pass');

        $fail = $weeklyScores->where('score_status', 'fail');

        $totalExam = $weeklyScores->count();

        $totalPass = $weeklyScores->where('score_status','pass')->count();

        $totalFail = $weeklyScores->where('score_status','fail')->count();

        $passRate = $totalExam > 0
            ? round(($totalPass / $totalExam) * 100, 2)
            : 0;

        Mail::to('tanapat@bangkokwebsolution.com')
            ->send(new WeeklyReportMail(
                $weeklyScores,
                $pass,
                $fail,
                $totalExam,
                $totalPass,
                $totalFail,
                $passRate,
            ));

        $this->info('Report Sent');

        Log::info('Weekly Report Sent');
    }
}