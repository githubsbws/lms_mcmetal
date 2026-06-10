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
						เพิ่มสไลด์รูปภาพ
					</div>
					<div class="card-body">
						<p>ค่าที่มี <span class="text-danger">*</span> จำเป็นต้องใส่ให้ครบ</p>

						<form action="{{ route('imgslide_insert')}}" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="imgslide_link">ชื่อลิ้งค์ <span class="text-danger">*</span></label>
								<input type="text" name="imgslide_link" class="form-control" required>
							</div>

							<div class="form-group">
								<label for="Imgslide_imgslide_picture" class="required">รูปภาพประกอบ <span class="required">*</span></label>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="input-append">
										<div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i><span class="fileupload-preview"></span></div><span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input id="ytImgslide_imgslide_picture" type="hidden" value="" name="imgslide_picture"><input name="imgslide_picture" id="Imgslide_imgslide_picture" type="file"></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
									</div>
								</div>
							</div>

							<div class="form-group">
								<font color="#990000">
									<span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> รูปภาพควรมีขนาด 1000x300
									<br><b>Note:</b>Only File JPG, JPEG, PNG, GIF & PDF to allow
								</font>
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
	</div>
	<div class="clearfix"></div>
</body>

@endsection