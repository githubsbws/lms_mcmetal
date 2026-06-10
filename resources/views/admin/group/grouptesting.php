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
					<li><a href="/admin/index.php">หน้าหลัก</a></li> » <li>ระบบชุดข้อสอบบทเรียนออนไลน์</li>
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
									<form id="SearchFormAjax" action="/admin/index.php/grouptesting/index" method="get">
										<div class="row"><label>ชื่อบทเรียนออนไลน์</label><input class="span6" name="Grouptesting[lesson_search]" id="Grouptesting_lesson_search" type="text"></div>
										<div class="row"><label>ชื่อชุด</label><input class="span6" name="Grouptesting[group_title]" id="Grouptesting_group_title" type="text" maxlength="255"></div>
										<div class="row"><button class="btn btn-primary btn-icon glyphicons search"><i></i> ค้นหา</button></div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="widget" style="margin-top: -1px;">
						<div class="widget-head">
							<h4 class="heading glyphicons show_thumbnails_with_lines"><i></i> ระบบชุดข้อสอบบทเรียนออนไลน์</h4>
						</div>
						<div class="widget-body">
							<div class="separator bottom form-inline small">
								<span class="pull-right">
									<label class="strong">แสดงแถว:</label>
									<select class="selectpicker" data-style="btn-default btn-small" onchange="$.updateGridView('Grouptesting-grid', 'news_per_page', this.value)" name="news_per_page" id="news_per_page" style="display: none;">
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
								<div style="margin-top: -1px;" id="Grouptesting-grid" class="grid-view">
									<table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
										<thead>
											<tr>
												<th class="checkbox-column" id="chk"><input class="select-on-check-all" type="checkbox" value="1" name="chk_all" id="chk_all"></th>
												<th id="Grouptesting-grid_c1"><a class="sort-link" style="color:white;" href="/admin/index.php/grouptesting/index?Grouptesting_sort=lesson_id">ชื่อบทเรียนออนไลน์</a></th>
												<th id="Grouptesting-grid_c2"><a class="sort-link" style="color:white;" href="/admin/index.php/grouptesting/index?Grouptesting_sort=group_title">ชื่อชุด</a></th>
												<th id="Grouptesting-grid_c3">จำนวนข้อ</th>
												<th id="Grouptesting-grid_c4">&nbsp;</th>
												<th id="Grouptesting-grid_c5">&nbsp;</th>
												<th id="Grouptesting-grid_c6">&nbsp;</th>
												<th class="button-column" id="Grouptesting-grid_c7">จัดการ</th>
											</tr>
											<tr class="filters">
												<td>&nbsp;</td>
												<td><input name="Grouptesting[lesson_search]" id="Grouptesting_lesson_search" type="text"></td>
												<td><input name="Grouptesting[group_title]" type="text" maxlength="255"></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
										</thead>
										<tbody>
											<tr class="odd selectable">
												<td class="checkbox-column"><input class="select-on-check" value="254" id="chk_0" type="checkbox" name="chk[]"></td>
												<td style="width:230px">tee test</td>
												<td>teetest</td>
												<td style="width:65px;text-align:center">2</td>
												<td width="120px"><a class="btn btn-success btn-icon" href="/admin/index.php/question/import/254">Import excel</a></td>
												<td width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/create/254">เพิ่มข้อสอบ</a></td>
												<td width="120px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/index/254">จัดการข้อสอบ</a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/grouptesting/254"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/grouptesting/update/254"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/grouptesting/delete/254"><i></i></a></td>
											</tr>
											<tr class="even selectable">
												<td class="checkbox-column"><input class="select-on-check" value="253" id="chk_1" type="checkbox" name="chk[]"></td>
												<td style="width:230px">แนะนำผลิตภัณฑ์ BMB เบื้องต้น</td>
												<td>ข้อสอบ BMB สำหรับศูนย์บริการ .</td>
												<td style="width:65px;text-align:center">30</td>
												<td width="120px"><a class="btn btn-success btn-icon" href="/admin/index.php/question/import/253">Import excel</a></td>
												<td width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/create/253">เพิ่มข้อสอบ</a></td>
												<td width="120px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/index/253">จัดการข้อสอบ</a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/grouptesting/253"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/grouptesting/update/253"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/grouptesting/delete/253"><i></i></a></td>
											</tr>
											<tr class="odd selectable">
												<td class="checkbox-column"><input class="select-on-check" value="249" id="chk_2" type="checkbox" name="chk[]"></td>
												<td style="width:230px">First1st</td>
												<td>test</td>
												<td style="width:65px;text-align:center">3</td>
												<td width="120px"><a class="btn btn-success btn-icon" href="/admin/index.php/question/import/249">Import excel</a></td>
												<td width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/create/249">เพิ่มข้อสอบ</a></td>
												<td width="120px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/index/249">จัดการข้อสอบ</a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/grouptesting/249"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/grouptesting/update/249"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/grouptesting/delete/249"><i></i></a></td>
											</tr>
											<tr class="even selectable">
												<td class="checkbox-column"><input class="select-on-check" value="248" id="chk_3" type="checkbox" name="chk[]"></td>
												<td style="width:230px">Namwantest1</td>
												<td>test</td>
												<td style="width:65px;text-align:center">3</td>
												<td width="120px"><a class="btn btn-success btn-icon" href="/admin/index.php/question/import/248">Import excel</a></td>
												<td width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/create/248">เพิ่มข้อสอบ</a></td>
												<td width="120px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/index/248">จัดการข้อสอบ</a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/grouptesting/248"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/grouptesting/update/248"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/grouptesting/delete/248"><i></i></a></td>
											</tr>
											<tr class="odd selectable">
												<td class="checkbox-column"><input class="select-on-check" value="247" id="chk_4" type="checkbox" name="chk[]"></td>
												<td style="width:230px">Namwantest2</td>
												<td>test</td>
												<td style="width:65px;text-align:center">3</td>
												<td width="120px"><a class="btn btn-success btn-icon" href="/admin/index.php/question/import/247">Import excel</a></td>
												<td width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/create/247">เพิ่มข้อสอบ</a></td>
												<td width="120px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/index/247">จัดการข้อสอบ</a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/grouptesting/247"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/grouptesting/update/247"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/grouptesting/delete/247"><i></i></a></td>
											</tr>
											<tr class="even selectable">
												<td class="checkbox-column"><input class="select-on-check" value="246" id="chk_5" type="checkbox" name="chk[]"></td>
												<td style="width:230px">บทที่ 7. แบบทดสอบ 10 ข้อ สำหรับเครื่องพิมพ์ฉลากรุ่น TD-4550DNWB</td>
												<td>แบบทดสอบหลังเรียน TD-4550DNWB</td>
												<td style="width:65px;text-align:center">10</td>
												<td width="120px"><a class="btn btn-success btn-icon" href="/admin/index.php/question/import/246">Import excel</a></td>
												<td width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/create/246">เพิ่มข้อสอบ</a></td>
												<td width="120px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/index/246">จัดการข้อสอบ</a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/grouptesting/246"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/grouptesting/update/246"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/grouptesting/delete/246"><i></i></a></td>
											</tr>
											<tr class="odd selectable">
												<td class="checkbox-column"><input class="select-on-check" value="245" id="chk_6" type="checkbox" name="chk[]"></td>
												<td style="width:230px">บทที่ 6 แบบทดสอบ NV-180 ภาคทฏษฎี 10 ข้อ</td>
												<td>แบบทดสอบ NV-180 หลังเรียน</td>
												<td style="width:65px;text-align:center">16</td>
												<td width="120px"><a class="btn btn-success btn-icon" href="/admin/index.php/question/import/245">Import excel</a></td>
												<td width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/create/245">เพิ่มข้อสอบ</a></td>
												<td width="120px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/index/245">จัดการข้อสอบ</a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/grouptesting/245"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/grouptesting/update/245"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/grouptesting/delete/245"><i></i></a></td>
											</tr>
											<tr class="even selectable">
												<td class="checkbox-column"><input class="select-on-check" value="244" id="chk_7" type="checkbox" name="chk[]"></td>
												<td style="width:230px">บทที่ 5 แบบทดสอบ GS2700 ภาคทฏษฎี 10 ข้อ</td>
												<td>ข้อสอบหลังเรียน (GS-2700)</td>
												<td style="width:65px;text-align:center">10</td>
												<td width="120px"><a class="btn btn-success btn-icon" href="/admin/index.php/question/import/244">Import excel</a></td>
												<td width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/create/244">เพิ่มข้อสอบ</a></td>
												<td width="120px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/index/244">จัดการข้อสอบ</a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/grouptesting/244"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/grouptesting/update/244"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/grouptesting/delete/244"><i></i></a></td>
											</tr>
											<tr class="odd selectable">
												<td class="checkbox-column"><input class="select-on-check" value="243" id="chk_8" type="checkbox" name="chk[]"></td>
												<td style="width:230px">บทที่ 6 การถอดประกอบเครื่องพิมพ์ฉลาก PT-E850TKW</td>
												<td>ข้อสอบหลังเรียน PT-E850TKW</td>
												<td style="width:65px;text-align:center">10</td>
												<td width="120px"><a class="btn btn-success btn-icon" href="/admin/index.php/question/import/243">Import excel</a></td>
												<td width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/create/243">เพิ่มข้อสอบ</a></td>
												<td width="120px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/index/243">จัดการข้อสอบ</a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/grouptesting/243"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/grouptesting/update/243"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/grouptesting/delete/243"><i></i></a></td>
											</tr>
											<tr class="even selectable">
												<td class="checkbox-column"><input class="select-on-check" value="242" id="chk_9" type="checkbox" name="chk[]"></td>
												<td style="width:230px">บทที่ 2.คุณสมบัติและข้อมูลตัวเครื่อง (Brother Mono Laser for ELL Series)</td>
												<td>Specification for ELL Series</td>
												<td style="width:65px;text-align:center">5</td>
												<td width="120px"><a class="btn btn-success btn-icon" href="/admin/index.php/question/import/242">Import excel</a></td>
												<td width="100px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/create/242">เพิ่มข้อสอบ</a></td>
												<td width="120px"><a class="btn btn-primary btn-icon" href="/admin/index.php/question/index/242">จัดการข้อสอบ</a></td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/grouptesting/242"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/grouptesting/update/242"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/grouptesting/delete/242"><i></i></a></td>
											</tr>
										</tbody>
									</table>
									<div class="pagination pull-right">
										<ul class="" id="yw1">
											<li class="first hidden"><a href="/admin/index.php/grouptesting/index">&lt;&lt; หน้าแรก</a></li>
											<li class="previous hidden"><a href="/admin/index.php/grouptesting/index">&lt; หน้าที่แล้ว</a></li>
											<li class="page active"><a href="/admin/index.php/grouptesting/index">1</a></li>
											<li class="page"><a href="/admin/index.php/grouptesting/index?Grouptesting_page=2">2</a></li>
											<li class="page"><a href="/admin/index.php/grouptesting/index?Grouptesting_page=3">3</a></li>
											<li class="page"><a href="/admin/index.php/grouptesting/index?Grouptesting_page=4">4</a></li>
											<li class="page"><a href="/admin/index.php/grouptesting/index?Grouptesting_page=5">5</a></li>
											<li class="page"><a href="/admin/index.php/grouptesting/index?Grouptesting_page=6">6</a></li>
											<li class="next"><a href="/admin/index.php/grouptesting/index?Grouptesting_page=2">หน้าถัดไป &gt;</a></li>
											<li class="last"><a href="/admin/index.php/grouptesting/index?Grouptesting_page=6">หน้าสุดท้าย &gt;&gt;</a></li>
										</ul>
									</div>
									<div class="keys" style="display:none" title="/admin/index.php/Grouptesting/index"><span>254</span><span>253</span><span>249</span><span>248</span><span>247</span><span>246</span><span>245</span><span>244</span><span>243</span><span>242</span></div>
									<input type="hidden" name="Grouptesting[news_per_page]" value="">
								</div>
							</div>
						</div>
					</div>

					<!-- Options -->
					<div class="separator top form-inline small">
						<!-- With selected actions -->
						<div class="buttons pull-left">
							<a class="btn btn-primary btn-icon glyphicons circle_minus" onclick="return multipleDeleteNews('/admin/index.php/Grouptesting/MultiDelete','Grouptesting-grid');" href="#"><i></i> ลบข้อมูลทั้งหมด</a>
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