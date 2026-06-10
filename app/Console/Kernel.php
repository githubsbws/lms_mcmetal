<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        //noti แจ้งเตือนหัวหน้าเรื่องการเรียน
        $schedule->command('app:send-weekly-supervisor-notify')
             ->weeklyOn(0, '23:00'); // ทุกวันอาทิตย์ 5 ทุ่ม
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }


}
