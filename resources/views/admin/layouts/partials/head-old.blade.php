<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <html class="ie gt-ie8"> <![endif]-->
<!--[if !IE]><!-->
<html><!-- <![endif]-->

<head>
	<title>ระบบบริหารจัดการ E Learning - Contitions</title>

	<!-- Meta -->
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" crossorigin href="/assets/index-CNiHm67Y.css">
	{{-- <script src="{{asset('themes/bws/plugins/system/jquery.min.js')}}"></script> --}}
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<!-- ✅ DataTables -->
	<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
	<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
	<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
	<link rel="stylesheet" href="{{asset('asset_admin/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset_admin/includes/css/style.css')}}">

	<script src="{{asset('asset_admin/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('asset_admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('asset_admin/dist/js/adminlte.js')}}"></script>
	{{-- @vite([
		"resources/Adminkit/bootstrap/css/bootstrap.css",
		"resources/Adminkit/bootstrap/css/responsive.css",
		"resources/Adminkit/theme/css/glyphicons.css",
		"resources/Adminkit/theme/scripts/plugins/forms/pixelmatrix-uniform/css/uniform.default.css",
		"resources/Adminkit/theme/scripts/plugins/other/excanvas/excanvas.js",
		"resources/Adminkit/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap.min.css",
		"resources/Adminkit/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap-responsive.min.css",
		"resources/Adminkit/bootstrap/extend/bootstrap-wysihtml5/css/bootstrap-wysihtml5-0.0.2.css",
		"resources/Adminkit/bootstrap/extend/bootstrap-select/bootstrap-select.css",
		"resources/Adminkit/bootstrap/extend/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css",
		"resources/Adminkit/theme/scripts/plugins/forms/select2/select2.css",
		"resources/Adminkit/theme/scripts/plugins/forms/bootstrap-datetimepicker/css/datetimepicker.css",
		"resources/Adminkit/theme/scripts/plugins/system/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.min.css",
		"resources/Adminkit/theme/scripts/plugins/color/jquery-miniColors/jquery.miniColors.css",
		"resources/Adminkit/theme/scripts/plugins/notifications/notyfy/jquery.notyfy.css",
		"resources/Adminkit/theme/scripts/plugins/notifications/notyfy/themes/default.css",
		"resources/Adminkit/theme/scripts/plugins/notifications/Gritter/css/jquery.gritter.css",
		"resources/Adminkit/theme/scripts/plugins/charts/easy-pie/jquery.easy-pie-chart.css",
		"resources/Adminkit/theme/scripts/plugins/other/google-code-prettify/prettify.css",
		"resources/Adminkit/bootstrap/extend/bootstrap-image-gallery/css/bootstrap-image-gallery.min.css",
		"resources/Adminkit/theme/css/style.min.css",
		"resources/Adminkit/theme/scripts/plugins/system/less.min.js"
	])	 --}}
	<script src="{{ asset('themes/bws/js/sweetalert.min.js')}}"></script>
	<script src="{{asset('js/tinymce-4.3.4/tinymce.min.js')}}" type="text/javascript"></script>
	<script type="text/javascript" src="{{asset('js/jquery.validate.js')}}"></script>
	<script type="module" crossorigin src="/assets/index-BL4sPiOY.js"></script>
</head>