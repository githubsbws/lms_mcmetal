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
							<h4 class="m-0">ระบบ Captcha</h4>
						</div>
						<div class="ml-3">
							<a href="{{route('captcha')}}">
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
						รายละเอียดCaptcha
					</div>
					<div class="card-body">
						<form action="{{route('captcha_edit',$captcha->capid)}}" enctype="multipart/form-data" method="post" id="question-form">
							@csrf
							<div class="form-group">
								<label for="capt_name">ชื่อเงื่อนไข</label>
								<input class="form-control" name="capt_name" type="text" value="{{$captcha->capt_name}}" >
							</div>

							<div class="form-group">
								<label for="capt_times">ระยะเวลาการแสดงแคปช่า</label>
								<input class="form-control" name="capt_times" type="text" value="{{$captcha->capt_times}}" >
							</div>

							<div class="card-footer">
								<button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
								</div>
						</form>
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