@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<body>
	<div id="wrapper">
		<div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">ระบบบทเรียน</h4>
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
                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>หลักสูตรอบรมออนไลน์</th>
                                        <th>ชื่อบทเรียน</th>
                                        {{-- <th>แบบสอบถาม</th> --}}
                                        <th>จัดการวิดีโอ</th>
										{{-- <th>ก่อนเรียน</th>
										<th>หลังเรียน</th> --}}
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @foreach($lesson as $item)
                                    <tr>
                                        <td>
                                            {{ $item->course->course_title ?? '-' }}
                                        </td>
                                        <td class="text-center">
                                            {!! htmlspecialchars_decode($item->title) !!}
                                        </td>
                                        {{-- <td class="text-center">
											<a class="btn btn-primary btn-icon" href="{{route('questionnaireout.plan',['id'=>$item->id])}}">เลือก</a>
                                        </td> --}}
										<td class="text-center">
                                            <a class="btn btn-primary btn-icon" href="{{ route('filemanagers', $item->file->isEmpty() ? [] : ['id' => $item->id]) }}">
												จัดการวิดีโอ ({{ $item->file->where('active', 'y')->isEmpty() ? 0 : count($item->file) }})
											</a>
                                        </td>
										{{-- <td class="text-center">
                                            <a class="btn btn-primary btn-icon" href="{{ route('grouptesting.plan', ['id' => $item->id, 'type' => 'pre']) }}">
												เลือกข้อสอบ ({{ $item->manage->where('type', 'pre')->where('active', 'y')->count() }})
											</a>
                                        </td>
										<td class="text-center">
											<a class="btn btn-primary btn-icon" href="{{ route('grouptesting.plan', ['id' => $item->id, 'type' => 'post']) }}">
												เลือกข้อสอบ ({{ $item->manage->where('type', 'post')->where('active', 'y')->count() }})
											</a>
                                        </td> --}}
                                        <td>
                                            <a href="{{ route('lesson.detail', ['id' =>$item->id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-search"></i></a>
                                            <a href="{{ route('lesson.edit',['id' =>$item->id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm delete-button" data-id="{{ $item->id }}">
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
            order: [],
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
					var url = "/lesson_delete/" + id;

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
