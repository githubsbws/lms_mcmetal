@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Course;
use App\Models\Orgcourse;
@endphp
<body class="">
					<div class="widget" style="margin-top: -1px;">
						<div class="widget-head">
							<h4 class="heading glyphicons show_thumbnails_with_lines"><i></i> {{ $course_title }}</h4>
						</div>
						<div class="widget-body">
							<div class="clear-div"></div>
							<div class="overflow-table">
								<div style="margin-top: -1px;" id="Grouptesting-grid" class="grid-view">
								<form id="scoreForm" action="{{ route('orgchart.course',['id' => $id ,'course_title' => $course_title]) }}" method="POST">
									@csrf
									<table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
										<thead>
											<tr>
												<th class="checkbox-column" id="chk"></th>
												<th id="CourseOnline-grid_c1"><a class="sort-link" style="color:white;" href="/admin/index.php/grouptesting/index?Grouptesting_sort=lesson_id">ชื่อหลักสูตรออนไลน์</a></th>
											</tr>
										</thead>
										<tbody>
											@php
												// ดึงหลักสูตรทั้งหมดที่ active อยู่
												$courses = Course::where('active', 'y')->get();

												// ดึงข้อมูลหลักสูตรตาม org_course ปัจจุบัน
												$org_course = Orgcourse::where('id', $id)->first();

												// ดึงหลักสูตรที่ใช้โดย orgchart_id ปัจจุบัน และมี parent_id ตรงกับ id ปัจจุบัน
												$chk_course = Orgcourse::where('orgchart_id', $org_course->orgchart_id)
																	->where('parent_id', $id)
																	->where('active', 'y')
																	->get();

												// ดึง course_id ที่ถูกใช้โดย parent_id อื่น ๆ
												$used_courses = Orgcourse::where('orgchart_id', $org_course->orgchart_id)
																		->where('parent_id', '!=', $id)
																		->where('active', 'y')
																		->pluck('course_id')
																		->toArray();
											@endphp

											@foreach ($courses as $cos)
												@php
													// ตรวจสอบว่าหลักสูตรที่กำลังวนลูปอยู่มีใน chk_course หรือไม่
													$chk_cos = $chk_course->firstWhere('course_id', $cos->course_id);

													// ตรวจสอบว่าหลักสูตรนี้ถูกใช้ใน parent_id อื่น ๆ หรือไม่
													$is_used = in_array($cos->course_id, $used_courses);
												@endphp

												@if($chk_cos && $chk_cos->order !== '1')
													@continue
												@endif

												@if($is_used)
													@continue
												@endif

												<tr class="odd selectable">
													<td class="checkbox-column">
														<input 
															class="select-on-check" 
															value="{{ $cos->course_id }}" 
															id="chk_0" 
															type="checkbox" 
															name="chk[]"
															@if($chk_cos) checked @endif>
													</td>
													
													@if($cos != null)
													<td style="width:230px">{{$cos->course_title}}</td>
													@else
													<td style="width:230px">-</td>
													@endif
												</tr>
											@endforeach
										</tbody>
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