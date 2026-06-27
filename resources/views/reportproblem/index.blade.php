@extends('layout/mainlayout')
@section('content')
<style>
    .page-section{
        margin: 0 !important
    }
    .main-content {
        min-height: 100vh;
    }
</style>
<body>
    <div class="main-content">
        <div id="content">
            <style>
                .custom-color1 {
                    background-color: #2599F8;
                }
            </style>
            <div class="parallax overflow-hidden page-section bg-blue-300">
                <div class="container parallax-layer" data-opacity="true" style="transform: translate3d(0px, 0px, 0px); opacity: 1;">
                    <div class="media media-grid v-middle">
                        <div class="media-left">
                            <span class="icon-block half bg-blue-500 text-white" style="height: 45px;"><i class="fa fa-fw fa-archive"></i></span>
                        </div>
                        <div class="media-body">
                            <h3 class="text-display-2 text-white margin-none">แจ้งปัญหาการใช้งาน</h3>
                            <!--                <p class="text-white text-subhead" style="font-size: 1.6rem;">รวมข่าวสารของ Brother</p>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="panel panel-default paper-shadow" data-z="0.5" style="margin-top:25px;">
                        <div class="panel-heading">
                            <h4>กรอกข้อมูลแจ้งปัญหา</h4>
                        </div>

                        <div class="panel-body">

                            <form action="{{ route('reportproblem.store') }}"
                                method="POST"
                                enctype="multipart/form-data">

                                @csrf

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ชื่อ <font color="red">*</font></label>
                                            <input type="text"
                                                    name="fullname"
                                                    class="form-control"
                                                    value="{{ old('fullname', Auth::check() ? optional(Auth::user()->profile)->firstname : '') }}"
                                                    required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>นามสกุล <font color="red">*</font></label>
                                            <input type="text"
                                                    name="lastname"
                                                    class="form-control"
                                                    value="{{ old('lastname', Auth::check() ? optional(Auth::user()->profile)->lastname : '') }}"
                                                    required>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email <font color="red">*</font></label>
                                            <input type="email"
                                                    name="email"
                                                    class="form-control"
                                                    value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}"
                                                    required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>เบอร์โทรศัพท์</label>
                                            <input type="text"
                                                name="tel"
                                                class="form-control"
                                                value="{{ old('tel') }}">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label>ประเภทปัญหา <font color="red">*</font></label>
                                    <select class="form-control" name="report_type" required>
                                        <option value="">-- เลือกประเภทปัญหา --</option>
                                        <option value="การเข้าใช้งาน">การเข้าใช้งาน</option>
                                        <option value="บทเรียน">บทเรียน</option>
                                        <option value="แบบทดสอบ">แบบทดสอบ</option>
                                        <option value="Certificate">Certificate</option>
                                        <option value="อื่น ๆ">อื่น ๆ</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>หัวข้อปัญหา <font color="red">*</font></label>
                                    <input type="text"
                                        name="report_title"
                                        class="form-control"
                                        value="{{ old('report_title') }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>หลักสูตร (ถ้ามี)</label>
                                    <input type="text"
                                        name="report_course"
                                        class="form-control"
                                        value="{{ old('report_course') }}">
                                </div>

                                <div class="form-group">
                                    <label>รายละเอียดปัญหา <font color="red">*</font></label>
                                    <textarea class="form-control"
                                            rows="6"
                                            name="report_detail"
                                            required>{{ old('report_detail') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>แนบรูปภาพ</label>
                                    <input type="file"
                                        name="report_pic"
                                        class="form-control"
                                        accept=".jpg,.jpeg,.png,.gif">
                                </div>

                                <hr>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-paper-plane"></i>
                                    ส่งข้อมูล
                                </button>

                                <button type="reset" class="btn btn-default">
                                    ล้างข้อมูล
                                </button>

                            </form>

                        </div>
                </div>
            </div>
        </div><!-- content -->
    </div>
    @if(session('success'))
        <script>
        Swal.fire({
            icon: 'success',
            title: 'สำเร็จ',
            text: "{{ session('success') }}",
            confirmButtonText: 'ตกลง'
        });
        </script>
    @endif
    @if ($errors->any())
        <script>
        Swal.fire({
            icon: 'error',
            title: 'ข้อมูลไม่ถูกต้อง',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonText: 'ตกลง'
        });
        </script>
    @endif
</body>
@endsection
