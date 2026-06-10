<?php
namespace App\Services;

use App\Enums\LessonStatus;
use App\Models\File;
use App\Models\FileDoc;
use App\Models\Learn;
use App\Models\LearnFile;
use App\Models\LearnFileDoc;
use Illuminate\Support\Facades\DB;

class LessonProgressService
{
    /**
     * อัปเดตความคืบหน้าวิดีโอ และตรวจสอบว่าบทเรียนผ่านหรือยัง
     * Complexity: $O(1)$ เนื่องจากเราใช้ Unique Index ในการหา Record
     */
    public function updateVideoProgress(int $userId, array $data)
    {
        return DB::transaction(function () use ($userId, $data) {
            $file = File::where('id', $data['file_id'])
                    ->where('lesson_id', $data['lesson_id'])
                    ->first();
            if (!$file) throw new \Exception('Invalid file', 403);

            // server คำนวณ status เองจาก seconds และ length จริง
            // ไม่เชื่อ status จาก client เลย
            if ($file->duration > 0) {
                $status = ($data['seconds'] >= $file->duration * 0.9) ? 'pass' : 'learning';
            } else {
                // ถ้าไม่มี length ค่อยเชื่อ client แต่ whitelist ไว้
                $status = in_array($data['status'], ['learning', 'pass'])
                        ? $data['status']
                        : 'learning';
            }

            $currentYear = now()->year;
            $learn = Learn::firstOrCreate(
                ['user_id' => $userId, 'lesson_id' => $data['lesson_id'],'pass_year' => now()->year],
                ['course_id' => $data['course_id'], 'lesson_status' => 'learning','learn_date' => now(),'created_at' => now()]
            );

            LearnFile::upsert([
                [
                    'learn_id'            => $learn->learn_id,
                    'file_id'             => $data['file_id'],
                    'last_watched_second' => $data['seconds'],
                    'learn_file_status'   => $status,
                    'learn_file_date'     => now(),
                ]
            ],
            ['learn_id', 'file_id'],
            [
                // ใช้ excluded.ฟิลด์ เพื่ออ้างอิงถึงค่าใหม่ที่ส่งมา
                'last_watched_second' => DB::raw("GREATEST(tbl_learn_file.last_watched_second, excluded.last_watched_second)"),
                'learn_file_status'   => DB::raw("CASE WHEN tbl_learn_file.learn_file_status = 'pass' THEN 'pass' ELSE excluded.learn_file_status END"),
                'learn_file_date'     => now(),
                'pass_year' => $currentYear,
            ]
            );
            //เก็บไว้ก่อนเผื่อเอาบันทึกปีหลังแก้
            // DB::raw("
            //         CASE
            //             WHEN tbl_learn_file.pass_year IS NOT NULL THEN tbl_learn_file.pass_year
            //             WHEN excluded.learn_file_status = 'pass' THEN {$currentYear}
            //             ELSE NULL
            //         END
            //     "),

            // Defensive Check: ถ้าวิดีโอจบ ให้ลองเช็คว่าไฟล์อื่นในบทเรียนนี้จบครบหรือยัง
            if ($data['status'] == LessonStatus::Success->value) {
                $this->checkAndMarkLessonPassed($learn);
            }
            return true;
        });
    }

    public function updateDocProgress(int $userId, array $data)
    {
        return DB::transaction(function () use ($userId, $data) {
            $learn = Learn::firstOrCreate(
                ['user_id' => $userId, 'lesson_id' => $data['lesson_id']],
                ['course_id' => $data['course_id'], 'lesson_status' => 'learning', 'learn_date' => now(),'created_at' => now(),'pass_year' => now()->year]
            );
            LearnFileDoc::updateOrCreate(
                ['learn_id' => $learn->learn_id, 'file_doc_id' => $data['file_doc_id']],
                ['learn_file_doc_status' => 'pass', 'learn_file_doc_date' => now(), 'pass_year' => now()->year]
            );
            $this->checkAndMarkLessonPassed($learn); // private ได้ปกติ
        });
    }

    private function checkAndMarkLessonPassed(Learn $learn)
    {
        $totalVdo = File::where('lesson_id', $learn->lesson_id)->where('active','y')->count();
        $totalDoc = FileDoc::where('lesson_id', $learn->lesson_id)->where('active','y')->count();
        $totalFilesCount = $totalVdo + $totalDoc;

        // นับที่จบแล้วทั้ง vdo และ doc
        $completedVdo = LearnFile::where('learn_id', $learn->learn_id)
                                ->where('learn_file_status', LessonStatus::Success->value)
                                ->count();

        $completedDoc = LearnFileDoc::where('learn_id', $learn->learn_id)
                                    ->where('learn_file_doc_status', LessonStatus::Success->value)
                                    ->count();

        $completedFilesCount = $completedVdo + $completedDoc;
        if ($totalFilesCount > 0 && $completedFilesCount >= $totalFilesCount) {
            $learn->update([
                'lesson_status' => LessonStatus::Success->value,
                'learn_date'    => now(),
            ]);
        }
    }
}
