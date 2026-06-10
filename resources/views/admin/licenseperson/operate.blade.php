@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
    <div id="warpper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">ระบบนำเข้า Operation Machine</h4>
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
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary font-weight-bold">
                            <i class="fas fa-file-excel mr-2"></i>นำเข้าข้อมูลจาก Excel (Import)
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('license.operate.excel') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                        <input type="file" name="excel_file" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="fas fa-upload mr-1"></i> เริ่มการนำเข้าข้อมูล
                                    </button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ asset('images/uploads/template-file/operation_machine_temp.xlsx') }}" class="btn btn-info btn-block">โหลด Template</a>
                                </div>
                                <div class="col-md-3 text-right text-muted">
                                    <small>โปรดระมัดระวังเรื่องรูปแบบคอลัมน์ให้ตรงตามเทมเพลต</small>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Block 2: Data Display Section -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 font-weight-bold">License Person (Operation Machine)</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="5%" class="text-center">No</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($licenseOperate as $index => $item)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $item->operation_name }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="fas fa-folder-open fa-2x mb-3 d-block"></i>
                                                ยังไม่มีข้อมูลในระบบ
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


