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
						{{-- <h1>Ouch! <span>404 error</span></h1>
						<hr class="separator">
						<!-- Row -->
						<div class="row-fluid row-merge">

							<!-- Column -->
							<div>
								<div class="innerAll left">
									<p>It seems the page you are looking for is not here anymore. The page might have moved to another address or just removed by our staff.</p>
								</div>
							</div> --}}
							<!-- // Column END -->
							<i></i>เพิ่มเอกสารและกิจกรรม </a>
						</li>
					</ul>
				</div>
				<div class="widget-body">
					<div class="form">
						<form enctype="multipart/form-data" id="document-form" action="document_insert" method="post">
							@csrf
							<p class="note">ค่าที่มี <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> จำเป็นต้องใส่ให้ครบ</p>
							<div class="row">
								<label for="News_cms_title" class="required">ชื่อหัวข้อ <span class="required">*</span></label> <input size="60" maxlength="250" class="span8" name="usa_title" id="document_cms_title" type="text" > <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
								<div class="error help-block">
									<div class="label label-important" id="News_cms_title_em_" style="display:none"></div>
								</div>
							</div>

							<div class="row">
								<label for="News_cms_short_title" class="required">รายละเอียดย่อ <span class="required">*</span></label> <textarea rows="4" cols="40" class="span8" maxlength="255" name="usa_detail" id="document_cms_short_title" ></textarea> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
								<div class="error help-block">
									<div class="label label-important" id="News_cms_short_title_em_" style="display:none"></div>
								</div>
							</div>


						</div>
						<div class="row buttons">
							<button class="btn btn-primary btn-icon glyphicons ok_2"><i></i>บันทึกข้อมูล</button>
						</div>
					</form>
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