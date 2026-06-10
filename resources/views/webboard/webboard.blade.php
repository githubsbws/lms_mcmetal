@extends('layout/mainlayout')
@section('content')
<body>
    <div class="parallax overflow-hidden page-section bg-blue-300" style="margin-top: 81px;">
        <div class="container parallax-layer" data-opacity="true" style="transform: translate3d(0px, 0px, 0px); opacity: 1;">
            <div class="media media-grid v-middle">
                <div class="media-left">
                    <span class="icon-block half bg-blue-500 text-white" style="height: 45px;"><i class="fa fa-fw fa-comments-o"></i></span>
                </div>
                <div class="media-body">
                    <h3 class="text-display-2 text-white margin-none">เว็บบอร์ด</h3>
                    <p class="text-white text-subhead" style="font-size: 1.6rem;">เว็บบอร์ดของหลักสูตร</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="page-section">
            <div class="row">
                <div class="col-md-12" style="padding-bottom: 15px;">

                    <div class="bbii-profile-box">
                        <a href="/lms_brother_docker/lms/app/index.php/forum/message/inbox"><img title="no new messages" style="vertical-align:bottom;" src="/lms_brother_docker/lms/app/assets/6a25eee3/images/mail.png" alt="no new messages"></a> | <a href="/lms_brother_docker/lms/app/index.php/forum/member/view/id/1"><img title="My settings" style="vertical-align:bottom;" src="/lms_brother_docker/lms/app/assets/6a25eee3/images/settings.png" alt="My settings"></a> | <a href="/lms_brother_docker/lms/app/index.php/forum/moderator/approval"><img title="Moderate" style="vertical-align:bottom;" src="/lms_brother_docker/lms/app/assets/6a25eee3/images/moderator.png" alt="Moderate"></a> | <a href="/lms_brother_docker/lms/app/index.php/forum/setting/index"><img title="Forum settings" style="vertical-align:bottom;" src="/lms_brother_docker/lms/app/assets/6a25eee3/images/config.png" alt="Forum settings"></a>
                    </div>
                    <ul class="nav nav-pills" id="yw0">
                        <li><a class="btn btn-primary" href="/lms_brother_docker/lms/app/index.php/forum/forum/index">เว็บบอร์ด</a></li>
                        <li><a class="btn btn-primary" href="/lms_brother_docker/lms/app/index.php/forum/member/index">สมาชิก</a></li>
                        <li><a class="btn btn-primary" href="/lms_brother_docker/lms/app/index.php/forum/moderator/approval">การอนุมัติ (0)</a></li>
                        <li><a class="btn btn-primary" href="/lms_brother_docker/lms/app/index.php/forum/moderator/report">รายงาน (0)</a></li>
                    </ul>


                    <div class="breadcrumbs">
                        <span>Forum</span>
                    </div><!-- breadcrumbs -->

                </div>
                <div class="col-md-8 col-lg-9">
                    <div id="bbiiForum" class="list-view">
                        <div class="summary"></div>

                        <div class="items">
                            @foreach($web as $wb)
                            <div class="panel panel-default paper-shadow" data-z="0.5">
                                <div class="forum-category" onclick="BBii.toggleForumGroup(1,'http://localhost/lms_brother_docker/lms/app/index.php/forum/forum/setCollapsed');">
                                    <ul class="list-group" style="margin-bottom: 10px;">
                                        <li class="list-group-item" style="border:none;">
                                            <div class="media v-middle">
                                                <div class="media-body">
                                                    <h3 class="text-headline margin-none" style="font-size: 28px;">{{ $wb->name }}</h3>
                                                    <p class="text-subhead text-light" style="font-size: 1.7rem;">{{ $wb->subtitle }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="list-group">



                                    <li class="list-group-item media v-middle">
                                        <div class="media-left">
                                            <div class="icon-block half img-circle bg-grey-300">
                                                <i class="fa fa-file-text text-white"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="text-subhead margin-none" style="font-size: 22px;">
                                                <a href="/lms_brother_docker/lms/app/index.php/forum/forum/forum/id/2/class/link-text-color">Engine: New Mono Laser</a> <small>New Mono Laser</small>
                                            </h4>
                                            <div class="text-light text-caption" style="font-size: 1.4rem;">
                                                posted by
                                                <img src="/lms_brother_docker/lms/app/themes/bws/images/logo_course2.png" alt="person" class="img-circle width-20"> Kritchanon<a href="/lms_brother_docker/lms/app/index.php/forum/forum/topic/id/28/nav/last"><img style="margin-left:5px;" src="/lms_brother_docker/lms/app/assets/6a25eee3/images/next.png" alt="next"></a> &nbsp; | <i class="fa fa-calendar fa-fw"></i> 24 มีนาคม 2020, 12:34
                                            </div>

                                        </div>
                                        <div class="media-right">
                                            <a class="btn btn-white text-light" href="/lms_brother_docker/lms/app/index.php/forum/forum/forum/id/2/class/link-text-color">19</a><!--            <a href="#" class="btn btn-white text-light"><i class="fa fa-comments fa-fw"></i> --><!--</a href="#">-->
                                        </div>
                                        <div class="media-right">
                                            <a class="btn btn-white text-light" href="/lms_brother_docker/lms/app/index.php/forum/forum/forum/id/2/class/link-text-color">10</a><!--            <a href="#" class="btn btn-white text-light"><i class="fa fa-comments fa-fw"></i> --><!--</a>-->
                                        </div>
                                    </li>




                                    <li class="list-group-item media v-middle">
                                        <div class="media-left">
                                            <div class="icon-block half img-circle bg-grey-300">
                                                <i class="fa fa-file-text text-white"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="text-subhead margin-none" style="font-size: 22px;">
                                                <a href="/lms_brother_docker/lms/app/index.php/forum/forum/forum/id/5/class/link-text-color">Basic Course Ink-jet Technology</a> <small>Basic Course Ink-jet Technology</small>
                                            </h4>
                                            No posts
                                        </div>
                                        <div class="media-right">
                                            <a class="btn btn-white text-light" href="/lms_brother_docker/lms/app/index.php/forum/forum/forum/id/5/class/link-text-color">0</a><!--            <a href="#" class="btn btn-white text-light"><i class="fa fa-comments fa-fw"></i> --><!--</a href="#">-->
                                        </div>
                                        <div class="media-right">
                                            <a class="btn btn-white text-light" href="/lms_brother_docker/lms/app/index.php/forum/forum/forum/id/5/class/link-text-color">0</a><!--            <a href="#" class="btn btn-white text-light"><i class="fa fa-comments fa-fw"></i> --><!--</a>-->
                                        </div>
                                    </li>




                                    <li class="list-group-item media v-middle">
                                        <div class="media-left">
                                            <div class="icon-block half img-circle bg-grey-300">
                                                <i class="fa fa-file-text text-white"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="text-subhead margin-none" style="font-size: 22px;">
                                                <a href="/lms_brother_docker/lms/app/index.php/forum/forum/forum/id/6/class/link-text-color">Engine: New Color Laser and Color LED</a> <small>New Color Laser and Color LED</small>
                                            </h4>
                                            No posts
                                        </div>
                                        <div class="media-right">
                                            <a class="btn btn-white text-light" href="/lms_brother_docker/lms/app/index.php/forum/forum/forum/id/6/class/link-text-color">0</a><!--            <a href="#" class="btn btn-white text-light"><i class="fa fa-comments fa-fw"></i> --><!--</a href="#">-->
                                        </div>
                                        <div class="media-right">
                                            <a class="btn btn-white text-light" href="/lms_brother_docker/lms/app/index.php/forum/forum/forum/id/6/class/link-text-color">0</a><!--            <a href="#" class="btn btn-white text-light"><i class="fa fa-comments fa-fw"></i> --><!--</a>-->
                                        </div>
                                    </li>




                                    <li class="list-group-item media v-middle">
                                        <div class="media-left">
                                            <div class="icon-block half img-circle bg-grey-300">
                                                <i class="fa fa-file-text text-white"></i>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="text-subhead margin-none" style="font-size: 22px;">
                                                <a href="/lms_brother_docker/lms/app/index.php/forum/forum/forum/id/7/class/link-text-color">Engine: FAX</a> <small>FAX</small>
                                            </h4>
                                            No posts
                                        </div>
                                        <div class="media-right">
                                            <a class="btn btn-white text-light" href="/lms_brother_docker/lms/app/index.php/forum/forum/forum/id/7/class/link-text-color">2</a><!--            <a href="#" class="btn btn-white text-light"><i class="fa fa-comments fa-fw"></i> --><!--</a href="#">-->
                                        </div>
                                        <div class="media-right">
                                            <a class="btn btn-white text-light" href="/lms_brother_docker/lms/app/index.php/forum/forum/forum/id/7/class/link-text-color">1</a><!--            <a href="#" class="btn btn-white text-light"><i class="fa fa-comments fa-fw"></i> --><!--</a>-->
                                        </div>
                                    </li>



                                </ul>
                            </div>
                            @endforeach
                        </div>
                        <div class="keys" style="display:none" title="/lms_brother_docker/lms/app/index.php/forum"><span>1</span><span>2</span><span>5</span><span>6</span><span>7</span><span>3</span><span>4</span><span>8</span><span>9</span></div>
                    </div>


                    <br>
                </div>




                <div class="col-md-4 col-lg-3">
                    <div class="panel panel-default" data-toggle="panel-collapse" data-open="true">
                        <div class="panel-heading panel-collapse-trigger collapse in" data-toggle="collapse" data-target="#f91232c6-6b30-f338-d094-6b213b2e336a" aria-expanded="true" style="">
                            <h4 class="panel-title">ค้นหา</h4>
                        </div>

                        <div id="f91232c6-6b30-f338-d094-6b213b2e336a" class="collapse in">
                            <div class="panel-body">
                                <div class="portlet" id="yw1">
                                    <div class="portlet-content">
                                        <form id="simple-search-form" action="/lms_brother_docker/lms/app/index.php/forum/search/index" method="post"><input type="hidden" value="0" name="choice" id="choice"><input type="hidden" value="0" name="type" id="type">
                                            <div class="form-group input-group margin-none">
                                                <div class="row margin-none">
                                                    <div class="col-xs-12 padding-none">
                                                        <input size="20" maxlength="50" class="form-control" placeholder="คำค้นหา" type="text" value="" name="search" id="search">
                                                    </div>
                                                </div>
                                                <div class="input-group-btn">
                                                    <button class="btn btn-primary" type="submit" name="yt0"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">หมวดหมู่</h4>
                        </div>
                        <div class="panel-body">
                            <select class="form-control" onchange="window.location.href='/lms_brother_docker/lms/app/index.php/forum/forum/forum/id/'+$(this).val()" name="bbii-jumpto" id="bbii-jumpto">
                                <option value="">เว็บบอร์ด</option>
                                <optgroup label="Brother Forum">
                                    <option value="2">Engine: New Mono Laser</option>
                                    <option value="5">Basic Course Ink-jet Technology</option>
                                    <option value="6">Engine: New Color Laser and Color LED</option>
                                    <option value="7">Engine: FAX</option>
                                </optgroup>
                                <optgroup label="กฏกติกา">
                                    <option value="4">กติการของเว็บบอร์ด</option>
                                </optgroup>
                                <optgroup label="พูดคุยเรื่องอื่น ๆ">
                                    <option value="9">ข่าวสารและกิจกรรม</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
@endsection