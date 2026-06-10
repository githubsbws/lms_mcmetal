<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html class="transition-navbar-scroll top-navbar-xlarge bottom-footer" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <!-- Compressed Vendor BUNDLE
    Includes vendor (3rd party) styling such as the customized Bootstrap and other 3rd party libraries used for the current theme/module -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/vendor.min.css" rel="stylesheet">
    <!-- Compressed Theme BUNDLE
Note: The bundle includes all the custom styling required for the current theme, however
it was tweaked for the current theme/module and does NOT include ALL of the standalone modules;
The bundle was generated using modern frontend development tools that are provided with the package
To learn more about the development process, please refer to the documentation. -->
    <!-- <link href="css/theme.bundle.min.css" rel="stylesheet"> -->
    <!-- Compressed Theme CORE
This variant is to be used when loading the separate styling modules -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/theme-core.css" rel="stylesheet">
    <!-- Standalone Modules
    As a convenience, we provide the entire UI framework broke down in separate modules
    Some of the standalone modules may have not been used with the current theme/module
    but ALL modules are 100% compatible -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/module-essentials.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/module-material.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/module-layout.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/module-sidebar.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/module-sidebar-skins.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/module-navbar.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/module-messages.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/module-carousel-slick.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/module-charts.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/module-maps.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/module-colors-alerts.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/module-colors-background.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/module-colors-buttons.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/module-colors-text.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-style.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/custom-font.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/plugins/system/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- If you don't need support for Internet Explorer <= 8 you can safely remove these -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .box-news{
            height: 155px;
            overflow: hidden;
        }
        .box-course{
            height: 124px;
            overflow: hidden;
        }
        .text-headline{
            font-size: 18px;
        }
        .footer-section a{
            color: #757575;
        }
        .footer-section a:hover{
            color: white;
        }
    </style>
</head>
<body>
<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top navbar-size-large navbar-size-xlarge paper-shadow" data-z="0" data-animated role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand navbar-brand-logo">
                <a href="<?php echo $this->createUrl('/site/index'); ?>">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/brotherlogo.png">
                </a>
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <?php $this->renderPartial('//layouts/_menu'); ?>
        <!-- /.navbar-collapse -->
    </div>
</div>
<?php echo $content; ?>
<!-- Footer -->
<section class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-2">
                <h4 class="text-headline text-light" style="font-size: 24px;">Corporate</h4>
                <ul class="list-unstyled" style="font-size: 1.4rem;">
                    <li><a href="<?php echo Yii::app()->createUrl('about/index');?>">เกี่ยวกับบริษัท</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('conditions/index');?>">เงื่อนไขการใช้งาน</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('contactus/index');?>">ติดต่อเรา</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-2">
                <h4 class="text-headline text-light" style="font-size: 24px;">เกี่ยวกับการเรียน</h4>
                <ul class="list-unstyled" style="font-size: 1.4rem;">
                    <li><a href="<?php echo Yii::app()->createUrl('course/index');?>">หลักสูตร</a></li>
                    <li><a href="<?php echo Yii::app()->createUrl('user/registration');?>">สมัครสมาชิก</a></li>
                </ul>
            </div>
            <div class="col-xs-12 col-md-3">
                <!-- Histats.com  START  (standard)-->
                <h4 class="text-headline text-light" style="font-size: 24px;">สถิติการเข้าชมเว็บไซต์</h4>
                <!-- Histats.com  START  (standard)-->
                <script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
                <a href="http://www.histats.com" target="_blank" title="" ><script  type="text/javascript" >
                        try {Histats.start(1,3337735,4,3021,130,80,"00011010");
                            Histats.track_hits();} catch(err){};
                    </script></a>
                <noscript><a href="http://www.histats.com" target="_blank"><img  src="http://sstatic1.histats.com/0.gif?3337735&101" alt="" border="0"></a></noscript>
                <!-- Histats.com  END  -->
            </div>
            <div class="col-xs-12 col-md-5">
                <h4 class="text-headline text-light" style="font-size: 24px;">ติดต่อเรา</h4>
                <p>บริษัท บราเดอร์ คอมเมอร์เชี่ยล (ประเทศไทย) จำกัด (สำนักงานใหญ่)</p>
                <p>ชั้น 21 รสาทาวเวอร์ 2, 555 ถนนพหลโยธิน
                    แขวงจตุจักร เขตจตุจักร กรุงเทพ 10900

                </p>
                <p>โทรศัพท์:(66) 2665-7700 || โทรสาร:(66) 2665-7799</p>
            </div>
            <div class="col-md-12 text-center" style="margin-top: 10px;margin-bottom: 0;">
                <p style="margin-bottom: 0;"><?php echo Yii::app()->name; ?> &copy; Copyright <?php echo 2016; ?></p>
            </div>
        </div>
    </div>
</section>
<!-- // Footer -->
<!-- Inline Script for colors and config objects; used by various external scripts; -->
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
<!-- Separate Vendor Script Bundles -->
<?php
$cs=Yii::app()->clientScript;
$path=Yii::app()->baseUrl;
$path_theme=Yii::app()->theme->baseUrl;
$cs->scriptMap = array(
    'jquery.js' => $path_theme.'/js/vendor-core.min.js',
//    'jquery.yii.js' => Yii::app()->request->baseUrl.'/js/jquery.min.js',
);
$cs->registerCoreScript('jquery');
//$cs->registerScriptFile($path_theme.'/js/vendor-core.min.js',CClientScript::POS_READY);
$cs->registerScriptFile($path_theme.'/js/vendor-countdown.min.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/vendor-tables.min.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/vendor-forms.min.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/vendor-carousel-slick.min.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/vendor-player.min.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/vendor-charts-flot.min.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/vendor-nestable.min.js',CClientScript::POS_END);
?>
<!--<script src="--><?php //echo Yii::app()->theme->baseUrl; ?><!--/js/vendor-core.min.js"></script>-->


<!-- <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor-angular.min.js"></script> -->
<!-- Compressed Vendor Scripts Bundle
Includes all of the 3rd party JavaScript libraries above.
The bundle was generated using modern frontend development tools that are provided with the package
To learn more about the development process, please refer to the documentation.
Do not use it simultaneously with the separate bundles above. -->
<!-- <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor-bundle-all.min.js"></script> -->
<!-- Compressed App Scripts Bundle
Includes Custom Application JavaScript used for the current theme/module;
Do not use it simultaneously with the standalone modules below. -->
<!-- <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/module-bundle-main.min.js"></script> -->
<!-- Standalone Modules
As a convenience, we provide the entire UI framework broke down in separate modules
Some of the standalone modules may have not been used with the current theme/module
but ALL the modules are 100% compatible -->
<?php
$cs->registerScriptFile($path_theme.'/js/module-essentials.min.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/module-material.min.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/module-layout.min.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/module-sidebar.min.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/module-carousel-slick.min.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/module-player.min.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/module-messages.min.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/module-maps-google.min.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/module-charts-flot.min.js',CClientScript::POS_END);
?>
<!-- [html] Core Theme Script:
    Includes the custom JavaScript for this theme/module;
    The file has to be loaded in addition to the UI modules above;
    module-bundle-main.js already includes theme-core.js so this should be loaded
    ONLY when using the standalone modules; -->
<?php
$cs->registerScriptFile($path_theme.'/js/theme-core.min.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/jquery.bootstrap.wizard.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/wizard.js',CClientScript::POS_END);
$cs->registerScriptFile($path_theme.'/js/jquery.highlight.js',CClientScript::POS_END);
?>
<style type="text/css" media="screen">
    .highlight {
    background-color: #FFFF88;
    }
</style>
<script type="text/javascript">
    $(function(){
        $(".container").highlight("<?=$_POST['search_text']?>");
    });
</script>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/sweetalert/dist/sweetalert.css">
    <script src="<?php echo Yii::app()->baseUrl; ?>/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>


