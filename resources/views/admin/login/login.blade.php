<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8"> <![endif]-->
<!--[if !IE]><!--><html><!-- <![endif]-->
<head>
    <title>Admin</title>
    <!-- Meta -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />

    <!-- Bootstrap -->
	<link href="{{asset('Adminkit/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />
	<link href="{{asset('Adminkit/bootstrap/css/responsive.css')}}" rel="stylesheet" />

	<!-- Glyphicons Font Icons -->
	<link href="{{asset('Adminkit/theme/css/glyphicons.css')}}" rel="stylesheet" />

	<!-- Uniform Pretty Checkboxes -->
	<link href="{{asset('Adminkit/theme/scripts/plugins/forms/pixelmatrix-uniform/css/uniform.default.css')}}" rel="stylesheet" />

	<!-- Main Theme Stylesheet :: CSS -->
	<link href="{{asset('Adminkit/theme/css/style.min.css')}}" rel="stylesheet" />


	<script src="{{asset('Adminkit/theme/scripts/plugins/system/jquery.min.js')}}"></script>

    <script src="{{asset('Adminkit/theme/scripts/plugins/system/jquery-ui/js/jquery-ui-1.9.2.custom.min.js')}}"></script>

    <script src="{{asset('Adminkit/theme/scripts/plugins/system/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

    <script src="{{asset('Adminkit/theme/scripts/plugins/system/modernizr.js')}}"></script>

    <script src="{{asset('Adminkit/bootstrap/js/bootstrap.min.js')}}"></script>

    <script src="{{asset('Adminkit/theme/scripts/plugins/other/jquery-slimScroll/jquery.slimscroll.min.js')}}"></script>

    <script src="{{asset('Adminkit/theme/scripts/demo/common.js')}}"></script>

    <script src="{{asset('Adminkit/theme/scripts/plugins/other/holder/holder.js')}}"></script>

    <script src="{{asset('Adminkit/theme/scripts/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js')}}"></script>


</head>
<style>
    .input-error {
        color: white;
        background-color: red;
        padding: 5px;
        margin-top: 5px;
        border-radius: 3px;
        display: inline-block;
    }
    .data-input{
        border-radius: 5px !important;
    }
</style>
<body class="login">

<!-- Wrapper -->
<div id="login">
    <!-- Box -->
    <div class="form-signin">
        <h3>Sign in to Your Account</h3>
        <!-- Row -->
        <div class="row-fluid row-merge">
            <!-- Column -->
            <form enctype="multipart/form-data" id="news-form" action="{{route('login.admin')}}" method="post">
                @csrf
            <div class="span7">
                <div class="inner">

                    <div class="success">

                    </div>
                    <label class="strong">Username</label>
                   <input class="data-input" type="text" name="username" placeholder="Your username">


                        <label class="strong">Password</label>
                       <input class="data-input" type="password" name="password" placeholder="Your password">

                        {{-- <br><br>
                        <div class="g-recaptcha" data-sitekey="6Le3zv8pAAAAACNf85umY6OIKbJYQOJMzoLjR8ZK" data-action="LOGIN"></div>
                        <br> --}}

                        <div class="row-fluid">
                            <div class="span5 center" style="margin-top:10px">
                                <button class="btn btn-block btn-primary"><i></i>เข้าสู่ระบบ</button>
                            </div>
                        </div>
                        @error('username')
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-3" style="padding: 0;">
                                    <span class="{{ $errors->has('username') ? 'input-error' : '' }}">{{ $message }}</span>
                                </div>
                            </div>
                        @enderror
                    </div>
            </div>


        </div>
        <div class="ribbon-wrapper"><div class="ribbon primary">Admin</div></div>
    </div>
</div>
{{-- <script src="https://www.google.com/recaptcha/enterprise.js" async defer></script> --}}
</body>
</html>
