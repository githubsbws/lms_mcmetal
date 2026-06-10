@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Lesson;
use App\Models\QHeader;
@endphp
<body>
	<div id="wrapper">
		<div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">ระบบแบบสอบถาม</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('lesson')}}">
                                <button class="btn btn-warning d-flex align-items-center">
                                    <i class="fas fa-angle-left mr-2"></i>
                                    กลับหน้าหลัก
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
			<div class="content">
                <div class="container-fluid">
                    <div class="card m-0">
                        <div class="card-body">

							<div class="form-group">
								<label for="group_id">แบบสอบถาม <span class="text-danger">*</span></label>
								<select class="form-control" name="group_id" id="Grouptesting_lesson_id">
									<option value="">-- กรุณาเลือกแบบสอบถาม --</option>
									@foreach ($survey_headers as $item)
										<option value="{{ $item->survey_header_id }}" data-id="{{ $item->survey_header_id }}">
											{{ $item->survey_name }}
										</option>
									@endforeach
								</select>
							</div>

							<div class="card-footer">
								<button type="button" onclick="showSweetAlert()" class="btn btn-primary">
									<i class="fas fa-save mr-1"></i>บันทึก
								</button>
							</div>

                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ชื่อบทเรียนออนไลน์</th>
                                        <th>ชื่อชุด</th> 
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    <tr>
                                        <td>
                                            {{$lesson_id->title}}
                                        </td>
                                        <td class="text-center">
                                            {{$lesson_id->Qheader->survey_name ?? '-'}}
                                        </td>
                                    </tr>
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
			responsive: true,
			scrollX: true,
			language: {
				url: '/include/languageDataTable.json',
			}
		});
	});
	var lessonId = @json($lesson_id->id ?? null); // ID ที่ถูกต้อง
	var url = "{{ route('questionnaireout.plan', ['header_id' => ':headerId', 'id' => ':id']) }}";

	function showSweetAlert() {
		var selectedOption = document.getElementById("Grouptesting_lesson_id");
		var selectedId = selectedOption.value; // Header ID

		if (!selectedId) {
			Swal.fire("กรุณาเลือกแบบสอบถาม!", { icon: "warning" });
			return;
		}

		// แทนค่าถูกต้อง (Header ID ก่อน, Lesson ID หลัง)
		var finalUrl = url.replace(':headerId', encodeURIComponent(selectedId))
						.replace(':id', encodeURIComponent(lessonId));

		console.log("📌 Final URL:", finalUrl); // ✅ ตรวจสอบ URL ก่อนส่ง

		var csrf_token = "{{ csrf_token() }}";

		Swal.fire({
			title: "ต้องการเพิ่มข้อสอบใช่หรือไม่?",
			icon: "info",
			buttons: true,
			dangerMode: true,
		}).then((confirm) => {
			if (confirm) {
				fetch(finalUrl, {
					method: 'POST',
					headers: {
						'X-CSRF-TOKEN': csrf_token,
						'Content-Type': 'application/json',
						'Accept': 'application/json'
					},
					body: JSON.stringify({ id: lessonId, header_id: selectedId }) // ส่งค่าถูกต้อง
				})
				.then(response => response.json())
				.then(data => {
					console.log("✅ Server Response:", data);
					if (data.success) {
						Swal.fire("สำเร็จ!", "เพิ่มแบบสอบถามเรียบร้อย!", "success").then(() => {
							location.reload();
						});
					} else {
						Swal.fire("เกิดข้อผิดพลาด!", data.error || "ไม่สามารถเพิ่มแบบสอบถามได้", "error");
					}
				})
				.catch(error => {
					console.error("❌ Fetch error:", error);
					Swal.fire("เกิดข้อผิดพลาด!", "ไม่สามารถเพิ่มแบบสอบถามได้", "error");
				});
			} else {
				swal("ยกเลิกการเพิ่มข้อสอบ!");
			}
		});
	}
</script>
</body>
@endsection