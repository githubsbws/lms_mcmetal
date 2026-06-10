@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<div id="wrapper">
    <div class="content-wrapper">

        {{-- HEADER --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <h4 class="m-0">ตรวจข้อสอบอัตนัย</h4>

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
                            @include('admin.questionnaireout.partials.table_exam')
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="checkModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">ตรวจข้อสอบอัตนัย</h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">
                    &times;
                </button>
            </div>

            <div class="modal-body" id="checkModalContent">
                <div class="text-center">
                    กำลังโหลด...
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

<!-- 1. โหลด jQuery ก่อน -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- 2. ค่อยเขียน script ของคุณ -->
<script>
$(document).ready(function(){

    function loadData() {
        $.ajax({
            url: "/questionnaireout_check_exam/ajax",
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
    }

    $('#course_id').change(loadData);

    let delayTimer;
    $('#firstname, #lastname').keyup(function(){
        clearTimeout(delayTimer);
        delayTimer = setTimeout(loadData, 400);
    });

});

$(document).on('click', '.check-button', function () {

    let course_id = $(this).data('course');
    let user_id   = $(this).data('user');

    // ✅ ใช้ชื่อเดียวกับ modal จริง
    $('#checkModal').modal('show');

    $('#checkModalContent').html(`
        <div class="text-center">
            กำลังโหลด...
        </div>
    `);

    $.ajax({

        url: '/questionnaireout_check_exam_detail',

        type: 'GET',

        data: {
            course_id: course_id,
            user_id: user_id
        },

        success: function(res){

            // ✅ ใช้ชื่อเดียวกัน
            $('#checkModalContent').html(res);

        },

        error: function(xhr){

            console.log(xhr.responseText);

            $('#checkModalContent').html(`
                <div class="alert alert-danger">
                    โหลดข้อมูลไม่สำเร็จ
                </div>
            `);

        }

    });

});

$(document).on('click', '#saveExamScore', function () {

    let score = $('.score-input').val();

    let max = $('.score-input').data('max');

    let course_id = $('#exam_course_id').val();
    let user_id   = $('#exam_user_id').val();

    // validation
    if (score === '') {

        Swal.fire({
            icon: 'warning',
            title: 'กรุณากรอกคะแนน'
        });

        return;
    }

    if (parseFloat(score) > parseFloat(max)) {

        Swal.fire({
            icon: 'warning',
            title: 'คะแนนห้ามเกิน ' + max
        });

        return;
    }

    $.ajax({

        url: '/questionnaireout_check_exam_save',

        type: 'POST',

        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            course_id: course_id,
            user_id: user_id,
            score: score,
            score_total: max
        },

        success: function(res){

    if(res.success){

        Swal.fire({
            icon: 'success',
            title: 'บันทึกสำเร็จ'
        });

        $('#checkModal').modal('hide');

        if (typeof loadData === 'function') {
            loadData();
        }

    } else {

        Swal.fire({
            icon: 'warning',
            title: res.message
        });

    }

},

        error: function(xhr){

            console.log(xhr.responseText);

            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด'
            });

        }

    });

});

</script>
