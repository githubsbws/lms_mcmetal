@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Orgchart;
use App\Models\ASC;
@endphp
<body>
    <div id="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">ระบบจัดการสมาชิก</h4>
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
                
				<!-- breadcrumbs -->
                <div class="container mt-5">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            นำเข้าจาก Excel
                        </div>
                        <div class="card-body">
                            <form action="{{ route('import.excel') }}" enctype="multipart/form-data" method="post" id="uploadForm">
                                @csrf
                                <div class="form-group">
                                    <label for="cate_id">นำเข้าไฟล์ สำหรับผู้เรียน <label>(ไฟล์ excel เท่านั้น)</label></label>
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
                                    <label for="File_filename">แบบฟอร์มรูปแบบนำเข้าสมาชิก</label>
                                    <a href="{{asset('images/uploads/templete_import_users_news.xlsx')}}"
                                           class="glyphicons download_alt"><i></i>Download Excel</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            @php
                            $orgchart = Orgchart::where('active','y')->get();
                            @endphp
                            <table id="settingTable" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
										<th>org_id</th>
										<th>title</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @foreach($orgchart as $org)
                                    <tr>
										<td>{{ $org->id}}</td>
                                        <td>{{ $org->title}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            @php
                            $asc = ASC::where('active','y')->get();
                            @endphp
                            <table id="settingTable2" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
										<th>asc_id</th>
                                        <th>asc_code</th>
										<th>title</th>
                                    </tr>
                                </thead>
                                <tbody id="sortable">
                                    @foreach($asc as $as)
                                    <tr>
										<td>{{ $as->id}}</td>
                                        <td>{{ $as->asc_code}}</td>
                                        <td>{{ $as->name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        // Initialize DataTable
        $('#settingTable2').DataTable({
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
