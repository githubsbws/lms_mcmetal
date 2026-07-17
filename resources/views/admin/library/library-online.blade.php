@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
    <div id="wrapper">
        <div class="content-wrapper">
            <div class="content-header py-4">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <h4 class="m-0 font-weight-bold text-dark">ระบบห้องสมุดออนไลน์</h4>
                            <div class="ml-3">
                                <a href="#">
                                    <button class="btn btn-warning d-flex align-items-center shadow-sm">
                                        <i class="fas fa-angle-left mr-2"></i>
                                        กลับหน้าหลัก
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid px-4">

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <i class="fas fa-file-upload mr-2"></i>
                        <h5 class="mb-0 font-weight-bold" style="font-size: 1rem;">เพิ่มไฟล์แนบ</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.library.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row align-items-end">
                                <div class="col-md-5 mb-3 mb-md-0">
                                    <label for="customFile" class="font-weight-bold text-secondary">เลือกไฟล์ที่ต้องการอัปโหลด</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="uploaded_file" accept=".pdf, .mp4" required>
                                        <label class="custom-file-label" for="customFile">เลือกไฟล์...</label>
                                    </div>
                                </div>
                                <div class="col-md-5 mb-3 mb-md-0">
                                    <label for="file_title" class="font-weight-bold text-secondary">ชื่อเรียกไฟล์</label>
                                    <input type="text" class="form-control" id="file_title" name="file_title" placeholder="เช่น เอกสารการใช้งาน" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success btn-block shadow-sm">
                                        <i class="fas fa-plus mr-1"></i> อัปโหลด
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <small class="text-muted"><i class="fas fa-info-circle mr-1"></i> รองรับไฟล์ PDF,MP4</small>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white d-flex align-items-center">
                        <i class="fas fa-list mr-2"></i>
                        <h5 class="mb-0 font-weight-bold" style="font-size: 1rem;">รายการไฟล์ทั้งหมด</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                        @if($libraryFiles && $libraryFiles->isNotEmpty())
                            <table class="table table-hover table-striped mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 8%">ลำดับ</th>
                                        <th style="width: 45%">ชื่อไฟล์ / หัวข้อ</th>
                                        <th style="width: 15%" class="text-center">ยอดกดดู</th>
                                        <th style="width: 17%">วันที่เพิ่มไฟล์</th>
                                        <th style="width: 15%" class="text-center">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $libraryFiles as $key => $file)
                                        <tr>
                                            <td>{{ ($libraryFiles->currentPage() - 1) * $libraryFiles->perPage() + $key + 1 }}</td>
                                            <td>
                                                @php
                                                    // ดึงนามสกุลไฟล์ออกมา และแปลงเป็นตัวพิมพ์เล็กทั้งหมดเพื่อความปลอดภัย
                                                    $extension = strtolower(pathinfo($file->filename, PATHINFO_EXTENSION));
                                                @endphp
                                                @if ($extension == 'pdf')
                                                    <i class="far fa-file-pdf text-danger mr-2"></i>
                                                @else
                                                <i class="far fa-file-video text-info mr-2"></i>
                                                @endif
                                                <a href="{{ route('admin.library.view',$file->id) }}" target="_blank" class="font-weight-bold text-primary">{{ $file->name  }}</a>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-pill badge-info"><i class="far fa-eye mr-1"></i> {{ $file->view }} ครั้ง</span>
                                            </td>
                                            <td><span class="text-muted">{{ \Carbon\Carbon::parse($file->created_at)->locale('th')->isoFormat('D MMM YYYY') }}</span></td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group" role="group">
                                                    {{-- <a href="#" class="btn btn-info" title="แก้ไข">
                                                        <i class="fas fa-edit"></i>
                                                    </a> --}}
                                                    <button type="button" class="btn btn-danger btn-delete" title="ลบ" data-id="{{ $file->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $libraryFiles->links('pagination::bootstrap-4') }}
                            </div>
                        @else
                            <div class="text-center mt-2"><p>ไม่มีข้อมูล</p></div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>

            <div id="sidebar"></div></div>
    </div>
    <div class="clearfix"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('.custom-file-input').addEventListener('change', function (e) {
                var fileName = document.getElementById("customFile").files[0].name;
                var nextSibling = e.target.nextElementSibling;
                nextSibling.innerText = fileName;
            });
        });

        document.querySelector('tbody').addEventListener('click',function(e) {
            const btnDelete = e.target.closest('.btn-delete');

            if(!btnDelete) return;

            const fileId = btnDelete.dataset.id;

            Swal.fire({
                title: 'ยืนยันการลบ?',
                text: 'ระบบจะทำการลบไฟล์',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',
                backdrop: false
            }).then(async(result) => {
                if(result.isConfirmed) {
                    try{
                        const res = await fetch(`{{ url('/library/deletefile') }}/${fileId}`,{
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        });
                        const data = await res.json();
                        if(res.ok){
                            Swal.fire({
                                title: 'ลบสำเร็จ',
                                icon: 'success',
                                showCancelButton: false,
                                backdrop: false
                            }).then(() => window.location.reload());
                        } else {
                            Swal.fire('เกิดข้อผิดพลาด', data.message ?? 'ไม่สามารถลบได้', 'error');
                        }
                    } catch(error) {
                        Swal.fire('เกิดข้อผิดพลาด', error.message, 'error');
                    }
                }
            })

        })
    </script>
@endsection
