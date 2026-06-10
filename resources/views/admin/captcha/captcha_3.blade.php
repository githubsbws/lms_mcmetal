@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Course;
use App\Models\Captcha;
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
						<ul class="breadcrumb">
							<li><a href="{{route('admin')}}">หน้าหลัก</a></li> » <li>ระบบเกี่ยวกับเรา</li>
						</ul><!-- breadcrumbs -->
						<div class="separator bottom"></div>
						
						
						<div class="innerLR">
							<div class="widget" style="margin-top: -1px;">
								<div class="widget-head">
									<h4 class="heading glyphicons show_thumbnails_with_lines"><i></i> จัดการระบบCaptcha</h4>
								</div>
								<a type="button" class="btn btn-primary" href="{{route('captcha_create')}}">เพิ่มแคปช่า</a>
								<div class="widget-body">
									<div class="separator bottom form-inline small">
										<span class="pull-right">
											<label class="strong">แสดงแถว:</label>
											<select class="selectpicker" data-style="btn-default btn-small" onchange="$.updateGridView('about-grid', 'news_per_page', this.value)" name="news_per_page" id="news_per_page" style="display: none;">
												<option value="">ค่าเริ่มต้น (10)</option>
												<option value="10">10</option>
												<option value="50">50</option>
												<option value="100">100</option>
												<option value="200">200</option>
												<option value="250">250</option>
											</select>
										</span>
									</div>
									<div class="clear-div"></div>
									<div class="overflow-table">
										
										<div style="margin-top: -1px;" id="about-grid" class="grid-view">
											<table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
												<thead>
													<tr>
														<th class="checkbox-column" id="chk"><input class="select-on-check-all" type="checkbox" value="1" name="chk_all" id="chk_all"></th>
														<th id="about-grid_c1"><a class="sort-link" style="color:white;" href="/admin/index.php/about/index?About_sort=about_title">ลำดับ</a>
														</th>
														<th id="about-grid_c1"><a class="sort-link" style="color:white;" href="/admin/index.php/about/index?About_sort=about_title">ชื่อเงื่อนไข</a>
														</th>
														<th id="about-grid_c1"><a class="sort-link" style="color:white;" href="/admin/index.php/about/index?About_sort=about_title">ชื่อหลักสูตร</a>
														</th>
														<th id="about-grid_c1"><a class="sort-link" style="color:white;" href="/admin/index.php/about/index?About_sort=about_title">เลือกหลักสูตร</a>
														</th>
														<th id="about-grid_c1"><a class="sort-link" style="color:white;" href="/admin/index.php/about/index?About_sort=about_title">สถานะ</a>
														</th>
														<th class="button-column" id="about-grid_c2">จัดการ</th>
													</tr>
												</thead>
												<tbody>
													@foreach($captcha as $cap)
													@php
												$course = Course::where('course_point',$cap->capid)->get();
												$dataId = $cap->capid;
												@endphp
												<tr class="items[]_2">
													<td class="checkbox-column"><input class="select-on-check" value="{{$cap->capid}}" id="chk_{{$loop->iteration}}" type="checkbox" name="chk[]"></td>
													<td>{{$cap->capid}}</td>
													<td>{{$cap->capt_name}}</td>
													<td>
														@if(count($course) > 0)
														@foreach($course as $c)
														{{$c->course_title}}
														@endforeach
														@else
														ยังไม่ได้เลือกหลักสูตร
														@endif
													</td>
													<td style="width:450px; vertical-align:top;">
														<button type="button" class="btn btn-primary" data-id="{{ $cap->capid }}" data-toggle="modal" data-target=".bd-example-modal-lg">เลือกหลักสูตร</button>
													</td>
													@if($cap->capt_active == 'y')
													<td><a class="btn btn-success btn-icon" href="{{route('captcha_n', ['capid' => $cap->capid,'capt_active' => "n"])}}">เปิด</a></td>
													@else
													<td><a class="btn btn-dark btn-icon" href="{{route('captcha_y', ['capid' => $cap->capid,'capt_active' => "y"])}}">ปิด</a></td>
													@endif
													<td style="width: 90px;" class="center">
														<a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="{{route('captcha_detail',$cap->capid)}}"><i></i></a>
														<a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="{{route('captcha_edit',$cap->capid)}}"><i></i></a>
														<a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="{{route('captcha_delete',$cap->capid)}}"><i></i></a>
													</td>
												</tr>
												@endforeach
											</tbody>
										</table>
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
			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="z-index:10001" hidden>
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h3>Modal header</h3>
						</div>
						<form id="scoreForm" action="{{route('captcha.course')}}" method="POST">
							@csrf
							<div class="modal-body">
								<table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
									<thead>
										<tr>
											<th class="checkbox-column" id="chk"> ทั้งหมด</th>
											<th id="News-grid_c2"><a class="sort-link" style="color:white;">ชื่อหลักสูตร</a></th>
										</tr>
									</thead>
									<tbody>
										@foreach ($courseOnline as $courses)
										
										<tr class="odd selectable">
											<td width="20" class="checkbox-column">
												<input class="select-on-check" value="{{ $courses->course_id }}" id="chk_course_{{ $loop->iteration }}" type="checkbox" name="chk[]" {{ $courses->course_point  ? 'checked' : '' }}>
												
												<input type="hidden" name="chk_unchecked[]" value="{{ $courses->course_id }}" {{ $courses->course_point ? '' : 'checked' }}>
											</td>
											<td width="110">{{ $courses->course_title }}</td>            
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<input type="hidden" name="data-id" id="dataIdField">
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
							</div>
						</form>
					</div>
				</div>
			</div>
	<script>
		// เมื่อคลิกที่ปุ่ม
		document.querySelectorAll('.btn-primary[data-toggle="modal"]').forEach(function(button) {
			button.addEventListener('click', function() {
				// ดึงค่า ID จากแอตทริบิวต์ data-id ของปุ่มที่ถูกคลิก
				var id = this.getAttribute('data-id');
				// กำหนดค่า ID ลงในฟิลด์ซ่อน
				document.getElementById('dataIdField').value = id;
				// กำหนดค่า ID ลงในแอตทริบิวต์ action ของฟอร์ม
				document.getElementById('scoreForm').action = '{{route("captcha.course")}}';
			});
		});
		$(document).ready(function(){
			// เมื่อคลิกที่ปุ่ม "เลือกหลักสูตร"
			$(".open-modal").click(function(){
				// ดึงค่า data-id จากปุ่ม
				var dataId = $(this).data("id");
				// เปิด modal ที่เกี่ยวข้องโดยใช้ data-id เป็นเงื่อนไข
				$(".modal[data-id='" + dataId + "']").modal("show");
			});
		});
	</script>
</body>

@endsection