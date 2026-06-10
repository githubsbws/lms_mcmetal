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
                            <h4 class="m-0">หมวดหัวข้อ</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('admin')}}">
                                <button class="btn btn-warning d-flex align-items-center">
                                    <i class="fas fa-angle-left mr-2"></i>
                                    กลับหน้าหลัก
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
				@if (session('success'))
                    <div class="alert alert-success" id="success-alert">{{ session('success') }}</div>
                    <script>
                        setTimeout(function(){
                            document.getElementById('success-alert').style.display = 'none';
                        }, 3000);
                    </script>
                @endif

                @if ($errors->has('import_excel'))
                    <div class="alert alert-danger" id="error-alert">{{ $errors->first('import_excel') }}</div>
                    <script>
                        setTimeout(function(){
                            document.getElementById('error-alert').style.display = 'none';
                        }, 3000);
                    </script>
                @endif
				<div class="container mt-5">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            นำเข้าจาก Excel
                        </div>
                        <div class="card-body">
                            <form action="{{ route('questionnaireout.excel') }}" enctype="multipart/form-data" method="post" id="uploadForm">
                                @csrf
                                <div class="form-group">
                                    <label for="cate_id">นำเข้าไฟล์ สำหรับข้อสอบ <label>(ไฟล์ excel เท่านั้น)</label></label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div id="fileNameDisplay"></div>
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-new">Select file</span>
                                            <span class="fileupload-exists">Change</span>
                                            <input type="file" name="import_excel" id="fileInput" onchange="displayFileNames('fileInput', 'fileList')">
                                        </span>
                                    {{-- <input type="file" class="fileupload fileupload-new" name="filename[]" id="fileInput" multiple onchange="displayFileNames()"> --}}
                                    </div>
                                    <div id="fileList"></div>
    
                                </div>
    
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> นำเข้าไฟล์ excel
                                </button>

                                <div class="form-group">
                                    <label for="File_filename">แบบฟอร์มรูปแบบนำเข้าข้อสอบ</label>
                                    <a href="{{asset('images/uploads/templete_import_questionnaireout.xlsx')}}"
                                           class="glyphicons download_alt"><i></i>Download Excel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
				<div id="sidebar">
				</div><!-- sidebar -->
			</div>
		</div>
		<div class="clearfix"></div>
<script>
    function displayFileNames(inputId, listId) {
            var input = document.getElementById(inputId);
            var list = document.getElementById(listId);
            list.innerHTML = '';
            for (var i = 0; i < input.files.length; i++) {
                list.innerHTML += '<p>' + input.files[i].name + '</p>';
            }
        }
</script>   
</body>
@endsection
