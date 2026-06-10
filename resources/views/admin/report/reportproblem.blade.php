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
							<h4 class="m-0">จัดการปัญหาการใช้งาน</h4>
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
			</div>
			<div class="content">
				<div class="container-fluid">
					<div class="card m-0">
						<div class="card-body">
							<table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
								<thead>
									<tr>
										<th>ชื่อ</th>
										<th>นามสกุล</th>
										<th>อีเมลล์</th>
										<th>เบอร์โทร</th>
										<th>รายละเอียด</th>
										<th>สถานะ</th>
										<th>คำตอบ</th>
										<th>จัดการ</th>
									</tr>
								</thead>
								<tbody id="sortable">
									@foreach ($reportproblem as $item)
									<tr>
										<td>{{ $item->profile->firstname}}</td>
										<td>{{ $item->profile->lastname}}</td>
										<td >{{$item->email}}</td>
										<td >{{$item->tel}}</td>
										<td >{{$item->report_detail}}</td>
										@if($item->status !== 'success')
										<td >รอการตอบกลับ</td>
										@else
										<td >ตอบกลับเสร็จสิ้น</td>
										@endif
										<td >{!! htmlspecialchars_decode($item->answer) !!}</td>
										<td>
											<a href="{{ route('reportproblem.detail',['id' =>$item->id])}}" class="btn btn-warning btn-sm"><i class="fas fa-search"></i></a>
											<a href="{{ route('reportproblem.edit',['id' =>$item->id])}}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div id="sidebar">
			</div><!-- sidebar -->
		</div>
	</div>
	<div class="clearfix"></div>
<script>
	$(document).ready(function() {
		// Initialize DataTable
		$('#settingTable').DataTable({
			responsive: true,
			scrollX: true,
			language: {
				url: '/include/languageDataTable.json',
			}
		});
	});
</script>
</body>
@endsection