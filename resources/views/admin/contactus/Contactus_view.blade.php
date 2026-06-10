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
                                    <div class="row">
                                        <label for="faq_type_title_TH" class="required"><h3>ชื่อ</h3></label>
                                        <h5>{{$contactus->contac_by_name}}</h5>
                                    </div>
                                    <div class="row">
                                        <label for="contac_by_surname" class="required"><h3>นามสกุล</h3></label>
                                        <h5>{{$contactus->contac_by_surname}}</h5>
                                    </div>

                                    <div class="row">
                                        <label for="contac_by_email" class="required"><h3>อีเมล</h3></label>
                                        <h5>{{$contactus->contac_by_email}}</h5>
                                        
                                    </div>

                                    <div class="row">
                                        <label for="contac_by_tel" class="required"><h3>เบอร์โทรศัพท์</h3></label>
                                        <h5>{{$contactus->contac_by_tel}}</h5>
                                        
                                    </div>

                                    <div class="row">
                                        <label for="contac_subject" class="required"><h3>หัวข้อติดต่อ</h3></label>
                                        <h5>{{$contactus->contac_subject}}</h5>
                                    </div>

                                    <div class="row">
                                        <label for="contac_detail" class="required"><h3>รายละเอียดติดต่อ</h3></label>
                                        <h5>{{$contactus->contac_detail}}</h5>
                                    </div>

                                    <div class="row">
                                        <label for="contac_ans_subject" class="required"><h3>หัวข้อคำตอบ</h3></label>
                                        <h5>{{$contactus->contac_ans_subject}}</h5>
                                    </div>

                                    <div class="row">
                                        <label for="contac_ans_detail" class="required"><h3>รายละเอียดคำตอบ</h3></label>
                                        <h5>{{$contactus->contac_ans_detail}}</h5>
                                    </div>
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
