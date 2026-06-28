<h2>ผลการสอบ</h2>

<p>สวัสดี {{ $user->username }}</p>

<p>หลักสูตร : {{ $course->course_title }}</p>

<p>คะแนน : {{ $score }}</p>

@if($pass)
    <p style="color:green">
        ยินดีด้วย คุณสอบผ่าน
    </p>
@else
    <p style="color:red">
        ขออภัย คุณสอบไม่ผ่าน
    </p>
@endif