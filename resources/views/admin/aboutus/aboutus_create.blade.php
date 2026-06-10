@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<body class="">
		<div id="wrapper">
			<div class="content-wrapper pl-5">
				<div class="content-header">
					<div class="container-fluid">
						<div class="d-flex align-items-center">
							<div class="">
								<h4 class="m-0">ระบบเกี่ยวกับเรา</h4>
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
							เพิ่มข้อมูลเกี่ยวกับเรา
						</div>
						<div class="card-body">
							<p>ค่าที่มี <span class="text-danger">*</span> จำเป็นต้องใส่ให้ครบ</p>
	
							<form action="{{route('aboutus.create')}}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<label for="about_title">ชื่อหัวข้อ <span class="text-danger">*</span></label>
									<input type="text" name="about_title" class="form-control" required>
								</div>
	
								<div class="form-group">
									<label for="summernote">เนื้อหาเกี่ยวกับเรา</label>
									<textarea name="about_detail" id="summernote" class="form-control"></textarea>
								</div>
	
								<div class="card-footer">
								<button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
								</div>
							</form>
						</div>
					</div>
				</div>
		</div>
		<div class="clearfix"></div>
</body>
<script>
	$(document).ready(function() {
		$('#summernote').summernote();
		});
</script>
@endsection



