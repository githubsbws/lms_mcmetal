@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Profiles;
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
							
								<div class="search-form">
									<div class="wide form">
										<form id="SearchFormAjax" action="{{route('report.usersearch')}}" method="get">
											<div class="row"><label>ชื่อ - นามสกุล </label><input class="span6" name="fname"  type="text" maxlength="255"></div>
											<div class="row"><label>อีเมลล์</label><input class="span6" name="email"  type="text" maxlength="255"></div>
											<div class="row"><button class="btn btn-primary btn-icon glyphicons search"><i></i> ค้นหา</button></div><br>
										</form>
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
											<th><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_title">username</a></th>
											<th><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_title">ชื่อ</a></th>
											<th><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_path">นามสกุล</a></th>
											<th><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_path">firstname</a></th>
											<th><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_path">lastname</a></th>
											<th><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_path">e-mail</a></th>
										</tr>
									</thead>
									<tbody>
									@if($user != null)
										@foreach ($user as $item)
										<tr class="odd selectable">
											
											<td class="checkbox-column"><input class="select-on-check" value="" id="chk_0" type="checkbox" name="chk[]"></td>
											<td>{{$item->username}}</td>
											<td>{{$item->firstname}}</td>
											<td>{{$item->lastname}}</td>
											<td>{{$item->firstname_en}}</td>
											<td>{{$item->lastname_en}}</td>
											<td>{{$item->email}}</td>
											
										</tr>
										@endforeach
									@else

									@endif
									</tbody>
								</table>
								@if($user != null && $user->count() > 0)
									<div class="pagination pull-right">
										<ul class="pagination margin-top-none" id="yw0">
											<li class="first"><a href="{{url('report_loguserstatus')}}">&lt;&lt; หน้าแรก</a></li>
											@if ($user->currentPage() > 1)
												<li class="previous"><a href="{{ $user->previousPageUrl() }}" class="pagination-link">หน้าที่แล้ว</a></li>
											@endif
											@for ($i = max(1, $user->currentPage() - 3); $i <= min($user->lastPage(), $user->currentPage() + 3); $i++)
												<li class="page"><a href="{{ $user->url($i) }}" class="pagination-link {{ ($i == $user->currentPage()) ? 'active' : '' }}">{{ $i }}</a></li>
											@endfor
											@if ($user->currentPage() < $user->lastPage())
												<li class="next"><a href="{{ $user->nextPageUrl() }}" class="pagination-link">หน้าถัดไป</a></li>
											@endif
											@if ($user->currentPage() < $user->lastPage())
												<li class="last"><a href="{{ url('report_loguserstatus?page='.$user->lastPage()) }}" class="pagination-link">หน้าสุดท้าย &gt;&gt;</a></li>
											@endif
										</ul>
									</div>
								@else
									<!-- แสดงข้อความหรือรูปแบบอื่น ๆ เมื่อไม่มีข้อมูลผู้ใช้ -->
								@endif
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
