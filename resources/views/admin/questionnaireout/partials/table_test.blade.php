<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ชื่อหลักสูตร</th>
            <th>ชื่อ - นามสกุล</th>
            <th>จัดการ</th>
        </tr>
    </thead>
    <tbody>
        @forelse($results as $item)
        <tr>
            <td class="text-center">{{ $item->course_title }}</td>
            <td class="text-center">{{ $item->firstname ?? '-' }} - {{ $item->lastname ?? '-' }}</td>
            <td class="text-center">

               <button class="btn btn-danger btn-sm reset-button"
                        data-course="{{ $item->course_id }}"
                        data-user="{{ $item->user_id }}">
                    <i class="fas fa-undo"></i> รีเซตผลสอบ
                </button>

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">ไม่พบข้อมูล</td>
        </tr>
        @endforelse
    </tbody>
</table>
