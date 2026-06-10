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
                            <h4 class="m-0">ระบบชุดข้อสอบบทเรียนออนไลน์</h4>
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
                        เพิ่มหลักสูตรนิสิต/นักศึกษา
                    </div>
                    <div class="card-body">
                        <p>ค่าที่มี <span class="text-danger">*</span> จำเป็นต้องใส่ให้ครบ</p>

                        <form action="{{route('grouptesting_create')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="cate_id">ชื่อหลักสูตรออนไลน์ <span class="text-danger">*</span></label>
                                <select  class="form-control" name="lesson_id">
									<option value="">--- กรุณาเลือกหลักสูตร ---</option>
									@foreach ($lesson as $item)
									<option value="{{ $item->course_id}}">{{$item->course_title}}</option>
									@endforeach
								</select>
                            </div>

                            <div class="form-group">
                                <label for="group_title">ชื่อชุด <span class="text-danger">*</span></label>
                                <input type="text" name="group_title" class="form-control" required>
                            </div>

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
</body>
@endsection