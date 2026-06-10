@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Company;
@endphp
<body>
	<div id="wrapper">
		<div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">ASC</h4>
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
                <div class="card m-0">
                    <div class="card-header bg-primary text-white">ASC</div>
                    <div class="card-body">
                        <table id="ascTable" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ชื่อบริษัท</th>
                                    <th>ASC_Code</th>
                                    <th>จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asc as $data)
                                <tr data-id="{{ $data->id }}">
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->asc_code }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm delete-button"
                                            data-id="{{ $data->id }}"
                                            data-name="{{ $data->name }}"
                                            data-url="{{ route('asc.delete', $data->id) }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
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
</body>
<script>
$(document).ready(function () {
    // ✅ Init DataTables แยกแต่ละตัว
    $('#companyTable, #ascTable, #positionTable').DataTable({
        responsive: true,
        scrollX: true,
        language: { url: '/include/languageDataTable.json' }
    });

    $.ajaxSetup({
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") }
    });

    console.log("✅ Delete button script loaded");

    $(document).on("click", ".delete-button", function (e) {
        e.preventDefault();

        const id = $(this).data("id");
        const name = $(this).data("name");
        const url = $(this).data("url");
        const row = $(this).closest("tr");

        Swal.fire({
            title: `คุณต้องการลบ "${name}" ใช่หรือไม่?`,
            text: "ข้อมูลนี้จะถูกลบถาวร!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ใช่, ลบเลย!",
            cancelButtonText: "ยกเลิก"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "POST",
                    success: function (response) {
                        console.log("✅ Success:", response);
                        Swal.fire({
                            title: "สำเร็จ!",
                            text: response.message || "ลบข้อมูลสำเร็จ",
                            icon: "success",
                            timer: 1500,
                            showConfirmButton: false
                        });
                        // ✅ ลบแถวออกจาก DataTable โดยไม่ต้อง reload
                        row.fadeOut(300, function () {
                            const table = row.closest('table').DataTable();
                            table.row(row).remove().draw(false);
                        });
                    },
                    error: function (xhr) {
                        console.error("❌ Error:", xhr);
                        Swal.fire(
                            "เกิดข้อผิดพลาด!",
                            xhr.responseJSON?.message || "ไม่สามารถลบข้อมูลได้",
                            "error"
                        );
                    }
                });
            }
        });
    });

    @if(session('success'))
    Swal.fire({
        title: "{{ session('alert') }}",
        text: "บันทึกข้อมูลสำเร็จ",
        icon: "success",
        confirmButtonText: "ตกลง"
    });
    @endif
});

</script>

@endsection