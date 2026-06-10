@extends('layout/mainlayout')
@section('title', 'Course Essay Exam')
@section('content')
<style>
    html, body {
        height: auto !important;
        min-height: 100vh !important;
        background: #fff !important;
    }
</style>
{{-- 1. คุมทั้งหน้าด้วย Flex เพื่อดัน Footer ลงล่าง --}}
<div class="d-flex flex-column" style="min-height: 100vh;">

    {{-- 2. เพิ่ม Padding-top กันโดน Head กิน --}}
    <div class="container flex-grow-1" style="max-width: 900px; padding-top: 110px; padding-bottom: 50px;">

        <div class="text-center mb-4">
            <h2 id="timer-display">--:--</h2>
        </div>

        <form action="{{ route('course.exam.submit-essay', $course->course_id) }}" method="POST" id="exam-form">
            @csrf
            <input type="hidden" name="exam_session_id" value="{{ $course->exam_session->id }}">
            <input type="hidden" name="is_timeout" id="is_timeout" value="0">

            @foreach($course->groupTesting->questions as $index => $question)
                <div id="question-card-{{ $index }}"
                    style="display: {{ $index === 0 ? 'block' : 'none' }};
                            background: #fff;
                            border-radius: 12px;
                            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                            margin-bottom: 20px;">

                    {{-- Header --}}
                    <div style="background: #1F7BCC; color: white; padding: 15px 20px; border-radius: 12px 12px 0 0; display: flex; justify-content: space-between; align-items: center;">
                        <h5 style="margin: 0; font-weight: bold;">คำถามข้อที่ {{ $index + 1 }}</h5>
                        <span style="background: white; color: #1F7BCC; padding: 4px 12px; border-radius: 20px; font-weight: bold;">
                            {{ $index + 1 }} / {{ $course->groupTesting->questions->count() }}
                        </span>
                    </div>

                    {{-- Body --}}
                    <div style="padding: 30px;">

                        {{-- รูปภาพ --}}
                        <div style="height: 300px; border: 2px dashed #dee2e6; border-radius: 8px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; overflow: hidden; margin-bottom: 20px;">
                            @if($question->images && $question->images->isNotEmpty())
                                @foreach($question->images as $img)
                                    <img src="{{ asset('storage/' . $img->path) }}"
                                        style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                @endforeach
                            @else
                                <div style="text-align: center; color: #adb5bd;">
                                    <i class="far fa-image fa-2x"></i>
                                    <p style="margin: 5px 0 0 0; font-size: 14px;">ไม่มีรูปภาพประกอบ</p>
                                </div>
                            @endif
                        </div>

                        {{-- คำถาม --}}
                        <h5 style="font-weight: bold; color: #334155; line-height: 1.6; margin-bottom: 20px;">
                            {!! strip_tags(html_entity_decode($question->ques_title)) !!}
                        </h5>

                        {{-- textarea --}}
                        <label style="font-weight: bold; color: #1F7BCC; margin-bottom: 8px; display: block;">
                            <i class="fas fa-pen-alt" style="margin-right: 6px;"></i>พิมพ์คำตอบของคุณ:
                        </label>
                        <textarea name="answers[{{ $question->ques_id }}]"
                                class="form-control essay-input"
                                rows="7"
                                style="border-radius: 8px; border: 2px solid #ced4da; font-size: 24px; padding: 12px; width: 100%; resize: none;"
                                placeholder="อธิบายคำตอบที่นี่..." required></textarea>
                    </div>

                    {{-- ปุ่ม --}}
                    <div style="padding: 15px 30px; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between;">
                        <button type="button" class="btn btn-outline-secondary btn-prev"
                                data-index="{{ $index }}"
                                style="font-weight: bold; padding: 10px 25px; border-radius: 8px;"
                                {{ $index === 0 ? 'disabled' : '' }}>
                            ย้อนกลับ
                        </button>

                        @if($index === $course->groupTesting->questions->count() - 1)
                            <button type="submit" class="btn btn-success" id="submit-btn"
                                    style="font-weight: bold; padding: 10px 35px; border-radius: 8px;">
                                ส่งข้อสอบ
                            </button>
                        @else
                            <button type="button" class="btn btn-primary btn-next"
                                    data-index="{{ $index }}"
                                    style="font-weight: bold; padding: 10px 35px; border-radius: 8px; background: #1F7BCC;">
                                ข้อถัดไป
                            </button>
                        @endif
                    </div>

                </div>
                @endforeach
        </form>
    </div>
</div>

<script>
    // Logic การสลับข้อเดิมของน้องชายยังใช้ได้เป๊ะครับ พี่แค่คุม Layout ให้เฉยๆ
    document.addEventListener('DOMContentLoaded', function() {
        const nextBtns = document.querySelectorAll('.btn-next');
        const prevBtns = document.querySelectorAll('.btn-prev');

        nextBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const idx = parseInt(this.getAttribute('data-index'));
                const txt = document.querySelector(`#question-card-${idx} textarea`);
                if(!txt.value.trim()) { alert('กรอกคำตอบก่อน'); return; }
                navigate(idx, idx + 1);
            });
        });

        prevBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const idx = parseInt(this.getAttribute('data-index'));
                navigate(idx, idx - 1);
            });
        });

        function navigate(f, t) {
            document.getElementById(`question-card-${f}`).style.display = 'none';
            document.getElementById(`question-card-${t}`).style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // 1. รับค่าวินาทีที่เหลือมาจาก Service (ผ่าน $course)
        let timeLeft = parseInt("{{ $course->remaining_seconds }}");
        // 2. ฟังก์ชันอัปเดตหน้าจอ
        function updateDisplay(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = seconds % 60;
            document.getElementById('timer-display').innerText =
                `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        }
        function onTimeout() {
            // 1. เปลี่ยนค่า Flag เพื่อให้หลังบ้านรู้ว่าหมดเวลา
            document.getElementById('is_timeout').value = "1";

            // 2. ปิดตัวแจ้งเตือน Browser (ถ้ามีพวก confirm ก่อนปิดหน้าเว็บ)
            window.onbeforeunload = null;

            // 3. ยิงฟอร์มทันที
            document.getElementById('exam-form').submit();
        }
        updateDisplay(timeLeft);
        // 3. เริ่มนับถอยหลัง
        const timer = setInterval(function() {
            timeLeft--;
            updateDisplay(timeLeft);

            if (timeLeft <= 0) {
                clearInterval(timer);
                onTimeout(); // ฟังก์ชันดีดออกที่น้องเขียนไว้
            }
        }, 1000);
    });


    document.getElementById('exam-form').addEventListener('submit', function(e) {
        const btn = document.getElementById('submit-btn');

        // 1. เช็คว่าปุ่มมีอยู่จริงไหม (กัน Error)
        if (btn) {
            // 2. สั่งปิดปุ่มทันที กันกดซ้ำ
            btn.disabled = true;

            // 3. เปลี่ยนข้อความให้ User สบายใจว่าระบบกำลังทำงาน
            btn.innerHTML = 'กำลังส่งข้อสอบ...';
        }

        // ปล่อยให้ Form ทำงานต่อไปตามปกติ
    });
</script>

@endsection
