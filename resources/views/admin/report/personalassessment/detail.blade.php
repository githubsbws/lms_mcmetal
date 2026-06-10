@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<style>
.license-lp3 {
    background: #00ff00;
    text-align: center;
    font-size: 22px;
    font-weight: bold;
}

.license-lp2 {
    background: #fff3cd;
    text-align: center;
    font-size: 22px;
    font-weight: bold;
}

.license-lp1 {
    background: #ff4d4d;
    color: white;
    text-align: center;
    font-size: 22px;
    font-weight: bold;
}

.license-na {
    background: #bdbdbd;
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
							<h4 class="m-0">ระบบReport</h4>
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
				</div>
                <div class="card m-2">
                    <div class="card-header">
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <a href="{{ route('personal.assessment.detail.export', $user->id) }}"
                                    class="btn btn-success mb-3">
                                    Export Excel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="content">
				<div class="container-fluid">
					<div class="card m-0">
						<div class="card-body">
							<h3 class="text-center mb-4">
                            แบบแจ้งและประเมินผลการฝึกอบรมตามตำแหน่งงาน
                            </h3>

                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">

                            <tr>

                                <th width="15%">
                                    ชื่อ - สกุล
                                </th>

                                <td width="35%">
                                    {{ $user->Profiles->firstname }}
                                    {{ $user->Profiles->lastname }}
                                </td>

                                <th width="10%">
                                    รหัส
                                </th>

                                <td width="15%">
                                    {{ $user->username }}
                                </td>

                                <th width="10%">
                                    ตำแหน่ง
                                </th>

                                <td width="15%">
                                    {{ $user->Orgchart->title ?? '-' }}
                                </td>

                                <th width="10%">
                                    แผนก
                                </th>

                                <td width="15%">
                                    {{ $user->Department->title ?? '-' }}
                                </td>

                            </tr>

                            </table>
                            <table id="settingTable2"
                                class="table table-bordered text-center nowrap"
                                style="width:100%">

                                <thead>

                                    {{-- Header Row 1 --}}
                                    <tr>

                                        <th rowspan="2">ลำดับที่</th>

                                        <th rowspan="2">หมวดวิชา</th>

                                        <th rowspan="2">หัวข้อการอบรม</th>

                                        <th rowspan="2">วัน/เดือน/ปี</th>

                                        <th colspan="4">
                                            วิธีการประเมิน
                                        </th>

                                        <th rowspan="2">
                                            คะแนน
                                        </th>

                                        <th colspan="2">
                                            ผลการประเมิน
                                        </th>

                                        <th rowspan="2">
                                            หมายเหตุ
                                        </th>

                                    </tr>

                                    {{-- Header Row 2 --}}
                                    <tr>

                                        <th>ถาม-ตอบ</th>

                                        <th>ปฏิบัติ</th>

                                        <th>ข้อสอบ</th>

                                        <th>ผลงาน</th>

                                        <th>ผ่าน</th>

                                        <th>ไม่ผ่าน</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($assessments as $index => $assessment)

                                    <tr>

                                        <td>{{ $index + 1 }}</td>

                                        <td>Orientation</td>

                                        <td class="text-left">
                                            {{ $assessment->course_name }}
                                        </td>

                                        <td>
                                            {{ $assessment->assessment_date }}
                                        </td>

                                        <td>{{ $assessment->qa_score }}</td>

                                        <td>{{ $assessment->operate_score }}</td>

                                        <td>{{ $assessment->assign_score }}</td>


                                        <td>{{ $assessment->observe_score }}</td>

                                        <td>
                                            {{ $assessment->total_score }}%
                                        </td>

                                        {{-- ผ่าน --}}
                                        <td>
                                            @if($assessment->level == 3)
                                                <span class="text-success font-weight-bold">
                                                    ✔
                                                </span>
                                            @endif
                                        </td>

                                        {{-- ไม่ผ่าน --}}
                                        <td>
                                            @if($assessment->level != 3)
                                                <span class="text-danger font-weight-bold">
                                                    ✖
                                                </span>
                                            @endif
                                        </td>

                                        <td></td>

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
        $('#settingTable2').DataTable({
			ordering: false,
			responsive: true,
			scrollX: true,
			paging: false,
			language: {
				url: '/include/languageDataTable.json',
			}
		});
	});
</script>
</body>
@endsection
