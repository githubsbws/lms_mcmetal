@extends('layout/mainlayout')
@section('title', 'Course')
@section('content')
@php
    $questions = $course->groupTesting->questions->shuffle();
@endphp
<div class="d-flex flex-column" style="min-height: 100vh;">
    <div class="container" style="max-width: 900px; padding-top: 110px; padding-bottom: 50px;">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #e2e8f0;">
            <div class="row timer-container">
                <small style="color: #64748b; font-size: 24px;">แบบทดสอบ Final Exam (ปรนัย)</small>
            </div>
            <div>
                <h2 id="timer-display">--:--</h2>
            </div>
            <div style="font-size: 20px; font-weight: bold; color: #1F7BCC;">
                ข้อที่ <span id="current-index-text">1</span> / {{ $questions->count() }}
            </div>
        </div>

        <form action="{{ route('course.exam.submit-multiple', $course->course_id) }}" method="POST" id="exam-form">
            @csrf
            <input type="hidden" name="exam_session_id" value="{{ $course->exam_session->id }}">
            <input type="hidden" name="is_timeout" id="is_timeout" value="0">

            @foreach($questions as $index => $question)
            <div id="question-card-{{ $index }}"
                style="display: {{ $index === 0 ? 'block' : 'none' }};
                        background: #fff;
                        border-radius: 12px;
                        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                        margin-bottom: 20px;
                        overflow: hidden;">

                {{-- Header คำถาม --}}
                <div style="background: #1F7BCC;color: white; padding: 25px 30px; border-bottom: 1px solid;">
                    <h4 style="font-size: 24px; font-weight: 600; color: white; margin: 0; line-height: 1.5;">
                        {{ $index + 1 }}. {!! strip_tags(html_entity_decode($question->ques_title), '<b><strong><i><em><u>') !!}
                    </h4>
                </div>

                {{-- ตัวเลือก --}}
                <div style="padding: 30px;">
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        @foreach($question->choices->shuffle() as $choice)
                            <label class="choice-container"
                                style="display: flex; align-items: center;
                                        background-color: #f1f5f9;
                                        border: 2px solid #e2e8f0;
                                        padding: 16px 20px;
                                        border-radius: 10px;
                                        cursor: pointer;
                                        margin: 0;">
                                <input type="radio"
                                    name="answers[{{ $question->ques_id }}]"
                                    value="{{ $choice->choice_id }}"
                                    class="choice-radio"
                                    data-question-index="{{ $index }}"
                                    style="width: 20px; height: 20px; margin-right: 15px; accent-color: #1F7BCC;"
                                    required>
                                <span style="font-size: 17px; color: #334155; font-weight: 500;">
                                    {{ $choice->choice_detail }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- ปุ่ม --}}
                <div style="padding: 15px 30px; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between;">
                    <button type="button" class="btn btn-secondary btn-prev"
                            data-index="{{ $index }}"
                            style="font-weight: bold; padding: 8px 25px; border-radius: 8px;"
                            {{ $index === 0 ? 'disabled' : '' }}>
                        ข้อก่อนหน้า
                    </button>

                    @if($index === $questions->count() - 1)
                        <button type="submit" class="btn btn-success" id="submit-btn"
                                style="font-weight: bold; padding: 8px 35px; border-radius: 8px;">
                            ส่งคำตอบทั้งหมด
                        </button>
                    @else
                        <button type="button" class="btn btn-primary btn-next"
                                data-index="{{ $index }}"
                                style="font-weight: bold; padding: 8px 25px; border-radius: 8px; background-color: #1F7BCC;">
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
    document.addEventListener('DOMContentLoaded', function() {
        const totalQuestions = {{ $questions->count() }};
        const radios = document.querySelectorAll('.choice-radio');
        const nextButtons = document.querySelectorAll('.btn-next');
        const prevButtons = document.querySelectorAll('.btn-prev');

        //////
        // 1. ไฮไลท์สีช้อยส์ที่เลือก + สั่งเลื่อนข้อถัดไปอัตโนมัติด้วยดีเลย์นิดๆ เพื่อให้เห็นเอฟเฟกต์การเลือก
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                const currentIdx = parseInt(this.getAttribute('data-question-index'));

                // ลบ class selected ออกจากกลุ่มช้อยส์ในข้อเดียวกันก่อน
                const parentCard = document.getElementById(`question-card-${currentIdx}`);
                parentCard.querySelectorAll('.choice-container').forEach(el => el.classList.remove('selected'));

                // เพิ่มสีให้ข้อที่เลือก
                this.parentElement.classList.add('selected');

            });
        });

        // 2. ควบคุมปุ่มกดด้วยมือ (Next / Prev)
        nextButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const currentIdx = parseInt(this.getAttribute('data-index'));
                navigateToQuestion(currentIdx, currentIdx + 1);
            });
        });

        prevButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const currentIdx = parseInt(this.getAttribute('data-index'));
                navigateToQuestion(currentIdx, currentIdx - 1);
            });
        });

        // ฟังก์ชันสลับการ์ดข้อสอบ
        function navigateToQuestion(fromIdx, toIdx) {
            document.getElementById(`question-card-${fromIdx}`).style.display = 'none';
            document.getElementById(`question-card-${toIdx}`).style.display = 'block';

            // อัปเดตตัวเลขข้อสอบด้านบน
            document.getElementById('current-index-text').innerText = toIdx + 1;
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

        // เรียกครั้งแรกเพื่อให้เวลาโชว์ทันทีไม่ต้องรอ 1 วิ


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
