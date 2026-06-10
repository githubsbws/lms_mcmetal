@extends('layout/mainlayout')
@section('content')
<style>
    .error-message {
        color: red;
        font-size: 0.9em;
    }
    .input-error {
        border: 1px solid red;
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
                                <h1>เข้าสู่ระบบ</h1>
                            </div>
                            @if ($errors->any())
                                    <div>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            <div class="form">
                                <form class="form-horizontal" action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"><label
                                                for="UserLogin_username" class="required">ชื่อผู้ใช้ <span
                                                    class="required">*</span></label></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" placeholder="Username"
                                                name="UserLogin[username]" id="UserLogin_username" type="text">
                                        </div>
                                        @error('username')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><label for="UserLogin_password"
                                                class="required">รหัสผ่าน <span
                                                    class="required">*</span></label></label>

                                        <div class="col-sm-9">
                                            <input class="form-control" placeholder="Password"
                                                name="UserLogin[password]" id="UserLogin_password" type="password">
                                        </div>
                                    </div><br>

                                    <div class="form-group">
                                        <div class="col-sm-6 col-sm-offset-3" style="padding: 0;">
                                            <p class="hint">
                                                <a href="/forgot-pass">ลืมรหัสผ่าน?</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6 col-sm-offset-3" style="padding: 0;">
                                            <div class="checkbox icheck">
                                                <input id="ytUserLogin_rememberMe" type="hidden" value="0"
                                                    name="UserLogin[rememberMe]">
                                                <input name="UserLogin[rememberMe]" id="UserLogin_rememberMe"
                                                    value="1" type="checkbox">
                                                <label for="UserLogin_rememberMe">จำการเข้าระบบ</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6 col-sm-offset-3" style="padding: 0;">
                                            <input class="btn btn-primary" type="submit" name="yt0"
                                                value="เข้าสู่ระบบ">
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
</body>
@endsection
