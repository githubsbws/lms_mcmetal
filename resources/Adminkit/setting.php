<?php include 'head.php' ?>

<body class="">

	<!-- Main Container Fluid -->
	<div class="container-fluid fluid menu-left">

		<!-- Top navbar -->
		<?php include 'top-nav.php' ?>
		<!-- Top navbar END -->


		<!-- Sidebar menu & content wrapper -->
		<div id="wrapper">

			<!-- Sidebar Menu -->
			<?php include 'menu-left.php' ?>
			<!-- // Sidebar Menu END -->


			<!-- Content -->
			<!-- <div class="span-19"> -->
			<div id="content">
				<ul class="breadcrumb">
					<li><a href="/admin/index.php">หน้าหลัก</a></li> » <li><a href="/admin/index.php/setting/index">จัดการตั้งค่าระบบ</a></li> » <li>ตั้งค่าระบบ</li>
				</ul><!-- breadcrumbs -->
				<div class="separator bottom"></div>
				<script src="/admin/js/tinymce-4.3.4/tinymce.min.js" type="text/javascript"></script>
				<script type="text/javascript">
					$(function() {
						tinymce.init({
							selector: ".tinymce",
							theme: "modern",
							width: 680,
							height: 300,
							plugins: [
								"advlist autolink link image lists charmap print preview hr anchor pagebreak",
								"searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
								"table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
							],
							toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
							toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
							image_advtab: true,

							external_filemanager_path: "/admin/../filemanager/",
							filemanager_title: "Responsive Filemanager",
							external_plugins: {
								"filemanager": "/admin/../filemanager/plugin.min.js"
							}
						});
					});
				</script>
				<!-- innerLR -->
				<div class="innerLR">
					<div class="widget widget-tabs border-bottom-none">
						<div class="widget-head">
							<ul>
								<li class="active">
									<a class="glyphicons edit" href="#account-details" data-toggle="tab">
										<i></i>ตั้งค่าระบบ </a>
								</li>
							</ul>
						</div>
						<div class="widget-body">
							<div class="form">
								<form enctype="multipart/form-data" id="page-form" action="/admin/index.php/Setting/create" method="post">
									<p class="note">ค่าที่มี <span style="margin:0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="First name is mandatory"><i></i></span> จำเป็นต้องใส่ให้ครบ</p>

									<!-- <div class="row">
					<label for="Setting_settings_email">อีเมล์ที่ติดต่อได้</label>					<input class="span7" size="60" maxlength="255" name="Setting[settings_email]" id="Setting_settings_email" type="text" value="pieapple.ope@gmail.com " />					<div class="errorMessage" id="Setting_settings_email_em_" style="display:none"></div>				</div>

				<div class="row">
					<label for="Setting_settings_tel">เบอร์โทรศัพท์ที่ติดต่อได้</label>					<input class="span7" size="60" maxlength="255" name="Setting[settings_tel]" id="Setting_settings_tel" type="text" value="029339750" />					<div class="errorMessage" id="Setting_settings_tel_em_" style="display:none"></div>				</div>

				<div class="row">
					<label for="Setting_settings_line">line ที่ติดต่อได้</label>					<input class="span7" size="60" maxlength="255" name="Setting[settings_line]" id="Setting_settings_line" type="text" value="bws." />					<div class="errorMessage" id="Setting_settings_line_em_" style="display:none"></div>				</div>

				<p><div class="progress progress-inverse progress-mini"><div class="bar" style="width: 100%;"></div></div></p> -->

									<!-- <div class="row">
					<label for="Setting_settings_institution">รหัสสถาบัญ</label>					<input class="span7" size="60" maxlength="255" name="Setting[settings_institution]" id="Setting_settings_institution" type="text" value="40294" />					<span style="margin:0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="First name is mandatory"><i></i></span>					<div class="errorMessage" id="Setting_settings_institution_em_" style="display:none"></div>				</div> -->

									<div class="row">
										<label for="Setting_email_room">User Email ที่ใช้ในการส่งรหัสผ่านเข้าห้องเรียน</label> <input class="span7" size="60" maxlength="255" name="Setting[email_room]" id="Setting_email_room" type="text" value=""> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="First name is mandatory"><i></i></span>
										<div class="errorMessage" id="Setting_email_room_em_" style="display:none"></div>
									</div>

									<div class="row">
										<label for="Setting_pass_email_room">Pass Email ที่ใช้ในการส่งรหัสผ่านเข้าห้องเรียน</label> <input class="span7" size="60" maxlength="255" name="Setting[pass_email_room]" id="Setting_pass_email_room" type="text" value=""> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="First name is mandatory"><i></i></span>
										<div class="errorMessage" id="Setting_pass_email_room_em_" style="display:none"></div>
									</div>

									<p></p>
									<div class="progress progress-inverse progress-mini">
										<div class="bar" style="width: 100%;"></div>
									</div>
									<p></p>

									<div class="row">
										<label for="Setting_settings_user_email" class="required">User Email ที่ใช้ในการส่งข้อมูล <span class="required">*</span></label> <input class="span7" size="60" maxlength="255" name="Setting[settings_user_email]" id="Setting_settings_user_email" type="text" value="developtestbws@gmail.com"> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="First name is mandatory"><i></i></span>
										<div class="errorMessage" id="Setting_settings_user_email_em_" style="display:none"></div>
									</div>

									<div class="row">
										<label for="Setting_settings_pass_email">Pass Email ที่ใช้ในการส่งข้อมูล</label> <input class="span7" size="60" maxlength="255" name="Setting[settings_pass_email]" id="Setting_settings_pass_email" type="text" value="121314151617"> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="First name is mandatory"><i></i></span>
										<div class="errorMessage" id="Setting_settings_pass_email_em_" style="display:none"></div>
									</div>

									<div class="row">
										<label for="Setting_settings_testing">เปิด-ปิด การเฉลยข้อสอบ</label>
										<div class="toggle-button" data-togglebutton-style-enabled="success" style="width: 100px; height: 25px;">
											<input id="ytSetting_settings_testing" type="hidden" value="0" name="Setting[settings_testing]">
											<div style="left: -50%; width: 150px;"><input value="1" name="Setting[settings_testing]" id="Setting_settings_testing" type="checkbox"><span class="labelLeft success" style="width: 50px; height: 25px; line-height: 25px;">ON</span><label for="Setting_settings_testing" style="width: 50px; height: 25px;"></label><span class="labelRight" style="width: 50px; height: 25px; line-height: 25px;">OFF </span></div>
										</div>
										<div class="errorMessage" id="Setting_settings_testing_em_" style="display:none"></div>
									</div>

									<div class="row">
										<label for="Setting_settings_register">เปิด-ปิด การลงทะเบียน</label>
										<div class="toggle-button" data-togglebutton-style-enabled="success" style="width: 100px; height: 25px;">
											<input id="ytSetting_settings_register" type="hidden" value="0" name="Setting[settings_register]">
											<div style="left: -50%; width: 150px;"><input value="1" name="Setting[settings_register]" id="Setting_settings_register" type="checkbox"><span class="labelLeft success" style="width: 50px; height: 25px; line-height: 25px;">ON</span><label for="Setting_settings_register" style="width: 50px; height: 25px;"></label><span class="labelRight" style="width: 50px; height: 25px; line-height: 25px;">OFF </span></div>
										</div>
										<div class="errorMessage" id="Setting_settings_register_em_" style="display:none"></div>
									</div>

									<p></p>
									<div class="progress progress-inverse progress-mini">
										<div class="bar" style="width: 100%;"></div>
									</div>
									<p></p>


									<div class="row">
										<label for="Setting_settings_score">เปอร์เซ็นการคำนวณคะแนน การทดสอบผ่าน (ใส่ค่า 80 คือผ่าน 80 เปอร์เซ็นของคะแนนสอบ)</label> <input class="span7" size="60" maxlength="255" name="Setting[settings_score]" id="Setting_settings_score" type="text" value="90"> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="First name is mandatory"><i></i></span>
										<div class="errorMessage" id="Setting_settings_score_em_" style="display:none"></div>
									</div>


									<div class="row">
										<label for="Setting_password_expire_day">จำนวนวัน ที่รหัสผ่าน User จะหมดอายุ (ใส่ 0 หรือเว้นว่างถ้าไม่กำหนด)</label> <input class="span7" size="60" maxlength="255" name="Setting[password_expire_day]" id="Setting_password_expire_day" type="text" value="0"> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark" data-toggle="tooltip" data-placement="top" data-original-title="First name is mandatory"><i></i></span>
										<div class="errorMessage" id="Setting_password_expire_day_em_" style="display:none"></div>
									</div>

									<!-- <div class="row">
					<label for="Setting_settings_intro_status">เปิด-ปิด หน้า Intro</label>					<div class="toggle-button" data-toggleButton-style-enabled="success">
						<input id="ytSetting_settings_intro_status" type="hidden" value="0" name="Setting[settings_intro_status]" /><input value="1" name="Setting[settings_intro_status]" id="Setting_settings_intro_status" type="checkbox" />					</div>
					<div class="errorMessage" id="Setting_settings_intro_status_em_" style="display:none"></div>				</div>
				<br> -->
									<!-- <div class="row">
					<div class="pull-left">
						<div id="colorTab1">
							<div class="farbtastic">
								<div class="color" style="background-color: rgb(255, 226, 0);"></div>
								<div class="wheel"></div>
								<div class="overlay"></div>
								<div class="h-marker marker" style="left: 164px; top: 47px;"></div>
								<div class="sl-marker marker" style="left: 98px; top: 118px;"></div>
							</div>
						</div>
					</div>
				</div> -->

									<!-- <div class="row">
					<script type="text/javascript">
					$(function(){
						$('#colorTab1').farbtastic('#settings_bg_color'); 
					});
					</script>
					<label for="Setting_settings_intro_bg_color">สีพื้นหลังหน้า Intro</label>					<input class="span4" id="settings_bg_color" readonly="readonly" style="background-color: rgb(0, 0, 0); color: rgb(255, 255, 255); " name="Setting[settings_intro_bg_color]" type="text" value="#ffffff" />					<div class="errorMessage" id="Setting_settings_intro_bg_color_em_" style="display:none"></div>				</div>
				<br> -->

									<!-- <script type="text/javascript">
				function deleteImage(file_id)
				{
					$.get("/admin/index.php/setting/DeleteImageBg",{id:file_id},function(data){
						if($.trim(data)==1){
							notyfy({dismissQueue: false,text: "ลบภาพพื้นหลังเรียบร้อย",type: 'success'});
							$('#ImageBg').hide('fast');
						}else{
							alert('เกิดข้อผิดพลาด');
						}
					});
				}
				</script> -->

									<!-- <div class="row" id="ImageBg">
				<img class="thumbnail" src="http://lms.brother.co.th/admin/../uploads/setting/1/original/15052014103624_Picture.jpg" alt="15052014103624_Picture.jpg" />				<a title="ลบภาพพื้นหลัง" class="btn-action glyphicons pencil btn-danger remove_2" style="float:left; z-index:1; background-color:white; cursor:pointer;" onclick="if(confirm(&quot;คุณต้องการลบรูปภาพพื้นหลังใช่หรือไม่ ?&quot;)){ deleteImage(&quot;1&quot;); }"><i></i></a>				</div>
				<br> -->

									<!-- <div class="row">
					<label for="Setting_settings_intro_bg">รูปภาพพื้นหลัง Intro</label>					<div class="fileupload fileupload-new" data-provides="fileupload">
					  	<div class="input-append">
					    	<div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input id="ytSetting_settings_intro_bg" type="hidden" value="" name="Setting[settings_intro_bg]" /><input name="Setting[settings_intro_bg]" id="Setting_settings_intro_bg" type="file" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
					  	</div>
					</div>
					<div class="errorMessage" id="Setting_settings_intro_bg_em_" style="display:none"></div>				</div> -->

									<!-- <div class="row">
					<label for="Setting_settings_intro_detail">รายละเอียดหน้า Intro</label>					<textarea rows="6" cols="50" class="span8 tinymce" name="Setting[settings_intro_detail]" id="Setting_settings_intro_detail">&lt;p&gt;&amp;nbsp;&lt;/p&gt;
&lt;p&gt;&amp;nbsp;&lt;/p&gt;
&lt;p&gt;&amp;nbsp;&lt;/p&gt;
&lt;p&gt;&amp;nbsp;&lt;/p&gt;
&lt;p&gt;&amp;nbsp;&lt;/p&gt;
&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;font-size: xx-large;&quot;&gt;ขณะนี้บริษัทได้ดำเนินการ&lt;/span&gt;&lt;/p&gt;
&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;font-size: xx-large;&quot;&gt;ปรับปรุง SERVERเสร็จเรียบร้อย&lt;/span&gt;&lt;/p&gt;
&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;font-size: xx-large;&quot;&gt;และสมาชิกสามารถเข้าเรียนได้ตามปกติ&lt;/span&gt;&lt;/p&gt;
&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;font-size: xx-large;&quot;&gt;สอบถามเพิ่มเติมที่ 091-408-5727-8 หรือ&lt;/span&gt;&lt;/p&gt;
&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;font-size: xx-large;&quot;&gt;&lt;a href=&quot;mailto:cpdland@yahoo.com&quot;&gt;cpdland@yahoo.com&lt;/a&gt;&lt;/span&gt;&lt;/p&gt;
&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;font-size: xx-large;&quot;&gt;ทางทีมงานต้องขออภัยมา ณ ที่นี้&lt;/span&gt;&lt;/p&gt;
&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;font-size: xx-large;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;
&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;font-size: xx-large;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;
&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;font-size: xx-large;&quot;&gt;&amp;nbsp;&amp;lt;&amp;lt;&amp;nbsp;&lt;a style=&quot;font-family: verdana, geneva; font-size: x-large;&quot; href=&quot;/index.php/site/index&quot;&gt;เข้าสู่หน้าหลัก&lt;/a&gt;&amp;nbsp;&amp;gt;&amp;gt;&lt;/span&gt;&lt;/p&gt;</textarea>					<div class="errorMessage" id="Setting_settings_intro_detail_em_" style="display:none"></div>				</div>
				<br> -->

									<div class="row buttons">
										<button class="btn btn-primary btn-icon glyphicons ok_2"><i></i>บันทึกข้อมูล</button>
									</div>
								</form>
							</div><!-- form -->
						</div>
					</div>
				</div>
				<!-- END innerLR -->
				<div id="sidebar">
				</div><!-- sidebar -->
			</div>

		</div>
		<div class="clearfix"></div>
		<!-- // Sidebar menu & content wrapper END -->

		<div id="footer" class="hidden-print">

			<!--  Copyright Line -->
			<div class="copy">© 2023 - All Rights Reserved.</a></div>
			<!--  End Copyright Line -->

		</div>
		<!-- // Footer END -->

	</div>

</body>

<?php include 'footer.php' ?>