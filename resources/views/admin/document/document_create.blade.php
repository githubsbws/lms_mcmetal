@extends('admin.layouts.mainlayout')
@section('title', 'Admin')
@section('content')
<body class="">
        <div id="wrapper">
            <div class="content-wrapper">
                <div class="content-header">
					<div class="container-fluid">
						<div class="d-flex align-items-center">
							<div class="">
								<h4 class="m-0">เอกสารและประเภทเอกสาร</h4>
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
                <div class="container mt-5">
					<div class="card">
						<div class="card-header bg-primary text-white">
							เพิ่มเอกสาร
						</div>
						<div class="card-body">
							<p>ค่าที่มี <span class="text-danger">*</span> จำเป็นต้องใส่ให้ครบ</p>
	
							<form action="{{route('document.create')}}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<label for="document_title">หัวข้อเอกสาร <span class="text-danger">*</span></label>
									<select class="form-control" name="title" id="document_title_select">
                                        <option value="">--- เลือกชื่อเอกสาร ---</option>
                                        @foreach ($document_title as $title)
                                            <option value="{{ $title->title_id }}">{{ $title->title_name }}</option>
                                        @endforeach
                                    </select> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
								</div>
                                <div class="form-group">
									<label for="download_cate">ประเภทเอกสาร</label>
                                    <select class="form-control" name="download_cate" id="document_type_select">
                                        <option value="">--- ประเภทเอกสาร ---</option>
                                    <!-- ตัวเลือกประเภทเอกสารจะถูกเติมโดยอัตโนมัติ -->
                                    </select>
								</div>
								<div class="form-group">
									<label for="filedoc_name">ชื่อไฟล์</label>
									<input type="text" name="filedoc_name" class="form-control" required>
								</div>

                                <div class="form-group">
									<label for="filedoc_name">ไฟล์ที่ดาว์นโหลด</label>
									<div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div id="fileNameDisplay"></div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-new">Select file</span>
                                            <span class="fileupload-exists">Change</span>
                                            {{-- <input id="ytNews_cms_picture" type="hidden" value="{{$document->filedocname}}" name="cms_picture"> --}}
                                            <input name="filedoc" id="imageInput" type="file" onchange="displayFileName()" >
                                            
                                        </span>
                                        <script>
                                            function displayFileName() {
                                                // Get the file input element
                                                var input = document.getElementById('imageInput');
                                    
                                                // Get the file name
                                                var fileName = input.files[0].name;
                                    
                                                // Display the file name
                                                document.getElementById('fileNameDisplay').innerText = 'Selected file: ' + fileName;
                                            }
                                        </script>
                                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                        {{-- <input type="file" id="imageInput" name="image"> --}}
                                        @error('error')
                                        <div class="form-group">
                                            <div class="col-sm-6 col-sm-offset-3" style="padding: 0;">
                                                <span class="{{ $errors->has('error') ? 'input-error' : '' }}">{{ $message }}</span>
                                            </div>
                                        </div>
                                    @enderror
                                    
                                </div>
								</div>

								<div class="card-footer">
								<button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
								</div>
							</form>
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
    // ฟังก์ชันเพื่อเรียกและเติมตัวเลือกประเภทเอกสารตามชื่อที่เลือก
    function populateDocumentTypes() {
        var titleId = document.getElementById('document_title_select').value;
        var documentTypeSelect = document.getElementById('document_type_select');
        
        // เคลียร์ตัวเลือกที่มีอยู่ก่อนหน้า
        documentTypeSelect.innerHTML = '<option value="">--- ประเภทเอกสาร ---</option>';

        // สร้าง URL ใหม่โดยใช้ชื่อที่เลือก
        
        console.log(titleId)

        // เรียกข้อมูลประเภทเอกสารตามชื่อที่เลือก
        fetch('{{ url("getDocumentTypes") }}/' + titleId)
            .then(response => response.json())
            .then(data => {
                console.log(data); // เพื่อตรวจสอบว่าได้รับข้อมูลแล้วหรือยัง

                // เติมตัวเลือกประเภทเอกสาร
                data.forEach(item => {
                    var option = document.createElement('option');
                    option.value = item.download_id;
                    option.text = item.download_name;
                    documentTypeSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching document types:', error);
            });
    }

    // แนบตัวฟังก์ชันไปยังเลือกชื่อ
    document.getElementById('document_title_select').addEventListener('change', populateDocumentTypes);
</script>
    
    
</body>

@endsection
