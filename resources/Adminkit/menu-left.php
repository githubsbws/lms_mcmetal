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

<!-- Sidebar Menu -->
<div id="menu" class="hidden-print ui-resizable">

	<!-- Scrollable menu wrapper with Maximum height -->
	<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 810px;">
		<div class="slim-scroll" data-scroll-height="800px" style="overflow: hidden; width: auto; height: 810px;">
			<!-- Regular Size Menu -->

			<ul id="yw4">
				<li class="glyphicons home"><a href="/admin/index.php/site/index"><i></i><span>หน้าหลัก</span></a></li>
				<li class="hasSubmenu glyphicons posterous_spaces"><a data-toggle="collapse" href="#About"><i></i><span>เกี่ยวกับเรา</span></a>
					<ul class=" collapse " id="About">
						<li><a href="aboutus.php">จัดการเกี่ยวกับเรา</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons cogwheel active"><a data-toggle="collapse" href="#Conditions"><i></i><span>เงื่อนไขการใช้งาน</span></a>
					<ul class=" in collapse " id="Conditions">
						<li class="active"><a href="condition.php">แก้ไขเงื่อนไขการใช้งาน</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons cogwheel"><a data-toggle="collapse" href="#Setting"><i></i><span>ตั้งค่าระบบพื้นฐาน</span></a>
					<ul class=" collapse " id="Setting">
						<li><a href="setting.php">ตั้งค่าระบบพื้นฐาน</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons adress_book"><a data-toggle="collapse" href="#ContactusNew"><i></i><span>ติดต่อเรา</span></a>
					<ul class=" collapse " id="ContactusNew">
						<li><a href="contactus.php">จัดการติดต่อเรา</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons facetime_video"><a data-toggle="collapse" href="#vdo"><span class="label label-primary"></span> <i></i><span>ระบบวีดีโอ</span></a>
					<ul class=" collapse " id="vdo">
						<li><a href="video-create.php">เพิ่มวีดีโอ (ภาษา EN )</a></li>
						<li><a href="video.php">จัดการวีดีโอ</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons folder_open"><a data-toggle="collapse" href="#Document"><i></i><span>ระบบเอกสาร</span></a>
					<ul class=" collapse " id="Document">
						<li><a href="document-createtype.php">เพิ่มประเภทเอกสาร (ภาษา EN )</a></li>
						<li><a href="document-index-type.php">จัดการประเภทเอกสาร</a></li>
						<li><a href="document-create.php">เพิ่มเอกสาร (ภาษา EN )</a></li>
						<li><a href="document.php">จัดการเอกสาร</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons folder_new"><a data-toggle="collapse" href="#News"><i></i><span>ระบบจัดการเนื้อหาเว็บไซต์ (ข่าวสาร)</span></a>
					<ul class=" collapse " id="News">
						<li><a href="news-create.php">เพิ่มข่าวสารและกิจกรรม (ภาษา EN )</a></li>
						<li><a href="news.php">จัดการข่าวสารและกิจกรรม</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons folder_open"><a data-toggle="collapse" href="#Category"><span class="label label-primary">1</span> <i></i><span>ระบบหมวดหลักสูตร</span></a>
					<ul class=" collapse " id="Category">
						<li><a href="category-create.php">เพิ่มหมวดหลักสูตร (ภาษา EN )</a></li>
						<li><a href="category.php">จัดการหมวดหลักสูตร</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons imac"><a data-toggle="collapse" href="#CourseOnline"><span class="label label-primary">2</span> <i></i><span>ระบบจัดการหลักสูตร</span></a>
					<ul class=" collapse " id="CourseOnline">
						<li><a href="courseonline-create.php">เพิ่ม (ภาษา EN )</a></li>
						<li><a href="courseonline.php">จัดการ</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons imac"><a data-toggle="collapse" href="#Lesson"><span class="label label-primary">3</span> <i></i><span>ระบบจัดการเนื้อหาบทเรียน</span></a>
					<ul class=" collapse " id="Lesson">
						<li><a href="lession-create.php">เพิ่มบทเรียน (ภาษา EN )</a></li>
						<li><a href="lession.php">จัดการบทเรียน</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons posterous_spaces"><a data-toggle="collapse" href="#Grouptesting"><span class="label label-primary">4</span> <i></i><span>ระบบข้อสอบ</span></a>
					<ul class=" collapse " id="Grouptesting">
						<li><a href="grouptesting-create.php">เพิ่มชุดข้อสอบ</a></li>
						<li><a href="grouptesting.php">จัดการชุดข้อสอบ</a></li>
						<li><a href="coursegrouptesting-create.php">เพิ่มชุดข้อสอบหลักสูตร</a></li>
						<li><a href="coursegrouptesting.php">จัดการชุดข้อสอบหลักสูตร</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons notes"><a data-toggle="collapse" href="#Questionnaireout"> <span class="label label-primary">5</span> <i></i><span>แบบประเมินผลการฝึกอบรม</span></a>
					<ul class=" collapse " id="Questionnaireout">
						<li><a href="questionnaireout-create.php">เพิ่มแบบสอบถาม</a></li>
						<li><a href="questionnaireout.php">จัดการแบบสอบถาม</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons eye_open"><a data-toggle="collapse" href="#OrgChart"><span class="label label-primary">6</span><i></i><span>ระบบจัดการระดับชั้นการเรียน (Organization)</span></a>
					<ul class=" collapse " id="OrgChart">
						<li><a href="orgchart.php">จัดการกลุ่มหลักสูตร</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons print"><a data-toggle="collapse" href="#CheckLecture"><i></i><span>ระบบตรวจข้อสอบบรรยาย</span></a>
					<ul class=" collapse " id="CheckLecture">
						<li><a href="checklecture.php">ตรวจข้อสอบบรรยายบทเรียน</a></li>
						<li><a href="checklecture-coursecheck.php">ตรวจข้อสอบบรรยายหลักสูตร</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons print"><a data-toggle="collapse" href="#Certificate"><i></i><span>ระบบใบประกาศนียบัตร</span></a>
					<ul class=" collapse " id="Certificate">
						<li><a href="certificate.php">จัดการประกาศนียบัตร</a></li>
						<li><a href="signnature.php">จัดการลายเซนต์</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons print"><a data-toggle="collapse" href="#Captcha"><i></i><span>ระบบ Captcha</span></a>
					<ul class=" collapse " id="Captcha">
						<li><a href="captcha.php">ตั้งค่าแคปช่า</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons refresh"><a href="learnreset-resetuser.php"><i></i><span>ระบบรีเซ็ตผลการเรียนการสอบ</span></a></li>
				<li class="hasSubmenu glyphicons wallet"><a data-toggle="collapse" href="#Usability"><i></i><span>ระบบวิธีการใช้งาน</span></a>
					<ul class=" collapse " id="Usability">
						<li><a href="usability-create.php">เพิ่มวิธีการใช้งาน (ภาษา EN )</a></li>
						<li><a href="usability.php">จัดการวิธีการใช้งาน</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons adress_book"><a data-toggle="collapse" href="#ReportProblem"><i></i><span>ระบบปัญหาการใช้งาน</span></a>
					<ul class=" collapse " id="ReportProblem">
						<li><a href="reportproblem.php">จัดการปัญหาการใช้งาน</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons no-js circle_question_mark"><a data-toggle="collapse" href="#Faq"><i></i><span>ระบบคำถามที่พบบ่อย</span></a>
					<ul class=" collapse " id="Faq">
						<li><a href="faqtype.php">หมวดคำถาม (ภาษา EN )</a></li>
						<li><a href="faq.php">คำถามที่พบบ่อย</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons magic"><a data-toggle="collapse" href="#Rights"><i></i><span>ระบบการกำหนดสิทธิการใช้งาน</span></a>
					<ul class=" collapse " id="Rights">
						<li><a href="adminuser.php">ข้อมูลผู้ดูแลระบบ</a></li>
						<li><a href="pgroup.php">กลุ่มผู้ใช้งาน</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons user_add"><a data-toggle="collapse" href="#admin"><i></i><span>ระบบจัดการสมาชิก (สมาชิก)</span></a>
					<ul class=" collapse " id="admin">
						<li><a href="user-admin-create.php">เพิ่มสมาชิก</a></li>
						<li><a href="user-admin-excel.php">เพิ่มสมาชิกจาก Excel</a></li>
						<li><a href="user-admin.php">รายชื่อสมาชิก</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons book"><a data-toggle="collapse" href="#CourseField"><i></i><span>จัดการฟอร์ม สมัครสมาชิก</span></a>
					<ul class=" collapse " id="CourseField">
						<li><a href="coursefield-create.php">เพิ่ม Field</a></li>
						<li><a href="coursefield.php">จัดการ Field</a></li>
						<li><a href="coursefield-manageform.php">จัดการ รูปแบบฟอร์ม</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons bullhorn"><a data-toggle="collapse" href="#imgslide"><span class="label label-primary"></span> <i></i><span>ระบบป้ายประชาสัมพันธ์</span></a>
					<ul class=" collapse " id="imgslide">
						<li><a href="imgslide-create.php">เพิ่มป้ายประชาสัมพันธ์ (ภาษา EN )</a></li>
						<li><a href="imgslide.php">จัดการป้ายประชาสัมพันธ์</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons posterous_spaces"><a data-toggle="collapse" href="#LibraryType"><span class="label label-primary"></span> <i></i><span>ระบบห้องสมุดอิเล็กทรอนิกส์</span></a>
					<ul class=" collapse " id="LibraryType">
						<li><a href="librarytype.php">จัดการประเภทห้องสมุด</a></li>
						<li><a href="libraryfile.php">จัดการห้องสมุด</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons cogwheel"><a data-toggle="collapse" href="#courseNotification"><i></i><span>ระบบตั้งค่าการแจ้งเตือนบทเรียน</span></a>
					<ul class=" collapse " id="courseNotification">
						<li><a href="coursenotification-create.php">สร้างระบบแจ้งเตือนบทเรียน</a></li>
						<li><a href="coursenotification.php">จัดการระบบแจ้งเตือนบทเรียน</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons print"><a data-toggle="collapse" href="#Passcours"><i></i><span>ระบบพิมพ์ใบประกาศนียบัตร</span></a>
					<ul class=" collapse " id="Passcours">
						<li><a href="passcourse-request-cert.php">รายงานผู้ขอรับใบประกาศนียบัตร</a></li>
						<li><a href="passcourse.php">รายงานผู้ผ่านการเรียน</a></li>
						<li><a href="passcourse-passcourselog.php">รายงานสถิติจำนวนผู้พิมพ์ใบประกาศฯ</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons print"><a data-toggle="collapse" href="#Report"><i></i><span>ระบบ Report</span></a>
					<ul class=" collapse " id="Report">
						<li><a href="report-logallregister.php">1.) รายงานภาพรวมการสมัครสมาชิก</a></li>
						<li><a href="user-admin-status.php">2.) รายงานผลการสมัครสมาชิก (ผู้เรียน)</a></li>
						<li><a href="report-attendprint.php">3.) รายงานภาพรวมของหลักสูตร</a></li>
						<li><a href="report-bycoursedetail.php">4.) รายงานการฝึกอบรมหลักสูตร</a></li>
						<li><a href="report-byuser.php">5..) รายงานติดตามผู้เรียน</a></li>
						<li><a href="report-logquestioncourse.php">6.) รายงานแบบสอบถามสำหรับหลักสูตร</a></li>
						<li><a href="report-logquestionall.php">7.) รายงานภาพรวมแบบสอบถาม</a></li>
						<li><a href="report-logreset.php">8.) รายงานการรีเซตหลักสูตร</a></li>
						<li><a href="report-orders.php">9.) รายงานคำสั่งซื้อ</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons folder_new"><a href="logemail-email.php"><i></i><span>ระบบการส่งผลการเรียนผ่านทางระบบอัตโนมัติ</span></a></li>
				<li class="hasSubmenu glyphicons print"><a data-toggle="collapse" href="#LogAdmin"><i></i><span>ระบบเก็บ Log การใช้งานระบบ</span></a>
					<ul class=" collapse " id="LogAdmin">
						<li><a href="logadmin-user.php">Log การใช้งานผู้เรียน</a></li>
						<li><a href="logadmin.php">Log การใช้งานผู้ดูแลระบบ</a></li>
						<li><a href="logadmin-apporve.php">Log การยืนยันสมัครสมาชิก</a></li>
						<li><a href="logadmin-apporvepersonal.php">Log การยืนยันสมัครสมาชิกบุคคลทั่วไป</a></li>
						<li><a href="logadmin-register.php">Log การตรวจสอบการสมัครสมาชิก</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons film"><a data-toggle="collapse" href="#student_photo"><i></i><span>ระบบการยืนยันการเข้าเรียนของผู้เรียน</span></a>
					<ul class=" collapse " id="student_photo">
						<li><a href="student-photo.php">จัดการการถ่ายภาพนักเรียน</a></li>
						<li><a href="capture.php">จัดการภาพถ่ายนักเรียน</a></li>
					</ul>
				</li>
				<li class="hasSubmenu glyphicons film"><a href="capturemember.php"><i></i><span>จัดการการถ่ายภาพนักเรียน</span></a></li>
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