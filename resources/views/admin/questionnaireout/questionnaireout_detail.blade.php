
{{-- <style>
.result-box {
    cursor: pointer;
    transition: 0.2s;
}

.result-box:hover {
    background: #f8f9fa;
}

.result-radio:checked + .result-box {
    border: 2px solid #007bff;
    background: #e9f5ff;
}
</style> --}}
@if($data)

<form id="saveForm" method="POST" action="{{ route('questionnaireout_save') }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="passcours_id" value="{{ $data->passcours_id }}">

    {{-- 🔷 Header --}}
    <div class="mb-4 p-3 bg-light rounded border">
        <h5 class="mb-2">{{ $data->course_title }}</h5>
        <div>
            <strong>ผู้เข้าอบรม:</strong> {{ $data->firstname }} {{ $data->lastname }}
        </div>
    </div>

    {{-- 🔥 Section --}}
    <div class="row">

        {{-- Q&A --}}
        @if($data->q_a_weight > 0)
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    Q&A (เต็ม {{ $data->q_a_weight }} คะแนน)
                </div>
                <div class="card-body">

                    {{-- ✅ คะแนน --}}
                    <div class="form-group">
                        <label>คะแนน</label>
                        <input type="number"
                            name="q_a_score"
                            class="form-control score-input"
                            data-max="{{ $data->q_a_weight }}"
                            placeholder="กรอกคะแนน"
                            value="{{ $scores[1]->score ?? '' }}"
                            max="{{ $data->q_a_weight }}"
                            min="0">
                               <small class="text-danger error-msg" style="display:none;"></small>
                    </div>

                    {{-- 📎 Upload --}}
                    <div class="form-group">
                        <label>แนบไฟล์</label>

                        <input type="file"
                            name="q_a_file"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">

                        {{-- @if(isset($files[1]) && !empty($files[1]->file_name))
                            <div class="mt-2">
                                <a href="{{ asset('images/uploads/assessment_files/'.$files[1]->file_name) }}"
                                target="_blank"
                                class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-file"></i> ดูไฟล์เดิม
                                </a>
                            </div>
                        @endif --}}
                    </div>
                    {{-- 📝 หมายเหตุ --}}
                    <div class="form-group">
                        <label>หมายเหตุ</label>
                        <textarea name="q_a_remark"
                            class="form-control"
                            rows="2"
                            placeholder="กรอกหมายเหตุเพิ่มเติม (ถ้ามี)">{{ $scores[1]->detail ?? '' }}</textarea>
                    </div>

                </div>
            </div>
        </div>
        @endif


        {{-- Operate --}}
        @if($data->operate_weight > 0)
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    ปฏิบัติ (เต็ม {{ $data->operate_weight }} คะแนน)
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label>คะแนน</label>
                        <input type="number"
                               name="operate_score"
                               class="form-control score-input"
                               data-max="{{ $data->operate_weight }}"
                               placeholder="กรอกคะแนน"
                               value="{{ $scores[2]->score ?? '' }}"
                               max="{{ $data->operate_weight }}"
                               min="0">
                               <small class="text-danger error-msg" style="display:none;"></small>
                    </div>

                    <div class="form-group">
                        <label>แนบไฟล์</label>

                        <input type="file"
                            name="operate_file"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">

                        @if(isset($files[2]) && !empty($files[2]->file_name))
                            <div class="mt-2">
                                <a href="{{ asset('images/uploads/assessment_files/'.$files[2]->file_name) }}"
                                target="_blank"
                                class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-file"></i> ดูไฟล์เดิม
                                </a>
                            </div>
                        @endif
                    </div>

                    {{-- 📝 หมายเหตุ --}}
                    <div class="form-group">
                        <label>หมายเหตุ</label>
                        <textarea name="operate_remark"
                                class="form-control"
                                rows="2"
                                placeholder="กรอกหมายเหตุเพิ่มเติม (ถ้ามี)">{{ $scores[2]->detail ?? '' }}</textarea>
                    </div>

                </div>
            </div>
        </div>
        @endif


        {{-- Assign --}}
        @if($data->assign_weight > 0)
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-warning text-dark">
                    งานที่ได้รับมอบหมาย (เต็ม {{ $data->assign_weight }} คะแนน)
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label>คะแนน</label>
                        <input type="number"
                               name="assign_score"
                               class="form-control score-input"
                               data-max="{{ $data->assign_weight }}"
                               placeholder="กรอกคะแนน"
                               value="{{ $scores[3]->score ?? '' }}"
                               max="{{ $data->assign_weight }}"
                               min="0">
                        <small class="text-danger error-msg" style="display:none;"></small>
                    </div>

                    <div class="form-group">
                        <label>แนบไฟล์</label>

                        <input type="file"
                            name="assign_file"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">

                        {{-- @if(isset($files[3]) && !empty($files[3]->file_name))
                            <div class="mt-2">
                                <a href="{{ asset('images/uploads/assessment_files/'.$files[3]->file_name) }}"
                                target="_blank"
                                class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-file"></i> ดูไฟล์เดิม
                                </a>
                            </div>
                        @endif --}}
                    </div>

                    {{-- 📝 หมายเหตุ --}}
                    <div class="form-group">
                        <label>หมายเหตุ</label>
                        <textarea name="assign_remark"
                                class="form-control"
                                rows="2"
                                placeholder="กรอกหมายเหตุเพิ่มเติม (ถ้ามี)">{{ $scores[3]->detail ?? '' }}</textarea>
                    </div>

                </div>
            </div>
        </div>
        @endif


        {{-- Observe --}}
        @if($data->observe_weight > 0)
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-danger text-white">
                    การสังเกต (เต็ม {{ $data->observe_weight }} คะแนน)
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label>คะแนน</label>
                        <input type="number"
                               name="observe_score"
                               class="form-control score-input"
                               data-max="{{ $data->observe_weight }}"
                               placeholder="กรอกคะแนน"
                               value="{{ $scores[4]->score ?? '' }}"
                               max="{{ $data->observe_weight }}"
                               min="0">
                        <small class="text-danger error-msg" style="display:none;"></small>
                    </div>

                    <div class="form-group">
                        <label>แนบไฟล์</label>

                        <input type="file"
                            name="observe_file"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx">

                        {{-- @if(isset($files[4]) && !empty($files[4]->file_name))
                            <div class="mt-2">
                                <a href="{{ asset('images/uploads/assessment_files/'.$files[4]->file_name) }}"
                                target="_blank"
                                class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-file"></i> ดูไฟล์เดิม
                                </a>
                            </div>
                        @endif --}}
                    </div>

                    {{-- 📝 หมายเหตุ --}}
                    <div class="form-group">
                        <label>หมายเหตุ</label>
                        <textarea name="observe_remark"
                                class="form-control"
                                rows="2"
                                placeholder="กรอกหมายเหตุเพิ่มเติม (ถ้ามี)">{{ $scores[4]->detail ?? '' }}</textarea>
                    </div>

                </div>
            </div>
        </div>
        @endif

            {{-- <div class="card shadow-sm mt-3"> --}}
                {{-- <div class="card-header bg-info text-white">
                    ผลการประเมิน
                </div> --}}

                {{-- <div class="card-body"> --}}

                    {{-- <div class="row text-center"> --}}

                        {{-- ✅ ผ่าน --}}
                        {{-- <div class="col-md-6 mb-2">
                            <label class="w-100">
                                <input type="radio" name="result_status" value="pass" class="d-none result-radio">

                                <div class="result-box border rounded p-3 h-100">
                                    <h5 class="text-success mb-2">✅ ผ่าน</h5>
                                    <small class="text-muted">ผู้เรียนผ่านเกณฑ์</small>
                                </div>
                            </label>
                        </div> --}}

                        {{-- ❌ ไม่ผ่าน --}}
                        {{-- <div class="col-md-6 mb-2">
                            <label class="w-100">
                                <input type="radio" name="result_status" value="fail" class="d-none result-radio">

                                <div class="result-box border rounded p-3 h-100">
                                    <h5 class="text-danger mb-2">❌ ไม่ผ่าน</h5>
                                    <small class="text-muted">ผู้เรียนไม่ผ่านเกณฑ์</small>
                                </div>
                            </label>
                        </div> --}}

                    {{-- </div> --}}

                    {{-- <small class="text-danger error-result" style="display:none;"></small> --}}

                {{-- </div> --}}
            {{-- </div> --}}

    </div>

    {{-- 🔥 ปุ่ม --}}
    <div class="text-right mt-3">
        <button type="submit" class="btn btn-success px-4">
            บันทึก
        </button>
    </div>

</form>

@endif


@section('script')
<script>

$(document).on('input', '.score-input', function () {

    let max = Number($(this).data('max'));
    let val = $(this).val();
    let input = $(this);
    let errorBox = input.siblings('.error-msg');

    // reset
    input.removeClass('is-invalid');
    errorBox.hide();

    if (val === '') return;

    val = Number(val);

    // ❌ ไม่ใช่ตัวเลข
    if (isNaN(val)) {
        input.addClass('is-invalid');
        errorBox.text('กรุณากรอกตัวเลข').show();
        return;
    }

    // ❌ ติดลบ
    if (val < 0) {
        input.addClass('is-invalid');
        errorBox.text('คะแนนต้องมากกว่าหรือเท่ากับ 0').show();
        return;
    }

    // ❌ เกิน
    if (val > max) {
        input.addClass('is-invalid');
        errorBox.text('คะแนนห้ามเกิน ' + max).show();
        return;
    }

    // ✅ ถูกต้อง
    input.removeClass('is-invalid');
    errorBox.hide();
});

$(document).on('submit', '#saveForm', function(e){
    console.log('FORM SUBMIT'); // 👈 ต้องขึ้น
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

            if (typeof loadData === 'function') {
                loadData();
            }
        },
        error: function(err){
            console.log(err);
        }
    });
});

$(document).on('change', 'input[type="file"]', function(){

    let file = this.files[0];

    if (!file) return;

    let allowed = [
        'image/jpeg',
        'image/png',
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    if (!allowed.includes(file.type)) {

        $(this).val('');

        Swal.fire({
            icon: 'warning',
            title: 'ไฟล์ไม่ถูกต้อง',
            text: 'อนุญาตเฉพาะ JPEG, PNG, PDF, Word, Excel'
        });
    }
});
</script>
@endsection