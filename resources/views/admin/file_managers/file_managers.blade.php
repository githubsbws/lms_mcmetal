@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<style>
.video-js {
        max-width: 100%
    }

    /* the usual RWD shebang */

    .video-js {
        width: 350px !important; /* override the plugin's inline dims to let vids scale fluidly */
        height: 200px !important;
    }

    .video-js video {
        position: relative !important;
    }
	.handle {
        cursor: grab; /* เปลี่ยนเป็นไอคอนจับลาก */
        transition: transform 0.2s ease-in-out;
    }

    .handle:hover {
        transform: scale(1); /* ขยายไอคอนเล็กน้อย */
        color: #007bff; /* เปลี่ยนสีให้ดูโดดเด่น */
    }

    /* เอฟเฟกต์ตอนลาก */
    .sortable-ghost {
        opacity: 0.5;
        background: #f8f9fa;
    }
</style>
<body class="">
	<div id="wrapper">
		<div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">จัดการวิดีโอ</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('lesson')}}">
                                <button class="btn btn-warning d-flex align-items-center">
                                    <i class="fas fa-angle-left mr-2"></i>
                                    กลับหน้าหลัก
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
                                        <th>วิดีโอ</th>
                                        <th>ชื่อไฟล์</th>
										<th>ชื่อบทเรียน</th>
										<th>ย้าย</th>
										<th>จัดการ</th> 
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @foreach($file as $f)
									<tr data-id="{{ $f->id }}">
                                        <td>
                                            <video id="example_video_1" class="video-js vjs-default-skin" controls="" preload="none" data-setup="{}" controlsList="nodownload">
												{{-- <source src="/../images/storage/uploads/lesson/{{$lesson->filename}}" type="video/mp4"> --}}
												<source src="{{asset('images/uploads/lesson/'.$f->filename)}}" type="video/mp4">
												<!-- <source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' />
															<source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' /> -->
												<!-- <track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track> -->
												<!-- Tracks need an ending tag thanks to IE9 -->
												<!-- <track kind="subtitles" src="demo.captions.vtt" srclang="en" label="English"></track> -->
												<!-- Tracks need an ending tag thanks to IE9 -->
												<p class="vjs-no-js">To view this video please
													enable JavaScript, and consider upgrading to
													a
													web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
												</p>
											</video>
                                        </td>
                                        <td class="text-center">
                                            {{ $f->file_name ?? '-' }}
                                        </td>
										<td class="text-center">
                                            {{ $f->lesson->title ?? '-'}}
                                        </td>
										<td class="handle"><i class="fas fa-arrows-alt"></i></td>
										<td>
                                            <a href="{{ route('file.edit',['id' =>$f->id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm delete-button" data-id="{{ $f->id }}">
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
                    var url = "/file_delete/" + id;

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
            fetch("{{ route('file.sort') }}", {
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