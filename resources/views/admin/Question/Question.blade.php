@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<body>

    <!-- Main Container Fluid -->
    <div class="container-fluid fluid menu-left">

        <!-- include top navbar -->
        @include('admin.layouts.partials.top-nav')

        <!-- Sidebar menu & content wrapper -->
        <div id="wrapper">

            <!-- Sidebar Menu -->
            @include('admin.layouts.partials.menu-left')

            <!-- Content -->
            <div id="content">
				<ul class="breadcrumb">
					<li><a href="/admin/index.php">หน้าหลัก</a></li> » <li>หมวดคำถาม</li>
				</ul><!-- breadcrumbs -->
				<div class="separator bottom"></div>

				<div class="innerLR">
					<!--	-->
					<div class="widget" style="margin-top: -1px;">
						<div class="widget-head">
							<h4 class="heading glyphicons show_thumbnails_with_lines"><i></i> หมวดคำถาม</h4>
						</div>
						<div class="widget-body">
							<div class="separator bottom form-inline small">
								<span class="pull-right">
									<label class="strong">แสดงแถว:</label>
									<select class="selectpicker" data-style="btn-default btn-small" onchange="$.updateGridView('FaqType-grid', 'news_per_page', this.value)" name="news_per_page" id="news_per_page" style="display: none;">
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
								<div style="margin-top: -1px;" id="FaqType-grid" class="grid-view">
									<table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
										<thead>
											<tr>
												<th class="checkbox-column" id="chk"><input class="select-on-check-all" type="checkbox" value="1" name="chk_all" id="chk_all"></th>
												<th id="FaqType-grid_c1"><a class="sort-link" style="color:white;" href="/admin/index.php/faqType/index?FaqType_sort=faq_type_title_TH">หมวดคำถาม</a></th>
                                                <th class="button-column" id="FaqType-grid_c2">ประเภทคำถาม</th>
												<th class="button-column" id="FaqType-grid_c2">คำถาม</th>
                                                <th class="button-column" id="FaqType-grid_c2">คำตอบ</th>
                                                <th class="button-column" id="FaqType-grid_c2">จัดการ</th>


                                            </tr>
										</thead><tbody>
                                    @foreach ($question as $item)
                                    @if($item->active === 'y')

                                        <tr>
                                            <td class="checkbox-column"><input class="select-on-check" value="{{$item->ques_id}}" id="chk_0" type="checkbox" name="chk[]"></td>
                                            <td>{{ $item->group_title}}</td>
                                            @if($item->ques_type == '1')
                                            <td>Checkbox</td>
                                            @elseif($item->ques_type == '2')
                                            <td>Radio</td>
                                            @elseif($item->ques_type == '3')
                                            <td>Textarea</td>
                                            @else
                                            <td>ทุกประเภท</td>
                                            @endif
                                            <td>{!! htmlspecialchars_decode($item->ques_title) !!}</td>
                                            <td>{!! htmlspecialchars_decode($item->ques_explain) !!}</td>
                                            <td style="width: 90px;" class="center"><a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/question/{{$item->ques_id}}"> <i></i></a> <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="question_edit_page/{{$item->ques_id}}"><i></i></a> <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/question_delete/{{$item->ques_id}}" onclick="return confirm('คุณต้องการลบคำถาม {{$item->ques_title}} หรือไม่?')"><i></i></a></td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination pull-right">
                                <ul class="pagination margin-top-none" id="yw0">
                                    <li class="first "><a href="{{url('question')}}">&lt;&lt; หน้าแรก</a></li>
                                    @if ($question->currentPage() > 1)
                                    <li class="previous "><a href="{{ $question->previousPageUrl() }}" class="pagination-link">หน้าที่แล้ว</a></li>
                                    @endif
                                    @for ($i = max(1, $question->currentPage() - 3); $i <= min($question->lastPage(), $question->currentPage() + 3); $i++)
                                    <li class="page"><a href="{{ $question->url($i) }}" class="pagination-link {{ ($i == $question->currentPage()) ? 'active' : '' }}">{{ $i }}</a></li>
                                    @endfor
                                    @if ($question->currentPage() < $question->lastPage())
                                    <li class="next"><a href="{{ $question->nextPageUrl() }}" class="pagination-link">หน้าถัดไป</a></li>
                                    @endif
                                    @if ($question->currentPage() == $question->lastPage())
                                    <li class="last"><a href="{{ $question->lastPage() }}"  class="pagination-link">หน้าสุดท้าย &gt;&gt;</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Survey Table -->
                </div>

                <div id="sidebar">
                    <!-- sidebar content if any -->
                </div>

            </div>
            <!-- // Content END -->

        </div>
        <div class="clearfix"></div>
        <!-- // Sidebar menu & content wrapper END -->

        <!-- Footer -->
        <div id="footer" class="hidden-print">
            <div class="copy">© 2024 - All Rights Reserved.</div>
        </div>
        <!-- // Footer END -->

    </div>

</body>
@endsection
