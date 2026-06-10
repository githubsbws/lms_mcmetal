<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/vender/video-js/video.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/vender/gallery/js/blueimp-gallery.min.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/js/vender/video-js/video-js.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl.'/js/vender/gallery/css/blueimp-gallery.min.css');
?>

    <div class="parallax bg-white page-section third">
        <div class="container parallax-layer" data-opacity="true">
            <div class="media v-middle media-overflow-visible">
                <div class="media-left">
                    <span class="icon-block s30 bg-default"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo_course2.png" width="30" class="img-responsive"></span>
                </div>
                <div class="media-body">
                    <div class="text-headline">Color Technologies For ASCs</div>
                </div>
                <div class="media-right">
                    <div class="dropdown">
                        <a class="btn btn-white dropdown-toggle" data-toggle="dropdown" href="#">หลักสูตร <span class="caret"></span></a>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?php echo $this->createUrl('course/detail'); ?>">Direct Thermal and Thermal Transfer</a></li>
                            <li><a href="<?php echo $this->createUrl('course/detail'); ?>">Mono Laser Technology</a></li>
                            <li><a href="<?php echo $this->createUrl('course/detail'); ?>">Basic course BHM11</a></li>
                            <li><a href="<?php echo $this->createUrl('course/detail'); ?>">Browserify: Writing Modular JavaScript</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="page-section">
            <div class="row">
                <div class="col-md-9">
                    <div class="page-section padding-top-none">
                        <div class="media media-grid v-middle">
                            <div class="media-left">
                                <!-- <span class="icon-block half bg-blue-300 text-white">2</span> -->
                                <span class="icon-block half bg-default text-white"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo_course2.png" width="50" class="img-responsive"></span>
                            </div>
                            <div class="media-body">
                                <h1 class="text-display-1 margin-none">Basic Specification and Line-up</h1>
                            </div>
                        </div>
                        <br/>
                        <p class="text-body-2">
                        Engine: New Color Laser and Color LED <br>
                        Model: BC2 Series
                        </p>
<style type="text/css">
    .video-js .vjs-tech {
        height: auto !important;
        position: relative !important;
    }
    /*.vjs-control-bar { display:none!important; }*/
    .vjs-progress-control {
        display: none;
    }
</style>

<?php
Yii::app()->clientScript->registerScript('init-video-js','

    videojs.options.flash.swf = "'.Yii::app()->theme->baseUrl.'/js/vender/video-js/video-js.swf";

    document.getElementById("links").onclick = function (event) {
        event = event || window.event;
        var target = event.target || event.srcElement,
            link = target.src ? target.parentNode : target,
            options = {index: link, event: event},
            links = this.getElementsByTagName("a");
        blueimp.Gallery(links, options);
    };

',CClientScript::POS_END);
?>
                        <div class="video">
                            <video id="example_video_1" class="video-js vjs-default-skin"
                              controls preload="auto" width="auto" height="auto"
                              poster="http://video-js.zencoder.com/oceans-clip.png"
                              data-setup='{"example_option":true}'>
                             <source src="http://video-js.zencoder.com/oceans-clip.mp4" type='video/mp4' />
                             <source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' />
                             <source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' />
                             <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
                            </video>
                        </div>
                        <div class="slide">
                            <img src="<?php echo Yii::app()->baseUrl; ?>/images/slide-0.jpg" style="width:100%" class="img-responsive">
                        </div>
                        <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                        <div id="blueimp-gallery" class="blueimp-gallery">
                            <div class="slides"></div>
                            <h3 class="title"></h3>
                            <a class="prev">‹</a>
                            <a class="next">›</a>
                            <a class="close">×</a>
                            <a class="play-pause"></a>
                            <ol class="indicator"></ol>
                        </div>

                        <div id="links" class="slide-thumb row">
                            <a href="<?php echo Yii::app()->baseUrl; ?>/images/slide-1.jpg" title="Slide1">
                                <img class="col-xs-3" src="<?php echo Yii::app()->baseUrl; ?>/images/slide-1.jpg" alt="Slide1">
                            </a>
                            <a href="<?php echo Yii::app()->baseUrl; ?>/images/slide-1.jpg" title="Slide1">
                                <img class="col-xs-3" src="<?php echo Yii::app()->baseUrl; ?>/images/slide-1.jpg" alt="Slide1">
                            </a>
                            <a href="<?php echo Yii::app()->baseUrl; ?>/images/slide-1.jpg" title="Slide1">
                                <img class="col-xs-3" src="<?php echo Yii::app()->baseUrl; ?>/images/slide-1.jpg" alt="Slide1">
                            </a>
                            <a href="<?php echo Yii::app()->baseUrl; ?>/images/slide-1.jpg" title="Slide1">
                                <img class="col-xs-3" src="<?php echo Yii::app()->baseUrl; ?>/images/slide-1.jpg" alt="Slide1">
                            </a>
                            <a href="<?php echo Yii::app()->baseUrl; ?>/images/slide-1.jpg" title="Slide1">
                                <img class="col-xs-3" src="<?php echo Yii::app()->baseUrl; ?>/images/slide-1.jpg" alt="Slide1">
                            </a>
                            <a href="<?php echo Yii::app()->baseUrl; ?>/images/slide-1.jpg" title="Slide1">
                                <img class="col-xs-3" src="<?php echo Yii::app()->baseUrl; ?>/images/slide-1.jpg" alt="Slide1">
                            </a>
                        
                        </div>
                    </div>
                    <h5 class="text-subhead-2 text-light">บทเรียน</h5>
                    <div class="panel panel-default curriculum open paper-shadow" data-z="0.5">
                        <div class="panel-heading panel-heading-gray" data-toggle="collapse" data-target="#curriculum-1">
                            <div class="media">
                                <div class="media-left">
                                    <span class="icon-block img-circle bg-indigo-300 half text-white"><i class="fa fa-graduation-cap"></i></span>
                                </div>
                                <div class="media-body">
                                    <h4 class="text-headline">Part 1</h4>
                                    <p>
                                        1. Introduction 10 min.<br>
                                        2. Basic Specification and Line-up 20 min.<br>
                                        3. Product features 40 min.<br>
                                        4. Theory of operation 120 min.
                                    </p>
                                </div>
                            </div>
                            <span class="collapse-status collapse-open">Open</span>
                            <span class="collapse-status collapse-close">Close</span>
                        </div>
                        <div class="list-group collapse in" id="curriculum-1">
                            <div class="list-group-item media" data-target="website-take-course.html">
                                <div class="media-left">
                                    <div class="text-crt">1.</div>
                                </div>
                                <div class="media-body">
                                    <i class="fa fa-fw fa-circle text-green-300"></i> Introduction
                                </div>
                                <div class="media-right">
                                    <div class="width-100 text-right text-caption">10:00 min</div>
                                </div>
                            </div>
                            <div class="list-group-item media active" data-target="website-take-course.html">
                                <div class="media-left">
                                    <div class="text-crt">2.</div>
                                </div>
                                <div class="media-body">
                                    <i class="fa fa-fw fa-circle text-blue-300"></i> Basic Specification and Line-up
                                </div>
                                <div class="media-right">
                                    <div class="width-100 text-right text-caption">20:00 min</div>
                                </div>
                            </div>
                            <div class="list-group-item media" data-target="website-take-course.html">
                                <div class="media-left">
                                    <div class="text-crt">3.</div>
                                </div>
                                <div class="media-body">
                                    <i class="fa fa-fw fa-circle text-grey-200"></i> Product features
                                </div>
                                <div class="media-right">
                                    <div class="width-100 text-right text-caption">40:00 min</div>
                                </div>
                            </div>
                            <div class="list-group-item media" data-target="website-take-course.html">
                                <div class="media-left">
                                    <div class="text-crt">4.</div>
                                </div>
                                <div class="media-body">
                                    <i class="fa fa-fw fa-circle text-grey-200"></i> Theory of operation
                                </div>
                                <div class="media-right">
                                    <div class="width-100 text-right text-caption">120:00 min</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default curriculum paper-shadow" data-z="0.5">
                        <div class="panel-heading panel-heading-gray" data-toggle="collapse" data-target="#curriculum-2">
                            <div class="media">
                                <div class="media-left">
                                    <span class="icon-block half img-circle bg-orange-300 text-white"><i class="fa fa-graduation-cap"></i></span>
                                </div>
                                <div class="media-body">
                                    <h4 class="text-headline">Part 2</h4>
                                    <p>
                                        5. Disassembly Procedure 120 min.<br>
                                        6. Part setup procedure 60 min.
                                    </p>
                                </div>
                            </div>
                            <span class="collapse-status collapse-open">Open</span>
                            <span class="collapse-status collapse-close">Close</span>
                        </div>
                        <div class="list-group collapse in" id="curriculum-2">
                            <div class="list-group-item media" data-target="website-take-course.html">
                                <div class="media-left">
                                    <div class="text-crt">1.</div>
                                </div>
                                <div class="media-body">
                                    <i class="fa fa-fw fa-circle text-grey-200"></i> Disassembly Procedure
                                </div>
                                <div class="media-right">
                                    <div class="width-100 text-right text-caption">120:00 min</div>
                                </div>
                            </div>
                            <div class="list-group-item media" data-target="website-take-course.html">
                                <div class="media-left">
                                    <div class="text-crt">2.</div>
                                </div>
                                <div class="media-body">
                                    <i class="fa fa-fw fa-circle text-grey-200"></i> Part setup procedure
                                </div>
                                <div class="media-right">
                                    <div class="width-100 text-right text-caption">60:00 min</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <br/>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                        <div class="panel-heading panel-collapse-trigger">
                            <h4 class="panel-title">หัวข้อเกี่ยวกับหลักสูตร</h4>
                        </div>
                        <div class="panel-body list-group">
                            <ul class="list-group list-group-menu">
                                <li class="list-group-item active"><a class="link-text-color" href="<?php echo $this->createUrl('course/detail'); ?>">บทเรียน</a></li>
                                <li class="list-group-item"><a class="link-text-color" href="<?php echo $this->createUrl('/forum'); ?>">เว็บบอร์ดของหลักสูตร</a></li>
                                <li class="list-group-item"><a class="link-text-color" href="<?php echo $this->createUrl('quiz/index'); ?>">ทำแบบทดสอบ</a></li>
                                <li class="list-group-item"><a class="link-text-color" href="<?php echo $this->createUrl('#'); ?>">ผลการทำแบบทดสอบ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                        <div class="panel-heading panel-collapse-trigger">
                            <h4 class="panel-title">ผู้สอน</h4>
                        </div>
                        <div class="panel-body">
                            <div class="media v-middle">
                                <div class="media-left">
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/people/110/guy-6.jpg" alt="About Adrian" width="60" class="img-circle" />
                                </div>
                                <div class="media-body">
                                    <h4 class="text-title margin-none"><a href="#">Thitiwat Pathak</a></h4>
                                    <span class="caption text-light">นักวิจัย</span>
                                </div>
                            </div>
                            <br/>
                            <div class="expandable expandable-indicator-white expandable-trigger">
                                <div class="expandable-content">
                                    <p>มีความรู้พื้นฐานในสาขาวิชาที่ทำการวิจัยเป็นอย่างดี นับเป็นความจำเป็นมากที่นักวิจัยจะต้องมีความรู้เป็นอย่างดีในสาขาวิชาที่ตนทำการวิจัยอยู่เพื่อจะได้เลือกใช้เทคนิค วิธีการและเครื่องมือให้เหมาะสมสอดคล้องกับลักษณะของงานวิจัยนั้น และสามารถค้นหาหรือเลือกใช้ความรู้จากงานวิจัยที่แล้วมาได้อย่างรวดเร็ว นอกจากนี้การที่นักวิจัยมีความรู้ดีก็จะสามารถสรุปผลของข้อมูลได้อย่างมีประสิทธิภาพอีกด้วย ฉะนั้นนักวิจัยจึงต้องค้นคว้าติดตามอ่านผลงานวิจัยที่ตีพิมพ์ใหม่ ๆ อยู่เสมอ เพื่อจะได้ศึกษาความก้าวหน้าทางวิชาการและเทคนิคใหม่ ๆ อยู่ตลอดเวลา</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>