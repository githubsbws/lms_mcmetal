@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<style>
    .video-js {
        max-width: 100%
    }

    /* the usual RWD shebang */

    .video-js {
        width: 350px !important; /* override the plugin's inline dims to let vids scale fluidly */
        height: 350px !important;
    }

    .video-js video {
        position: relative !important;
    }
</style>
<body class="">
    <div id="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">ระบบบทเรียน</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('lesson')}}">
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
                        รายละเอียดบทเรียน
                    </div>
                    <div class="card-body">
                            <div class="form-group">
                                <label for="course_title">หลักสูตรอบรมออนไลน์</label>
                                <h4>{{$lesson->course_title ?? '-'}}</h4>
                            </div>

                            <div class="form-group">
                                <label for="title">ชื่อบทเรียน</label>
                                <h4>{{$lesson->title ?? '-'}}</h4>
                            </div>

                            <div class="form-group">
                                <label for="description">รายละเอียดย่อ</label>
                                {!! htmlspecialchars_decode(htmlspecialchars_decode($lesson->description ?? '-')) !!}
                            </div>

                            <div class="form-group">
                                <label for="view_all">สิทธิ์การดูบทเรียนนี้</label>
                                <div>
                                    @php
                                        $checked = $lesson->view_all ?? '-' == 'y' ? 'checked' : '';
                                    @endphp
                                    <input type="checkbox" name="view_all" value="y" data-toggle="toggle" data-on="ดูได้ทั้งหมด" data-off="ดูได้เฉพาะกลุ่ม" data-onstyle="success" data-offstyle="danger" {{ $checked }} />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cate_amount">จำนวนครั้งที่สามารถทำข้อสอบได้</label>
                                <h4>{{$lesson->cate_amount ?? '-'}}</h4>
                            </div>

                            <div class="form-group">
                                <label for="cate_amount">เวลาในการทำข้อสอบ</label>
                                <h4>{{$lesson->time_test ?? '-'}}</h4>
                            </div>

                            <div class="form-group">
                                <label for="cms_short_title">เนื้อหา </label>
                                {!! htmlspecialchars_decode(htmlspecialchars_decode($lesson->content ?? '-')) !!}
                            </div>

                            <div class="form-group">
                                <label for="File_filename">ไฟล์บทเรียน (mp3,mp4)</label>
                                    @if($file != null)
                                    <div class="col-md-6">
                                        <video id="example_video_1" class="video-js vjs-default-skin" controls="" preload="none" data-setup="{}" controlsList="nodownload">
                                            {{-- <source src="/../images/storage/uploads/lesson/{{$lesson->filename}}" type="video/mp4"> --}}
                                            <source src="{{asset('images/uploads/lesson/'.$file->filename)}}" type="video/mp4">
                                            <!-- <source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' />
                                                        <source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' /> -->
                                            <!-- <track kind="captions" src="demo.captions.vtt" srclang="en" label="English"></track> -->
                                            <!-- Tracks need an ending tag thanks to IE9 -->
                                            <!-- <track kind="subtitles" src="demo.captions.vtt" srclang="en" label="English"></track> -->
                                            <!-- Tracks need an ending tag thanks to IE9 -->
                                            <p class="vjs-no-js">To view this video please
                                                enable JavaScript, and consider upgrading to
                                                a
                                                web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                                            </p>
                                        </video>
                                    </div>
                                    @else
                                    <h4>ไม่มีวิดีโอ</h4>
                                    @endif
                            </div>

                            <div class="form-group">
                                <label for="FileDoc_doc">ไฟล์ประกอบบทเรียน (pdf,docx,pptx)</label>
                                    @if($filedoc != null)
                                    <a href="{{ route('lesson.downloadfile', ['id' => $filedoc->id]) }}" target="_blank" >{{ $filedoc->file_name}}</a>
                                    @else
                                    <h4>ไม่มีไฟล์ประกอบบทเรียน</h4>
                                    @endif
                            </div>

                            <div class="form-group">
                                <label for="picture_show">ภาพประกอบ</label>
                                    @if($lesson)
                                    <h3><img src="{{ asset('images/uploads/lesson/'.$lesson->id.'/original/'. $lesson->image) }}" alt="รูปภาพ"></h3>
                                    @else
                                    <h4>ไม่มีภาพประกอบ</h4>
                                    @endif
                            </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="clearfix"></div>
</body>
@endsection
