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
							<h4 class="m-0">ระบบสไลด์รูปภาพ</h4>
						</div>
						<div class="ml-3">
							<a href="{{route('imgslide')}}">
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
						สไลด์รูปภาพ
					</div>
					<div class="card-body">
							<div class="form-group">
								<label for="imgslide_link">ชื่อลิ้งค์</label>
								<h4>{{ $imgslide->imgslide_link}}</h4>
							</div>

							<div class="form-group">
								<label for="cms_short_title">รูปภาพประกอบ </label>
								<h4><img src="{{asset('images/uploads/imgslides/'.$imgslide->imgslide_picture)}}" style="width: 100%;height:100%;"></h4>
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