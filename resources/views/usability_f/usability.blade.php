@extends('layout/mainlayout')
@section('content')
<style>
    .page-section{
        margin: 0 !important
    }
    .main-content {
        min-height: 100vh;
    }
</style>
<body>
    <div class="main-content">
        <div id="content">
            <style>
                .custom-color1 {
                    background-color: #2599F8;
                }
            </style>
            <div class="parallax overflow-hidden page-section bg-blue-300">
                <div class="container parallax-layer" data-opacity="true" style="transform: translate3d(0px, 0px, 0px); opacity: 1;">
                    <div class="media media-grid v-middle">
                        <div class="media-left">
                            <span class="icon-block half bg-blue-500 text-white" style="height: 45px;"><i class="fa fa-fw fa-archive"></i></span>
                        </div>
                        <div class="media-body">
                            <h3 class="text-display-2 text-white margin-none">วิธีการใช้งาน</h3>
                            <!--                <p class="text-white text-subhead" style="font-size: 1.6rem;">รวมข่าวสารของ Brother</p>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="panel panel-default paper-shadow" data-z="0.5" style="margin-top: 25px;">
                    <div class="panel-body">
                        @foreach ($usa as $us)
                        <p><span style="font-family: tahoma, arial, helvetica, sans-serif; font-size: x-large;"><strong>{{ $us->usa_title}} &nbsp;</strong> &nbsp;</span></p>
                        {{-- <p><span style="font-family: tahoma, arial, helvetica, sans-serif; font-size: large;">{!! htmlspecialchars_decode($us->usa_detail) !!}</span></p> --}}
                        @endforeach
                    </div>
                </div>
            </div>
        </div><!-- content -->
    </div>
</body>
@endsection
