<?php
session_start();

if (!empty($_POST['lang'])) {
    $_SESSION['lang'] = $_POST['lang'];
}

if (empty($_SESSION['lang']) || $_SESSION['lang'] == 1) {
    $_SESSION['lang'] = 1;
    $flag = 'thflag.png';
    $langId = 1;
    $home = 'หน้าเเรก';
    $aboutus = 'เกี่ยวกับเรา';
    $allcourse = 'หลักสูตร';
    $product7 = 'ผลิตภัณฑ์สปา';
    $gallery = 'แกลเลอรี';
    $contactus = 'ติดต่อเรา';
} else {
    $_SESSION['lang'] = 2;
    $flag = 'enflag.png';
    $langId = 2;
    $home = 'Home';
    $aboutus = 'About us';
    $allcourse = 'Course';
    $product7 = 'Product';
    $gallery = 'Gallery';
    $contactus = 'Contact us ';
}

use App\Models\Usability;
?>
<!DOCTYPE html>
<html lang="en">

<style>
    .nav-header .navbar {
        position: relative !important;
        padding: 0 20px;
    }

    .navbar-right {
        border: none !important;


    }

    .navbar-right .btn-primary {
        color: #fff;
        background-color: #093880 !important;
        border-color: #093880 !important;
        border-radius: 26px !important;
    }

    .navbar-right a {
        padding: 0px 21px !important;
        margin: 9px 4px 4px 4px !important !important;
        border-radius: 42px !important;
        line-height: 2.5 !important;
    }

    .navbar-nav>li>.dropdown-menu {
        height: 50px !important;
        overflow: visible !important;
        top: 74px !important;
        opacity: 1 !important;
        border-radius: 16px !important;
    }

    .navbar-right a {
        padding: 10px;
    }

    .dropdown-profile {
        background-color: #093880 !important;
        border-color: #093880 !important;
        border-radius: 26px !important;
        color: #fff !important;
        display: flex !important;
        align-items: center !important;
        height: auto !important;
        line-height: 3 !important;
        padding: 0 16px !important;
        margin-top: 10px !important;
    }

    .navbar.navbar-size-xlarge .navbar-btn {
        margin-top: 16px !important;
        margin-bottom: 16px !important;
    }

    .dropdown-menu {
        opacity: 1 !important;

        a {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            flex-direction: row-reverse !important;
            column-gap: 16px !important;
        }
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toyoseikan E-learning System</title>
    <link href="{{asset('themes/bws/js/vender/video-js/video-js.css')}}" rel="stylesheet">
    <link href="{{asset('themes/bws/js/vender/video-js/video-js.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('asset_admin/plugins/sweetalert2/sweetalert2.min.css')}}">
    {{-- <script src="{{asset('asset_admin/plugins/sweetalert2/sweetalert2.all.js')}}"></script> --}}
    <script src="{{asset('asset_admin/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- <link rel="stylesheet" href="{{asset('assets/bootstrap5.0.2/css/bootstrap.min.css')}}">
    <script src="{{asset('assets/bootstrap5.0.2/js/bootstrap.min.js')}}"></script> --}}
    {{-- <link href="themes/bws/css/vendor.min.css" rel="stylesheet">
    <link href="themes/bws/css/theme-core.css" rel="stylesheet">
    <link href="themes/bws/css/module-essentials.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-material.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-layout.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-sidebar.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-sidebar-skins.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-navbar.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-messages.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-carousel-slick.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-charts.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-maps.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-colors-alerts.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-colors-background.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-colors-buttons.min.css" rel="stylesheet" />
    <link href="themes/bws/css/module-colors-text.min.css" rel="stylesheet" />
    <link href="themes/bws/css/font-style.css" rel="stylesheet" />
    <link href="themes/bws/css/custom-font.css" rel="stylesheet" /> --}}
    @vite(["resources/themes/bws/css/vendor.min.css" ,
    "resources/themes/bws/css/theme-core.css" ,
    "resources/themes/bws/css/module-essentials.min.css" ,
    "resources/themes/bws/css/module-material.min.css" ,
    "resources/themes/bws/css/module-layout.min.css" ,
    "resources/themes/bws/css/module-sidebar.min.css" ,
    "resources/themes/bws/css/module-sidebar-skins.min.css" ,
    "resources/themes/bws/css/module-navbar.min.css" ,
    "resources/themes/bws/css/module-messages.min.css" ,
    "resources/themes/bws/css/module-carousel-slick.min.css" ,
    "resources/themes/bws/css/module-charts.min.css" ,
    "resources/themes/bws/css/module-maps.min.css" ,
    "resources/themes/bws/css/module-colors-alerts.min.css" ,
    "resources/themes/bws/css/module-colors-background.min.css" ,
    "resources/themes/bws/css/module-colors-buttons.min.css" ,
    "resources/themes/bws/css/module-colors-text.min.css" ,
    "resources/themes/bws/css/font-style.css" ,
    "resources/themes/bws/css/custom-font.css" ,
    "resources/themes/bws/layerslider/css/layerslider.css",
    "resources/themes/bws/css/style.css"
    ])

    <!--    jquery   --->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js" integrity="sha512-ju6u+4bPX50JQmgU97YOGAXmRMrD9as4LE05PdC3qycsGQmjGlfm041azyB1VfCXpkpt1i9gqXCT6XuxhBJtKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--    jquery   --->
</head>

<section class="nav-header">
    <div class="navbar navbar-default navbar-fixed-top navbar-size-large paper-shadow navbar-size-xlarge" data-z="0" data-animated="" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand navbar-brand-logo">
                    <a href="{{url('index')}}">
                        <img src="{{ asset('themes/bws/images/toyologo.jpg') }}" class="logonav" style="width: 74px !important; height: auto !important;">
                    </a>
                </div>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="main-nav">
                <ul class="nav navbar-nav navbar-nav-margin-left">
                    <li class="dropdown">
                        <a href="{{url('index')}}" style="font-size: 20px; color: #00529D;"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
                    </li>
                    <li class="dropdown">
                        <a href="{{url('new')}}">ข่าวสาร</a>
                        <!-- <a href="#modal-ckeck-key-new" data-toggle="modal">ข่าวสาร</a> -->
                    </li>
                    @if(Auth::check())
                    <li class="dropdown">
                        <a href="{{ url('course') }}">หลักสูตร</a>
                    </li>

                    <li class="dropdown">
                        <a href="{{url('dashboard')}}">แดชบอร์ด</a>
                    </li>
                    @endif
                    </li>
                       <li class="dropdown">
                        <a href="{{ route('faq_front') }}">คำถามที่พบบ่อย</a>
                    </li>
                    </li>
                       <li class="dropdown">
                        <a href="{{ route('usability_front') }}">วิธีการใช้งาน</a>
                    </li>
                    <li class="dropdown">
                        <a href="{{ route('site.contactus') }}">ติดต่อเรา</a>
                    </li>

                </ul>
                @if(Auth::check())
                <div class="navbar-right" style="border-left: 1px solid rgb(216, 216, 216); padding-left: 15px; padding-right: 15px; border-right: 1px solid rgb(216, 216, 216);">
                    <ul class="nav navbar-nav navbar-nav-bordered">
                        <!-- user -->
                        <li class="dropdown user" style="border-right-color: #fff;">
                            <a href="#" class="dropdown-toggle ripple dropdown-profile" data-toggle="dropdown" aria-expanded="false"><span class="ink animate"></span>

                                <img class="img-circle" style="height:30px;" src="{{ asset('themes/bws/images/default-avatar.png') }}" alt="No Image"> {{Auth::user()->username}} <span class="caret"></span>

                            </a>
                            <ul class="dropdown-menu" role="menu" style="height: auto; display: none; overflow: visible; top: 100%; opacity: 0;">
                                <!-- <li><a href="{{ url('dashboard') }}"><i class="fa fa-bar-chart-o"></i> Dashboard</a></li> -->
                                <!-- <li><a href="{{ url('course') }}"><i class="fa fa-mortar-board"></i> หลักสูตรของฉัน</a></li> -->
                                <!--                 <li><a href="{{ url('profile') }}"><i class="fa fa-user"></i>
                                        โปรไฟล์</a></li>

                                <li> -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf

                                </form>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i>
                                    ออกจากระบบ
                                </a>
                        </li>
                    </ul>
                    </li>
                    </ul>
                </div>

                @else
                <!-- No login -->
                <div class="navmenu">
                    <div class="navbar-right" style="border-left: 1px solid rgb(216, 216, 216); padding-left: 15px; padding-right: 15px; border-right: 1px solid rgb(216, 216, 216);">
                        <a href="{{ url('logins') }}" class="navbar-btn btn btn-primary"><i class="fa fa-fw fa-user"></i> เข้าสู่ระบบ</a>
                    </div>

                    <div class="navbar-right" style="border-left: 1px solid rgb(216, 216, 216); padding-left: 15px; padding-right: 15px; border-right: 1px solid rgb(216, 216, 216);">
                        <a href="{{ url('registers') }}" class="navbar-btn btn btn-primary"><i class="fa-solid fa-registered"></i> สมัครสมาชิก</a>
                    </div>
                </div>
                @endif
            </div>

            <div class="modal fade" id="modal-ckeck-key-new">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title modalhead"><i class="fa fa-sign-in" aria-hidden="true"></i> ยืนยันรหัสผ่าน</h4>
                        </div>
                        <form action="/lms_brother_docker/lms/app/index.php/site/chkkey" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2 text-center">
                                        <h3 class="font-weight-bold">กรุณากรอกรหัส key เพื่่อยืนยันตัวตน</h3>
                                        <input type="hidden" name="id" class="form-control" value="new">
                                        <input type="password" name="check_key" class="form-control" autocomplete="off">

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">ตกลง</button>
                                <button class="btn btn-warning" href="#" data-dismiss="modal" aria-hidden="true">ยกเลิก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- /.navbar-collapse -->
        </div>
    </div>
</section>
<script src="{{ asset('themes/bws/js/sweetalert.min.js')}}"></script>
<script src="{{ asset('themes/bws/js/vender/video-js/video.js')}}"></script>
<script src="{{ asset('themes/bws/js/vendor-core.min.js')}}"></script>
<script src="{{ asset('themes/bws/js/vendor-countdown.min.js')}}"></script>
<script src="{{ asset('themes/bws/js/vendor-tables.min.js')}}"></script>
<script src="{{ asset('themes/bws/js/vendor-forms.min.js')}}"></script>
<script src="{{ asset('themes/bws/js/vendor-carousel-slick.min.js')}}"></script>
<script src="{{ asset('themes/bws/js/vendor-player.min.js')}}"></script>
<script src="{{ asset('themes/bws/js/vendor-charts-flot.min.js')}}"></script>
<script src="{{ asset('themes/bws/js/vendor-nestable.min.js')}}"></script>
<script src="{{ asset('themes/bws/js/module-essentials.min.js')}}"></script>
<script src="{{ asset('themes/bws/js/module-material.min.js')}}"></script>
<script src="{{ asset('themes/bws/js/module-layout.min.js')}}"></script>
<script src="{{ asset('themes/bws/js/module-sidebar.min.js')}}"></script>
<script src="{{ asset('themes/bws/js/module-carousel-slick.min.js')}}"></script>
<script src="{{ asset('themes/bws/js/module-player.min.js')}}"></script>
<script src="{{ asset('themes/bws/js/module-messages.min.js')}}"></script>
{{-- <script src="{{ asset('themes/bws/js/module-maps-google.min.js')}}"></script>
<script src="{{ asset('themes/bws/js/module-charts-flot.min.js')}}"></script> --}}
{{-- <script src="{{ asset('themes/bws/layerslider/js/greensock.js')}}" type="text/javascript"></script>
<script src="{{ asset('themes/bws/layerslider/js/layerslider.transitions.js')}}" type="text/javascript"></script>
<script src="{{ asset('themes/bws/layerslider/js/layerslider.kreaturamedia.jquery.js')}}" rel="stylesheet"></script> --}}

<script>
    var colors = {
        "danger-color": "#e74c3c",
        "success-color": "#81b53e",
        "warning-color": "#f0ad4e",
        "inverse-color": "#2c3e50",
        "info-color": "#2d7cb5",
        "default-color": "#6e7882",
        "default-light-color": "#cfd9db",
        "purple-color": "#9D8AC7",
        "mustard-color": "#d4d171",
        "lightred-color": "#e15258",
        "body-bg": "#f6f6f6"
    };
    var config = {
        theme: "html",
        skins: {
            "default": {
                "primary-color": "#42a5f5"
            }
        }
    };
</script>
