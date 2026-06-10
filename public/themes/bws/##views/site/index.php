<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
?>

	<div class="parallax cover overlay cover-image-full home">
        <!-- Initializing the slider -->
        <style>
            #layerslider * {
                font-family: Lato, 'Open Sans', sans-serif;
            }

            .ls-container, .ls-slide, .ls-inner, .ls-lt-container, .ls-bg {
                -webkit-mask-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAA5JREFUeNpiYGBgAAgwAAAEAAGbA+oJAAAAAElFTkSuQmCC);
                -moz-mask-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAA5JREFUeNpiYGBgAAgwAAAEAAGbA+oJAAAAAElFTkSuQmCC);
                -ms-mask-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAA5JREFUeNpiYGBgAAgwAAAEAAGbA+oJAAAAAElFTkSuQmCC);
                mask-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAIAAACQd1PeAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAA5JREFUeNpiYGBgAAgwAAAEAAGbA+oJAAAAAElFTkSuQmCC);
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
            }

        </style>
        <div id="full-slider-wrapper">
            <div id="layerslider" style="width:100%;height:500px;">
                <div class="ls-slide" data-ls="slidedelay:8000;transition2d:75,79;">
                    <img src="<?=Yii::app()->theme->baseUrl?>/images/sliderimages/slide/bg.png" class="ls-bg" alt="Slide background"/><img class="ls-l"
                                                                                                                                           style="top:0px;left:0px;white-space: nowrap;"
                                                                                                                                           data-ls="offsetxin:0;durationin:2000;easingin:linear;offsetxout:0;durationout:6000;showuntil:1;easingout:linear;"
                                                                                                                                           src="<?=Yii::app()->theme->baseUrl?>/images/sliderimages/slide/bg.png"
                                                                                                                                           alt="">

                    <img class="ls-l" style="white-space: nowrap;" data-ls="durationin:1000;scalexin:0.8;scaleyin:0.8;scalexout:0.8;scaleyout:0.8;"
                         src="<?=Yii::app()->theme->baseUrl?>/images/sliderimages/slide1/bg.png"
                         alt="">


                    <img class="ls-l" style="white-space: nowrap;" data-ls="offsetxin:0;delayin:2000;easingin:easeInOutQuart;scalexin:0.8;scaleyin:0.5;offsetxout:-800;durationout:1000;"
                         src="<?=Yii::app()->theme->baseUrl?>/images/sliderimages/slide1/b1.png"
                         alt="">
                    <img class="ls-l" style="white-space: nowrap;" data-ls="durationin:2500;delayin:3000;rotatein:20;rotatexin:-60;scalexin:1.5;scaleyin:1.5;transformoriginin:left 10% 0;durationout:150;rotateout:20;rotatexout:-30;scalexout:0;scaleyout:0;transformoriginout:left 50% 0;"
                         src="<?=Yii::app()->theme->baseUrl?>/images/sliderimages/slide1/a2.png"
                         alt="">

                    <img class="ls-l" style="white-space: nowrap;" data-ls="durationin:2500;delayin:4000;rotatein:20;rotatexin:30;scalexin:1.5;scaleyin:1.5;transformoriginin:left 80% 0;durationout:750;rotateout:20;rotatexout:-30;scalexout:0;scaleyout:0;transformoriginout:left 50% 0;"
                         src="<?=Yii::app()->theme->baseUrl?>/images/sliderimages/slide1/b3.png"
                         alt="">
                    <img class="ls-l" style="white-space: nowrap;" data-ls="durationin:2500;delayin:5000;rotatein:20;rotatexin:70;scalexin:1.5;scaleyin:1.5;transformoriginin:left 50% 0;durationout:750;rotateout:20;rotatexout:-30;scalexout:0;scaleyout:0;transformoriginout:left 50% 0;"
                         src="<?=Yii::app()->theme->baseUrl?>/images/sliderimages/slide1/a1.png"
                         alt="">

                    <img class="ls-l" style="white-space: nowrap;" data-ls="durationin:2500;delayin:6000;rotatein:20;rotatexin:30;scalexin:1.5;scaleyin:1.5;transformoriginin:left 50% 0;durationout:750;rotateout:20;rotatexout:-30;scalexout:0;scaleyout:0;transformoriginout:left 50% 0;"
                         src="<?=Yii::app()->theme->baseUrl?>/images/sliderimages/slide1/b2.png"
                         alt="">
                    <img class="ls-l" style="white-space: nowrap;" data-ls="durationin:2500;delayin:7000;rotatein:20;rotatexin:30;scalexin:1.5;scaleyin:1.5;transformoriginin:left 80% 0;durationout:750;rotateout:20;rotatexout:-30;scalexout:0;scaleyout:0;transformoriginout:left 50% 0;"
                         src="<?=Yii::app()->theme->baseUrl?>/images/sliderimages/slide1/a3.png"
                         alt="">


                    <img class="ls-l" style="white-space: nowrap;" data-ls="durationin:2500;delayin:8000;rotatein:20;rotatexin:30;scalexin:1.5;scaleyin:1.5;transformoriginin:left 50% 0;durationout:750;rotateout:20;rotatexout:-30;scalexout:0;scaleyout:0;transformoriginout:left 50% 0;"
                                     src="<?=Yii::app()->theme->baseUrl?>/images/sliderimages/slide1/b4.png"
                                     alt="">
                    <img class="ls-l" style="white-space: nowrap;" data-ls="durationin:2500;delayin:9000;rotatein:20;rotatexin:30;scalexin:1.5;scaleyin:1.5;transformoriginin:left 50% 0;durationout:750;rotateout:20;rotatexout:-30;scalexout:0;scaleyout:0;transformoriginout:left 50% 0;"
                         src="<?=Yii::app()->theme->baseUrl?>/images/sliderimages/slide1/a4.png"
                         alt="">





                </div>
            </div>
        </div>
        <!-- Initializing the slider -->


    </div>
    <div class="container">
        <div class="page-section-heading">
            <h2 class="text-display-1">ข่าวสาร</h2>
            <p class="lead text-muted">ข่าวสาร กิจกรรม และประกาศต่าง ๆ</p>
        </div>
        <div class="row" data-toggle="gridalicious">
            <?php
            $classcolor=array('btn-green-500','bg-purple-300','bg-orange-400','bg-cyan-400','bg-pink-400','bg-red-400');
            $i=0;
            foreach($news_data as $news){
                ?>
                <div class="media">
                    <div class="media-left padding-none">
                        <div class="<?php echo $classcolor[$i];?> text-white">
                            <div class="panel-body">
                                <i class="fa fa-newspaper-o fa-2x fa-fw"></i>
                            </div>
                        </div>
                    </div>
                    <div class="media-body">
                        <div class="panel panel-default box-news">
                            <div class="panel-body">
                                <div class="text-headline" style="font-size: 23px;"><?=$news->cms_title;?></div>
                                <p style="font-size: 18px;"><?=iconv_substr($news->cms_short_title,0,150,'utf-8');?> <a href="<?= Yii::app()->createUrl('news/index/', array('id' => $news->cms_id));?>" title="<?=$news->cms_title;?>">อ่านต่อ...</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++;
            } ?>
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
                <?php
                $i=0;
                foreach($course_online as $course_online_data){
                    $folder = explode("_", $course_online_data->course_id);
                    $imageShow = Yii::app()->request->baseUrl.'/uploads/courseonline/'.$folder[0].'/small/'.$course_online_data->course_picture;
                    ?>
                    <div class="item">
                        <div class="panel panel-default paper-shadow box-course" data-z="0.5" data-hover-z="1" data-animated>
                            <div class="panel-body">
                                <div class="media media-clearfix-xs">
                                    <div class="media-left">
<!--                                        -->
                                        <div class="cover width-90 width-100pc-xs overlay cover-image-full hover">
                                            <span class="img icon-block s90 bg-default"></span>
<!--                                            -->
                                            <?php if($course_online_data->course_picture != ""){?>
                                                <span class="overlay overlay-full padding-none icon-block s90 bg-default">
                        <span class="v-center">
<!--                            <img src="--><?//=$imageShow;?><!--" class="img-responsive" style="height: 90px; width: 90px;">-->
                            <img src="http://placehold.it/90x90" class="img-responsive" style="height: 90px; width: 90px;">
                        </span>
                                        </span>
                                            <?php }else{?>
                                                <span class="overlay overlay-full padding-none icon-block s90 bg-default">
                        <span class="v-center">
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo_course2.png" class="img-responsive">
                        </span>
                                        </span>
                                            <?php }?>
<!--                                            -->
                                            <a href="<?php echo $this->createUrl('course/detail'); ?>" class="overlay overlay-full overlay-hover overlay-bg-white">
                                            <span class="v-center">
                            <span class="btn btn-circle btn-white btn-lg"><i class="fa fa-graduation-cap"></i></span>
                                            </span>
                                            </a>
                                        </div>
<!--                                        -->
                                    </div>
                                    <div class="media-body">
                                        <h6 class="media-heading margin-v-5-3"><a href="<?php echo $this->createUrl('course/detail'); ?>">
                                                <?=iconv_substr($course_online_data->course_title,0,100,'utf-8');?>
                                            </a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++;
                } ?>
            </div>

            <div class="text-center">
                <br/>
                <a class="btn btn-lg btn-primary" href="<?php echo $this->createUrl('course/index'); ?>">หลักสูตรทั้งหมด</a>
            </div>
        </div>
    </div>
</br>
<!--<div class="container">-->
<!--    <div class="page-section-heading">-->
<!--        <h2 class="text-display-1">วิธีใช้งาน</h2>-->
<!--        <p class="lead text-muted">วิธีการใช้งานอุปกรณ์ของบราเดอร์</p>-->
<!--    </div>-->
<!--    <div class="row" data-toggle="gridalicious">-->
<!--        <div class="media">-->
<!--            <div class="media-left padding-none">-->
<!--                <div class="bg-green-300 text-white">-->
<!--                    <div class="panel-body">-->
<!--                        <i class="fa fa-newspaper-o fa-2x fa-fw"></i>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="media-body">-->
<!--                <div class="panel panel-default box-news">-->
<!--                    <div class="panel-body">-->
<!--                        <div class="text-headline">บราเดอร์ เปิดตัว ระบบ “โฮโลแกรม”</div>-->
<!--                        <p>บราเดอร์ ทั่วโลก เปิดตัว “โฮโลแกรมรับประกันสินค้าแท้ 100%” ถือเป็นวิธีการตรวจสอบสินค้าใหม่ล่าสุด เริ่มใช้ตั้งแต่เดือนพฤศจิกายนนี้เป็นต้นไป...</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="media">-->
<!--            <div class="media-left padding-none">-->
<!--                <div class="bg-purple-300 text-white">-->
<!--                    <div class="panel-body">-->
<!--                        <i class="fa fa-newspaper-o fa-2x fa-fw"></i>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="media-body">-->
<!--                <div class="panel panel-default box-news">-->
<!--                    <div class="panel-body">-->
<!--                        <div class="text-headline">ชวนคนไทยถวายเครื่องพิมพ์บราเดอร์</div>-->
<!--                        <p>บราเดอร์   ร่วมกับสำนักงานพระพุทธศาสนาแห่งชาติ และบุ๊คสไมล์ ชวนคนไทยสร้างบุญปัญญา   เครื่องพิมพ์บราเดอร์เลเซอร์มัลติฟังก์ชั่น รุ่น...</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="media">-->
<!--            <div class="media-left padding-none">-->
<!--                <div class="bg-orange-400 text-white">-->
<!--                    <div class="panel-body">-->
<!--                        <i class="fa fa-newspaper-o fa-2x fa-fw"></i>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="media-body">-->
<!--                <div class="panel panel-default box-news">-->
<!--                    <div class="panel-body">-->
<!--                        <div class="text-headline">เครื่องพิมพ์อิงค์เจทมัลติฟังก์ชั่น A3 </div>-->
<!--                        <p>บราเดอร์ ผู้นำนวัตกรรมเครื่องพิมพ์และอุปกรณ์การพิมพ์ ขอแนะนำ เครื่องพิมพ์อิงค์เจทมัลติฟังก์ชั่นสี รุ่นล่าสุด MFC-J3520 InkBenefit...</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
