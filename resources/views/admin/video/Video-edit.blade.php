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
								<a href="{{route('video')}}">
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
							แก้ไขตัวอย่าง Vdo YouTube
						</div>
						<div class="card-body">
							<form action="{{route('video_update',$vdo->vdo_id)}}" enctype="multipart/form-data" method="post" id="question-form">
								@csrf
								<div class="form-group">
									<label for="cms_title">แก้ไขหัวข้อวิดีโอ</label>
									<textarea name="vdo_path" id="summernote" class="form-control">{{ htmlspecialchars_decode(htmlspecialchars_decode($vdo->vdo_title)) }}</textarea>
								</div>
	
								<div class="form-group">
									<label for="cms_short_title">แก้ไข Path ของ YouTube </label>
									<input type="text" name="vdo_path" class="form-control" value="{{$vdo->vdo_path}}">
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
<script>
	$(document).ready(function() {
		$('#summernote').summernote();
		});
</script>
</body>

@endsection