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
							<h4 class="m-0">ระบบวิธีการใช้งาน</h4>
						</div>
						<div class="ml-3">
							<a href="{{route('usability')}}">
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
						วิธีการใช้งาน
					</div>
					<div class="card-body">
							<div class="form-group">
								<label for="cms_title">หัวข้อวิธีการใช้งาน</label>
								<h4>{{ $usa->usa_title }}</h4>
							</div>

							<div class="form-group">
								<label for="cms_short_title">รายละเอียดย่อ </label>
								<h4>{!! htmlspecialchars_decode($usa->usa_detail) !!}</h4>
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