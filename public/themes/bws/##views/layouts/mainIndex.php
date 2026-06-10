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

    <!--    layerslide-->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/layerslider/css/layerslider.css" rel="stylesheet" />
    <!--    layerslide-->

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
                <div class="col-sm-6 col-md-3">
                    <h4 class="text-headline text-light" style="font-size: 27px;">Corporate</h4>
                    <ul class="list-unstyled" style="font-size: 1.4rem;">
                        <li><a href="#">เกี่ยวกับบริษัท</a></li>
                        <li><a href="#">เงื่อนไขการใช้งาน</a></li>
                        <li><a href="#">ติดต่อเรา</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3">
                    <h4 class="text-headline text-light" style="font-size: 27px;">การเรียน</h4>
                    <ul class="list-unstyled" style="font-size: 1.4rem;">
                        <li><a href="">หลักสูตร</a></li>
                        <li><a href="">สมัครสมาชิก</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-md-6">
                    <br/>
                    <p>
                        <a href="#" class="btn btn-indigo-500 btn-circle"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="btn btn-pink-500 btn-circle"><i class="fa fa-dribbble"></i></a>
                        <a href="#" class="btn btn-blue-500 btn-circle"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="btn btn-danger btn-circle"><i class="fa fa-google-plus"></i></a>
                    </p>
                    <p class="text-subhead">
                        &copy; 2015 Brother E-learning System.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <strong><?php echo Yii::app()->name; ?></strong> &copy; Copyright 2015
    </footer>
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
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor-core.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor-countdown.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor-tables.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor-forms.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor-carousel-slick.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor-player.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor-charts-flot.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor-nestable.min.js"></script>
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
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/module-essentials.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/module-material.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/module-layout.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/module-sidebar.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/module-carousel-slick.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/module-player.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/module-messages.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/module-maps-google.min.js"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/module-charts-flot.min.js"></script>


    <!--    layerslide-->

    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/layerslider/js/jquery.js" rel="stylesheet" /></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/layerslider/js/greensock.js" type="text/javascript"/></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/layerslider/js/layerslider.transitions.js" type="text/javascript"/></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/layerslider/js/layerslider.kreaturamedia.jquery.js" rel="stylesheet" /></script>
    <script>
        jQuery("#layerslider").layerSlider({
            pauseOnHover: false,
            autoPlayVideos: false,
            skinsPath: '<?=Yii::app()->theme->baseUrl?>/layerslider/skins/'
        });
    </script>

    <!--    layerslide-->

    <!-- [html] Core Theme Script:
        Includes the custom JavaScript for this theme/module;
        The file has to be loaded in addition to the UI modules above;
        module-bundle-main.js already includes theme-core.js so this should be loaded
        ONLY when using the standalone modules; -->
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/theme-core.min.js"></script>
</body>
</html>
