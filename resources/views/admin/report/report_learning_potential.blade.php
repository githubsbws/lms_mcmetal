@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
	<div id="wrapper">
		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="d-flex align-items-center">
						<div class="">
							<h4 class="m-0">Learning Potential Report</h4>
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
                            <span class="badge badge-primary px-3 py-2 ml-1 shadow-sm" style="font-size: 1rem; border-radius: 8px; background: linear-gradient(45deg, #007bff, #0056b3);" data-id="{{ $departments->id }}">
                                    <i class="fas fa-building mr-1"></i> {{ $departments->title }}
                                </span>
                            <form action="" method="GET">  {{-- ส่งกลับค่าfunction เดิมที่ส่งมาที่นี้ --}}
                                <div class="row align-items-end m-3">
                                    <div class="col-md-3">
                                        <label class="form-label">หลักสูตร<span class="text-danger">*</span></label>
                                        <select name="course_id" class="form-control">
                                            @foreach($courses as $course)
                                                <option value="{{ $course->course_id }}" {{ request('course_id') == $course->course_id ? 'selected' : '' }}>
                                                    {{ $course->course_title}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Section</label>
                                        <select name="section_id" id="section_id" class="form-control">
                                            <option value="0">-- ทั้งหมด --</option>
                                            @foreach($sections as $section)
                                                <option value="{{ $section->id }}" {{ request('section_id') == $section->id ? 'selected' : '' }}>
                                                    {{ $section->title}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Line</label>
                                        <select name="line_id" id="line_id" class="form-control">
                                            <option value="0">-- ทั้งหมด --</option>
                                            </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">ค้นหา</label>
                                        <input type="text" name="search" class="form-control"
                                            value="{{ request('search') }}"
                                            placeholder="ค้นหาชื่อ-สกุล หรือ รหัสพนักงาน">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">ค้นหาทีม</label>
                                        <select name="team_id" id="team_id" class="form-control">
                                            <option value="0">-- ทั้งหมด --</option>
                                            @foreach($teams as $team)
                                                <option value="{{ $team->id }}" {{ request('team_id') == $team->id ? 'selected' : '' }}>
                                                    {{ $team->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-m-4">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fa fa-search me-1"></i> ค้นหา
                                        </button>
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
                        @if ($potentialData->isNotEmpty())
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="settingTable" class="table table-bordered text-center align-middle" style="width:100%">
                                        <thead class="bg-light">
                                            <tr>
                                                <th colspan="5" class="bg-warning-light" style="background-color: #ffffcc;">หัวข้ออบรม ({{ $potentialData->isNotEmpty() ? $potentialData->first()->course_title : '-' }})</th>
                                                <th colspan="8" style="background-color: #ffffff;">ประเมินศักยภาพผู้เข้าอบรม</th>
                                            </tr>
                                            <tr>
                                                <th rowspan="2" style="background-color: #ccffcc;">No.</th>
                                                <th rowspan="2" style="background-color: #ccffcc;">ชื่อ - สกุล</th>
                                                <th rowspan="2" style="background-color: #ccffcc;">รหัสพนักงาน</th>
                                                <th rowspan="2" style="background-color: #ccffcc;">ตำแหน่ง</th>
                                                <th rowspan="2" style="background-color: #ccffcc;">ทีม</th>
                                                <th colspan="5" style="background-color: #ffff99;">ผลประเมินศักยภาพผู้ผ่านการอบรม</th>
                                                <th rowspan="2" style="background-color: #ffff99; width: 80px;">การประเมินศักยภาพ</th>
                                                <th rowspan="2" style="background-color: #ffff99; width: 80px;">การประเมินผลิตภาพ</th>
                                                <th rowspan="2" style="background-color: #ffff99;">ลายเซ็น (Signature)</th>
                                            </tr>
                                            <tr>
                                                <th style="background-color: #ffff99; font-size: 12px;">1. ความรู้จากการฝึกอบรม</th>
                                                <th style="background-color: #ffff99; font-size: 12px;">2. ทักษะในการปฏิบัติงาน</th>
                                                <th style="background-color: #ffff99; font-size: 12px;">3. ทัศนคติที่มีต่อการปฏิบัติงาน</th>
                                                <th style="background-color: #ffff99; font-size: 12px;">4. การแก้ปัญหาในการทำงาน</th>
                                                <th style="background-color: #ffff99; font-size: 12px;">5. ความตระหนักในด้านการทำงาน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($potentialData as $item)
                                                @foreach ($item->passcourse as $index => $userData)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td class="text-left">{{ $userData->user->Profiles->firstname ? $userData->user->Profiles->firstname:'NaN' }} {{ $userData->user->Profiles->lastname ? $userData->user->Profiles->lastname:'NaN' }}</td>
                                                        <td>{{ $userData->user->username }}</td>
                                                        <td>{{ $userData->user->orgchart->title }}</td>
                                                        <td>{{ $userData->user->Team->name }}</td>
                                                        {{-- วนลูปโชว์ 5 ช่องที่เตรียมไว้แล้ว --}}
                                                        @foreach ($userData->display_evals as $eval)
                                                            <td class="text-center">
                                                                @if ($eval['grade'] > 0)
                                                                    <i style="font-size: 18px;"></i>
                                                                    {{ $eval['grade'] }}
                                                                @else
                                                                    0
                                                                @endif
                                                            </td>
                                                        @endforeach

                                                        <td></td><td></td><td></td>
                                                    </tr>
                                                @endforeach

                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-3">
                                    <p class="text-primary mb-1"><strong>Remark</strong></p>
                                    <table class="table-sm border-0">
                                        <tr>
                                            <td width="30" class="font-weight-bold">3</td>
                                            <td class="text-primary">Qualifiled</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">2</td>
                                            <td class="text-primary">Under Supervision</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">1</td>
                                            <td class="text-primary">Not Qualifiled(In Training)</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">0</td>
                                            <td class="text-primary">-</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('report.learning_potential.export.excel', request()->all()) }}" class="btn btn-success">Export to Excel</a>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-info text-center" style="margin-bottom:0rem">
								กรุณากดเลือกหลักสูตร | ไม่มีข้อมูล
							</div>
                        @endif
                    </div>
                </div>
            </div>
		</div>
	</div>
<script>
    $(document).ready(function() {
        // function โหลด line
        function loadLines(sectionId, selectedLineId = 0) {
            var lineSelect = $('#line_id');
            lineSelect.html('<option value="0">-- ทั้งหมด --</option>');

            if (sectionId != 0) {
                $.ajax({
                    url: '{{ route("report.learning_potential.get_line", "") }}/' + sectionId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            var selected = value.id == selectedLineId ? 'selected' : '';
                            lineSelect.append(
                                '<option value="' + value.id + '" ' + selected + '>' +
                                value.title +
                                '</option>'
                            );
                        });
                    },
                    error: function() {
                        console.log('Error fetching lines');
                    }
                });
            }
        }

        // ถ้ามีค่า section จาก request → โหลด line พร้อม selected ทันที
        var currentSection = '{{ request("section_id", 0) }}';
        var currentLine    = '{{ request("line_id", 0) }}';
        if (currentSection != 0) {
            loadLines(currentSection, currentLine);
        }

        // event เมื่อเปลี่ยน section
        $('#section_id').on('change', function() {
            loadLines($(this).val());
        });
    });
</script>
@endsection
