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
						แก้ไขสไลด์รูปภาพ
					</div>
					<div class="card-body">
						<form action="{{route('imgslide_update',$imgslide->imgslide_id)}}" enctype="multipart/form-data" method="post" id="question-form">
							@csrf
							<div class="form-group">
								<label for="imgslide_link">ชื่อลิ้งค์</label>
								<input type="text" name="imgslide_link" class="form-control" value="{{$imgslide->imgslide_link}}">
							</div>

							<div class="form-group">
								<font color="#990000">
									<span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> ตัวอย่าง http://www.cpdland.com/
								</font>
							</div>

							<div class="form-group">
								<label for="Imgslide_imgslide_picture" class="required">แก้ไขรูปภาพประกอบ</label>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="input-append">
										<div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div><span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input id="ytImgslide_imgslide_picture" type="hidden" value="{{$imgslide->imgslide_picture}}" name="imgslide_picture"><input name="imgslide_picture" id="Imgslide_imgslide_picture" type="file"></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="imgslide_link">รูปภาพ</label>
								<img src="{{asset('images/uploads/imgslides/'.$imgslide->imgslide_picture)}}" style="width: 100%;height:100%;">
							</div>

							<div class="form-group">
								<font color="#990000">
									<span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span><br> รูปภาพควรมีขนาด 1000x300
									<br><b>Note:</b>Only File JPG, JPEG, PNG, GIF & PDF to allow
								</font>
							</div>

							<button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
						</form>
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