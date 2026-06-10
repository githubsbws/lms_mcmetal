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
								<h4 class="m-0">ระบบข่าวสารและกิจกรรม</h4>
							</div>
							<div class="ml-3">
								<a href="{{route('news')}}">
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
							รายละเอียดข่าวสารและกิจกรรม
						</div>
						<div class="card-body">
								<div class="form-group">
									<label for="cms_title">ชื่อหัวข้อ</label>
									<h4>{{ $news->cms_title }}</h4>
								</div>

								<div class="form-group">
									<label for="cms_title">รายละเอียดย่อ</label>
									<h4>{{ $news->cms_short_title }}</h4>
								</div>
	
								<div class="form-group">
									<label for="cms_short_title">เนื้อหาข่าว </label>
									{!! htmlspecialchars_decode($news->cms_detail) !!}
								</div>

								<div class="form-group">
									<label for="News_cms_picture">รูปภาพ</label>
									<h3><img src="{{asset('images/uploads/news/'.$news->cms_id.'/original/'.$news->cms_picture)}}"></h3>
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