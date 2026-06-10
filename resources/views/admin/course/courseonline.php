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
					<li><a href="/admin/index.php">หน้าหลัก</a></li> » <li>หลักสูตรนิสิต/นักศึกษา</li>
				</ul><!-- breadcrumbs -->
				<div class="separator bottom"></div>


				<div class="innerLR">
					<div class="widget" data-toggle="collapse-widget" data-collapse-closed="true">
						<div class="widget-head">
							<h4 class="heading  glyphicons search"><i></i>ค้นหาขั้นสูง</h4>
							<span class="collapse-toggle"></span>
						</div>
						<div class="widget-body collapse" style="height: 0px;">
							<div class="search-form">
								<div class="wide form">
									<form id="SearchFormAjax" action="/admin/index.php/courseOnline/index" method="get">
										<div class="row"><label>หมวดอบรมออนไลน์</label><input class="span6" name="CourseOnline[cates_search]" id="CourseOnline_cates_search" type="text"></div>
										<div class="row"><label>รหัสหลักสูตร</label><input class="span6" name="CourseOnline[course_number]" id="CourseOnline_course_number" type="text" maxlength="255"></div>
										<div class="row"><label>ชื่อวิยากร</label><select class="span6" name="CourseOnline[course_lecturer]" id="CourseOnline_course_lecturer">
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
											</select></div>
										<div class="row"><label>ชื่อหลักสูตรอบรมออนไลน์</label><input class="span6" name="CourseOnline[course_title]" id="CourseOnline_course_title" type="text" maxlength="255"></div>
										<div class="row"><label>ราคา</label><input class="span6" name="CourseOnline[course_price]" id="CourseOnline_course_price" type="text"></div>
										<div class="row"><button class="btn btn-primary btn-icon glyphicons search"><i></i> ค้นหา</button></div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="widget" style="margin-top: -1px;">
						<div class="widget-head">
							<h4 class="heading glyphicons show_thumbnails_with_lines"><i></i> หลักสูตรนิสิต/นักศึกษา</h4>
						</div>
						<div class="widget-body">
							<div class="separator bottom form-inline small">
								<span class="pull-right">
									<label class="strong">แสดงแถว:</label>
									<select class="selectpicker" data-style="btn-default btn-small" onchange="$.updateGridView('CourseOnline-grid', 'news_per_page', this.value)" name="news_per_page" id="news_per_page" style="display: none;">
										<option value="">ค่าเริ่มต้น (10)</option>
										<option value="10">10</option>
										<option value="50">50</option>
										<option value="100">100</option>
										<option value="200">200</option>
										<option value="250">250</option>
									</select>
									<div class="btn-group bootstrap-select"><button class="btn dropdown-toggle clearfix btn-default btn-small" data-toggle="dropdown" id="news_per_page"><span class="filter-option pull-left">ค่าเริ่มต้น (10)</span>&nbsp;<span class="caret"></span></button>
										<div class="dropdown-menu" role="menu">
											<ul style="max-height: none; overflow-y: auto;">
												<li rel="0"><a tabindex="-1" href="#">ค่าเริ่มต้น (10)</a></li>
												<li rel="1"><a tabindex="-1" href="#">10</a></li>
												<li rel="2"><a tabindex="-1" href="#">50</a></li>
												<li rel="3"><a tabindex="-1" href="#">100</a></li>
												<li rel="4"><a tabindex="-1" href="#">200</a></li>
												<li rel="5"><a tabindex="-1" href="#">250</a></li>
											</ul>
										</div>
									</div>
								</span>
							</div>
							<div class="clear-div"></div>
							<div class="overflow-table">
								<div style="margin-top: -1px;" id="CourseOnline-grid" class="grid-view">
									<table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
										<thead>
											<tr>
												<th class="checkbox-column" id="chk"><input class="select-on-check-all" type="checkbox" value="1" name="chk_all" id="chk_all"></th>
												<th id="CourseOnline-grid_c1">รูปภาพ</th>
												<th id="CourseOnline-grid_c2"><a class="sort-link" style="color:white;" href="/admin/index.php/courseOnline/index?CourseOnline_sort=course_title">ชื่อหลักสูตรอบรมออนไลน์</a></th>
												<th id="CourseOnline-grid_c3"><a class="sort-link" style="color:white;" href="/admin/index.php/courseOnline/index?CourseOnline_sort=cate_id">หมวดอบรมออนไลน์</a></th>
												<th id="CourseOnline-grid_c4"><a class="sort-link" style="color:white;" href="/admin/index.php/courseOnline/index?CourseOnline_sort=course_lecturer">ชื่อวิยากร</a></th>
												<th style="text-align:center;" id="CourseOnline-grid_c5">ย้าย</th>
												<th class="button-column" id="CourseOnline-grid_c6">จัดการ</th>
											</tr>
											<tr class="filters">
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td><input name="CourseOnline[course_title]" type="text" maxlength="255"></td>
												<td><input name="CourseOnline[cates_search]" id="CourseOnline_cates_search" type="text"></td>
												<td><select class="" name="CourseOnline[course_lecturer]" id="CourseOnline_course_lecturer">
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
													</select></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
										</thead>
										<tbody>
											<tr class="items[]_176">
												<td class="checkbox-column"><input class="select-on-check" value="176" id="chk_0" type="checkbox" name="chk[]"></td>
												<td width="110"><img src="http://lms.brother.co.th/admin/../uploads/courseonline/176/small/26092017214417_Picture.jpg" alt="26092017214417_Picture.jpg"></td>
												<td>หลักสูตรการอบรมขั้นพื้นฐานสำหรับเครื่องพิมพ์ Inkjet Tank System.</td>
												<td style="width:130px">Brother E-learning System</td>
												<td width="150">อาจารย์ฐิติวัชร์ ปาตัก</td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/courseOnline/176"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/courseOnline/update/176"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/courseOnline/delete/176"><i></i></a></td>
											</tr>
											<tr class="items[]_192">
												<td class="checkbox-column"><input class="select-on-check" value="192" id="chk_1" type="checkbox" name="chk[]"></td>
												<td width="110"><img src="http://lms.brother.co.th/admin/../uploads/courseonline/192/small/17102018082943_Picture.jpg" alt="17102018082943_Picture.jpg"></td>
												<td>หลักสูตรการอบรมขั้นพื้นฐานสำหรับเครื่องพิมพ์ A3 Inkjet Tank Technology.</td>
												<td style="width:130px">Brother E-learning System</td>
												<td width="150">อาจารย์ฐิติวัชร์ ปาตัก</td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/courseOnline/192"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/courseOnline/update/192"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/courseOnline/delete/192"><i></i></a></td>
											</tr>
											<tr class="items[]_191">
												<td class="checkbox-column"><input class="select-on-check" value="191" id="chk_2" type="checkbox" name="chk[]"></td>
												<td width="110"><img src="http://lms.brother.co.th/admin/../uploads/courseonline/191/small/10042018110417_Picture.jpg" alt="10042018110417_Picture.jpg"></td>
												<td>การซ่อมบำรุงเครื่องพิมพ์ Brother Mono Laser สำหรับ ELL-Series</td>
												<td style="width:130px">Brother E-learning System</td>
												<td width="150">อาจารย์ กิติชัย วิเศษศิริ</td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/courseOnline/191"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/courseOnline/update/191"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/courseOnline/delete/191"><i></i></a></td>
											</tr>
											<tr class="items[]_197">
												<td class="checkbox-column"><input class="select-on-check" value="197" id="chk_3" type="checkbox" name="chk[]"></td>
												<td width="110"><img src="http://lms.brother.co.th/admin/../uploads/courseonline/197/small/20022019113040_Picture.jpg" alt="20022019113040_Picture.jpg"></td>
												<td>การซ่อมบำรุงเครื่องพิมพ์ Brother Color LED สำหรับ ECL-Series</td>
												<td style="width:130px">Brother E-learning System</td>
												<td width="150">อาจารย์ กิติชัย วิเศษศิริ</td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/courseOnline/197"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/courseOnline/update/197"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/courseOnline/delete/197"><i></i></a></td>
											</tr>
											<tr class="items[]_232">
												<td class="checkbox-column"><input class="select-on-check" value="232" id="chk_4" type="checkbox" name="chk[]"></td>
												<td width="110"><img src="http://lms.brother.co.th/admin/../uploads/courseonline/232/small/30032022155057_Picture.jpg" alt="30032022155057_Picture.jpg"></td>
												<td>หลักสูตรแนะนำผลิตภัณฑ์ GTX เบื้องต้น</td>
												<td style="width:130px">Brother E-learning System</td>
												<td width="150">อาจารย์ชาญวิทย์ ใยบัว </td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/courseOnline/232"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/courseOnline/update/232"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/courseOnline/delete/232"><i></i></a></td>
											</tr>
											<tr class="items[]_231">
												<td class="checkbox-column"><input class="select-on-check" value="231" id="chk_5" type="checkbox" name="chk[]"></td>
												<td width="110"><img src="http://lms.brother.co.th/admin/../uploads/courseonline/231/small/30032022082430_Picture.jpg" alt="30032022082430_Picture.jpg"></td>
												<td>หลักสูตรแนะนำผลิตภัณฑ์ BMB เบื้องต้น</td>
												<td style="width:130px">Brother E-learning System</td>
												<td width="150">อาจารย์ นภัทร สุขศิริภูริภัทร</td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/courseOnline/231"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/courseOnline/update/231"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/courseOnline/delete/231"><i></i></a></td>
											</tr>
											<tr class="items[]_209">
												<td class="checkbox-column"><input class="select-on-check" value="209" id="chk_6" type="checkbox" name="chk[]"></td>
												<td width="110"><img src="http://lms.brother.co.th/admin/../uploads/courseonline/209/small/08022020212313_Picture.jpg" alt="08022020212313_Picture.jpg"></td>
												<td>การซ่อมบำรุงเครื่อง Scanner สำหรับ ADS-Series</td>
												<td style="width:130px">Brother E-learning System</td>
												<td width="150">อาจารย์ กิติชัย วิเศษศิริ</td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/courseOnline/209"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/courseOnline/update/209"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/courseOnline/delete/209"><i></i></a></td>
											</tr>
											<tr class="items[]_222">
												<td class="checkbox-column"><input class="select-on-check" value="222" id="chk_7" type="checkbox" name="chk[]"></td>
												<td width="110"><img src="http://lms.brother.co.th/admin/../uploads/courseonline/222/small/30082021112832_Picture.jpg" alt="30082021112832_Picture.jpg"></td>
												<td>การซ่อมบำรุงเครื่องพิมพ์ฉลาก PT-E850TKW</td>
												<td style="width:130px">Brother E-learning System</td>
												<td width="150">อาจารย์ นภัทร สุขศิริภูริภัทร</td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/courseOnline/222"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/courseOnline/update/222"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/courseOnline/delete/222"><i></i></a></td>
											</tr>
											<tr class="items[]_182">
												<td class="checkbox-column"><input class="select-on-check" value="182" id="chk_8" type="checkbox" name="chk[]"></td>
												<td width="110"><img src="http://lms.brother.co.th/admin/../uploads/courseonline/182/small/17112017112102_Picture.png" alt="17112017112102_Picture.png"></td>
												<td>การซ่อมบำรุงเครื่องพิมพ์ Brother Mono Laser สำหรับ DL-Series</td>
												<td style="width:130px">Brother E-learning System</td>
												<td width="150">อาจารย์ กิติชัย วิเศษศิริ</td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/courseOnline/182"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/courseOnline/update/182"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/courseOnline/delete/182"><i></i></a></td>
											</tr>
											<tr class="items[]_223">
												<td class="checkbox-column"><input class="select-on-check" value="223" id="chk_9" type="checkbox" name="chk[]"></td>
												<td width="110"><img src="http://lms.brother.co.th/admin/../uploads/courseonline/223/small/01112021171608_Picture.jpg" alt="01112021171608_Picture.jpg"></td>
												<td>การซ่อมบำรุงจักรเย็บผ้ารุ่น GS2700</td>
												<td style="width:130px">Brother E-learning System</td>
												<td width="150">อาจารย์ชาญวิทย์ ใยบัว </td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/courseOnline/223"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/courseOnline/update/223"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/courseOnline/delete/223"><i></i></a></td>
											</tr>
										</tbody>
									</table>
									<div class="pagination pull-right">
										<ul class="" id="yw1">
											<li class="first hidden"><a href="/admin/index.php/courseOnline/index">&lt;&lt; หน้าแรก</a></li>
											<li class="previous hidden"><a href="/admin/index.php/courseOnline/index">&lt; หน้าที่แล้ว</a></li>
											<li class="page active"><a href="/admin/index.php/courseOnline/index">1</a></li>
											<li class="page"><a href="/admin/index.php/courseOnline/index?CourseOnline_page=2">2</a></li>
											<li class="page"><a href="/admin/index.php/courseOnline/index?CourseOnline_page=3">3</a></li>
											<li class="page"><a href="/admin/index.php/courseOnline/index?CourseOnline_page=4">4</a></li>
											<li class="page"><a href="/admin/index.php/courseOnline/index?CourseOnline_page=5">5</a></li>
											<li class="next"><a href="/admin/index.php/courseOnline/index?CourseOnline_page=2">หน้าถัดไป &gt;</a></li>
											<li class="last"><a href="/admin/index.php/courseOnline/index?CourseOnline_page=5">หน้าสุดท้าย &gt;&gt;</a></li>
										</ul>
									</div>
									<div class="keys" style="display:none" title="/admin/index.php/CourseOnline/index"><span>176</span><span>192</span><span>191</span><span>197</span><span>232</span><span>231</span><span>209</span><span>222</span><span>182</span><span>223</span></div>
									<input type="hidden" name="CourseOnline[news_per_page]" value="">
								</div>
							</div>
						</div>
					</div>

					<!-- Options -->
					<div class="separator top form-inline small">
						<!-- With selected actions -->
						<div class="buttons pull-left">
							<a class="btn btn-primary btn-icon glyphicons circle_minus" onclick="return multipleDeleteNews('/admin/index.php/CourseOnline/MultiDelete','CourseOnline-grid');" href="#"><i></i> ลบข้อมูลทั้งหมด</a>
						</div>
						<!-- // With selected actions END -->
						<div class="clearfix"></div>
					</div>
					<!-- // Options END -->


				</div>
				<div id="sidebar">
				</div><!-- sidebar -->
			</div>
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