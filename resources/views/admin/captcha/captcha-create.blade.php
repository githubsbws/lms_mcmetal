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
                            <h4 class="m-0">ระบบ Captcha</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('admin')}}">
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
						เพิ่มระบบ Captcha
					</div>
					<div class="card-body">
						<p>ค่าที่มี <span class="text-danger">*</span> จำเป็นต้องใส่ให้ครบ</p>
						<form enctype="multipart/form-data" id="captcha-form" action="captcha_insert" method="post">
								@csrf
								{{-- <p class="note">ค่าที่มี <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> จำเป็นต้องใส่ให้ครบ</p> --}}
								<div class="form-group">
									{{-- <label for="capt_name" class="required">ชื่อเงื่อนไข<span class="required">*</span></label> <input size="60" maxlength="250" class="span8" name="capt_name" id="capt_name" type="text" > <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> --}}
									<label for="capt_name">ชื่อเงื่อนไข <span class="text-danger">*</span></label>
									<input size="60" maxlength="250" class="form-control" name="capt_name" id="capt_name" type="text" >
									<div class="error help-block">
										<div class="label label-important" id="News_cms_title_em_" style="display:none"></div>
									</div>
								</div>

								{{-- <div class="row">
									<label for="type" class="required">ชนิด<span class="required">*</span></label> <input size="60" maxlength="250" class="span8" name="type" id="type"  type="text"  > <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
									<div class="error help-block">
										<div class="label label-important" id="type" style="display:none"></div>
									</div>
								</div> --}}

								<div class="form-group">
									{{-- <label for="capt_times" class="required">ระยะเวลาการแสดงแคปช่า<span class="required">*</span></label> <input size="60" maxlength="250" class="span8" name="capt_times" id="capt_times" type="number" > <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> --}}
									<label for="capt_name">ระยะเวลาการแสดงแคปช่า <span class="text-danger">*</span></label>
									<input size="60" maxlength="250" class="form-control" name="capt_times" id="capt_times" type="number" >
									<div class="error help-block">
										<div class="label label-important" id="capt_times" style="display:none"></div>
									</div>
								</div>


							</div>
							<div class="card-footer">
								<button class="btn btn-primary btn-icon glyphicons ok_2"><i></i>บันทึกข้อมูล</button>
							</div>
						</form>
					</div>
					
				</div>
			</div>
			<!-- Content -->
			<!-- <div class="span-19"> -->
			{{-- <div id="content">
				<!-- breadcrumbs -->
				<div class="separator bottom"></div>
				<div class="innerLR">
					<!-- Box -->
					<div class="hero-unit well">
						<div class="widget-head">
							<h4 class="heading glyphicons show_thumbnails_with_lines"><i></i>จัดการระบบCaptcha >> เพิ่มระบบCaptcha</h4>
						</div>
						<hr class="separator">
						<!-- Row -->
						<div class="form">
							<form enctype="multipart/form-data" id="captcha-form" action="captcha_insert" method="post">
								@csrf
								<p class="note">ค่าที่มี <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> จำเป็นต้องใส่ให้ครบ</p>
								<div class="row">
									<label for="capt_name" class="required">ชื่อเงื่อนไข<span class="required">*</span></label> <input size="60" maxlength="250" class="span8" name="capt_name" id="capt_name" type="text" > <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
									<div class="error help-block">
										<div class="label label-important" id="News_cms_title_em_" style="display:none"></div>
									</div>
								</div>

								<div class="row">
									<label for="type" class="required">ชนิด<span class="required">*</span></label> <input size="60" maxlength="250" class="span8" name="type" id="type"  type="text"  > <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
									<div class="error help-block">
										<div class="label label-important" id="type" style="display:none"></div>
									</div>
								</div>

								<div class="row">
									<label for="capt_times" class="required">ระยะเวลาการแสดงแคปช่า<span class="required">*</span></label> <input size="60" maxlength="250" class="span8" name="capt_times" id="capt_times" type="number" > <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
									<div class="error help-block">
										<div class="label label-important" id="capt_times" style="display:none"></div>
									</div>
								</div>


							</div>
							<div class="row buttons">
								<button class="btn btn-primary btn-icon glyphicons ok_2"><i></i>บันทึกข้อมูล</button>
							</div>
						</form>
							<!-- // Row END -->

						</div>
						<!-- // Row END -->

					</div>
					<!-- // Box END -->
				</div>
				<div id="sidebar">
				</div><!-- sidebar -->
			</div> --}}
			<!-- // Content END -->
		</div>
	</div>
		<div class="clearfix"></div>
</body>

@endsection