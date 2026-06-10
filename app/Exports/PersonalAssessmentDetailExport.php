<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Events\AfterSheet;

class PersonalAssessmentDetailExport implements
    FromArray,
    WithStyles,
    WithEvents
{
    protected $user;
    protected $assessments;

    public function __construct($user, $assessments)
    {
        $this->user = $user;
        $this->assessments = $assessments;
    }

    public function array(): array
    {
        $rows = [];

        /*
        |--------------------------------------------------------------------------
        | TITLE
        |--------------------------------------------------------------------------
        */

        $rows[] = [
            'แบบแจ้งและประเมินผลการฝึกอบรมตามตำแหน่งงาน'
        ];

        /*
        |--------------------------------------------------------------------------
        | EMPTY
        |--------------------------------------------------------------------------
        */

        $rows[] = [];

        /*
        |--------------------------------------------------------------------------
        | USER INFO HEADER
        |--------------------------------------------------------------------------
        */

        $rows[] = [
            'ชื่อ - สกุล',
            $this->user->Profiles->firstname.' '.$this->user->Profiles->lastname,
            '',
            '',
            
            'รหัส',
            $this->user->username,

            'ตำแหน่ง',
            optional($this->user->Orgchart)->title,
            'แผนก',
            optional($this->user->Department)->title,
            '',
            '',
            ''
        ];

        /*
        |--------------------------------------------------------------------------
        | EMPTY
        |--------------------------------------------------------------------------
        */

        $rows[] = [];

        /*
        |--------------------------------------------------------------------------
        | TABLE HEADER ROW 1
        |--------------------------------------------------------------------------
        */

        $rows[] = [

            'ลำดับที่',
            'หมวดวิชา',
            'หัวข้อการอบรม',
            'วัน/เดือน/ปี',
            
            'วิธีการประเมิน',
            '',
            '',
            '',

            'คะแนน',

            'ผลการประเมิน',
            '',

            'หมายเหตุ'
        ];

        /*
        |--------------------------------------------------------------------------
        | TABLE HEADER ROW 2
        |--------------------------------------------------------------------------
        */

        $rows[] = [

            '', // A
            '', // B
            '', // C
            '', // D

            'ถาม-ตอบ', // E
            'ปฏิบัติ', // F
            'ข้อสอบ', // G
            'ผลงาน',  // H

            '', // I = คะแนน

            'ผ่าน', // J
            'ไม่ผ่าน', // K

            ''

        ];

        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        foreach($this->assessments as $index => $assessment){

            $pass = '';
            $fail = '';

            if($assessment->level == 3){
                $pass = '✔';
            }else{
                $fail = '✖';
            }

            $rows[] = [

                $index + 1,
                'Orientation',
                $assessment->course_name,
                $assessment->assessment_date,

                $assessment->qa_score,
                $assessment->operate_score,
                $assessment->assign_score,
                $assessment->observe_score,

                $assessment->total_score.'%',

                $pass,
                $fail,

                ''
            ];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet)
    {
        return [

            // Title
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 16
                ]
            ],

            // Table Header
            5 => [
                'font' => [
                    'bold' => true
                ]
            ]
        ];
    }

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function(AfterSheet $event){

            $sheet = $event->sheet->getDelegate();

            /*
            |--------------------------------------------------------------------------
            | Merge Title
            |--------------------------------------------------------------------------
            */

            $sheet->mergeCells('A1:L1');

            /*
            |--------------------------------------------------------------------------
            | Merge User Info
            |--------------------------------------------------------------------------
            */


            // Header
            $sheet->mergeCells('A3:A4');
            $sheet->mergeCells('B3:B4');
            $sheet->mergeCells('C3:C4');
            $sheet->mergeCells('D3:D4');

            // วิธีการประเมิน E:H (4 ช่อง)
            $sheet->mergeCells('E3:H3');

            // คะแนน I
            $sheet->mergeCells('I3:I4');

            // ผลประเมิน J:K
            $sheet->mergeCells('J3:K3');

            // หมายเหตุ L
            $sheet->mergeCells('L3:L4');

            /*
            |--------------------------------------------------------------------------
            | Title Style
            |--------------------------------------------------------------------------
            */

            $sheet->getStyle('A1')->applyFromArray([
                'font' => [
                    'bold' => true,
                    'size' => 18
                ],

                'alignment' => [
                    'horizontal' =>
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                ]
            ]);

            /*
            |--------------------------------------------------------------------------
            | Header Color
            |--------------------------------------------------------------------------
            */

            $sheet->getStyle('A5:L4')
                    ->applyFromArray([
                        'font' => [
                            'bold' => true
                        ],
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => [
                                'rgb' => 'D9D9D9'
                            ]
                        ]
                    ]);

            /*
            |--------------------------------------------------------------------------
            | Borders
            |--------------------------------------------------------------------------
            */

            $highestRow = $sheet->getHighestRow();

            $sheet->getStyle('A3:L'.$highestRow)
                ->applyFromArray([

                    'borders' => [

                        'allBorders' => [

                            'borderStyle' =>
                            \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
                        ]
                    ]
                ]);

            /*
            |--------------------------------------------------------------------------
            | Alignment
            |--------------------------------------------------------------------------
            */

            $sheet->getStyle('A1:L'.$highestRow)
                ->getAlignment()
                ->setVertical(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                );

            $sheet->getStyle('A5:L'.$highestRow)
                ->getAlignment()
                ->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                );

            /*
            |--------------------------------------------------------------------------
            | Row Height
            |--------------------------------------------------------------------------
            */

            $sheet->getRowDimension(1)->setRowHeight(30);

            $sheet->getColumnDimension('A')->setWidth(8);
            $sheet->getColumnDimension('B')->setWidth(18);
            $sheet->getColumnDimension('C')->setWidth(30);
            $sheet->getColumnDimension('D')->setWidth(14);

            $sheet->getColumnDimension('E')->setWidth(10);
            $sheet->getColumnDimension('F')->setWidth(10);
            $sheet->getColumnDimension('G')->setWidth(10);
            $sheet->getColumnDimension('H')->setWidth(10);
            $sheet->getColumnDimension('I')->setWidth(10);

            $sheet->getColumnDimension('J')->setWidth(10);

            $sheet->getColumnDimension('K')->setWidth(8);
            $sheet->getColumnDimension('L')->setWidth(8);


            /*
            |--------------------------------------------------------------------------
            | Freeze
            |--------------------------------------------------------------------------
            */

            $sheet->freezePane('A7');
        }
        ];
    }
}
