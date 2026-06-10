<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h1>รีเซ็ตรหัสผ่าน</h1>
    <p>คลิกที่ลิงก์ด้านล่างเพื่อรีเซ็ตรหัสผ่านของคุณ:</p>
    <a href="{{ url('/reset-password/' . $token) }}">รีเซ็ตรหัสผ่าน</a>
</body>
</html>