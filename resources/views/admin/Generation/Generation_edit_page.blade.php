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
                    <li><a href="/admin/index.php">หน้าหลัก</a></li> » <li><a href="/admin/index.php/contactus/index">จัดการรุ่นผู้เรียน</a></li> »
                    <li>แก้ไขข้อมูลรุ่นผู้เรียน</li>
                </ul><!-- breadcrumbs -->
                <div class="separator bottom"></div>

                <!-- innerLR -->
                <div class="innerLR">
                    <div class="widget widget-tabs border-bottom-none">
                        <div class="widget-head">
                            <ul>
                                <li class="active">
                                    <a class="glyphicons edit" href="#account-details" data-toggle="tab">
                                        <i></i>แก้ไขข้อมูลรุ่นผู้เรียน</a>
                                </li>
                            </ul>
                        </div>
                        <div class="widget-body">
                            
                            <div class="form">
                                <form enctype="multipart/form-data" id="generation_edit" action="/generation_edit/{{$generation_edit_page->id}}" method="post">
                                    @csrf
                                    <p class="note">ค่าที่มี <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> จำเป็นต้องใส่ให้ครบ</p>

                                    <div class="row">
                                        <label for="orgchart_id" class="required">รหัสรุ่น<span class="required">*</span></label>
                                        <input size="60" maxlength="250" class="span8" name="orgchart_id" id="orgchart_id" type="text" value={{$generation_edit_page->orgchart_id}}>
                                    </div>
                                    <div class="row">
                                        <label for="course_id" class="required">รหัสคอร์ส <span class="required">*</span></label>
                                        <input size="60" maxlength="250" class="span8" name="course_id" id="course_id" type="text"  value={{$generation_edit_page->course_id}}>
                                    </div>

                                    
                                    <div class="row buttons">
                                        <button class="btn btn-primary btn-icon glyphicons ok_2"><i></i>บันทึกข้อมูล</button>
                                    </div>
                                </form>
                            </div><!-- form -->
                        </div>
                    </div>
                </div>
                <!-- END innerLR -->

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
