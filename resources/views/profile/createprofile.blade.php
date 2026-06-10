@extends('layout/mainlayout')
@section('title', 'Dashboard')
@section('content')

<!-- <div class="parallax overflow-hidden page-section bg-blue-300">
    <div class="container parallax-layer" data-opacity="true">
        <div class="media media-grid v-middle">
            <div class="media-left">
                <span class="icon-block half bg-blue-500 text-white" style="height: 45px;"><i
                        class="fa fa-fw fa-user"></i></span>
            </div>
            <div class="media-body">
                <p class="text-white text-subhead" style="font-size: 1.6rem;">สร้างโปรไฟล์ส่วนตัว</p>
            </div>
        </div>
    </div>
</div> -->
<style>
    .label-deteil {
        margin-bottom: 15px;
        font-size: 22px;
    }

    .label-edit {
        font-size: 23px;
        margin-bottom: 15px;
        font-weight: bold;
        color: #363636;
    }

    .page-sidebar-title {
        padding: 30px 40px 10px 40px;
        font-size: 20px;
        color: #111111;
    }

    .row {
        background-color: #fff !important;
    }

    .tab-content {
        border: 1px solid #00529C;
        border-radius: 16px;
    }

    .col-md-6 {
        margin: 0 0 18px 0;
    }
</style>

<div class="page-sidebar-title">
    <span>โปรไฟล์</span>
</div>
<div class="container">
    <div class="page-section">
        <div class="row">
            <div class="col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
                <!-- Tabbable Widget -->
                <div class="tabbable paper-shadow relative" data-z="0.5">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs">

                        <li class="active"><a><i class="fa fa-fw fa-lock"></i> <span class="hidden-sm hidden-xs"
                                    style="font-size: 23px;">-</span></a>
                        </li>

                    </ul>
                    <!-- // END Tabs -->
                    <!-- Panes -->
                    <div class="tab-content">
                        <div id="account" class="tab-pane active">
                            <div class="row">
                                <div class="col-lg-12" style="padding-top: 20px;">
                                    <form action="{{ route('create.profile') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-6">
                                            <label for="text" class="col-md-4 col-form-label text-md-end">ชื่อ</label>

                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="firstname" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password" class="col-md-4 col-form-label text-md-end">นามสกุล</label>

                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="lastname" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="text" class="col-md-4 col-form-label text-md-end">ชื่อ (EN)</label>

                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="firstname_en" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password" class="col-md-4 col-form-label text-md-end">นามสกุล (EN)</label>

                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="lastname_en" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password" class="col-md-4 col-form-label text-md-end">รหัสบัตรประชาชน</label>

                                            <div class="col-md-8">
                                                <input type="password" class="form-control" name="identification" maxlength="13" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password" class="col-md-4 col-form-label text-md-end">เบอร์โทรศัพท์</label>

                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="phone" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password" class="col-md-4 col-form-label text-md-end">Email</label>

                                            <div class="col-md-6">
                                                <p class="text-white text-subhead" style="font-size: 1.6rem;">{{ Auth::user()->email }}</p>
                                            </div>
                                        </div>
                                </div>
                                <br>
                                <div class="col-md-9" style="padding-top: 40px;">

                                    <div class="col-md-6">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">บริษัท</label>

                                        <div class="col-md-6">
                                            @if($company)
                                            <p class="text-white text-subhead" style="font-size: 1.6rem;">{{ $company->company_title}}</p>
                                            @else
                                            <p class="text-white text-subhead" style="font-size: 1.6rem;">-</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">แผนก</label>

                                        <div class="col-md-6">
                                            @if($division)
                                            <p class="text-white text-subhead" style="font-size: 1.6rem;">{{ $division->dep_title}}</p>
                                            @else
                                            <p class="text-white text-subhead" style="font-size: 1.6rem;">-</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">ตำแหน่ง</label>

                                        <div class="col-md-6">
                                            @if($position)
                                            <p class="text-white text-subhead" style="font-size: 1.6rem;">{{ $position->position_title}}</p>
                                            @else
                                            <p class="text-white text-subhead" style="font-size: 1.6rem;">-</p>
                                            @endif
                                        </div>
                                    </div>
                                    </form>
                                    <div class="text-center">
                                        <button class="btn btn-success">บันทึกข้อมูล</button>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <!-- // END Panes -->
                </div>
                <!-- // END Tabbable Widget -->
                <br />
                <br />
            </div>
        </div>
    </div>
</div>
<script>
    function checkPassword() {
        var password = document.getElementById("password").value;

        // ตรวจสอบความยาวของรหัสผ่าน (ต้องมีอย่างน้อย 8 ตัวอักษร)
        if (password.length < 8) {
            document.getElementById("password-length-status").innerHTML = "<p style='color:red;'>รหัสผ่านต้องมีอย่างน้อย 8 ตัว</p>";
        } else {
            document.getElementById("password-length-status").innerHTML = "<p style='color:green;'>&#x2714;</p>";
        }

        // ตรวจสอบว่ามีอักขระพิเศษอย่างน้อย 1 ตัว
        if (!/[!@#$%^&*]/.test(password)) {
            document.getElementById("password-special-status").innerHTML = "<p style='color:red;'>รหัสผ่านต้องมีสัญลักษณ์พิเศษอย่างน้อย 1 ตัว</p>";
        } else {
            document.getElementById("password-special-status").innerHTML = "<p style='color:green;'>&#x2714;</p>";
        }
    }

    function validatePassword() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password-confirm').value;

        if (password !== confirmPassword) {
            alert('รหัสผ่านไม่ตรงกัน');
            return false;
        }

        return true;
    }
</script>
@endsection