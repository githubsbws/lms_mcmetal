@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Company;
use App\Models\Division;
use App\Models\Position;
use App\Models\ProfilesTitle;
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
                            <a href="{{route('user_admin')}}">
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
                        แก้ไขสมาชิก
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user_update') }}" enctype="multipart/form-data" method="post" id="question-form">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ $user->username }}" disabled>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password"  autocomplete="new-password" oninput="checkPassword()" >
                                <input type="hidden" name="old_password" value="{{ $user->password }}">

                            </div>
                            <div class="form-group">
                                <label for="password-length">รหัสผ่านต้องมีความยาวมากว่า 8 ตัว</label>
                                <div class="col-md-6">
                                    <span id="password-length-status"></span>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <label for="password-special">รหัสผ่านต้องมีสัญลักษณ์พิเศษอย่างน้อย 1 ตัว</label>
                                <div class="col-md-6">
                                    <span id="password-special-status"></span>
                                </div>
                            </div> --}}
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
                            {{-- @php
                            $pro = ProfilesTitle::where('prof_id',$user->Profiles->title_id)->first();
                            @endphp
                            <div class="form-group">
                                <label for="">คำนำหน้าชื่อ</label>
                                <select class="form-control" name="title">
                                    <option value="">---เลือก---</option>
                                    @foreach ($profTitle as $title)
                                        <option value="{{ $title->prof_id }}"
                                            {{ $user->Profiles->title_id == $title->prof_id ? 'selected' : '' }}>
                                            {{ $title->prof_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="form-group">
                                <label for="">ชื่อ(EN)</label>
                                <input type="text"  class="form-control" name="firstname_en" value="{{ $user->Profiles->firstname_en ?? '-'}}">
                            </div>
                            <div class="form-group">
                                <label for="">นามสกุล(EN)</label>
                                <input type="text"  class="form-control" name="lastname_en" value="{{ $user->Profiles->lastname_en ?? null }}">
                            </div>
                            <div class="form-group">
                                <label for="">ชื่อ(TH)<span style="color:red">*</span></label>
                                <input type="text"  class="form-control" name="firstname" value="{{ $user->Profiles->firstname ?? null }}">
                            </div>
                            <div class="form-group">
                                <label for="">นามสกุล(TH)<span style="color:red">*</span></label>
                                <input type="text"  class="form-control" name="lastname" value="{{ $user->Profiles->lastname ?? null }}">
                            </div>
                            <div class="form-group">
                                <label for="">เลขบัตรประชาชน</label>
                                <input type="text"  class="form-control" name="identification" value="{{ $user->Profiles->identification ?? null }}">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email"  class="form-control" name="email" value="{{ $user->email ?? null }}">
                            </div>
                            <div class="form-group">
                                <label for="">เบอร์โทรศัพท์</label>
                                <input type="text"  class="form-control" name="phone" value="{{ $user->Profiles->phone ?? null }}">
                            </div>
                            <div class="form-group org-group">
                                <label for="inputEmail3" class="col-sm-3 control-label"><label
                                        for="level-2" class="required">องค์กร </label></label>
                                <div class="col-sm-9">
                                    <select class="form-control org-select" id="level-2" name="orgchart_id" data-next="level-3" data-label-name="องค์กร" data-level="2">
                                        <option value="" disabled selected>---เลือกรายการ---</option>
                                        @foreach ($orgchart as $org)
                                            <option value="{{ $org->id }}">
                                                {{ $org->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('orgchart_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group org-group" id="group-level-3" style="display:none;">
                                <label for="inputEmail3" class="col-sm-3 control-label"><label
                                        for="level-3" class="required">แผนก</label></label>
                                <div class="col-sm-9">
                                    <select class="form-control org-select" id="level-3" name="department_id" data-next="level-4" data-level="3" data-label-name="แผนก" disabled>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group org-group" id="group-level-4" style="display:none;">
                                <label for="inputEmail3" class="col-sm-3 control-label"><label
                                        for="level-4" class="required">ส่วนงาน</label></label>
                                <div class="col-sm-9">
                                    <select class="form-control org-select" id="level-4" name="section_id" data-next="level-5" data-level="4" data-label-name="ส่วนงาน" disabled>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group org-group" id="group-level-5" style="display:none;">
                                <label for="inputEmail3" class="col-sm-3 control-label"><label
                                        for="level-5" class="required">สายการผลิต</label></label>
                                <div class="col-sm-9">
                                    <select class="form-control org-select" id="level-5" name="line_id" data-next="level-6" data-level="5" data-label-name="สายการผลิต" disabled>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group org-group" id="group-level-6" style="display:none;">
                                <label for="inputEmail3" class="col-sm-3 control-label"><label
                                        for="level-6" class="required">ตำแหน่ง</label></label>
                                <div class="col-sm-9">
                                    <select class="form-control org-select" id="level-6" name="position_id" data-level="6" data-label-name="ตำแหน่ง" disabled>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label"><label
                                        for="" class="required">ทีม</label></label>
                                <div class="col-sm-9">
                                    <select class="form-control"  name="team_id">
                                        <option value="" disabled selected>---เลือกรายการ---</option>
                                        @foreach ($team as $teams)
                                            <option value="{{ $teams->id }}" {{ $user->team_id == $teams->id ? 'selected' : '' }}>
                                                {{ $teams->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('team_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <input type="hidden" name="org_id" id="final_org_id" value="{{ $user->org_id }}">
                            <input type="hidden" name="department_id" id="department_id" value="{{ $user->department_org_id }}">

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
<script>
    $(document).ready(function () {
        $('.org-select').on('change', function () {
            var currentSelect = $(this);
            // console.log(currentSelect);
            var parentId = currentSelect.val();
            var nextId = currentSelect.data('next');
            var currentLevel = currentSelect.data('level');

            // 1. อัปเดต ID ล่าสุดลงใน Hidden Input เสมอ
            $('#final_org_id').val(parentId);

            if(currentLevel === 3){
                $('#department_id').val(parentId); //เก็บ department เพื่อไว้กรองการมองเห็นหลังบ้าน
            }
            // 2. ล้างค่าตัวลูกทั้งหมด (Chain Reset)
            resetChildren(currentLevel);

            // 3. ถ้าไม่ได้เลือกอะไร หรือเป็นตัวสุดท้ายแล้ว ให้หยุด
            if (!parentId || !nextId) return;

            // 4. ดึงข้อมูลตัวลูกผ่าน API
            $.get('/api/get-sub-org/' + parentId, function (res) {
                console.log(res);
                var nextSelect = $('#' + nextId);
                var nextGroup = $('#group-' + nextId);
                var nextLabel = $(`label[for="${nextId}"]`);
                if (res.has_child) {
                    // มีลูกต่อ: วาด Option และเปิดให้กด
                    // console.log(nextId);
                    nextLabel.text(nextSelect.data('label-name'));
                    var options = '<option value="" disabled selected>-- เลือกรายการ --</option>';
                    $.each(res.data, function (key, item) {
                        options += `<option value="${item.id}">${item.title}</option>`;
                    });

                    nextSelect.html(options).prop('disabled', false);
                    nextGroup.show();
                } else {
                    // ไม่มีลูกแล้ว: จบสายงานที่ตรงนี้
                    var currentLabel = $(`label[for="${currentSelect.attr('id')}"]`);
                        console.log(currentLabel);
                    // เช็คเลเวลหน่อย เผื่อเลเวล 6 เราไม่อยากยุ่งกับมัน (เพราะมันคือตำแหน่งอยู่แล้ว)
                    if (currentLevel < 6) {
                        currentLabel.text('ตำแหน่ง');
                    }
                    nextSelect.prop('disabled', true);
                    nextGroup.hide();
                }
            });
        });

        // ฟังก์ชันล้างค่าตัวลูก (ล้างทุกตัวที่ Level สูงกว่าตัวปัจจุบัน)
        function resetChildren(level) {
            $('.org-select').each(function () {
                var thisLevel = $(this).data('level');
                if (thisLevel > level) {
                    $(this).val('').prop('disabled', true);
                    $(this).closest('.org-group').hide();
                }
            });
        }
    });

    function checkPassword() {
        var password = document.getElementById("password").value;

        // ตรวจสอบความยาวของรหัสผ่าน (ต้องมีอย่างน้อย 8 ตัวอักษร)
        if (password.length < 8) {
            document.getElementById("password-length-status").innerHTML = "<p style='color:red;'>รหัสผ่านต้องมีอย่างน้อย 8 ตัว</p>";
        } else {
            document.getElementById("password-length-status").innerHTML = "<p style='color:green;'>&#x2714;</p>";
        }

        // ตรวจสอบว่ามีอักขระพิเศษอย่างน้อย 1 ตัว
        // if (!/[!@#$%^&*]/.test(password)) {
        //     document.getElementById("password-special-status").innerHTML = "<p style='color:red;'>รหัสผ่านต้องมีสัญลักษณ์พิเศษอย่างน้อย 1 ตัว</p>";
        // } else {
        //     document.getElementById("password-special-status").innerHTML = "<p style='color:green;'>&#x2714;</p>";
        // }
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
<script>
$(document).ready(function() {
    var orgPath = @json($orgPath ?? []);

    function autoSelectOrg(path, index) {
        if (index >= path.length) return;

        var id     = path[index];
        if (!id) return;

        var level         = index + 2;
        var currentSelect = $('.org-select[data-level="' + level + '"]');

        currentSelect.val(id);

        var nextId = currentSelect.data('next');
        if (!nextId || index + 1 >= path.length) return;

        $.get('/api/get-sub-org/' + id, function(res) {
            if (res.has_child) {
                var nextSelect = $('#' + nextId);
                var nextGroup  = $('#group-' + nextId);

                var options = '<option value="" disabled selected>-- เลือกรายการ --</option>';
                $.each(res.data, function(key, item) {
                    options += '<option value="' + item.id + '">' + item.title + '</option>';
                });

                nextSelect.html(options).prop('disabled', false);
                nextGroup.show();

                autoSelectOrg(path, index + 1);
            }
        });
    }

    if (orgPath.length > 0) {
        autoSelectOrg(orgPath, 0);
    }
});
</script>
</body>
@endsection
