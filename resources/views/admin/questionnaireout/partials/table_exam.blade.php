<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="text-center">ชื่อหลักสูตร</th>
            <th class="text-center">ชื่อ - นามสกุล</th>
            <th class="text-center">สถานะ</th>
            <th class="text-center">จัดการ</th>
        </tr>
    </thead>

    <tbody>

        @forelse($results as $item)

        <tr>

            <td class="text-center">
                {{ $item->course_title }}
            </td>

            <td class="text-center">
                {{ $item->firstname ?? '-' }}
                {{ $item->lastname ?? '-' }}
            </td>

            <td class="text-center">

                @if($item->status == 'wait')

                    <span class="badge badge-warning">
                        {{ $item->status_text }}
                    </span>

                @elseif($item->status == 'pass')

                    <span class="badge badge-success">
                        {{ $item->status_text }}
                    </span>

                @elseif($item->status == 'fail')

                    <span class="badge badge-danger">
                        {{ $item->status_text }}
                    </span>

                @else

                    <span class="badge badge-secondary">
                        -
                    </span>

                @endif

            </td>

            <td class="text-center">

                <button class="btn btn-primary btn-sm check-button"
                        data-course="{{ $item->course_id }}"
                        data-user="{{ $item->user_id }}">

                    <i class="fas fa-file-alt"></i>
                    ตรวจข้อสอบ

                </button>

            </td>

        </tr>

        @empty

        <tr>
            <td colspan="4" class="text-center">
                ไม่พบข้อมูล
            </td>
        </tr>

        @endforelse

    </tbody>
</table>