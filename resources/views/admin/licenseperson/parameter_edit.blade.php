@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
    <div id="warpper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">License Authorized</h4>
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
                    <div class="card-body">
                        <form action="{{ route('license.parameter.update',$parameter->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">License Authorized</label>
                                    <input type="text" name="parameter_name" class="form-control" value="{{ $parameter->parameter_name }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">สายการผลิต (Lines) *ใช้เครื่องหมายคอมม่า ( , ) คั่นแต่ละสายผลิต</label>
                                    <input type="text" name="lines_string" class="form-control"
                                        value="{{ !empty($parameter->line) && is_array($parameter->line) ? implode(', ', $parameter->line) : '' }}"
                                        placeholder="ตัวอย่างเช่น: Mixing Line 1, Mixing Line 2, Mixing Line 3">
                                </div>

                                <div class="mt-4 text-end">
                                    <a href="javascript:history.back()" class="btn btn-secondary me-2">ยกเลิก</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save mr-1"></i> บันทึกการเปลี่ยนแปลง
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


