<div class="collapse navbar-collapse" id="main-nav">
    <ul class="nav navbar-nav navbar-nav-margin-left">
        <li class="dropdown<?php echo Controller::activeMenu('site'); ?>">
            <a href="<?php echo $this->createUrl('/site/index'); ?>" style="font-size: 20px; color: #00529D;"><span
                    class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
        </li>
        <li class="dropdown<?php echo Controller::activeMenu('list_news'); ?>">
        
            <!-- <a href="<?php echo $this->createUrl('/list_news'); ?>">ข่าวสาร</a>  -->
            <a href="#modal-ckeck-key-new" data-toggle="modal">ข่าวสาร</a>


        </li>
        <!-- <li class="dropdown<?php echo Controller::activeMenu('course'); ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">หลักสูตร <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->createUrl('/course/index'); ?>">หลักสูตรทั้งหมด</a></li>
                            <li><a href="#">หลักสูตร A</a></li>
                        </ul>
                    </li> -->
        <?php
        if (!Yii::app()->user->isGuest) {
            ?>
            <li class="dropdown<?php echo Controller::activeMenu('course'); ?>">
                <a href="<?php echo $this->createUrl('/course/index'); ?>">หลักสูตร</a>
            </li>
            <li class="dropdown<?php echo Controller::activeMenu('forum'); ?>">
                <a href="<?php echo $this->createUrl('/forum'); ?>">เว็บบอร์ด</a>
            </li>
            <?php
        }
        ?>

        <li class="dropdown<?php echo Controller::activeMenu('usability'); ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">วิธีการใช้งาน <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <?php
                $usability = Usability::model()->findAll(array(
                    'condition' => 'active="y"',
                    'order' => 'create_date DESC',
                ));
                if ($usability) {
                    foreach ($usability as $usability_data) {
                        ?>
                        <li>
                            <a href="<?= Yii::app()->createUrl('/usability/index/', array('id' => $usability_data->usa_id)); ?>"><?= $usability_data->usa_title; ?></a>
                        </li>
                    <?php }
                } ?>
            </ul>
        </li>
        <li class="dropdown<?php echo Controller::activeMenu('faq'); ?>">
            <a href="<?php echo $this->createUrl('/faq'); ?>">คำถามที่พบบ่อย</a>
        </li>
        <?php
        if (!Yii::app()->user->isGuest) {
            ?>
            <li class="dropdown<?php echo Controller::activeMenu('virtualclassroom'); ?>">

                <a href="<?php echo $this->createUrl('/virtualclassroom'); ?>">ห้องเรียน</a>

            </li>
            <li class="dropdown<?php echo Controller::activeMenu('dashboard'); ?>">

                <a href="<?php echo $this->createUrl('/dashboard'); ?>">แดชบอร์ด</a>

            </li>
            <?php
        }
        ?>


        <!--                    <li class="dropdown--><?php //echo Controller::activeMenu('assessment'); ?><!--">-->
        <!--                        <a href="-->
        <?php //echo $this->createUrl('/assessment/index'); ?><!--">แบบประเมิน</a>-->
        <!--                    </li>-->
        <!--                    <li class="dropdown--><?php //echo Controller::activeMenu('quiz'); ?><!--">-->
        <!--                        <a href="--><?php //echo $this->createUrl('/quiz/index'); ?><!--">ข้อสอบ</a>-->
        <!--                    </li>-->
        <!--                    <li class="dropdown--><?php //echo Controller::activeMenu('registration'); ?><!--">-->
        <!--                        <a href="-->
        <?php //echo $this->createUrl('/registration/index'); ?><!--">สมัครสมาชิก</a>-->
        <!--                    </li>-->
    </ul>
    <div class="navbar-right"
         style="border-left: 1px solid rgb(216, 216, 216); padding-left: 15px; padding-right: 15px; border-right: 1px solid rgb(216, 216, 216);">
        <?php
        $nameAdmin = Yii::app()->getModule('user')->user();
        if (!empty($nameAdmin)) {
            $registor = new RegistrationForm;
            $registor->id = $nameAdmin->id;

            ?>
            <ul class="nav navbar-nav navbar-nav-bordered">
                <!-- user -->
                <li class="dropdown user" style="border-right-color: #fff;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php echo Controller::ImageShowUser(Yush::SIZE_THUMB, $nameAdmin, $nameAdmin->pic_user, $registor, array('class' => 'img-circle', 'style' => 'height:30px;')); ?>
                        <?php echo $nameAdmin->profile->firstname ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo $this->createUrl('/dashboard/index'); ?>"><i
                                    class="fa fa-bar-chart-o"></i> Dashboard</a></li>
                        <li><a href="<?php echo $this->createUrl('/course/index'); ?>"><i
                                    class="fa fa-mortar-board"></i> หลักสูตรของฉัน</a></li>
                        <li><a href="<?php echo $this->createUrl('/user/profile'); ?>"><i class="fa fa-user"></i>
                                โปรไฟล์</a></li>
                        <li><a href="<?php echo $this->createUrl('/user/logout'); ?>"><i class="fa fa-sign-out"></i>
                                ออกจากระบบ</a></li>
                    </ul>
                </li>
            </ul>
        <?php } else {
            ?>
            <!-- // END user -->
            <?php
            if (Helpers::lib()->chkRegister_status() == true) {
                ?>
                <a href="<?php echo $this->createUrl('/user/registration'); ?>" class="navbar-btn btn btn-primary"><i
                        class="fa fa-fw fa-edit"></i> ลงทะเบียนเรียน</a>
                <?php
            }
            ?>
            <a href="<?php echo $this->createUrl('/user/login'); ?>" class="navbar-btn btn btn-primary"><i
                    class="fa fa-fw fa-user"></i> เข้าสู่ระบบ</a>
        <?php } ?>
    </div>
</div>

<div class="modal fade" id="modal-ckeck-key-new">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title modalhead"><i class="fa fa-sign-in" aria-hidden="true"></i> ยืนยันรหัสผ่าน</h4>
            </div>
            <form  action="<?php echo Yii::app()->createUrl('site/chkkey'); ?>" method="post" enctype="multipart/form-data"  >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text-center">
                            <h3 class="font-weight-bold">กรุณากรอกรหัส key เพื่่อยืนยันตัวตน</h3>
                            <input  type="hidden" name="id" class='form-control' value="new">
                            <input  type="password" name="check_key" class='form-control' autocomplete="off">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">ตกลง</button>
                    <button class="btn btn-warning" href="#" class="close" data-dismiss="modal" aria-hidden="true">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>

