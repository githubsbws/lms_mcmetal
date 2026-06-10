@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')

<body class="">

    <!-- Main Container Fluid -->
    <div class="container-fluid fluid menu-left">

        <!-- Top navbar -->
        @include('admin.layouts.partials.top-nav')
        <!-- Top navbar END -->

        <!-- Sidebar menu & content wrapper -->
        <div id="wrapper">

            <!-- Sidebar Menu -->
            @include('admin.layouts.partials.menu-left')
            <!-- // Sidebar Menu END -->

            <!-- Content -->
            <div id="content">
                <ul class="breadcrumb">
                    <li><a href="/admin/index.php">หน้าหลัก</a></li> » <li><a href="/admin/index.php/faq/index">คำถามที่พบบ่อย</a></li> »
                    <li>แก้ไขคำถาม</li>
                </ul><!-- breadcrumbs -->
                <div class="separator bottom"></div>

                <!-- innerLR -->
                <div class="innerLR">
                    <div class="widget widget-tabs border-bottom-none">
                        <div class="widget-head">
                            <ul>
                                <li class="active">
                                    <a class="glyphicons edit" href="#account-details" data-toggle="tab">
                                        <i></i>แก้ไขคำถาม</a>
                                </li>
                            </ul>
                        </div>
                        <div class="widget-body">
                            <div class="form">
                                <form enctype="multipart/form-data" id="faq_edit" action="{{route('faq.edit',['id' =>$faq_edit_page->faq_nid_])}}" method="post">
                                    @csrf
                                    <input type="hidden" name="faq_nid_" value="{{ $faq_edit_page->faq_nid_ }}"> <!-- ตัวอย่างการเพิ่ม input hidden เพื่อเก็บ ID ของคำถาม -->

                                    <p class="note">ค่าที่มี <span style="margin:0;" class="btn-action single glyphicons circle_question_mark"><i></i></span> จำเป็นต้องใส่ให้ครบ</p>

                                    <div class="row">
                                        <label for="faq_type_id" class="required">หมวดหมู่คำถาม <span class="required">*</span></label>
                                        <select class="span8 custom-dropdown" name="faq_type_id" id="faq_type_id">
                                            @foreach($faq_types as $key => $value)
                                                <option value="{{ $value->faq_type_id }}" {{ $faq_edit_page->faq_type_id == $value->faq_type_id ? 'selected' : '' }}>{{ $value->faq_type_title_TH }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="row">
                                        <label for="faq_THtopic" class="required">ชื่อหัวข้อคำถาม <span class="required">*</span></label>
                                        <input size="60" maxlength="250" class="span8" name="faq_THtopic" id="faq_THtopic" type="text" value="{{ $faq_edit_page->faq_THtopic }}">
                                    </div>

                                    <div class="row">
                                        <label for="faq_THanswer" class="required">คำตอบ <span class="required">*</span></label>
                                        {{-- {!! htmlspecialchars_decode($faq_edit_page->faq_THanswer) !!} --}}
                                        <div id="microtextbox-cms-detail" style="height: 1000px"></div>
                                        {{-- <textarea class="span8" name="faq_THanswer" id="faq_THanswer" rows="6">{{ $faq_edit_page->faq_THanswer }}</textarea> --}}
                                    </div>

                                    <div class="row buttons">
                                        <button class="btn btn-primary btn-icon glyphicons ok_2"><i></i>บันทึกข้อมูล</button>
                                    </div>
                                </form>
                            </div><!-- form -->
                        </div>
                    </div>
                </div>
                <!-- END innerLR -->

                <div id="sidebar">
                </div><!-- sidebar -->
            </div>
            <!-- // Content END -->

        </div>
        <div class="clearfix"></div>
        <!-- // Sidebar menu & content wrapper END -->

        <div id="footer" class="hidden-print">
            <!--  Copyright Line -->
            <div class="copy">© 2023 - All Rights Reserved.</a></div>
            <!--  End Copyright Line -->
        </div>
        <!-- // Footer END -->

    </div>
    @php
    $text = htmlspecialchars_decode(htmlspecialchars_decode($faq_edit_page->faq_THanswer));
	@endphp

   <script>
	var text = {!! json_encode($text) !!};
	const mtextboxConfig = {
		target: [
			{
				id: 'microtextbox-cms-detail',
				name: 'faq_THanswer',
				options: {
					placeholder: text,
                    body : '{!! $text !!}'
				},
			}
		],
	}
</script>
</body>

@endsection
