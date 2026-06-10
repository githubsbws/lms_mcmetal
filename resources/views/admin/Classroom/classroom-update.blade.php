@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<head>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
</head>

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
				<ul class="breadcrumb">
					<li><a href="{{route('admin')}}">หน้าหลัก</a></li> » <li>จัดการระบบห้องเรียนออนไลน์</li>
				</ul><!-- breadcrumbs -->
				<div class="separator bottom"></div>


				<div class="innerLR">
					<div class="widget" style="margin-top: -1px;">
						<div class="widget-head">
							<h4 class="heading glyphicons show_thumbnails_with_lines"><i></i>จัดการระบบห้องเรียนออนไลน์</h4>
						</div>
						<div class="widget-body">
							
							<div class="clear-div"></div>
							<div class="overflow-table">
								<div style="margin-top: -1px;" id="News-grid" class="grid-view">
                                    <form enctype="multipart/form-data" id="classroom-form" action="{{route('classroom_update',$zoom->id)}}" method="post">
                                        @csrf
                                            <th >ชื่อห้องเรียน</th><td><input id="title" type="text" value="{{$zoom->title}}" name="title"></td>
                                            <th >ลิ้งค์</th><td><input id="title" type="text" value="{{$zoom->join_url}}" name="join_url"></td>
                                            <th >เวลาเริ่มต้น-สิ้นสุด</th><td><input id="title" type="datetime-local" value="{{$zoom->start_date}}" name="start_date"></td>
                                            <div class="row buttons">
                                                <button class="btn btn-primary btn-icon glyphicons ok_2"><i></i>บันทึกข้อมูล</button>
                                                </div>
                                            </form>
                                            </tbody>
                                      </div>
									
								</div>
							</div>
						</div>
					</div>
					<!-- Options -->
					<div class="separator top form-inline small">
						<!-- With selected actions -->
						
						<!-- // With selected actions END -->
						<div class="clearfix"></div>
					</div>
					<!-- // Options END -->

				</div>
				<div id="sidebar">
				</div><!-- sidebar -->
			</div>
			<!-- </div> -->
			<!-- <div class="span-5 last"> -->
			<!-- </div> -->
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
@endsection
