@extends('admin.layouts.mainlayout')
@section('title', 'Admin')
@section('content')

<body class="">
		<div id="wrapper">
			<div class="content-wrapper">
				<div class="content-header">
					<div class="container-fluid">
						<div class="d-flex align-items-center">
							<div class="">
								<h4 class="m-0">ระบบชุดข้อสอบบทเรียนออนไลน์</h4>
							</div>
							<div class="ml-3">
								<a href="{{ redirect()->back()->getTargetUrl() }}">
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
							รายละเอียดข้อสอบบทเรียนออนไลน์
						</div>
						<div class="card-body">
							<form action="{{route('ques.edit',['id' => $group->ques_id])}}" enctype="multipart/form-data" method="post" id="question-form">
								@csrf
								<div class="form-group">
									<label for="ques_title">คำถาม</label>
									<textarea name="ques_title" id="summernote" class="form-control">{{ htmlspecialchars_decode(htmlspecialchars_decode($group->ques_title)) }}</textarea>
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