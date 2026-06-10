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
                            <h4 class="m-0">ระบบอาจาร์ย/ผู้สอน</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('teacher.create')}}">
                                <button class="btn btn-warning d-flex align-items-center">
                                    <i class="fas fa-angle-left mr-2"></i>
                                    กลับหน้าหลัก
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        แก้ไขข้อมูลอาจาร์ย/ผู้สอน
                    </div>
                    <div class="card-body">
                        <form action="{{ route('teacher.edit', ['id'=>$teacher->teacher_id]) }}" enctype="multipart/form-data" method="post" id="question-form">
                            @csrf
                            <div class="form-group">
                                <label for="course_title">ชื่อวิทยากร/ผู้สอน </label>
                                <input type="text" name="teacher_name" class="form-control" value="{{ $teacher->teacher_name}}">
                            </div>

                            <div class="form-group">
                                <label for="summernote">รายละเอียดย่อ</label>
                                <textarea name="teacher_detail" id="summernote" class="form-control">{!!  htmlspecialchars_decode($teacher->teacher_detail) !!}</textarea>
                            </div>

                             {{-- <div class="form-group">
                                <div id="picture_show" style="">
                                    ภาพประกอบ <br>
                                    <img src="{{ asset('images/uploads/teacher/'.$teacher->teacher_id.'/thumb/'.$teacher->teacher_picture) }}" name="teacher_picture"><br><br>
                                </div>
                            </div> --}}

                            {{-- <div class="form-group">
                                <label for="summernote">รูปภาพ</label>
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
                                            <input id="ytNews_cms_picture" type="hidden" value="{{ $teacher->teacher_picture}}"  name="cate_image">
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
                            </div>

                            <div class="form-group">
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
        $('#summernote2').summernote();
        });
</script>
</body>
@endsection
