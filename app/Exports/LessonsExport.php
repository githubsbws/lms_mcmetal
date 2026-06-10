<?php

namespace App\Exports;

use App\Models\Lesson;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LessonsExport implements FromCollection, WithHeadings
{
    private $courseId;

    public function __construct($courseId)
    {
        $this->courseId = $courseId;
    }

    public function collection()
    {
        return Lesson::where('course_id', $this->courseId)
                     ->where('active', 'y')
                     ->orderBy('course_id', 'DESC')
                     ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Course ID',
            'Lesson Title',
            'Active',
            'Created At',
            'Updated At',
        ];
    }
}
