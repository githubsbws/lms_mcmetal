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
					<li><a href="/admin/index.php">หน้าหลัก</a></li> » <li><a href="/admin/index.php/courseOnline/index">ระบบหลักสูตรนิสืต/นักศึกษา</a></li> » <li>เพิ่มหลักสูตรนิสืต/นักศึกษา</li>
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
										<i></i>เพิ่มหลักสูตรสนิสืต/นักศึกษา </a>
								</li>
							</ul>
						</div>
						<div class="widget-body">
							<div class="form">
								<form enctype="multipart/form-data" id="course-form" action="/admin/index.php/CourseOnline/create" method="post">
									<p class="note">ค่าที่มี <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> จำเป็นต้องใส่ให้ครบ</p>
									<div class="row">
										<label for="CourseOnline_cate_id" class="required">หมวดอบรมออนไลน์ <span class="required">*</span></label> <select class="span8" name="CourseOnline[cate_id]" id="CourseOnline_cate_id">
											<option value="">ทั้งหมด</option>
											<option value="35">Brother E-learning System</option>
										</select> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
										<div class="error help-block">
											<div class="label label-important" id="CourseOnline_cate_id_em_" style="display:none"></div>
										</div>
									</div>

									<!-- <div class="row">
					<label for="CourseOnline_course_number">รหัสหลักสูตร</label>					<input class="span8" name="CourseOnline[course_number]" id="CourseOnline_course_number" type="text" maxlength="255" />					<span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>					<div class="error help-block"><div class="label label-important" id="CourseOnline_course_number_em_" style="display:none"></div></div>				</div> -->

									<!-- <div class="row">
					<label for="CourseOnline_course_rector_date">หลักสูตรได้รับความเห็นชอบเมื่อวันที่</label>					<input class="span8" readonly="readonly" id="CourseOnline_course_rector_date" name="CourseOnline[course_rector_date]" type="text" />					<span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>					<div class="error help-block"><div class="label label-important" id="CourseOnline_course_rector_date_em_" style="display:none"></div></div>				</div> -->

									<div class="row">
										<label for="CourseOnline_course_lecturer">ชื่อวิยากร</label> <select class="span8" name="CourseOnline[course_lecturer]" id="CourseOnline_course_lecturer">
											<option value="">ทั้งหมด</option>
											<option value="56">อาจารย์ นภัทร สุขศิริภูริภัทร</option>
											<option value="55">Prakaikoon Thomma (Noon)</option>
											<option value="54">Prakaikoon Thomma (Noon)</option>
											<option value="53">Sale &amp; Marketing team</option>
											<option value="52">Thipaya Traisathienkul</option>
											<option value="51">คุณ วรศักดิ์ ประดิษฐ์กุล </option>
											<option value="50">ople</option>
											<option value="49">น.ส. อมรรัตน์ ทรงงาม</option>
											<option value="48">น.ส.ณัฐธิณา แย้มสวัสดิ์</option>
											<option value="43">Mr. Piyapong Jaikla (Ae)</option>
											<option value="42">Mr. Kittaphob Srikhao (Ake)</option>
											<option value="40">Ms.Sukumal DephasdinNaAyudhya (Su)</option>
											<option value="38">Mr. Jakkit Rabtanyaboon (Tum)</option>
											<option value="34">Mr.Mongkol Inkamnerd </option>
											<option value="33">อุกฤษฏ์ จำปา</option>
											<option value="32">กำพล ชมเกษร</option>
											<option value="31">Naphat Suksiriphuriphat</option>
											<option value="30">จิณพงศ์ คำดี</option>
											<option value="29">วิศิษฎ์ วิบูลย์วิมลรัตน์</option>
											<option value="26">อาจารย์ กิติชัย วิเศษศิริ</option>
											<option value="25">อาจารย์ชาญวิทย์ ใยบัว </option>
											<option value="24">อาจารย์ฐิติวัชร์ ปาตัก</option>
										</select> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
										<div class="error help-block">
											<div class="label label-important" id="CourseOnline_course_lecturer_em_" style="display:none"></div>
										</div>
									</div>

									<div class="row">
										<label for="CourseOnline_course_title" class="required">ชื่อหลักสูตรอบรมออนไลน์ <span class="required">*</span></label> <input size="60" maxlength="255" class="span8" name="CourseOnline[course_title]" id="CourseOnline_course_title" type="text"> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
										<div class="error help-block">
											<div class="label label-important" id="CourseOnline_course_title_em_" style="display:none"></div>
										</div>
									</div>

									<div class="row">
										<label for="CourseOnline_course_short_title" class="required">รายละเอียดย่อ <span class="required">*</span></label> <textarea rows="6" cols="50" class="span8" name="CourseOnline[course_short_title]" id="CourseOnline_course_short_title"></textarea> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
										<div class="error help-block">
											<div class="label label-important" id="CourseOnline_course_short_title_em_" style="display:none"></div>
										</div>
									</div>

									<div class="row">
										<label for="CourseOnline_course_detail" class="required">รายละเอียด <span class="required">*</span></label>
										<div id="mceu_25" class="mce-tinymce mce-container mce-panel" hidefocus="1" tabindex="-1" role="application" style="visibility: hidden; border-width: 1px; width: 680px;">
											<div id="mceu_25-body" class="mce-container-body mce-stack-layout">
												<div id="mceu_26" class="mce-container mce-menubar mce-toolbar mce-stack-layout-item mce-first" role="menubar" style="border-width: 0px 0px 1px;">
													<div id="mceu_26-body" class="mce-container-body mce-flow-layout">
														<div id="mceu_27" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-first mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_27" role="menuitem" aria-haspopup="true"><button id="mceu_27-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">File</span> <i class="mce-caret"></i></button></div>
														<div id="mceu_28" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_28" role="menuitem" aria-haspopup="true"><button id="mceu_28-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">Edit</span> <i class="mce-caret"></i></button></div>
														<div id="mceu_29" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_29" role="menuitem" aria-haspopup="true"><button id="mceu_29-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">Insert</span> <i class="mce-caret"></i></button></div>
														<div id="mceu_30" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_30" role="menuitem" aria-haspopup="true"><button id="mceu_30-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">View</span> <i class="mce-caret"></i></button></div>
														<div id="mceu_31" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_31" role="menuitem" aria-haspopup="true"><button id="mceu_31-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">Format</span> <i class="mce-caret"></i></button></div>
														<div id="mceu_32" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_32" role="menuitem" aria-haspopup="true"><button id="mceu_32-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">Table</span> <i class="mce-caret"></i></button></div>
														<div id="mceu_33" class="mce-widget mce-btn mce-menubtn mce-flow-layout-item mce-last mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_33" role="menuitem" aria-haspopup="true"><button id="mceu_33-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">Tools</span> <i class="mce-caret"></i></button></div>
													</div>
												</div>
												<div id="mceu_34" class="mce-toolbar-grp mce-container mce-panel mce-stack-layout-item" hidefocus="1" tabindex="-1" role="group">
													<div id="mceu_34-body" class="mce-container-body mce-stack-layout">
														<div id="mceu_35" class="mce-container mce-toolbar mce-stack-layout-item mce-first" role="toolbar">
															<div id="mceu_35-body" class="mce-container-body mce-flow-layout">
																<div id="mceu_36" class="mce-container mce-flow-layout-item mce-first mce-btn-group" role="group">
																	<div id="mceu_36-body">
																		<div id="mceu_0" class="mce-widget mce-btn mce-first mce-disabled" tabindex="-1" aria-labelledby="mceu_0" role="button" aria-label="Undo" aria-disabled="true"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-undo"></i></button></div>
																		<div id="mceu_1" class="mce-widget mce-btn mce-last mce-disabled" tabindex="-1" aria-labelledby="mceu_1" role="button" aria-label="Redo" aria-disabled="true"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-redo"></i></button></div>
																	</div>
																</div>
																<div id="mceu_37" class="mce-container mce-flow-layout-item mce-btn-group" role="group">
																	<div id="mceu_37-body">
																		<div id="mceu_2" class="mce-widget mce-btn mce-first" tabindex="-1" aria-labelledby="mceu_2" role="button" aria-label="Bold"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-bold"></i></button></div>
																		<div id="mceu_3" class="mce-widget mce-btn" tabindex="-1" aria-labelledby="mceu_3" role="button" aria-label="Italic"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-italic"></i></button></div>
																		<div id="mceu_4" class="mce-widget mce-btn mce-last" tabindex="-1" aria-labelledby="mceu_4" role="button" aria-label="Underline"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-underline"></i></button></div>
																	</div>
																</div>
																<div id="mceu_38" class="mce-container mce-flow-layout-item mce-btn-group" role="group">
																	<div id="mceu_38-body">
																		<div id="mceu_5" class="mce-widget mce-btn mce-first" tabindex="-1" aria-labelledby="mceu_5" role="button" aria-label="Align left"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-alignleft"></i></button></div>
																		<div id="mceu_6" class="mce-widget mce-btn" tabindex="-1" aria-labelledby="mceu_6" role="button" aria-label="Align center"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-aligncenter"></i></button></div>
																		<div id="mceu_7" class="mce-widget mce-btn" tabindex="-1" aria-labelledby="mceu_7" role="button" aria-label="Align right"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-alignright"></i></button></div>
																		<div id="mceu_8" class="mce-widget mce-btn mce-last" tabindex="-1" aria-labelledby="mceu_8" role="button" aria-label="Justify"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-alignjustify"></i></button></div>
																	</div>
																</div>
																<div id="mceu_39" class="mce-container mce-flow-layout-item mce-btn-group" role="group">
																	<div id="mceu_39-body">
																		<div id="mceu_9" class="mce-widget mce-btn mce-splitbtn mce-menubtn mce-first" role="button" tabindex="-1" aria-label="Bullet list" aria-haspopup="true"><button type="button" hidefocus="1" tabindex="-1"><i class="mce-ico mce-i-bullist"></i></button><button type="button" class="mce-open" hidefocus="1" tabindex="-1"> <i class="mce-caret"></i></button></div>
																		<div id="mceu_10" class="mce-widget mce-btn mce-splitbtn mce-menubtn" role="button" tabindex="-1" aria-label="Numbered list" aria-haspopup="true"><button type="button" hidefocus="1" tabindex="-1"><i class="mce-ico mce-i-numlist"></i></button><button type="button" class="mce-open" hidefocus="1" tabindex="-1"> <i class="mce-caret"></i></button></div>
																		<div id="mceu_11" class="mce-widget mce-btn" tabindex="-1" aria-labelledby="mceu_11" role="button" aria-label="Decrease indent"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-outdent"></i></button></div>
																		<div id="mceu_12" class="mce-widget mce-btn mce-last" tabindex="-1" aria-labelledby="mceu_12" role="button" aria-label="Increase indent"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-indent"></i></button></div>
																	</div>
																</div>
																<div id="mceu_40" class="mce-container mce-flow-layout-item mce-last mce-btn-group" role="group">
																	<div id="mceu_40-body">
																		<div id="mceu_13" class="mce-widget mce-btn mce-menubtn mce-first mce-last mce-btn-has-text" tabindex="-1" aria-labelledby="mceu_13" role="button" aria-haspopup="true"><button id="mceu_13-open" role="presentation" type="button" tabindex="-1"><span class="mce-txt">Formats</span> <i class="mce-caret"></i></button></div>
																	</div>
																</div>
															</div>
														</div>
														<div id="mceu_41" class="mce-container mce-toolbar mce-stack-layout-item mce-last" role="toolbar">
															<div id="mceu_41-body" class="mce-container-body mce-flow-layout">
																<div id="mceu_42" class="mce-container mce-flow-layout-item mce-first mce-btn-group" role="group">
																	<div id="mceu_42-body">
																		<div id="mceu_14" class="mce-widget mce-btn mce-first mce-last" tabindex="-1" aria-labelledby="mceu_14" role="button" aria-label="Insert file"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-browse"></i></button></div>
																	</div>
																</div>
																<div id="mceu_43" class="mce-container mce-flow-layout-item mce-btn-group" role="group">
																	<div id="mceu_43-body">
																		<div id="mceu_15" class="mce-widget mce-btn mce-first" tabindex="-1" aria-labelledby="mceu_15" role="button" aria-label="Insert/edit link"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-link"></i></button></div>
																		<div id="mceu_16" class="mce-widget mce-btn" tabindex="-1" aria-labelledby="mceu_16" role="button" aria-label="Remove link"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-unlink"></i></button></div>
																		<div id="mceu_17" class="mce-widget mce-btn mce-last" tabindex="-1" aria-labelledby="mceu_17" role="button" aria-label="Anchor"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-anchor"></i></button></div>
																	</div>
																</div>
																<div id="mceu_44" class="mce-container mce-flow-layout-item mce-btn-group" role="group">
																	<div id="mceu_44-body">
																		<div id="mceu_18" class="mce-widget mce-btn mce-first" tabindex="-1" aria-labelledby="mceu_18" role="button" aria-label="Insert/edit image"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-image"></i></button></div>
																		<div id="mceu_19" class="mce-widget mce-btn mce-last" tabindex="-1" aria-labelledby="mceu_19" role="button" aria-label="Insert/edit video"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-media"></i></button></div>
																	</div>
																</div>
																<div id="mceu_45" class="mce-container mce-flow-layout-item mce-btn-group" role="group">
																	<div id="mceu_45-body">
																		<div id="mceu_20" class="mce-widget mce-btn mce-colorbutton mce-first" role="button" tabindex="-1" aria-haspopup="true" aria-label="Text color"><button role="presentation" hidefocus="1" type="button" tabindex="-1"><i class="mce-ico mce-i-forecolor"></i><span id="mceu_20-preview" class="mce-preview"></span></button><button type="button" class="mce-open" hidefocus="1" tabindex="-1"> <i class="mce-caret"></i></button></div>
																		<div id="mceu_21" class="mce-widget mce-btn mce-colorbutton mce-last" role="button" tabindex="-1" aria-haspopup="true" aria-label="Background color"><button role="presentation" hidefocus="1" type="button" tabindex="-1"><i class="mce-ico mce-i-backcolor"></i><span id="mceu_21-preview" class="mce-preview"></span></button><button type="button" class="mce-open" hidefocus="1" tabindex="-1"> <i class="mce-caret"></i></button></div>
																	</div>
																</div>
																<div id="mceu_46" class="mce-container mce-flow-layout-item mce-last mce-btn-group" role="group">
																	<div id="mceu_46-body">
																		<div id="mceu_22" class="mce-widget mce-btn mce-first" tabindex="-1" aria-labelledby="mceu_22" role="button" aria-label="Print"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-print"></i></button></div>
																		<div id="mceu_23" class="mce-widget mce-btn" tabindex="-1" aria-labelledby="mceu_23" role="button" aria-label="Preview"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-preview"></i></button></div>
																		<div id="mceu_24" class="mce-widget mce-btn mce-last" tabindex="-1" aria-labelledby="mceu_24" role="button" aria-label="Source code"><button role="presentation" type="button" tabindex="-1"><i class="mce-ico mce-i-code"></i></button></div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div id="mceu_47" class="mce-edit-area mce-container mce-panel mce-stack-layout-item" hidefocus="1" tabindex="-1" role="group" style="border-width: 1px 0px 0px;"><iframe id="CourseOnline_course_detail_ifr" frameborder="0" allowtransparency="true" title="Rich Text Area. Press ALT-F9 for menu. Press ALT-F10 for toolbar. Press ALT-0 for help" src="javascript:&quot;&quot;" style="width: 100%; height: 300px; display: block;"></iframe></div>
												<div id="mceu_48" class="mce-statusbar mce-container mce-panel mce-stack-layout-item mce-last" hidefocus="1" tabindex="-1" role="group" style="border-width: 1px 0px 0px;">
													<div id="mceu_48-body" class="mce-container-body mce-flow-layout">
														<div id="mceu_49" class="mce-path mce-flow-layout-item mce-first">
															<div role="button" class="mce-path-item mce-last" data-index="0" tabindex="-1" id="mceu_49-0" aria-level="0">p</div>
														</div><label id="mceu_51" class="mce-wordcount mce-widget mce-label mce-flow-layout-item">Words: 0</label>
														<div id="mceu_50" class="mce-flow-layout-item mce-resizehandle mce-last"><i class="mce-ico mce-i-resize"></i></div>
													</div>
												</div>
											</div>
										</div><textarea rows="6" cols="50" class="span8 tinymce" name="CourseOnline[course_detail]" id="CourseOnline_course_detail" aria-hidden="true" style="display: none;"></textarea>
										<div class="error help-block">
											<div class="label label-important" id="CourseOnline_course_detail_em_" style="display:none"></div>
										</div>
									</div>
									<br>


									<div class="row">
										<label for="CourseOnline_recommend">ปักหมุดหลักสูตรแนะนำ</label>
										<div class="toggle-button" data-togglebutton-style-enabled="success" style="width: 100px; height: 25px;">
											<input id="ytCourseOnline_recommend" type="hidden" value="n" name="CourseOnline[recommend]">
											<div style="left: -50%; width: 150px;"><input value="y" name="CourseOnline[recommend]" id="CourseOnline_recommend" type="checkbox"><span class="labelLeft success" style="width: 50px; height: 25px; line-height: 25px;">ON</span><label for="CourseOnline_recommend" style="width: 50px; height: 25px;"></label><span class="labelRight" style="width: 50px; height: 25px; line-height: 25px;">OFF </span></div>
										</div>
										<div class="error help-block">
											<div class="label label-important" id="CourseOnline_recommend_em_" style="display:none"></div>
										</div>
									</div>


									<!-- <div class="row">
					<label for="CourseOnline_course_refer">กำหนดอ้างถึงหนังสือ</label>					<input size="60" maxlength="255" class="span8" name="CourseOnline[course_refer]" id="CourseOnline_course_refer" type="text" />					<span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>					<div class="error help-block"><div class="label label-important" id="CourseOnline_course_refer_em_" style="display:none"></div></div>				</div> -->

									<!-- <div class="row">
					<label for="CourseOnline_course_book_number">หนังสือกรมพัฒนาธุรกิจการค้าเลขที่</label>					<input class="span8" name="CourseOnline[course_book_number]" id="CourseOnline_course_book_number" type="text" maxlength="255" />					<span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>					<div class="error help-block"><div class="label label-important" id="CourseOnline_course_book_number_em_" style="display:none"></div></div>				</div> -->

									<!-- <div class="row">
					<label for="CourseOnline_course_book_date">วันที่พัฒนาธุรกิจการค้า</label>					<input class="span8" readonly="readonly" id="CourseOnline_course_book_date" name="CourseOnline[course_book_date]" type="text" />					<span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>					<div class="error help-block"><div class="label label-important" id="CourseOnline_course_book_date_em_" style="display:none"></div></div>				</div> -->

									<!-- <div class="row">
					<label for="CourseOnline_course_type">ประเภทการเก็บชั่วโมง</label>					<select class="span8" name="CourseOnline[course_type]" id="CourseOnline_course_type">
<option value="">เลือกประเภทการเก็บชั่วโมง</option>
<option value="1">CPD</option>
<option value="2">CPA</option>
</select>					<span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>					<div class="error help-block"><div class="label label-important" id="CourseOnline_course_type_em_" style="display:none"></div></div>				</div> -->

									<!-- <div class="row">
					<label for="CourseOnline_course_hour">การเก็บชั่วโมง (บัญชี)</label>					<input size="60" maxlength="255" class="span8" name="CourseOnline[course_hour]" id="CourseOnline_course_hour" type="text" />					<div class="error help-block"><div class="label label-important" id="CourseOnline_course_hour_em_" style="display:none"></div></div>				</div> -->

									<!-- <div class="row">
					<label for="CourseOnline_course_other">การเก็บชั่วโมง (อื่นๆ)</label>					<input size="60" maxlength="255" class="span8" name="CourseOnline[course_other]" id="CourseOnline_course_other" type="text" />					<div class="error help-block"><div class="label label-important" id="CourseOnline_course_other_em_" style="display:none"></div></div>				</div> -->

									<!-- <div class="row">
					<label for="CourseOnline_course_tax">ประเภทการเสียภาษีหรือไม่</label>					<select class="span8" name="CourseOnline[course_tax]" id="CourseOnline_course_tax">
<option value="">กรุณาเลือกประเภท</option>
<option value="0" selected="selected">ไม่เสียภาษี (n.v.)</option>
<option value="1">เสียภาษี</option>
</select>					<span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>					<div class="error help-block"><div class="label label-important" id="CourseOnline_course_tax_em_" style="display:none"></div></div>				</div> -->

									<div class="row">
										<label for="CourseOnline_course_note">หมายเหตุ</label> <input size="60" maxlength="255" class="span8" name="CourseOnline[course_note]" id="CourseOnline_course_note" type="text">
										<div class="error help-block">
											<div class="label label-important" id="CourseOnline_course_note_em_" style="display:none"></div>
										</div>
									</div>

									<!-- <div class="row">
					<label for="CourseOnline_course_price">ราคา</label>					<input class="span8" name="CourseOnline[course_price]" id="CourseOnline_course_price" type="text" value="0" />					<span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>					<div class="error help-block"><div class="label label-important" id="CourseOnline_course_price_em_" style="display:none"></div></div>				</div> -->

									<div class="row">
									</div>

									<br>
									<div class="row">
									</div>
									<br>

									<div class="row">
										<label for="CourseOnline_course_picture">รูปภาพ</label>
										<div class="fileupload fileupload-new" data-provides="fileupload">
											<div class="input-append">
												<div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input id="ytCourseOnline_course_picture" type="hidden" value="" name="CourseOnline[course_picture]"><input name="CourseOnline[course_picture]" id="CourseOnline_course_picture" type="file"></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
											</div>
										</div>
										<div class="error help-block">
											<div class="label label-important" id="CourseOnline_course_picture_em_" style="display:none"></div>
										</div>
									</div>

									<div class="row">
										<font color="#990000">
											<span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> รูปภาพควรมีขนาด 250x180(แนวนอน) หรือ ขนาด 250x(xxx) (แนวยาว)
										</font>
									</div>
									<br>

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
			<!-- </div> -->
			<!-- <div class="span-5 last"> -->
			<!-- </div> -->
			<!-- // Content END -->

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