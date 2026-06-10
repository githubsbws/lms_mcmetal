	<!-- Top navbar -->
	<div class="navbar main hidden-print">

		<!-- Brand -->
		<a href="index.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left" class="appbrand"><span>AdminKIT <span>v1.3</span></span></a>

		<!-- Menu Toggle Button -->
		<button type="button" class="btn btn-navbar">
			<span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
		</button>
		<!-- // Menu Toggle Button END -->

		<!-- Top Menu -->
		<ul class="topnav pull-left tn1">

			<!-- Themer -->
			<li class="hidden-phone">
				<a href="#themer" data-toggle="collapse" class="glyphicons eyedropper"><i></i><span>Themer</span></a>
				<div id="themer" class="collapse">
					<div class="wrapper">
						<span class="close2">&times; close</span>
						<h4>Themer <span>color options</span></h4>
						<ul>
							<li>Theme: <select id="themer-theme" class="pull-right"></select>
								<div class="clearfix"></div>
							</li>
							<li>Primary Color: <input type="text" data-type="minicolors" data-default="#ffffff" data-slider="hue" data-textfield="false" data-position="left" id="themer-primary-cp" />
								<div class="clearfix"></div>
							</li>
							<li>
								<span class="link" id="themer-custom-reset">reset theme</span>
								<span class="pull-right"><label>advanced <input type="checkbox" value="1" id="themer-advanced-toggle" /></label></span>
							</li>
						</ul>
						<div id="themer-getcode" class="hide">
							<hr class="separator" />
							<button class="btn btn-primary btn-small pull-right btn-icon glyphicons download" id="themer-getcode-less"><i></i>Get LESS</button>
							<button class="btn btn-inverse btn-small pull-right btn-icon glyphicons download" id="themer-getcode-css"><i></i>Get CSS</button>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</li>
			<!-- // Themer END -->

		</ul>
		<!-- // Top Menu END -->

		<!-- Top Menu Right -->
		<ul class="topnav pull-right">

			<!-- Language menu -->
			<!--  <li class="hidden-phone" id="lang_nav">
	            <a href="#" data-toggle="dropdown"><img src="theme/images/lang/en.png" alt="en" /></a>
	            <ul class="dropdown-menu pull-left">
	                <li class="active"><a href="?page=index&amp;lang=en&amp;layout_type=fluid&amp;menu_position=menu-left" title="English"><img src="theme/images/lang/en.png" alt="English"> English</a></li>
	                <li><a href="?page=index&amp;lang=ro&amp;layout_type=fluid&amp;menu_position=menu-left" title="Romanian"><img src="theme/images/lang/ro.png" alt="Romanian"> Romanian</a></li>
	                <li><a href="?page=index&amp;lang=it&amp;layout_type=fluid&amp;menu_position=menu-left" title="Italian"><img src="theme/images/lang/it.png" alt="Italian"> Italian</a></li>
	                <li><a href="?page=index&amp;lang=fr&amp;layout_type=fluid&amp;menu_position=menu-left" title="French"><img src="theme/images/lang/fr.png" alt="French"> French</a></li>
	                <li><a href="?page=index&amp;lang=pl&amp;layout_type=fluid&amp;menu_position=menu-left" title="Polish"><img src="theme/images/lang/pl.png" alt="Polish"> Polish</a></li>
	            </ul>
	        </li> -->
			<!-- // Language menu END -->

			<!-- Dropdown -->
			<li class="dropdown visible-abc">
				<a href="" data-toggle="dropdown" class="glyphicons cogwheel"><i></i>คู่มือการใช้งาน<span class="caret"></span></a>
				<ul class="dropdown-menu pull-right">
					<li><a href="">คู่มือสำหรับผู้ดูแลระบบ</a></li>
					<li><a href="">คู่มือสำหรับผู้ใช้งาน</a></li>

				</ul>
			</li>
			<!-- // Dropdown END -->

			<!-- Profile / Logout menu -->
			<li class="account">
				<a data-toggle="dropdown" href="my_account.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left" class="glyphicons logout lock"><span class="hidden-phone text">admin</span><i></i></a>
				<ul class="dropdown-menu pull-right">
					<li><a href="my_account.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left" class="glyphicons cogwheel">Settings<i></i></a></li>
					<li><a href="my_account.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left" class="glyphicons camera">My Photos<i></i></a></li>
					<li class="highlight profile">
						<span>
							<span class="heading">Profile <a href="my_account.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left" class="pull-right">edit</a></span>
							<span class="img"></span>
							<span class="details">
								<a href="my_account.html?lang=en&amp;layout_type=fluid&amp;menu_position=menu-left">Admin</a>
								contact@mosaicpro.biz
							</span>
							<span class="clearfix"></span>
						</span>
					</li>
					<li>
						<span>
							<form id="logout-form" action="{{ route('logout.admin') }}" method="POST" style="display: none;">
								@csrf
							</form>
							<a class="btn btn-default btn-mini pull-right" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign
								Out</a>

							{{-- <form id="logout-form" action="{{ route('logout.admin') }}" method="POST" style="display: none;">
								@csrf
								<button class="btn btn-default btn-mini pull-right" type="submit" >Sign Out</button>
							</form> --}}
							
						</span>
					</li>
				</ul>
			</li>
			<!-- // Profile / Logout menu END -->

		</ul>
		<!-- // Top Menu Right END -->

	</div>
	<!-- Top navbar END -->
	