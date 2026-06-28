@extends('layout/mainlayout')
@section('title', 'Course')
@section('content')
<style>
    /* ใช้ CSS Variable เพื่อจัดการสัดส่วนให้ยืดหยุ่น */
    :root {
        --navbar-offset: 100px;
    }

    .lesson-container {
        max-width: 900px;
        margin: 0 auto;
        padding-top: var(--navbar-offset);
        padding-bottom: 3rem;
    }

    /* ใช้ Aspect Ratio แทนการ Fix Height เพื่อรองรับ Responsive */
    .video-wrap {
        background: #000;
        border-radius: 12px;
        overflow: hidden;
        aspect-ratio: 16 / 9; /* มาตรฐานวิดีโอ */
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    #player {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
</style>

<div class="lesson-container px-3">
    <div class="video-wrap mb-4">
        <video id="player" controls playsinline
                data-course-id="{{ $lesson->course->course_id }}"
               data-file-id="{{ $file->id }}"
               data-lesson-id="{{ $lesson->id }}">
            <source src="{{ route('course.videostream', $file->id) }}" type="video/mp4">
        </video>
    </div>

    <div class="text-left">
        <h1 class="h3 font-weight-bold text-dark mb-2">{{ $lesson->title }}</h1>

        {{-- Security: ใช้ระบบ Clean HTML เสมอ ห้ามพ่นสด --}}
        <div class="text-muted mb-4 lead">
            {!! strip_tags(html_entity_decode($lesson->description)) !!}
        </div>

        <div class="border-top pt-4">
            <a href="{{ route('course', ['page' => session('lesson_from_page', 1)]) }}#course-{{ session('lesson_from_course') }}"
                class="btn btn-primary btn-lg px-5 font-weight-bold shadow-sm">
                <i class="fa fa-arrow-left mr-2"></i> กลับหลักสูตร
            </a>
        </div>
    </div>
</div>

<div id="attendance-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 9999; justify-content: center; align-items: center;">
    <div style="background: white; padding: 30px; border-radius: 8px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.2); max-width: 400px; width: 90%;">
        <p style="margin-top: 0; color: #1f2937; font-family: sans-serif;">คุณยังอยู่หน้าจอหรือไม่?</p>
        <button id="btn-confirm-attendance" style="background: #2563eb; color: white; border: none; padding: 12px 30px; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; transition: background 0.2s;">
            ตกลง, ฉันยังอยู่
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const video = document.getElementById('player');
        if (!video) return;

        const lastWatchedTime = parseFloat("{{ $learnFile->last_watched_second ?? 0 }}");
        const hasCompleted = {{ $hasLearnComplete ? 'true' : 'false' }};

        let lastSavedTick = Math.floor({{ $learnFile->last_watched_second ?? 0 }});
        let lastSavedTime = Math.floor(lastWatchedTime);
        let supposedCurrentTime = lastWatchedTime;
        let isInitialized = false;
        let isSync = false;
        let isFirstSave = true;

        if(!hasCompleted) {
            const config = {
                saveInterval: 10, // Seconds
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                    'Accept': 'application/json'
                }
            };

            video.addEventListener('playing', () => {
                if (!isSync) {
                    updateProgress('learning');

                    isSync = true; // Flag ป้องกันการยิงซ้ำ
                }
            }, { once: true });

            // 2. Resume: เลื่อนไปวินาทีล่าสุดที่เคยดู
            video.addEventListener('loadedmetadata', function() {
                if (!isInitialized) {
                    video.currentTime = lastWatchedTime;
                    isInitialized = true;
                }
            });

            const updateProgress = async (status = 'learning') => {
                const currentTime = Math.floor(video.currentTime);
                // ถ้าเวลาไม่เดิน และไม่ใช่การจบวิดีโอ ไม่ต้องส่ง API
                if (!isFirstSave && isSync && currentTime === lastSavedTime && status !== 'pass') return;

                try {
                    const res = await fetch('/api/learn/progress', {
                        method: 'POST',
                        headers: config.headers,
                        body: JSON.stringify({
                            course_id: parseInt(video.dataset.courseId), // Cast ให้ชัวร์ก่อนส่ง
                            lesson_id: parseInt(video.dataset.lessonId),
                            file_id: parseInt(video.dataset.fileId),
                            seconds: currentTime,
                            status: status
                        })
                    });
                    if (res.ok) {
                        lastSavedTime = currentTime;
                        isFirstSave = false;
                    }
                    return res;
                } catch (error) {
                    console.error('Failed to sync progress:', error);
                }
            };
                // ดักจับตอนพยายามกรอ
            video.addEventListener('timeupdate', function() {
                if (!video.seeking) {
                    supposedCurrentTime = video.currentTime;
                }
            });

            video.addEventListener('seeking', function() {
                // ถ้าพยายามกรอไปข้างหน้าเกินจุดที่ดูถึง ให้ดีดกลับ
                const delta = video.currentTime - supposedCurrentTime;
                if (delta > 1.0) {
                    video.currentTime = supposedCurrentTime;
                }
            });
            // Event: บันทึกตามช่วงเวลา
            video.addEventListener('timeupdate', () => {
                const currentTick = Math.floor(video.currentTime);
                // เงื่อนไข: ยิงเมื่อเวลาปัจจุบันลบเวลาที่บันทึกล่าสุด มีค่าเท่ากับหรือมากกว่า Interval
                if (currentTick - lastSavedTick >= config.saveInterval) {

                    // อัปเดต Marker ทันทีเพื่อป้องกัน Race Condition
                    lastSavedTick = currentTick;

                    updateProgress('learning');
                }
            });

            // Event: เมื่อดูจบ (เปลี่ยนสถานะเป็น Pass)
            video.addEventListener('ended', async () => {
                const response = await updateProgress('pass');
                if (response && response.ok) {
                    // 3. แสดง Modal เมื่อ Data ปลอดภัยแล้ว
                    Swal.fire({
                        title: 'ยินดีด้วยคุณเรียนจบแล้ว',
                        text: 'คุณได้เรียนจบเนื้อหาในส่วนนี้เรียบร้อยแล้ว',
                        icon: 'success',
                        confirmButtonText: 'ปิด',
                        confirmButtonColor: '#3085d6',
                        backdrop: false,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#btn-complete').show();
                        }
                    });
                } else {
                    // [Defensive] กรณี DB ไม่บันทึก ห้ามโชว์ Modal สำเร็จเด็ดขาด!
                    Swal.fire('เกิดข้อผิดพลาด', 'ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบการเชื่อมต่อ', 'error');
                }
            });
        }else{
            $('#btn-complete').show();
        }

    });

    document.addEventListener('DOMContentLoaded', function () {
        // 🛡️ No Magic Numbers: ย้ายเกณฑ์เงื่อนไขเวลาไปไว้ที่ Configuration Constant เพื่อความยืดหยุ่น
        const TRIGGER_TIME_SECONDS = 5.0;

        const modal = document.getElementById('attendance-modal');
        const confirmBtn = document.getElementById('btn-confirm-attendance');
        const videoElement = document.querySelector('video');

        // 🛡️ Defensive Programming: ป้องกัน Null Pointer เผื่อหน้าจอเดโมนั้นไม่มี Element วิดีโออยู่จริง
        if (!videoElement) {
            console.warn('[Architecture Warning] Video element not found on this page.');
            return;
        }

        // State Tracking Flag: ป้องกันไม่ให้ป๊อปอัปเด้งซ้ำซ้อนหลังจากกดตกลงไปแล้ว
        let hasTriggered = false;

        // 🏎️ Performance Optimization: ใช้ 'timeupdate' event ทราฟฟิกฝั่ง Client ทำงานแบบสตรีมความเร็ว $O(1)$
        videoElement.addEventListener('timeupdate', function () {
            if (!hasTriggered && videoElement.currentTime >= TRIGGER_TIME_SECONDS) {
                triggerAttendanceCheck();
            }
        });

        function triggerAttendanceCheck() {
            hasTriggered = true; // ล็อก State ทันทีป้องกัน Race Condition หน้าบ้าน

            // ⚡ UI Interaction: แสดง Modal แพลตฟอร์ม
            modal.style.display = 'flex';

            // ⏸️ Pause Video Stream: บังคับหยุดสื่อเพื่อรอ Action จากผู้เรียน
            videoElement.pause();
        }

        // Event Handling: จังหวะเคลียร์ State เมื่อกดยืนยัน
        confirmBtn.addEventListener('click', function () {
            modal.style.display = 'none';

            // ▶️ Resume Video Stream
            videoElement.play();
        });
    });
</script>
@endsection
