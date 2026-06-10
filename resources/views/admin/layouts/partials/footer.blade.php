
	<!-- JQuery -->
	

	<!-- Modernizr -->
	<script src="{{asset('Adminkit/theme/scripts/plugins/system/modernizr.js')}}"></script>

	<!-- Bootstrap -->
	<script src="{{asset('Adminkit/bootstrap/js/bootstrap.min.js')}}"></script>

	<!-- SlimScroll Plugin -->
	<script src="{{asset('Adminkit/theme/scripts/plugins/other/jquery-slimScroll/jquery.slimscroll.min.js')}}"></script>

	<!-- Common Demo Script -->
	<script src="{{asset('Adminkit/theme/scripts/demo/common.js')}}"></script>

	<!-- Holder Plugin -->
	<script src="{{asset('Adminkit/theme/scripts/plugins/other/holder/holder.js')}}"></script>

	<!-- Uniform Forms Plugin -->
	<script src="{{asset('Adminkit/theme/scripts/plugins/forms/pixelmatrix-uniform/jquery.uniform.min.js')}}"></script>

	<!-- Global -->
	<script>
		var basePath = '';
	</script>

	<!-- Bootstrap Extended -->
	<script src="{{asset('Adminkit/bootstrap/extend/bootstrap-select/bootstrap-select.js')}}"></script>
	<script src="{{asset('Adminkit/bootstrap/extend/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js')}}"></script>
	<script src="{{asset('Adminkit/bootstrap/extend/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js')}}"></script>
	<script src="{{asset('Adminkit/bootstrap/extend/jasny-bootstrap/js/jasny-bootstrap.min.js')}}"></script>
	<script src="{{asset('Adminkit/bootstrap/extend/jasny-bootstrap/js/bootstrap-fileupload.js')}}"></script>
	<script src="{{asset('Adminkit/bootstrap/extend/bootbox.js')}}"></script>
	<script src="{{asset('Adminkit/bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js')}}"></script>
	<script src="{{asset('Adminkit/bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.js')}}"></script>

	<!-- Google Code Prettify -->
	<script src="{{asset('Adminkit/theme/scripts/plugins/other/google-code-prettify/prettify.js')}}"></script>

	<!-- JQueryUI -->
	<script src="{{asset('Adminkit/theme/scripts/plugins/system/jquery-ui/js/jquery-ui-1.9.2.custom.min.js')}}"></script>

	<!-- JQueryUI Touch Punch -->
	<!-- small hack that enables the use of touch events on sites using the jQuery UI user interface library -->
	<script src="{{asset('Adminkit/theme/scripts/plugins/system/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

	<!-- Gritter Notifications Plugin -->
	<script src="{{asset('Adminkit/theme/scripts/plugins/notifications/Gritter/js/jquery.gritter.min.js')}}"></script>

	<!-- Notyfy Notifications Plugin -->
	<script src="{{asset('Adminkit/theme/scripts/plugins/notifications/notyfy/jquery.notyfy.js')}}"></script>

	<!-- MiniColors Plugin -->
	<script src="{{asset('Adminkit/theme/scripts/plugins/color/jquery-miniColors/jquery.miniColors.js')}}"></script>

	<!-- DateTimePicker Plugin -->
	<script src="{{asset('Adminkit/theme/scripts/plugins/forms/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>

	<!-- Cookie Plugin -->
	<script src="{{asset('Adminkit/theme/scripts/plugins/system/jquery.cookie.js')}}"></script>

	<!-- Colors -->
	<script>
		var primaryColor = '#e25f39',
			dangerColor = '#bd362f',
			successColor = '#609450',
			warningColor = '#ab7a4b',
			inverseColor = '#45484d';
	</script>

	<!-- Themer -->
	<script>
		var themerPrimaryColor = primaryColor;
	</script>
	<script src="{{asset('Adminkit/theme/scripts/demo/themer.js')}}"></script>

	<!-- Twitter Feed -->
	<script src="{{asset('Adminkit/theme/scripts/demo/twitter.js')}}"></script>

	<!-- Easy-pie Plugin -->
	<script src="{{asset('Adminkit/theme/scripts/plugins/charts/easy-pie/jquery.easy-pie-chart.js')}}"></script>

	<!-- Sparkline Charts Plugin -->
	<script src="{{asset('Adminkit/theme/scripts/plugins/charts/sparkline/jquery.sparkline.min.js')}}"></script>

	<!-- Ba-Resize Plugin -->
	<script src="{{asset('Adminkit/theme/scripts/plugins/other/jquery.ba-resize.js')}}"></script>

	<!-- Dashboard Demo Script -->
	<script src="{{asset('Adminkit/theme/scripts/demo/index.js')}}"></script>


	<!-- Google JSAPI -->
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>

	<!--  Flot Charts Plugin -->
	<script src="{{asset('Adminkit/theme/scripts/plugins/charts/flot/jquery.flot.js')}}"></script>
	<script src="{{asset('Adminkit/theme/scripts/plugins/charts/flot/jquery.flot.pie.js')}}"></script>
	<script src="{{asset('Adminkit/theme/scripts/plugins/charts/flot/jquery.flot.tooltip.js')}}"></script>
	<script src="{{asset('Adminkit/theme/scripts/plugins/charts/flot/jquery.flot.selection.js')}}"></script>
	<script src="{{asset('Adminkit/theme/scripts/plugins/charts/flot/jquery.flot.resize.js')}}"></script>
	<script src="{{asset('Adminkit/theme/scripts/plugins/charts/flot/jquery.flot.orderBars.js')}}"></script>

	<!-- Charts Helper Demo Script -->
	<script src="{{asset('Adminkit/theme/scripts/demo/charts.helper.js')}}"></script>


	<!-- Optional Resizable Sidebars -->
	<!--[if gt IE 8]><!-->
	<script src="{{asset('Adminkit/theme/scripts/demo/resizable.js')}}"></script><!--<![endif]-->

	<!-- Bootstrap Image Gallery -->
	<script src="http://blueimp.github.com/JavaScript-Load-Image/load-image.min.js"></script>
	<script src="{{asset('Adminkit/bootstrap/extend/bootstrap-image-gallery/js/bootstrap-image-gallery.min.js')}}" type="text/javascript"></script>
	<script>
		//Load the Visualization API and the table/core chart package.
		google.load('visualization', '1.0', {
			'packages': ['table', 'corechart']
		});

		// Set a callback to run when the Google Visualization API is loaded.
		google.setOnLoadCallback(charts.traffic_sources_dataTables.init);
	</script>
