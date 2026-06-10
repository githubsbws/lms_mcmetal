@extends('layout/mainlayout')
@section('content')
<body>

    <div class="span-19">
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
                
                .col {
                    margin-right: 10px; /* Adjust spacing between the columns as needed */
                }
                .col input {
                    width: 100%; /* Ensure the inputs take up the full width of their column */
                }
                .btn-action {
                    margin-left: auto; /* Push the button to the right end */
                }
                .error {
                    display: flex;
                    flex-direction: column;
                    margin-top: 5px;
                }
            </style>
            <div class="parallax overflow-hidden page-section bg-blue-300">
                <div class="container parallax-layer" data-opacity="true">
                    <div class="media media-grid v-middle">
                        <div class="media-left">
                            <span class="icon-block half bg-blue-500 text-white" style="height: 45px;"><i class="fa fa-fw fa-question-circle"></i></span>
                        </div>
                        <div class="media-body">
                            <h3 class="text-display-2 text-white margin-none">ติดต่อเรา</h3>
                            <!--                <p class="text-white text-subhead" style="font-size: 1.6rem;">รวมข่าวสารของ Brother</p>-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="widget-body">
                    <div class="form">
                        <form enctype="multipart/form-data" id="news-form" action="{{route('contactus_f')}}" method="post">
                            @csrf
                            <div class="row">
                                <label for="contact_by_name" class="required">ชื่อ - นามสกุล ผู้ติดต่อ <span class="required">*</span></label> <br>
                                <div class="col">
                                    <input class="form-control" size="60" maxlength="250" name="contact_by_name" id="contact_by_name" type="text" placeholder="ชื่อ"> 
                                </div>
                                <div class="col">
                                    <input class="form-control" size="60" maxlength="250" name="contact_by_surname" id="contact_by_surname" type="text" placeholder="นามสกุล"> 
                                </div>
                                <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
                                <div class="error help-block">
                                    <div class="label label-important" id="contact_by_name_em_" style="display:none"></div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="News_cms_title" class="required">อีเมลล์ผู้ติดต่อ <span class="required">*</span></label> <br>
                                <input size="60" maxlength="250" class="form-control" name="contact_by_email" id="contact_by_email" type="email" placeholder="อีเมลล์ผู้ติดต่อ"> 
                                <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
                                <div class="error help-block">
                                    <div class="label label-important" id="News_cms_title_em_" style="display:none"></div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="News_cms_title" class="required">เบอร์โทรผู้ติดต่อ <span class="required">*</span></label> <br>
                                <input size="60" maxlength="20" class="form-control" name="contact_by_tel" id="contact_by_tel" type="number" placeholder="เบอร์โทรผู้ติดต่อ"> 
                                <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
                                <div class="error help-block">
                                    <div class="label label-important" id="News_cms_title_em_" style="display:none"></div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="News_cms_title" class="required">หัวข้อเรื่อง <span class="required">*</span></label> <br>
                                <input size="60" maxlength="250" class="form-control" name="contact_by_subject" id="contact_by_subject" type="text" > 
                                <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
                                <div class="error help-block">
                                    <div class="label label-important" id="News_cms_title_em_" style="display:none"></div>
                                </div>
                            </div>
                            <div class="row">
                                <label for="News_cms_title" class="required">รายละเอียด <span class="required">*</span></label> <br>
                                <textarea rows="6" cols="50" class="form-control" name="contact_by_detail" id="contact_by_detail" aria-hidden="true"></textarea>
                                <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span>
                                <div class="error help-block">
                                    <div class="label label-important" id="News_cms_title_em_" style="display:none"></div>
                                </div>
                            </div>
                            <br>

                            <div class="row buttons">
                                <button class="btn btn-primary btn-icon glyphicons ok_2"><i></i>บันทึกข้อมูล</button>
                            </div>
                        </form>
                    </div><!-- form -->
                </div>
            </div>

        </div><!-- content -->
    </div>
    @if(session('success'))
    <script>
        swal({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect or do any other action if needed
                window.location.href = "{{url('index')}}";
            }
        });
    </script>
    @endif
</body>
@endsection