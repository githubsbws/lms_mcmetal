@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Learn;
use App\Models\Lesson;
use App\Models\Course;

function getSkillLevel($percent) {
    if ($percent == 100) return 5;
    if ($percent >= 80) return 4;
    if ($percent >= 60) return 3;
    if ($percent >= 25) return 2;
    if ($percent >= 0) return 1;
    return 0;
}
@endphp
<style>
	#settingTable thead th {
    position: sticky;
    top: 0;
    z-index: 10;
    background: white;
}
.skill-icon {
    width: 22px;
    height: 22px;
    border-radius: 50%;
    display: inline-block;
    border: 1px solid #999;
}

.group-header {
    background: yellow;
    text-align: center;
    font-weight: bold;
}
thead th[rowspan] {
    vertical-align: middle !important;
    text-align: center;
}
th.rotate {
    height: 180px;
	width: 60px;
	position: relative;
	text-align: center;
    vertical-align: middle;
	border: 1px solid #ccc;
    padding: 0;
	min-width: 70px;
    max-width: 70px;
}

th.rotate > div {
	position: absolute;
	top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-90deg);
    transform-origin: center;
    white-space: nowrap;
}

/* Skill 5 ⭐ */
.skill-5 {
    background: transparent;
    clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%,
                       79% 91%, 50% 70%, 21% 91%, 32% 57%,
                       2% 35%, 39% 35%);
}

/* Skill 4 ● */
.skill-4 {
    background: #333;
}

/* Skill 3 ◕ */
.skill-3 {
    background: conic-gradient(#333 75%, #eee 0%);
}

/* Skill 2 ◑ */
.skill-2 {
    background: conic-gradient(#333 50%, #eee 0%);
}

/* Skill 1 ◔ */
.skill-1 {
    background: conic-gradient(#333 25%, #eee 0%);
}

/* N/A */
.skill-0 {
    background: #ccc;
}
</style>
<body class="">
	<div id="wrapper">
		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="d-flex align-items-center">
						<div class="">
							<h4 class="m-0">Skill Matrix Visual Report</h4>
						</div>
						<div class="ml-3">
							<a href="{{route('admin')}}">
								<button class="btn btn-warning d-flex align-items-center">
									<i class="fas fa-angle-left mr-2"></i>
									หน้าหลัก
								</button>
							</a>
						</div>
					</div>
					<div class="card m-2">
                        <div class="card-header">
                            {{-- <span class="badge badge-primary px-3 py-2 ml-1 shadow-sm" style="font-size: 1rem; border-radius: 8px; background: linear-gradient(45deg, #007bff, #0056b3);" data-id="{{ $departments->id }}">
                                    <i class="fas fa-building mr-1"></i> {{ $departments->title }}
                                </span> --}}
                            <form method="GET" action="">
								<div class="row mb-3">
									<div class="col-md-2">
										<label>หมวดหลักสูตร</label>

										<select name="cate_id" class="form-control">
											<option value="">--เลือกหมวกหลักสูตร--</option>

											@foreach($categories as $category)
												<option value="{{ $category->cate_id }}"
													{{ $cate_id == $category->cate_id ? 'selected' : '' }}>
													{{ $category->cate_title }}
												</option>
											@endforeach
										</select>
									</div>

									<div class="col-md-2">
										<label>Section</label>
										<select name="section_id"  id="section_id" class="form-control">
											<option value="">--ทั้งหมด--</option>

											@foreach($sections as $section)
												<option value="{{ $section->id }}"
													{{ $section_id == $section->id ? 'selected' : '' }}>
													{{ $section->title }}
												</option>
											@endforeach
										</select>
									</div>

									<div class="col-md-2">
										<label>Line</label>
										<select name="line_id" id="line_id" class="form-control">
											<option value="">--ทั้งหมด--</option>

											@foreach($lines as $line)
												<option value="{{ $line->id }}"
													{{ $line_id == $line->id ? 'selected' : '' }}>
													{{ $line->title }}
												</option>
											@endforeach
										</select>
									</div>

									<div class="col-md-2">
										<label>ค้นหาทีม</label>
										<select name="team_id" class="form-control">
											<option value="">--ทั้งหมด--</option>

											@foreach($teams as $team)
												<option value="{{ $team->id }}"
													{{ $team_id == $team->id ? 'selected' : '' }}>
													{{ $team->name }}
												</option>
											@endforeach
										</select>
									</div>

									<div class="col-md-4 d-flex align-items-end">
										<button class="btn btn-primary mr-2">
											<i class="fa fa-search me-1"></i> ค้นหา
										</button>

										<a href="{{ route('report.user') }}"
										class="btn btn-secondary mr-2">
											Reset
										</a>

										<a href="{{ route('report.user.export', request()->query()) }}"
										class="btn btn-success">
											Export Excel
										</a>
									</div>

								</div>
							</form>
                        </div>
                    </div>
				</div>
			</div>
			<div class="content">
				<div class="container-fluid">
					<div class="card m-0">
						<div class="card-body">
							<div class="mb-3">
								<span class="skill-icon skill-1"></span> Beginner
								<span class="skill-icon skill-2 ml-3"></span> Training
								<span class="skill-icon skill-3 ml-3"></span> Under Supervision
								<span class="skill-icon skill-4 ml-3"></span> Standard
								<span class="ml-3">⭐ Expert</span>
							</div>
							@if($cate_id)
							<table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
								 <thead>
									<tr>
										<th rowspan="2">No.</th>
										<th rowspan="2">ชื่อ - สกุล</th>
										<th rowspan="2">รหัสพนักงาน</th>
										<th rowspan="2">ตำแหน่ง</th>
										<th rowspan="2">ทีม</th>
										<th rowspan="2">วันที่เริ่มงาน</th>

										<th colspan="{{ $courses->count() }}" class="group-header">
											{{ $categories->where('cate_id', $cate_id)->first()->cate_title ?? '-' }}
										</th>
									</tr>

									<tr>
										@foreach($courses as $course)
											<th class="rotate">
												<div>{{ $course->course_title }}</div>
											</th>
										@endforeach
									</tr>
								</thead>
								<tbody>
									@foreach($users as $index => $user)
									<tr>
										<td>{{ $index+1 }}</td>
										<td>{{ $user->firstname }} {{ $user->lastname }}</td>
										<td>{{ $user->username }}</td>
										<td>{{ $user->Orgchart->title ?? '-' }}</td>
										<td>{{ $user->Team->name ?? '-' }}</td>
										<td>{{ $user->work_start
												? \Carbon\Carbon::parse($user->work_start)->format('d F Y')
												: '-' }}
										</td>
										@foreach($courses as $course)
												@php

													$key = $user->id . '_' . $course->course_id;

													$passCourse = $passCourses->get($key);

													$percent = null;

													if($passCourse){

														$scores = $assessmentScores
															->get($passCourse->passcours_id, collect());

														// รวมคะแนน
														$percent = $scores
															->sum(function($item){
																return (float)$item->score;
															});
													}

													$level = is_null($percent)
														? 0
														: getSkillLevel($percent);
													
												@endphp

												<td class="text-center">
													@if($level == 5)
														⭐
													@else
														<div class="skill-icon skill-{{ $level }}"
														title="
														{{ $percent ?? 'N/A' }}%
														({{ ['','Beginner','Training','Under Supervision','Standard','Expert'][$level] ?? '-' }})
														"></div>
													@endif
												</td>
										@endforeach
									</tr>
									@endforeach
								</tbody>
							</table>
							@else

							<div class="alert alert-info text-center">
								กรุณากดเลือกหลักสูตร | ไม่มีข้อมูล
							</div>

							@endif
						</div>
					</div>
				</div>
			</div>
			<div id="sidebar">
			</div><!-- sidebar -->
		</div>
	</div>
	<div class="clearfix"></div>
<script>
	$(document).ready(function() {
		$('#settingTable').DataTable({
			ordering: false,
			scrollX: true,
			paging: false,
			searching: false,
			info: false,
			responsive: false,
			language: {
				url: '/include/languageDataTable.json',
			}
		});
	});
	$(document).ready(function(){

    $('#section_id').change(function(){

        let sectionId = $(this).val();

        $('#line_id').html(
            '<option value="">--ทั้งหมด--</option>'
        );

        if(sectionId){

            $.ajax({

                url: '/get-lines/' + sectionId,
                type: 'GET',

                success: function(lines){

                    $.each(lines, function(index, line){

                        $('#line_id').append(
                            `<option value="${line.id}">
                                ${line.title}
                            </option>`
                        );

                    });

                }

            });

        }

    });

});
</script>
</body>
@endsection
