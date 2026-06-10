<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ผลการสอบ</title>
</head>
<body>
    <h2>สวัสดีคุณ {{ $name }}</h2>
    <p>คุณได้ทำการสอบในบทเรียน <strong>{{ $lesson }}</strong> เสร็จสิ้นแล้ว</p>
    <p>คะแนนของคุณคือ <strong>{{ $score }}/{{ $total }}</strong></p>
    <p>สถานะผลการสอบ: 
        <strong style="color: {{ $result == 'ผ่าน' ? 'green' : 'red' }}">
            {{ $result }}
        </strong>
    </p>
    <br>
</body>
</html>