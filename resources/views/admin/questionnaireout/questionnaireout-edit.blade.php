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
							<h4 class="m-0">ระบบแบบประเมินผลการฝึกอบรม</h4>
						</div>
						<div class="ml-3">
							<a href="{{ route('questionnaireout') }}">
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
						รายละเอียดแบบประเมินผลการฝึกอบรม
					</div>
					<div class="card-body">
						<form action="{{route('questionnaireout_update',$survey_headers->survey_header_id)}}" enctype="multipart/form-data" method="post" id="question-form">
							@csrf

							<div class="form-group">
                                <label for="survey_name">ชื่อหมวดหัวข้อ</label>
                                <input type="text" name="survey_name" class="form-control" value="{{$survey_headers->survey_name}}">
                            </div>

							<div class="form-group">
								<label for="instructions">รายละเอียดหัวข้อ</label>
								<textarea name="instructions" id="summernote" class="form-control">{{ htmlspecialchars_decode(htmlspecialchars_decode($survey_headers->instructions)) }}</textarea>
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