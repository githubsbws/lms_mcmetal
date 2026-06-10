@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Manage;
@endphp
<body class="">
	<div id="wrapper">
		<div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">ระบบชุดข้อสอบบทเรียนออนไลน์</h4>
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
								<label for="group_id">ชุดข้อสอบบทเรียนออนไลน์ <span class="text-danger">*</span></label>
								<select class="form-control" name="group_id" id="Grouptesting_lesson_id">
									<option value="">-- กรุณาเลือกข้อสอบบทเรียนออนไลน์ --</option>
									@foreach ($group as $item)
										<option value="{{ $item->group_id }}" data-id="{{ $item->group_id }}">
											{!! htmlspecialchars_decode($item->group_title) !!}
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
										<th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
									@foreach ($group_active as $item)
									<tr>
										<td class="text-center">
											{!! htmlspecialchars_decode($item->title) !!}
										</td>
										<td class="text-center">
											{!! htmlspecialchars_decode($item->group_title ?? '-') !!}
										</td>
										@php
											// เนื่องจาก join แล้ว จะมีข้อมูล manage ใน $item เลย ไม่ต้องโหลด relation
											$manage_id = $item->manage_id ?? null;
										@endphp

										<td class="text-center">
											@if($manage_id)
												<button type="button" class="btn btn-danger btn-sm delete-button" data-id="{{ $manage_id }}">
													<i class="fas fa-trash"></i>
												</button>
											@else
												<span class="text-muted">-</span>
											@endif
										</td>
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
			responsive: true,
			scrollX: true,
			language: {
				url: '/include/languageDataTable.json',
			}
		});
	});
	var type = @json($type ?? null);
	var url = "{{ route('grouptesting.plan', ['id' => ':selectedId','type' => $type]) }}";

	function showSweetAlert() {
		var selectedOption = document.getElementById("Grouptesting_lesson_id");
		var selectedId = selectedOption.value; // Header ID

		if (!selectedId) {
			Swal.fire("กรุณาเลือกแบบสอบถาม!", { icon: "warning" });
			return;
		}

		// แทนค่าถูกต้อง (Header ID ก่อน, Lesson ID หลัง)
		var finalUrl = url.replace(':id', encodeURIComponent(selectedId))
						.replace(':type', encodeURIComponent(type));

		console.log("📌 Final URL:", finalUrl); // ✅ ตรวจสอบ URL ก่อนส่ง

		var csrf_token = "{{ csrf_token() }}";

		Swal.fire({
			title: "ต้องการเพิ่มข้อสอบใช่หรือไม่?",
			icon: "question",
			showCancelButton: true,
			confirmButtonText: "ใช่, เพิ่มเลย",
			cancelButtonText: "ยกเลิก",
		}).then((result) => {
			if (result.isConfirmed) {
				fetch(finalUrl, {
					method: 'POST',
					headers: {
						'X-CSRF-TOKEN': csrf_token,
						'Content-Type': 'application/json',
						'Accept': 'application/json'
					},
					body: JSON.stringify({ type: type, id: selectedId })
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
				Swal.fire("ยกเลิก", "ยกเลิกการเพิ่มแบบสอบถามแล้ว", "info");
			}
		});
	}

	$(document).ready(function() {
				// ตรวจสอบว่า jQuery โหลดหรือไม่
				if (typeof jQuery === "undefined") {
					console.error("jQuery is not loaded!");
					return;
				}

				// ตั้งค่า CSRF Token
				$.ajaxSetup({
					headers: {
						"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
					}
				});

				// ตรวจสอบว่าโค้ดนี้ทำงานจริงไหม
				console.log("Delete button script loaded");

				// ใช้ Event Delegation เผื่อปุ่มถูกโหลดใหม่
				$(document).on("click", ".delete-button", function(e) {
					e.preventDefault();

					var id = $(this).data("id");
					console.log(id)
					var url = "/grouptesting_plan_delete/" + id;

					console.log("Clicked delete button with ID:", id); // ตรวจสอบว่า ID ถูกต้องไหม

					Swal.fire({
						title: "คุณแน่ใจหรือไม่?",
						text: "ข้อมูลนี้จะถูกลบออก!",
						icon: "warning",
						showCancelButton: true,
						confirmButtonColor: "#3085d6",
						cancelButtonColor: "#d33",
						confirmButtonText: "ใช่, ลบเลย!",
						cancelButtonText: "ยกเลิก"
					}).then((result) => {
						if (result.isConfirmed) {
							$.ajax({
								url: url,
								type: "POST", // ใช้ DELETE ตาม Laravel
								success: function(response) {
									console.log("Success:", response);
									Swal.fire({
										title: "สำเร็จ!",
										text: response.message || "ลบข้อมูลสำเร็จ",
										icon: "success",
										confirmButtonText: "OK"
									}).then(() => {
										location.reload();
									});
								},
								error: function(xhr) {
									console.error("Error:", xhr);
									Swal.fire(
										"เกิดข้อผิดพลาด!",
										xhr.responseJSON?.message || "ไม่สามารถลบข้อมูลได้",
										"error"
									);
								}
							});
						}
					});
				});
			});

			@if(session('success'))
			Swal.fire({
				title: "{{ session('alert') }}",
				text:"บันทึกข้อมูลสำเร็จ",
				icon: "success",
				confirmButtonText: 'ตกลง' // เพิ่มปุ่มยืนยัน
			});
		@endif
</script>
</body>
@endsection