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
                            <h4 class="m-0">ระบบหลักสูตรนิสิต/นักศึกษา</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('courseonline')}}">
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
                        รายละเอียดหลักสูตรนิสิต/นักศึกษา
                    </div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="cms_title">หมวดอบรมออนไลน์</label>
                                <h4>{{ $course_online->cate_title}}</h4>
                            </div>

                            <div class="form-group">
                                <label for="cms_title">ชื่อวิยากร</label>
                                <h4>{{ $course_online->teacher->teacher_name ?? '-' }}</h4>
                            </div>

                            <div class="form-group">
                                <label for="cms_short_title">ชื่อหลักสูตรอบรมออนไลน์ </label>
                                <h4>{{ $course_online->course_title}}</h4>
                            </div>

                            <div class="form-group">
                                <label for="cms_short_title">รายละเอียดย่อ </label>
                                {!! htmlspecialchars_decode($course_online->course_short_title) !!}
                            </div>

                            <div class="form-group">
                                <label for="cms_short_title">รายละเอียด </label>
                                {!! htmlspecialchars_decode(htmlspecialchars_decode($course_online->course_detail)) !!}
                            </div>

                            <div class="form-group">
                                <label for="cms_short_title">ปักหมุดหลักสูตรแนะนำ </label>
                                <div>
                                    @php
                                        $checked = $course_online->recommend == 'y' ? 'checked' : '';
                                    @endphp
                                    <input type="checkbox" name="recommend" value="y" data-toggle="toggle" data-on="แสดง" data-off="ไม่แสดง" data-onstyle="success" data-offstyle="danger" {{ $checked }} />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cms_short_title">หมายเหตุ </label>
                                <h4>{{ $course_online->course_note}}</h4>
                            </div>

                            <div class="form-group">
                                <label for="cms_short_title">ภาพประกอบ </label>
                                <h3><img src="{{ asset('images/uploads/courseonline/'.$course_online->course_id.'/original/'. $course_online->course_picture) }}" alt="รูปภาพ"></h3>
                            </div>
                    </div>
                </div>
            </div>
            <div id="sidebar">
            </div><!-- sidebar -->
        </div>
    </div>
    <div class="clearfix"></div>
</body>
@endsection
