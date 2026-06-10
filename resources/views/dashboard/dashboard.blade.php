@extends('layout/mainlayout')
@section('title', 'Dashboard')
@section('content')
<?php
use App\Models\Lesson;
use App\Models\Learn;
use App\Models\Score;
use App\Models\Ques_ans;
?>
<body>

    <div id="content">
        <style>
            .text-subhead {
                font-size: 1.50rem;
            }

            .text-caption {
                font-size: 1.2rem;
                font-weight: 400;
            }

            thead {
                background-color: #42A5F5;
            }
            
        </style>
        <div class="overflow-hidden page-section bg-blue-300">
            <div class="container-fluid " data-opacity="true" style="transform: translate3d(0px, 0px, 0px); opacity: 1;">
                <div class="media media-grid v-middle">
                    <div class="media-left">
                        <span class="icon-block half bg-blue-500 text-white" style="height: 45px;"><i class="fa fa-tachometer"></i></span>
                    </div>
                    <div class="media-body">
                        <h3 class="text-display-2 text-white margin-none">Dashboard</h3>
                       <!--  <p class="text-white text-subhead" style="font-size: 1.6rem;">รวมหลักสูตร การทำงานของ Product ของ
                            Brother</p> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="page-section">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="row" data-toggle="isotope" style="position: relative; height: 790.713px;">
                            
                            <div class="item col-12" style="position: absolute; left: 580px; top: 0px;">
                                <div class="panel panel-primary paper-shadow" data-z="0.5">
                                    <!-- <div class="panel-heading">
                                        <h4 class="margin-none" style="color: white;font-weight: bold;">หลักสูตร</h4>

                                        <p class="text-subhead text-light" style="color: white;">หลักสูตรทั้งหมดที่ต้องเรียน</p>
                                    </div> -->
                                    <ul class="list-group">
                                        
                                        @foreach ($course as $cs)
                                        @php 
                                        
                                        $lesson = Lesson::where('course_id',$cs->course_id)->where('active','y')->count();
                                        $lesson_c = Lesson::where('course_id',$cs->course_id)->where('active','y')->get(); 
                                        $i = 1;
                                        $pass = 0;
                                        $learning = 0;
                                        $notlearn = 0;
                                        foreach ($lesson_c as $key ) {
                                           
                                            $status =  Learn::join('lesson', 'lesson.id', '=', 'learn.lesson_id')
                                                            ->where('learn.lesson_id', $key->id)
                                                            ->where('learn.user_id', Auth::user()->id)
                                                            ->where('lesson.active', 'y') 
                                                            ->get();
                                            foreach ($status as  $counts) {
                                                if ($counts->lesson_status == "pass") {
                                                    $pass = $pass + 1;
                                                }
                                                if ($counts->lesson_status == "learning") {
                                                    $learning = $learning + 1;
                                                }
                                                if ($counts->lesson_status == "notLearn") {
                                                    $notlearn = $notlearn + 1;
                                                }
                                                $i++;
                                            }
                                            
                                        }
                                        $per = ($pass / $lesson) * 100;
                                        @endphp
                                        <li class="list-group-item media v-middle">
                                            <div class="media-body">
                                                <a href="{{ route('course.detail', ['id' => $cs->course_id]) }}" class="text-subhead list-group-link">
                                                    {{ $cs->course_title }} </a>
                                                <br>
                                                <p style="font-size:18px;">เรียนแล้ว <label style="color: #00A000; font-weight: 600;">{{ $pass }}</label> : ยังไม่เรียน <label style="color: red; font-weight: 600;">{{ $notlearn }} </label> : กำลังเรียน <label>{{ $learning }}</label></p>
                                            </div>

                                            <div class="media-right" align="center">
                                                <label style="color: #00A000; font-weight: 600;">{{ $pass }}</label> จาก <label style="color: #00A000; font-weight: 600;">{{ $lesson }}</label>
                                                <div class="progress progress-mini width-100 margin-none">
                                                    <div class="progress-bar progress-bar-green-300" role="progressbar"
                                                     aria-valuenow="" aria-valuemin="0"
                                                     aria-valuemax="100"
                                                     style="width:{{ $per }}%;">
                                                </div>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                  <!--       <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="margin-none" style="color: white;font-weight: bold;">ผลการเรียน</h4>
                                <p class="text-subhead text-light" style="color: white;">ผลการเรียน</p>
                            </div>
                        </div> -->
                        <div class="panel-group" id="accordion" style="margin-top: 10px;">
                            @foreach($course as $cos)
                            @php
                            $lessons =  Lesson::where('course_id',$cos->course_id)->where('active','y')->get();
                            @endphp
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="col-md-10" style="padding-top: 12px;">
                                        <a class="" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$cos->course_id}}">
                                            <h4 class="panel-title panel-title-adjust">
                                                <!-- หลักสูตร: หลักสูตรการทำงานเป็นทีม -->
                                                หลักสูตร: {{$cos->course_title}}
                                            </h4>
                                        </a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div style="height: auto;" id="collapse{{$cos->course_id}}" class="panel-collapse collapse ">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table v-middle table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">บทเรียน</th>
                                                        <th class="text-center">สถานะการเรียน</th>
                                                        <th class="text-center">แบบทดสอบ</th>
                                                        <th class="text-center">สิทธิการทำแบบทดสอบ</th>
                                                        <th class="text-center">แบบสอบถาม</th>
                                                        <th class="text-center">ผลการสอบ(คะแนนที่ดีที่สุด)</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="responsive-table-body">
                                                    @foreach($lessons as $les)
                                                    @php
                                                    $learn = Learn::where('lesson_id',$les->id)->where('user_id',Auth::user()->id)->where('lesson_active','y')->get();
                                                    
                                                    $score = Score::where('lesson_id',$les->id)->where('user_id',Auth::user()->id)->where('score_past','y')->where('active','y')->orderBy('update_date','DESC')->get();
                                                    
                                                    $quest = Ques_ans::where('user_id',Auth::user()->id)->first();
                                                    @endphp
                                                    
                                                    <tr>
                                                        
                                                        <td>
                                                            <a href="{{ route('course.lesson', ['course_id' => $cos->course_id,'id' => $les->id]) }}">{{ $les->title}}</a>
                                                        </td>
                                                        <td class="text-center">
                                                            @php
                                                            
                                                             if ($learn->isEmpty()) {
                                                                echo "<a href='" . route('course.lesson', ['course_id' => $cos->course_id, 'id' => $les->id]) . "'><span style='color:red;''>ยังไม่เรียน</span></a>";
                                                            } else {
                                                                
                                                                foreach ($learn as $lea) {
                                                                    if($lea->lesson_status == 'pass'){
                                                                        echo "<a href='" . route('course.lesson', ['course_id' => $cos->course_id, 'id' => $les->id]) . "'><span style='color:green;''>เรียนผ่าน</span></a>";
                                                                    }elseif($lea->lesson_status == 'learning'){
                                                                        echo "<a href='" . route('course.lesson', ['course_id' => $cos->course_id, 'id' => $les->id]) . "'><span style='color:orange;''>กำลังเรียน</span></a>";
                                                                    }else{
                                                                        echo "<a href='" . route('course.lesson', ['course_id' => $cos->course_id, 'id' => $les->id]) . "'><span style='color:red;''>ยังไม่เรียน</span></a>";
                                                                    }
                                                                }
                                                            }
                                                            @endphp
                                                        </td>
                                                        
                                                        <td class="text-center">
                                                            @php
                                                            if ($score->isEmpty()) {
                                                                // กรณี $score เป็น null หรือ array เปล่า
                                                                echo "ยังไม่ทำแบบทดสอบ";
                                                                
                                                            } else {
                                                                foreach ($score as $sco) {
                                                                    if($sco->score_past == 'y'){
                                                                        echo "ทำแบบทดสอบผ่าน";
                                                                    }
                                                                    elseif($sco->score_past == 'n'){
                                                                        echo "ทำแบบทดสอบไม่ผ่าน";
                                                                    }
                                                                    else{
                                                                        echo "ยังไม่ทำแบบทดสอบ";
                                                                    }  
                                                                }
                                                            }
                                                            @endphp
                                                        </td>
                                                        <td class="text-center">
                                                            -
                                                        </td>

                                                        <td class="text-center">
                                                            @php
                                                            if ($quest == null) {
                                                                 // กรณี $score เป็น null หรือ array เปล่า
                                                                 echo "<p style='font-weight: normal;color: #045BAB;''><label class='label label-warning' style='font-size: medium; letter-spacing: 2px !important;'>ไม่มีแบบสอบถาม</label></p>";
                                                                
                                                            } else {
                                                                
                                                                        echo "<p style='font-weight: normal;color: #045BAB;''><label class='label label-primary' style='font-size: medium; letter-spacing: 2px !important;'>ทำแบบสอบถามแล้ว</label></p>";
                                                                   
                                                            }
                                                            @endphp


                                                        </td>

                                                        <td class="text-center">
                                                            @php
                                                            
                                                            if ($score->isEmpty()) {
                                                                echo "0 / 0";
                                                            } else {

                                                                foreach ($score as $sco) {
                                                                    if($sco->score_number !== null){
                                                                        echo $sco->score_number."/".$sco->score_total;
                                                                    }else{
                                                                        echo "0/0";
                                                                    }
                                                                    
                                                                     
                                                                }
                                                            }
                                                            @endphp
                                                        </td>
                                                        
                                                    </tr>
                                                        
                                                    @endforeach
                                                </tbody>
                                            </table>


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
</body>
@endsection