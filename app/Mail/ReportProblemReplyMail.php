<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportProblemReplyMail extends Mailable
{
    public $report;

    public function __construct($report)
    {
        $this->report = $report;
    }

    public function build()
    {
        return $this->subject('ตอบกลับการแจ้งปัญหาการใช้งาน')
                    ->view('emails.reportproblem_reply');
    }
}
