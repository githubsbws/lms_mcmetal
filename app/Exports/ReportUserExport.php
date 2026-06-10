<?php

namespace App\Exports;

use App\Models\Company;
use App\Models\Score;
use App\Models\Learn;
use App\Models\Users;
use App\Models\Lesson;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;

use Maatwebsite\Excel\Events\AfterSheet;


class ReportUserExport implements
    FromArray,
    WithStyles,
    ShouldAutoSize,
    WithEvents
{
    protected $users;
    protected $groupedCourses;
    protected $passCourses;
    protected $assessmentScores;

    public function __construct($users, $groupedCourses, $passCourses,$assessmentScores)
    {
        $this->users = $users;
        $this->groupedCourses = $groupedCourses;
        $this->passCourses = $passCourses;
        $this->assessmentScores = $assessmentScores;
    }

    private function getSkillLevel($percent)
    {
        if ($percent == 100) return 5;
        if ($percent >= 80) return 4;
        if ($percent >= 60) return 3;
        if ($percent >= 25) return 2;
        if ($percent >= 0) return 1;

        return 0;
    }

    private function skillSymbol($skill)
    {
        if (is_null($skill)) {
            return '○';
        }

        switch ((int)$skill) {
            case 5:
                return '★';
            case 4:
                return '●';
            case 3:
                return '◕';
            case 2:
                return '◑';
            case 1:
                return '◔';
            default:
                return '○';
        }
    }

    public function array(): array
    {
        $rows = [];

        /*
        |--------------------------------------------------------------------------
        | HEADER ROW 1
        |--------------------------------------------------------------------------
        */

        $header1 = [
            'No',
            'ชื่อ - สกุล',
            'รหัสพนักงาน',
            'ตำแหน่ง',
            'ทีม',
            'วันที่เริ่มงาน'
        ];

        foreach($this->groupedCourses as $group => $items){

            for($i=0; $i<count($items); $i++){
                $header1[] = $i == 0 ? $group : '';
            }
        }

        /*
        |--------------------------------------------------------------------------
        | HEADER ROW 2
        |--------------------------------------------------------------------------
        */

        $header2 = [
            '',
            '',
            '',
            '',
            '',
            ''
        ];

        foreach($this->groupedCourses as $group => $items){

            foreach($items as $course){
                $header2[] = $course->course_title;
            }
        }

        $rows[] = $header1;
        $rows[] = $header2;

        /*
        |--------------------------------------------------------------------------
        | DATA ROWS
        |--------------------------------------------------------------------------
        */

        foreach($this->users as $index => $user){

            $row = [
                $index + 1,
                $user->firstname.' '.$user->lastname,
                $user->username,
                optional($user->Orgchart)->title,
                $user->Team->name,
                $user->work_start
                    ? \Carbon\Carbon::parse($user->work_start)->format('d/m/Y')
                    : '-'
            ];

            foreach($this->groupedCourses as $group => $items){

                foreach($items as $course){

                    $key = $user->id.'_'.$course->course_id;

                    $passCourse = $this->passCourses->get($key);

                    $percent = null;

                    if($passCourse){

                        $scores = $this->assessmentScores
                            ->get($passCourse->passcours_id, collect());

                        // รวมคะแนน assessment
                        $percent = $scores->sum(function($item){
                            return (float)$item->score;
                        });
                    }

                    $skill = is_null($percent)
                        ? null
                        : $this->getSkillLevel($percent);

                    $row[] = $this->skillSymbol($skill);
                }
            }

            $rows[] = $row;
        }

        return $rows;
    }

    /*
    |--------------------------------------------------------------------------
    | STYLE
    |--------------------------------------------------------------------------
    */

    public function styles(Worksheet $sheet)
    {
        return [

            // Header Row 1
            1 => [
                'font' => [
                    'bold' => true,
                ]
            ],

            // Header Row 2
            2 => [
                'font' => [
                    'bold' => true,
                ]
            ]
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | AFTER SHEET
    |--------------------------------------------------------------------------
    */

    public function registerEvents(): array
    {
        return [

            AfterSheet::class => function(AfterSheet $event){

                $sheet = $event->sheet->getDelegate();

                /*
                |--------------------------------------------------------------------------
                | Merge Header
                |--------------------------------------------------------------------------
                */

                $startCol = 7;

                foreach($this->groupedCourses as $group => $items){

                    $count = count($items);

                    $startLetter = $this->columnLetter($startCol);
                    $endLetter = $this->columnLetter($startCol + $count - 1);

                    $sheet->mergeCells(
                        $startLetter.'1:'.$endLetter.'1'
                    );

                    $startCol += $count;
                }

                /*
                |--------------------------------------------------------------------------
                | Merge Left Header
                |--------------------------------------------------------------------------
                */

                $sheet->mergeCells('A1:A2');
                $sheet->mergeCells('B1:B2');
                $sheet->mergeCells('C1:C2');
                $sheet->mergeCells('D1:D2');
                $sheet->mergeCells('E1:E2');
                $sheet->mergeCells('F1:F2');

                /*
                |--------------------------------------------------------------------------
                | Center
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle(
                    'A1:'.$sheet->getHighestColumn().$sheet->getHighestRow()
                )->getAlignment()->setHorizontal(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                );

                $sheet->getStyle(
                    'A1:'.$sheet->getHighestColumn().$sheet->getHighestRow()
                )->getAlignment()->setVertical(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                );

                /*
                |--------------------------------------------------------------------------
                | Header Color
                |--------------------------------------------------------------------------
                */

                $sheet->getStyle(
                    'A1:'.$sheet->getHighestColumn().'2'
                )->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'FFF200'
                        ]
                    ]
                ]);

                /*
                |--------------------------------------------------------------------------
                | Freeze Pane
                |--------------------------------------------------------------------------
                */

                $sheet->freezePane('G3');

                /*
                |--------------------------------------------------------------------------
                | Auto Height
                |--------------------------------------------------------------------------
                */

                foreach(range(1, $sheet->getHighestRow()) as $row){
                    $sheet->getRowDimension($row)
                        ->setRowHeight(25);
                }

                $startRow = 3; // data row เริ่ม
                $startCol = 7; // G

                for ($row = $startRow; $row <= $sheet->getHighestRow(); $row++) {

                    for ($col = $startCol; $col <= \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($sheet->getHighestColumn()); $col++) {

                        $cell = $this->columnLetter($col).$row;
                        $value = $sheet->getCell($cell)->getValue();

                        $color = null;

                        switch ($value) {
                            case '★':
                                $color = 'FFD700'; // gold
                                break;
                            case '●':
                                $color = '333333';
                                break;
                            case '◕':
                                $color = '666666';
                                break;
                            case '◑':
                                $color = '999999';
                                break;
                            case '◔':
                                $color = 'CCCCCC';
                                break;
                            case '○':
                                $color = 'EEEEEE'; 
                                break;
                        }

                        if ($color) {

                            $borderColor = ($value == '○')
                                ? 'BFBFBF'
                                : null;

                            $fontColor = in_array($value, ['●', '◕']) 
                                ? 'FFFFFF' 
                                : '000000';

                            $sheet->getStyle($cell)->applyFromArray([

                                'fill' => [
                                    'fillType' => Fill::FILL_SOLID,
                                    'startColor' => [
                                        'rgb' => $color
                                    ]
                                ],
                                'borders' => $value == '○'
                                ? [
                                    'outline' => [
                                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                        'color' => [
                                            'rgb' => 'BFBFBF'
                                        ]
                                    ]
                                ]
                                : [],
                                'font' => [
                                    'bold' => true,
                                    'size' => 14,
                                    'color' => [
                                        'rgb' => $fontColor
                                    ]
                                ],

                                'alignment' => [
                                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                                ]
                            ]);
                        }
                    }
                }

            }
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Convert Column Number To Excel Letter
    |--------------------------------------------------------------------------
    */

    private function columnLetter($c)
    {
        $letter = '';

        while($c > 0){
            $temp = ($c - 1) % 26;
            $letter = chr($temp + 65).$letter;
            $c = intval(($c - $temp - 1) / 26);
        }

        return $letter;
    }
}