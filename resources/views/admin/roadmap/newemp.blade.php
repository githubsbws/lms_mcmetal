@extends('admin/layouts/mainlayout')
@section('title', 'Admin')
@section('content')
<body>
    <div id="warpper">
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <h4 class="m-0">ระบบRoadmapสำหรับพนังงานใหม่</h4>
                        </div>
                        <div class="ml-3">
                            <a href="{{route('admin')}}">
                                <button class="btn btn-warning d-flex align-items-center">
                                    <i class="fas fa-angle-left mr-2"></i>
                                    หน้าหลัก
                                </button>
                            </a>
                        </div>
                    </div>

                    <div class="card shadow-sm mt-4">
                        <div class="card-header bg-white">
                            <h5 class="card-title m-0 text-dark">
                                Roadmap ทั้งหมดของ
                                <span class="badge badge-primary px-3 py-2 ml-1 shadow-sm" style="font-size: 1rem; border-radius: 8px; background: linear-gradient(45deg, #007bff, #0056b3);">
                                    <i class="fas fa-building mr-1"></i> {{ Auth::user()->Department->title }}
                                </span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="input-group shadow-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-search text-muted"></i></span>
                                        </div>
                                        <input type="text" id="roadmapSearch" class="form-control border-left-0" placeholder="พิมพ์เพื่อค้นหา Roadmap หรือสายงาน...">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="roadmapContainer">
                                @fragment('roadmap-cards')
                                    @forelse($newEmpRoadmap as $roadmap)
                                        <div class="col-md-4 col-sm-6 mb-4">
                                            <a href="{{ route('roadmap.newemp.detail',$roadmap->id) }}" class="text-decoration-none">
                                                <div class="card h-100 shadow-sm roadmap-card border-0">
                                                    <div class="card-body p-4">
                                                        <h5 class="text-dark font-weight-bold mb-3" style="font-size: 1.1rem;">
                                                            <i class="fas fa-route text-primary mr-2"></i> {{ $roadmap->name }}
                                                        </h5>

                                                        <hr class="my-3"> <div class="d-flex justify-content-between align-items-center">
                                                            <div class="text-muted">
                                                                <i class="fas fa-book-open mr-1"></i>
                                                                <span class="small">จำนวน</span>
                                                                <strong class="text-dark">{{ $roadmap->roadmapCourse->count() }}</strong>
                                                                <span class="small">หลักสูตร</span>
                                                            </div>

                                                            <div class="text-info font-weight-bold small">
                                                                รายละเอียด <i class="fas fa-chevron-right ml-1" style="font-size: 0.7rem;"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center py-5">
                                            <p class="mt-3 text-muted font-italic">ไม่พบข้อมูล Roadmap สำหรับแผนกของคุณ</p>
                                        </div>
                                    @endforelse
                                @endfragment
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
$('#roadmapSearch').on('input', function() {
    let val = $(this).val();
    let url = "{{ route('roadmap.newemp.index') }}";

    // ถ้าไม่อยากให้ยิงตอนช่องว่าง ก็ดัก if (val !== "") { ... }
    // แต่ปกติแนะนำให้ยิงไปเลย เพราะถ้า val เป็นว่าง Controller จะคืนค่าทั้งหมดมาให้เอง (เพราะ when ไม่ทำงาน)
    $.ajax({
        url: url,
        type: "GET",
        data: { search: val },
        success: function(data) {
            $('#roadmapContainer').html(data);
        }
    });
});
</script>
@endsection
