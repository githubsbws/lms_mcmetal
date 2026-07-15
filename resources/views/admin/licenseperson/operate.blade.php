@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
    <div id="warpper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">ระบบนำเข้า License User</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{ route('admin') }}">
                                <button class="btn btn-warning d-flex align-items-center">
                                    <i class="fas fa-angle-left mr-2"></i>
                                    หน้าหลัก
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 text-primary font-weight-bold">
                                <i class="fas fa-file-excel mr-2"></i>นำเข้าข้อมูลจาก Excel (Import)
                            </h5>
                        </div>
                        <div class="card-body">
                            <form id="upload-excel-form" action="{{ route('license.operate.excel') }}" method="POST"
                                enctype="multipart/form-data">
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
                                        <a href="{{ asset('images/uploads/template-file/license_user_temp.xlsx') }}"
                                            class="btn btn-info btn-block">โหลด Template</a>
                                    </div>
                                    <div class="col-md-3 text-right text-muted">
                                        <small>โปรดระมัดระวังเรื่องรูปแบบคอลัมน์ให้ตรงตามเทมเพลต</small>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <!-- Block 2: Data Display Section -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 font-weight-bold">License User</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="5%" class="text-center">No</th>
                                            <th>Name</th>
                                            <th>line</th>
                                            <th>จัดการ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($licenseOperate as $index => $item)
                                            <tr>
                                                <td class="text-center">{{ ($licenseOperate->currentPage() - 1) * $licenseOperate->perPage() + $loop->index + 1 }}</td>
                                                <td>{{ $item->operation_name }}</td>
                                                <td>
                                                    {{-- 🎯 เช็กก่อนว่ามีข้อมูลในอาร์เรย์ไหม และต้องไม่ว่างเปล่า --}}
                                                    @if (!empty($item->line) && is_array($item->line))
                                                        @foreach ($item->line as $lineName)
                                                            <span class="badge bg-success text-white me-1 mb-1"
                                                                style="font-size: 14px;">
                                                                {{ $lineName }}
                                                            </span>
                                                        @endforeach
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('license.operate.edit', $item->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm delete-button"
                                                        data-id="{{ $item->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
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
                                <div class="d-flex mt-4">
                                    {{-- 🧙‍♂️ คาถาเสกปุ่มเปลี่ยนหน้าอัตโนมัติจาก Laravel --}}
                                    {{ $licenseOperate->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('upload-excel-form').addEventListener('submit', function(e) {
                e.preventDefault(); // 🛑 เบรกหน้าจอ ไม่ให้รีเฟรชหนีไปไหน

                // 1. เรียกป็อปอัพหมุนติ้วๆ ล็อกหน้าจอไว้เลย ยูสเซอร์จะกดอะไรซ้ำไม่ได้
                Swal.fire({
                    title: 'กำลังนำเข้าข้อมูล...',
                    text: 'ระบบกำลังอ่านไฟล์ Excel และบันทึกลงระบบ กรุณารอสักครู่',
                    allowOutsideClick: false, // ห้ามคลิกพื้นที่ว่างข้างนอกเพื่อปิด
                    allowEscapeKey: false, // ห้ามกดปุ่ม Esc
                    backdrop: false,
                    didOpen: () => {
                        Swal.showLoading(); // สั่งรันแอนิเมชันหมุนโหลดแบบจัดเต็ม
                    }
                });

                // 2. แพ็กไฟล์ Excel เตรียมส่ง
                let formData = new FormData(this);

                // 3. ใช้ Fetch API ยิงหลังบ้านแบบ Ajax ไร้รอยต่อ
                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest' // บอก Laravel ว่านี่คือ Ajax นะจ๊ะ
                        }
                    })
                    .then(response => {
                        // แนะนำให้ทาง Controller ของหนูทำ return response()->json(['success' => true]); กลับมานะครับ
                        if (response.ok) {
                            // 🎉 ถ้านำเข้าสำเร็จ ปิดตัวหมุน แล้วขึ้นแจ้งเตือนสำเร็จ
                            Swal.fire({
                                icon: 'success',
                                title: 'นำเข้าข้อมูลสำเร็จ!',
                                confirmButtonText: 'ตกลง',
                                backdrop: false,
                            }).then(() => {
                                window.location.reload(); // รีเฟรชหน้าเว็บทีเดียวเพื่ออัปเดตตารางดรอปดาวน์
                            });
                        } else {
                            throw new Error('Something went wrong');
                        }
                    })
                    .catch(error => {
                        // ถ้าหลังบ้านพังล่มกลางทาง ดีดแจ้งเตือน Error ทันที
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            text: 'ระบบไม่สามารถนำเข้าข้อมูลได้ กรุณาตรวจสอบไฟล์อีกครั้ง',
                            confirmButtonText: 'รับทราบ',
                            backdrop: false,
                        });
                    });
            });

            document.addEventListener("DOMContentLoaded", function () {
                document.querySelectorAll('.delete-button').forEach(button => {
                    button.addEventListener('click', function () {
                        const id = this.getAttribute('data-id');
                        // 🎯 หาแท็ก <tr> (แถวตาราง) ของปุ่มนี้เตรียมไว้ เพื่อจะสั่งลบออกจากหน้าจอตอนหลังบ้านเสร็จ
                        const row = this.closest('tr');

                        // 1. เรียกสวอลล์ถามความสมัครใจ
                        Swal.fire({
                            title: 'ยืนยันการลบข้อมูล?',
                            text: "คุณต้องการลบรายการพารามิเตอร์นี้ใช่หรือไม่?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'ใช่, ลบเลย!',
                            cancelButtonText: 'ยกเลิก',
                            backdrop:false
                        }).then((result) => {
                            // 2. ถ้ายูสเซอร์กดยืนยันลบ
                            if (result.isConfirmed) {
                                // 3. ยิง Ajax (Fetch) ข้ามไปหา Controller โดยตรง
                                fetch(`/licenseperson/user/delete/${id}`, {
                                    method: 'POST', // หรือจะใช้ DELETE ถ้าใน Route หนูตั้งเป็น Delete
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // ส่ง Token ป้องกัน 419 ผ่าน Headers
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                })
                                .then(response => {
                                    if (response.ok) {
                                        // 🎉 ถ้าหลังบ้านลบสำเร็จ เปลี่ยนสวอลล์เป็นติ๊กถูก
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'ลบสำเร็จ!',
                                            text: 'ข้อมูลถูกลบออกจากระบบเรียบร้อยแล้ว',
                                            confirmButtonText: "OK"
                                        }).then(() => {
                                            location.reload();
                                        });

                                        // 🔥 ทีเด็ด: สั่งให้แถวตารางตัวนั้นค่อย ๆ เฟดหายไปจากหน้าจอทันทีโดยไม่ต้องรีเฟรชหน้าเว็บ!
                                    } else {
                                        throw new Error('Delete failed');
                                    }
                                })
                                .catch(error => {
                                    // ❌ ถ้าล่มกลางทาง ดีดเออร์เรอร์แจ้ง
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'เกิดข้อผิดพลาด!',
                                        text: 'ไม่สามารถลบข้อมูลได้ กรุณาลองใหม่อีกครั้ง'
                                    });
                                });
                            }
                        });
                    });
                });
            });
        </script>
    @endsection
