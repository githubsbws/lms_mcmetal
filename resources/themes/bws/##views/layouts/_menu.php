            <div class="collapse navbar-collapse" id="main-nav">
                <ul class="nav navbar-nav navbar-nav-margin-left">
                    <li class="dropdown<?php echo Controller::activeMenu('site'); ?>">
                        <a href="<?php echo $this->createUrl('/site/index'); ?>">หน้าแรก</a>
                    </li>
                    <li class="dropdown<?php echo Controller::activeMenu('list_news'); ?>">
                        <a href="<?php echo $this->createUrl('/list_news'); ?>">ข่าวสาร</a>
                    </li>
                    <li class="dropdown<?php echo Controller::activeMenu('course'); ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">หลักสูตร <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->createUrl('/course/index'); ?>">หลักสูตรทั้งหมด</a></li>
                            <li><a href="#">หลักสูตร A</a></li>
                        </ul>
                    </li>
                    <li class="dropdown<?php echo Controller::activeMenu('forum'); ?>">
                        <a href="<?php echo $this->createUrl('/forum'); ?>">เว็บบอร์ด</a>
                    </li>
                    <li class="dropdown<?php echo Controller::activeMenu('usability'); ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">วิธีการใช้งาน <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php
                            $usability = Usability::model()->findAll(array(
                                'condition' => 'active="y"',
                                'order' => 'create_date DESC',
                            ));
                            if($usability){
                            foreach($usability as $usability_data){
                            ?>
                            <li><a href="<?= Yii::app()->createUrl('usability/index/', array('id' => $usability_data->usa_id));?>"><?=$usability_data->usa_title;?></a></li>
                            <?php }}?>
                        </ul>
                    </li>
                    <li class="dropdown<?php echo Controller::activeMenu('faq'); ?>">
                        <a href="<?php echo $this->createUrl('/faq'); ?>">คำถามที่พบบ่อย</a>
                    </li>
<!--                    <li class="dropdown--><?php //echo Controller::activeMenu('assessment'); ?><!--">-->
<!--                        <a href="--><?php //echo $this->createUrl('/assessment/index'); ?><!--">แบบประเมิน</a>-->
<!--                    </li>-->
<!--                    <li class="dropdown--><?php //echo Controller::activeMenu('quiz'); ?><!--">-->
<!--                        <a href="--><?php //echo $this->createUrl('/quiz/index'); ?><!--">ข้อสอบ</a>-->
<!--                    </li>-->
<!--                    <li class="dropdown--><?php //echo Controller::activeMenu('registration'); ?><!--">-->
<!--                        <a href="--><?php //echo $this->createUrl('/registration/index'); ?><!--">สมัครสมาชิก</a>-->
<!--                    </li>-->
                </ul>
                <div class="navbar-right" style="border-left: 1px solid rgb(216, 216, 216);padding-left: 15px;border-right: 1px solid rgb(216, 216, 216);">
                    <ul class="nav navbar-nav navbar-nav-bordered navbar-nav-margin-right">
                        <!-- user -->
                        <li class="dropdown user">
                            <?php
                            $nameAdmin = Yii::app()->getModule('user')->user();
                            if(!empty($nameAdmin)){
                            ?>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/people/110/guy-3.jpg" alt="" class="img-circle" /> <?php echo $nameAdmin->NameUser?><span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#"><i class="fa fa-bar-chart-o"></i> Dashboard</a></li>
                                <li><a href="#"><i class="fa fa-mortar-board"></i> หลักสูตรของฉัน</a></li>
                                <li><a href="#"><i class="fa fa-user"></i> โปรไฟล์</a></li>
                                <li><a href="<?php echo $this->createUrl('/user/logout'); ?>"><i class="fa fa-sign-out"></i> ออกจากระบบ</a></li>
                            </ul>
                        </li>
                        <?php }else{?>
                        <!-- // END user -->
                    </ul>
                        <a href="<?php echo $this->createUrl('/registration/index'); ?>" class="navbar-btn btn btn-primary"><i class="fa fa-fw fa-edit"></i> ลงทะเบียนเรียน</a>
                        <a href="<?php echo $this->createUrl('/user/login'); ?>" class="navbar-btn btn btn-primary"><i class="fa fa-fw fa-user"></i> เข้าสู่ระบบ</a>
                    <?php }?>
                </div>
            </div>