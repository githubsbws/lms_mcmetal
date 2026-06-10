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
					<li><a href="/admin/index.php">หน้าหลัก</a></li> » <li>คำถามที่พบบ่อย</li>
				</ul><!-- breadcrumbs -->
				<div class="separator bottom"></div>
				<!---->
				<!--<h1>Faqs</h1>-->
				<!---->


				<div class="innerLR">
					<div class="widget" data-toggle="collapse-widget" data-collapse-closed="true">
						<div class="widget-head">
							<h4 class="heading  glyphicons search"><i></i>ค้นหาขั้นสูง</h4>
							<span class="collapse-toggle"></span>
						</div>
						<div class="widget-body collapse" style="height: 0px;">
							<div class="search-form">
								<div class="wide form">
									<form id="SearchFormAjax" action="/admin/index.php/faq/index" method="get">
										<div class="row"><label>คำถาม</label><input class="span6" name="Faq[faq_THtopic]" id="Faq_faq_THtopic" type="text" maxlength="250"></div>
										<div class="row"><button class="btn btn-primary btn-icon glyphicons search"><i></i> ค้นหา</button></div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="widget" style="margin-top: -1px;">
						<div class="widget-head">
							<h4 class="heading glyphicons show_thumbnails_with_lines"><i></i> คำถามที่พบบ่อย</h4>
						</div>
						<div class="widget-body">
							<div class="separator bottom form-inline small">
								<span class="pull-right" style="margin-left: 10px;">
									<a class="btn btn-primary btn-icon glyphicons circle_plus" href="/admin/index.php/Faq/create"><i></i> เพิ่มคำถาม</a>
								</span>
								<span class="pull-right">
									<label class="strong">แสดงแถว:</label>
									<select class="selectpicker" data-style="btn-default btn-small" onchange="$.updateGridView('Faq-grid', 'news_per_page', this.value)" name="news_per_page" id="news_per_page" style="display: none;">
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
								<div style="margin-top: -1px;" id="Faq-grid" class="grid-view">
									<table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
										<thead>
											<tr>
												<th class="checkbox-column" id="chk"><input class="select-on-check-all" type="checkbox" value="1" name="chk_all" id="chk_all"></th>
												<th id="Faq-grid_c1"><a class="sort-link" style="color:white;" href="/admin/index.php/faq/index?Faq_sort=faq_type_id">หมวดคำถาม</a></th>
												<th id="Faq-grid_c2"><a class="sort-link" style="color:white;" href="/admin/index.php/faq/index?Faq_sort=faq_THtopic">คำถาม</a></th>
												<th id="Faq-grid_c3"><a class="sort-link" style="color:white;" href="/admin/index.php/faq/index?Faq_sort=create_date">วันที่เพิ่มข้อมูล</a></th>
												<th class="button-column" id="Faq-grid_c4">จัดการ</th>
											</tr>
										</thead>
										<tbody>
											<tr class="odd selectable">
												<td class="checkbox-column"><input class="select-on-check" value="35" id="chk_0" type="checkbox" name="chk[]"></td>
												<td>วิธีการสมัครสมาชิก</td>
												<td>สมัครสมาชิกได้อย่างไร</td>
												<td>2015-10-20 16:02:46</td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/faq/35"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/faq/update/35"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/faq/delete/35"><i></i></a></td>
											</tr>
											<tr class="even selectable">
												<td class="checkbox-column"><input class="select-on-check" value="34" id="chk_1" type="checkbox" name="chk[]"></td>
												<td>เข้าสู่บทเรียนอย่างไร</td>
												<td>brother</td>
												<td>2015-09-24 11:50:14</td>
												<td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/faq/34"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/admin/index.php/faq/update/34"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/admin/index.php/faq/delete/34"><i></i></a></td>
											</tr>
										</tbody>
									</table>
									<div class="keys" style="display:none" title="/admin/index.php/Faq/index"><span>35</span><span>34</span></div>
									<input type="hidden" name="Faq[news_per_page]" value="">
								</div>
							</div>
						</div>
					</div>

					<!-- Options -->
					<div class="separator top form-inline small">
						<!-- With selected actions -->
						<div class="buttons pull-left">
							<a class="btn btn-primary btn-icon glyphicons circle_minus" onclick="return multipleDeleteNews('/admin/index.php/Faq/MultiDelete','Faq-grid');" href="#"><i></i> ลบข้อมูลทั้งหมด</a>
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