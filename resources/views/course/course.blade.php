@extends('layout/mainlayout')
@section('title', 'Course')
@section('content')
    <style>
        .img-admin-course img {
            width: 80px !important;
            height: 80px !important;
        }

        .swal2-popup {
            font-size: 1.2rem !important;
            font-family: Georgia, serif;
        }

        .title-page {}

        .fa-certificate {
            font-size: 26px;
        }
    </style>
    <script>
        // ตรวจสอบ Session Flash และแสดง SweetAlert2
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: "{{ session('success') }}",
                confirmButtonText: 'ตกลง',
                backdrop: false
            });
        @endif
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: '{{ session('
                        error ') }}',
                confirmButtonText: 'ตกลง',
                backdrop: false
            });
        @endif
    </script>

    <body>
        <div id="content" c>
            <div class=" overflow-hidden page-section bg-blue-300 title-page" style="background-color: cornflowerblue">
                <div class="container-fluid parallax-layer" data-opacity="true">
                    <div class="media media-grid v-middle">
                        <div class="media-body">
                            <h3 class="text-display-2 text-white margin-none">
                                {{ auth()->user()->team_id == 6 ? 'Roadmap สำหรับ พนักงานใหม่' : 'Roadmap สำหรับ พนักงานทั่วไป' }}
                            </h3>

                        </div>
                    </div>
                </div>
            </div><br>
            <div class="container-fluid" style="min-height: 60vh; margin-bottom: auto;">
                <div class="course-content">
                    {{-- ใส่ ID คลุมไว้เพื่อเขียน CSS ดักเฉพาะจุด --}}
                    <div class="row" id="custom-roadmap-area">

                        {{-- ฝั่งซ้าย: Roadmap --}}
                        {{-- ใช้ col-lg-5 ตามเดิม แต่เช็คว่าคลาส .roadmap ใน CSS ของน้องไม่ไปสั่งกว้าง 100% ทับ --}}
                        <div class="col-lg-5 roadmap">
                            <div class="title" style="margin-bottom: 20px;">
                                <span class="title1" style="font-size: 2rem; font-weight: bold; text-transform: uppercase;">
                                    road<span class="title2" style="color: #ff9800;">map</span>
                                </span>
                            </div>

                            <div class="d-flex align-items-start">
                                {{-- เปลี่ยนจาก nav-pills เป็น nav-tabs หรือคลาสที่ Theme รองรับ --}}
                                <div class="nav flex-column me-3" id="v-pills-tab" role="tablist">
                                    @if ($course_detail->count() > 0)
                                        @foreach ($course_detail as $key => $item)
                                            @php
                                                $isLocked = $item->is_locked ?? false;
                                                $allowedStatuses = ['pass', 'wait'];
                                                $isPassed = $item->passcourse
                                                    ->whereIn('passcours_status', $allowedStatuses)
                                                    ->isNotEmpty();

                                                $isLearning = !$isLocked && !$isPassed;

                                                if ($isLocked) {
                                                    $btnClass = 'btn-danger';
                                                    $label = 'ล็อค';
                                                    $icon = 'fa fa-lock';
                                                } elseif ($isPassed) {
                                                    $btnClass = 'btn-success';
                                                    $label = 'ผ่านแล้ว';
                                                    $icon = 'fa fa-check-circle';
                                                } else {
                                                    $btnClass = 'btn-warning';
                                                    $label = 'กำลังเรียน';
                                                    $icon = 'fa fa-play-circle';
                                                }
                                            @endphp

                                            <div class="road-item" style="margin-bottom: 15px;"
                                                id="course-{{ $item->course_id }}">
                                                <button class="nav-link btn {{ $btnClass }}"
                                                    id="v-pills-tab-{{ $item->course_id }}" data-toggle="tab"
                                                    href="#v-pills-content-{{ $item->course_id }}"
                                                    @if ($isLocked) disabled @endif
                                                    style="display: flex; align-items: center; text-align: left;
                                                        width: 100%; padding: 20px; border-radius: 15px;
                                                        {{ $isLocked ? 'pointer-events: none; opacity: 0.6;' : '' }}">

                                                    <div class="wrap" style="flex-grow: 1;">
                                                        <div class="couurse-name-rd">
                                                            @php
                                                                $milestoneLabel = [
                                                                    30 => 'เดือนที่ 1',
                                                                    60 => 'เดือนที่ 2',
                                                                    90 => 'เดือนที่ 3',
                                                                    119 => 'เดือนที่ 4',
                                                                    999 => 'หลัง 4 เดือน',
                                                                ];
                                                            @endphp
                                                            <strong style="display: block; font-size: 24px;">
                                                                {{ ($milestoneLabel[$item->milestone_days]?? null) ? $milestoneLabel[$item->milestone_days] . ' :' : '' }}
                                                                {{ $item->course_title }}
                                                            </strong>

                                                            <small>
                                                                {!! strip_tags(html_entity_decode($item->course_short_title), '<b><strong><i><em><u>') !!}
                                                            </small>
                                                            <br>
                                                            <small>
                                                                {{ !($milestoneLabel[$item->milestone_days] ?? null) ? 'วันปิดหลักสูตร: ' . date('d/m/Y', strtotime($item->end_date)) : '' }}
                                                            </small>
                                                        </div>
                                                    </div>

                                                    <div style="margin-left: 10px;">
                                                        <i class="{{ $icon }} fa-lg"></i>
                                                    </div>

                                                </button>
                                            </div>
                                        @endforeach
                                        @if (method_exists($course_detail, 'links'))
                                            {{ $course_detail->links('pagination::bootstrap-4') }}
                                        @endif
                                    @else
                                        <div>
                                            <p>ยังไม่มีหลักสูตรการเรียนการสอน</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- ฝั่งขวา: Content (Learning Mode) --}}
                        <div class="col-lg-7 col-md-7">
                            <div class="tab-content">
                                @foreach ($course_detail as $key => $item)
                                    @php
                                        // เช็คอีกรอบเพื่อความชัวร์ หรือจะดึงจากข้างบนมาก็ได้
                                        $isLockedInContent = $item->is_locked ?? false;
                                    @endphp
                                    <div class="tab-pane fade in {{ $loop->first && !$isLockedInContent ? 'active' : '' }}"
                                        id="v-pills-content-{{ $item->course_id }}"
                                        style="border-radius: 12px;background: transparent">

                                        {{-- Card หลักตามดีไซน์ในรูป --}}
                                        <div class="panel panel-default paper-shadow mb-3" data-z="0.5"
                                            style="border-radius: 12px">
                                            <div class="panel-body p-5">

                                                {{-- ส่วนรูปภาพ (Thumbnail/Video Placeholder) --}}
                                                <div class="image-container" style="border-radius: 12px; overflow: hidden;">
                                                    <img src="{{ asset('images/uploads/courseonline/' . $item->course_id . '/original/' . $item->course_picture) }}"
                                                        class="img-responsive" style="width: 100%;" loading="lazy">
                                                </div>

                                                {{-- ส่วนข้อมูลเนื้อหา --}}
                                                <div style="padding: 20px;">
                                                    <h3 class="text-display-1">
                                                        {{ $item->course_title }}
                                                    </h3>

                                                    {{-- Progress Bar (100% สำเร็จ ตามรูป) --}}
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-primary" role="progressbar"
                                                            style="width: {{ $item->progress }}%; border-radius: 12px"
                                                            aria-valuenow="{{ $item->progress }}" aria-valuemin="0"
                                                            aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <h5 class="card-title">{{ $item->progress }}%</h5>
                                                    {{-- progressbar --}}

                                                    <hr style="margin: 15px 0;">

                                                    {{-- รายละเอียดวิทยากรและวันที่ --}}
                                                    <div class="course-meta" style="font-size: 20px; color: #666;">
                                                        <p><i class="fa fa-user fa-fw"></i> <strong>ผู้สอน :</strong>
                                                            {{ $item->teacher ? $item->teacher->teacher_name : '-' }}
                                                        </p>
                                                    </div>

                                                    {{-- ส่วนคำอธิบายแบบย่อ (Short Title) --}}
                                                    ลายละเอียดหลักสูตร
                                                    <div class="margin-t-15"
                                                        style="background: #f9f9f9; padding: 15px; border-radius: 5px;">
                                                        {!! strip_tags(html_entity_decode($item->course_short_title)) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="panel panel-default paper-shadow mb-5" data-z="0.5" style="border-radius: 12px">
                                            <div class="panel-body p-5">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <h5 class="mb-0">จำนวนบทเรียน</h5>
                                                        <div class="col-6 m-5">
                                                            <i class="fa fa-book fa-5x" style="color: #428bca;"></i>
                                                            <p class="mx-0">{{ $item->lesson()->count() }} บทเรียน</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <h5 class="mb-0">สถานะการประเมิน</h5>
                                                        <div class="col-6 m-5">
                                                            <i class="fa fa-certificate fa-5x m-3" style="color: #428bca;"></i>
                                                            @if ($isLearning)
                                                            <p class="mx-0">กรุณาเรียนให้จบก่อน</p>
                                                            @elseif(!$isLearning && !$isPassed)
                                                            <p class="mx-0">รอคะแนนในส่วนอื่นๆจากแอดมิน</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="panel-head">
                                            <h3>รายการบทเรียน</h3>
                                        </div>
                                        <div class="panel panel-default paper-shadow mb-5" data-z="0.5"
                                            style="border-radius: 12px; background-color: #dbeafe !important; overflow: hidden; border: none;">

                                            <div class="panel-body" style="padding: 20px;">
                                                <div class="row">
                                                    <div class="col-12">
                                                        @foreach ($item->lesson as $index => $lessons)
                                                            {{-- แถบหัวข้อบทเรียน --}}
                                                            <div
                                                                style="background-color: #1F7BCC; color: white; padding: 15px 15px; border-radius: 8px; margin-bottom: 10px; display: flex; gap: 20px; align-items: center;">
                                                                <span style="font-size:28px">บทที่ {{ $index + 1 }}
                                                                    {{ $lessons->title }}</span>
                                                                @php
                                                                    // ดึงสถานะ
                                                                    $status =
                                                                        $lessons->learn->first()->lesson_status ??
                                                                        'notLearning';

                                                                    // กำหนดสีและข้อความของ Badge
                                                                    $badgeStyle =
                                                                        'padding: 4px 12px; border-radius: 50px; font-size: 18px; font-weight: bold; color: white;';

                                                                    if ($status === 'pass') {
                                                                        $bg = 'background-color: #28a745;'; // เขียว
                                                                        $label = 'Pass';
                                                                    } elseif ($status === 'learning') {
                                                                        $bg =
                                                                            'background-color: #ffc107; color: #212529;'; // เหลือง (ตัวหนังสือดำเพื่อให้อ่านง่าย)
                                                                        $label = 'Learning';
                                                                    } else {
                                                                        $bg = 'background-color: #dc3545;'; // แดง
                                                                        $label = 'Not-Learning';
                                                                    }
                                                                @endphp
                                                                <span style="{{ $badgeStyle }} {{ $bg }}">
                                                                    {{ $label }}
                                                                </span>
                                                            </div>

                                                            {{-- รายการย่อย (ทำเป็นโครงไว้ก่อน) --}}
                                                            <div style="padding: 5px 15px 20px 15px;">
                                                                @if ($lessons->file->count() > 0)
                                                                    @foreach ($lessons->file as $vdo)
                                                                        {{-- ย้าย d-flex และ justify-between มาไว้ที่นี่ เพื่อคุม "ชื่อ" กับ "ปุ่ม" ในแต่ละแถว --}}
                                                                        <div
                                                                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; width: 100%;">

                                                                            {{-- ฝั่งซ้าย: ไอคอน + ชื่อวิดีโอ --}}
                                                                            <div
                                                                                style="display: flex; align-items: center; gap: 20px;">
                                                                                <i class="fa fa-play-circle text-primary"
                                                                                    style="font-size: 1.2rem;padding-right:10px"></i>
                                                                                <span style="font-size:24px ">วิดีโอ:
                                                                                    {{ $vdo->file_name ?? 'วิดีโอไม่มีชื่อ' }}</span>
                                                                                @php
                                                                                    // ดึงสถานะ
                                                                                    $status =
                                                                                        $vdo->learnFile->first()
                                                                                            ->learn_file_status ??
                                                                                        'notLearning';

                                                                                    // กำหนดสีและข้อความของ Badge
                                                                                    $badgeStyle =
                                                                                        'padding: 4px 12px; border-radius: 50px; font-size: 18px; font-weight: bold; color: white;';

                                                                                    if ($status === 'pass') {
                                                                                        $bg =
                                                                                            'background-color: #28a745;'; // เขียว
                                                                                        $label = 'Pass';
                                                                                    } elseif ($status === 'learning') {
                                                                                        $bg =
                                                                                            'background-color: #ffc107; color: #212529;'; // เหลือง (ตัวหนังสือดำเพื่อให้อ่านง่าย)
                                                                                        $label = 'Learning';
                                                                                    } else {
                                                                                        $bg =
                                                                                            'background-color: #dc3545;'; // แดง
                                                                                        $label = 'Not-Learning';
                                                                                    }
                                                                                @endphp
                                                                                <span
                                                                                    style="{{ $badgeStyle }} {{ $bg }}">
                                                                                    {{ $label }}
                                                                                </span>
                                                                            </div>

                                                                            {{-- ฝั่งขวา: เวลา (ถ้ามี) + ปุ่ม --}}
                                                                            <div
                                                                                style="display: flex; align-items: center;">
                                                                                {{-- ถ้าใน DB มีเก็บเวลา (Duration) ก็เอามาโชว์ตรงนี้ได้ครับ --}}
                                                                                {{-- <span class="text-muted me-3">
                                                                                <i class="fa fa-clock-o"></i> 30 นาที
                                                                            </span> --}}
                                                                                <a
                                                                                    href="{{ route('course.lessonLearn', [$lessons->id, $vdo->id, 'course_id' => $item->course_id, 'from_page' => request()->query('page', 1)]) }}"><button
                                                                                        class="btn btn-primary"
                                                                                        style="border-radius: 6px;font-size:24px; padding: 5px 40px;">ดูวิดีโอ</button></a>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                                @if ($lessons->filedoc->count() > 0)
                                                                    @foreach ($lessons->filedoc as $doc)
                                                                        <div class="lesson-item d-flex justify-content-between align-items-center mb-2"
                                                                            style="padding: 10px; background: rgba(255,255,255,0.3); border-radius: 8px;">
                                                                            <span>
                                                                                <i
                                                                                    class="fa fa-file-pdf-o text-danger me-2"></i>
                                                                                {{ $doc->file_name_display ?? 'เอกสารประกอบ' }}
                                                                            </span>
                                                                            <a href="{{ route('course.viewfile', [
                                                                                'file_doc_id' => $doc->id,
                                                                                'lesson_id' => $lessons->id,
                                                                                'course_id' => $lessons->course_id,
                                                                            ]) }}"
                                                                                class="btn btn-secondary btn-sm btn-view-doc"
                                                                                data-course-id="course-{{ $lessons->course_id }}"
                                                                                data-doc-id="{{ $doc->id }}"
                                                                                data-lesson-id="{{ $lessons->id }}">
                                                                                <i class="fa fa-eye"></i> ดูเอกสาร
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                            @if ($loop->last)
                                                                @if ($item->has_questions)
                                                                    {{-- Container หลัก --}}
                                                                    <div
                                                                        style="margin-top: 30px; margin-bottom: 20px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">

                                                                        {{-- ส่วนหัว (Header) - สีน้ำเงิน ตัวอักษรขาว --}}
                                                                        <div
                                                                            style="background-color: #1F7BCC; color: white; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center;">
                                                                            <div>
                                                                                <h3
                                                                                    style="font-size: 26px; font-weight: bold; margin: 0; color: white !important; line-height: 1;">
                                                                                    แบบทดสอบ Final Exam
                                                                                </h3>
                                                                                <p
                                                                                    style="margin: 8px 0 0 0; font-size: 14px; color: rgba(255,255,255,0.9);">
                                                                                    สิทธิ์การสอบทั้งหมด:
                                                                                    {{ $item->exam_attempts }}/{{ $item->exam_max_attempts }}
                                                                                    ครั้ง
                                                                                </p>
                                                                            </div>

                                                                            {{-- ปุ่มสถานะ/เข้าสอบ (วางตำแหน่งเดียวกับปุ่มบทเรียน) --}}
                                                                            <div>
                                                                                @if ($item->exam_has_passed)
                                                                                    <button class="btn btn-success"
                                                                                        style="font-size: 18px; font-weight: bold; border-radius: 8px; padding: 8px 30px; background-color: #28a745 !important; border: none; color: white !important; cursor: default;"
                                                                                        disabled>
                                                                                        สอบผ่านแล้ว
                                                                                    </button>
                                                                                @elseif($item->can_exam && !$item->score_has_wait)
                                                                                    @php
                                                                                        $examRoute =
                                                                                            $item->exam_type == 2
                                                                                                ? route(
                                                                                                    'course.exam.multiple',
                                                                                                    [
                                                                                                        $item->course_id,
                                                                                                        'from_page' => request()->query(
                                                                                                            'page',
                                                                                                            1,
                                                                                                        ),
                                                                                                    ],
                                                                                                )
                                                                                                : route(
                                                                                                    'course.exam.essay',
                                                                                                    [
                                                                                                        $item->course_id,
                                                                                                        'from_page' => request()->query(
                                                                                                            'page',
                                                                                                            1,
                                                                                                        ),
                                                                                                    ],
                                                                                                );
                                                                                        $btnClass =
                                                                                            $item->exam_attempts > 0
                                                                                                ? 'btn-warning'
                                                                                                : 'btn-info';
                                                                                    @endphp
                                                                                    <a href="{{ $examRoute }}"
                                                                                        class="btn {{ $btnClass }}"
                                                                                        style="font-size: 18px; font-weight: bold; border-radius: 8px; padding: 8px 35px; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                                                                                        {{ $item->exam_attempts > 0 ? 'สอบซ่อมครั้งที่ ' . $item->exam_attempts : 'เริ่มทำข้อสอบ' }}
                                                                                    </a>
                                                                                @elseif($item->score_has_wait)
                                                                                    <button class="btn btn-warning"
                                                                                        style="font-size: 18px; font-weight: bold; border-radius: 8px; padding: 8px 30px; opacity: 0.8;"
                                                                                        disabled>
                                                                                        รอแอดมินตรวจข้อสอบ
                                                                                    </button>
                                                                                @else
                                                                                    @if($item->exam_attempts >= $item->exam_max_attempts && !$item->exam_has_passed)
                                                                                        {{-- หมดสิทธิ์สอบและยังไม่ผ่าน → ปุ่มขอรีเซต --}}
                                                                                        <form id="reset-form-{{ $item->course_id }}" action="{{ route('course.reset',[$item->course_id]) }}" method="POST" style="display:inline;">
                                                                                            @csrf
                                                                                            {{-- <input type="hidden" name="course_id" value="{{ $item->course_id }}"> --}}
                                                                                            <input type="hidden" name="from_page" value="{{ request()->query('page', 1) }}">
                                                                                            <button type="button" class="btn btn-danger" onclick="confirmReset('{{ $item->course_id }}')"
                                                                                                    style="font-size: 18px; font-weight: bold; border-radius: 8px; padding: 8px 30px;">
                                                                                                <i class="fa fa-refresh mr-2"></i> รีเซตการเรียนทั้งหมด
                                                                                            </button>
                                                                                        </form>
                                                                                    @else
                                                                                        {{-- ยังเรียนไม่ครบ --}}
                                                                                        <button class="btn btn-danger"
                                                                                                style="font-size: 18px; font-weight: bold; border-radius: 8px; padding: 8px 30px; opacity: 0.8;"
                                                                                                disabled>
                                                                                            ต้องเรียนให้ครบก่อน
                                                                                        </button>
                                                                                    @endif
                                                                                @endif
                                                                            </div>
                                                                        </div>

                                                                        {{-- ส่วนเนื้อหาข้างล่าง (Body) - สีขาว/ฟ้าอ่อน แสดงประวัติคะแนนแบบรายการย่อย --}}
                                                                        <div
                                                                            style="background-color: #f0f7ff; padding: 20px; border: 1px solid #1F7BCC; border-top: none; border-radius: 0 0 12px 12px;">

                                                                            @if ($item->all_exam_scores && $item->all_exam_scores->isNotEmpty())
                                                                                <p
                                                                                    style="font-size: 16px; font-weight: bold; color: #1F7BCC; margin-bottom: 15px;">
                                                                                    ประวัติการทำข้อสอบ:
                                                                                </p>

                                                                                <div
                                                                                    style="display: flex; flex-direction: column; gap: 10px;">
                                                                                    @foreach ($item->all_exam_scores as $index => $score)
                                                                                        @php
                                                                                            if (
                                                                                                $score->score_status ===
                                                                                                'pass'
                                                                                            ) {
                                                                                                $statusBg = '#28a745'; // สีเขียว
                                                                                            } elseif (
                                                                                                $score->score_status ===
                                                                                                'fail'
                                                                                            ) {
                                                                                                $statusBg = '#dc3545'; // สีแดง
                                                                                            } elseif (
                                                                                                $score->score_status ===
                                                                                                'wait'
                                                                                            ) {
                                                                                                $statusBg = '#ffc107'; // สีเหลือง (Warning)
                                                                                            }
                                                                                        @endphp
                                                                                        {{-- แถบรายการคะแนน เลียนแบบสไตล์บทเรียนย่อย --}}
                                                                                        <div
                                                                                            style="background-color: white; border-radius: 10px; padding: 12px 20px; display: flex; justify-content: space-between; align-items: center; border: 1px solid #d1e6f9;">
                                                                                            <div
                                                                                                style="display: flex; align-items: center;">
                                                                                                <div
                                                                                                    style="width: 35px; height: 35px; background-color: #1F7BCC; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-weight: bold;">
                                                                                                    {{ $index + 1 }}
                                                                                                </div>
                                                                                                <span
                                                                                                    style="font-size: 17px; font-weight: 600; color: #333;">รอบที่
                                                                                                    {{ $index + 1 }}</span>
                                                                                            </div>

                                                                                            <div
                                                                                                style="display: flex; align-items: center; gap: 20px;">
                                                                                                <span
                                                                                                    style="font-size: 18px; font-weight: bold; color: #1F7BCC;">
                                                                                                    {{ $score->score_number }}
                                                                                                    /
                                                                                                    {{ $score->score_total }}
                                                                                                    <small>คะแนน</small>
                                                                                                </span>
                                                                                                <span
                                                                                                    style="background-color: {{ $statusBg }}; color: white; padding: 4px 15px; border-radius: 6px; font-weight: bold; font-size: 13px; text-transform: uppercase; min-width: 70px; text-align: center;">
                                                                                                    {{ $score->score_status }}
                                                                                                </span>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            @else
                                                                                <div
                                                                                    style="text-align: center; padding: 20px; color: #6c757d; font-style: italic;">
                                                                                    ยังไม่มีประวัติการทำข้อสอบในหลักสูตรนี้
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    {{-- ไม่มีข้อสอบ → ปุ่มสำเร็จการเรียน --}}
                                                                    <div style="margin-top: 30px; text-align: center;">
                                                                        @if ($item->passcourse->isNotEmpty())
                                                                            <button class="btn btn-success btn-lg" disabled
                                                                                style="font-size: 18px; font-weight: bold; border-radius: 8px; padding: 10px 40px;">
                                                                                <i class="fa fa-check-circle mr-2"></i>
                                                                                สำเร็จการเรียนแล้ว
                                                                            </button>
                                                                        @else
                                                                            <form
                                                                                action="{{ route('course.complete', $item->course_id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <input type="hidden" name="from_page"
                                                                                    value="{{ request()->query('page', 1) }}">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary btn-lg"
                                                                                    style="font-size: 18px; font-weight: bold; border-radius: 8px; padding: 10px 40px;">
                                                                                    <i class="fa fa-check-circle mr-2"></i>
                                                                                    กดเพื่อสำเร็จการเรียน
                                                                                </button>
                                                                            </form>
                                                                        @endif
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                // 1. ดึงค่า Fragment จาก URL (เช่น #course-52)
                var hash = window.location.hash;

                if (hash) {
                    // ดึงตัวเลข ID ออกมาจากคำว่า #course-52
                    var courseId = hash.replace('#course-', '');

                    // 2. สั่งให้ Bootstrap Tab ของคอร์สนั้นทำงาน

                    var targetTab = $('#v-pills-tab-' + courseId);

                    if (targetTab.length > 0) {
                        targetTab.tab('show'); // สั่งเปิด Tab ทันที

                        // 3. (Optional) เลื่อนหน้าจอลงไปหาจุดนั้นหน่อย จะได้ไม่ต้องเลื่อนเอง
                        setTimeout(function() {
                            $('html, body').animate({
                                scrollTop: $(hash).offset().top - 120 // -120 เผื่อระยะ Header ข้างบน
                            }, 500);
                        }, 300); // หน่วงเวลานิดนึงเพื่อให้ Tab กางออกเสร็จก่อน
                    }
                }
            });
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.btn-view-doc').forEach(btn => {
                    btn.addEventListener('click', async function(e) {
                        e.preventDefault();

                        const viewUrl   = this.getAttribute('href');
                        const courseId = this.getAttribute('data-course-id');
                        const docId = this.getAttribute('data-doc-id');
                        const lessonId = this.getAttribute('data-lesson-id');

                        // 1. แสดง Swal ทันทีที่กด (แบบไม่มีปุ่มตกลง)
                        Swal.fire({
                            title: 'กำลังบันทึกและดาวน์โหลด...',
                            text: 'กรุณารอสักครู่',
                            icon: 'success',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            backdrop: false,
                            didOpen: () => {
                                Swal
                            .showLoading(); // แสดงไอคอนหมุนๆ ให้ดูว่ากำลังประมวลผล
                            }
                        });

                        try {
                            // 2. บันทึก progress (รอจน Server ตอบกลับ)
                            await fetch('{{ route('course.doc.progress') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    file_doc_id: docId,
                                    lesson_id: lessonId,
                                    course_id: courseId.replace('course-', '')
                                })
                            });

                            // 2. เปิด PDF viewer แยก tab
                            window.open(viewUrl, '_blank');

                            // 4. รอสักพักให้ไฟล์เริ่มโหลด แล้วทำการรีโหลดหน้าเว็บ
                            setTimeout(() => {
                                // สร้าง URL ใหม่ที่มี Fragment
                                const nextUrl = window.location.origin + window.location
                                    .pathname + window.location.search + '#' + courseId;

                                // บังคับเปลี่ยน URL และ Reload จริงๆ
                                window.location.href = nextUrl;
                                window.location.reload();
                            }, 1000); // ลดเหลือ 1 วินาที เพราะบันทึก DB เสร็จไปแล้วจาก fetch

                        } catch (error) {
                            console.error('Error:', error);
                            Swal.fire('เกิดข้อผิดพลาด', 'ไม่สามารถบันทึกข้อมูลได้', 'error');
                        }
                    });
                });
            });

            function confirmReset(courseId) {
            Swal.fire({
                title: 'ยืนยันการรีเซต?',
                text: "ระบบจะทำการรีเซตการเรียนของท่านทั้งหมดในหลักสูตรนี้",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33', // สีแดง
                cancelButtonColor: '#3085d6', // สีน้ำเงิน
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                backdrop: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // ⏳ แสดง Loading เพื่อไม่ให้ User กดปุ่มซ้ำระหว่างที่หลังบ้านกวาด 6 ตาราง
                    Swal.fire({
                        title: 'กำลังจัดการข้อมูล...',
                        text: 'โปรดรอสักครู่ ระบบกำลังทำการรีเซตบทเรียน',
                        backdrop: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // 🚀 สั่งสั่ง Submit Form ตัวที่เราต้องการยิงไปหา Controller
                    document.getElementById('reset-form-' + courseId).submit();
                }
            });
        }
        </script>
    </body>
    {{-- เก็บไว้ตอนทำคะแนน --}}
    {{-- <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
    <span><i class="fa fa-check-circle text-primary"></i> ทำข้อสอบก่อนเรียน</span>
    <span>คะแนนที่ได้ <b style="background: white; padding: 2px 10px; border-radius: 5px; margin-left: 5px;">15/15</b></span>
</div> --}}
@endsection
