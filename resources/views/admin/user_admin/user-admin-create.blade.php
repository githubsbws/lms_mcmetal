@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\ASC;
@endphp
<body>
    <div id="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">ระบบจัดการสมาชิก</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('admin')}}">
                                <button class="btn btn-warning d-flex align-items-center">
                                    <i class="fas fa-angle-left mr-2"></i>
                                    กลับหน้าหลัก
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        เพิ่มสมาชิก
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user_insert') }}" enctype="multipart/form-data" method="post" id="question-form">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password"  autocomplete="new-password" oninput="checkPassword()" >   
                            </div>

                            <div class="form-group">
                                <label for="password-length">รหัสผ่านต้องมีความยาวมากว่า 8 ตัว</label>
                                <div class="col-md-6">
                                    <span id="password-length-status"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-special">รหัสผ่านต้องมีสัญลักษณ์พิเศษอย่างน้อย 1 ตัว</label>
                                <div class="col-md-6">
                                    <span id="password-special-status"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>

                            @error('password')
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-3" style="padding: 0;">
                                    <span class="{{ $errors->has('password') ? 'input-error' : '' }}" style="color:red;">{{ $message }}</span>
                                </div>
                            </div>
                            @enderror

                            <div class="form-group">
                                <label for="">คำนำหน้าชื่อ</label>
                                <select class="form-control" name="title">
                                    <option value="">---เลือก---</option>
                                    @foreach ( $profTitle as $title )
                                        <option value="{{ $title->prof_id }}">{{ $title->prof_title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">ชื่อ(EN)</label>
                                <input type="text"  class="form-control" name="firstname_en">
                            </div>

                            <div class="form-group">
                                <label for="">นามสกุล(EN)</label>
                                <input type="text"  class="form-control" name="lastname_en">
                            </div>

                            <div class="form-group">
                                <label for="">ชื่อ(TH)<span style="color:red">*</span></label>
                                <input type="text"  class="form-control" name="firstname" required>
                            </div>

                            <div class="form-group">
                                <label for="">นามสกุล(TH)<span style="color:red">*</span></label>
                                <input type="text"  class="form-control" name="lastname" required>
                            </div>

                            <div class="form-group">
                                <label for="">เลขบัตรประชาชน<span style="color:red">*</span></label>
                                <input type="text"  class="form-control" name="identification">
                            </div>
                            @error('identification')
                                <span style="color:red">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email"  class="form-control" name="email">
                            </div>

                            <div class="form-group">
                                <label for="">เบอร์โทรศัพท์</label>
                                <input type="text"  class="form-control" name="phone">
                            </div>
                            
                            <div class="form-group">
                                <label for="">Chanel</label>
                                <select class="form-control" name="company" id="company">
                                    <option value="">---เลือก---</option>
                                    @foreach ( $company as $comp )
                                        <option value="{{ $comp->company_id }}">{{ $comp->company_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @php
                            $asc_all = ASC::where('active','y')->get();
                            @endphp
                            <div class="form-group">
                                <label for="">Company</label>
                                <select class="form-control" name="asc" id="asc">
                                    <option value="">---เลือก---</option>
                                    @foreach ($asc_all as $as)
                                        <option value="{{ $as->id }}">
                                            {{ $as->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">ตำแหน่ง</label>
                                <select name="position" id="position" class="form-control"></select>
                            </div>

                            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
                        </form>
                    </div>
                </div>
            </div>
            <div id="sidebar">
            </div><!-- sidebar -->
        </div>
    </div>
    <div class="clearfix"></div>
<script type="text/javascript">
    document.getElementById('company').addEventListener('change', function() {
        var selectedId = this.value;

        // ส่งค่าไปยัง backend เพื่อคิวรี่ข้อมูลสองอันที่เหลือ
        fetch('/useradmin_create/company_selector/' + selectedId)
            .then(response => response.json())
            .then(data => {
                populateSecondDropdown(data.position);
                populateThirdDropdown(data.division);
            });
    });

    function populateSecondDropdown(data) {
        var secondDropdown = document.getElementById('position');
        secondDropdown.innerHTML = '<option value="" selected disabled>เลือกตำแหน่ง</option>';

        data.forEach(function(item) {
            var option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.position_title;
            secondDropdown.appendChild(option);
        });
    }
</script>
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
</body>
@endsection
