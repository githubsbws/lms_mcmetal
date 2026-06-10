<?php

namespace App\Imports;

use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Row;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use PhpOffice\PhpSpreadsheet\IOFactory;

class QuesImportEssay implements OnEachRow
{
    private $id;
    private $imagesByRow = [];

    public function __construct($id, $imagesByRow)
    {
        $this->id = $id;
        $this->imagesByRow = $imagesByRow;
    }

      public function onRow(Row $row)
    {
        $userId = auth()->id();

        \Log::info('USER ID', ['id' => $userId]);

        $index = $row->getIndex();

        \Log::info('STEP 3: MATCH', [
            'row_index' => $index,
            'images' => $this->imagesByRow[$index] ?? null
        ]);
        $data = array_values($row->toArray());

        \Log::info('ROW DATA', $data);

        if ($index < 2) return;

        $question = trim($data[1] ?? '');
        $answer   = trim($data[4] ?? '');

        \Log::info('QUESTION RAW', [
            'value' => $data[1],
            'length' => strlen($data[1] ?? ''),
        ]);

        if (!$question) return;

        \Log::info('BEFORE CREATE', [
            'row' => $index,
            'question' => $question
        ]);

       try {
                $q = Question::create([
                    'ques_type'  => '3',
                    'ques_title' => $question,
                    'group_id'   => $this->id,
                    'active'     => 'y',
                    'answer'     => $answer,
                    'create_by'  => $userId,
                ]);

                \Log::info('CREATED QUESTION', [
                    'id' => $q->ques_id ?? null
                ]);

                if (!empty($this->imagesByRow[$index])) {

                    \Log::info('Q ID CHECK', [
                        'id' => $q->ques_id,
                        'raw' => $q->toArray()
                    ]);

                    foreach ($this->imagesByRow[$index] as $img) {

                        $q->images()->create([
                            'path' => $img,
                        ]);
                    }
                }

            } catch (\Exception $e) {
                \Log::error('CREATE FAIL', [
                    'error' => $e->getMessage()
                ]);
            }
    }
}