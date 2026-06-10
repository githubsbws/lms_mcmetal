@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<body class="">
	<div id="wrapper">
		<div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">ระบบชุดข้อสอบบทเรียนออนไลน์</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{ route('grouptesting') }}">
                                <button class="btn btn-warning d-flex align-items-center">
                                    <i class="fas fa-angle-left mr-2"></i>
                                    กลับหน้าหลัก
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
			<div class="container mt-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        เพิ่มคำถาม
                    </div>
                    <div class="card-body">
                             <form method="POST" action="{{ route('questions.update', ['id'=>$question->ques_id]) }}">
                                @csrf
                                <input type="hidden" name="ques_type" value="{{ $question->ques_type }}">
                                <!-- ประเภท -->
                                <div class="mb-3">
                                    <label>ประเภทคำถาม</label>
                                    <select  id="ques_type" class="form-control" disabled>
                                        {{-- <option value="1" {{ $question->ques_type == 1 ? 'selected' : '' }}>หลายคำตอบ</option> --}}
                                        <option value="2" {{ $question->ques_type == 2 ? 'selected' : '' }}>คำตอบเดียว</option>
                                        <option value="3" {{ $question->ques_type == 3 ? 'selected' : '' }}>อธิบาย</option>
                                    </select>
                                </div>

                                <!-- คำถาม -->
                                <div class="mb-3">
                                    <label>คำถาม</label>
                                    <textarea name="ques_title" id="summernote" class="form-control">{!! htmlspecialchars_decode($question->ques_title) !!}</textarea>
                                </div>
                                <!-- Text -->
                                <div class="mb-3" id="answer-wrapper" style="display:none;">
                                    <label>คำตอบ</label>
                                    <textarea name="answer" id="summernote2" class="form-control" rows="5">{!! htmlspecialchars_decode($question->answer) !!}</textarea>
                                </div>
                                <!-- Choices -->
                                <div id="choice-wrapper">
                                    <label>ตัวเลือก</label>

                                    @foreach($choices as $i => $choice)
                                    <div class="choice-item mb-2">
                                        <input type="text"
                                            name="choices[{{ $i }}][choice_detail]"
                                            value="{{ $choice->choice_detail }}"
                                            class="form-control mb-1">

                                        <label>
                                            <input type="checkbox"
                                                name="choices[{{ $i }}][is_answer]"
                                                {{ $choice->choice_answer == '1' ? 'checked' : '' }}>
                                            คำตอบถูก
                                        </label>

                                        <button type="button" class="btn btn-danger btn-sm remove-choice">ลบ</button>
                                    </div>
                                    @endforeach
                                </div>

                                <button type="button" id="add-choice" class="btn btn-primary mb-3">
                                    + เพิ่มตัวเลือก
                                </button>

                                <br>
                                <button type="submit" class="btn btn-success">บันทึก</button>
                            </form>
                    </div>
                </div>
            </div>
			<div id="sidebar">
			</div><!-- sidebar -->
		</div>
	</div>
	<div class="clearfix"></div>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
    $(document).ready(function() {
        $('#summernote2').summernote();
    });
let index = Date.now();

document.getElementById('add-choice').addEventListener('click', function() {
    let html = `
    <div class="choice-item mb-2">
        <input type="text" name="choices[${index}][choice_detail]" class="form-control mb-1" placeholder="ตัวเลือก">

        <label>
            <input type="checkbox" name="choices[${index}][is_answer]">
            คำตอบถูก
        </label>

        <button type="button" class="btn btn-danger btn-sm remove-choice">ลบ</button>
    </div>
    `;

    document.getElementById('choice-wrapper').insertAdjacentHTML('beforeend', html);
    index++;
});

// ลบ choice
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-choice')) {
        e.target.closest('.choice-item').remove();
    }
});

//โชว์คำตอบของคำถามอธิบาย
document.addEventListener('DOMContentLoaded', function() {

    let type = document.getElementById('ques_type').value;

    let wrapper = document.getElementById('choice-wrapper');
    let btn = document.getElementById('add-choice');
    let answerWrapper = document.getElementById('answer-wrapper');

    if (type == '3') {

        // ซ่อน choice
        wrapper.style.display = 'none';
        btn.style.display = 'none';

        // แสดง answer
        answerWrapper.style.display = 'block';

    } else {

        // แสดง choice
        wrapper.style.display = 'block';
        btn.style.display = 'inline-block';

        // ซ่อน answer
        answerWrapper.style.display = 'none';
    }
});

// คำตอบเดียว
document.addEventListener('change', function(e) {
    if (e.target.name.includes('[is_answer]')) {
        let type = document.getElementById('ques_type').value;

        if (type == '2') {
            document.querySelectorAll('#choice-wrapper input[type=checkbox]')
                .forEach(cb => cb.checked = false);

            e.target.checked = true;
        }
    }
});

// load ครั้งแรก
document.addEventListener('DOMContentLoaded', function() {
    let type = document.getElementById('ques_type').value;

    if (type == '3') {
        document.getElementById('choice-wrapper').style.display = 'none';
        document.getElementById('add-choice').style.display = 'none';
    }
});

// validate
document.querySelector('form').addEventListener('submit', function(e) {
    let type = document.getElementById('ques_type').value;

    if (type != '3') {
        let choices = document.querySelectorAll('#choice-wrapper input[type=text]');
        let hasValue = false;

        choices.forEach(c => {
            if (c.value.trim() !== '') hasValue = true;
        });

        if (!hasValue) {
            alert('กรุณากรอกตัวเลือกอย่างน้อย 1 ข้อ');
            e.preventDefault();
        }
    }
});
@if(session('success'))
            Swal.fire({
                title: "{{ session('alert') }}",
                text:"บันทึกข้อมูลสำเร็จ",
                icon: "success",
                confirmButtonText: 'ตกลง' // เพิ่มปุ่มยืนยัน
            });
        @endif
</script>
</body>
@endsection