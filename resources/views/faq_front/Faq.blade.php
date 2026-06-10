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
            <!---->
            <!--<h1>Faqs</h1>-->
            <!---->
            <style>
                .panel {
                    margin-bottom: 4px;
                }

                .panel-collapse-trigger.panel-heading::after {
                    top: 15px;
                }

                .panel-default>.panel-heading:hover {
                    color: #333;
                    background-color: #F0F0F0;
                    border-color: #E2E9E6;
                }
            </style>
            <div class="parallax overflow-hidden page-section bg-blue-300">
                <div class="container parallax-layer" data-opacity="true">
                    <div class="media media-grid v-middle">
                        <div class="media-left">
                            <span class="icon-block half bg-blue-500 text-white" style="height: 45px;"><i class="fa fa-fw fa-question-circle"></i></span>
                        </div>
                        <div class="media-body">
                            <h3 class="text-display-2 text-white margin-none">คำถามที่พบบ่อย</h3>
                            <!--                <p class="text-white text-subhead" style="font-size: 1.6rem;">รวมข่าวสารของ Brother</p>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="page-section">
                    <div class="col-md-9" style="margin-bottom: 25px;">
                        @foreach ($faq_type as $type)
                        <div class="panel panel-default paper-shadow" data-z="0.5" style="margin-bottom: 25px;">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="media v-middle">
                                        <div class="media-body">
                                            <h4 class="text-headline margin-none" style="font-size: 26px;font-weight: bold;">{{ $type->faq_type_title_TH }}</h4>
                                        </div>
                                        <div class="media-right">
                                        </div>
                                    </div>
                                </li>
                                {{-- <li class="list-group-item media v-middle">

                                    <div class="panel panel-default" data-toggle="panel-collapse" data-open="false">

                                        <div class="panel-heading panel-collapse-trigger collapse in collapsed" data-toggle="collapse" data-target="#3caeb8e4-baaa-9587-7891-500dc5108dfe" aria-expanded="false" style="">
                                            <h3 class="panel-title" style="font-size: 22px;"><img src="{{ asset('themes/bws/images/brotherlogo.png') }}" alt="person" style="width: 25px;">{{ $type->faq_THtopic}}</h3>
                                        </div>


                                        <div class="panel-body list-group">
                                            <ul class="list-group list-group-menu">
                                                <li class="list-group-item" style="padding-left: 15px;padding:10px;">
                                                    <ul>
                                                        <li>
                                                            <p><strong>{!! htmlspecialchars_decode($type->faq_THanswer) !!}</strong></p>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li> --}}
                            </ul>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div><!-- content -->
    </div>

</body>
@endsection
