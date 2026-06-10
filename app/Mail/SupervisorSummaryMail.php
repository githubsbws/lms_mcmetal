<?php

namespace App\Mail;

use App\Models\Users;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SupervisorSummaryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct(
        public Users $boss,
        public array $staffList,
        public array $openingCourses
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // ใส่ Subject ตรงนี้ครับ
            subject: '[Notification] รายงานสรุปพนักงานที่ต้องติดตามการเรียนประจำสัปดาห์',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $this->boss->loadMissing('Profiles');

        $supervisorName = trim(
            ($this->boss->Profiles->firstname ?? 'ไม่ระบุชื่อ') . ' ' .
            ($this->boss->Profiles->lastname ?? '')
        );
        return new Content(
            // ระบุ Path ของไฟล์ Blade ที่เราสร้างไว้
            view: 'mails.supervisor_summary',
            // ถ้าต้องการส่งตัวแปรไปที่ Blade แบบชัดเจน (Optional)
            with: [
                'supervisorName' => $supervisorName,
                'staffList'      => $this->staffList,
                'openingCourses' => $this->openingCourses,
                'runDate'        => now()->format('d/m/Y'),
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
