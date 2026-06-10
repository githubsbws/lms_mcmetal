@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@import ("Swal from 'sweetalert2'")
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
						<li><a href="{{route('admin')}}">หน้าหลัก</a></li> » <li>จัดการระบบห้องเรียนออนไลน์</li>
					</ul><!-- breadcrumbs -->
					<div class="separator bottom"></div>
	
	
					<div class="innerLR">
						<div class="widget" style="margin-top: -1px;">
							<div class="widget-head">
								<h4 class="heading glyphicons show_thumbnails_with_lines"><i></i>จัดการระบบห้องเรียนออนไลน์</h4>
							</div>
							<div class="widget-body">
								<div class="separator bottom form-inline small">
									<span class="pull-right">
										<label class="strong">แสดงแถว:</label>
										<select class="selectpicker" data-style="btn-default btn-small" onchange="$.updateGridView('News-grid', 'news_per_page', this.value)" name="news_per_page" id="news_per_page" style="display: none;">
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
									<div style="margin-top: -1px;" id="News-grid" class="grid-view">
										<nav>
											<div class="nav nav-tabs" id="nav-tab" role="tablist">
											  {{-- <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">ห้องเรียนทางไกล</button> --}}
											  <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">ห้องเรียนเสมือน</button>
											</div>
										</nav>
										  <div class="tab-content" id="nav-tabContent">
											<div class="tab-pane show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0"><table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
												<thead>
													<tr>
														<th class="checkbox-column" id="chk"><input class="select-on-check-all" type="checkbox" value="1" name="chk_all" id="chk_all"></th>
															<th id="News-grid_c2"><a class="sort-link" style="color:white;" href="/admin/index.php/news/index?News_sort=cms_title">ชื่อห้องเรียน</a></th>
															<th id="News-grid_c3"><a class="sort-link" style="color:white;" href="/admin/index.php/news/index?News_sort=cms_short_title">วัน/เดือน/ปี</a></th>
															<th id="News-grid_c3"><a class="sort-link" style="color:white;" href="/admin/index.php/news/index?News_sort=cms_short_title">ระยะเวลา(วัน)</a></th>
															<th id="News-grid_c3"><a class="sort-link" style="color:white;" href="/admin/index.php/news/index?News_sort=cms_short_title">ห้องเรียน</a></th>
															<th id="News-grid_c3"><a class="sort-link" style="color:white;" href="/admin/index.php/news/index?News_sort=cms_short_title">สถานะ</a></th>
															<th class="button-column" id="News-grid_c4">จัดการ</th>
													</tr>
												</thead>
												<tbody>
													@foreach ($zoom as $item)
													@if($item->active === 'y')
													<?php
													$numberOfDays = $item->duration;
													$date_now = now('Asia/Bangkok');
													$newDate = date('Y-m-d', strtotime($item->start_date . ' + ' . $numberOfDays . ' days'));
													?>
													<tr class="odd selectable">
														<td class="checkbox-column"><input class="select-on-check" value="78" id="chk_0" type="checkbox" name="chk[]"></td>
														<td width="110">{{$item->title}}</td>
														<td style="width:150px; vertical-align:top;">{{$item->start_date}}</td>
														{{-- <td style="width:150px; vertical-align:top;">{{$timeInFuture = time() + $item->duration}}</td> --}}
														
														<td >{{$item->duration}}</td>
														@if($date_now > $newDate)
														<td width="100px"><a class="btn btn-primary btn-icon" href="#">หมดเวลาเข้าร่วมห้องเรียน</a></td>
														@else
														<td width="100px"><a class="btn btn-success btn-icon" href="{{$item->join_url}}">เข้าร่วมห้องเรียน</a></td>
														@endif
	
														@if($date_now > $newDate)
													   
														<td width="90px" class="btn btn-secondary btn-icon" href="">สี้นสุดการสอน</td>
														@else
															<td width="90px" class="btn btn-success btn-icon" href="">มีการเรียนการสอน</td>
														  
														  @endif
														{{-- <td style="width: 90px;" class="center"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="{{route('classroom_edit',$item->id)}}"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="{{route('classroom_delete',$item->id)}}"><i></i></a></td> --}}
														  <td style="width: 90px;" class="center"><i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="{{route('classroom_edit',$item->id)}}"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="{{route('classroom_delete',$item->id)}}"><i></i></a></td>
													</tr>
													@endif
													@endforeach
												</tbody>
											</table></div>
										  </div>
									</div>
								</div>
							</div>
						</div>
						<!-- Options -->
						
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
@endsection