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
                    <li><a href="/admin/index.php">หน้าหลัก</a></li> » <li><a href="/admin/index.php/generation/index">จัดการรุ่นผู้เรียน</a></li> »
                    <li>เพิ่มข้อมูลติดต่อ</li>
                </ul><!-- breadcrumbs -->
                <div class="separator bottom"></div>

                <!-- innerLR -->
                <div class="innerLR">
                    <div class="widget widget-tabs border-bottom-none">
                        <div class="widget-head">
                            <ul>
                                <li class="active">
                                    <a class="glyphicons edit" href="#account-details" data-toggle="tab">
                                        <i></i>เพิ่มรุ่นผู้เรียน</a>
                                </li>
                            </ul>
                        </div>
                        <div class="widget-body">
                            <div class="form">
                                <form enctype="multipart/form-data" id="generation_insert" action="/generation_insert" method="post">
                                    @csrf
                                    <p class="note">ค่าที่มี <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> จำเป็นต้องใส่ให้ครบ</p>

                                    <div class="row">
                                        <label for="contac_by_name" class="required">รหัสรุ่น <span class="required">*</span></label>
                                        <input size="60" maxlength="250" class="span8" name="orgchart_id" id="orgchart_id" type="text">
                                    </div>

                                    <div class="row">
                                        <label for="contac_by_surname" class="required">รหัสคอร์ส <span class="required">*</span></label>
                                        <input size="60" maxlength="250" class="span8" name="course_id" id="course_id" type="text">
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
@section('scripts')
    @parent
    <script>
        function validateEmail() {
            var emailInput = document.getElementById('contac_by_email');
            var emailError = document.getElementById('email-error');
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailRegex.test(emailInput.value)) {
                emailError.textContent = 'กรุณากรอก Email ให้ถูกต้อง';
            } else {
                emailError.textContent = '';
            }
        }

        function validatePhoneNumber() {
            var telInput = document.getElementById('contac_by_tel');
            var telError = document.getElementById('tel-error');
            var telRegex = /^\d+$/;

            if (!telRegex.test(telInput.value)) {
                telError.textContent = 'กรุณากรอกเบอร์โทรศัพท์เป็นตัวเลขเท่านั้น';
            } else {
                telError.textContent = '';
            }
        }

        // เพิ่ม event listener สำหรับทำ validation
        document.getElementById('contac_by_email').addEventListener('blur', validateEmail);
        document.getElementById('contac_by_tel').addEventListener('blur', validatePhoneNumber);
    </script>
@endsection