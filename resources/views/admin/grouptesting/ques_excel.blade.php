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
                            <h4 class="m-0">ระบบชุดข้อสอบบทเรียนออนไลน์</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('grouptesting')}}">
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
				<!-- breadcrumbs -->
                <div class="container mt-5">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            นำเข้าระบบชุดข้อสอบบทเรียนออนไลน์
                        </div>
                        <div class="card-body">
                            <form action="{{ route('ques.excel',['id' => $group->group_id]) }}" enctype="multipart/form-data" method="post" id="uploadForm">
                                @csrf
                                <div class="form-group">
                                    <label>ประเภทข้อสอบ</label>
                                    <select name="import_type" class="form-control" required>
                                        <option value="">-- เลือกประเภท --</option>
                                        <option value="essay">ข้อสอบอัตนัย</option>
                                        <option value="choice">ข้อสอบปรนัย</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cate_id">นำเข้าไฟล์ สำหรับข้อสอบ </label>
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
                                    <i class="fas fa-save mr-1"></i> นำเข้าไฟล์ 
                                </button>
                                <br>
                                <br>
                                <div class="form-group">
                                    <label for="File_filename">แบบฟอร์มรูปแบบนำเข้าข้อสอบ</label>
                                        <table class="table table-striped table-bordered nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ข้อสอบอัตนัย</th>
                                                    <th>ข้อสอบปรนัย</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a id="templateLink"
                                                            href="{{ asset('images/uploads/template_import_essay.xlsx') }}"
                                                            style="color: red">
                                                            Download Excel 
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a id="templateLink"
                                                            href="{{ asset('images/uploads/template_import_choice.xlsx') }}"
                                                            style="color: red">
                                                            Download Excel 
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
    document.getElementById('importType').addEventListener('change', function() {

        let type = this.value;
        let link = document.getElementById('templateLink');

        if (type === 'essay') {
            link.href = "{{ asset('images/uploads/template_import_essay.xlsx') }}";
        } 
        else if (type === 'choice') {
            link.href = "{{ asset('images/uploads/template_import_choice.xlsx') }}";
        } 
        else {
            link.href = "#";
        }
    });
</script>
</body>
@endsection
