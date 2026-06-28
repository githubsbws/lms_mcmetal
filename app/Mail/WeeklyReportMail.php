<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WeeklyReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public $weeklyScores,
        public $pass,
        public $fail,
        public $totalExam,
        public $totalPass,
        public $totalFail,
        public $passRate,
    ){}

    public function build()
    {
        return $this
            ->subject('รายงานสรุปการเรียน')
            ->view('emails.weekly-report');
    }
}
