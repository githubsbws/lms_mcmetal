@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php

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
.license-box{
    width: 24px;
    height: 24px;
    display: inline-flex;
    align-items: center;
    justify-content: center;

    margin-right: 5px;
    background: transparent;
    border: none;
    font-size: 20px;
}

/* icon color */
.license-lp3{
    color: #28a745; /* เขียว */
}

.license-lp2{
    color: #ffc107; /* เหลือง */
}

.license-lp1{
    color: #dc3545; /* แดง */
}

.license-na{
    color: #bdbdbd; /* เทา */
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
							<h4 class="m-0">License Person Report</h4>
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

									<div class="col-md-3 d-flex align-items-end">

										<button type="submit" class="btn btn-primary mr-2">
											<i class="fa fa-search me-1"></i> ค้นหา
										</button>

										<a href="{{ route('report.license') }}"
											class="btn btn-secondary mr-2">
											Reset
										</a>

										<a href="{{ route('report.license.export', request()->query()) }}"
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

								<span class="license-box license-lp3">
									<i class="far fa-check-square"></i>
								</span>
								LP3 - Qualified
								<small class="text-muted">
									(80–100% : ผ่านเกณฑ์รับรองว่าสามารถปฏิบัติงานได้)
								</small>

								<span class="license-box license-lp2 ml-4">
									<i class="fas fa-exclamation-triangle"></i>
								</span>
								LP2 - Under Supervision
								<small class="text-muted">
									(60–79% : ปฏิบัติงานได้โดยมีผู้ควบคุม)
								</small>

								<span class="license-box license-lp1 ml-4">
									<i class="fas fa-times"></i>
								</span>
								LP1 - Not Qualified (In Training)
								<small class="text-muted">
									(0–59% : ยังต้องพัฒนาทักษะ)
								</small>

								<span class="license-box license-na ml-4"></span>
								N/A
								<small class="text-muted">
									(ไม่เกี่ยวข้องกับหน้าที่)
								</small>

							</div>
							<table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
								 <thead>

									<tr>
										<th rowspan="2">No.</th>
										<th rowspan="2">ชื่อ - สกุล</th>
										<th rowspan="2">รหัสพนักงาน</th>
										<th rowspan="2">ตำแหน่ง</th>
										<th rowspan="2">ทีม</th>
										<th colspan="{{ count($operateMachines) }}">
											Operate Machine
										</th>

										<th colspan="{{ count($parameterSettings) }}">
											Parameter Setting
										</th>
									</tr>

									<tr>

										@foreach($operateMachines as $machine)
											<th>{{ $machine->operation_name }}</th>
										@endforeach

										@foreach($parameterSettings as $setting)
											<th>{{ $setting->parameter_name }}</th>
										@endforeach

									</tr>

								</thead>
								<tbody>
									@foreach($users as $index => $user)
									@php
									$userLicenses = $licenses[$user->id] ?? collect();

									$operateMap = $userLicenses
										->whereNotNull('operation_machine_id')
										->keyBy('operation_machine_id');

									$parameterMap = $userLicenses
										->whereNotNull('parameter_setting_id')
										->keyBy('parameter_setting_id');
									@endphp
									<tr>
										<td>{{ $index+1 }}</td>
										<td>{{ $user->firstname }} {{ $user->lastname }}</td>
										<td>{{ $user->username }}</td>
										<td>{{ $user->Orgchart->title ?? '-' }}</td>
										<td>{{ $user->Team->name ?? '-' }}</td>

											@foreach($operateMachines as $machine)

											@php
											$license = $operateMap[$machine->id] ?? null;
											@endphp

											<td class="
												@if(!$license)
													license-na
												@elseif($license->license_level == 3)
													license-lp3
												@elseif($license->license_level == 2)
													license-lp2
												@else
													license-lp1
												@endif
												">

												@if($license)

													@if($license->license_level == 3)
														<span class="license-box license-lp3">
															<i class="far fa-check-square"></i>
														</span>
													@elseif($license->license_level == 2)
														<span class="license-box license-lp2 ml-4">
															<i class="fas fa-exclamation-triangle"></i>
														</span>
													@else
														<span class="license-box license-lp1 ml-4">
															<i class="fas fa-times"></i>
														</span>
													@endif

												@endif

											</td>

											@endforeach
											@foreach($parameterSettings as $setting)

												@php
												$license = $parameterMap[$setting->id] ?? null;
												@endphp

												<td class="
													@if(!$license)
														license-na
													@elseif($license->license_level == 3)
														license-lp3
													@elseif($license->license_level == 2)
														license-lp2
													@else
														license-lp1
													@endif
												">

													@if($license)

														@if($license->license_level == 3)
															<span class="license-box license-lp3">
																<i class="far fa-check-square"></i>
															</span>
														@elseif($license->license_level == 2)
															<span class="license-box license-lp2 ml-4">
																<i class="fas fa-exclamation-triangle"></i>
															</span>
														@else
															<span class="license-box license-lp1 ml-4">
																<i class="fas fa-times"></i>
															</span>
														@endif

													@endif

												</td>

											@endforeach
									</tr>
									@endforeach
								</tbody>
							</table>
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
		// Initialize DataTable
		$('#settingTable').DataTable({
			ordering: false,
			responsive: true,
			scrollX: true,
			paging: false,
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

                url: '/get-lines-license/' + sectionId,
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
