@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Profiles;
use App\Models\Division;
use App\Models\Company;
use App\Models\Learn;
use App\Models\Orgcourse;
use App\Models\Course;
use App\Models\Score;
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
										<form id="SearchFormAjax" action="{{route('report.byusersearch')}}" method="get">
											<div class="row">
												<label>username</label>
												<input class="span6" name="fname" type="text" maxlength="255">
											</div>
											{{-- <div class="row">
												<label>บริษัท</label>
												<select name="company" id="company">
													<option value=""></option>
													@foreach($company as $com)
														<option value="{{$com->company_id}}">{{$com->company_title}}</option>
													@endforeach
												</select>
											</div>
											<div class="row">
												<label>แผนก</label>
												<select name="division" id="division">
													<option value=""></option>
													@foreach($division as $div)
														<option value="{{$div->id}}">{{$div->dep_title}}</option>
													@endforeach
												</select>
											</div> --}}
											<div class="row">
												<button type="submit" class="btn btn-primary btn-icon glyphicons search"><i></i> ค้นหา</button>
											</div>
											<br>
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
											<th><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_title">บริษัท</a></th>
											<th><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_path">แผนก</a></th>
											<th><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_path">แบบทดสอบก่อนเรียน</a></th>
											<th><a class="sort-link" style="color:white;" href="/admin/index.php/vdo/index?Vdo_sort=vdo_path">บทเรียน</a></th>
										</tr>
									</thead>
									<tbody>
										@foreach ($user as $item)
											@php
												$profile = Profiles::find($item->id);
												$companys = Company::find($item->company_id);
												$divisions = Division::find($item->division_id);
												$learn = Learn::where('user_id', $item->id)->get();
												$orgcourseCount = Orgcourse::where('active', 'y')->count();
												$learnCourseCounts = $learn->groupBy('course_id')->map->count();
												$courseIds = $learn->pluck('course_id')->unique();
												$courses = Course::whereIn('course_id', $courseIds)->get(['course_id','course_title']);
											@endphp
											<tr class="odd selectable">
												<td class="checkbox-column"><input class="select-on-check" value="" id="chk_0" type="checkbox" name="chk[]"></td>
												<td>{{ $item->username }}</td>
												@if($profile != null)
												<td>{{ $profile->firstname }} {{ $profile->lastname }}</td>
												@else
												<td> - </td>
												@endif
												<td>{{ $companys ? $companys->company_title : '-' }}</td>
												<td>{{ $divisions ? $divisions->dep_title : '-' }}</td>
												<td>

												</td>
												{{-- <td>
													<a href="#" onclick="showSweetAlert('{{ json_encode($learnCourseCounts) }}', '{{ json_encode($courses) }}')" class="btn btn-{{ $learn->isNotEmpty() ? 'success' : 'dark' }}">หลักสูตร</a>
												</td>
												<td>{{ $learnCourseCounts->count() }}  / {{ $orgcourseCount }}</td> --}}
											</tr>
										@endforeach

										{{-- <script>
											function showSweetAlert(learnCourseCounts, courses) {
											var coursesCount = JSON.parse(learnCourseCounts);
											var coursesData = JSON.parse(courses);
											var message = '';

											for (var courseId in coursesCount) {
												var courseCount = coursesCount[courseId];
												var course = coursesData.find(course => course.course_id == courseId);
												if (course) {
													message += '<div>' + course.course_title +'</div>';
												}
												else {
													message += '<div>Unknown Course </div>';
												}
											}

											swal({
												title: "หลักสูตรที่เรียน",
												content: {
													element: "div",
													attributes: {
														innerHTML: message
													}
												},
												buttons: true,
											});
										}
										</script> --}}
									
									</tbody>
								</table>
								@if($user != null && $user->count() > 0)
									<div class="pagination pull-right">
										<ul class="pagination margin-top-none" id="yw0">
											<li class="first"><a href="{{url('report_byuser')}}">&lt;&lt; หน้าแรก</a></li>
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
												<li class="last"><a href="{{ url('report_byuser?page='.$user->lastPage()) }}" class="pagination-link">หน้าสุดท้าย &gt;&gt;</a></li>
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
