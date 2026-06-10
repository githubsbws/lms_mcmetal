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
					<ul class="breadcrumb">
						<li><a href="/admin/index.php">หน้าหลัก</a></li> » <li>Log การยืนยันสมัครสมาชิกบุคคล</li>
					</ul><!-- breadcrumbs -->
					<div class="separator bottom"></div>
	
	
					<div class="innerLR">
						<div class="widget" style="margin-top: -1px;">
							<div class="widget-head">
								<h4 class="heading glyphicons show_thumbnails_with_lines"><i></i> Log การยืนยันสมัครสมาชิกบุคคล</h4>
							</div>
							<div class="widget-body">
								<div class="separator bottom form-inline small">
									<span class="pull-right">
										<label class="strong">แสดงแถว:</label>
										<select class="selectpicker" data-style="btn-default btn-small" onchange="$.updateGridView('News-grid', 'news_per_page', this.value)" name="news_per_page" id="news_per_page" style="display: none;">
											<option value="">ค่าเริ่มต้น (10)</option>
											<option value="10">10</option>
											<option value="50">50</option>
											<option value="100">100</option>
											<option value="200">200</option>
											<option value="250">250</option>
										</select>
										<div class="btn-group bootstrap-select"><button class="btn dropdown-toggle clearfix btn-default btn-small" data-toggle="dropdown" id="news_per_page"><span class="filter-option pull-left">ค่าเริ่มต้น (10)</span>&nbsp;<span class="caret"></span></button>
											<div class="dropdown-menu" role="menu">
												<ul style="max-height: none; overflow-y: auto;">
													<li rel="0"><a tabindex="-1" href="#">ค่าเริ่มต้น (10)</a></li>
													<li rel="1"><a tabindex="-1" href="#">10</a></li>
													<li rel="2"><a tabindex="-1" href="#">50</a></li>
													<li rel="3"><a tabindex="-1" href="#">100</a></li>
													<li rel="4"><a tabindex="-1" href="#">200</a></li>
													<li rel="5"><a tabindex="-1" href="#">250</a></li>
												</ul>
											</div>
										</div>
									</span>
								</div>
								<div class="clear-div"></div>
								<div class="overflow-table">
									<div style="margin-top: -1px;" id="News-grid" class="grid-view">
										<table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
											<thead>
												<tr>
													<th class="checkbox-column" id="chk"><input class="select-on-check-all" type="checkbox" value="1" name="chk_all" id="chk_all"></th>
													<th id="News-grid_c1">Controller</th>
													<th id="News-grid_c2"><a class="sort-link" style="color:white;" href="/admin/index.php/news/index?News_sort=cms_title">firsname</a></th>
													<th id="News-grid_c3"><a class="sort-link" style="color:white;" href="/admin/index.php/news/index?News_sort=cms_short_title">lastname</a></th>
													<th id="News-grid_c3"><a class="sort-link" style="color:white;" href="/admin/index.php/news/index?News_sort=cms_short_title">registerDate</a></th>
													<th id="News-grid_c3"><a class="sort-link" style="color:white;" href="/admin/index.php/news/index?News_sort=cms_short_title">confirmDate</a></th>
													<th id="News-grid_c3"><a class="sort-link" style="color:white;" href="/admin/index.php/news/index?News_sort=cms_short_title">confirmUser</a></th>
													<th id="News-grid_c3"><a class="sort-link" style="color:white;" href="/admin/index.php/news/index?News_sort=cms_short_title">username</a></th>
												</tr>
												<tr class="filters">
													<td>&nbsp;</td>
													<td>&nbsp;</td>
													<td><input name="News[cms_title]" type="text" maxlength="250"></td>
													<td><input name="News[cms_short_title]" type="text"></td>
													<td>&nbsp;</td>
												</tr>
											</thead>
											<tbody>
												@foreach ($logapporvepersonal as $item)
												<tr class="odd selectable">
													<td class="checkbox-column"><input class="select-on-check" value="78" id="chk_0" type="checkbox" name="chk[]"></td>
													<td>{{ $item->firsname}}</td>
													<td>{{ $item->lastname}}</td>
													<td >{{$item->register_date}}</td>
													<td >{{$item->confirm_date}}</td>
													<td >{{$item->confirm_user}}</td>
													<td >{{$item->username}}</td>
												</tr>
												@endforeach
											</tbody>
										</table>
										<div class="pagination pull-right">
											<ul class="pagination margin-top-none" id="yw0">
												<li class="first"><a href="{{url('logapporvepersonal')}}">&lt;&lt; หน้าแรก</a></li>
												@if ($logapporvepersonal->currentPage() > 1)
												<li class="previous"><a href="{{ $logapporvepersonal->previousPageUrl() }}" class="pagination-link">หน้าที่แล้ว</a></li>
												@endif
												@for ($i = max(1, $logapporvepersonal->currentPage() - 3); $i <= min($logapporvepersonal->lastPage(), $logapporvepersonal->currentPage() + 3); $i++)
												<li class="page"><a href="{{ $logapporvepersonal->url($i) }}" class="pagination-link {{ ($i == $logapporvepersonal->currentPage()) ? 'active' : '' }}">{{ $i }}</a></li>
												@endfor
												@if ($logapporvepersonal->currentPage() < $logapporvepersonal->lastPage())
												<li class="next"><a href="{{ $logapporvepersonal->nextPageUrl() }}" class="pagination-link">หน้าถัดไป</a></li>
												@endif
												@if ($logapporvepersonal->currentPage() == $logapporvepersonal->lastPage())
												<li class="last"><a href="{{ $logapporvepersonal->lastPage() }}"  class="pagination-link">หน้าสุดท้าย &gt;&gt;</a></li>
												@endif
											</ul>
										</div>
										<div class="keys" style="display:none" title="/admin/index.php/News/index"><span>78</span><span>77</span><span>74</span><span>72</span><span>71</span><span>70</span><span>68</span><span>67</span><span>66</span><span>65</span></div>
										<input type="hidden" name="News[news_per_page]" value="">
									</div>
								</div>
							</div>
						</div>
	
						<!-- Options -->
						<div class="separator top form-inline small">
							<!-- With selected actions -->
							<div class="buttons pull-left">
								<a class="btn btn-primary btn-icon glyphicons circle_minus" onclick="return multipleDeleteNews('/admin/index.php/News/MultiDelete','News-grid');" href="#"><i></i> ลบข้อมูลทั้งหมด</a>
							</div>
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

</body>
@endsection