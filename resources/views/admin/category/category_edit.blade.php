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
                            <h4 class="m-0">ระบบหมวดหลักสูตร</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('category')}}">
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
                        แก้ไขหมวดหลักสูตร
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.edit',['id' =>$category->cate_id]) }}" enctype="multipart/form-data" method="post" id="question-form">
                            @csrf
                            <div class="form-group">
                                <label for="cate_title">ชื่อหมวดหลักสูตร</label>
                                <input type="text" name="cate_title" class="form-control" value="{{ $category->cate_title }}">
                            </div>

                            <div class="form-group">
                                <label for="cate_short_detail">รายละเอียดย่อ</label>
                                <input type="text" name="cate_short_detail" class="form-control" value="{{ $category->cate_short_detail }}">
                            </div>

                            <div class="form-group">
                                <label for="cate_detail">รายละเอียด </label>
                                <textarea name="cate_detail" id="summernote" class="form-control">{{ htmlspecialchars_decode(htmlspecialchars_decode($category->cate_detail)) }}</textarea>
                            </div>

                            <div class="form-group">
                                <div id="picture_show" style="">
                                    ภาพประกอบ <br>
                                    <img src="{{ asset('images/uploads/category/'.$category->cate_id.'/original/'. $category->cate_image) }}" alt="รูปภาพ" value="{{ $category->cate_image }}" name="cate_image_o"><br><br>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cate_image">รูปภาพ</label>
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
                                            <input id="ytNews_cms_picture" type="hidden" value="{{$category->cate_image}}" name="cate_image">
                                            <input name="image" id="imageInput"  type="file" >
                                        </span>
                                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                        {{-- <input type="file" id="imageInput" name="image"> --}}

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
                            </div>

                            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
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
</script>
</body>

@endsection
