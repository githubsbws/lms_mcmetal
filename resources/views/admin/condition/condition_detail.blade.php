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
								<h4 class="m-0">ระบบเงื่อนไขการใช้งาน</h4>
							</div>
							<div class="ml-3">
								<a href="{{route('condition')}}">
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
							รายละเอียดเงื่อนไขการใช้งาน
						</div>
						<div class="card-body">
								<div class="form-group">
									<label for="cms_title">หัวข้อเงื่อนไขการใช้งาน</label>
									<h4>{!! htmlspecialchars_decode($conditions->conditions_title) !!}</h4>
								</div>
	
								<div class="form-group">
									<label for="cms_short_title">รายละเอียดเงื่อนไขการใช้งาน </label>
									{!! htmlspecialchars_decode($conditions->conditions_detail) !!}
								</div>
						</div>
					</div>
				</div>
				<div id="sidebar">
				</div><!-- sidebar -->
			</div>
			<!-- </div> -->
			<!-- <div class="span-5 last"> -->
			<!-- </div> -->
			<!-- // Content END -->

		</div>
		<div class="clearfix"></div>
</body>

@endsection



