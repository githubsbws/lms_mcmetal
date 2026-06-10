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
							เพิ่มข่าวสารและกิจกรรม
						</div>
						<div class="card-body">
							<p>ค่าที่มี <span class="text-danger">*</span> จำเป็นต้องใส่ให้ครบ</p>

							<form action="{{route('news.create')}}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<label for="cms_title">ชื่อหัวข้อ <span class="text-danger">*</span></label>
									<input type="text" name="cms_title" class="form-control" required>
								</div>

								<div class="form-group">
									<label for="cms_short_title">รายละเอียดย่อ</label>
									<input type="text" name="cms_short_title" class="form-control" required>
								</div>

								<div class="form-group">
									<label for="summernote">เนื้อหาข่าว</label>
									<textarea name="cms_detail" id="summernote" class="form-control"></textarea>
								</div>

                                <div class="form-group">
									<label for="summernote">วันหมดอายุข่าว</label>
									<input type="date" name="cms_expire" class="form-control"></input>
								</div>

								<div class="form-group">
									<label for="summernote">รูปภาพ</label>
									<div class="fileupload fileupload-new" data-provides="fileupload">
										<div class="input-append">
											<div class="uneditable-input span3">
												<i class="icon-file fileupload-exists"></i>
												<span class="fileupload-preview"></span>
											</div>
											<img id="previewImage" src="#" alt="Preview Image" style="display: none;">
											<span class="btn btn-default btn-file">
												<span class="fileupload-new">Select file</span>
												<span class="fileupload-exists">Change</span>
												{{-- <input id="ytNews_cms_picture" type="hidden" value="{{$news->cms_picture}}" name="cms_picture"> --}}
												<input name="image" id="imageInput"  type="file" >
											</span>
											<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
											{{-- <input type="file" id="imageInput" name="image"> --}}

										</div>
										<script>
											document.addEventListener('DOMContentLoaded', function() {
												var imageInput = document.getElementById('imageInput');
												var previewImage = document.getElementById('previewImage');

												imageInput.addEventListener('change', function() {
													previewImageFile(this);
												});

												function previewImageFile(input) {
													var file = input.files[0];
													if (file) {
														var reader = new FileReader();
														reader.onload = function(e) {
															previewImage.src = e.target.result;
															previewImage.style.display = 'block';
														};
														reader.readAsDataURL(file);
													}
												}
											});
										</script>
									</div>
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
<script>
	$(document).ready(function() {
		$('#summernote').summernote();
		});
</script>
</body>
@endsection
