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
							<h4 class="m-0">ระบบวิธีการใช้งาน</h4>
						</div>
						<div class="ml-3">
							<a href="{{route('usability')}}">
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
						วิธีการใช้งาน
					</div>
					<div class="card-body">
						<form action="{{route('usability.edit',$usa->usa_id)}}" enctype="multipart/form-data" method="post" id="question-form">
							@csrf
							<div class="form-group">
								<label for="usa_title">หัวข้อวิธีการใช้งาน</label>
								<input type="text" name="usa_title" class="form-control" value="{{$usa->usa_title}}">
							</div>

							<div class="form-group">
								<label for="usa_detail">รายละเอียดย่อ </label>
								<textarea name="usa_detail" id="summernote" class="form-control">{{ htmlspecialchars_decode(htmlspecialchars_decode($usa->usa_detail)) }}</textarea>
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