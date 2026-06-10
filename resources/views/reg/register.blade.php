@extends('layout/mainlayout')
@section('content')
<style>
    .error-message {
        color: red;
        font-size: 0.9em;
    }
    .input-error {
        border: 1px solid red;
    }
</style>
<body>

    <div class="container">
        <div class="page-section login-page">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-xs-12" align="center">
                                <h1>สมัครสมาชิก</h1>
                            </div>
                            {{-- @if ($errors->any())
                                    <div>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}
                            <div class="form">
                                <form class="form-horizontal" action="{{ route('register') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"><label
                                                for="UserLogin_username" class="required">รหัสพนักงาน <span
                                                    class="text-danger">*</span></label></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" placeholder="Staff ID"
                                                name="username" type="text">
                                            @error('username')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><label for="UserLogin_password"
                                                class="required">รหัสผ่าน <span
                                                    class="text-danger">*</span></label></label>

                                        <div class="col-sm-9">
                                            <input class="form-control" placeholder="Password"
                                                name="password" type="password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"><label
                                                for="UserLogin_username" class="required">ชื่อ - นามสกุล <span
                                                    class="text-danger">*</span></label></label>
                                        <div class="col-sm-9">
                                            <input class="form-control" placeholder="firstname"
                                                name="firstname" type="text">
                                            @error('firstname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <br>
                                            <input class="form-control" placeholder="lastname"
                                                name="lastname" type="text">
                                            @error('lastname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><label for="UserLogin_password"
                                                class="required">อีเมล <span
                                                    class="text-danger">*</span></label></label>

                                        <div class="col-sm-9">
                                            <input class="form-control" placeholder="Email"
                                                name="email" type="email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group org-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"><label
                                                for="level-2" class="required">องค์กร <span
                                                    class="text-danger">*</span></label></label>
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
                                                for="level-3" class="required">แผนก <span
                                                    class="text-danger">*</span></label></label>
                                        <div class="col-sm-9">
                                            <select class="form-control org-select" id="level-3" name="department_id" data-next="level-4" data-level="3" data-label-name="แผนก" disabled>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group org-group" id="group-level-4" style="display:none;">
                                        <label for="inputEmail3" class="col-sm-3 control-label"><label
                                                for="level-4" class="required">ส่วนงาน <span
                                                    class="text-danger">*</span></label></label>
                                        <div class="col-sm-9">
                                            <select class="form-control org-select" id="level-4" name="section_id" data-next="level-5" data-level="4" data-label-name="ส่วนงาน" disabled>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group org-group" id="group-level-5" style="display:none;">
                                        <label for="inputEmail3" class="col-sm-3 control-label"><label
                                                for="level-5" class="required">สายการผลิต <span
                                                    class="text-danger">*</span></label></label>
                                        <div class="col-sm-9">
                                            <select class="form-control org-select" id="level-5" name="line_id" data-next="level-6" data-level="5" data-label-name="สายการผลิต" disabled>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group org-group" id="group-level-6" style="display:none;">
                                        <label for="inputEmail3" class="col-sm-3 control-label"><label
                                                for="level-6" class="required">ตำแหน่ง <span
                                                    class="text-danger">*</span></label></label>
                                        <div class="col-sm-9">
                                            <select class="form-control org-select" id="level-6" name="position_id" data-level="6" data-label-name="ตำแหน่ง" disabled>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"><label
                                                for="" class="required">ทีม <span
                                                    class="text-danger">*</span></label></label>
                                        <div class="col-sm-9">
                                            <select class="form-control"  name="team_id">
                                                <option value="" disabled selected>---เลือกรายการ---</option>
                                                @foreach ($team as $teams)
                                                    <option value="{{ $teams->id }}">
                                                        {{ $teams->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('team_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label"><label
                                                for="" class="required">วันที่เริ่มงาน<span
                                                    class="text-danger">*</span></label></label>
                                        <div class="col-sm-9">
                                            <input class="form-control"
                                                name="work_start_date" type="date">
                                            @error('work_start_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <input type="hidden" name="org_id" id="final_org_id">
                                    <input type="hidden" name="department_id" id="department_id">

                                    <div class="form-group">
                                        <div class="col-sm-6 col-sm-offset-5" style="padding: 0;">
                                            <input class="btn btn-primary" type="submit" name="yt0"
                                                value="ลงทะเบียน">
                                        </div>
                                    </div>
                                </form>
                            </div><!-- form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
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
</script>
@endsection

