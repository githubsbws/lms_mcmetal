@extends('layout/mainlayout')
@section('content')
<body>

    <div id="content" style="margin-top: 6rem;">
        <div class="parallax overflow-hidden page-section bg-blue-300">
            <div class="container parallax-layer" data-opacity="true">
                <div class="media media-grid v-middle">
                    <div class="media-left">
                        <span class="icon-block half bg-blue-500 text-white" style="height: 45px;"><i class="fa fa-fw fa-book"></i></span>
                    </div>
                    <div class="media-body">
                        <h3 class="text-display-2 text-white margin-none">ห้องเรียนเสมือน</h3>
                        <p class="text-white text-subhead" style="font-size: 1.6rem;">รวมรายชื่อห้องเรียนเสมือนที่กำลัง ออนไลน์อยู่</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="min-height: 250px;">
            <div class="page-section">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row" data-toggle="isotope" style="position: relative; height: 0px;">
                            @foreach($zoom as $z)
                            @php
                            $z_date = $z->start_date;
                            $z_range = $z->duration;
                            if($z_range !== null){
                                $date_now = now();
                                $newDate = date('Y-m-d', strtotime($z_date . ' + ' . $z_range . ' days'));
                            }
                            @endphp
                            @if($date_now <= $newDate)
                            <div class="row">
                            <h4 class="text-headline margin-v-5-0" style="font-size: 28px;"><a href="{{ $z->join_url}}" title="{{ $z->join_url}}">{{ $z->title}}</a></h4>
                            <h6> ระยะเวลา {{ $z->duration}} วัน &nbsp; | <i class="fa fa-fw fa-calendar" style="color:#42A5F5;"></i> 
                            </h6>
                            </div>
                            @else
                           
                            @endif
                            @endforeach


                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
</body>
@endsection