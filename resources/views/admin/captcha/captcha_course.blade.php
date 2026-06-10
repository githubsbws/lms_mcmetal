@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Course;

@endphp
<body class="">
					<div class="widget" style="margin-top: -1px;">
						<div class="widget-head">
							<h4 class="heading glyphicons show_thumbnails_with_lines"><i></i> หลักสูตรที่เรียน</h4>
						</div>
						<div class="widget-body">
							<div class="clear-div"></div>
							<div class="overflow-table">
								<div style="margin-top: -1px;" id="Grouptesting-grid" class="grid-view">
								<form id="scoreForm" action="{{route('captcha_course_insert',['id',$cap_id])}}" method="POST">
									@csrf
									<input type="hidden" name="id" value="{{$cap_id}}">
									<table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
										<thead>
											<tr>
												<th class="checkbox-column" id="chk"></th>
												<th id="Grouptesting-grid"><a class="sort-link" style="color:white;">ชื่อหลักสูตรออนไลน์</a></th>
											</tr>
										</thead>
										<tbody>
											@php
											$course = Course::where('active','y')->get();
											@endphp
											@foreach ($course as $courses)
											@php
												if($courses->course_point == $capt->capid){
													$isChecked ='checked';
												}else{
													$isChecked = '';
												}
											@endphp
											<tr class="odd selectable">
												<td width="20" class="checkbox-column">
													<input class="select-on-check" value="{{ $courses->course_id }}" id="chk_course_{{ $loop->iteration }}" type="checkbox" name="chk[]" {{ $isChecked }}>
		
													<input type="hidden" name="chk_unchecked[]" value="{{ $courses->course_id }}" {{ $isChecked }}>
												</td>
												<td width="110">{{ $courses->course_title }}</td>            
											</tr>
										</tbody>
										
										@endforeach
									</table>
									<br>
									<br>
									<div class="row buttons">
										<button id="openModalButton" class="btn btn-primary btn-icon glyphicons ok_2"><i></i>บันทึกข้อมูล</button>
									</div>
								</form>
								</div>
							</div>
						</div>
					</div>
		</div>	
		
</body>
@endsection