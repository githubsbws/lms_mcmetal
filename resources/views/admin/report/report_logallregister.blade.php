@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Position;
@endphp
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
				<!-- breadcrumbs -->
				<div class="separator bottom"></div>
				<div class="innerLR">
					<!-- Box -->
					<div class="hero-unit well">
						<div class="widget" data-toggle="collapse-widget" data-collapse-closed="true">
							<div class="widget-head">
								<h4 class="heading  glyphicons search"><i></i>ค้นหาขั้นสูง</h4>
								<span class="collapse-toggle"></span>
							</div>
							<div class="widget-body collapse" style="height: 0px;">
								<div class="search-form">
									<div class="wide form">
										<form id="SearchFormAjax" action="{{route('report.search')}}" method="get">
											<div class="row"><label>ชื่อ - นามสกุล </label><input class="span6" name="fname"  type="text" maxlength="255"></div>
											<div class="row"><label>ตำแหน่ง</label>
												@php
													$po = Position::get();
												@endphp
												<select name="position" id="position">
													@foreach($po as $p)
														<option value="{{$p->id}}">{{$p->position_title}}</option>
													@endforeach
												</select>
											</div>
											<div class="row"><button class="btn btn-primary btn-icon glyphicons search"><i></i> ค้นหา</button></div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<hr class="separator">
						<!-- Row -->
						<div class="overflow-table">
							<div style="margin-top: -1px;" id="Vdo-grid" class="grid-view">
								<table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
									<thead>
										<tr>
											<th class="checkbox-column" id="chk"><input class="select-on-check-all" type="checkbox" value="1" name="chk_all" id="chk_all"></th>
											<th id="Vdo-grid_c1"><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_title">ชื่อ</a></th>
											<th id="Vdo-grid_c2"><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_path">นามสกุล</a></th>
											<th id="Vdo-grid_c2"><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_path">ตำแหน่ง</a></th>
											<th id="Vdo-grid_c2"><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_path">วันที่อนุมัติ</a></th>
											<th id="Vdo-grid_c2"><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_path">ผู้อนุมัติ</a></th>
										</tr>
									</thead>
									<tbody>
										
										<tr class="odd selectable">
											@foreach ($report as $item)
											@php
											$position = Position::where('id',$item->position_id)->first();
											@endphp
											<td class="checkbox-column"><input class="select-on-check" value="" id="chk_0" type="checkbox" name="chk[]"></td>
											<td>{{$item->firstname}}</td>
											<td>{{$item->lastname}}</td>
											<td>{{$position->position_title}}</td>
											<td>{{$item->confirm_date}}</td>
											<td>{{$item->confirm_user}}</td>
											@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
						<!-- // Row END -->

					</div>
					<!-- // Box END -->
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
