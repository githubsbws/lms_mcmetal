@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('hidesidebar', true)
@section('content')
@php
use App\Models\Course;
use App\Models\Lesson;
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
								<form id="scoreForm" action="{{ route('learnreset.course',['id' => $id]) }}" method="POST">
									@csrf
									<table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
										<thead>
											<tr>
												<th class="checkbox-column" id="chk"></th>
												<th id="Grouptesting-grid"><a class="sort-link" style="color:white;" href="/admin/index.php/grouptesting/index?Grouptesting_sort=lesson_id">ชื่อหลักสูตรออนไลน์</a></th>
												<th id="Grouptesting-grid"><a class="sort-link" style="color:white;" href="/admin/index.php/grouptesting/index?Grouptesting_sort=group_title">ชื่อบทเรียนออนไลน์</a></th>
											</tr>
										</thead>
										<tbody>
											@foreach ($learn as $item)
											@php
											$course = Course::where('course_id',$item->course_id)->first();
											$lesson = Lesson::where('id',$item->lesson_id)->first();
											@endphp
											<tr class="odd selectable">
												<td class="checkbox-column"><input class="select-on-check" value="{{ $item->learn_id}}" id="chk_0" type="checkbox" name="chk[]"></td>
												@if($course != null)
												<td style="width:230px">{!! htmlspecialchars_decode($course->course_title) !!}</td>
												@else
												<td style="width:230px">-</td>
												@endif
												@if($lesson != null)
												<td>{!! htmlspecialchars_decode($lesson->title) !!}</td>
												@else
												<td>-</td>
												@endif
											</tr>
										</tbody>
										
										@endforeach
									</table>
									<br>
									<br>
									<div>
										<input type="text" id="inputData" name="inputData" class="form-control" placeholder="หมายเหตุ...">
									</div>
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