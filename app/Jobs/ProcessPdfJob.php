<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Imagick;
use Spatie\PdfToImage\Pdf;
use App\Models\OcrFilePage;
use Elastic\Elasticsearch\ClientBuilder;
use Google\Cloud\DocumentAI\V1\Client\DocumentProcessorServiceClient;
use Google\Cloud\DocumentAI\V1\ProcessRequest;
use Google\Cloud\DocumentAI\V1\RawDocument;
use App\Jobs\ProcessPdfPageJob;
use Exception;

class ProcessPdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 0; // 0 = ไม่จำกัดเวลา
    public $tries = 3;   // ลองใหม่ได้ 3 ครั้ง
    protected $originalFile;
    protected $ocrFileId;
    protected $folderPath;

    public function __construct(string $originalFile, int $ocrFileId, string $folderPath)
    {
        $this->originalFile = $originalFile;
        $this->ocrFileId = $ocrFileId;
        $this->folderPath = rtrim($folderPath, '/') . '/';
    }

    public function handle()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path(env('GOOGLE_APPLICATION_CREDENTIALS')));

        $batchSize = 20;

        try {
            // ใช้ Imagick อ่าน PDF
            $imagick = new Imagick();
            $imagick->setResolution(200, 200);
            $imagick->readImage($this->originalFile);
            $pageCount = $imagick->getNumberImages();
            $imagick->clear();
            $imagick->destroy();

            $this->processBatchWithImagick($pageCount, $batchSize);

        } catch (Exception $e) {
            // fallback: Spatie/pdf-to-image
            try {
                $pdf = new Pdf($this->originalFile);
                $pdf->setTimeout(3600);
                $pageCount = $pdf->getNumberOfPages();
                $this->processBatchWithSpatie($pdf, $pageCount, $batchSize);

            } catch (Exception $ex) {
                \Log::error('ProcessPdfJob failed: ' . $ex->getMessage());
            }
        }
    }

    protected function processBatchWithImagick(int $pageCount, int $batchSize)
    {
        for ($start = 0; $start < $pageCount; $start += $batchSize) {
            $end = min($start + $batchSize - 1, $pageCount - 1);

            $batchImagick = new Imagick();
            $batchImagick->setResolution(200, 200);
            $batchImagick->readImage("{$this->originalFile}[{$start}-{$end}]");

            $index = 0;
            foreach ($batchImagick as $page) {
                $pageNum = $start + $index + 1;
                $outputFile = $this->folderPath . "page-{$pageNum}.png";

                $page->setImageFormat('png');
                $page->writeImage($outputFile);

                $this->ocrAndSave($outputFile, $pageNum);
                $index++;
            }

            $batchImagick->clear();
            $batchImagick->destroy();
        }
    }

   protected function processBatchWithSpatie(Pdf $pdf, int $pageCount, int $batchSize)
    {
        $pdf->setTimeout(3600); // เพิ่ม timeout ให้ Spatie PDF > 1 ชั่วโมง

        for ($start = 0; $start < $pageCount; $start += $batchSize) {
            $end = min($start + $batchSize - 1, $pageCount - 1);

            for ($i = $start + 1; $i <= $end + 1; $i++) {
                $outputFile = $this->folderPath . "page-{$i}.png";

                try {
                    $pdf->setPage($i)
                        ->setResolution(200)
                        ->saveImage($outputFile);

                    $this->ocrAndSave($outputFile, $i);

                } catch (\Exception $e) {
                    \Log::error("Failed to convert page {$i} with Spatie PDF: " . $e->getMessage());
                }
            }
        }
    }

    protected function ocrAndSave(string $file, int $pageNum)
    {
        try {
            // Google Document AI
            putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path(env('GOOGLE_APPLICATION_CREDENTIALS')));
            $projectId = env('GOOGLE_PROJECT_ID');
            $location = env('GOOGLE_LOCATION');
            $processorId = env('PROCESSOR_ID');

            $client = new DocumentProcessorServiceClient();
            $name = $client->processorName($projectId, $location, $processorId);

            $rawDocument = new RawDocument([
                'content' => file_get_contents($file),
                'mime_type' => mime_content_type($file),
            ]);

            $requestObj = new ProcessRequest([
                'name' => $name,
                'raw_document' => $rawDocument
            ]);

            $response = $client->processDocument($requestObj);
            $pageText = trim($response->getDocument()->getText());
            try {
                \Log::info("OCR Page Data BEFORE Save:", [
                    'ocr_file_id' => $this->ocrFileId,
                    'page_number' => $pageNum,
                    'text_length' => strlen($pageText),
                    'text_preview' => substr($pageText, 0, 100), // ดูตัวอย่าง 100 ตัวแรก
                ]);

                $ocrPage = OcrFilePage::create([
                    'ocr_file_id' => $this->ocrFileId,
                    'page_number' => $pageNum,
                    'text' => $pageText,
                ]);

                \Log::info("OCR Page SAVED with ID: {$ocrPage->id}");

            } catch (\Exception $e) {
                \Log::error("Failed to save OCR page {$pageNum}: " . $e->getMessage());
            }

            // ส่งเข้า Elasticsearch
           $esClient = ClientBuilder::create()
                        ->setHosts([env('ELASTICSEARCH_HOST', 'https://127.0.0.1:9200')])
                        ->setBasicAuthentication(
                            env('ELASTICSEARCH_USER', 'elastic'),
                            env('ELASTICSEARCH_PASS', '')
                        )
                        ->setCABundle(env('ELASTICSEARCH_SSL_VERIFICATION'))
                        ->build();

            $esClient->index([
                'index' => 'ocr_pages',
                'id'    => $this->ocrFileId . '_' . $pageNum,
                'body'  => [
                    'ocr_file_id' => $this->ocrFileId,
                    'filename'   => basename($this->originalFile),
                    'folder_name'   => basename(dirname($this->originalFile)),
                    'page_number' => $pageNum,
                    'text'     => $pageText,
                    'created_at'  => now(),
                    'active'      => 'y',
                ]
            ]);

            // ลบไฟล์ PNG หลังใช้
            if (file_exists($file)) {
                unlink($file);
            }

        } catch (Exception $e) {
            \Log::error("OCR failed for page {$pageNum}: " . $e->getMessage());
        }
    }
}