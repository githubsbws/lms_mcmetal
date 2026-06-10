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
								<h4 class="m-0">Organization chart</h4>
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
				<div class="separator bottom"></div>
				<style>
					body {
						margin: 0;
						/* Reset default margin */
					}

					iframe {
						display: block;
						/* iframes are inline by default */
						background: #000;
						border: none;
						/* Reset default border */
						height: 100vh;
						/* Viewport-relative units */
						width: 100%;
					}
				</style>
				<div class="content">
					<div class="container-fluid">
						<iframe src="{{ route('orgchart.ifram') }}" scrolling="yes"></iframe>
					</div>
				</div>
				<div id="sidebar">
				</div><!-- sidebar -->
			</div>
		</div>
		<div class="clearfix"></div>
</body>
@endsection