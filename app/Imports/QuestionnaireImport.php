<?php

namespace App\Imports;

use App\Models\QHeader;
use App\Models\QSection;
use App\Models\QQuestion;
use App\Models\QChoice;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Facades\AuthFacade;

class QuestionnaireImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // แปลงประเภทคำถาม
        $typeMapping = [
            'คำตอบบรรทัดเดียว'             => '1',
            'คำตอบแบบเลือกคำตอบเดียว'       => '2',
            'คำตอบแบบเลือกได้หลายคำตอบ'     => '3',
            'ความพึงพอใจ'                    => '4',
            'คำตอบแบบหลายบรรทัด'           => '5',
        ];

        $ques_type = $typeMapping[$row['type']] ?? null;

        if (!$ques_type || empty($row['question_name']) || empty($row['survey_name'])) {
            return null; // ข้ามถ้าไม่มีคำถามหรือประเภท
        }

        // สร้าง survey header
        $header = QHeader::create([
            'survey_name'  => $row['survey_name'],
            'instructions' => $row['instructions'] ?? '',
            'active'       => 'y',
        ]);

        if ($header) {
            // สร้าง section
            $section = QSection::create([
                'survey_header_id'        => $header->survey_header_id,
                'section_title'           => $row['section_title'] ?? 'Section 1',
                'section_required_yn'     => 'n',
            ]);

            // สร้างคำถาม
            $question = QQuestion::create([
                'survey_section_id'               => $section->survey_section_id,
                'input_type_id'                   => $ques_type,
                'question_name'                   => $row['question_name'],
                'answer_required_yn'              => 'n',
                'allow_multiple_option_answers_yn'=> 'n'
            ]);

            // เพิ่ม choice เฉพาะเมื่อเป็นประเภทที่ต้องการ choice เท่านั้น
            if (in_array($ques_type, ['2', '3', '4'])) {
                foreach ($row as $key => $value) {
                    if (Str::startsWith($key, 'option_choice_') && trim($value) !== '') {
                        $isCorrect = Str::startsWith($value, '*');
                        $choiceText = $isCorrect ? substr($value, 1) : $value;

                        QChoice::create([
                            'question_id'         => $question->question_id,
                            'option_choice_name'  => trim($choiceText),
                            'option_choice_type'  => 'normal' // เพิ่ม logic หากต้อง mark choice ที่ถูกต้องในอนาคต
                        ]);
                    }
                }
            }
        }
    }
}
    