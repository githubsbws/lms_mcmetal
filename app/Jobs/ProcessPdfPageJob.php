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
use Elasticsearch\ClientBuilder;
use Google\Cloud\DocumentAI\V1\Client\DocumentProcessorServiceClient;
use Google\Cloud\DocumentAI\V1\ProcessRequest;
use Google\Cloud\DocumentAI\V1\RawDocument;
use Exception;

class ProcessPdfPageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 600; // 10 นาที สำหรับหน้าใหญ่ ๆ
    protected $filePath;
    protected $ocrFileId;
    protected $pageNum;

    public function __construct(string $filePath, int $ocrFileId, int $pageNum)
    {
        $this->filePath = $filePath;
        $this->ocrFileId = $ocrFileId;
        $this->pageNum = $pageNum;
    }

    public function handle()
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path(env('GOOGLE_APPLICATION_CREDENTIALS')));
        $projectId = env('GOOGLE_PROJECT_ID');
        $location = env('GOOGLE_LOCATION');
        $processorId = env('PROCESSOR_ID');

        $client = new DocumentProcessorServiceClient();
        $name = $client->processorName($projectId, $location, $processorId);

        $rawDocument = new RawDocument([
            'content' => file_get_contents($this->filePath),
            'mime_type' => mime_content_type($this->filePath),
        ]);

        $requestObj = new ProcessRequest([
            'name' => $name,
            'raw_document' => $rawDocument
        ]);

        $response = $client->processDocument($requestObj);
        $pageText = trim($response->getDocument()->getText());

        OcrFilePage::create([
            'ocr_file_id' => $this->ocrFileId,
            'page_number' => $this->pageNum,
            'text' => $pageText,
        ]);

        // ลบไฟล์ png หลัง process เสร็จ
        if (file_exists($this->filePath)) {
            unlink($this->filePath);
        }
    }
}
