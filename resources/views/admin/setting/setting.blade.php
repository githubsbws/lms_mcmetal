@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<body class="">
		<div id="wrapper">
			<div class="content-wrapper">
				<div class="content-header">
					<div class="container-fluid d-flex align-items-center">
						<div>
							<h4 class="m-0">จัดการตั้งค่าระบบ</h4>
						</div>
                        <div class="ml-3">
							<a href="{{route('admin')}}">
								<button class="btn btn-warning d-flex align-items-center">
									<i class="fas fa-angle-left mr-2"></i>
									หน้าหลัก
								</button>
							</a>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="container-fluid">
						<div class="d-md-flex">
							<div class="col mx-auto col-md-8 col-lg-6">
								<div class="card m-0">
									<div class="card-header bg-primary text-white">
										ตั้งค่าระบบ
									</div>
									<div class="card-body">
										<form enctype="multipart/form-data" id="page-form" action="{{route('setting.update',['id' => $setting->setting_id])}}" method="post">
											@csrf
											<div class="form-group mb-0">
												<div class="form-group px-0 mr-3 w-100">
													<label for="con_firstname">User Email ที่ใช้ในการส่งข้อมูล</label>
													<input type="text" class="form-control"  name="settings_user_email" value="{{ $setting->settings_user_email}}">
												</div>
												<div class="form-group px-0 mr-3 w-100">
													<label for="con_firstname">Pass Email ที่ใช้ในการส่งข้อมูล</label>
													<input type="password" class="form-control"  name="settings_pass_email" value="{{ $setting->settings_pass_email}}">
												</div>
												{{-- <div class="form-group px-0 w-100">
													<label for="con_lastname">เปิด-ปิด การเฉลยข้อสอบ</label>
													<div>
														@php
															$checked = $setting->settings_testing == 1 ? 'checked' : '';
														@endphp
														<input type="checkbox" name="settings_testing" value="y" data-toggle="toggle" data-on="แสดง" data-off="ไม่แสดง" data-onstyle="success" data-offstyle="danger" {{ $checked }} />
													</div>
												</div>

												<div class="form-group px-0 w-100">
													<label for="con_lastname">เปิด-ปิด การลงทะเบียน</label>
													<div>
														@php
															$checked = $setting->settings_register == 1 ? 'checked' : '';
														@endphp
														<input type="checkbox" name="settings_register" value="y" data-toggle="toggle" data-on="แสดง" data-off="ไม่แสดง" data-onstyle="success" data-offstyle="danger" {{ $checked }} />
													</div>
												</div>

												<div class="progress progress-inverse progress-mini">
													<div class="progress-bar" id="progress-bar"
														 style="width: {{ $setting->settings_score ?? 0 }}%; background-color: #007bff; transition: width 0.5s;">
													</div>
												</div>

												<div class="form-group px-0 mr-3 w-100">
													<label for="settings_score">
														เปอร์เซ็นการคำนวณคะแนน การทดสอบผ่าน
														(ใส่ค่า 80 คือผ่าน 80 เปอร์เซ็นของคะแนนสอบ)
													</label>
													<input type="number" id="settings_score" class="form-control" name="settings_score"
														   value="{{ $setting->settings_score ?? 0 }}" min="0" max="100">
												</div>

												<div class="form-group px-0 mr-3 w-100">
													<label for="con_firstname">จำนวนวัน ที่รหัสผ่าน User จะหมดอายุ (ใส่ 0 หรือเว้นว่างถ้าไม่กำหนด)</label>
													<input type="text" class="form-control"  name="password_expire_day" value="{{$setting->password_expire_day}}">
												</div>
											</div>

											<div class="card-footer">
												<button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
											</div> --}}
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="sidebar">
				</div><!-- sidebar -->
			</div>

		</div>
		<div class="clearfix"></div>
</body>
@endsection
