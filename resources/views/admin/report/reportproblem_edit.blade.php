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
							<h4 class="m-0">ระบบจัดการปัญหาการใช้งาน</h4>
						</div>
						<div class="ml-3">
							<a href="{{route('reportproblem')}}">
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
						จัดการปัญหาการใช้งาน
					</div>
					<div class="card-body">
						<form action="{{route('reportproblem.edit',$reportproblem->id)}}" enctype="multipart/form-data" method="post" id="question-form">
							@csrf
							<div class="form-group">
								<label for="firstname">ชื่อ - นามสกุลผู้ส่ง</label>
								<input type="text" name="firstname" class="form-control" value="{{$reportproblem->profile->firstname}} {{$reportproblem->profile->lastname}}" readonly>
							</div>

							<div class="form-group">
								<label for="email">อีเมลล์ผู้ส่ง </label>
								<input type="text" name="email" class="form-control" value="{{ $reportproblem->email}}" readonly>
							</div>

							<div class="form-group">
								<label for="report_detail">รายละเอียดปัญหา </label>
								<input type="text" name="report_detail" class="form-control" value="{{ $reportproblem->report_detail}}" readonly>
							</div>

							<div class="form-group">
								<label for="answer">วิธีแก้ปัญหา </label>
								<textarea name="answer" id="summernote" class="form-control">{{ htmlspecialchars_decode(htmlspecialchars_decode($reportproblem->answer )) }}</textarea>
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