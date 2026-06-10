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
								<h4 class="m-0">ระบบเกี่ยวกับเรา</h4>
							</div>
							<div class="ml-3">
								<a href="{{route('aboutus')}}">
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
							แก้ไขรายละเอียดเกี่ยวกับเรา
						</div>
						<div class="card-body">
							<form action="{{ route('aboutus.update',['id' => $about_detail->about_id]) }}" enctype="multipart/form-data" method="post" id="question-form">
								@csrf
								<div class="form-group">
									<label for="cms_title">หัวข้อเกี่ยวกับเรา</label>
									<input type="text" name="about_title" class="form-control" value="{{ $about_detail->about_title }}">
								</div>
	
								<div class="form-group">
									<label for="cms_short_title">รายละเอียดเกี่ยวกับเรา </label>
									<textarea name="about_detail" id="summernote" class="form-control">{{ htmlspecialchars_decode(htmlspecialchars_decode($about_detail->about_detail)) }}</textarea>
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



