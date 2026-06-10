@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<div id="wrapper">
    <div class="content-wrapper">

        {{-- HEADER --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <h4 class="m-0">การสอบซ่อม</h4>

                    <div class="ml-3">
                        <a href="{{ route('admin') }}">
                            <button class="btn btn-warning">
                                <i class="fas fa-angle-left"></i> กลับหน้าหลัก
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="content">
            <div class="container-fluid">
                <div class="card">

                    <div class="card-body">

                        {{-- 🔍 FILTER --}}
                        <div class="row mb-3">

                            <div class="col-md-4">
                                <label>หลักสูตร</label>
                                <select id="course_id" class="form-control">
                                    <option value="">-- เลือกหลักสูตร --</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->course_id }}">
                                            {{ $course->course_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>ชื่อ</label>
                                <input type="text" id="firstname" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label>นามสกุล</label>
                                <input type="text" id="lastname" class="form-control">
                            </div>

                        </div>

                        {{-- 📊 TABLE --}}
                        <div id="resultTable">
                            @include('admin.questionnaireout.partials.table_test')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="detailModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">รายละเอียด</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body" id="modalContent">
                <div class="text-center">กำลังโหลด...</div>
            </div>

        </div>
    </div>
</div>
@endsection

<!-- 1. โหลด jQuery ก่อน -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- 2. ค่อยเขียน script ของคุณ -->
<script>
window.loadData = function() {
    $.ajax({
        url: "{{ route('questionnaireout.assessment.ajax_test') }}",
        type: "GET",
        data: {
            course_id: $('#course_id').val(),
            firstname: $('#firstname').val(),
            lastname: $('#lastname').val()
        },
        success: function(res){
            $('#resultTable').html(res.html);
        }
    });
};

$(document).ready(function(){

    // 🔽 dropdown
    $('#course_id').change(loadData);

    // 🔍 search delay
    let delayTimer;
    $('#firstname, #lastname').keyup(function(){
        clearTimeout(delayTimer);
        delayTimer = setTimeout(loadData, 400);
    });

});

$(document).on('click', '.reset-button', function(){

    let course_id = $(this).data('course');
    let user_id = $(this).data('user');

    Swal.fire({
        title: 'ยืนยันการรีเซต?',
        text: 'ข้อมูลการประเมินจะถูกลบ',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ใช่, รีเซต',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: "{{ route('questionnaireout.reset.action') }}",
                type: "POST",
                data: {
                    course_id: course_id,
                    user_id: user_id,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res){

                    Swal.fire('สำเร็จ', 'รีเซตเรียบร้อย', 'success');

                    if (typeof loadData === 'function') {
                        loadData();
                    }
                }
            });

        }

    });

});
</script>
