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
                            <h5 class="card-title m-0 text-dark">ชื่อRoadmap: <span class="badge badge-primary px-3 py-2 ml-1 shadow-sm" style="font-size: 1rem; border-radius: 8px; background: linear-gradient(45deg, #007bff, #0056b3);">{{ $roadmapCourse->name }}</span></h5>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $months =  \App\Models\Roadmap::getMilestones();
                            $groupedData = ($roadmapCourse->roadmapCourse ?? collect())->groupBy('milestone_days');
                        @endphp
                        <div class="card-body bg-white p-0">
                            <table class="table table-hover table-striped mb-0" id="sortableTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%" class="text-center">No.</th>
                                        <th width="30%" class="text-center">ชื่อหลักสูตร</th>
                                        <th width="20%" class="text-center">ลำดับการเรียน</th>
                                        <th width="25%">ช่วงเดือนของหลักสูตร</th>
                                        <th width="10%" class="text-center"><i class="fas fa-arrows-alt"></i></th>
                                    </tr>
                                </thead>
                                <tbody id="roadmapItems">
                                    @foreach($roadmapCourse->roadmapCourse->sortBy('order') as $index => $item)
                                        <tr class="sortable-row" data-id="{{ $item->id }}">
                                            <td class="text-center text-muted small no-order">{{ $index + 1 }}</td>
                                            <td class="text-center">
                                                <strong>{{ $item->course->course_title }}</strong>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-secondary badge-order">{{ $item->order }}</span>
                                            </td>
                                            <td>
                                                @php
                                                    $milestone = collect($months)->firstWhere('val', $item->milestone_days);
                                                @endphp
                                                <span class="text-{{ $milestone['color'] ?? 'secondary' }}">
                                                    <i class="fas fa-calendar-alt mr-1"></i> {{ $milestone['title'] ?? 'ไม่ระบุ' }}
                                                </span>
                                            </td>
                                            <td class="text-center text-muted">
                                                <i class="fas fa-grip-vertical handle" style="cursor: move;"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer bg-white border-top-0 py-3">
                                <button id="saveOrderBtn" class="btn btn-success px-4 shadow-sm">
                                    <i class="fas fa-save mr-1"></i> บันทึกลำดับใหม่
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const el = document.getElementById('roadmapItems');

        // เริ่มต้นการลากวาง
        const sortable = new Sortable(el, {
            animation: 150,

            ghostClass: 'bg-light', // สีตอนที่กำลังลาก
            onEnd: function() {
                // เมื่อลากจบ ให้รันเลขลำดับที่โชว์บนหน้าเว็บใหม่ (UI เท่านั้น)
                $('.no-order').each(function(index) {
                    $(this).text(index + 1);
                });

                $('.badge-order').each(function(index) {
                    $(this).text(index + 1);
                });
            }
        });

        // เมื่อกดปุ่มบันทึก
        $('#saveOrderBtn').on('click', function() {
            let orderData = [];

            // วนลูปเก็บ ID ตามลำดับใหม่ที่ลากไว้
            $('#roadmapItems tr').each(function(index) {
                orderData.push({
                    id: $(this).data('id'),
                    order: index + 1
                });
            });

            // ส่ง AJAX ไปบันทึกที่หลังบ้าน
            $.ajax({
                url: "{{ route('admin.roadmap.updateOrder') }}", // สร้าง Route นี้รอไว้เลย
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    orders: orderData
                },
                success: function(response) {
                    alert('บันทึกลำดับเรียบร้อยแล้ว!');
                    location.reload(); // รีโหลดเพื่อให้ลำดับใน DB กับหน้าจอตรงกัน
                }
            });
        });
    });
</script>
@endsection
