@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<body class="">
		<div id="wrapper">
			<div class="content-wrapper">
				<div class="content-header">
					<div class="container-fluid d-flex align-items-center">
						<div>
							<h4 class="m-0">จัดการระบบหมวดหลักสูตร</h4>
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
				<div class="content">
					<div class="container-fluid">
						<div class="card m-0">
							<div class="card-body">
								<span class="label label-important" style="color:red">
									* หมายเหตุ ถ้าลบหมวดหลักสูตร จะทำให้หลักสูตร, บทเรียน(วิดีโอ), ข้อสอบ จะถูกลบไปด้วย
								</span>
								<table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
									<thead>
										<tr>
											<th>รูปภาพ</th>
											<th>ชื่อหมวดหลักสูตร</th>
											<th>รายละเอียดย่อ</th>
											<th>รายละเอียด</th>
											{{-- <th>เปิด-ปิด</th> --}}
											<th>จัดการ</th>
										</tr>
									</thead>
									<tbody id="sortable">
										@foreach($category_on as $item)
										<tr>
											<td class="text-center">
												<img src="{{ asset('images/uploads/category/'.$item->cate_id.'/original/'. $item->cate_image) }}" alt="{{ $item->cate_image }}">
											</td>
											<td class="text-center">{{$item->cate_title}}</td>
											<td class="text-center">{{ $item->cate_short_detail}}</td>
											<td class="text-center">{!! htmlspecialchars_decode($item->cate_detail) !!}</td>
											{{-- <td class="text-center">
												<a class="btn {{ $item->cate_show == '1' ? 'btn-primary' : 'btn-light' }}"
													href="{{ route('category.openshow', ['id' => $item->cate_id, $item->cate_show == '1' ? 'off' : 'on' => $item->cate_show == '1' ? '0' : '1']) }}"
													role="button">
													{{ $item->cate_show == '1' ? 'เปิด' : 'ปิด' }}
												 </a>
											</td> --}}
											<td>
												<a href="{{ route('category.detail',['id'=>$item->cate_id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-search"></i></a>
												<a href="{{ route('category.edit',['id' =>$item->cate_id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
												<button type="button" class="btn btn-danger btn-sm delete-button" data-id="{{ $item->cate_id }}">
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
			var url = "/category_delete/" + id;

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
