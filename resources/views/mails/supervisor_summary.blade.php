<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px;">
<div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">

    {{-- Header --}}
    <div style="background-color: #1F7BCC; padding: 20px 30px;">
        <h2 style="color: white; margin: 0; font-size: 18px;">รายงานสรุปการเรียนประจำสัปดาห์</h2>
        <p style="color: rgba(255,255,255,0.8); margin: 5px 0 0 0; font-size: 13px;">ประจำวันที่ {{ $runDate }}</p>
    </div>

    {{-- Body --}}
    <div style="padding: 25px 30px;">
        <p style="color: #333; font-size: 15px;">เรียน คุณ {{ ' '.$supervisorName }},</p>

        {{-- Section 1: คอสที่กำลังจะเปิด --}}
        <h3 style="color: #1F7BCC; font-size: 15px; border-bottom: 2px solid #1F7BCC; padding-bottom: 8px;">
            หลักสูตรที่กำลังจะเปิดเรียน (อีก 14 วัน)
        </h3>

        @if(!empty($openingCourses))
            <ol style="margin: 0 0 20px 0; padding-left: 20px; color: #333; font-size: 14px; line-height: 1.8;">
                @foreach($openingCourses as $course)
                    <li>{{ $course['course_title'] }} (เปิด {{ $course['start_date'] }})</li>
                @endforeach
            </ol>
        @else
            <p style="color: #888; font-size: 14px; margin-bottom: 20px;">-</p>
        @endif

        {{-- Section 2: พนักงานทั่วไปที่ยังไม่ครบ --}}
        <h3 style="color: #dc3545; font-size: 15px; border-bottom: 2px solid #dc3545; padding-bottom: 8px;">
            รายชื่อพนักงานทั่วไปที่ยังเรียนไม่ครบ
        </h3>

        @php
            $generalStaff = collect($staffList)->where('staff_type', 'general')->values();
        @endphp

        @if($generalStaff->isNotEmpty())
            <table style="width: 100%; border-collapse: collapse; font-size: 14px; margin-bottom: 20px;">
                <thead>
                    <tr style="background-color: #f8f9fa;">
                        <th style="padding: 8px 12px; text-align: left; border-bottom: 1px solid #dee2e6; width: 30px;">#</th>
                        <th style="padding: 8px 12px; text-align: left; border-bottom: 1px solid #dee2e6; width: 120px;">รหัสพนักงาน</th>
                        <th style="padding: 8px 12px; text-align: left; border-bottom: 1px solid #dee2e6;">ชื่อ - นามสกุล</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($generalStaff as $index => $staff)
                        <tr style="background-color: {{ $index % 2 === 0 ? '#ffffff' : '#f9f9f9' }};">
                            <td style="padding: 8px 12px; border-bottom: 1px solid #e2e8f0; color: #888;">{{ $index + 1 }}</td>
                            <td style="padding: 8px 12px; border-bottom: 1px solid #e2e8f0; font-family: monospace; color: #555;">{{ $staff['staff_id'] }}</td>
                            <td style="padding: 8px 12px; border-bottom: 1px solid #e2e8f0; color: #333; font-weight: 500;">{{ $staff['staff_fullname'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #888; font-size: 14px; margin-bottom: 20px;">-</p>
        @endif

        {{-- Section 3: พนักงานใหม่ที่ยังไม่ครบ --}}
        <h3 style="color: #fd7e14; font-size: 15px; border-bottom: 2px solid #fd7e14; padding-bottom: 8px;">
            รายชื่อพนักงานใหม่ที่ยังเรียนไม่ครบ
        </h3>

        @php
            $newStaff = collect($staffList)->where('staff_type', 'new')->values();
        @endphp

        @if($newStaff->isNotEmpty())
            <table style="width: 100%; border-collapse: collapse; font-size: 14px; margin-bottom: 20px;">
                <thead>
                    <tr style="background-color: #f8f9fa;">
                        <th style="padding: 8px 12px; text-align: left; border-bottom: 1px solid #dee2e6; width: 30px;">#</th>
                        <th style="padding: 8px 12px; text-align: left; border-bottom: 1px solid #dee2e6; width: 120px;">รหัสพนักงาน</th>
                        <th style="padding: 8px 12px; text-align: left; border-bottom: 1px solid #dee2e6;">ชื่อ - นามสกุล</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($newStaff as $index => $staff)
                        <tr style="background-color: {{ $index % 2 === 0 ? '#ffffff' : '#f9f9f9' }};">
                            <td style="padding: 8px 12px; border-bottom: 1px solid #e2e8f0; color: #888;">{{ $index + 1 }}</td>
                            <td style="padding: 8px 12px; border-bottom: 1px solid #e2e8f0; font-family: monospace; color: #555;">{{ $staff['staff_id'] }}</td>
                            <td style="padding: 8px 12px; border-bottom: 1px solid #e2e8f0; color: #333; font-weight: 500;">{{ $staff['staff_fullname'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #888; font-size: 14px; margin-bottom: 20px;">-</p>
        @endif

        <p style="color: #888; font-size: 12px; margin-top: 20px;">
            * อีเมลนี้ถูกส่งอัตโนมัติทุกสัปดาห์ กรุณาอย่าตอบกลับ
        </p>
    </div>

    {{-- Footer --}}
    <div style="background-color: #f8f9fa; padding: 15px 30px; border-top: 1px solid #e2e8f0; text-align: center;">
        <p style="color: #aaa; font-size: 12px; margin: 0;">Toyoseikan E-Learning System © {{ date('Y') }}</p>
    </div>

</div>
</body>
</html>
