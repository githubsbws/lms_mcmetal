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
						<form action="{{ route('grouptesting.edit', ['id' =>$group->group_id]) }}" enctype="multipart/form-data" method="post" id="question-form">
                            @csrf
                            <div class="form-group">
                                <label for="course_title">ชื่อบทเรียนออนไลน์</label>
								<select class="form-control" name="lesson_id">
                                    <option value="">เลือกหลักสูตร</option>
                                    @foreach ($lesson as $lesson_id)
                                        <option value="{{ $lesson_id->course_id }}"
                                            {{ $group->course_id == $lesson_id->course_id ? 'selected' : '' }}>
                                            {{ $lesson_id->course_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="group_title">ชื่อชุด</label>
								<input type="text" name="group_title" class="form-control" value="{{ $group->group_title }}">
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