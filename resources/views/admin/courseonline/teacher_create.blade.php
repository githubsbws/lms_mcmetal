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
                            <h4 class="m-0">ระบบหลักสูตรนิสิต/นักศึกษา</h4>
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
            </div>
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        เพิ่มข้อมูลผู้สอน
                    </div>
                    <div class="card-body">
                        <p>ค่าที่มี <span class="text-danger">*</span> จำเป็นต้องใส่ให้ครบ</p>

                        <form action="{{ route('teacher.create')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="course_title">ชื่อวิทยากร/ผู้สอน <span class="text-danger">*</span></label>
                                <input type="text" name="teacher_name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="summernote">รายละเอียดย่อ</label>
                                <textarea name="teacher_detail" id="summernote" class="form-control"></textarea>
                            </div>

                            {{-- <div class="form-group">
                                <label for="summernote">รูปภาพ</label><span class="text-danger">*</span>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input span3">
                                            <i class="icon-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <img id="previewImage" src="#" alt="Preview Image" style="display: none;">
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-new">Select file</span>
                                            <span class="fileupload-exists">Change</span>
                                            <input id="ytNews_cms_picture" type="hidden"  name="cate_image">
                                            <input name="image" id="imageInput"  type="file" >
                                        </span>
                                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                        <input type="file" id="imageInput" name="image">
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var imageInput = document.getElementById('imageInput');
                                            var previewImage = document.getElementById('previewImage');

                                            imageInput.addEventListener('change', function() {
                                                previewImageFile(this);
                                            });

                                            function previewImageFile(input) {
                                                var file = input.files[0];
                                                if (file) {
                                                    var reader = new FileReader();
                                                    reader.onload = function(e) {
                                                        previewImage.src = e.target.result;
                                                        previewImage.style.display = 'block';
                                                    };
                                                    reader.readAsDataURL(file);
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div> --}}



                            {{-- <div class="form-group">
                                <font color="#990000">
                                    รูปภาพควรมีขนาด 250x180(แนวนอน) หรือ ขนาด 250x(xxx) (แนวยาว)
                                </font>
                            </div> --}}

                            <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        ลบข้อมูลผู้สอน
                    </div>
                    <div class="card-body">
                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>วิทยากร/ผู้สอน</th>
                                        <th>รายละเอียดย่อ</th>
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @foreach($teacher as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{ $item->teacher_name }}
                                        </td>
                                        <td class="text-center">
                                            {!! htmlspecialchars_decode($item->teacher_detail) !!}
                                        </td>
                                        <td>
                                            <a href="{{ route('teacher.edit',['id' =>$item->teacher_id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm delete-button" data-id="{{ $item->teacher_id }}">
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
        <div id="sidebar">
        </div><!-- sidebar -->
        </div>
    </div>
    <div class="clearfix"></div>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
        });

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
                    var url = "/teacher_delete/" + id;

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

