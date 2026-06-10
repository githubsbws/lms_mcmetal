<?php

namespace App\Imports;

use App\Models\Question;
use App\Models\Choice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;

class ImportWord
{
    private $group_id;

    public function __construct($group_id)
    {
        $this->group_id = $group_id;
    }

    private function saveImage($image)
    {
        $imageData = $image->getImageString();

        $extension = $image->getImageType() ?: 'png';

        $fileName = 'images/uploads/' . uniqid() . '.' . $extension;

        Storage::disk('public')->put($fileName, $imageData);

        return $fileName;
    }

    // 🔥 recursive ดึง text + image
    private function extract($element, &$items)
    {
        // TEXT
        if (method_exists($element, 'getText')) {
            $text = trim($element->getText());

            // ❌ skip header/logo text
            if (
                str_contains($text, 'Toyo Seikan') ||
                str_contains($text, 'Raw material Preparation') ||
                str_contains($text, 'ผู้ตรวจ') ||
                str_contains($text, 'ผู้รับรอง')||
                str_contains($text, 'หัวข้อ:')
            ) {
                return;
            }

            if ($text !== '') {
                $items[] = [
                    'type' => 'text',
                    'value' => $text
                ];
            }
        }

        // IMAGE (ถ้าไม่อยากเก็บ logo)
        if ($element instanceof \PhpOffice\PhpWord\Element\Image) {
            return; // ❌ skip logo
        }

        if (method_exists($element, 'getElements')) {
            foreach ($element->getElements() as $child) {
                $this->extract($child, $items);
            }
        }
    }

    public function importWord($file ,$group_id = null)
    {
        DB::beginTransaction();

        try {

            $phpWord = IOFactory::load($file->getRealPath());

            $items = [];

            // 🔥 ดึงทุก element มาเรียงตามลำดับ
            foreach ($phpWord->getSections() as $section) {
                foreach ($section->getElements() as $element) {
                    $this->extract($element, $items);
                }
            }

            // 🔥 แยกเป็น block (ข้อ)
            $blocks = [];
            $current = null;

            foreach ($items as $item) {

                if ($item['type'] === 'text') {

                    $text = trim($item['value']);

                    // normalize
                    $isQuestionStart = preg_match('/^\s*\d+\s*[\.\)]\s*/u', $text)
                                    || preg_match('/^\d+\./', $text)
                                    || preg_match('/^\d+\)/', $text);

                    // 👉 detect question start
                    if ($isQuestionStart) {

                        if ($current) {
                            $blocks[] = $current;
                        }

                        $current = [
                            'texts' => [],
                            'images' => []
                        ];
                    }

                    if (!$current) {
                        $current = [
                            'texts' => [],
                            'images' => []
                        ];
                    }

                    $current['texts'][] = $text;
                }

                if ($item['type'] === 'image') {
                    if (!$current) {
                        $current = [
                            'texts' => [],
                            'images' => []
                        ];
                    }

                    $current['images'][] = $item['value'];
                }
            }

            if ($current) {
                $blocks[] = $current;
            }
            // 🔥 loop สร้าง question
            foreach ($blocks as $block) {

                if (empty($block['texts'])) continue;

                // รวม text
                $lines = array_values(array_filter(array_map('trim', $block['texts'])));

                if (empty($lines)) continue;

                // 🔥 เอาบรรทัดแรกเป็นคำถาม (ตัดเลขข้อออก)
                $questionText = preg_replace('/^\d+\s*[\.\)]\s*/', '', $lines[0]);

                // 🔥 detect choice
                $hasChoice = collect($lines)->contains(function ($line) {
                    return preg_match('/^[A-Za-zก-ฮ]\s*[\.\)\:]/u', $line);
                });

                $type = $hasChoice ? '2' : '3';

                $question = Question::create([
                    'ques_type'  => $type,
                    'ques_title' => $questionText,
                    'group_id'   => $this->group_id,
                    'active'     => 'y',
                    'create_by'  => auth()->id(),
                ]);

                // 🔥 save images (ผูกตาม block)
                foreach ($block['images'] as $img) {
                    DB::table('question_images')->insert([
                        'ques_id' => $question->ques_id,
                        'path'    => $img,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                // 🔥 choices
                if ($hasChoice) {

                    foreach ($lines as $line) {

                        if (preg_match('/^[A-Za-zก-ฮ]\s*[\.\)\:]/u', $line)) {

                            $choiceText = preg_replace('/^[A-Za-zก-ฮ]\s*[\.\)\:]\s*/u', '', $line);

                            Choice::create([
                                'ques_id'       => $question->ques_id,
                                'choice_detail' => $choiceText,
                                'choice_answer' => '2',
                                'choice_type'   => $type,
                                'active'        => 'y',
                                'create_by'     => auth()->id(),
                            ]);
                        }
                    }
                }
            }

            DB::commit();

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}