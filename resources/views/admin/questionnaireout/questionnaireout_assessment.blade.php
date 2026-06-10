@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<div id="wrapper">
    <div class="content-wrapper">

        {{-- HEADER --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <h4 class="m-0">การประเมินภาคปฎิบัติ</h4>

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

                            <div class="col-md-2">
                                <label>สถานะ</label>

                                <select id="status" class="form-control">

                                    <option value="">-- ทั้งหมด --</option>

                                    <option value="pass">
                                        กรอกข้อมูลแล้ว
                                    </option>

                                    <option value="wait">
                                        ยังไม่ได้กรอกข้อมูล
                                    </option>

                                </select>
                            </div>

                        </div>

                        {{-- 📊 TABLE --}}
                        <div id="resultTable">
                            @include('admin.questionnaireout.partials.table')
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
$(document).ready(function(){

    function loadData() {
        $.ajax({
            url: "/questionnaireout_assessment/ajax",
            type: "GET",
            data: {
                course_id: $('#course_id').val(),
                firstname: $('#firstname').val(),
                lastname: $('#lastname').val(),
                status: $('#status').val()
            },
            success: function(res){
                $('#resultTable').html(res.html);
            }
        });
    }

    $('#course_id').change(loadData);
    $('#status').change(loadData);

    let delayTimer;
    $('#firstname, #lastname').keyup(function(){
        clearTimeout(delayTimer);
        delayTimer = setTimeout(loadData, 400);
    });

});

$(document).on('click', '.detail-button', function(){

    let id = $(this).data('id');

    console.log('ID:', id); // 👈 ดูว่ามีค่าไหม

    $('#detailModal').modal('show');
    $('#modalContent').html('กำลังโหลด...');

    $.get('/questionnaireout_detail/' + id, function(res){
        console.log('RES:', res); // 👈 สำคัญมาก
        $('#modalContent').html(res);
    });

});

$(document).on('submit', '#saveForm', function(e){

    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "{{ route('questionnaireout_save') }}",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(res){
    console.log(res);

    Swal.fire('สำเร็จ', 'บันทึกเรียบร้อย', 'success');

    $('#detailModal').modal('hide');

    // ✅ กัน error + เรียก refresh
    if (typeof loadData === 'function') {
        loadData();
    }
},
        error: function(err){
            console.log(err);
        }
    });
});
</script>
