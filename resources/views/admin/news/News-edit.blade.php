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
							แก้ไขข่าวสารและกิจกรรม
						</div>
						<div class="card-body">
							<form action="{{route('news.edit',$news->cms_id)}}" enctype="multipart/form-data" method="post" id="question-form">
								@csrf
								<div class="form-group">
									<label for="cms_title">ชื่อหัวข้อ</label>
									<input type="text" name="cms_title" class="form-control" value="{{ $news->cms_title }}">
								</div>

								<div class="form-group">
									<label for="cms_short_title">รายละเอียดย่อ</label>
									<input type="text" name="cms_short_title" class="form-control" value="{{ $news->cms_short_title }}">
								</div>

								<div class="form-group">
									<label for="cms_short_title">เนื้อหาข่าว </label>
									<textarea name="cms_detail" id="summernote" class="form-control">{{ htmlspecialchars_decode(htmlspecialchars_decode($news->cms_detail)) }}</textarea>
								</div>

                                <div class="form-group">
									<label for="summernote">วันหมดอายุข่าว</label>
									<input type="date" name="cms_expire" class="form-control" value="{{ $news->expired_date }}"></input>
								</div>

								<div class="form-group">
									<label for="News_cms_picture">รูปภาพ</label>
									<h3><img src="{{asset('images/uploads/news/'.$news->cms_id.'/original/'.$news->cms_picture)}}"></h3>
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
												<input id="ytNews_cms_picture" type="hidden" value="{{$news->cms_picture}}" name="cms_picture">
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
<script>
	$(document).ready(function() {
		$('#summernote').summernote();
		});
</script>
</body>
@endsection
