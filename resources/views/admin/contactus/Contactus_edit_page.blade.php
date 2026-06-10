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
                    <li><a href="{{route('admin')}}">หน้าหลัก</a></li> » <li><a >ติดต่อเรา</a></li> »
                    <li>แก้ไขข้อมูลติดต่อเรา</li>
                </ul><!-- breadcrumbs -->
                <div class="separator bottom"></div>

                <!-- innerLR -->
                <div class="innerLR">
                    <div class="widget widget-tabs border-bottom-none">
                        <div class="widget-head">
                            <ul>
                                <li class="active">
                                    <a class="glyphicons edit" href="#account-details" data-toggle="tab">
                                        <i></i>แก้ไขข้อมูลติดต่อเรา</a>
                                </li>
                            </ul>
                        </div>
                        <div class="widget-body">
                            
                            <div class="form">
                                <form enctype="multipart/form-data" id="contactus_edit" action="{{ route('contactus.edit_page',['id' => $contactus_edit_page->contac_id]) }}" method="post">
                                    @csrf
                                    <p class="note">ค่าที่มี <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> จำเป็นต้องใส่ให้ครบ</p>

                                    <div class="row">
                                        <label for="faq_type_title_TH" class="required">ชื่อ <span class="required">*</span></label>
                                        <input size="60" maxlength="250" class="span8" name="contac_by_name" id="contac_by_name" type="text" value={{$contactus_edit_page->contac_by_name}}>
                                    </div>
                                    <div class="row">
                                        <label for="contac_by_surname" class="required">นามสกุล <span class="required">*</span></label>
                                        <input size="60" maxlength="250" class="span8" name="contac_by_surname" id="contac_by_surname" type="text"  value={{$contactus_edit_page->contac_by_surname}}>
                                    </div>

                                    <div class="row">
                                        <label for="contac_by_email" class="required">อีเมล <span class="required">*</span></label>
                                        <input size="60" maxlength="250" class="span8" name="contac_by_email" id="contac_by_email" type="text"  value={{$contactus_edit_page->contac_by_email}}>
                                        <span id="email-error" style="color: red;"></span>
                                    </div>

                                    <div class="row">
                                        <label for="contac_by_tel" class="required">เบอร์โทรศัพท์ <span class="required">*</span></label>
                                        <input size="60" maxlength="250" class="span8" name="contac_by_tel" id="contac_by_tel" type="text"  value={{$contactus_edit_page->contac_by_tel}}>
                                        <span id="tel-error" style="color: red;"></span>
                                    </div>

                                    <div class="row">
                                        <label for="contac_subject" class="required">หัวข้อติดต่อ <span class="required">*</span></label>
                                        <input size="60" maxlength="250" class="span8" name="contac_subject" id="contac_subject" type="text" value={{$contactus_edit_page->contac_subject}}>
                                    </div>

                                    <div class="row">
                                        <label for="contac_detail" class="required">รายละเอียดติดต่อ <span class="required">*</span></label>
                                        <textarea class="span8" name="contac_detail" id="contac_detail" rows="6">{{$contactus_edit_page->contac_detail}}</textarea>
                                    </div>

                                    <div class="row">
                                        <label for="contac_ans_subject" class="required">หัวข้อคำตอบ <span class="required">*</span></label>
                                        <input size="60" maxlength="250" class="span8" name="contac_ans_subject" id="contac_ans_subject" type="text" value={{$contactus_edit_page->contac_ans_subject}}>
                                    </div>

                                    <div class="row">
                                        <label for="contac_ans_detail" class="required">รายละเอียดคำตอบ <span class="required">*</span></label>
                                        <textarea class="span8" name="contac_ans_detail" id="contac_ans_detail" rows="6 ">{{$contactus_edit_page->contac_ans_detail}}</textarea>
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
