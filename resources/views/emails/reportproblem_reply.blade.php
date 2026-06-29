<h2>ตอบกลับการแจ้งปัญหา</h2>

<p>เรียน {{ $report->fullname }} {{ $report->lastname }}</p>

<p>หัวข้อปัญหา</p>

<p>
    {{ $report->report_title }}
</p>

<hr>

<p><strong>รายละเอียดที่แจ้ง</strong></p>

{!! nl2br(e($report->report_detail)) !!}

<hr>

<p><strong>คำตอบจากเจ้าหน้าที่</strong></p>

{!! $report->answer !!}

<br><br>

ขอขอบคุณสำหรับการแจ้งปัญหาการใช้งาน