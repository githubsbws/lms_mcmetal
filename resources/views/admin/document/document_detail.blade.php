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
								<h4 class="m-0">เอกสารและประเภทเอกสาร</h4>
							</div>
							<div class="ml-3">
								<a href="{{route('document')}}">
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
							เอกสาร
						</div>
						<div class="card-body">
								<div class="form-group">
									<label for="cms_title">ประเภทเอกสาร</label>
									<h4>{{ $type->download_name ?? '-' }}</h4>
								</div>
	
								<div class="form-group">
									<label for="cms_short_title">Path ของ YouTube </label>
									<h4>{{ $document->filedoc_name }}</a></h4>
								</div>

                                <div class="form-group">
									<label for="cms_short_title">ไฟล์ที่ดาว์นโหลด </label>
									<h4>{{ $document->filedocname}}</a></h4>
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
