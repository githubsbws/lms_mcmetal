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
            <div id="content">
                <ul class="breadcrumb">
                    <li><a href="/admin/index.php">หน้าหลัก</a></li> » <li>แสดงข้อมูลรุ่นของผู้เรียน</li>
                </ul><!-- breadcrumbs -->
                <div class="separator bottom"></div>

                <div class="innerLR">
                    <div class="widget" data-toggle="collapse-widget" data-collapse-closed="true">
                        <div class="widget-head">
                            <h4 class="heading glyphicons search"><i></i>ค้นหาขั้นสูง</h4>
                            <span class="collapse-toggle"></span>
                        </div>
                        <div class="widget-body collapse" style="height: 0px;">
                            <div class="search-form">
                                <div class="wide form">
                                    <form id="SearchFormAjax" action="/admin/index.php/orgchart/index" method="get">
                                        <div class="row"><label>คำถาม</label><input class="span6" name="Orgchart[orgchart_id]" id="Orgchart_orgchart_id" type="text" maxlength="250"></div>
                                        <div class="row"><button class="btn btn-primary btn-icon glyphicons search"><i></i> ค้นหา</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget" style="margin-top: -1px;">
                        <div class="widget-head">
                            <h4 class="heading glyphicons show_thumbnails_with_lines"><i></i> ข้อมูลรุ่นของผู้เรียน</h4>
                        </div>
                        <div class="widget-body">
                            <div class="separator bottom form-inline small">
                                <span class="pull-right" style="margin-left: 10px;">
                                    <a class="btn btn-primary btn-icon glyphicons circle_plus" href={{url('/generation_create')}}><i></i> เพิ่มข้อมูลรุ่น</a>
                                </span>
                                <span class="pull-right">
                                    <label class="strong">แสดงแถว:</label>
                                    <select class="selectpicker" data-style="btn-default btn-small" onchange="$.updateGridView('Orgchart-grid', 'news_per_page', this.value)" name="news_per_page" id="news_per_page" style="display: none;">
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
                                <div style="margin-top: -1px;" id="Orgchart-grid" class="grid-view">
                                    <table class="table table-striped table-bordered table-condensed dataTable table-primary js-table-sortable ui-sortable">
                                        <thead>
                                            <tr>
                                                <th class="checkbox-column" id="chk"><input class="select-on-check-all" type="checkbox" value="1" name="chk_all" id="chk_all"></th>
                                                <th id="Orgchart-grid_c1"><a class="sort-link" style="color:white;" href="/admin/index.php/orgchart/index?Orgchart_sort=orgchart_id">รหัสรุ่น</a></th>
                                                <th id="Orgchart-grid_c2"><a class="sort-link" style="color:white;" href="/admin/index.php/orgchart/index?Orgchart_sort=course_id">รหัสคอร์ส</a></th>
                                                <th id="Orgchart-grid_c3"><a class="sort-link" style="color:white;" href="/admin/index.php/orgchart/index?Orgchart_sort=parent_id">รหัส</a></th>
                                                <th id="Orgchart-grid_c4" class="button-column">จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($generation as $item)
                                            @if($item->active === 'y')
                                                <tr class="odd selectable">
                                                    <td class="checkbox-column"><input class="select-on-check" value="{{$item->orgchart_id}}" id="chk_{{$item->orgchart_id}}" type="checkbox" name="chk[]"></td>
                                                    <td>{{$item->orgchart_id}}</td>
                                                    <td>{{$item->course_id}}</td>
                                                    <td>{{$item->parent_id}}</td>
                                                    <td style="width: 90px;" class="center">
                                                        <a class="btn-action glyphicons eye_open btn-info" title="ดูรายละเอียด" href="/admin/index.php/generation/{{$item->id}}"><i></i></a>
                                                        <a class="btn-action glyphicons pencil btn-success" title="แก้ไข" href="/generation_edit_page/{{$item->id}}"><i></i></a>
                                                        <a class="btn-action glyphicons pencil btn-danger remove_2" title="ลบ" href="/generation_delete/{{$item->id}}" onclick="return confirm('คุณต้องการลบข้อมูลรุ่น {{$item->orgchart_id}} หรือไม่?')"><i></i></a>
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="keys" style="display:none" title="/admin/index.php/orgchart/index"><span>35</span><span>34</span></div>
                                    <input type="hidden" name="Orgchart[news_per_page]" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Options -->
                    <div class="separator top form-inline small">
                        <!-- With selected actions -->
                        <div class="buttons pull-left">
                            <a class="btn btn-primary btn-icon glyphicons circle_minus" onclick="return multipleDeleteNews('/admin/index.php/orgchart/MultiDelete','Orgchart-grid');" href="#"><i></i> ลบข้อมูลทั้งหมด</a>
                        </div>
                        <!-- // With selected actions END -->
                        <div class="clearfix"></div>
                    </div>
                    <!-- // Options END -->

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
