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
                    <li><a href="/admin/index.php">หน้าหลัก</a></li> » <li><a href="/admin/index.php/faq/index">ระบบแบบสอบถาม</a></li> »
                    <li>เพิ่มคำถาม</li>
                </ul><!-- breadcrumbs -->
                <div class="separator bottom"></div>

                <!-- innerLR -->
                <div class="innerLR">
                    <div class="widget widget-tabs border-bottom-none">
                        <div class="widget-head">
                            <ul>
                                <li class="active">
                                    <a class="glyphicons edit" href="#account-details" data-toggle="tab">
                                        <i></i>เพิ่มคำถาม</a>
                                </li>
                            </ul>
                        </div>
                        <div class="widget-body">
                            <div class="form">
                                <form enctype="multipart/form-data" id="question_insert" action="/question_insert" method="post">
                                    @csrf
                                    <p class="note">ค่าที่มี <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> จำเป็นต้องใส่ให้ครบ</p>

                                    <div class="row">
                                        <label for="group_id" class="required">หมวดหมู่คำถาม <span class="required">*</span></label>
                                        <select class="span8 custom-dropdown" name="group_id" id="group_id">
                                            @foreach($grouptesting as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        <label for="ques_type" class="required">ประเภทคำถาม <span class="required">*</span></label>
                                        <input size="60" maxlength="250" class="span8" name="ques_type" id="ques_type" type="text">
                                    </div>
                                    <div class="row">
                                        <label for="test_type" class="required">ประเภทแบบทดสอบ <span class="required">*</span></label>
                                        <input size="60" maxlength="250" class="span8" name="test_type" id="test_type" type="text">
                                    </div>
                                    <div class="row">
                                        <label for="difficult" class="required">ระดับความยาก <span class="required">*</span></label>
                                        <input size="60" maxlength="250" class="span8" name="difficult" id="difficult" type="text">
                                    </div>
                                    <div class="row">
                                        <label for="ques_title" class="required">คำถาม <span class="required">*</span></label>
                                        <input size="60" maxlength="250" class="span8" name="ques_title" id="ques_title" type="text">
                                    </div>

                                    <div class="row">
                                        <label for="ques_explain" class="required">คำตอบ <span class="required">*</span></label>
                                        <textarea class="span8" name="ques_explain" id="ques_explain" rows="6"></textarea>
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
