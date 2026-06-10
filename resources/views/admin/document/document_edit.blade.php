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
								<h4 class="m-0">เอกสารและประเภทเอกสาร</h4>
							</div>
							<div class="ml-3">
								<a href="{{route('document')}}">
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
                            แก้ไขเอกสารและประเภทเอกสาร
                        </div>
                        <div class="card-body">
                            <p>ค่าที่มี <span class="text-danger">*</span> จำเป็นต้องใส่ให้ครบ</p>
    
                            <form action="{{route('document.edit',['id' =>$document->filedoc_id])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="download_cate">ประเภทเอกสาร <span class="text-danger">*</span></label>
                                    <select class="form-control" name="download_cate" id="download_cate">
                                        <option value="{{$document_type->download_id ?? '-'}}">{{$document_type->download_name ?? '-'}}</option>
                                        @foreach ($document_cate as $item)
                                        <option value="{{ $item->download_id}}">{{$item->download_name}}</option>
                                        @endforeach
                                    </select> <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
                                </div>
    
                                <div class="form-group">
                                    <label for="filedoc_name">ชื่อไฟล์ <span class="text-danger">*</span></label>
                                    <input type="text" name="filedoc_name" class="form-control" value="{{ $document->filedoc_name }}" required>
                                </div>
    
                                <div class="form-group mb-0">
                                    <label for="cms_picture">ไฟล์ที่ดาว์นโหลด</label>
                                    <h4>{{ $document->filedocname}}</h4>
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

                                    
                                    </div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button> 
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

</body>

@endsection
