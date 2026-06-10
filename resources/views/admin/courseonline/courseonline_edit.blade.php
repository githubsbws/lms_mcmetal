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
                            <h4 class="m-0">ระบบหลักสูตรนิสิต/นักศึกษา</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('courseonline')}}">
                                <button class="btn btn-warning d-flex align-items-center">
                                    <i class="fas fa-angle-left mr-2"></i>
                                    กลับหน้าหลัก
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        กรุณาติดต่อแผนกIT
                        {{-- @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach --}}
                    </ul>
                </div>
            @endif
            <div class="container mt-5">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        แก้ไขหลักสูตรนิสิต/นักศึกษา
                    </div>
                    <div class="card-body">
                        <form action="{{ route('courseonline.edit', ['id'=>$course_detail->course_id]) }}" enctype="multipart/form-data" method="post" id="question-form">
                            @csrf
                            <div class="form-group">
                                <label for="cate_id"><u>หมวดอบรมออนไลน์</u></label>
                                <select class="form-control" name="cate_id">
                                    <option value="">ทั้งหมด</option>
                                    @foreach ($category as $cate_id => $cate_title)
                                        <option value="{{ $cate_id }}"
                                            {{ $course_detail->cate_id == $cate_id ? 'selected' : '' }}>
                                            {{ $cate_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="teacher_name"><u>ชื่อวิยากร</u></label>
                                <select class="form-control" name="teacher_name">
                                    <option value="{{ $course_detail->teacher->teacher_id ?? '-' }}">{{ $course_detail->teacher->teacher_name ?? '-'}}</option>
                                    @foreach($teacher as $t)
                                    <option value="{{ $t->teacher_id }}">{{ $t->teacher_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="course_title"><u>ชื่อหลักสูตรอบรมออนไลน์</u></label>
                                <input type="text" name="course_title" class="form-control" value="{{ $course_detail->course_title }}">
                            </div>
                            <div class="form-group">
                                <label for="course_short_title"><u>รายละเอียดย่อ</u></label>
                                <textarea name="course_short_title" id="summernote" class="form-control">{!!  htmlspecialchars_decode($course_detail->course_short_title) !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="course_detail"><u>รายละเอียด</u></label>
                                <textarea name="course_detail" id="summernote2" class="form-control">{{ htmlspecialchars_decode(htmlspecialchars_decode($course_detail->course_detail)) }}</textarea>
                            </div>

                            <div class="form-group">
                                <div class="col-4">
                                    <label for="retest_amount"><u>จำนวนครั้งที่สามารถสอบซ่อมได้</u><span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="retest_amount" value="{{ $course_detail->course_retest_amount }}">
                                </div>
                            </div>

                            <hr class="my-4" style="border-top: 2px solid #eee;">

                            <div class="form-group">
                                <label for=""><u>ระยะเวลาของหลักสูตร</u></label>
                                <div class="col-12 mt-2">
                                    <input type="checkbox" id="onboarding" name="onboarding" @checked($course_detail->is_onboarding ?? false)>
                                    <label for="onboarding">เป็นหลักสูตรสำหรับพนักงานใหม่<span class="text-danger">(หลักสูตรถาวร-หากเลือกแล้วช่องวันที่จะหายไป)</span></label>
                                </div>
                                <div id="date-select">
                                    <div class="my-2" >
                                        <label for="start_date" class="col-12">วันที่เริ่มหลักสูตร</label>
                                        <div class="col-4">
                                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $course_detail->start_date ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <label for="end_date" class="col-12">วันที่ปิดหลักสูตร</label>
                                        <div class="col-4">
                                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $course_detail->end_date ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div id="milestone-select" style="display: none;">
                                    <label for="">เลือกช่วงเดือนของหลักสูตรนี้</label>
                                    <div class="col-4">
                                        <select class="form-control" name="milestone" id="milestone">
                                            @php
                                                // ดึงค่า Milestone ออกมาพักไว้ก่อน เพื่อความสะอาดของโค้ด
                                                $currentMilestone = $course_detail->roadmapCourse?->milestone_days;

                                            @endphp
                                            <option value="30" {{ $currentMilestone == 30 ? 'selected' : '' }}>เดือนที่ 1</option>
                                            <option value="60" {{ $currentMilestone == 60 ? 'selected' : '' }}>เดือนที่ 2</option>
                                            <option value="90" {{ $currentMilestone == 90 ? 'selected' : '' }}>เดือนที่ 3</option>
                                            <option value="119" {{ $currentMilestone == 119 ? 'selected' : '' }}>เดือนที่ 4</option>
                                            <option value="999" {{ $currentMilestone == 999 ? 'selected' : '' }}>หลังเดือนที่ 4(ก่อนขึ้นเป็นพนังงานทั่วไป)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4" style="border-top: 2px solid #eee;">
                            <label class="d-block mb-2"><u>หัวข้อการประเมินศักยภาพ</u></label>
                            <div class="d-flex flex-wrap gap-4">
                                <div class="form-check d-inline-block me-4" style="margin-right: 10px;">
                                    <input class="form-check-input" type="checkbox" name="eval_knowledge" id="know" value="1" {{ $course_detail->courseWeight->eval_knowledge ? 'checked' : '' }}>
                                    <label class="form-check-label" for="know">1. ความรู้จากการฝึกอบรม</label>
                                </div>
                                <div class="form-check d-inline-block" style="margin-right: 10px;">
                                    <input class="form-check-input" type="checkbox" name="eval_skill" id="skill" value="1" {{ $course_detail->courseWeight->eval_skill ? 'checked' : '' }}>
                                    <label class="form-check-label" for="skill">2. ทักษะในการปฏิบัติงาน</label>
                                </div>
                                <div class="form-check d-inline-block" style="margin-right: 10px;">
                                    <input class="form-check-input" type="checkbox" name="eval_attitude" id="att" value="1" {{ $course_detail->courseWeight->eval_attitude ? 'checked' : '' }}>
                                    <label class="form-check-label" for="att">3. ทัศนคติที่มีต่อการปฏิบัติงาน</label>
                                </div>
                                <div class="form-check d-inline-block" style="margin-right: 10px;">
                                    <input class="form-check-input" type="checkbox" name="eval_problem_solv" id="prob" value="1" {{ $course_detail->courseWeight->eval_problem_solv ? 'checked' : '' }}>
                                    <label class="form-check-label" for="prob">4. การแก้ปัญหาในการทำงาน</label>
                                </div>
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="checkbox" name="eval_awareness" id="aware" value="1" {{ $course_detail->courseWeight->eval_awareness ? 'checked' : '' }}>
                                    <label class="form-check-label" for="aware">5. ความตระหนักในด้านการทำงาน</label>
                                </div>
                            </div>
                            <hr class="my-4" style="border-top: 2px solid #eee;">

                            <div class="form-group">
                                <label for=""><u>ผลกระทบต่อ License Person</u></label>
                                <div class="col-4 ml-2">
                                    <label for="">Operating Machine</label>
                                    <select class="form-control" name="op_mac_id" id="">
                                        <option value="">--ไม่มีรายการนี้--</option>
                                        @forelse ($licenseOperation as $operate)
                                            <option value="{{ $operate->id }}"{{ $course_detail->op_mac_id == $operate->id ? 'selected' : '' }}>
                                                            {{ $operate->operation_name }}</option>
                                        @empty
                                            <option value="">ไม่มีข้อมูล</option>
                                        @endforelse
                                    </select>
                                </div>

                                <div class="col-4 m-2">
                                    <label for="">Parameter Setting</label>
                                    <select class="form-control" name="par_st_id" id="">
                                        <option value="">--ไม่มีรายการนี้--</option>
                                        @forelse ($licenseParameter as $parameter)
                                            <option value="{{ $parameter->id }}"{{ $course_detail->par_st_id == $parameter->id ? 'selected' : '' }}>{{ $parameter->parameter_name }}</option>
                                        @empty
                                            <option value="">ไม่มีข้อมูล</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for=""><u>เกณฑ์นํ้าหนักคะแนน<span class="text-danger">(ไม่จำเป็นต้องใส่หมดใส่เท่าที่หลักสูตรกำหนด)</span></u></label>
                                <div class="row m-2">
                                    <label class="col-1">ถาม-ตอบ:</label>
                                        <div class="col-sm-2">
                                            <input class="form-control form-control-sm" type="number" placeholder="0" name="w_q_and_a" value="{{ $course_detail->courseWeight->q_a_weight ?? '' }}">
                                        </div>
                                    <div class="col-sm-1 p-0">%</div>
                                </div>

                                <div class="row m-2">
                                    <label class="col-1">ปฏิบัติจริง:</label>
                                    <div class="col-sm-2">
                                        <input class="form-control form-control-sm" type="number" placeholder="0" name="w_operate" value="{{ $course_detail->courseWeight->operate_weight ?? '' }}">
                                    </div>
                                    <div class="col-sm-1 p-0">%</div>
                                </div>

                                <div class="row m-2">
                                    <label class="col-1">สังเกตุ:</label>
                                    <div class="col-sm-2">
                                        <input class="form-control form-control-sm" type="number" placeholder="0" name="w_observe" value="{{ $course_detail->courseWeight->observe_weight ?? '' }}">
                                    </div>
                                    <div class="col-sm-1 p-0">%</div>
                                </div>

                                <div class="row m-2">
                                    <label class="col-1">ข้อสอบ:</label>
                                    <div class="col-sm-2">
                                        <input class="form-control form-control-sm" type="number" placeholder="0" name="w_exam" value="{{ $course_detail->courseWeight->exam_weight ?? '' }}">
                                    </div>
                                    <div class="col-sm-1 p-0">%</div>
                                </div>

                                <div class="row m-2">
                                    <label class="col-1">ผลงาน:</label>
                                    <div class="col-sm-2">
                                        <input class="form-control form-control-sm" type="number" placeholder="0" name="w_assign" value="{{ $course_detail->courseWeight->assign_weight ?? '' }}">
                                    </div>
                                    <div class="col-sm-1 p-0">%</div>
                                </div>
                            </div>

                            <hr class="my-4" style="border-top: 2px solid #eee;">

                            <div class="form-group" id="org-select">
                                <label for=""><u>เลือกสายที่ต้องการให้เห็นหลักสูตร</u></label>
                                <div class="form-group" id="org_jstree"></div>
                            </div>

                            <div class="form-group">
                                <label for="course_note"><u>หมายเหตุ</u></label>
                                <input type="text" name="course_note" class="form-control" value="{{ $course_detail->course_note }}">
                            </div>

                            <div class="form-group">
                                <div id="picture_show" style="">
                                    ภาพประกอบ <br>
                                    <img src="{{ asset('images/uploads/courseonline/'.$course_detail->course_id.'/original/'.$course_detail->course_picture) }}" name="course_picture"><br><br>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="course_picture"><u>รูปภาพ</u></label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="input-append">
                                        <div class="uneditable-input span3">
                                            <i class="icon-file fileupload-exists"></i>
                                            <span class="fileupload-preview"></span>
                                        </div>
                                        <img id="previewImage" src="#" alt="Preview Image" style="display: none;">
                                        <span class="btn btn-default btn-file">
                                            <span class="fileupload-new">Select file</span>
                                            <span class="fileupload-exists">Change</span>
                                            <input id="ytNews_cms_picture" type="hidden" value="{{$course_detail->course_picture}}" name="course_picture">
                                            <input name="image" id="imageInput"  type="file" >
                                        </span>
                                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                        {{-- <input type="file" id="imageInput" name="image"> --}}

                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            var imageInput = document.getElementById('imageInput');
                                            var previewImage = document.getElementById('previewImage');

                                            imageInput.addEventListener('change', function() {
                                                previewImageFile(this);
                                            });

                                            function previewImageFile(input) {
                                                var file = input.files[0];
                                                if (file) {
                                                    var reader = new FileReader();
                                                    reader.onload = function(e) {
                                                        previewImage.src = e.target.result;
                                                        previewImage.style.display = 'block';
                                                    };
                                                    reader.readAsDataURL(file);
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="form-group">
                                <font color="#990000">
                                    รูปภาพควรมีขนาด 250x180(แนวนอน) หรือ ขนาด 250x(xxx) (แนวยาว)
                                </font>
                            </div>

                            <input type="hidden" name="org_ids" id="org_ids">

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
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
        });

    $(document).ready(function() {
        $('#summernote2').summernote();
        });
    $(document).ready(function() {
        if($('#onboarding').is(':checked')){
            $('#date-select').hide();
        }

        $('#onboarding').change(function(){
            if($(this).is(':checked')){
                $('#date-select').hide();
                $('#milestone-select').show();
                $('#onboarding-note').show();
            }else{
                $('#date-select').show();
                $('#milestone-select').hide();
                $('#onboarding-note').hide();
            }
        }).trigger('change');
    });
    $(document).ready(function () {
        var OrgChartTree = @json($orgtree);
        // console.log(OrgChartTree);
        $('#org_jstree').jstree({
            'core': {
            'data': OrgChartTree, // ใช้ข้อมูลที่เรา map มา
            'themes': {
                'dots': true, // มีเส้นประเชื่อมกิ่งเหมือน Registry Editor
                'icons': true,
                'responsive': true,
            }
        },
        'plugins': ["checkbox"] // เพิ่ม wholerow ให้จิ้มง่าย และ search ให้ค้นหาได้
        });

        $('#org_jstree').on("changed.jstree", function (e, data) {
            const tree = data.instance;

            const leafNodes = data.selected.filter(id => {
                return tree.is_leaf(id);
            })
            // console.log(leafNodes);
            $('#org_ids').val(leafNodes.join(','));
        });
    });
</script>
</body>
@endsection
