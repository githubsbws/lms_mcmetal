@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')

<body>
<div id="wrapper">
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <div>
                        <h4 class="m-0">ระบบใบประกาศนียบัตร</h4>
                    </div>

                    <div class="ml-3">
                        <a href="{{ route('certificate') }}">
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
                    แก้ไขใบประกาศนียบัตร
                </div>

                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>บันทึกไม่สำเร็จ!</strong>
                            กรุณาตรวจสอบข้อมูลอีกครั้ง
                        </div>
                    @endif

                    <form action="{{ route('certificate.edit',$certificate->id) }}"
                          enctype="multipart/form-data"
                          method="POST">

                        @csrf

                        {{-- หลักสูตร --}}
                        <div class="form-group">
                            <label>
                                หลักสูตรอบรมออนไลน์
                                <span style="color:red">*</span>
                            </label>

                            <select class="form-control" name="course_id">

                                <option value="">เลือกหลักสูตร</option>

                                @foreach($course_online as $course)

                                    <option
                                        value="{{ $course->course_id }}"
                                        {{ $certificate->cert_course == $course->course_id ? 'selected' : '' }}
                                    >
                                        {{ $course->course_title }}
                                    </option>

                                @endforeach

                            </select>
                        </div>

                        {{-- ชื่อใบประกาศ --}}
                        <div class="form-group">
                            <label>
                                ชื่อใบประกาศนียบัตร
                                <span style="color:red">*</span>
                            </label>

                            <input
                                type="text"
                                name="cert_name"
                                class="form-control"
                                value="{{ old('cert_name',$certificate->cert_name) }}"
                            >
                        </div>

                        {{-- รูปเดิม --}}
                        @if(!empty($certificate->cert_pic))

                            <div class="form-group">
                                <label>รูปปัจจุบัน</label>

                                <div>
                                    <img
                                        src="{{ asset('images/uploads/certificate/'.$certificate->id.'/original/'.$certificate->cert_pic) }}"
                                        class="img-thumbnail"
                                        style="max-width:400px;"
                                    >
                                </div>
                            </div>

                        @endif

                        {{-- อัพโหลดรูปใหม่ --}}
                        <div class="form-group">

                            <label>เปลี่ยนภาพพื้นหลัง</label>

                            <div class="fileupload fileupload-new">

                                <span class="btn btn-default btn-file">

                                    <span class="fileupload-new">
                                        Select file
                                    </span>

                                    <input
                                        type="file"
                                        name="image"
                                        id="imageInput"
                                        onchange="previewImageFile()"
                                    >

                                </span>

                            </div>

                            <img
                                id="previewImage"
                                src="#"
                                style="
                                    display:none;
                                    max-width:400px;
                                    margin-top:10px;
                                "
                            >

                        </div>

                        <div class="form-group">
                            <font color="#990000">
                                รูปภาพควรมีขนาด 250x180 (แนวนอน)
                                หรือ 250x(xxx) (แนวตั้ง)
                            </font>
                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="fas fa-save mr-1"></i>
                            บันทึกการแก้ไข

                        </button>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

<script>

function previewImageFile()
{
    let input = document.getElementById('imageInput');
    let preview = document.getElementById('previewImage');

    if(input.files && input.files[0])
    {
        let reader = new FileReader();

        reader.onload = function(e)
        {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }

        reader.readAsDataURL(input.files[0]);
    }
}

</script>

</body>
@endsection