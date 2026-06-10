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
					<li><a href="/admin/index.php">หน้าหลัก</a></li> » <li>ระบบบทเรียน</li>
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
									<form id="SearchFormAjax" action="/admin/index.php/lesson/index" method="get">
										<div class="row"><label>หลักสูตรอบรมออนไลน์</label><select class="span6" name="Lesson[course_id]" id="Lesson_course_id">
												<option value="">ทั้งหมด</option>
												<option value="236">tee test</option>
												<option value="235">ทีเทส</option>
												<option value="232">หลักสูตรแนะนำผลิตภัณฑ์ GTX เบื้องต้น</option>
												<option value="231">หลักสูตรแนะนำผลิตภัณฑ์ BMB เบื้องต้น</option>
												<option value="230">Online Marketing Day4 Facebook Live Shopee Lazada</option>
												<option value="229">Online Marketing Day3 Facebook and IG Ads</option>
												<option value="228">Online Marketing Day2 Digital Content Strategy</option>
												<option value="226">Online Marketing Day1 Social Media Platform</option>
												<option value="225">การซ่อมบำรุงเครื่องพิมพ์ฉลาก รุ่น TD-4550DNWB</option>
												<option value="224">การซ่อมบำรุงจักรเย็บผ้ารุ่น NV-180</option>
												<option value="223">การซ่อมบำรุงจักรเย็บผ้ารุ่น GS2700</option>
												<option value="222">การซ่อมบำรุงเครื่องพิมพ์ฉลาก PT-E850TKW</option>
												<option value="220">หลักสูตรผลิตภัณฑ์ใหม่ BHmini19HT</option>
												<option value="219">Ink Tank Mini19HT_BCC</option>
												<option value="218">ธกส. (HiQ)</option>
												<option value="217">Product Overview </option>
												<option value="215">Strategic Thinking</option>
												<option value="214">เทคนิคการนำเสนอบริการเสริมการรับประกันเครื่อง " Brother Care Pack "</option>
												<option value="213">CRG Project</option>
												<option value="212">การใช้งานโปรแกรม BR-Admin Professional 4</option>
												<option value="211">ความรู้ทั่วไป</option>
												<option value="210">Barcode Utility Program</option>
												<option value="209">การซ่อมบำรุงเครื่อง Scanner สำหรับ ADS-Series</option>
												<option value="208">การใช้งานโปรแกรม Brother iprint and scan</option>
												<option value="201">การเรียนรู้เครื่องพิมพ์ผ้าระบบดิจิตอล GTX-422 Training For BCC</option>
												<option value="197">การซ่อมบำรุงเครื่องพิมพ์ Brother Color LED สำหรับ ECL-Series</option>
												<option value="195">TEST_COURSEONLINE</option>
												<option value="192">หลักสูตรการอบรมขั้นพื้นฐานสำหรับเครื่องพิมพ์ A3 Inkjet Tank Technology.</option>
												<option value="191">การซ่อมบำรุงเครื่องพิมพ์ Brother Mono Laser สำหรับ ELL-Series</option>
												<option value="190">การใช้ Cap Frame เบี้ยงต้น</option>
												<option value="189">ตำแหน่งการปรับสายพานจักร VR</option>
												<option value="188">การแก้ไขปัญหาจักร VR ปุ่มนิรภัยถูกปิด</option>
												<option value="187">Mobile printing</option>
												<option value="186">การติดตั้งและการใช้งาน Program Brother Meter Read Tool</option>
												<option value="185">ความรู้พื้นฐานของจักร NV950</option>
												<option value="184">Brother Service Excellence ( Module I : Brother Care ) </option>
												<option value="183">Brother Service Excellence ( Module II : Brother นักบริการมืออาชีพ )</option>
												<option value="182">การซ่อมบำรุงเครื่องพิมพ์ Brother Mono Laser สำหรับ DL-Series</option>
												<option value="180">Sales : รู้จักกับ Inkjet tank ของ Brother กัน</option>
												<option value="179">Sales : อบรมความเข้าใจพื้นฐานเกี่ยวกับการใช้งาน Scanner</option>
												<option value="178">Sales : อัพเดต Laser รุ่นใหม่</option>
												<option value="177">Sales : P-Touch Editor</option>
												<option value="176">หลักสูตรการอบรมขั้นพื้นฐานสำหรับเครื่องพิมพ์ Inkjet Tank System.</option>
												<option value="172">การแก้ปัญหาเบื้องตของจักรเย็บผ้า</option>
												<option value="171">การใช้งานระบบบริการลูกค้า (New BSIS)</option>
												<option value="139">การใช้งานโปรแกรมลายปักษ์ (PE-Design Next)</option>
											</select></div>
										<div class="row"><label>ชื่อบทเรียน</label><input class="span6" name="Lesson[title]" id="Lesson_title" type="text" maxlength="80"></div>
										<div class="row"><button class="btn btn-primary btn-icon glyphicons search"><i></i> ค้นหา</button></div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="widget" style="margin-top: -1px;">
						<div class="widget-head">
							<h4 class="heading glyphicons show_thumbnails_with_lines"><i></i> ระบบบทเรียน</h4>
						</div>
						<div class="widget-body">
							<div class="separator bottom form-inline small">
								<span class="pull-right">
									<label class="strong">แสดงแถว:</label>
									<select class="selectpicker" data-style="btn-default btn-small" onchange="$.updateGridView('Lesson-grid', 'news_per_page', this.value)" name="news_per_page" id="news_per_page" style="display: none;">
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
								<div style="margin-top: -1px;" id="Lesson-grid" class="grid-view">
									<table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
										<thead>
											<tr>
												<th class="checkbox-column" id="chk"><input class="select-on-check-all" type="checkbox" value="1" name="chk_all" id="chk_all"></th>
												<th id="Lesson-grid_c1"><a class="sort-link" style="color:white;" href="/admin/index.php/lesson/index?Lesson_sort=course_id">หลักสูตรอบรมออนไลน์</a></th>
												<th id="Lesson-grid_c2"><a class="sort-link" style="color:white;" href="/admin/index.php/lesson/index?Lesson_sort=title">ชื่อบทเรียน</a></th>
												<th id="Lesson-grid_c3">แบบสอบถาม</th>
												<th style="text-align: center" id="Lesson-grid_c4">จัดการวิดีโอ</th>
												<th id="Lesson-grid_c5">ก่อนเรียน</th>
												<th id="Lesson-grid_c6">หลังเรียน</th>
												<th style="text-align:center;" id="Lesson-grid_c7">ย้าย</th>
												<th class="button-column" id="Lesson-grid_c8">จัดการ</th>
											</tr>
											<tr class="filters">
												<td>&nbsp;</td>
												<td><select class="" name="Lesson[course_id]" id="Lesson_course_id">
														<option value="">ทั้งหมด</option>
														<option value="236">tee test</option>
														<option value="235">ทีเทส</option>
														<option value="232">หลักสูตรแนะนำผลิตภัณฑ์ GTX เบื้องต้น</option>
														<option value="231">หลักสูตรแนะนำผลิตภัณฑ์ BMB เบื้องต้น</option>
														<option value="230">Online Marketing Day4 Facebook Live Shopee Lazada</option>
														<option value="229">Online Marketing Day3 Facebook and IG Ads</option>
														<option value="228">Online Marketing Day2 Digital Content Strategy</option>
														<option value="226">Online Marketing Day1 Social Media Platform</option>
														<option value="225">การซ่อมบำรุงเครื่องพิมพ์ฉลาก รุ่น TD-4550DNWB</option>
														<option value="224">การซ่อมบำรุงจักรเย็บผ้ารุ่น NV-180</option>
														<option value="223">การซ่อมบำรุงจักรเย็บผ้ารุ่น GS2700</option>
														<option value="222">การซ่อมบำรุงเครื่องพิมพ์ฉลาก PT-E850TKW</option>
														<option value="220">หลักสูตรผลิตภัณฑ์ใหม่ BHmini19HT</option>
														<option value="219">Ink Tank Mini19HT_BCC</option>
														<option value="218">ธกส. (HiQ)</option>
														<option value="217">Product Overview </option>
														<option value="215">Strategic Thinking</option>
														<option value="214">เทคนิคการนำเสนอบริการเสริมการรับประกันเครื่อง " Brother Care Pack "</option>
														<option value="213">CRG Project</option>
														<option value="212">การใช้งานโปรแกรม BR-Admin Professional 4</option>
														<option value="211">ความรู้ทั่วไป</option>
														<option value="210">Barcode Utility Program</option>
														<option value="209">การซ่อมบำรุงเครื่อง Scanner สำหรับ ADS-Series</option>
														<option value="208">การใช้งานโปรแกรม Brother iprint and scan</option>
														<option value="201">การเรียนรู้เครื่องพิมพ์ผ้าระบบดิจิตอล GTX-422 Training For BCC</option>
														<option value="197">การซ่อมบำรุงเครื่องพิมพ์ Brother Color LED สำหรับ ECL-Series</option>
														<option value="195">TEST_COURSEONLINE</option>
														<option value="192">หลักสูตรการอบรมขั้นพื้นฐานสำหรับเครื่องพิมพ์ A3 Inkjet Tank Technology.</option>
														<option value="191">การซ่อมบำรุงเครื่องพิมพ์ Brother Mono Laser สำหรับ ELL-Series</option>
														<option value="190">การใช้ Cap Frame เบี้ยงต้น</option>
														<option value="189">ตำแหน่งการปรับสายพานจักร VR</option>
														<option value="188">การแก้ไขปัญหาจักร VR ปุ่มนิรภัยถูกปิด</option>
														<option value="187">Mobile printing</option>
														<option value="186">การติดตั้งและการใช้งาน Program Brother Meter Read Tool</option>
														<option value="185">ความรู้พื้นฐานของจักร NV950</option>
														<option value="184">Brother Service Excellence ( Module I : Brother Care ) </option>
														<option value="183">Brother Service Excellence ( Module II : Brother นักบริการมืออาชีพ )</option>
														<option value="182">การซ่อมบำรุงเครื่องพิมพ์ Brother Mono Laser สำหรับ DL-Series</option>
														<option value="180">Sales : รู้จักกับ Inkjet tank ของ Brother กัน</option>
														<option value="179">Sales : อบรมความเข้าใจพื้นฐานเกี่ยวกับการใช้งาน Scanner</option>
														<option value="178">Sales : อัพเดต Laser รุ่นใหม่</option>
														<option value="177">Sales : P-Touch Editor</option>
														<option value="176">หลักสูตรการอบรมขั้นพื้นฐานสำหรับเครื่องพิมพ์ Inkjet Tank System.</option>
														<option value="172">การแก้ปัญหาเบื้องตของจักรเย็บผ้า</option>
														<option value="171">การใช้งานระบบบริการลูกค้า (New BSIS)</option>
														<option value="139">การใช้งานโปรแกรมลายปักษ์ (PE-Design Next)</option>
													</select></td>
												<td><input name="Lesson[title]" type="text" maxlength="80"></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
										</thead>
										<tbody>
											<tr class="items[]_313">
												<td class="checkbox-column"><input class="select-on-check" value="313" id="chk_0" type="checkbox" name="chk[]"></td>
												<td style="width: 150px;">การเรียนรู้เครื่องพิมพ์ผ้าระบบดิจิตอล GTX-422 Training For BCC</td>
												<td style="width: 250px;">บทที่ 5. แบบทดสอบหลังจบหลักสูตร (GTX-422)</td>
												<td style="text-align: center" width="160px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Questionnaire/Choose/313">เลือก</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/File/index/313">จัดการวิดีโอ (0)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/313?type=pre">เลือกข้อสอบ (0)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/313?type=post">เลือกข้อสอบ (1)</a></td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/lesson/313"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/lesson/update/313"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/lesson/delete/313"><i></i></a></td>
											</tr>
											<tr class="items[]_312">
												<td class="checkbox-column"><input class="select-on-check" value="312" id="chk_1" type="checkbox" name="chk[]"></td>
												<td style="width: 150px;">การเรียนรู้เครื่องพิมพ์ผ้าระบบดิจิตอล GTX-422 Training For BCC</td>
												<td style="width: 250px;">บทที่ 4 การบำรุงรักษาของเครื่องพิมพ์ผ้าระบบดิจิตอล GTX-422</td>
												<td style="text-align: center" width="160px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Questionnaire/Choose/312">เลือก</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/File/index/312">จัดการวิดีโอ (0)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/312?type=pre">เลือกข้อสอบ (0)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/312?type=post">เลือกข้อสอบ (0)</a></td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/lesson/312"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/lesson/update/312"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/lesson/delete/312"><i></i></a></td>
											</tr>
											<tr class="items[]_311">
												<td class="checkbox-column"><input class="select-on-check" value="311" id="chk_2" type="checkbox" name="chk[]"></td>
												<td style="width: 150px;">การเรียนรู้เครื่องพิมพ์ผ้าระบบดิจิตอล GTX-422 Training For BCC</td>
												<td style="width: 250px;">บทที่ 3. การออกแบบและการพิมพ์ลงบนผ้าของเครื่องพิมพ์ผ้าระบบดิจิตอล GTX-422</td>
												<td style="text-align: center" width="160px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Questionnaire/Choose/311">เลือก</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/File/index/311">จัดการวิดีโอ (0)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/311?type=pre">เลือกข้อสอบ (0)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/311?type=post">เลือกข้อสอบ (0)</a></td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/lesson/311"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/lesson/update/311"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/lesson/delete/311"><i></i></a></td>
											</tr>
											<tr class="items[]_310">
												<td class="checkbox-column"><input class="select-on-check" value="310" id="chk_3" type="checkbox" name="chk[]"></td>
												<td style="width: 150px;">การเรียนรู้เครื่องพิมพ์ผ้าระบบดิจิตอล GTX-422 Training For BCC</td>
												<td style="width: 250px;">บทที่ 2 การติดตั้งและการตั้งค่าเครื่องพิมพ์ผ้าระบบดิจิตอล GTX-422</td>
												<td style="text-align: center" width="160px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Questionnaire/Choose/310">เลือก</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/File/index/310">จัดการวิดีโอ (0)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/310?type=pre">เลือกข้อสอบ (0)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/310?type=post">เลือกข้อสอบ (0)</a></td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/lesson/310"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/lesson/update/310"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/lesson/delete/310"><i></i></a></td>
											</tr>
											<tr class="items[]_309">
												<td class="checkbox-column"><input class="select-on-check" value="309" id="chk_4" type="checkbox" name="chk[]"></td>
												<td style="width: 150px;">การเรียนรู้เครื่องพิมพ์ผ้าระบบดิจิตอล GTX-422 Training For BCC</td>
												<td style="width: 250px;">บทที่ 1 รู้จักกับเครื่องพิมพ์ผ้าระบบดิจิทัล GTX-422</td>
												<td style="text-align: center" width="160px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Questionnaire/Choose/309">เลือก</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/File/index/309">จัดการวิดีโอ (0)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/309?type=pre">เลือกข้อสอบ (1)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/309?type=post">เลือกข้อสอบ (0)</a></td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/lesson/309"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/lesson/update/309"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/lesson/delete/309"><i></i></a></td>
											</tr>
											<tr class="items[]_307">
												<td class="checkbox-column"><input class="select-on-check" value="307" id="chk_5" type="checkbox" name="chk[]"></td>
												<td style="width: 150px;">การซ่อมบำรุงเครื่องพิมพ์ Brother Mono Laser สำหรับ ELL-Series</td>
												<td style="width: 250px;">บทที่ 7. แบบทดสอบหลังจบหลักสูตร (Brother Mono Laser ELL Series)</td>
												<td style="text-align: center" width="160px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Questionnaire/Choose/307">เลือก</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/File/index/307">จัดการวิดีโอ (0)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/307?type=pre">เลือกข้อสอบ (0)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/307?type=post">เลือกข้อสอบ (1)</a></td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/lesson/307"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/lesson/update/307"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/lesson/delete/307"><i></i></a></td>
											</tr>
											<tr class="items[]_306">
												<td class="checkbox-column"><input class="select-on-check" value="306" id="chk_6" type="checkbox" name="chk[]"></td>
												<td style="width: 150px;">การซ่อมบำรุงเครื่องพิมพ์ Brother Color LED สำหรับ ECL-Series</td>
												<td style="width: 250px;">บนที่ 7. แบบทดสอบ ECL-SEries ภาคทฏษฎี 20 ข้อ (Brother Color LED for ECL Series )</td>
												<td style="text-align: center" width="160px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Questionnaire/Choose/306">เลือก</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/File/index/306">จัดการวิดีโอ (0)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/306?type=pre">เลือกข้อสอบ (0)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/306?type=post">เลือกข้อสอบ (1)</a></td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/lesson/306"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/lesson/update/306"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/lesson/delete/306"><i></i></a></td>
											</tr>
											<tr class="items[]_305">
												<td class="checkbox-column"><input class="select-on-check" value="305" id="chk_7" type="checkbox" name="chk[]"></td>
												<td style="width: 150px;">การซ่อมบำรุงเครื่องพิมพ์ Brother Color LED สำหรับ ECL-Series</td>
												<td style="width: 250px;">บทที่ 6 ขั้นตอนการถอดประกอบเครื่องพิมพ์ (Brother Color LED for ECL Series )</td>
												<td style="text-align: center" width="160px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Questionnaire/Choose/305">เลือก</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/File/index/305">จัดการวิดีโอ (14)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/305?type=pre">เลือกข้อสอบ (0)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/305?type=post">เลือกข้อสอบ (0)</a></td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/lesson/305"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/lesson/update/305"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/lesson/delete/305"><i></i></a></td>
											</tr>
											<tr class="items[]_304">
												<td class="checkbox-column"><input class="select-on-check" value="304" id="chk_8" type="checkbox" name="chk[]"></td>
												<td style="width: 150px;">การซ่อมบำรุงเครื่องพิมพ์ Brother Color LED สำหรับ ECL-Series</td>
												<td style="width: 250px;">บทที่ 5. การแก้ปัญหาเบื้องต้น (Brother Color LED for ECL Series)</td>
												<td style="text-align: center" width="160px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Questionnaire/Choose/304">เลือก</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/File/index/304">จัดการวิดีโอ (1)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/304?type=pre">เลือกข้อสอบ (0)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/304?type=post">เลือกข้อสอบ (0)</a></td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/lesson/304"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/lesson/update/304"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/lesson/delete/304"><i></i></a></td>
											</tr>
											<tr class="items[]_303">
												<td class="checkbox-column"><input class="select-on-check" value="303" id="chk_9" type="checkbox" name="chk[]"></td>
												<td style="width: 150px;">การซ่อมบำรุงเครื่องพิมพ์ Brother Color LED สำหรับ ECL-Series</td>
												<td style="width: 250px;">บทที่ 4.ขั้นตอนตรวจเช็คตามระยะเวลา (Brother Color LED for ECL Series)</td>
												<td style="text-align: center" width="160px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Questionnaire/Choose/303">เลือก</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/File/index/303">จัดการวิดีโอ (1)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/303?type=pre">เลือกข้อสอบ (0)</a></td>
												<td style="text-align: center" width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/Lesson/FormLesson/303?type=post">เลือกข้อสอบ (0)</a></td>
												<td style="text-align: center; width:50px;" class="row_move"><a class="glyphicons move btn-action btn-inverse"><i></i></a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/lesson/303"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/lesson/update/303"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/lesson/delete/303"><i></i></a></td>
											</tr>
										</tbody>
									</table>
									<div class="pagination pull-right">
										<ul class="" id="yw1">
											<li class="first hidden"><a href="/admin/index.php/lesson/index">&lt;&lt; หน้าแรก</a></li>
											<li class="previous hidden"><a href="/admin/index.php/lesson/index">&lt; หน้าที่แล้ว</a></li>
											<li class="page active"><a href="/admin/index.php/lesson/index">1</a></li>
											<li class="page"><a href="/admin/index.php/lesson/index?Lesson_page=2">2</a></li>
											<li class="page"><a href="/admin/index.php/lesson/index?Lesson_page=3">3</a></li>
											<li class="page"><a href="/admin/index.php/lesson/index?Lesson_page=4">4</a></li>
											<li class="page"><a href="/admin/index.php/lesson/index?Lesson_page=5">5</a></li>
											<li class="page"><a href="/admin/index.php/lesson/index?Lesson_page=6">6</a></li>
											<li class="page"><a href="/admin/index.php/lesson/index?Lesson_page=7">7</a></li>
											<li class="page"><a href="/admin/index.php/lesson/index?Lesson_page=8">8</a></li>
											<li class="page"><a href="/admin/index.php/lesson/index?Lesson_page=9">9</a></li>
											<li class="page"><a href="/admin/index.php/lesson/index?Lesson_page=10">10</a></li>
											<li class="next"><a href="/admin/index.php/lesson/index?Lesson_page=2">หน้าถัดไป &gt;</a></li>
											<li class="last"><a href="/admin/index.php/lesson/index?Lesson_page=25">หน้าสุดท้าย &gt;&gt;</a></li>
										</ul>
									</div>
									<div class="keys" style="display:none" title="/admin/index.php/Lesson/index"><span>313</span><span>312</span><span>311</span><span>310</span><span>309</span><span>307</span><span>306</span><span>305</span><span>304</span><span>303</span></div>
									<input type="hidden" name="Lesson[news_per_page]" value="">
								</div>
							</div>
						</div>
					</div>

					<!-- Options -->
					<div class="separator top form-inline small">
						<!-- With selected actions -->
						<div class="buttons pull-left">
							<a class="btn btn-primary btn-icon glyphicons circle_minus" onclick="return multipleDeleteNews('/admin/index.php/Lesson/MultiDelete','Lesson-grid');" href="#"><i></i> ลบข้อมูลทั้งหมด</a>
						</div>
						<!-- // With selected actions END -->
						<div class="clearfix"></div>
					</div>
					<!-- // Options END -->

				</div>
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