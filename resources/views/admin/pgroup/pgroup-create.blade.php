@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<style>
    .menu {
    display: flex;
    align-items: center; /* จัดให้ข้อความอยู่ตรงกลางตา */
    }

    .menu input[type="checkbox"] {
        margin-right: 8px; /* ระยะห่างระหว่าง checkbox กับข้อความ */
    }
</style>
<body class="">
    <div id="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">ระบบการกำหนดสิทธิการใช้งาน</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('pgroup')}}">
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
                        แก้ไขกลุ่มผู้ใช้งาน
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pgroup_insert') }}" enctype="multipart/form-data" method="post" id="question-form">
                            @csrf
                            <div class="form-grop">
                                <p>ชื่อกลุ่มผู้ใช้งาน<i style="color:red">*</i></p>
                                <input type="text" id="group_name" name="group_name" class="form-control">
                            </div>
                            <div class="table-responsive">
                                <p>เลือกเมนูและบันทึกลงฐานข้อมูล</p>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="row"><input type="checkbox" id="select-all"><span> </span>เลือกทั้งหมด</th>
                                            <th scope="row">เมนูหลัก</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menuHead as $menuHeads )
                                        <tr>
                                            <td><input type="checkbox" id="{{ $menuHeads->id }}" name="menu[]" value="{{ $menuHeads->id }}"></td>
                                            <td><label for="">{{ $menuHeads->name }}</label></td>
                                        </tr>
                                            {{-- <div class="menu">
                                            </div> --}}

                                                {{-- <ul>
                                                @foreach ($menuList as $menuLists)
                                                    @if ($menuHeads->id == $menuLists->parent_id)
                                                        <li>
                                                            <div class="sub-menu">
                                                                <input type="checkbox" id="{{ $menuLists->id }}" name="menu[]" value="{{ $menuLists->id }}">
                                                                <label for="">{{ $menuLists->name }}</label>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                                </ul> --}}

                                            {{-- <hr> --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="sidebar">
        </div><!-- sidebar -->
    <div class="clearfix"></div>
    </div>

<script type="text/javascript">
var selectAllCheckbox = document.getElementById('select-all');

// เพิ่มการฟังก์ชันให้กับองค์ประกอบ input เมื่อมีการคลิก
    selectAllCheckbox.addEventListener('click', function() {
        // รับองค์ประกอบทั้งหมดของ input checkbox ในเอกสาร
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        // วนลูปผ่าน input checkbox ทั้งหมด
        checkboxes.forEach(function(checkbox) {
            // ตรวจสอบว่า checkbox ไม่ใช่ select-all และกำหนดค่า checked ให้เท่ากับค่า checked ของ select-all
            if (checkbox !== selectAllCheckbox) {
                checkbox.checked = selectAllCheckbox.checked;
            }
        });
    });
</script>
</body>
@endsection

