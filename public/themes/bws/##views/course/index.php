<div class="parallax overflow-hidden page-section bg-blue-300">
    <div class="container parallax-layer" data-opacity="true">
        <div class="media media-grid v-middle">
            <div class="media-left">
                <span class="icon-block half bg-blue-500 text-white" style="height: 45px;"><i class="fa fa-fw fa-book"></i></span>
            </div>
            <div class="media-body">
                <h3 class="text-display-2 text-white margin-none">หลักสูตร</h3>
                <p class="text-white text-subhead" style="font-size: 1.6rem;">รวมหลักสูตร การทำงานของ Product ของ Brother</p>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="page-section">
        <div class="row">
            <div class="col-md-9">
                <div class="row" data-toggle="isotope">
                    <?php
                    $i = 0;
                    foreach ($course_online as $course_online_data){
                    $folder = explode("_", $course_online_data->course_id);
                    $imageShow = Yii::app()->request->baseUrl . '/uploads/courseonline/' . $folder[0] . '/thumb/' . $course_online_data->course_picture;
                    ?>
                    <div class="item col-xs-12 col-sm-6 col-lg-4">
                        <div class="panel panel-default paper-shadow" data-z="0.5">
                            <div class="cover overlay cover-image-full hover"
                            ">
                            <span class="img icon-block height-150 bg-default"></span>
                            <?php if ($course_online_data->course_picture != "") { ?>
                                <a href="<?php echo $this->createUrl('course/detail'); ?>"
                                   class="padding-none overlay overlay-full icon-block bg-default">
                                        <span class="v-center">
<!--                                            <img src="--><? //=$imageShow;?><!--" style="height: 150px; width: 267px;">-->
                                            <img src="http://placehold.it/268x150" style="height: 150px; width: 267px;">
                                        </span>
                                </a>
                            <?php } else { ?>
                                <a href="<?php echo $this->createUrl('course/detail'); ?>"
                                   class="padding-none overlay overlay-full icon-block bg-default">
                                        <span class="v-center">
                                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo_course.png">
                                    </span>
                                </a>
                            <?php }?>
                            <a href="<?php echo $this->createUrl('course/detail'); ?>"
                               class="overlay overlay-full overlay-hover overlay-bg-white">
                                        <span class="v-center">
                                            <span class="btn btn-circle btn-white btn-lg"><i
                                                    class="fa fa-graduation-cap"></i></span>
                                        </span>
                            </a>
                        </div>
                        <div class="panel-body height-100">
                            <h4 class="text-headline margin-v-0-10" style="font-size: 23px;"><a
                                    href="<?php echo $this->createUrl('course/detail'); ?>"><?= $course_online_data->course_title; ?></a>
                            </h4>
                        </div>
                        <hr class="margin-none"/>
                        <div class="panel-body height-140">
                            <p style="font-size: 1.5rem;color: #545454;"><?= iconv_substr($course_online_data->course_short_title, 0, 100, 'utf-8'); ?></p>

                            <div class="media v-middle">
                                <div class="media-left">
                                    <?php $teacher = Teacher::model()->findByPk($course_online_data->course_lecturer);
                                    $folder = explode("_", $course_online_data->course_lecturer);
                                    $imageShowteacher = Yii::app()->request->baseUrl . '/uploads/teacher/' . $folder[0] . '/small/' . $teacher->teacher_picture;
                                    if ($teacher->teacher_picture != "") {
                                        ?>
                                        <!--                                            <img src="--><? //=$imageShowteacher;
                                        ?><!--" src="http://placehold.it/40x40" alt="People" class="img-circle width-40" />-->
                                        <img src="http://placehold.it/40x40" alt="People" class="img-circle width-40"/>
                                    <?php } else {
                                        ?>
                                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/people/50/guy-3.jpg"
                                             alt="People" class="img-circle width-40"/>
                                    <?php }?>
                                </div>
                                <div class="media-body">
                                    <?php $teacher = Teacher::model()->findByPk($course_online_data->course_lecturer);?>
                                    <h6 style="margin-bottom: 3px;"><a href=""><?= $teacher->teacher_name; ?></a>
                                        <br/>
                                    </h6>
                                    <span style="font-size: 19px;">ชื่อวิทยากร</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $i++;
                } ?>
            </div>
            <div style="float: right;">
            <?php $this->widget('CLinkPager', array(
                'pages' => $pages,
                'header' => '',
                'maxButtonCount' => 6,
                'selectedPageCssClass' => 'active',
                'htmlOptions' => array('class' => 'pagination margin-top-none'),
            )) ?>
                </div>

            <br/>
            <br/>
        </div>
        <div class="col-md-3">
            <?php echo CHtml::form();?>
            <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                <div class="panel-heading panel-collapse-trigger">
                    <h4 class="panel-title">ค้นหา</h4>
                </div>
                <div class="panel-body">
                    <div class="form-group input-group margin-none">
                        <div class="row margin-none">
                            <div class="col-xs-12 padding-none">
                                <input class="form-control" type="text" name="search_text" placeholder="คำค้นหา"/>
                            </div>
                        </div>
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo CHtml::endForm();?>
            <h4>หลักสูตรแนะนำ</h4>

            <div class="slick-basic slick-slider" data-items="1" data-items-lg="1" data-items-md="1" data-items-sm="1"
                 data-items-xs="1">

                <?php
                $course_online = CourseOnline::model()->findAll(array(
                    'condition' => 'active="y"',
                    'order' => 'create_date DESC',
                    'limit' => '6',
                ));
                if ($course_online) {
                    foreach ($course_online as $course_online_data) {
                        $folder = explode("_", $course_online_data->course_id);
                        $imageShow = Yii::app()->request->baseUrl . '/uploads/courseonline/' . $folder[0] . '/small/' . $course_online_data->course_picture;
                        ?>


                        <div class="item">
                            <div class="panel panel-default paper-shadow box-course" data-z="0.5" data-hover-z="1"
                                 data-animated>
                                <div class="panel-body">
                                    <div class="media media-clearfix-xs">
                                        <div class="media-left">
                                            <div class="cover width-90 width-100pc-xs overlay cover-image-full hover">
                                                <span class="img icon-block s90 bg-default"></span>
                                        <span class="overlay overlay-full padding-none icon-block s90 bg-default">
                            <?php if ($course_online_data->course_picture != "") { ?>
                                <span class="v-center">
<!--                                            <img src="--><? //=$imageShow;?><!--" class="img-responsive" style="height: 90px; width: 90px;">-->
                                            <img src="http://placehold.it/90x90" class="img-responsive"
                                                 style="height: 90px; width: 90px;">
                                        </span>
                            <?php } else { ?>
                                <span class="v-center">
                                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo_course2.png"
                                                 class="img-responsive">
                                        </span>
                            <?php }?>
                                        </span>
                                                <a href="<?php echo $this->createUrl('course/detail'); ?>"
                                                   class="overlay overlay-full overlay-hover overlay-bg-white">
                                            <span class="v-center">
                            <span class="btn btn-circle btn-white btn-lg"><i class="fa fa-graduation-cap"></i></span>
                                            </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading margin-v-5-3"><a
                                                    href="<?php echo $this->createUrl('course/detail'); ?>"><?= iconv_substr($course_online_data->course_title, 0, 100, 'utf-8'); ?></a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php }
                } ?>


            </div>
        </div>
    </div>
</div>
</div>