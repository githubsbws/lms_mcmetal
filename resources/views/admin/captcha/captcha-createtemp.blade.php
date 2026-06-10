@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')

<body class="">

	<!-- Main Container Fluid -->
	<div class="container-fluid fluid menu-left">

		<!-- Top navbar -->
		@include('admin.layouts.partials.top-nav')
		<!-- Top navbar END -->


		<!-- Sidebar menu & content wrapper -->
		<div id="wrapper">

			<!-- Sidebar Menu -->
			@include('admin.layouts.partials.menu-left')
			<!-- // Sidebar Menu END -->


			<!-- Content -->
			<!-- <div class="span-19"> -->
			<div id="content">
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
    
                                {{-- <div class="row">
                                    <label for="type" class="required">ชนิด<span class="required">*</span></label> <input size="60" maxlength="250" class="span8" name="type" id="type"  type="text"  > <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
                                    <div class="error help-block">
                                        <div class="label label-important" id="type" style="display:none"></div>
                                    </div>
                                </div> --}}

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
			</div>
			<!-- // Content END -->

		</div>
		<div class="clearfix"></div>
		<!-- // Sidebar menu & content wrapper END -->

		<div id="footer" class="hidden-print">

			<!--  Copyright Line -->
			<div class="copy">© 2023 - All Rights Reserved.</a></div>
			<!--  End Copyright Line -->

		</div>
		<!-- // Footer END -->

	</div>

</body>

@endsection