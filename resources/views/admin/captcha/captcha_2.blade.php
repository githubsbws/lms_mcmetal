@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
    @php
        use App\Models\Course;
        use App\Models\Captcha;
    @endphp
<body class="">
    <div id="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">ระบบ Captcha</h4>
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
                                <a type="button" class="btn btn-primary" href="{{ route('captcha_create') }}">เพิ่มแคปช่า</a>                
								<table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อเงื่อนไข</th>
                                            <th>ชื่อหลักสูตร</th>
                                            <th>เลือกหลักสูตร</th>
                                            <th>สถานะ</th>
                                            <th>จัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($captcha as $cap)
                                            @php
                                                $course = Course::where('course_point', $cap->capid)->get();
                                                $dataId = $cap->capid;
                                            @endphp
                                            <tr>
                                                <td>{{ $cap->capid }}</td>
                                                <td>{{ $cap->capt_name }}</td>
                                                <td class="text-wrap">
                                                    @if (count($course) > 0)
                                                        @foreach ($course as $c)
                                                            {{ $c->course_title }}
                                                        @endforeach
                                                    @else
                                                        ยังไม่ได้เลือกหลักสูตร
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"
                                                        data-id="{{ $cap->capid }}" data-toggle="modal"
                                                        data-target=".bd-example-modal-lg">เลือกหลักสูตร</button>
                                                </td>
                                                @if ($cap->capt_active == 'y')
                                                    <td><a class="btn btn-success btn-icon"
                                                            href="{{ route('captcha_n', ['capid' => $cap->capid, 'capt_active' => 'n']) }}">เปิด</a>
                                                    </td>
                                                @else
                                                    <td><a class="btn btn-dark btn-icon"
                                                            href="{{ route('captcha_y', ['capid' => $cap->capid, 'capt_active' => 'y']) }}">ปิด</a>
                                                    </td>
                                                @endif
                                                <td>
                                                    <a href="{{ route('captcha_detail', $cap->capid) }}" class="btn btn-warning btn-sm"><i class="fas fa-search"></i></a>
                                                    <a href="{{ route('captcha_edit', $cap->capid) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm delete-button" data-id="{{ $cap->capid }}">
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
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true" style="z-index:10001">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>เลือกหลักสูตร</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                        <div class="modal-body">
                            <table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
                                <thead>
                                    <tr>
                                        <th class="checkbox-column" id="chk"> ทั้งหมด</th>
                                        <th id="News-grid_c2"><a class="sort-link" style="color:white;">ชื่อหลักสูตร</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courseOnline as $courses)
                                        <tr class="odd selectable">
                                            <td width="20" class="checkbox-column">
                                                <input class="select-on-check" value="{{ $courses->course_id }}" 
                                                    id="chk_course_{{ $courses->course_id }}" type="checkbox"
                                                    name="chk[]" data-course-id="{{ $courses->course_id }}">
                                            </td>
                                            <td width="110">{{ $courses->course_title }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="data-id" id="dataIdField">
                        {{-- <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
                        </div> --}}
                </div>
            </div>
        </div>
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#settingTable').DataTable({
            responsive: false,
            scrollX: true,
            language: {
                url: '/include/languageDataTable.json',
            }
        });
    });


    $(document).ready(function() {
        // เมื่อคลิกปุ่ม "เลือกหลักสูตร"
        $(".btn-primary[data-toggle='modal']").click(function(event) {
            event.preventDefault(); // ปิดการส่งฟอร์มอัตโนมัติ

            var capid = $(this).data("id");  // ดึง capid จากปุ่มที่คลิก
            $("#dataIdField").val(capid); // ตั้งค่า capid ในฟิลด์ซ่อน

            // ดึงข้อมูลจากฐานข้อมูลว่า capid นี้มีหลักสูตรที่เลือกไปแล้วหรือไม่
            $.ajax({
                url: '/path-to-check-selected-courses', // สร้าง route ที่จะเช็คว่าหลักสูตรถูกเลือกหรือไม่
                method: 'GET',
                data: { capid: capid },
                success: function(response) {
                    // เช็คว่ามีข้อมูลหรือไม่
                    if (response.courses.length > 0) {
                        // หากมีข้อมูลหลักสูตรที่ถูกเลือกแล้ว, ทำการแสดง checkbox และตั้งค่าให้ถูกเลือก
                        response.courses.forEach(function(courseId) {
                            $('#chk_course_' + courseId).prop('checked', true);
                        });
                    } else {
                        // หากไม่มีการเลือกหลักสูตร, ให้ทุก checkbox สามารถเลือกได้
                        $(".select-on-check").prop('disabled', false).prop('checked', false);
                    }

                    $.ajax({
                    url: '/path-to-check-all-selected-courses', // route นี้จะดึงข้อมูลหลักสูตรที่เลือกไปแล้วจาก capid อื่นๆ
                    method: 'GET',
                    data: { capid: capid },
                    success: function(response) {
                        response.courses.forEach(function(courseId) {
                            // เช็คว่า checkbox นี้เป็นของ capid ที่เปิด modal หรือไม่
                            if (capid != $("#dataIdField").val()) {
                                
                                // ทำการ disable checkbox ที่ถูกเลือกไปแล้วจาก capid อื่นๆ
                                $('#chk_course_' + courseId).prop('disabled', true);
                            }
                        });
                    }
                });

                    // เปิด modal
                    $(".bd-example-modal-lg").modal("show");
                }
            });
        });

        // เมื่อ checkbox ถูกเลือกหรือยกเลิกการเลือก
        $(document).on('change', '.select-on-check', function() {
            var capid = $("#dataIdField").val(); // ดึง capid จากฟิลด์ซ่อน
            var courseId = $(this).val(); // ดึง course_id ที่เกี่ยวข้องกับ checkbox ที่ถูกคลิก

            // ตรวจสอบว่า checkbox ถูกเลือกหรือไม่
            if ($(this).prop('checked')) {
                // ถ้าถูกเลือก, ทำการอัปเดตฐานข้อมูลเพื่อผูกหลักสูตรนี้กับ capid
                $.ajax({
                    url: '/path-to-add-course', // สร้าง route ที่จะเพิ่ม course
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        capid: capid,
                        course_id: courseId
                    },
                    success: function(response) {
                        console.log('Course added: ' + courseId);
                    }
                });
            } else {
                // ถ้าไม่ได้เลือก, ทำการอัปเดตฐานข้อมูลเพื่อยกเลิกการเลือก
                $.ajax({
                    url: '/path-to-remove-course', // สร้าง route ที่จะลบ course
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        capid: capid,
                        course_id: courseId
                    },
                    success: function(response) {
                        console.log('Course removed: ' + courseId);
                    }
                });
            }
        });

        $(".bd-example-modal-lg").on('hidden.bs.modal', function () {
        // รีโหลดหน้าเมื่อปิด modal
        location.reload();
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
					var url = "/captcha_delete/" + id;

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
