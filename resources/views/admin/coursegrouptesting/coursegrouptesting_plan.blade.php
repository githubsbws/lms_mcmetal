@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Grouptesting;
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
						<li><a href="/admin/index.php">หน้าหลัก</a></li> » <li>ระบบชุดข้อสอบหลักสูตร</li>
					</ul><!-- breadcrumbs -->
					<div class="separator bottom"></div>
	
					<div class="innerLR">
						<div class="widget" data-toggle="collapse-widget" data-collapse-closed="false">
							<div class="row">
								<label for="Grouptesting_lesson_id" class="required">ชื่อข้อสอบหลักสูตร <span class="required">*</span></label>
								<select class="span8" name="group_id" id="Grouptesting_lesson_id">
									@foreach ($course_group as $item)
									<option value="{{ $item->group_id }}" data-id="{{ $item->group_id }}">{{ $item->group_title }}</option>
									@endforeach
								</select>
								<span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
								<div class="error help-block">
									<div class="label label-important" id="Grouptesting_lesson_id_em_" style="display:none"></div>
								</div>
							</div>
							<div class="row buttons">
								<button onclick="showSweetAlert()" class="btn btn-primary btn-icon glyphicons ok_2"><i></i>บันทึกข้อมูล</button>
							</div>
							<script>
								function showSweetAlert() {
									var selectedOption = document.getElementById("Grouptesting_lesson_id");
									var selectedId = selectedOption.options[selectedOption.selectedIndex].getAttribute("data-id");
	
									var url = "{{ route('coursegrouptesting.plan', ['id' => ':selectedId']) }}";
									url = url.replace(':selectedId', selectedId);
									var csrf_token = "{{ csrf_token() }}";
									// ตรวจสอบว่าเลือก option ได้หรือไม่
									if (selectedId) {
										swal({
											title: "ต้องการเพิ่มข้อสอบใช่หรือไม่?",
											icon: "info",
											buttons: true,
											dangerMode: true,
										}).then((willDelete) => {
											if (willDelete) {
												fetch(url, {
													method: 'POST',
													headers: {
														'X-CSRF-TOKEN': csrf_token,
														'Content-Type': 'application/json',
														'Accept': 'application/json'
													},
													body: JSON.stringify({ id: selectedId })
												})
												.then(response => response.json())
												.then(data => {
													console.log(data);
													swal("เพิ่มข้อสอบเรียบร้อย!", {
														icon: "success",
													}).then(results => {
														location.reload();
													});
												})
												.catch(error => {
													swal("Oops!", "เกิดข้อผิดพลาดในการเพิ่มข้อสอบ!", "error");
												});
											} else {
												swal("ยกเลิกการเพิ่มข้อสอบ!");
											}
										});
									} else {
										// ถ้าไม่มี option ที่ถูกเลือก
										swal("กรุณาเลือกเพิ่มข้อสอบ!");
									}
								}
							</script>
						</div>
						<div class="widget" style="margin-top: -1px;">
							<div class="widget-head">
								<h4 class="heading glyphicons show_thumbnails_with_lines"><i></i> ระบบชุดข้อสอบหลักสูตร</h4>
							</div>
							<div class="widget-body">
								
								<div class="clear-div"></div>
								<div class="overflow-table">
									<div style="margin-top: -1px;" id="Grouptesting-grid" class="grid-view">
										<table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
											<thead>
												<tr>
													<th class="checkbox-column" id="chk"><input class="select-on-check-all" type="checkbox" value="1" name="chk_all" id="chk_all"></th>
													<th id="Grouptesting-grid"><a class="sort-link" style="color:white;" href="/admin/index.php/grouptesting/index?Grouptesting_sort=lesson_id">หัวข้อหลักสูตร</a></th>
													<th id="Grouptesting-grid"><a class="sort-link" style="color:white;" href="/admin/index.php/grouptesting/index?Grouptesting_sort=group_title">ชื่อชุดข้อสอบหลักสูตร</a></th>
													
												</tr>
											</thead>
											<tbody>
												@foreach ($course_group_active as $item)
												<tr class="odd selectable">
													<td class="checkbox-column"><input class="select-on-check" value="254" id="chk_0" type="checkbox" name="chk[]"></td>
													<td>{{ $item->course_title}}</td>
													<td>{{($item->group_title) }}</td>					
													
												</tr>
											</tbody>
											
											@endforeach
										</table>
										
										<div class="keys" style="display:none" title="/admin/index.php/coursegrouptesting/index"><span>254</span><span>253</span><span>249</span><span>248</span><span>247</span><span>246</span><span>245</span><span>244</span><span>243</span><span>242</span></div>
										<input type="hidden" name="Grouptesting[news_per_page]" value="">
									</div>
								</div>
							</div>
						</div>
	
						<!-- Options -->
						<div class="separator top form-inline small">
							<!-- With selected actions -->
							
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
@endsection