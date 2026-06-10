@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<body class="">
		<div id="wrapper">
			<div  class="content-wrapper">
				<div class="content-header">
					<div class="container-fluid d-flex align-items-center">
						<div>
							<h4 class="m-0">ระบบเงื่อนไขการใช้งาน</h4>
							<p class="m-0 text-black-50"><li><a href="{{route('admin')}}">หน้าหลัก</a></li></p>
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
											<th>หัวข้อเงื่อนไขการใช้งาน</th>
											<th>รายละเอียด</th>
											<th>จัดการ</th>
										</tr>
									</thead>
									<tbody id="sortable">
										@foreach($conditions as $condition)
										<tr>
											<td class="text-center">
												{!! htmlspecialchars_decode($condition->conditions_title)  !!}
											</td>
											<td class="text-center">{!! htmlspecialchars_decode(htmlspecialchars_decode($condition->conditions_detail))  !!}</td>
											<td>
												<a href="{{route('condition.detail',['id'=>$condition->conditions_id])}}" class="btn btn-warning btn-sm"><i class="fas fa-search"></i></a>
												<a href="{{route('condition.update',['id'=>$condition->conditions_id])}}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
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
			</div><!-- content -->

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