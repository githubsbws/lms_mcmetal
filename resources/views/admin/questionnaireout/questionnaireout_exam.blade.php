@extends('layout/mainlayout')
@section('title', 'Course')
@section('content')
    @php
        use App\Models\QQuestion;
        use App\Models\QChoice;
    @endphp
    <style type="text/css">
        #question-form p {
            display: inline;
        }
    </style>
    <script type='text/javascript'
            src='{{asset('themes/bws/js/jquery.countdown.min.js')}}'>
        </script>
    <script type="text/javascript">
        window.timeEnd = false;
    </script>
    <div class="bs-example">
        <style>
            .quiz {
                list-style-type: none;
                margin-bottom: 40px;
            }

            .quiz li {
                float: left;
                margin-right: 20px;
            }

            .head-quiz {
                padding-left: 20px;
                padding-right: 20px;
            }

            thead {
                background-color: #94CFFF;
            }

            .mb-quiz {
                margin-bottom: 10px;
            }

            .form-control {
                border: 1px solid #D1D1D1;
            }

            .radio label::before {
                border: 1px solid #4193D0;
            }

            .checkbox label::before {
                border: 1px solid #4193D0;
            }

            .ml-15 {
                margin-left: 15px;
            }

            .mb-10 {
                margin-bottom: 15px;
                ;
            }

            .span5 {
                width: 500px;
            }

            label {
                font-weight: normal;
            }
        </style>

        <div class="parallax bg-white page-section">
            <div class="container parallax-layer" data-opacity="true">
                <div class="media v-middle">
                    <div class="media-body">
                        <h1 class="text-display-2 margin-none">แบบสอบถาม</h1>

                        <!--<p class="text-light lead">แบบประเมินผลการอบรม</p>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="text-center bg-transparent margin-none">
            </div>
            <div class="page-section">
                <div class="panel panel-default head-quiz">
                    <form action="{{ route('questionnaireout.Answer',['id' => $survey_headers->survey_header_id]) }}" enctype="multipart/form-data" method="post" id="question-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-sm-12"
                                style="margin-top: 20px;margin-bottom: 30px;text-align: center;"><img
                                    src="{{ asset('Adminkit/theme/images/head-subject/quiz.png') }}" alt="person"
                                    style="margin-top: -15px;" /><span
                                    style="font-size: 50px;color: rgb(0, 183, 243);">แบบสอบถาม {{ $survey_section->section_title}}</span>
                            </div>
                            @php
                                $strTotal = 0;
                                $questionTypeArray = ['1' => 'checkbox', '2' => 'radio', '3' => 'textarea', '4' => 'radio', '5' => 'textarea'];
                            @endphp
                            @foreach ($question as $z => $m)
                                @php ++$strTotal;
                                    $choice = QChoice::where(['question_id' => $m->question_id])->get();
                                    // dd($m->input_type_id);
                                @endphp
                                <div class="question" style="margin: 10px 0; font-weight: bold; font-size: 22px;">
                                    <div class="col-md-12 col-sm-12">
                                        @php
                                            $imageS = asset('/images/knewstuff.png');
                                        @endphp
                                        <img src="{{ $imageS }}" width="20px" valign="top"
                                            style="margin-right:10px;" alt="">
                                        {{ $strTotal }}.{!! html_entity_decode($m->question_name) !!}
                                    </div>
                                    <div id="div-choice" class="col-md-12 col-sm-12 ml-15 pull-left question-group"
                                        style="margin-top: 5px;">
                                        @if ($m->input_type_id == '1')
                                        
                                            {{-- {{ Form::hidden("Question_type[{$m->question_id}]", $questionTypeArray[$m->input_type_id]) }} --}}
                                            @if ($choice)
                                                @foreach ($choice as $choices)
                                                
                                                    <div class="col-md-12 col-sm-12 mb-quiz">
                                                        <label>
                                                            {{-- {{ Form::checkbox("Choice[{$m->question_id}][]", $choices->option_choice_id, false, ['style' => 'margin-top:0px;']) }}
                                                            {{ $choices->option_choice_name }}<br> --}}
                                                            <input type="checkbox" name="Choice[{{$m->question_id}}][]" value="{{$choices->option_choice_id}}" style="margin-top:0px;">
                                                            {{$choices->option_choice_name}}<br>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @elseif ($m->input_type_id == '2')
                                       
                                            {{-- {{ Form::hidden("Question_type[{$m->question_id}]", $questionTypeArray[$m->input_type_id]) }} --}}
                                            @if ($choice)
                                                @foreach ($choice as $choices)
                                                
                                                    <div class="col-md-12 col-sm-12 mb-quiz">
                                                        <label>
                                                            {{-- {{ Form::radio("Choice[{$m->question_id}][]", $choices->option_choice_id, false, ['style' => 'margin-top:0px;']) }}
                                                            {{ html_entity_decode($choices->option_choice_name) }} --}}
                                                            <input type="radio" name="Choice[{{$m->question_id}}][]" value="{{$choices->option_choice_id}}" style="margin-top:0px;">
                                                            {{ html_entity_decode($choices->option_choice_name) }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @elseif ($m->input_type_id == '3')
                                        @foreach ($choice as $choices)
                                        <input type="hidden" name="Question_type[{{$m->question_id}}]" value="{{$choices->option_choice_id}}">
                                        @endforeach
                                            {{-- {{ Form::hidden("Question_type[{$m->question_id}]", $questionTypeArray[$m->input_type_id]) }} --}}
                                            <div class="col-md-12 col-sm-12 mb-quiz">
                                                {{-- {{ Form::textarea("ChoiceText[{$m->question_id}]", '', ['class' => 'form-control']) }} --}}
                                                <textarea name="ChoiceText[{{$m->question_id}}]" class="form-control"></textarea>
                                            </div>
                                        @elseif ($m->input_type_id == '4')
                                        
                                            {{-- {{ Form::hidden("Question_type[{$m->question_id}]", $questionTypeArray[$m->input_type_id]) }} --}}
                                            @if ($choice)
                                                @foreach ($choice as $choices)
                                               
                                                    <div class="col-md-12 col-sm-12 mb-quiz">
                                                        <label>
                                                            {{-- {{ Form::radio("Choice[{$m->question_id}][]", $choices->option_choice_id, false, ['style' => 'margin-top:0px;']) }}
                                                            {{ html_entity_decode($choices->option_choice_name) }} --}}
                                                            <input type="radio" name="Choice[{{$m->question_id}}][]" value="{{$choices->option_choice_id}}" style="margin-top:0px;">
                                                            {{ html_entity_decode($choices->option_choice_name) }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @elseif ($m->input_type_id == '5')
                                        @foreach ($choice as $choices)
                                        <input type="hidden" name="Question_type[{{$m->question_id}}]" value="{{$choices->option_choice_id}}">
                                        @endforeach
                                            {{-- {{ Form::hidden("Question_type[{$m->question_id}]", $questionTypeArray[$m->input_type_id]) }} --}}
                                            <div class="col-md-12 col-sm-12 mb-quiz">
                                                {{-- {{ Form::textarea("ChoiceText[{$m->question_id}]", '', ['class' => 'form-control']) }} --}}
                                                <textarea name="ChoiceText[{{$m->question_id}}]" class="form-control"></textarea>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 mb-assessment" style="margin-bottom: 40px;">
                                    <img src="{{ asset('/images/bordertop.png') }}" class="img-responsive" alt="">
                                </div>
                            @endforeach
                            <div class="col-md-12 col-sm-12 mb-assessment text-right" style="margin-bottom: 40px;">
                                <button class="btn btn-icon btn-primary" >บันทึกข้อมูล</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() { // document ready
            $('form#question-form').submit(function() {
                var validate = true;
                if (validate && !window.timeEnd) {
                    // alert('กรุณาเลือกคำตอบให้ครบ');
                    //  return false;
                    $('.question-group').each(function(index) {
                        var type = $(this).find("input[name^='Question_type']");
                        if (type.length) {
                            type = type.val();
                        } else {
                            type = 'error';
                        }
                        
                    });
                }
                return validate;
            });

            if (!!$('.sticky').offset()) { // make sure ".sticky" element exists
                var stickyTop = $('.sticky').offset().top; // returns number
                $(window).scroll(function() { // scroll event
                    var windowTop = $(window).scrollTop(); // returns number
                    if (stickyTop < windowTop) {
                        $('.sticky').css({
                            position: 'fixed',
                            top: 0,
                            'z-index': 99999,
                            right: 0
                        });
                    } else {
                        $('.sticky').css('position', 'static');
                    }
                });
            }
        });
    </script>

@endsection
