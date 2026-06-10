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
                                <h1>ลืมรหัสผ่าน</h1>
                            </div>
                            <div class="form">
                                <form class="form-horizontal" action="{{ route('password.forgot') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">
                                            <label for="UserRecoveryForm_login_or_email">Username</label>
                                        </label>
                                        <div class="col-sm-9">
                                            <input class="form-control" placeholder="กรุณาใส่ Username" name="login_or_email" id="UserRecoveryForm_login_or_email" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-6 col-sm-offset-3" style="padding: 0;">
                                            <input class="btn btn-primary" type="submit" value="รีเซ็ตรหัสผ่าน">
                                        </div>
                                    </div>
                                </form>
                                @if (session('status'))
                                <div class="form-group">
                                    <div class="col-sm-6 col-sm-offset-3" style="padding: 0;">
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @error('login_or_email')
                                    <div class="form-group">
                                        <div class="col-sm-6 col-sm-offset-3" style="padding: 0;">
                                            <span class="{{ $errors->has('login_or_email') ? 'input-error' : '' }}">{{ $message }}</span>
                                        </div>
                                    </div>
                                @enderror
                            </div><!-- form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
