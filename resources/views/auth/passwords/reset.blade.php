@extends('layout/mainlayout')
@section('title', 'Brother e-learning')
@section('content')
<style>
    .input-error {
        color: white;
        background-color: red;
        padding: 5px;
        margin-top: 5px;
        border-radius: 3px;
        display: inline-block;
    }
</style>
<body>

    <div class="container">
        <div class="page-section login-page">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-xs-12" align="center">
                                <h1>Reset Password</h1>
                            </div>
                            <div class="form">
                                <form method="POST" action="{{ route('password.update') }}" onsubmit="return validatePassword()">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" oninput="checkPassword()">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm Password</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row mb-3">
                                        <label for="password-length" class="col-md-4 col-form-label text-md-end">รหัสผ่านต้องมีความยาวมากว่า 8 ตัว</label>
                                        <div class="col-md-6">
                                            <span id="password-length-status"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="password-case" class="col-md-4 col-form-label text-md-end">รหัสผ่านต้องมีตัวอักษรทั้งพิมพ์เล็กและพิมพ์ใหญ่อย่างน้อย 1 ตัว</label>
                                        <div class="col-md-6">
                                            <span id="password-case-status"></span>
                                        </div>
                                    </div>
                                    {{-- <div class="row mb-3">
                                        <label for="password-special" class="col-md-4 col-form-label text-md-end">รหัสผ่านต้องมีสัญลักษณ์พิเศษอย่างน้อย 1 ตัว</label>
                                        <div class="col-md-6">
                                            <span id="password-special-status"></span>
                                        </div>
                                    </div> --}}

                                    @error('password')
                                        <div class="form-group">
                                            <div class="col-sm-6 col-sm-offset-3" style="padding: 0;">
                                                <span class="{{ $errors->has('password') ? 'input-error' : '' }}">{{ $message }}</span>
                                            </div>
                                        </div>
                                    @enderror
                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">Reset Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- form -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function checkPassword() {
            var password = document.getElementById("password").value;

            // ตรวจสอบความยาวของรหัสผ่าน (ต้องมีอย่างน้อย 8 ตัวอักษร)
            if (password.length < 8) {
                document.getElementById("password-length-status").innerHTML = "<p style='color:red;'>รหัสผ่านต้องมีอย่างน้อย 8 ตัว</p>";
            } else {
                document.getElementById("password-length-status").innerHTML = "<p style='color:green;'>&#x2714;</p>";
            }

            // ตรวจสอบว่ามีอักขระพิเศษอย่างน้อย 1 ตัว
            if (!/[!@#$%^&*]/.test(password)) {
                document.getElementById("password-special-status").innerHTML = "<p style='color:red;'>รหัสผ่านต้องมีสัญลักษณ์พิเศษอย่างน้อย 1 ตัว</p>";
            } else {
                document.getElementById("password-special-status").innerHTML = "<p style='color:green;'>&#x2714;</p>";
            }
        }
        function validatePassword() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password-confirm').value;

        if (password !== confirmPassword) {
            alert('รหัสผ่านไม่ตรงกัน');
            return false;
        }

        return true;
    }
    </script>
</body>
@endsection
