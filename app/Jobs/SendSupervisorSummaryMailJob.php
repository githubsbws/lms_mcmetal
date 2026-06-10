<?php

namespace App\Jobs;

use App\Mail\SupervisorSummaryMail;
use App\Models\EmailNotificationLog;
use App\Models\Users;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSupervisorSummaryMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3; // retry 3 ครั้งถ้า fail

    public function __construct(
        public Users $boss,
        public array $staffList,
        public array $openingCourses
    ) {}

    public function handle(): void
    {
        try {
            Mail::to($this->boss->email)
                ->send(new SupervisorSummaryMail($this->boss,
                    $this->staffList,
                    $this->openingCourses));

            EmailNotificationLog::create([
                'supervisor_id'    => $this->boss->id,
                'supervisor_email' => $this->boss->email,
                'status'           => 'success',
                'run_at'           => now(),
            ]);

        } catch (\Exception $e) {
            EmailNotificationLog::create([
                'supervisor_id'    => $this->boss->id,
                'supervisor_email' => $this->boss->email,
                'status'           => 'fail',
                'error_log'        => substr($e->getMessage(), 0, 100),
                'run_at'           => now(),
            ]);

            throw $e; // throw ให้ Queue retry
        }
    }


}
