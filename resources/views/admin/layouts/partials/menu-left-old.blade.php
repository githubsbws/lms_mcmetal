<style>
	.slimScrollDiv {
		/* height: 2000px !important; */
		/* overflow: scroll !important; */
	}

	.slim-scroll {
		/* height: 2000px !important; */
		overflow-y: scroll !important;
	}
</style>

<?php
use App\Models\Users;
use App\Models\Permission;
?>
<!-- Sidebar Menu -->
<div id="menu" class="hidden-print ui-resizable">

	<!-- Scrollable menu wrapper with Maximum height -->
	<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 810px;">
		<div class="slim-scroll" data-scroll-height="800px" style="overflow: hidden; width: auto; height: 810px;">
			<!-- Regular Size Menu -->
            <?php
            $user_id = Auth::id(); //Auth::id()
            $getUser = Users::where('id',$user_id)->first();
            $accessControl = Permission::where('group_id',$getUser->group_id)->where('active',1)->get();
			$menu_array = [];
            ?>
			<ul id="yw4">
				<li class="glyphicons home active"><a href="{{ url('/admin') }}"><i></i><span>หน้าหลัก</span></a></li>
                @foreach ($accessControl as $check)
						<?php
						$menu_array[] = $check->group_parent_id;
						?>
				@endforeach
                @if (in_array(1, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons posterous_spaces "><a data-toggle="collapse" href="#About"><i></i><span>เกี่ยวกับเรา</span></a>
                        <ul class=" collapse " id="About">
                            <li><a href="{{ url('/aboutus_create') }}">เพิ่มข้อมูลเกี่ยวกับเรา</a></li>
                            <li><a href="{{ url('/aboutus') }}">จัดการเกี่ยวกับเรา</a></li>
                        </ul>
                    </li>
                @endif
                @if (in_array(2, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons cogwheel "><a data-toggle="collapse" href="#Conditions"><i></i><span>เงื่อนไขการใช้งาน</span></a>
                        <ul class=" in collapse " id="Conditions">
                            <li class="active"><a href="{{ url('/condition') }}">แก้ไขเงื่อนไขการใช้งาน</a></li>
                        </ul>
                    </li>
                @endif
                @if (in_array(3, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons cogwheel"><a data-toggle="collapse" href="#Setting"><i></i><span>ตั้งค่าระบบพื้นฐาน</span></a>
                        <ul class=" collapse " id="Setting">
                            <li><a href="{{ url('/setting') }}">ตั้งค่าระบบพื้นฐาน</a></li>
                        </ul>
                    </li>
                @endif
                @if (in_array(4, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons adress_book"><a data-toggle="collapse" href="#ContactusNew"><i></i><span>ติดต่อเรา</span></a>
                        <ul class=" collapse " id="ContactusNew">
                            <li><a href="{{ url('/contactus') }}">จัดการติดต่อเรา</a></li>
                        </ul>
                    </li>
                @endif
                @if (in_array(5, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons facetime_video"><a data-toggle="collapse" href="#vdo"><span class="label label-primary"></span> <i></i><span>ระบบวีดีโอ</span></a>
                        <ul class=" collapse " id="vdo">
                            <li><a href="{{ url('/video_create') }}">เพิ่มวีดีโอ (ภาษา EN )</a></li>
                            <li><a href="{{ url('/video') }}">จัดการวีดีโอ</a></li>
                        </ul>
                    </li>
                @endif
                @if (in_array(6, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons folder_open"><a data-toggle="collapse" href="#Document"><i></i><span>ระบบเอกสาร</span></a>
                        <ul class=" collapse " id="Document">
                            <li><a href="{{url('document_type_create')}}">เพิ่มประเภทเอกสาร (ภาษา EN )</a></li>
                            <li><a href="{{url('document_type')}}">จัดการประเภทเอกสาร</a></li>
                            <li><a href="{{url('document_create')}}">เพิ่มเอกสาร (ภาษา EN )</a></li>
                            <li><a href="{{ url('/document') }}">จัดการเอกสาร</a></li>
                        </ul>
                    </li>
                @endif
                @if (in_array(7, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons folder_new"><a data-toggle="collapse" href="#News"><i></i><span>ระบบจัดการเนื้อหาเว็บไซต์ (ข่าวสาร)</span></a>
                        <ul class=" collapse " id="News">
                            <li><a href="{{ url('/news_create') }}">เพิ่มข่าวสารและกิจกรรม (ภาษา EN )</a></li>
                            <li><a href="{{ url('/news') }}">จัดการข่าวสารและกิจกรรม</a></li>
                        </ul>
                    </li>
                @endif
                @if (in_array(8, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons folder_open"><a data-toggle="collapse" href="#Category"><span class="label label-primary">1</span> <i></i><span>ระบบหมวดหลักสูตร</span></a>
                        <ul class=" collapse " id="Category">
                            <li><a href="{{url('category_create')}}">เพิ่มหมวดหลักสูตร (ภาษา EN )</a></li>
                            <li><a href="{{ url('/category') }}">จัดการหมวดหลักสูตร</a></li>
                        </ul>
                    </li>
                @endif
                @if (in_array(9, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons imac"><a data-toggle="collapse" href="#CourseOnline"><span class="label label-primary">2</span> <i></i><span>ระบบจัดการหลักสูตร</span></a>
                        <ul class=" collapse " id="CourseOnline">
                            <li><a href="{{url('courseonline_create')}}">เพิ่ม (ภาษา EN )</a></li>
                            <li><a href="{{ url('/courseonline') }}">จัดการ</a></li>
                        </ul>
                    </li>
                @endif
                @if (in_array(10, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons imac"><a data-toggle="collapse" href="#Lesson"><span class="label label-primary">3</span> <i></i><span>ระบบจัดการเนื้อหาบทเรียน</span></a>
                        <ul class=" collapse " id="Lesson">
                            <li><a href="{{url('lesson_create')}}">เพิ่มบทเรียน (ภาษา EN )</a></li>
                            <li><a href="{{ url('/lesson') }}">จัดการบทเรียน</a></li>
                        </ul>
                    </li>
                @endif
                @if (in_array(11, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons posterous_spaces"><a data-toggle="collapse" href="#Grouptesting"><span class="label label-primary">4</span> <i></i><span>ระบบข้อสอบ</span></a>
                        <ul class=" collapse " id="Grouptesting">
                            <li><a href="{{url('grouptesting_create')}}">เพิ่มชุดข้อสอบ</a></li>
                            <li><a href="{{ url('/grouptesting') }}">จัดการชุดข้อสอบ</a></li>
                            {{-- <li><a href="grouptesting-create.blade.php">เพิ่มชุดข้อสอบหลักสูตร</a></li>
                            <li><a href="{{ url('/coursegrouptesting') }}">จัดการชุดข้อสอบหลักสูตร</a></li> --}}
                        </ul>
                    </li>
                @endif
                @if (in_array(12, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons notes"><a data-toggle="collapse" href="#Questionnaireout"> <span class="label label-primary">5</span> <i></i><span>แบบประเมินผลการฝึกอบรม</span></a>
                        <ul class=" collapse " id="Questionnaireout">
                            <li><a href="{{ url('/questionnaireout_excel') }}">เพิ่มแบบสอบถาม</a></li>
                            <li><a href="{{ url('/questionnaireout') }}">จัดการแบบสอบถาม</a></li>
                        </ul>
                    </li>
                @endif
                @if (in_array(13, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons eye_open"><a data-toggle="collapse" href="#OrgChart"><span class="label label-primary">6</span><i></i><span>ระบบจัดการระดับชั้นการเรียน </span></a>
                        <ul class=" collapse " id="OrgChart">
                            {{-- <li><a href="{{ url('/orgchart_create') }}">เพิ่มระดับชั้นการเรียน</a></li> --}}
                            <li><a href="{{ url('/orgchart') }}">จัดการระดับชั้นการเรียน</a></li>
                        </ul>
                    </li>
                @endif
                @if (in_array(14, $menu_array) || $getUser->superuser == 1)
				    <li class="hasSubmenu glyphicons refresh"><a data-toggle="collapse" href="#Refresh"><i></i><span>จัดการระบบห้องเรียนออนไลน์</span></a>
                        <ul class=" collapse " id="Refresh">
                            <li><a href="{{ url('/classroom') }}">จัดการระบบห้องเรียนออนไลน์</a></li>
                            <li><a href="{{ url('/classroom_create') }}">เพิ่มห้องเรียนออนไลน์</a></li>
                        </ul>
                    </li>
                @endif
                {{-- @if (in_array(15, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons print"><a data-toggle="collapse" href="#CheckLecture"><i></i><span>ระบบตรวจข้อสอบบรรยาย</span></a>
                        <ul class=" collapse " id="CheckLecture">
                            <li><a href="{{ url('/checklecture') }}">ตรวจข้อสอบบรรยายบทเรียน</a></li>
                            <li><a href="{{ url('/coursecheck') }}">ตรวจข้อสอบบรรยายหลักสูตร</a></li>
                        </ul>
                    </li>
                @endif --}}
                {{-- @if (in_array(16, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons print"><a data-toggle="collapse" href="#Certificate"><i></i><span>ระบบใบประกาศนียบัตร</span></a>
                        <ul class=" collapse " id="Certificate">
                            <li><a href="{{ url('/certificate') }}">จัดการประกาศนียบัตร</a></li>
                            <li><a href="{{ url('/signnature') }}">จัดการลายเซนต์</a></li>
                        </ul>
                    </li>
                @endif --}}
                @if (in_array(17, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons print"><a data-toggle="collapse" href="#Captcha"><i></i><span>ระบบ Captcha</span></a>
                        <ul class=" collapse " id="Captcha">
                            <li><a href="{{ url('/captcha') }}">ตั้งค่าแคปช่า</a></li>
                        </ul>
                    </li>
                @endif
                @if (in_array(18, $menu_array) || $getUser->superuser == 1)
				    <li class="hasSubmenu glyphicons refresh"><a href="{{ url('learnreset')}}"><i></i><span>ระบบรีเซ็ตผลการเรียนการสอบ</span></a></li>
                @endif
                @if (in_array(19, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons wallet"><a data-toggle="collapse" href="#Usability"><i></i><span>ระบบวิธีการใช้งาน</span></a>
                        <ul class=" collapse " id="Usability">
                            <li><a href="{{ url('usability_create')}}">เพิ่มวิธีการใช้งาน (ภาษา EN )</a></li>
                            <li><a href="{{ url('/usability') }}">จัดการวิธีการใช้งาน</a></li>
                        </ul>
                    </li>
                @endif
                @if (in_array(20, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons adress_book"><a data-toggle="collapse" href="#ReportProblem"><i></i><span>ระบบปัญหาการใช้งาน</span></a>
                        <ul class=" collapse " id="ReportProblem">
                            <li><a href="{{ url('/reportproblem') }}">จัดการปัญหาการใช้งาน</a></li>
                        </ul>
                    </li>
                @endif
                @if (in_array(21, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons no-js circle_question_mark"><a data-toggle="collapse" href="#Faq"><i></i><span>ระบบคำถามที่พบบ่อย</span></a>
                        <ul class=" collapse " id="Faq">
                            <li><a href="{{ url('/faqtype') }}">หมวดคำถาม (ภาษา EN )</a></li>
                            <li><a href="{{ url('/faq') }}">คำถามที่พบบ่อย</a></li>
                        </ul>
                    </li>
                @endif
                {{-- @if (in_array(22, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons no-js circle_question_mark"><a data-toggle="collapse" href="#question"><i></i><span>ระบบแบบสอบถาม</span></a>
                        <ul class=" collapse " id="question">
                            <li><a href="{{ url('/question') }}">จัดการแบบสอบถาม</a></li>
                            <li><a href="{{ url('/question_create') }}">เพิ่มคำถาม</a></li>
                        </ul>
                    </li>
                @endif --}}
				@if (in_array(23, $menu_array) || $getUser->superuser == 1)
					<li class="hasSubmenu glyphicons magic"><a data-toggle="collapse" href="#Rights"><i></i><span>ระบบการกำหนดสิทธิการใช้งาน</span></a>
						<ul class=" collapse " id="Rights">
								<li><a href="{{ url('/adminuser') }}">ข้อมูลผู้ดูแลระบบ</a></li>
								<li><a href="{{ url('/pgroup') }}">กลุ่มผู้ใช้งาน</a></li>
						</ul>
					</li>
				@endif
				{{-- <li class="hasSubmenu glyphicons magic"><a data-toggle="collapse" href="#Rights"><i></i><span>ระบบการกำหนดสิทธิการใช้งาน</span></a>
					<ul class=" collapse " id="Rights">
						<li><a href="{{ url('/adminuser') }}">ข้อมูลผู้ดูแลระบบ</a></li>
						<li><a href="{{ url('/pgroup') }}">กลุ่มผู้ใช้งาน</a></li>
					</ul>
				</li> --}}
				@if (in_array(24, $menu_array) || $getUser->superuser == 1)
					<li class="hasSubmenu glyphicons user_add"><a data-toggle="collapse" href="#admin"><i></i><span>ระบบจัดการสมาชิก (สมาชิก)</span></a>
						<ul class=" collapse " id="admin">
							<li><a href="{{url('/useradmin_create')}}">เพิ่มสมาชิก</a></li>
							<li><a href="{{ url('/userexcel') }}">เพิ่มสมาชิกจาก Excel</a></li>
                            <li><a href="{{url('/asc')}}">เพิ่มASC</a></li>
							<li><a href="{{ url('/user_admin') }}">รายชื่อสมาชิก</a></li>
						</ul>
					</li>
				@endif
                {{-- @if (in_array(25, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons book"><a data-toggle="collapse" href="#CourseField"><i></i><span>จัดการฟอร์ม สมัครสมาชิก</span></a>
                        <ul class=" collapse " id="CourseField">
                            <li><a href="coursefield-create.php">เพิ่ม Field</a></li>
                            <li><a href="{{ url('/coursefield') }}">จัดการ Field</a></li>
                            <li><a href="coursefield-manageform.php">จัดการ รูปแบบฟอร์ม</a></li>
                        </ul>
                    </li>
                @endif --}}
                @if (in_array(26, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons bullhorn"><a data-toggle="collapse" href="#imgslide"><span class="label label-primary"></span> <i></i><span>ระบบป้ายประชาสัมพันธ์</span></a>
                        <ul class=" collapse " id="imgslide">
                            <li><a href="{{ url('/imgslide_create') }}">เพิ่มป้ายประชาสัมพันธ์ (ภาษา EN )</a></li>
                            <li><a href="{{ url('/imgslide') }}">จัดการป้ายประชาสัมพันธ์</a></li>
                        </ul>
                    </li>
                @endif
                {{-- @if (in_array(27, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons posterous_spaces"><a data-toggle="collapse" href="#LibraryType"><span class="label label-primary"></span> <i></i><span>ระบบห้องสมุดอิเล็กทรอนิกส์</span></a>
                        <ul class=" collapse " id="LibraryType">
                            <li><a href="{{ url('/librarytype') }}">จัดการประเภทห้องสมุด</a></li>
                            <li><a href="{{ url('/libraryfile') }}">จัดการห้องสมุด</a></li>
                        </ul>
                    </li>
                @endif --}}
                {{-- @if (in_array(28, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons cogwheel"><a data-toggle="collapse" href="#courseNotification"><i></i><span>ระบบตั้งค่าการแจ้งเตือนบทเรียน</span></a>
                        <ul class=" collapse " id="courseNotification">
                            <li><a href="coursenotification-create.php">สร้างระบบแจ้งเตือนบทเรียน</a></li>
                            <li><a href="{{ url('/coursenotification') }}">จัดการระบบแจ้งเตือนบทเรียน</a></li>
                        </ul>
                    </li>
                @endif --}}
                {{-- @if (in_array(29, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons user_add"><a data-toggle="collapse" href="#generation"><i></i><span>ระบบจัดการรุ่นผู้เรียน</span></a>
                        <ul class=" collapse " id="generation">

                            <li><a href="{{ url('/generation') }}">จัดการรุ่นผู้เรียน</a></li>
                        </ul>
                    </li>
                @endif --}}
                {{-- @if (in_array(30, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons print"><a data-toggle="collapse" href="#Passcours"><i></i><span>ระบบพิมพ์ใบประกาศนียบัตร</span></a>
                        <ul class=" collapse " id="Passcours">
                            <li><a href="passcourse-request-cert.php">รายงานผู้ขอรับใบประกาศนียบัตร</a></li>
                            <li><a href="{{ url('/passcourse') }}">รายงานผู้ผ่านการเรียน</a></li>
                            <li><a href="passcourse-passcourselog.php">รายงานสถิติจำนวนผู้พิมพ์ใบประกาศฯ</a></li>
                        </ul>
                    </li>
                @endif --}}
                @if (in_array(31, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons print"><a data-toggle="collapse" href="#Report"><i></i><span>ระบบ Report</span></a>
                        <ul class=" collapse " id="Report">
                            {{-- <li><a href="{{url('report_logallregister')}}">1.) รายงานภาพรวมการสมัครสมาชิก</a></li>
                            <li><a href="{{url('report_loguserstatus')}}">2.) รายงานผลการสมัครสมาชิก (ผู้เรียน)</a></li> --}}
                            <li><a href="{{url('report_course')}}">1.) รายงานภาพรวมของหลักสูตร</a></li>
                            {{-- <li><a href="report-bycoursedetail.php">4.) รายงานการฝึกอบรมหลักสูตร</a></li> --}}
                            {{-- <li><a href="{{url('report_byuser')}}">2.) รายงานติดตามผู้เรียน</a></li> --}}
                            {{-- <li><a href="report-logquestioncourse.php">6.) รายงานแบบสอบถามสำหรับหลักสูตร</a></li> --}}
                            {{-- <li><a href="report-logquestionall.php">7.) รายงานภาพรวมแบบสอบถาม</a></li> --}}
                            {{-- <li><a href="{{url('report_reset')}}">8.) รายงานการรีเซตหลักสูตร</a></li> --}}
                        </ul>
                    </li>
                @endif
                {{-- @if (in_array(32, $menu_array) || $getUser->superuser == 1)
				    <li class="hasSubmenu glyphicons folder_new"><a href="logemail-email.php"><i></i><span>ระบบการส่งผลการเรียนผ่านทางระบบอัตโนมัติ</span></a></li>
                @endif --}}
                @if (in_array(33, $menu_array) || $getUser->superuser == 1)
                    <li class="hasSubmenu glyphicons print"><a data-toggle="collapse" href="#LogAdmin"><i></i><span>ระบบเก็บ Log การใช้งานระบบ</span></a>
                        <ul class=" collapse " id="LogAdmin">
                            <li><a href="{{url('/logusers')}}">Log การใช้งานผู้เรียน</a></li>
                            <li><a href="{{ url('/logadmin') }}">Log การใช้งานผู้ดูแลระบบ</a></li>
                            <li><a href="{{url('/logapprove')}}">Log การยืนยันสมัครสมาชิก</a></li>
                            <li><a href="{{url('logapporvepersonal')}}">Log การยืนยันสมัครสมาชิกบุคคลทั่วไป</a></li>
                            <li><a href="{{url('/logregister')}}">Log การตรวจสอบการสมัครสมาชิก</a></li>
                        </ul>
                    </li>
                @endif
			</ul>
			<div class="clearfix"></div>

		</div>
		<div class="slimScrollBar ui-draggable" style="background: rgb(0, 0, 0); width: 15px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 15px; z-index: 99; right: 1px; height: 486.36px;"></div>
		<div class="slimScrollRail" style="width: 15px; height: 100%; position: absolute; top: 0px; display: block; border-radius: 15px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
	</div>
	<!-- // Scrollable Menu wrapper with Maximum Height END -->

	<div class="ui-resizable-handle ui-resizable-e" style="z-index: 1000;"></div>
	<div class="ui-resizable-handle ui-resizable-w" style="z-index: 1000;"></div>
</div>
<!-- // Sidebar Menu END -->
