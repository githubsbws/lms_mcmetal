@if(count($data) > 0)

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="font-weight-bold text-primary mb-1">
                {{ $data[0]->course_title }}
            </h4>

            <div class="text-muted">
                ผู้เข้าสอบ :
                <strong>
                    {{ $data[0]->firstname }}
                    {{ $data[0]->lastname }}
                </strong>
            </div>

        </div>

        {{-- STEP --}}
        <div class="bg-primary text-white px-3 py-2 rounded-pill font-weight-bold">

            <span id="currentQuestion">1</span>
            /
            <span id="totalQuestion">{{ count($data) }}</span>

        </div>

    </div>

    <input type="hidden"
           id="exam_course_id"
           value="{{ $data[0]->course_id }}">

    <input type="hidden"
           id="exam_user_id"
           value="{{ $data[0]->user_id }}">

    {{-- QUESTIONS --}}
    @foreach($data as $index => $item)

    <div class="question-box"
         data-index="{{ $index }}"
         style="{{ $index != 0 ? 'display:none;' : '' }}">

        {{-- QUESTION --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-info text-white">
                <i class="fas fa-question-circle"></i>
                คำถาม
            </div>

            <div class="card-body">

                <div class="p-3 rounded bg-light border">
                    {{-- {!! nl2br(e($item->ques_title)) !!} --}}
                    {!! strip_tags(html_entity_decode($item->ques_title), '<b><strong><i><em><u>') !!}
                </div>

            </div>

        </div>

        {{-- ANSWER --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-warning">
                <i class="fas fa-user-edit"></i>
                คำตอบของผู้เข้าสอบ
            </div>

            <div class="card-body">

                <div class="p-4 rounded border bg-light"
                     style="min-height:180px; font-size:15px; line-height:1.8;">

                    {{-- {!! nl2br(e($item->answer_text)) !!} --}}
                    {!! strip_tags(html_entity_decode($item->answer_text), '<b><strong><i><em><u>') !!}
                </div>

            </div>

        </div>

        {{-- เฉลย --}}
        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-success text-white">
                <i class="fas fa-check-circle"></i>
                เฉลย
            </div>

            <div class="card-body">

                <div class="p-4 rounded border bg-light"
                     style="min-height:180px; font-size:15px; line-height:1.8;">

                    {{-- {!! nl2br(e($item->answer)) !!} --}}
                    {!! strip_tags(html_entity_decode($item->answer), '<b><strong><i><em><u>') !!}

                </div>

            </div>

        </div>

    </div>

    @endforeach

    {{-- SCORE --}}
   <div id="scoreSection" style="display:none;">

        <div class="card shadow-sm border-0 mb-4">

            <div class="card-header bg-primary text-white">
                <i class="fas fa-star"></i>
                ให้คะแนน
            </div>

            <div class="card-body">

                <div class="row align-items-end">

                    <div class="col-md-8">

                        <label class="font-weight-bold mb-2">
                            <i class="fas fa-star text-warning"></i>
                            คะแนน
                        </label>

                        <input type="number"
                            name="score"
                            class="form-control form-control-lg score-input"
                            max="{{ $data[0]->exam_weight }}"
                            data-max="{{ $data[0]->exam_weight }}"
                            min="0"
                            value="{{ $data[0]->score ?? '' }}"
                            placeholder="กรอกคะแนน">

                        <small class="text-muted mt-2 d-block">
                            คะแนนเต็ม {{ $data[0]->exam_weight }} คะแนน
                        </small>

                        <small class="text-danger error-msg d-block mt-2"></small>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- BUTTON --}}
    <div class="d-flex justify-content-between align-items-center mt-4">

            {{-- ซ้าย --}}
            <button type="button"
                    class="btn btn-secondary"
                    id="prevBtn">

                <i class="fas fa-arrow-left"></i>
                ย้อนกลับ

            </button>

            {{-- ขวา --}}
            <div>

            <button type="button"
                    class="btn btn-primary"
                    id="nextBtn">

                ถัดไป
                <i class="fas fa-arrow-right"></i>

            </button>

            <button type="button"
                    id="saveExamScore"
                    class="btn btn-success px-4">

                <i class="fas fa-paper-plane"></i>
                ส่งคะแนน

            </button>

        </div>

    </div>

</div>


<script>

window.currentIndex = 0;
window.totalQuestion = $('.question-box').length;

// reset ทุกครั้ง
window.currentIndex = 0;

function renderQuestion() {

    $('.question-box').hide();

    $('.question-box').eq(window.currentIndex).show();

    $('#currentQuestion').text(window.currentIndex + 1);

    // prev
    if(window.currentIndex <= 0){

        $('#prevBtn').css('visibility', 'hidden');

    } else {

        $('#prevBtn').css('visibility', 'visible');

    }

    // last page
    if(window.currentIndex >= window.totalQuestion - 1){

        $('#nextBtn').hide();

        $('#scoreSection').show();

        $('#saveExamScore').show();

    } else {

        $('#nextBtn').show();

        $('#scoreSection').hide();

        $('#saveExamScore').hide();

    }

}

// init
renderQuestion();


// ป้องกัน bind ซ้ำ
$(document).off('click', '#nextBtn');

$(document).on('click', '#nextBtn', function () {

    if(window.currentIndex < window.totalQuestion - 1){

        window.currentIndex++;

        renderQuestion();

    }

});


$(document).off('click', '#prevBtn');

$(document).on('click', '#prevBtn', function () {

    if(window.currentIndex > 0){

        window.currentIndex--;

        renderQuestion();

    }

});


// validate score
$(document).off('input', '.score-input');

$(document).on('input', '.score-input', function () {

    let max = Number($(this).data('max'));

    let val = Number($(this).val());

    if (val > max) {

        $(this).val(max);

        $('.error-msg').text('คะแนนห้ามเกิน ' + max);

    } else {

        $('.error-msg').text('');

    }

});

</script>


@endif
