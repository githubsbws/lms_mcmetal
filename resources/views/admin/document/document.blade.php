@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\DownloadFile;
@endphp
<body class="">
		<div id="wrapper">
			<div class="content-wrapper">
				<div class="content-header">
					<div class="container-fluid">
						<div class="d-flex align-items-center">
							<div class="">
								<h4 class="m-0">ระบบเอกสาร</h4>
							</div>
							<div class="ml-3">
								<a href="{{route('admin')}}">
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
								<!-- หัวข้อเอกสาร (Document Title) -->
								<div class="form-group">
									<label for="document_title">หัวข้อเอกสาร</label>
									<select class="form-control" name="title" id="document_title_select">
										<option value="">--- เลือกชื่อเอกสาร ---</option>
										@foreach ($document_title as $title)
											<option value="{{ $title->title_id }}">{{ $title->title_name }}</option>
										@endforeach
									</select>
								</div>

								<!-- ประเภทเอกสาร (Document Type) -->
								<div class="form-group">
									<label for="download_cate">ประเภทเอกสาร</label>
									<select class="form-control" name="download_cate" id="document_type_select">
										<option value="">--- ประเภทเอกสาร ---</option>
										<!-- ตัวเลือกประเภทเอกสารจะถูกเติมโดยอัตโนมัติ -->
									</select>
								</div>
								<table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
									<thead>
										<tr>
											<th>หัวข้อเอกสาร</th>
											<th>ประเภทเอกสาร</th>
											<th>ชื่อไฟล์</th>
											<th>ไฟล์ที่ดาวน์โหลด</th>
											<th>จัดการ</th>
										</tr>
									</thead>
									<tbody id="sortable">
										@foreach($document as $item)
											<tr>
												<td>
													@if(!empty($item->downloadFile) && !empty($item->downloadFile->categories) && $item->downloadFile->categories->isNotEmpty())
														{{ optional($item->downloadFile->categories->first()->downloadTitle)->title_name ?? '-' }}
													@else
														-
													@endif
												</td>
												<td class="text-center">
													@if($item->downloadFile && $item->downloadFile->categories->isNotEmpty())
														@foreach($item->downloadFile->categories as $category)
															{{ $category->download_name ?? '-' }}
														@endforeach
													@else
														-
													@endif
												</td>
												<td class="text-center">{{ $item->filedoc_name }}</td>
												<td class="text-center">
													<a href="{{ route('document.downloadfile', ['id' => $item->filedoc_id]) }}">{{ $item->filedocname }}</a>
												</td>
												<td>
													<a href="{{ route('document.detail', ['id' => $item->filedoc_id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-search"></i></a>
													<a href="{{ route('document.edit', ['id' => $item->filedoc_id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
													<button type="button" class="btn btn-danger btn-sm delete-button" data-id="{{ $item->filedoc_id }}">
														<i class="fas fa-trash"></i>
													</button>
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
			<!-- </div> -->
			<!-- <div class="span-5 last"> -->
			<!-- </div> -->
			<!-- // Content END -->

		</div>
		<div class="clearfix"></div>
<script>
	$(document).ready(function() {
    var table = $('#settingTable').DataTable({
        responsive: true,
        scrollX: true,
        language: {
            url: '/include/languageDataTable.json',
        }
    });


	function populateDocumentTypes() {
    var titleId = $('#document_title_select').val();
    var documentTypeSelect = $('#document_type_select');

    // เคลียร์ตัวเลือกประเภทเอกสารก่อนเติมใหม่
    documentTypeSelect.html('<option value="">--- ประเภทเอกสาร ---</option>');

    // ดึงข้อมูลประเภทเอกสาร
    fetch('{{ url("getDocumentTypes") }}/' + titleId)
        .then(response => response.json())
        .then(data => {
            console.log("ประเภทเอกสารที่ได้:", data);

            data.forEach(item => {
                var option = $('<option></option>').attr("value", item.download_name).text(item.download_name);
                documentTypeSelect.append(option);
            });

            // หลังจากโหลดประเภทเอกสารแล้ว ให้กรอง DataTable ตาม "หัวข้อเอกสาร"
            filterTable();
        })
        .catch(error => {
            console.error('Error fetching document types:', error);
        });
	}

	function filterTable() {
    var selectedTitleId = $('#document_title_select').val();  // ดึงค่า ID
    var selectedTitleName = $('#document_title_select option:selected').text().trim(); // ดึงค่า title_name
    var selectedCategory = $('#document_type_select').val(); // ดึงประเภทเอกสาร

    console.log("หัวข้อที่เลือก (ID):", selectedTitleId);
    console.log("หัวข้อที่เลือก (ชื่อ):", selectedTitleName);
    console.log("ประเภทที่เลือก:", selectedCategory);

    // กรองข้อมูลตาม "หัวข้อเอกสาร" (คอลัมน์ที่ 0)
    if (selectedTitleName && selectedTitleName !== "--- เลือกชื่อเอกสาร ---") {
        table.columns(0).search('^' + selectedTitleName + '$', true, false).draw();
    } else {
        table.columns(0).search('').draw();  // รีเซ็ตการกรอง
    }

    // กรองข้อมูลตาม "ประเภทเอกสาร" (คอลัมน์ที่ 1)
    if (selectedCategory) {
        table.columns(1).search('^' + selectedCategory + '$', true, false).draw();
    } else {
        table.columns(1).search('').draw();  // รีเซ็ตการกรอง
    }
	}
	
    $('#document_title_select').on('change', function() {
        populateDocumentTypes();  // โหลดประเภทเอกสารใหม่ตามหัวข้อที่เลือก
    });

    // เมื่อเลือกประเภทเอกสาร
    $('#document_type_select').on('change', function() {
        filterTable();  // กรองข้อมูลใน DataTable
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
					var url = "/document_delete/" + id;

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