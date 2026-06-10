@extends('layout/mainlayout')
@section('content')
<body>

    <div class="span-19">
        <div id="content">
            <div class="overflow-hidden page-section bg-blue-300">
                <div class="container-fluid parallax-layer" data-opacity="true">
                    <div class="media media-grid v-middle">
                        <div class="media-left">
                            <span class="icon-block half bg-blue-500 text-white" style="height: 45px;"><i class="fa fa-fw fa-newspaper-o"></i></span>
                        </div>
                        <div class="media-body">
                            <h3 class="text-display-2 text-white margin-none">ข่าวสาร</h3>
                            <p class="text-white text-subhead" style="font-size: 1.6rem;">รวมข่าวสารของ Brother</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="page-section">
                    <div class="row">
                        <div class="col-lg-9 col-md-8">
                            <div class="page-section">
                                <div class="panel panel-default paper-shadow" data-z="0.5" data-hover-z="1" data-animated="">
                                    <div class="panel-body">
                                        <div class="width-300 width-250-md width-50pc-xs paragraph-inline">
                                            <img src="{{ asset('images/uploads/news/'.$news->cms_id.'/original/'.$news->cms_picture)}}"
                                                class="img-responsive" width="700px" height="700px">
                                        </div>
                                        <br>
                                        <p></p>
                                        <p class="text-caption" style="font-size: 35px;">
                                            {{ $news->cms_title}}
                                        </p>
                                        <p class="text-caption" style="font-size: 22px;">{{ $news->cms_short_title }}</p>
                                        <p class="text-caption" style="font-size: 22px;">{!! htmlspecialchars_decode($news->cms_detail) !!}</p>
                                        <p class="text-caption" style="font-size: 22px;">posted by<i class="fa fa-fw fa-comment" style="color:#42A5F5;"></i> {{$profiles->firstname ?? '-'}} &nbsp; | <i class="fa fa-fw fa-calendar" style="color:#42A5F5;"></i> {{$news->update_date ?? '-'}} <br></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                </div>
            </div>
        </div><!-- content -->
    </div>

</body>
@endsection