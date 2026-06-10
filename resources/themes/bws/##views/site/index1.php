<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

	<div class="parallax cover overlay cover-image-full home">
        <img class="parallax-layer" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/elearning-banner.png" alt="Learning Cover" />
        <!-- <div class="parallax-layer overlay overlay-full overlay-bg-white bg-transparent" data-speed="8" data-opacity="true">
            <div class="v-center">
                <div class="page-section overlay-bg-white-strong relative paper-shadow" data-z="1">
                    <h1 class="text-display-2 margin-v-0-15 display-inline-block">Brother E-learning System</h1>
                    <p class="text-subhead">หลักสูตรสำหรับช่าง เพื่อการเรียนการซ่อมบำรุงผลิตภัณฑ์</p> -->
                    <!-- <a class="btn btn-green-500 btn-lg paper-shadow" data-hover-z="2" data-animated data-toggle="modal" href="#modal-overlay-signup">Sign Up - Only &dollar;19.00/mo</a> -->
                    <!-- <a class="btn btn-green-500 btn-lg paper-shadow" href="login.html">เข้าสู่ระบบ</a>
                </div>
            </div>
        </div> -->
    </div>
    <div class="container">
        <div class="page-section-heading">
            <h2 class="text-display-1">ข่าวสาร</h2>
            <p class="lead text-muted">ข่าวสาร กิจกรรม และประกาศต่าง ๆ</p>
        </div>
        <div class="row" data-toggle="gridalicious">
            <div class="media">
                <div class="media-left padding-none">
                    <div class="bg-green-300 text-white">
                        <div class="panel-body">
                            <i class="fa fa-newspaper-o fa-2x fa-fw"></i>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="panel panel-default box-news">
                        <div class="panel-body">
                            <div class="text-headline">Delisting and cancellation</div>
                            <p>Further to the announcement made by Nikon Corporation and Optos plc (Optos) on 22 May 2015 that the Scheme has become effective in accordance ...</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="media">
                <div class="media-left padding-none">
                    <div class="bg-purple-300 text-white">
                        <div class="panel-body">
                            <i class="fa fa-newspaper-o fa-2x fa-fw"></i>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="panel panel-default box-news">
                        <div class="panel-body">
                            <div class="text-headline">Scheme becomes effective</div>
                            <p>Further to the announcement made by Nikon Corporation and Optos plc (Optos) on 22 May 2015 that the Scheme has become effective in accordance ...</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="media">
                <div class="media-left padding-none">
                    <div class="bg-orange-400 text-white">
                        <div class="panel-body">
                            <i class="fa fa-newspaper-o fa-2x fa-fw"></i>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="panel panel-default box-news">
                        <div class="panel-body">
                            <div class="text-headline">Court Sanction of the Scheme</div>
                            <p>Further to the announcement made by Nikon Corporation and Optos plc (Optos) on 22 May 2015 that the Scheme has become effective in accordance ...</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="media">
                <div class="media-left padding-none">
                    <div class="bg-cyan-400 text-white">
                        <div class="panel-body">
                            <i class="fa fa-newspaper-o fa-2x fa-fw"></i>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="panel panel-default box-news">
                        <div class="panel-body">
                            <div class="text-headline">Suspension of listing and trading</div>
                            <p>Further to the announcement made by Nikon Corporation and Optos plc (Optos) on 22 May 2015 that the Scheme has become effective in accordance ...</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="media">
                <div class="media-left padding-none">
                    <div class="bg-pink-400 text-white">
                        <div class="panel-body">
                            <i class="fa fa-newspaper-o fa-2x fa-fw"></i>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="panel panel-default box-news">
                        <div class="panel-body">
                            <div class="text-headline">Anti-trust Conditions Satisfied</div>
                            <p>Further to the announcement made by Nikon Corporation and Optos plc (Optos) on 22 May 2015 that the Scheme has become effective in accordance ...</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="media box-news">
                <div class="media-left padding-none">
                    <div class="bg-red-400 text-white">
                        <div class="panel-body">
                            <i class="fa fa-newspaper-o fa-2x fa-fw"></i>
                        </div>
                    </div>
                </div>
                <div class="media-body">
                    <div class="panel panel-default box-news">
                        <div class="panel-body">
                            <div class="text-headline">Brother Donates 2 Million</div>
                            <p>Further to the announcement made by Nikon Corporation and Optos plc (Optos) on 22 May 2015 that the Scheme has become effective in accordance ...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="page-section bg-white">
        <div class="container">
            <div class="text-center">
                <h3 class="text-display-1">หลักสูตร</h3>
                <p class="lead text-muted">หลักสูตร และหลักสูตรต่าง ๆ ในระบบ</p>
            </div>
            <br/>
            <div class="slick-basic slick-slider" data-items="4" data-items-lg="3" data-items-md="2" data-items-sm="1" data-items-xs="1">
                <div class="item">
                    <div class="panel panel-default paper-shadow box-course" data-z="0.5" data-hover-z="1" data-animated>
                        <div class="panel-body">
                            <div class="media media-clearfix-xs">
                                <div class="media-left">
                                    <div class="cover width-90 width-100pc-xs overlay cover-image-full hover">
                                        <span class="img icon-block s90 bg-default"></span>
                                        <span class="overlay overlay-full padding-none icon-block s90 bg-default">
                        <span class="v-center">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo_course2.png" class="img-responsive">
                        </span>
                                        </span>
                                        <a href="<?php echo $this->createUrl('course/detail'); ?>" class="overlay overlay-full overlay-hover overlay-bg-white">
                                            <span class="v-center">
                            <span class="btn btn-circle btn-white btn-lg"><i class="fa fa-graduation-cap"></i></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading margin-v-5-3"><a href="<?php echo $this->createUrl('course/detail'); ?>">
                                    Color Technologies For ASCs
                                    </a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="panel panel-default paper-shadow box-course" data-z="0.5" data-hover-z="1" data-animated>
                        <div class="panel-body">
                            <div class="media media-clearfix-xs">
                                <div class="media-left">
                                    <div class="cover width-90 width-100pc-xs overlay cover-image-full hover">
                                        <span class="img icon-block s90 bg-default"></span>
                                        <span class="overlay overlay-full padding-none icon-block s90 bg-default">
                        <span class="v-center">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo_course2.png" class="img-responsive">
                        </span>
                                        </span>
                                        <a href="<?php echo $this->createUrl('course/detail'); ?>" class="overlay overlay-full overlay-hover overlay-bg-white">
                                            <span class="v-center">
                            <span class="btn btn-circle btn-white btn-lg"><i class="fa fa-graduation-cap"></i></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading margin-v-5-3"><a href="<?php echo $this->createUrl('course/detail'); ?>">Direct Thermal and Thermal Transfer</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="panel panel-default paper-shadow box-course" data-z="0.5" data-hover-z="1" data-animated>
                        <div class="panel-body">
                            <div class="media media-clearfix-xs">
                                <div class="media-left">
                                    <div class="cover width-90 width-100pc-xs overlay cover-image-full hover">
                                        <span class="img icon-block s90 bg-default"></span>
                                        <span class="overlay overlay-full padding-none icon-block s90 bg-default">
                        <span class="v-center">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo_course2.png" class="img-responsive">
                        </span>
                                        </span>
                                        <a href="<?php echo $this->createUrl('course/detail'); ?>" class="overlay overlay-full overlay-hover overlay-bg-white">
                                            <span class="v-center">
                            <span class="btn btn-circle btn-white btn-lg"><i class="fa fa-graduation-cap"></i></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading margin-v-5-3"><a href="<?php echo $this->createUrl('course/detail'); ?>">Mono Laser Technology</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="panel panel-default paper-shadow box-course" data-z="0.5" data-hover-z="1" data-animated>
                        <div class="panel-body">
                            <div class="media media-clearfix-xs">
                                <div class="media-left">
                                    <div class="cover width-90 width-100pc-xs overlay cover-image-full hover">
                                        <span class="img icon-block s90 bg-default"></span>
                                        <span class="overlay overlay-full padding-none icon-block s90 bg-default">
                        <span class="v-center">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo_course2.png" class="img-responsive">
                        </span>
                                        </span>
                                        <a href="<?php echo $this->createUrl('course/detail'); ?>" class="overlay overlay-full overlay-hover overlay-bg-white">
                                            <span class="v-center">
                            <span class="btn btn-circle btn-white btn-lg"><i class="fa fa-graduation-cap"></i></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading margin-v-5-3"><a href="<?php echo $this->createUrl('course/detail'); ?>">Basic course BHM11</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="panel panel-default paper-shadow box-course" data-z="0.5" data-hover-z="1" data-animated>
                        <div class="panel-body">
                            <div class="media media-clearfix-xs">
                                <div class="media-left">
                                    <div class="cover width-90 width-100pc-xs overlay cover-image-full hover">
                                        <span class="img icon-block s90 bg-default"></span>
                                        <span class="overlay overlay-full padding-none icon-block s90 bg-default">
                        <span class="v-center">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo_course2.png" class="img-responsive">
                        </span>
                                        </span>
                                        <a href="<?php echo $this->createUrl('course/detail'); ?>" class="overlay overlay-full overlay-hover overlay-bg-white">
                                            <span class="v-center">
                            <span class="btn btn-circle btn-white btn-lg"><i class="fa fa-graduation-cap"></i></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading margin-v-5-3"><a href="<?php echo $this->createUrl('course/detail'); ?>">
                                    Color Technologies For ASCs
                                    </a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="panel panel-default paper-shadow box-course" data-z="0.5" data-hover-z="1" data-animated>
                        <div class="panel-body">
                            <div class="media media-clearfix-xs">
                                <div class="media-left">
                                    <div class="cover width-90 width-100pc-xs overlay cover-image-full hover">
                                        <span class="img icon-block s90 bg-default"></span>
                                        <span class="overlay overlay-full padding-none icon-block s90 bg-default">
                        <span class="v-center">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo_course2.png" class="img-responsive">
                        </span>
                                        </span>
                                        <a href="<?php echo $this->createUrl('course/detail'); ?>" class="overlay overlay-full overlay-hover overlay-bg-white">
                                            <span class="v-center">
                            <span class="btn btn-circle btn-white btn-lg"><i class="fa fa-graduation-cap"></i></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading margin-v-5-3"><a href="<?php echo $this->createUrl('course/detail'); ?>">Direct Thermal and Thermal Transfer</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="panel panel-default paper-shadow box-course" data-z="0.5" data-hover-z="1" data-animated>
                        <div class="panel-body">
                            <div class="media media-clearfix-xs">
                                <div class="media-left">
                                    <div class="cover width-90 width-100pc-xs overlay cover-image-full hover">
                                        <span class="img icon-block s90 bg-default"></span>
                                        <span class="overlay overlay-full padding-none icon-block s90 bg-default">
                        <span class="v-center">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo_course2.png" class="img-responsive">
                        </span>
                                        </span>
                                        <a href="<?php echo $this->createUrl('course/detail'); ?>" class="overlay overlay-full overlay-hover overlay-bg-white">
                                            <span class="v-center">
                            <span class="btn btn-circle btn-white btn-lg"><i class="fa fa-graduation-cap"></i></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading margin-v-5-3"><a href="<?php echo $this->createUrl('course/detail'); ?>">Mono Laser Technology</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="panel panel-default paper-shadow box-course" data-z="0.5" data-hover-z="1" data-animated>
                        <div class="panel-body">
                            <div class="media media-clearfix-xs">
                                <div class="media-left">
                                    <div class="cover width-90 width-100pc-xs overlay cover-image-full hover">
                                        <span class="img icon-block s90 bg-default"></span>
                                        <span class="overlay overlay-full padding-none icon-block s90 bg-default">
                        <span class="v-center">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo_course2.png" class="img-responsive">
                        </span>
                                        </span>
                                        <a href="<?php echo $this->createUrl('course/detail'); ?>" class="overlay overlay-full overlay-hover overlay-bg-white">
                                            <span class="v-center">
                            <span class="btn btn-circle btn-white btn-lg"><i class="fa fa-graduation-cap"></i></span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading margin-v-5-3"><a href="<?php echo $this->createUrl('course/detail'); ?>">Basic course BHM11</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                
                
            </div>
            <div class="text-center">
                <br/>
                <a class="btn btn-lg btn-primary" href="<?php echo $this->createUrl('course/index'); ?>">หลักสูตรทั้งหมด</a>
            </div>
        </div>
    </div>
