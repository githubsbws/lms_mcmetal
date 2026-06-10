<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

class PotentialReportExport implements FromArray, WithEvents, ShouldAutoSize
{
    protected $reportData;
    protected $courseTitle;

    public function __construct($reportData)
    {
        $this->reportData   = $reportData;
        $this->courseTitle  = $reportData->isNotEmpty() ? $reportData->first()->course_title : '-';
    }

    public function array(): array
    {
        $rows = [];

        // Row 1: หัวใหญ่
        $rows[] = [
            'หัวข้ออบรม (' . $this->courseTitle . ')',
            '', '', '', '',
            'ประเมินศักยภาพผู้เข้าอบรม',
            '', '', '', '', '', '', ''
        ];

        // Row 2: หัวกลุ่ม
        $rows[] = [
            'No.', 'ชื่อ - สกุล', 'รหัสพนักงาน', 'ตำแหน่ง', 'ทีม',
            'ผลประเมินศักยภาพผู้ผ่านการอบรม',
            '', '', '', '',
            'การประเมินศักยภาพ', 'การประเมินผลิตภาพ', 'ลายเซ็น (Signature)'
        ];

        // Row 3: หัวย่อย
        $rows[] = [
            '', '', '', '', '',
            '1. ความรู้จากการฝึกอบรม',
            '2. ทักษะในการปฏิบัติงาน',
            '3. ทัศนคติที่มีต่อการปฏิบัติงาน',
            '4. การแก้ปัญหาในการทำงาน',
            '5. ความตระหนักในด้านการทำงาน',
            '', '', ''
        ];

        // Data rows
        foreach ($this->reportData as $course) {
            foreach ($course->passcourse as $index => $userData) {
                $evals = $userData->display_evals;
                $rows[] = [
                    $index + 1,
                    trim(($userData->user->Profiles->firstname ?? '') . ' ' . ($userData->user->Profiles->lastname ?? '')),
                    $userData->user->username,
                    $userData->user->orgchart->title ?? '-',
                    $userData->user->Team->name ?? '-',
                    $this->gradeSymbol($evals['knowledge']    ?? ['grade' => 0]),
                    $this->gradeSymbol($evals['skill']        ?? ['grade' => 0]),
                    $this->gradeSymbol($evals['attitude']     ?? ['grade' => 0]),
                    $this->gradeSymbol($evals['problem_solv'] ?? ['grade' => 0]),
                    $this->gradeSymbol($evals['awareness']    ?? ['grade' => 0]),
                    '', '', ''
                ];
            }
        }

        // Remark rows
        $rows[] = [];
        $rows[] = ['Remark'];
        $rows[] = ['3', 'Qualified'];
        $rows[] = ['2', 'Under Supervision'];
        $rows[] = ['1', 'Not Qualified (In Training)'];
        $rows[] = ['0', '-'];

        return $rows;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet      = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();

                // สี
                $greenBg  = 'CCFFCC';
                $yellowBg = 'FFFF99';
                $lightYellow = 'FFFFCC';
                $white    = 'FFFFFF';

                // ── Row 1: Merge และสี ──
                $sheet->mergeCells('A1:E1');
                $sheet->mergeCells('F1:M1');
                $sheet->getStyle('A1:E1')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 12],
                    'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $lightYellow]],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);
                $sheet->getStyle('F1:M1')->applyFromArray([
                    'font'      => ['bold' => true, 'size' => 12],
                    'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $white]],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);

                // ── Row 2: Merge และสี ──
                // A-E merge row 2-3
                foreach (['A', 'B', 'C', 'D', 'E'] as $col) {
                    $sheet->mergeCells("{$col}2:{$col}3");
                }
                // F-J merge row 2
                $sheet->mergeCells('F2:J2');
                // K-M merge row 2-3
                foreach (['K', 'L', 'M'] as $col) {
                    $sheet->mergeCells("{$col}2:{$col}3");
                }

                $sheet->getStyle('A2:E3')->applyFromArray([
                    'font'      => ['bold' => true],
                    'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $greenBg]],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
                ]);
                $sheet->getStyle('F2:M3')->applyFromArray([
                    'font'      => ['bold' => true],
                    'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $yellowBg]],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER, 'wrapText' => true],
                ]);

                // ── Data rows: จัดกึ่งกลางตัวเลข ──
                if ($highestRow > 3) {
                    $sheet->getStyle("A4:A{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("C4:C{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    $sheet->getStyle("F4:J{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }

                // ── Border ทั้งตาราง ──
                $lastDataRow = 3 + $this->reportData->sum(fn($c) => $c->passcourse->count());
                $sheet->getStyle("A1:M{$lastDataRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color'       => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // ── Row สูง ──
                $sheet->getRowDimension(1)->setRowHeight(25);
                $sheet->getRowDimension(2)->setRowHeight(25);
                $sheet->getRowDimension(3)->setRowHeight(40);

                // ── Remark section ──
                $remarkRow = $lastDataRow + 2;
                $sheet->getStyle("A{$remarkRow}")->getFont()->setBold(true)->setColor(
                    (new \PhpOffice\PhpSpreadsheet\Style\Color('FF0000FF'))
                );

                $dataStartRow = 4;
                foreach ($this->reportData as $course) {
                    foreach ($course->passcourse as $userData) {
                        foreach (['F', 'G', 'H', 'I', 'J'] as $col) {
                            $cellValue = $sheet->getCell("{$col}{$dataStartRow}")->getValue();
                            // $color = match(true) {
                            //     str_contains((string)$cellValue, '✓') => '00AA00',
                            //     str_contains((string)$cellValue, '△') => 'FF8800',
                            //     str_contains((string)$cellValue, '✗') => 'CC0000',
                            //     default => '000000'
                            // };
                            $color = match((string)$cellValue) {
                                '3'     => '00AA00', // สีเขียว (เดิมเช็ก ✓)
                                '2'     => 'FF8800', // สีส้ม/เหลือง (เดิมเช็ก △)
                                '1'     => 'CC0000', // สีแดง (เดิมเช็ก ✗)
                                default => '000000'  // สีดำปกติสำหรับเกรด 0 หรือค่าว่าง
                            };
                            $sheet->getStyle("{$col}{$dataStartRow}")->getFont()->getColor()->setRGB($color);
                        }
                        $dataStartRow++;
                    }
                }
                $approveRow = $lastDataRow + 1;

                // ข้อความ Approve By Mgr Up
                $sheet->setCellValue("K{$approveRow}", 'Approve By Mgr Up');
                $sheet->mergeCells("K{$approveRow}:M{$approveRow}");
                $sheet->getStyle("K{$approveRow}:M{$approveRow}")->applyFromArray([
                    'font'      => ['bold' => true],
                    'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $yellowBg]],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                    'borders'   => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color'       => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // ช่องว่างสำหรับเซ็น merge รวม 3 แถวเป็น 1 ช่อง
                $signStart = $approveRow + 1;
                $signEnd   = $approveRow + 2;

                $sheet->mergeCells("K{$signStart}:M{$signEnd}");
                $sheet->getStyle("K{$signStart}:M{$signEnd}")->applyFromArray([
                    'fill'    => ['fillType' => Fill::FILL_SOLID],
                    'borders' => [
                        'outline' => [ // ← outline แทน allBorders ไม่มีเส้นกลาง
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);

                // กำหนดความสูง
                for ($i = 1; $i <= 3; $i++) {
                    $sheet->getRowDimension($approveRow + $i)->setRowHeight(30);
                }
            },
        ];
    }

    private function gradeSymbol(array $eval): string
    {
        return match($eval['grade']) {

            3 => '3', // ตัวเดิม: '✓ 3'
            2 => '2', // ตัวเดิม: '△ 2'
            1 => '1', // ตัวเดิม: '✗ 1'
            default => '0'
    };
    }
}
