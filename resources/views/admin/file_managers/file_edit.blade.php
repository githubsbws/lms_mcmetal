@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<body>
    <div id="wrapper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">จัดการวิดีโอ</h4>
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
                        แก้ไขวิดีโอ
                    </div>
                    <div class="card-body">
                        <form action="{{ route('file.edit', ['id'=>$file->id]) }}" enctype="multipart/form-data" method="post" id="question-form">
                            @csrf
                            <div class="form-group">
                                <label for="cate_id">ชื่อไฟล์</label>
                                <input type="text" name="file_name" class="form-control" value="{{ $file->file_name }}">
                            </div>

                            <div class="form-group">
                                <label for="teacher_name">บทเรียน</label>
                                <select class="form-control" name="teacher_name">
                                    <option value="{{ $lesson->id ?? '-' }}">{{ $lesson->title ?? '-'}}</option>
                                    @foreach($lesson_all as $all)
                                    <option value="{{ $all->id }}">{{ $all->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="teacher_name">วิดีโอ</label>
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
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>บันทึก</button>
                        </form>
                    </div>
                </div>
            </div>
            <div id="sidebar">
            </div><!-- sidebar -->
        </div>
    </div>
    <div class="clearfix"></div>
</body>
@endsection
