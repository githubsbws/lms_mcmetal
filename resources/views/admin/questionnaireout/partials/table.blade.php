<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ชื่อหลักสูตร</th>
            <th>ชื่อ - นามสกุล</th>
            <th>สถานะ</th>
            <th>จัดการ</th>
        </tr>
    </thead>
    <tbody>
        @forelse($results as $item)
        <tr>
            <td class="text-center">{{ $item->course_title }}</td>
            <td class="text-center">{{ $item->firstname ?? '-' }} - {{ $item->lastname ?? '-' }}</td>
            <td class="text-center">
                @if($item->passcours_status === 'pass')
                    <span class="badge badge-success">กรอกข้อมูลแล้ว</span>
                @else
                    <span class="badge badge-danger">ยังไม่ได้กรอกข้อมูล</span>
                @endif
            </td>
            <td class="text-center">

               <button class="btn btn-primary btn-sm detail-button"
                        data-id="{{ $item->passcours_id }}">
                    <i class="fas fa-eye"></i> จัดการ
                </button>

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">ไม่พบข้อมูล</td>
        </tr>
        @endforelse
    </tbody>
</table>