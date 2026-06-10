@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<style>
    .handle {
    cursor: grab; /* เปลี่ยนเป็นไอคอนจับลาก */
    transition: transform 0.2s ease-in-out;
}

.handle:hover {
    transform: scale(1); /* ขยายไอคอนเล็กน้อย */
    color: #007bff; /* เปลี่ยนสี */
}

</style>
<body class="">
		<div id="wrapper">
			<div class="content-wrapper">
				<div class="content-header">
					<div class="container-fluid d-flex align-items-center">
						<div>
							<h4 class="m-0">ระบบตัวอย่าง Vdo YouTube</h4>
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
											<th>หัวข้อวิดีโอ</th>
											<th>Path ของ YouTube</th>
											<th>จัดการ</th>
										</tr>
									</thead>
									<tbody id="sortable">
										@foreach($vdo as $item)
										<tr>
                                            {{-- <td class="handle"><i class="fas fa-arrows-alt"></i></td> --}}
											<td>{!! htmlspecialchars_decode($item->vdo_title) !!}</td>
											<td><a href="{{$item->vdo_path}}" target="_blank">{{$item->vdo_path}}</a></td>
											<td>
												<a href="{{route('video.detail',['vdo_id' =>$item->vdo_id])}}" class="btn btn-warning btn-sm"><i class="fas fa-search"></i></a>
												<a href="{{url('video_edit',['vdo_id'=>$item->vdo_id])}}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
												<button type="button" class="btn btn-danger btn-sm delete-button" data-id="{{ $item->vdo_id }}">
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
			<!-- // Content END -->

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

	$(document).ready(function() {
                // ตรวจสอบว่า jQuery โหลดหรือไม่
                if (typeof jQuery === "undefined") {
                    console.error("jQuery is not loaded!");
                    return;
                }

                // ตั้งค่า CSRF Token
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    }
                });

                // ตรวจสอบว่าโค้ดนี้ทำงานจริงไหม
                console.log("Delete button script loaded");

                // ใช้ Event Delegation เผื่อปุ่มถูกโหลดใหม่
                $(document).on("click", ".delete-button", function(e) {
                    e.preventDefault();

                    var id = $(this).data("id");
                    var url = "/video_delete/" + id;

                    console.log("Clicked delete button with ID:", id); // ตรวจสอบว่า ID ถูกต้องไหม

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
                                type: "POST", // ใช้ DELETE ตาม Laravel
                                success: function(response) {
                                    console.log("Success:", response);
                                    Swal.fire({
                                        title: "สำเร็จ!",
                                        text: response.message || "ลบข้อมูลสำเร็จ",
                                        icon: "success",
                                        confirmButtonText: "OK"
                                    }).then(() => {
                                        location.reload();
                                    });
                                },
                                error: function(xhr) {
                                    console.error("Error:", xhr);
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
            });

            @if(session('success'))
            Swal.fire({
                title: "{{ session('alert') }}",
                text:"บันทึกข้อมูลสำเร็จ",
                icon: "success",
                confirmButtonText: 'ตกลง' // เพิ่มปุ่มยืนยัน
            });
        @endif

        let sortable = new Sortable(document.querySelector("#settingTable tbody"), {
        handle: ".handle",
        animation: 150,
        onEnd: function(evt) {
            let order = [];
            document.querySelectorAll("#settingTable tbody tr").forEach((row, index) => {
                order.push({
                    id: row.dataset.id,
                    position: index + 1
                });
            });

            // ส่งข้อมูลไปยัง Laravel
            fetch("{{ route('video.sort') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ order })
            }).then(response => console.log("Updated successfully"));
        }
    });
</script>
</body>
@endsection