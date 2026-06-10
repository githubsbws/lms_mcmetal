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
                            <h4 class="m-0">ผลการเรียน</h4>
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
                                        {{-- <th>รูปภาพ</th> --}}
                                        <th>ชื่อหลักสูตรอบรมออนไลน์</th>
                                        <th>หมวดอบรมออนไลน์</th>
                                        <th>ชื่อ - นามสกุล</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @foreach($course_online as $item)
                                    <tr>
                                        
                                        {{-- <td>
                                            <img src="{{ asset('images/uploads/courseonline/'.$item->course_id.'/original/' . $item->course_picture) }}" alt="{{ $item->course_picture }}" width="100px" height="100px">
                                        </td> --}}
                                        <td class="text-center">
                                            {{ $item->course_title }}
                                        </td>
                                        <td class="text-center">
                                            {{ $item->cate_title }}
                                        </td>
                                        <td class="text-center">{{ $item->firstname .'-'. $item->lastname ?? '-'}}</td>
                                        <td>
                                            {{-- <a href="{{ route('courseonline.detail',['id'=>$item->course_id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-search"></i></a>
                                            <a href="{{ route('courseonline.edit',['id' =>$item->course_id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a> --}}
                                            <button type="button" class="btn btn-success btn-sm approve-button" data-id="{{ $item->course_id }}">
                                                <i class="fas fa-check"></i> อนุมัติ
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm delete-button"    data-id="{{ $item->course_id }}">
                                                <i class="fas fa-times"></i> ไม่อนุมัติ
                                            </button>
                                            {{-- <button type="button" class="btn btn-success btn-sm delete-button" data-id="{{ $item->course_id }}">
                                            <button type="button" class="btn btn-danger btn-sm delete-button" data-id="{{ $item->course_id }}"></button>
                                                <i class="fas fa-trash"></i>
                                            </button> --}}
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
                $(document).on("click", ".approve-button", function(e) {
                    e.preventDefault();

                    var id = $(this).data("id");
                    var url = "/courseonline_delete/" + id;

                    console.log("Clicked delete button with ID:", id); // ตรวจสอบว่า ID ถูกต้องไหม

                    Swal.fire({
                        title: "คุณแน่ใจหรือไม่?",
                        text: "อนุมัติผลการเรียน!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "อนุมัติ",
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
                                        text: response.message || "อนุมัติผลการเรียนสำเร็จ",
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

            $(document).on("click", ".delete-button", function(e) {
    e.preventDefault();

    var id = $(this).data("id");
    var url = "/courseonline_reject/" + id;

    Swal.fire({
        title: "ยกเลิกการอนุมัติ",
        text: "กรุณาระบุเหตุผล",
        input: "textarea",
        inputPlaceholder: "พิมพ์เหตุผลที่นี่...",
        inputAttributes: {
            "aria-label": "กรุณาระบุเหตุผล"
        },
        showCancelButton: true,
        confirmButtonText: "ยืนยัน",
        cancelButtonText: "ยกเลิก",
        confirmButtonColor: "#d33",
        preConfirm: (reason) => {
            if (!reason) {
                Swal.showValidationMessage("กรุณากรอกเหตุผลก่อนยืนยัน");
            }
            return reason;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    reason: result.value,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        title: "สำเร็จ!",
                        text: response.message || "ยกเลิกสำเร็จ",
                        icon: "success"
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    Swal.fire(
                        "เกิดข้อผิดพลาด!",
                        xhr.responseJSON?.message || "ไม่สามารถทำรายการได้",
                        "error"
                    );
                }
            });
        }
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
