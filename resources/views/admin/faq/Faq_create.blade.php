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
							<h4 class="m-0">คำถามที่พบบ่อย</h4>
						</div>
						<div class="ml-3">
							<a href="{{route('faq')}}">
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
                        เพิ่มคำถาม
                    </div>
                    <div class="card-body">
                        <p>ค่าที่มี <span class="text-danger">*</span> จำเป็นต้องใส่ให้ครบ</p>

                        <form action="{{route('faq_insert')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="faq_type_id">หมวดหมู่คำถาม <span class="text-danger">*</span></label>
                                <select class="form-control" name="faq_type_id">
                                    @foreach($faq_types as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="faq_THtopic">ชื่อหัวข้อคำถาม <span class="text-danger">*</span></label>
                                <input type="text" name="faq_THtopic" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="faq_THanswer">คำตอบ <span class="text-danger">*</span></label>
                                <textarea name="faq_THanswer" id="summernote" class="form-control"></textarea>
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
