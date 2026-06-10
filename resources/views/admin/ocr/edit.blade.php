@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<body class="">
		<div id="wrapper">
			<div class="content-wrapper">
				<div class="content-header">
					<div class="container-fluid">
						<div class="d-flex align-items-center">
							<div class="">
								<h4 class="m-0">ระบบเพิ่มเอกสาร OCR</h4>
							</div>
							<div class="ml-3">
								<a href="{{ url()->previous() }}">
									<button class="btn btn-warning d-flex align-items-center">
										<i class="fas fa-angle-left mr-2"></i>
										กลับ
									</button>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="container-fluid">
						<div class="d-flex" style="gap: 1rem; height: 80vh;">
							<!-- ฝั่งซ้าย: PDF Viewer -->
							<div class="flex-fill">
								<div class="card h-100">
									<div class="card-header bg-primary text-white">
										PDF Preview
									</div>
									<div class="card-body p-0" style="height: calc(100% - 56px); overflow: auto;">
										<iframe 
											src="{{ asset('images/uploads/ocr/'.$page->OcrFile->folder_name.'/'.$page->OcrFile->filename) }}#page={{ $page->page_number }}" 
											style="width:100%; height:100%;" 
											frameborder="0">
										</iframe>
									</div>
								</div>
							</div>

							<!-- ฝั่งขวา: Textarea -->
							<div class="flex-fill">
								<div class="card h-100">
									<div class="card-header bg-success text-white">
										Edit Text
									</div>
									<div class="card-body p-0" style="height: calc(100% - 56px);">
										<form action="{{ route('ocr.update', ['id' => $page->id, 'page_number' => $page->page_number]) }}" method="POST" style="height: 100%;">
											@csrf
											@method('PUT')
											<textarea 
												name="text_content" 
												class="form-control h-100" 
												style="resize:none; overflow:auto;">{{ $page->text }}</textarea>
											<button type="submit" class="btn btn-primary mt-2 w-100">บันทึก</button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
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
					var url = "/ocr_del/" + id;

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
