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
                            <h4 class="m-0">ระบบบทเรียน</h4>
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
			<div class="container mt-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        แก้ไขระบบบทเรียน
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>บันทึกไม่สำเร็จ!</strong> กรุณาติดต่อ ADMIN
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form action="{{route('lesson.create')}}" enctype="multipart/form-data" method="post" id="uploadForm">
                            @csrf
                            <div class="form-group">
                                <label for="cate_id">หลักสูตรอบรมออนไลน์ <span class="required" style="color:red">*</span></label>
                                <select class="form-control" name="course_id">
                                    <option value="">เลือกหลักสูตร</option>
                                    @foreach ($course_online as $course_id)
                                        <option value="{{ $course_id->course_id }}">
                                            {{ $course_id->course_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="title">ชื่อบทเรียน <span class="required" style="color:red">*</span></label>
                                <input type="text" name="title" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="description">รายละเอียดย่อ <span class="required" style="color:red">*</span></label>
                                <textarea name="description" id="summernote" class="form-control"></textarea>
                            </div>

                            {{-- <div class="form-group">
                                <label for="view_all">สิทธิ์การดูบทเรียนนี้</label>
                                <div>
                                    <input type="checkbox" name="view_all" value="y" data-toggle="toggle" data-on="ดูได้ทั้งหมด" data-off="ดูได้เฉพาะกลุ่ม" data-onstyle="success" data-offstyle="danger" />
                                </div>
                            </div> --}}

                            {{-- <div class="form-group">
                                <label for="cate_amount">จำนวนครั้งที่สามารถทำข้อสอบได้ <span class="required" style="color:red">*</span></label>
                                <input type="text" name="cate_amount" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="time_test">เวลาในการทำข้อสอบ <span class="required" style="color:red">*</span></label>
                                <input type="text" name="time_test" class="form-control">
                            </div> --}}

                            <div class="form-group">
                                <label for="content">เนื้อหา <span class="required" style="color:red">*</span></label>
                                <textarea name="content" id="summernote2" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
								<label for="File_filename">ไฟล์บทเรียน (mp3, mp4)</label>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div id="fileNameDisplay"></div>
									<span class="btn btn-default btn-file">
										<span class="fileupload-new">Select file</span>
										<span class="fileupload-exists">Change</span>
										<input type="file" id="fileInput" multiple onchange="displayFileNames('fileInput', 'fileList')">
									</span>
								{{-- <input type="file" class="fileupload fileupload-new" name="filename[]" id="fileInput" multiple onchange="displayFileNames()"> --}}
								</div>
								<div id="fileList"></div>
                                <div id="uploadedFiles"></div>
							</div>

                            <div class="form-group">
								<label for="FileDoc_doc">ไฟล์ประกอบบทเรียน (pdf, docx, pptx)</label>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div id="fileNameDisplay"></div>
									<span class="btn btn-default btn-file">
										<span class="fileupload-new">Select file</span>
										<span class="fileupload-exists">Change</span>
										<input type="file" name="doc[]" id="docInput" multiple onchange="displayFileNames('docInput', 'fileListDoc')">
									</span>
								</div>
								{{-- <input type="file" name="doc[]" id="docInput" multiple onchange="displayFileNames('docInput', 'fileListDoc')"> --}}
								<div id="fileListDoc"></div>
							</div>

							<div class="form-group">
								<label for="course_picture">ภาพประกอบ</label>
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div id="fileNameDisplay"></div>
									<span class="btn btn-default btn-file">
										<span class="fileupload-new">Select file</span>
										<span class="fileupload-exists">Change</span>
										<input type="file" name="image" id="imageInput" onchange="previewImageFile()">
									</span>
								</div>
								{{-- <input type="file" name="image" id="imageInput" onchange="previewImageFile()"> --}}
								<img id="previewImage" src="#" alt="Preview Image" style="display: none; width: 100px; margin-top: 10px;">
							</div>

                            <div class="form-group">
                                <font color="#990000">
                                    รูปภาพควรมีขนาด 250x180(แนวนอน) หรือ ขนาด 250x(xxx) (แนวยาว)
                                </font>
                            </div>

                            <button id="submitBtn" type="submit" class="btn btn-primary">
								<i class="fas fa-save mr-1"></i> บันทึก
							</button>
                        </form>
                    </div>
                </div>
            </div>
			<div id="sidebar">
			</div><!-- sidebar -->
		</div>
	</div>
	<div class="clearfix"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/resumable.js/1.1.0/resumable.min.js"></script>
<script>
	$(document).ready(function() {
		$('#summernote').summernote();
		});

	$(document).ready(function() {
		$('#summernote2').summernote();
		});


		// แสดงชื่อไฟล์ที่เลือก
		function displayFileNames(inputId, listId) {
			var input = document.getElementById(inputId);
			var list = document.getElementById(listId);
			list.innerHTML = '';
			for (var i = 0; i < input.files.length; i++) {
				list.innerHTML += '<p>' + input.files[i].name + '</p>';
			}
		}

		// แสดงตัวอย่างรูปภาพ
		function previewImageFile() {
			var input = document.getElementById('imageInput');
			var previewImage = document.getElementById('previewImage');

			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					previewImage.src = e.target.result;
					previewImage.style.display = 'block';
				};
				reader.readAsDataURL(input.files[0]);
			}
		}
        document.addEventListener('DOMContentLoaded', function() {
            var uploadedCount = 0;
            var totalFiles    = 0;

            var r = new Resumable({
                target: '{{ route("upload.chunk") }}',
                chunkSize: 5 * 1024 * 1024,
                simultaneousUploads: 1,
                testChunks: false,
                fileType: ['mp3', 'mp4'],
                fileTypeErrorCallback: function(file, errorCount) {
                    alert('ระบบรองรับเฉพาะไฟล์ .mp3 และ .mp4 เท่านั้น');
                },
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            r.assignBrowse(document.getElementById('fileInput'));

            document.getElementById('fileInput').addEventListener('change', function() {
                totalFiles    = this.files.length;
                uploadedCount = 0;
                document.getElementById('uploadedFiles').innerHTML = '';
            });
            r.on('fileAdded', function(file) {
                var fileList = document.getElementById('fileList');
                fileList.innerHTML += `
                    <div id="progress-wrap-${file.uniqueIdentifier}" style="margin-bottom: 6px;">
                        <small id="status-${file.uniqueIdentifier}" class="text-muted">กำลังอัพโหลด...</small>
                        <div class="progress" style="height: 6px;">
                            <div id="progress-${file.uniqueIdentifier}"
                                class="progress-bar progress-bar-striped active"
                                style="width: 0%"></div>
                        </div>
                    </div>
                `;
                r.upload();
            });

            r.on('fileProgress', function(file) {
                var percent = Math.floor(file.progress() * 100);
                var uploadedMB = ((file.size * file.progress()) / 1024 / 1024).toFixed(1);
                var totalMB    = (file.size / 1024 / 1024).toFixed(1);
                document.getElementById('progress-' + file.uniqueIdentifier).style.width = percent + '%';
                document.getElementById('status-' + file.uniqueIdentifier).textContent =
                    `กำลังอัพโหลด ${percent}% (${uploadedMB}/${totalMB} MB)`;
            });

            r.on('fileSuccess', function(file) {
                document.getElementById('status-' + file.uniqueIdentifier).textContent = 'กำลัง merge...';

                fetch('{{ route("upload.merge") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        identifier:  file.uniqueIdentifier,
                        filename:    file.fileName,
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        document.getElementById('status-' + file.uniqueIdentifier).textContent = '✓ เสร็จแล้ว';
                        document.getElementById('progress-' + file.uniqueIdentifier).style.width = '100%';
                        document.getElementById('progress-' + file.uniqueIdentifier).classList.remove('active');
                        document.getElementById('progress-' + file.uniqueIdentifier).classList.add('bg-success');

                        var hidden = document.createElement('input');
                        hidden.type  = 'hidden';
                        hidden.name  = 'uploaded_files[]';
                        hidden.value = data.filename + '|' + data.duration;
                        document.getElementById('uploadedFiles').appendChild(hidden);

                        uploadedCount++;
                    }
                });
            });

            r.on('fileError', function(file) {
                document.getElementById('status-' + file.uniqueIdentifier).textContent = '❌ อัพโหลดล้มเหลว';
                document.getElementById('progress-' + file.uniqueIdentifier).classList.add('bg-danger');
            });

            document.getElementById('uploadForm').addEventListener('submit', function(e) {
                if (totalFiles > 0 && uploadedCount < totalFiles) {
                    e.preventDefault();
                    alert('กรุณารอให้ไฟล์ upload เสร็จก่อนครับ');
                }
            });

        });
</script>
</body>

@endsection
