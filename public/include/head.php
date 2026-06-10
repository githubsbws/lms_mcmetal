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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>

    <link href="themes/bws/css/vendor.min.css" rel="stylesheet">
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
    <link href="themes/bws/css/custom-font.css" rel="stylesheet" />

    <!--    layerslide-->
    <link href="themes/bws/layerslider/css/layerslider.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="themes/bws/css/sweetalert.css">

    <link href="themes/bws/css/style.css" rel="stylesheet" />
    <!--    layerslide-->

    <!--    jquery   --->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"
        integrity="sha512-ju6u+4bPX50JQmgU97YOGAXmRMrD9as4LE05PdC3qycsGQmjGlfm041azyB1VfCXpkpt1i9gqXCT6XuxhBJtKg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--    jquery   --->


</head>
<section class="nav-header">
    <div class="navbar navbar-default navbar-fixed-top navbar-size-large paper-shadow navbar-size-xlarge" data-z="0"
        data-animated="" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand navbar-brand-logo">
                    <a href="index.php">
                        <img src="themes/bws/images/brotherlogo.png">
                    </a>
                </div>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="main-nav">
                <ul class="nav navbar-nav navbar-nav-margin-left">
                    <li class="dropdown">
                        <a href="index.php" style="font-size: 20px; color: #00529D;"><span
                                class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
                    </li>
                    <li class="dropdown">
                        <a href="news.php">ข่าวสาร</a>
                        <!-- <a href="#modal-ckeck-key-new" data-toggle="modal">ข่าวสาร</a> -->
                    </li>
                    <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">หลักสูตร <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/lms_brother_docker/lms/app/index.php/course/index">หลักสูตรทั้งหมด</a></li>
                            <li><a href="#">หลักสูตร A</a></li>
                        </ul>
                    </li> -->
                    <li class="dropdown">
                        <a href="course.php">หลักสูตร</a>
                    </li>
                    <li class="dropdown">
                        <a href="webboard.php">เว็บบอร์ด</a>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">วิธีการใช้งาน <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="usability.php">การติดตามผลการเรียน</a>
                            </li>
                            <li>
                                <a href="usability.php">การทำแบบสอบถาม</a>
                            </li>
                            <li>
                                <a href="usability.php">การสอบและผลการสอบ</a>
                            </li>
                            <li>
                                <a href="usability.php">การเข้าสู่ห้องเรียนออนไลน์</a>
                            </li>
                            <li>
                                <a href="usability.php">การสมัครสมาชิก</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="faq.php">คำถามที่พบบ่อย</a>
                    </li>
                    <li class="dropdown">

                        <a href="virtualclassroom.php">ห้องเรียน</a>

                    </li>
                    <li class="dropdown">

                        <a href="dashboard.php">แดชบอร์ด</a>

                    </li>


                    <!--                    <li class="dropdown--><!--">-->
                    <!--                        <a href="-->
                    <!--">แบบประเมิน</a>-->
                    <!--                    </li>-->
                    <!--                    <li class="dropdown--><!--">-->
                    <!--                        <a href="--><!--">ข้อสอบ</a>-->
                    <!--                    </li>-->
                    <!--                    <li class="dropdown--><!--">-->
                    <!--                        <a href="-->
                    <!--">สมัครสมาชิก</a>-->
                    <!--                    </li>-->
                </ul>
                <div class="navbar-right"
                    style="border-left: 1px solid rgb(216, 216, 216); padding-left: 15px; padding-right: 15px; border-right: 1px solid rgb(216, 216, 216);">
                    <ul class="nav navbar-nav navbar-nav-bordered">
                        <!-- user -->
                        <li class="dropdown user" style="border-right-color: #fff;">
                            <a href="#" class="dropdown-toggle ripple" data-toggle="dropdown"
                                aria-expanded="false"><span class="ink animate"
                                    style="height: 177px; width: 177px; top: -52.5px; left: -8.07501px;"></span>
                                <img class="img-circle" style="height:30px;"
                                    src="themes/bws/images/default-avatar.png" alt="No Image"> Administrator <span
                                    class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu"
                                style="height: auto; display: none; overflow: visible; top: 100%; opacity: 0;">
                                <li><a href="dashboard.php"><i class="fa fa-bar-chart-o"></i> Dashboard</a></li>
                                <li><a href="course.php"><i class="fa fa-mortar-board"></i> หลักสูตรของฉัน</a></li>
                                <li><a href="user.php"><i class="fa fa-user"></i>
                                        โปรไฟล์</a></li>
                                <li><a href="index.php"><i class="fa fa-sign-out"></i>
                                        ออกจากระบบ</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- No login -->
                <!--  <div class="navbar-right" style="border-left: 1px solid rgb(216, 216, 216); padding-left: 15px; padding-right: 15px; border-right: 1px solid rgb(216, 216, 216);">
                    <a href="/lms_brother_docker/lms/app/index.php/user/login" class="navbar-btn btn btn-primary"><i class="fa fa-fw fa-user"></i> เข้าสู่ระบบ</a>
                </div> -->
            </div>

            <div class="modal fade" id="modal-ckeck-key-new">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title modalhead"><i class="fa fa-sign-in" aria-hidden="true"></i>
                                ยืนยันรหัสผ่าน</h4>
                        </div>
                        <form action="/lms_brother_docker/lms/app/index.php/site/chkkey" method="post"
                            enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2 text-center">
                                        <h3 class="font-weight-bold">กรุณากรอกรหัส key เพื่่อยืนยันตัวตน</h3>
                                        <input type="hidden" name="id" class="form-control" value="new">
                                        <input type="password" name="check_key" class="form-control"
                                            autocomplete="off">

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">ตกลง</button>
                                <button class="btn btn-warning" href="#" data-dismiss="modal"
                                    aria-hidden="true">ยกเลิก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <a class="btn " id="insertt" href='/logout_t'>ออกจากระบบ</a>
            <!-- /.navbar-collapse -->
        </div>
    </div>
</section>
<script src="themes/bws/js/vendor-core.min.js"></script>
<script src="themes/bws/js/vendor-countdown.min.js"></script>
<script src="themes/bws/js/vendor-tables.min.js"></script>
<script src="themes/bws/js/vendor-forms.min.js"></script>
<script src="themes/bws/js/vendor-carousel-slick.min.js"></script>
<script src="themes/bws/js/vendor-player.min.js"></script>
<script src="themes/bws/js/vendor-charts-flot.min.js"></script>
<script src="themes/bws/js/vendor-nestable.min.js"></script>
<script src="themes/bws/js/module-essentials.min.js"></script>
<script src="themes/bws/js/module-material.min.js"></script>
<script src="themes/bws/js/module-layout.min.js"></script>
<script src="themes/bws/js/module-sidebar.min.js"></script>
<script src="themes/bws/js/module-carousel-slick.min.js"></script>
<script src="themes/bws/js/module-player.min.js"></script>
<script src="themes/bws/js/module-messages.min.js"></script>
<script src="themes/bws/js/module-maps-google.min.js"></script>
<script src="themes/bws/js/module-charts-flot.min.js"></script>
<script src="themes/bws/layerslider/js/greensock.js" type="text/javascript"></script>
<script src="themes/bws/layerslider/js/layerslider.transitions.js" type="text/javascript"></script>
<script src="themes/bws/layerslider/js/layerslider.kreaturamedia.jquery.js" rel="stylesheet"></script>


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
