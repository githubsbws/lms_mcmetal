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
								<h4 class="m-0">ระบบตัวอย่าง Vdo YouTube</h4>
							</div>
							<div class="ml-3">
								<a href="{{route('video')}}">
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
							ตัวอย่าง Vdo YouTube
						</div>
						<div class="card-body">
								<div class="form-group">
									<label for="cms_title">หัวข้อวิดีโอ</label>
									<h4>{!! htmlspecialchars_decode($vdo->vdo_title) !!}</h4>
								</div>
	
								<div class="form-group">
									<label for="cms_short_title">Path ของ YouTube </label>
									<h4><a href="{{$vdo->vdo_path}}">{{$vdo->vdo_path}}</a></h4>
								</div>
						</div>
					</div>
				</div>
				<div id="sidebar">
				</div><!-- sidebar -->
			</div>
			<!-- // Content END -->

		</div>
		<div class="clearfix"></div>

</body>
@endsection