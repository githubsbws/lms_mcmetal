@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<body>
    <div id="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">ระบบการกำหนดสิทธิการใช้งาน</h4>
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
                @if (session('success'))
                    <div class="alert alert-success" id="success-alert">{{ session('success') }}</div>
                    <script>
                        setTimeout(function(){
                            document.getElementById('success-alert').style.display = 'none';
                        }, 3000);
                    </script>
                @endif

                @if ($errors->has('import_excel'))
                    <div class="alert alert-danger" id="error-alert">{{ $errors->first('import_excel') }}</div>
                    <script>
                        setTimeout(function(){
                            document.getElementById('error-alert').style.display = 'none';
                        }, 3000);
                    </script>
                @endif
				<div class="container mt-5">
					<div class="card">
						<div class="card-header bg-primary text-white">
							แก้ไขกลุ่มผู้ใช้งาน
						</div>
						<div class="card-body">
							<form action="{{ route('permission_insert',['id' => $id]) }}" enctype="multipart/form-data" method="post" id="question-form">
								@csrf
								<div class="form-group">
									<label for="cms_title">ชื่อ: {{ $user->firstname ?? '-' }} {{ $user->lastname ?? '-' }}</label>
								</div>

								<div class="form-group">
									<label for="cms_short_title">เลือกกลุ่มผู้ใช้งาน </label>
                                    <select class="form-control" name="group_role" id="group_role">
                                        <option value="">---เลือก---</option>
                                        @foreach ($groupRole as $role)
                                            <option value="{{ $role->id }}"
                                                data-name="{{ $role->group_name }}"
                                                {{ $user->user->group_id == $role->id ? 'selected' : '' }}>
                                                {{ $role->group_name }}
                                            </option>
                                        @endforeach
                                    </select>
								</div>

                                <div class="form-group" id="supervisor_extra" style="display:none;">
                                    <label>สิทธิ์เพิ่มเติมสำหรับ Supervisor</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="supervisor_permission[]" value="approve">
                                        <label class="form-check-label">เป็นผู้สอน</label>
                                    </div>
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
</body>
<script>
document.addEventListener("DOMContentLoaded", function () {

    function checkSupervisor() {
        let select = document.getElementById("group_role");
        let selected = select.options[select.selectedIndex].dataset.name;

        if(selected === "Supervisor"){
            document.getElementById("supervisor_extra").style.display = "block";
        }else{
            document.getElementById("supervisor_extra").style.display = "none";
        }
    }

    document.getElementById("group_role").addEventListener("change", checkSupervisor);

    // run ตอนโหลดหน้า
    checkSupervisor();
});
</script>
@endsection
