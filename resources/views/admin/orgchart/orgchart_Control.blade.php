
<script src="{{ asset('js/app.js') }}"></script>

@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
@php
use App\Models\Orgcourse;
use App\Models\Course;
@endphp
<body class="">
	
    <style type="text/css">
/**
 * Nestable
 */

.dd { position: relative; display: block; margin: 0; padding: 0; max-width: 600px; list-style: none; font-size: 13px; line-height: 20px; background: #fff; min-height: 100px }

.dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
.dd-list .dd-list { padding-left: 30px; }
.dd-collapsed .dd-list { display: none; }

.dd-item,
.dd-empty,
.dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

.dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd-handle:hover { color: #2ea8e5; background: #fff; }

.dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
.dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
.dd-item > button[data-action="collapse"]:before { content: '-'; }

.dd-placeholder,
.dd-empty { 
    margin: 5px 0; 
    padding: 0; 
    min-height: 30px; 
    background: #fff; 
    /*border: 1px dashed #b6bcbf; */
    box-sizing: border-box; 
    -moz-box-sizing: border-box; 
}
.dd-empty { 
   /* border: 1px dashed #bbb; */
    min-height: 100px; 
    background-color: #fff;
    /*background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                      -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                         -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                              linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;*/
}

.dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
.dd-dragel > .dd-item .dd-handle { margin-top: 0; }
.dd-dragel .dd-handle {
    -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
}

/**
 * Nestable Extras
 */

.nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; border: 0; border-top: 2px solid #ddd; border-bottom: 2px solid #ddd; }

#nestable-menu { padding: 0; margin: 20px 0; }

#nestable-output,
#nestable2-output { width: 100%; height: 7em; font-size: 0.75em; line-height: 1.333333em; font-family: Consolas, monospace; padding: 5px; box-sizing: border-box; -moz-box-sizing: border-box; }

#nestable2 .dd-handle {
    color: #fff;
    border: 1px solid #999;
    background: #bbb;
    background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
    background:    -moz-linear-gradient(top, #bbb 0%, #999 100%);
    background:         linear-gradient(top, #bbb 0%, #999 100%);
}
#nestable2 .dd-handle:hover { background: #bbb; }
#nestable2 .dd-item > button:before { color: #fff; }


.dd-hover > .dd-handle { background: #2ea8e5 !important; }

/**
 * Nestable Draggable Handles
 */

.dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
    background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd3-content:hover { color: #2ea8e5; background: #fff; }

.dd-dragel > .dd3-item > .dd3-content { margin: 0; }

.dd3-item > button { margin-left: 30px; }

.dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
    border: 1px solid #aaa;
    background: #ddd;
    background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
    background:         linear-gradient(top, #ddd 0%, #bbb 100%);
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
.dd3-handle:hover { background: #ddd; }

    </style>
	<div id="wrapper">
		<div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">Org Courses</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('admin')}}">
                                <button class="btn btn-warning d-flex align-items-center">
                                    <i class="fas fa-angle-left mr-2"></i>
                                    กลับหน้าหลัก
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="cf nestable-lists">
                        <div class="row buttons">
                            <a class="btn btn-primary btn-icon glyphicons ok_2" href="{{route('orgchart.users',['org_id' => $org->id])}}"><i></i>จัดการผู้ใช้</a>
                        </div>
                    <div class="row g-3">

                    <div class="col">
                        <div class="dd" id="nestable">
                            <?php
                            $org_course = Orgcourse::where('active', 'y')
                                        ->where('orgchart_id', $org->id)
                                        ->orderBy('parent_id')
                                        ->orderBy('order') // จัดเรียงตาม parent_id และ order
                                        ->get();
                            ?>
                            <strong>หลักสูตรที่เลือก</strong>
                            <ol class="dd-list" id="selectedCourses">
                                @foreach($org_course as $oc)
                                    @php 
                                        $course = Course::where('course_id', $oc->course_id)->first();
                                    @endphp
                                    @if($oc->order !== '1')
                                    <li class="dd-item" data-id="{{ $oc->id }}">
                                        <div class="dd-handle">{{ $course->course_title }}</div>

                                        @php $children = $sub_courses->where('parent_id', $oc->id); @endphp
                                        @if($children->isNotEmpty())
                                            <ol class="dd-list">
                                                @foreach($children as $sub)
                                                    @php $sub_course = Course::where('course_id', $sub->course_id)->first(); @endphp
                                                    <li class="dd-item" data-id="{{ $sub->id }}">
                                                        <div class="dd-handle">{{ $sub_course->course_title }}</div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        @endif
                                    </li>
                                    @endif
                                @endforeach
                            </ol>
                            @if($org_course->isEmpty())
                                <div class="dd-empty">ยังไม่มีหลักสูตรที่เลือก</div>
                            @endif
                        </div>
                    </div>

                    <div class="col">
                    <div class="dd" id="nestable2">
                                    <?php
                                    $courses = Course::where('active', 'y')->get();
                                    ?>
                                    <strong>หลักสูตรทั้งหมด</strong>
                                    <ol class="dd-list" id="allCourses">
                                        @foreach($courses as $course)
                                            @php
                                                $used = $org_course
                                                ->where('course_id', $course->course_id)
                                                ->where('orgchart_id', $org->id)
                                                ->first();
                                            @endphp
                                            @if(!$used)
                                                <li class="dd-item" data-id="{{ $course->course_id }}">
                                                    <div class="dd-handle">{{ $course->course_title }}</div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ol>
                                </div>
                        </div>
                    </div>

                            
                    </div>



                        <div style="clear:both;"></div>
                </div>
            </div>
    </div>
</div>

<div class="clearfix"></div>


<script src="{{ asset('js/sortable.js') }}"></script>
<script>
    $(document).on("click", ".open-modal", function () {
        var url = $(this).data('url');
        $("#myModals iframe").attr("src", url);
    });
</script>
<script>
    const selectedList = document.getElementById('selectedCourses');
    new Sortable(document.getElementById('allCourses'), {
        group: {
            name: 'shared',
            pull: 'clone', // สามารถลากออกมาได้
            put: true     // ห้ามลากกลับเข้าไป
        },
        sort: false,
         onAdd: function (evt) {
            const courseId = evt.item.dataset.id;
            activen(courseId); // เรียกฟังก์ชันเพื่อบันทึก
        }
    });

    new Sortable(selectedList, {
        group: {
            name: 'shared',
            pull: true,
            put: true
        },
        animation: 150,
        onAdd: function (evt) {
            const courseId = evt.item.dataset.id;
            activey(courseId);
        }
    });
    function activey(id) {
        var route = "{{ route('orgchart.y', ['id' => ':id','org_id' => $org->id]) }}";
        var csrf_token = "{{ csrf_token() }}";

        // แทนที่ :id ด้วยค่า id ที่ได้รับ
        route = route.replace(':id', id);

        fetch(route, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf_token,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            console.log("เพิ่มคอร์สแล้ว:", data);
        })
        .catch(error => {
            // console.log(error);
            console.error("error", error)
        });
    }
    function activen(id) {
        var route = "{{ route('orgchart.n', ['id' => ':id']) }}";
        var csrf_token = "{{ csrf_token() }}";

        // แทนที่ :id ด้วยค่า id ที่ได้รับ
        route = route.replace(':id', id);

        fetch(route, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf_token,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            // console.log(data);
            console.log("ลบคอร์สแล้ว:", data);
        })
        .catch(error => {
            // console.log(error);
            console.error("error", error)
        });
    }
    function saveSubCourses() {
        const items = selectedList.querySelectorAll('.dd-item');
        const course_ids = Array.from(items).map(item => item.dataset.id);
        const route = "{{ route('orgchart.course', ['id' => ':id']) }}";

        route = route.replace(':id', id);

        fetch(route, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ chk: course_ids })
        })
        .then(res => res.json())
        .then(data => console.log("บันทึกแล้ว:", data))
        .catch(error => console.error("เกิดข้อผิดพลาด", error));
    }
</script>
</body>
@endsection

