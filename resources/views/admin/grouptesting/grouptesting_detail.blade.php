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
                            <h4 class="m-0">ระบบชุดข้อสอบบทเรียนออนไลน์</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('grouptesting')}}">
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
                        รายละเอียดชุดข้อสอบบทเรียนออนไลน์
                    </div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="course_title">ชื่อบทเรียนออนไลน์</label>
                                <h4>{{ $group->course->course_title ?? '-'}}</h4>
                            </div>

                            <div class="form-group">
                                <label for="title">ชื่อชุด</label>
                                <h4>{{$group->group_title ?? '-'}}</h4>
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