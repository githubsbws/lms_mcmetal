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
								<h4 class="m-0">ระบบตัวอย่าง Vdo YouTube</h4>
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
							เพิ่มตัวอย่าง Vdo YouTube
						</div>
						<div class="card-body">
							<p>ค่าที่มี <span class="text-danger">*</span> จำเป็นต้องใส่ให้ครบ</p>
	
							<form action="{{route('video_insert')}}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<label for="vdo_title">หัวข้อวิดีโอ <span class="text-danger">*</span></label>
									<textarea name="vdo_title" id="summernote" class="form-control"></textarea>
								</div>
	
								<div class="form-group">
									<label for="vdo_path">Path ของ YouTube</label>
									<input type="text" name="vdo_path" class="form-control" required>
								</div>

								<div class="form-group">
									<font color="#990000">
										<span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> ตัวอย่าง http://www.youtube.com/watch?v=xLgnkRxlKCg
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
			<!-- // Content END -->

		</div>
		<div class="clearfix"></div>
<script>
	$(document).ready(function() {
		$('#summernote').summernote();
		});
</script>
</body>
@endsection