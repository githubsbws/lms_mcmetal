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
							<h4 class="m-0">ระบบวิธีการใช้งาน</h4>
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
										<th>หัวข้อวิธีการใช้งาน</th>
										<th>จัดการ</th>
									</tr>
								</thead>
								<tbody id="sortable">
									@foreach($usa as $us)
									<tr>
										{{-- <td class="handle"><i class="fas fa-arrows-alt"></i></td> --}}
										<td>{{ $us->usa_title}}</td>
										<td>
											<a href="{{route('usability.detail',['id'=>$us->usa_id])}}" class="btn btn-warning btn-sm"><i class="fas fa-search"></i></a>
											<a href="{{route('usability.edit',['id'=>$us->usa_id])}}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
											<button 
												type="button" 
												class="btn btn-danger btn-sm delete-button"
												data-id="{{ $us->usa_id }}"
												data-url="{{ route('usability.delete', $us->usa_id) }}">  {{-- ✅ ส่ง id ให้ route --}}
												<i class="fas fa-trash"></i>
											</button>
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

	$(document).on("click", ".delete-button", function(e) {
			e.preventDefault();

			var url = $(this).data("url"); // ✅ ดึงจาก data-url ที่เรา set ในปุ่ม

			Swal.fire({
				title: "คุณแน่ใจหรือไม่?",
				text: "ข้อมูลนี้จะถูกลบออก!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "ใช่, ลบเลย!",
				cancelButtonText: "ยกเลิก"
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: url,
						type: "POST",
						data: {
							_token: "{{ csrf_token() }}"
						},
						success: function(response) {
							Swal.fire({
								title: "สำเร็จ!",
								text: response.message || "ลบข้อมูลสำเร็จ",
								icon: "success",
								confirmButtonText: "OK"
							}).then(() => location.reload());
						},
						error: function(xhr) {
							Swal.fire(
								"เกิดข้อผิดพลาด!",
								xhr.responseJSON?.message || "ไม่สามารถลบข้อมูลได้",
								"error"
							);
						}
					});
				}
			});
		});

			@if(session('success'))
			Swal.fire({
				title: "{{ session('alert') }}",
				text:"บันทึกข้อมูลสำเร็จ",
				icon: "success",
				confirmButtonText: 'ตกลง' // เพิ่มปุ่มยืนยัน
			});
		@endif
</script>
</body>
@endsection