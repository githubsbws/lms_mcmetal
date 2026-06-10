@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<body class="">
	<div id="wrapper">
		<div class="content-wrapper">
			<div class="content-header">
				<div class="container-fluid">
					<div class="d-flex align-items-center">
						<div class="">
							<h4 class="m-0">ระบบLog การใช้งานผู้ดูแลระบบ</h4>
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
										<th>Controller</th>
										<th>action</th>
										<th>user</th>
										<th>ASC</th>
										<th>วันที่</th>
									</tr>
								</thead>
								<tbody id="sortable">
									
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
		$('#settingTable').DataTable({
			serverSide: true,
			processing: true,
			ajax: "{{ route('admin.admin_data') }}",
			columns: [
				{ data: 'controller', name: 'controller', orderable: false },
				{ data: 'action', name: 'action', orderable: false },
				{ data: 'username', name: 'username', orderable: false },
				{ data: 'name', name: 'name', orderable: false },
				{ data: 'create_date', name: 'create_date' }
			],
			language: {
				url: '/include/languageDataTable.json'
			},
			pageLength: 10
		});
	});
</script>	
</body>
@endsection