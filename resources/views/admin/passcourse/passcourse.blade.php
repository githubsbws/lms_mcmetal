@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<body class="">

	<!-- Main Container Fluid -->
	<div class="container-fluid fluid menu-left">

		<!-- Top navbar -->
		@include('admin.layouts.partials.top-nav')
		<!-- Top navbar END -->


		<!-- Sidebar menu & content wrapper -->
		<div id="wrapper">

			<!-- Sidebar Menu -->
			@include('admin.layouts.partials.menu-left')
			<!-- // Sidebar Menu END -->


			<!-- Content -->
			<!-- <div class="span-19"> -->
			<div id="content">
				<ul class="breadcrumb">
					<li><a href="/admin/index.php">หน้าหลัก</a></li> » <li>ระบบReport ผู้ผ่านการเรียน</li>
				</ul><!-- breadcrumbs -->
				<div class="separator bottom"></div>


				<div class="innerLR">
					<div class="widget" style="margin-top: -1px;">
						<div class="widget-head">
							<h4 class="heading glyphicons show_thumbnails_with_lines"><i></i> ระบบReport ผู้ผ่านการเรียน</h4>
						</div>
						<div class="widget-body">
							<div class="separator bottom form-inline small">
								<span class="pull-left">
									<button class="btn btn-primary btn-icon glyphicons print" id="export"><i></i>ออกรายงาน</button> </span>
								<span class="pull-right">
									<label class="strong">แสดงแถว:</label>
									<select class="selectpicker" data-style="btn-default btn-small" onchange="$.updateGridView('Passcours-grid', 'news_per_page', this.value)" name="news_per_page" id="news_per_page" style="display: none;">
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
								<div style="margin-top: -1px;" id="Passcours-grid" class="grid-view">
									<table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
										<thead>
											<tr>
												<th id="Passcours-grid_c0"><a class="sort-link" style="color:white;" href="/admin/index.php/passcours/index?Passcours_sort=passcours_user">ชื่อผู้อบรม</a></th>
												<th id="Passcours-grid_c1"><a class="sort-link" style="color:white;" href="/admin/index.php/passcours/index?Passcours_sort=passcours_cours">ชื่อหลักสูตร</a></th>
												<th id="Passcours-grid_c2">หน่วยงาน</th>
												<th id="Passcours-grid_c3"><a class="sort-link" style="color:white;" href="/admin/index.php/passcours/index?Passcours_sort=passcours_date">วันที่สอบผ่าน</a></th>
												<th id="Passcours-grid_c4">พิมพ์ใบผ่านการอบรม</th>
												<th id="Passcours-grid_c5">พิมพ์ใบผ่านการอบรม</th>
											</tr>
											<tr class="filters">
												<td><input name="Passcours[user_name]" id="Passcours_user_name" type="text"></td>
												<td><input name="Passcours[cours_name]" id="Passcours_cours_name" type="text"></td>
												<td>&nbsp;</td>
												<td><input id="passcours_date" name="Passcours[passcours_date]" type="text" class="hasDatepicker"></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
										</thead>
										<tbody>
											<tr class="odd selectable">
												<td width="120">Administrator Admin</td>
												<td>tee test</td>
												<td>Brother</td>
												<td width="110" style="text-align:center;">26 กรกฎาคม 2023</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/236/1?style=1">แบบที่ 1</a>&nbsp;</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/236/1?style=0">แบบที่ 2</a>&nbsp;</td>
											</tr>
											<tr class="even selectable">
												<td width="120">พีระพงศ์ เวชศิริ </td>
												<td>การซ่อมบำรุงเครื่อง Scanner สำหรับ ADS-Series</td>
												<td>ศูนย์บริการแต่งตั้ง (ASC)</td>
												<td width="110" style="text-align:center;">23 พฤษภาคม 2023</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/209/680?style=1">แบบที่ 1</a>&nbsp;</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/209/680?style=0">แบบที่ 2</a>&nbsp;</td>
											</tr>
											<tr class="odd selectable">
												<td width="120">ไตรรัตน์ แสงสาคร </td>
												<td>การซ่อมบำรุงจักรเย็บผ้ารุ่น GS2700</td>
												<td>ศูนย์บริการแต่งตั้ง (ASC)</td>
												<td width="110" style="text-align:center;">22 พฤษภาคม 2023</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/223/546?style=1">แบบที่ 1</a>&nbsp;</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/223/546?style=0">แบบที่ 2</a>&nbsp;</td>
											</tr>
											<tr class="even selectable">
												<td width="120">ทวีชัย ทองดล</td>
												<td>การซ่อมบำรุงจักรเย็บผ้ารุ่น GS2700</td>
												<td>ศูนย์บริการแต่งตั้ง (ASC)</td>
												<td width="110" style="text-align:center;">15 พฤษภาคม 2023</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/223/1505?style=1">แบบที่ 1</a>&nbsp;</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/223/1505?style=0">แบบที่ 2</a>&nbsp;</td>
											</tr>
											<tr class="odd selectable">
												<td width="120">ประมวล ปานด้วง</td>
												<td>การซ่อมบำรุงจักรเย็บผ้ารุ่น GS2700</td>
												<td>ศูนย์บริการแต่งตั้ง (ASC)</td>
												<td width="110" style="text-align:center;">13 พฤษภาคม 2023</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/223/1504?style=1">แบบที่ 1</a>&nbsp;</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/223/1504?style=0">แบบที่ 2</a>&nbsp;</td>
											</tr>
											<tr class="even selectable">
												<td width="120">ปรเมศร์ สวนแก้ว</td>
												<td>หลักสูตรแนะนำผลิตภัณฑ์ BMB เบื้องต้น</td>
												<td>ศูนย์บริการแต่งตั้ง (ASC)</td>
												<td width="110" style="text-align:center;">4 พฤษภาคม 2023</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/231/1495?style=1">แบบที่ 1</a>&nbsp;</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/231/1495?style=0">แบบที่ 2</a>&nbsp;</td>
											</tr>
											<tr class="odd selectable">
												<td width="120">ภานุวัฒร์ คำยวง</td>
												<td>การซ่อมบำรุงเครื่องพิมพ์ฉลาก PT-E850TKW</td>
												<td>ศูนย์บริการแต่งตั้ง (ASC)</td>
												<td width="110" style="text-align:center;">3 พฤษภาคม 2023</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/222/1496?style=1">แบบที่ 1</a>&nbsp;</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/222/1496?style=0">แบบที่ 2</a>&nbsp;</td>
											</tr>
											<tr class="even selectable">
												<td width="120">ปรเมศร์ สวนแก้ว</td>
												<td>การซ่อมบำรุงเครื่อง Scanner สำหรับ ADS-Series</td>
												<td>ศูนย์บริการแต่งตั้ง (ASC)</td>
												<td width="110" style="text-align:center;">2 พฤษภาคม 2023</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/209/1495?style=1">แบบที่ 1</a>&nbsp;</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/209/1495?style=0">แบบที่ 2</a>&nbsp;</td>
											</tr>
											<tr class="odd selectable">
												<td width="120">ดนัย ตันทีปธรรม </td>
												<td>หลักสูตรแนะนำผลิตภัณฑ์ BMB เบื้องต้น</td>
												<td>ศูนย์บริการแต่งตั้ง (ASC)</td>
												<td width="110" style="text-align:center;">28 เมษายน 2023</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/231/579?style=1">แบบที่ 1</a>&nbsp;</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/231/579?style=0">แบบที่ 2</a>&nbsp;</td>
											</tr>
											<tr class="even selectable">
												<td width="120">เจริญกรุง นามบุญชู</td>
												<td>หลักสูตรแนะนำผลิตภัณฑ์ BMB เบื้องต้น</td>
												<td>ศูนย์บริการแต่งตั้ง (ASC)</td>
												<td width="110" style="text-align:center;">24 เมษายน 2023</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/231/1236?style=1">แบบที่ 1</a>&nbsp;</td>
												<td style="width: 140px;text-align:center"><a class="btn btn-primary" target="_blank" href="/admin/index.php/CourseOnline/PrintPDF/231/1236?style=0">แบบที่ 2</a>&nbsp;</td>
											</tr>
										</tbody>
									</table>
									<div class="pagination pull-right">
										<ul class="" id="yw0">
											<li class="first hidden"><a href="/admin/index.php/passcours/index">&lt;&lt; หน้าแรก</a></li>
											<li class="previous hidden"><a href="/admin/index.php/passcours/index">&lt; หน้าที่แล้ว</a></li>
											<li class="page active"><a href="/admin/index.php/passcours/index">1</a></li>
											<li class="page"><a href="/admin/index.php/passcours/index?Passcours_page=2">2</a></li>
											<li class="page"><a href="/admin/index.php/passcours/index?Passcours_page=3">3</a></li>
											<li class="page"><a href="/admin/index.php/passcours/index?Passcours_page=4">4</a></li>
											<li class="page"><a href="/admin/index.php/passcours/index?Passcours_page=5">5</a></li>
											<li class="page"><a href="/admin/index.php/passcours/index?Passcours_page=6">6</a></li>
											<li class="page"><a href="/admin/index.php/passcours/index?Passcours_page=7">7</a></li>
											<li class="page"><a href="/admin/index.php/passcours/index?Passcours_page=8">8</a></li>
											<li class="page"><a href="/admin/index.php/passcours/index?Passcours_page=9">9</a></li>
											<li class="page"><a href="/admin/index.php/passcours/index?Passcours_page=10">10</a></li>
											<li class="next"><a href="/admin/index.php/passcours/index?Passcours_page=2">หน้าถัดไป &gt;</a></li>
											<li class="last"><a href="/admin/index.php/passcours/index?Passcours_page=90">หน้าสุดท้าย &gt;&gt;</a></li>
										</ul>
									</div>
									<div class="keys" style="display:none" title="/admin/index.php/Passcours/index"><span>896</span><span>895</span><span>894</span><span>893</span><span>892</span><span>891</span><span>890</span><span>889</span><span>888</span><span>887</span></div>
									<input type="hidden" name="Passcours[news_per_page]" value="">
								</div>
							</div>
						</div>
					</div>
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
@endsection