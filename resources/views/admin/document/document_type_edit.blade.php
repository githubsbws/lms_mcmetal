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
							แก้ไขเอกสารและประเภทเอกสาร
						</div>
						<div class="card-body">
							<form action="{{route('document_type.edit',['id' =>$document_type->download_id])}}" enctype="multipart/form-data" method="post" id="question-form">
								@csrf
								<div class="form-group">
									<label for="cms_title">หัวข้อ</label>
									<select class="form-control" name="document_title" id="document_title">
                                        <option value="{{ $document_type->title_id }}">{{ $document_type->title_name }}</option>
                                        @foreach ($document_title as $item)
                                        <option value="{{ $item->title_id}}">{{$item->title_name}}</option>
                                        @endforeach
                                    </select>
								</div>
	
								<div class="form-group">
									<label for="download_name">ชื่อหัวข้อ </label>
									<input type="text" name="download_name" class="form-control" value="{{ $document_type->download_name }}">
								</div>

								<button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
							</form>
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
