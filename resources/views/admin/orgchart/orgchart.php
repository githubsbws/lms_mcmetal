<?php include 'head.php' ?>

<body class="">

	<!-- Main Container Fluid -->
	<div class="container-fluid fluid menu-left">

		<!-- Top navbar -->
		<?php include 'top-nav.php' ?>
		<!-- Top navbar END -->


		<!-- Sidebar menu & content wrapper -->
		<div id="wrapper">

			<!-- Sidebar Menu -->
			<?php include 'menu-left.php' ?>
			<!-- // Sidebar Menu END -->


			<!-- Content -->
			<!-- <div class="span-19"> -->
			<div id="content">
				<ul class="breadcrumb">
					<li><a href="/admin/index.php">หน้าหลัก</a></li> » <li>Org Charts</li>
				</ul><!-- breadcrumbs -->
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
				<div class="innerLR">
					<div class="widget" style="margin-top: -1px;">
						<div class="widget-head">
							<h4 class="heading glyphicons show_thumbnails_with_lines"><i></i> Organization chart</h4>
						</div>
						<div class="widget-body">
							<!--			<div class="spacer"></div>-->
							<iframe src="/admin/index.php/orgchart/orgchart2"></iframe>
							<!--			<div>-->
							<!--				--><!--			</div>-->
						</div>
					</div>

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

</body>

<?php include 'footer.php' ?>
