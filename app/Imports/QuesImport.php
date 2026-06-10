<?php

namespace App\Imports;

use App\Models\Position;
use App\Models\Question;
use App\Models\Choice;
use App\Models\Users;
use App\Models\Grouptesting;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Facades\AuthFacade;

class QuesImport implements ToCollection
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection(Collection $rows)
    {
        $userId = auth()->id();

        foreach ($rows as $row) {

            $text = $row[1] ?? null;

            $answer = $row[2] ?? null;

            if (!$text || !$answer) continue;

            $lines = explode("\n", $text);

            $questionText = trim($lines[0]);

            $question = Question::create([
                'ques_type'   => '2', 
                'ques_title'  => $questionText,
                'group_id'    => $this->id,
                'active'      => 'y',
                'create_by'   => $userId,
            ]);

            foreach ($lines as $line) {

                if (preg_match('/^[A-D]\./', trim($line))) {

                    $choiceText = trim(substr($line, 2));

                    // เช็คคำตอบ
                    $isAnswer = str_contains($answer, substr($line, 0, 1));

                    Choice::create([
                        'ques_id'       => $question->ques_id,
                        'choice_detail' => $choiceText,
                        'choice_answer' => $isAnswer ? '1' : '2',
                        'choice_type'   => '2',
                        'active'        => 'y',
                        'create_by'     => $userId,
                    ]);
                }
            }
        }
    }
}
    