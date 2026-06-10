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
								<a href="{{route('admin')}}">
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
							เพิ่มเอกสารและประเภทเอกสาร
						</div>
						<div class="card-body">
							<p>ค่าที่มี <span class="text-danger">*</span> จำเป็นต้องใส่ให้ครบ</p>
	
							<form action="{{route('document_type.create')}}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<label for="document_title">หัวข้อ <span class="text-danger">*</span></label>
									<select class="form-control" name="document_title" id="document_title">
                                        <option value="">--- หัวข้อ ---</option>
                                        @foreach ($document_title as $item)
                                        <option value="{{ $item->title_id}}">{{$item->title_name}}</option>
                                        @endforeach
                                    </select> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
								</div>
	
								<div class="form-group">
									<label for="download_name">ชื่อประเภท</label>
									<input type="text" name="download_name" class="form-control" required>
								</div>

								<div class="card-footer">
								<button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
								</div>
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
