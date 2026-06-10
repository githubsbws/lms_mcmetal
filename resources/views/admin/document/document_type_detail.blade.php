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
								<a href="{{route('document.type')}}">
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
							เอกสารและประเภทเอกสาร
						</div>
						<div class="card-body">
                                <div class="form-group">
                                    <label for="cms_title">ประเภทเอกสาร</label>
                                    <h4>{{ $document_type->downloadTitle->title_name}}</h4>
                                </div>
								<div class="form-group">
									<label for="cms_title">ชื่อหัวข้อ</label>
									<h4>{{ $document_type->download_name}}</h4>
								</div>
	
								<div class="form-group">
									<label for="cms_short_title">วันที่เพิ่มข้อมูล </label>
									<h4>{{ $document_type->update_date }}</h4>
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
