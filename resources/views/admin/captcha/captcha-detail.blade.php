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
							<div class="form-group">
								<label for="cms_title">ชื่อเงื่อนไข</label>
								<h4>{{$captcha->capt_name}}</h4>
							</div>

							<div class="form-group">
								<label for="cms_title">ชนิด</label>
								<h4>{{$captcha->type}}</h4>
							</div>

							<div class="form-group">
								<label for="cms_title">ระยะเวลาการแสดงแคปช่า</label>
								<h4>{{$captcha->capt_times}}</h4>
							</div>
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