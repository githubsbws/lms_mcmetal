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
					<li><a href="/admin/index.php">หน้าหลัก</a></li> » <li>ระบบตัวอย่าง Vdo YouTube</li>
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
									<form id="SearchFormAjax" action="/admin/index.php/vdo/index" method="get">
										<div class="row"><label>หัวข้อวิดีโอ</label><input class="span6" name="Vdo[vdo_title]" id="Vdo_vdo_title" type="text" maxlength="255"></div>
										<div class="row"><label>Path ของ YouTube</label><input class="span6" name="Vdo[vdo_path]" id="Vdo_vdo_path" type="text" maxlength="255"></div>
										<div class="row"><button class="btn btn-primary btn-icon glyphicons search"><i></i> ค้นหา</button></div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="widget" style="margin-top: -1px;">
						<div class="widget-head">
							<h4 class="heading glyphicons show_thumbnails_with_lines"><i></i> ระบบตัวอย่าง Vdo YouTube</h4>
						</div>
						<div class="widget-body">
							<div class="separator bottom form-inline small">
								<span class="pull-right">
									<label class="strong">แสดงแถว:</label>
									<select class="selectpicker" data-style="btn-default btn-small" onchange="$.updateGridView('Vdo-grid', 'news_per_page', this.value)" name="news_per_page" id="news_per_page" style="display: none;">
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
								<div style="margin-top: -1px;" id="Vdo-grid" class="grid-view">
									<table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
										<thead>
											<tr>
												<th class="checkbox-column" id="chk"><input class="select-on-check-all" type="checkbox" value="1" name="chk_all" id="chk_all"></th>
												<th id="Vdo-grid_c1"><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_title">หัวข้อวิดีโอ</a></th>
												<th id="Vdo-grid_c2"><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_path">Path ของ YouTube</a></th>
												<th class="button-column" id="Vdo-grid_c3">จัดการ</th>
											</tr>
											<tr class="filters">
												<td>&nbsp;</td>
												<td><input name="Vdo[vdo_title]" type="text" maxlength="255"></td>
												<td><input name="Vdo[vdo_path]" type="text" maxlength="255"></td>
												<td>&nbsp;</td>
											</tr>
										</thead>
										<tbody>
											<tr class="odd selectable">
												<td class="checkbox-column"><input class="select-on-check" value="9" id="chk_0" type="checkbox" name="chk[]"></td>
												<td> Microsoft เปิดตัว Office สำหรับ iPad มาครบทั้ง Word, Excel, PowerPoint</td>
												<td>https://www.youtube.com/watch?v=frpsGFQ4AIY</td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/vdo/9"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/vdo/update/9"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/vdo/delete/9"><i></i></a></td>
											</tr>
											<tr class="even selectable">
												<td class="checkbox-column"><input class="select-on-check" value="8" id="chk_1" type="checkbox" name="chk[]"></td>
												<td>Samsung เปิดตัว Galaxy S5 หน้าจอ 5.1 นิ้ว ทนทานกันน้ำกันฝุ่นได้!</td>
												<td>http://www.youtube.com/watch?v=mPu_K58jcas</td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/vdo/8"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/vdo/update/8"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/vdo/delete/8"><i></i></a></td>
											</tr>
											<tr class="odd selectable">
												<td class="checkbox-column"><input class="select-on-check" value="7" id="chk_2" type="checkbox" name="chk[]"></td>
												<td>รู้กันไหม? ATM ที่เราใช้ใกล้หมดอายุแล้วนะ!</td>
												<td>http://www.youtube.com/watch?v=0a5m2DwDy_I</td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/vdo/7"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/vdo/update/7"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/vdo/delete/7"><i></i></a></td>
											</tr>
											<tr class="even selectable">
												<td class="checkbox-column"><input class="select-on-check" value="6" id="chk_3" type="checkbox" name="chk[]"></td>
												<td>บัญชีครัวเรือนฉบับสมบรูณ์</td>
												<td>http://www.youtube.com/watch?v=AJC3mO0ePkU</td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/vdo/6"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/vdo/update/6"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/vdo/delete/6"><i></i></a></td>
											</tr>
											<tr class="odd selectable">
												<td class="checkbox-column"><input class="select-on-check" value="5" id="chk_4" type="checkbox" name="chk[]"></td>
												<td>รู้จัก "หลักปรัชญาของเศรษฐกิจพอเพียง" ใน 3 นาที</td>
												<td>http://www.youtube.com/watch?v=G1arbHJVuEw</td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/vdo/5"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/vdo/update/5"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/vdo/delete/5"><i></i></a></td>
											</tr>
										</tbody>
									</table>
									<div class="keys" style="display:none" title="/admin/index.php/vdo/index"><span>9</span><span>8</span><span>7</span><span>6</span><span>5</span></div>
									<input type="hidden" name="Vdo[news_per_page]" value="">
								</div>
							</div>
						</div>
					</div>

					<!-- Options -->
					<div class="separator top form-inline small">
						<!-- With selected actions -->
						<div class="buttons pull-left">
							<a class="btn btn-primary btn-icon glyphicons circle_minus" onclick="return multipleDeleteNews('/admin/index.php/Vdo/MultiDelete','Vdo-grid');" href="#"><i></i> ลบข้อมูลทั้งหมด</a>
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