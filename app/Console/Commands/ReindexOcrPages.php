<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OcrFilePage;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Exception;
use Illuminate\Support\Facades\App;

class ReindexOcrPages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ocr:reindex 
                            {--chunk=500 : The number of records to process at a time}
                            {--force : Force the operation to run when in production}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-index all OCR pages to Elasticsearch (recreates index, uses bulk API, shows progress)';

    /**
     * The Elasticsearch client instance.
     *
     * @var \Elastic\Elasticsearch\Client
     */
    protected $client;

    /**
     * The name of the Elasticsearch index.
     *
     * @var string
     */
    protected $index = 'ocr_pages';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // เพิ่มการป้องกันการรันบน production โดยไม่ตั้งใจ
        if (App::environment('production') && !$this->option('force')) {
            $this->error('Running this in production is destructive. Use the --force flag to proceed.');
            return 1;
        }

        // เพิ่มการยืนยันก่อนเริ่ม
        if (!$this->confirm("This will DELETE and REBUILD the '{$this->index}' index. Are you sure you want to continue?")) {
            $this->info('Re-indexing cancelled.');
            return 0;
        }

        try {
            $this->initializeClient();
            $chunkSize = (int) $this->option('chunk');
            $this->info("Starting re-index for '{$this->index}' (chunk size: {$chunkSize})...");

            $this->recreateIndex();
            $this->performBulkIndex($chunkSize);

            $this->info("\nRe-index complete.");
        } catch (Exception $e) {
            $this->error("An error occurred: " . $e->getMessage());
            return 1;
        }

        return 0;
    }

    /**
     * Initialize the Elasticsearch client.
     */
    protected function initializeClient(): void
    {
        $this->client = ClientBuilder::create()
            ->setHosts([env('ELASTICSEARCH_HOST', 'https://127.0.0.1:9200')])
            ->setBasicAuthentication(
                env('ELASTICSEARCH_USER'),
                env('ELASTICSEARCH_PASS')
            )
            ->setCABundle(env('ELASTICSEARCH_SSL_VERIFICATION'))
            ->build();
    }

    /**
     * Delete the old index if it exists and create a new one with the correct mapping.
     */
    protected function recreateIndex(): void
    {
        if ($this->client->indices()->exists(['index' => $this->index])->asBool()) {
            $this->client->indices()->delete(['index' => $this->index]);
            $this->warn("Deleted old index: {$this->index}");
        }

        $this->client->indices()->create([
            'index' => $this->index,
            'body'  => [
                'settings' => [
                    'index.max_ngram_diff' => 10, // เพื่อให้ใช้ ngram กว้างๆ ได้
                    'analysis' => [
                        'analyzer' => [
                            'thai_ngram' => [
                                'type' => 'custom',
                                'tokenizer' => 'thai',
                                'filter' => ['lowercase', 'my_edge_ngram']
                            ],
                            'thai_search' => [
                                'type' => 'custom',
                                'tokenizer' => 'thai',
                                'filter' => ['lowercase']
                            ]
                        ],
                        'filter' => [
                            'my_edge_ngram' => [
                                'type' => 'edge_ngram',
                                'min_gram' => 2,
                                'max_gram' => 10
                            ]
                        ],
                        'normalizer' => [
                            'lowercase_normalizer' => [
                                'type' => 'custom',
                                'char_filter' => [],
                                'filter' => ['lowercase']
                            ]
                        ]
                    ]
                ],
                'mappings' => $this->getIndexMappings()
            ]
        ]);
        $this->info("Created new index '{$this->index}' with updated mappings.");
    }
    
    /**
     * Fetch data from the database and perform bulk indexing.
     * @param int $chunkSize
     */
    protected function performBulkIndex(int $chunkSize): void
    {
        $total = OcrFilePage::count();
        if ($total === 0) {
            $this->info("No pages to index.");
            return;
        }
        $this->info("Total pages to index: $total");

        $bar = $this->output->createProgressBar($total);
        $bar->start();

        OcrFilePage::with('ocrFile')->chunk($chunkSize, function ($pages) use ($bar) {
            $bulk = ['body' => []];

            foreach ($pages as $page) {
                $bulk['body'][] = [
                    'index' => [
                        '_index' => $this->index,
                        '_id'    => $page->id,
                    ]
                ];
                $bulk['body'][] = [
                    'ocr_file_id' => $page->ocr_file_id,
                    'page_number' => $page->page_number,
                    'text'        => $page->text,
                    'filename'    => optional($page->ocrFile)->filename ?? null,
                    'folder_name' => optional($page->ocrFile)->folder_name ?? null,
                    'created_at'  => $page->created_at?->toIso8601String(),
                    'active'      => optional($page->ocrFile)->active ?? 'y',
                ];
            }

            if (!empty($bulk['body'])) {
                $this->client->bulk($bulk);
            }

            $bar->advance($pages->count());
        });

        $bar->finish();
    }

    /**
     * Get the Elasticsearch index mappings.
     * @return array
     */
    protected function getIndexMappings(): array
    {
        return [
            'properties' => [
                'ocr_file_id' => ['type' => 'integer'],
                'page_number' => ['type' => 'integer'],
                'text' => [
                    'type' => 'text',
                    'analyzer' => 'thai_ngram',      // ใช้สำหรับ index
                    'search_analyzer' => 'thai_search' // ใช้สำหรับ search
                ],
                'filename' => [
                    'type' => 'text',
                    'fields' => [
                        'keyword' => [
                            'type' => 'keyword',
                            'ignore_above' => 256
                        ],
                        'keyword_lower' => [
                            'type' => 'keyword',
                            'ignore_above' => 256,
                            'normalizer' => 'lowercase_normalizer'
                        ]
                    ]
                ],
                'folder_name' => [ // ทำแบบเดียวกับ filename เพื่อความยืดหยุ่น
                    'type' => 'text',
                    'fields' => [
                        'keyword' => [
                            'type' => 'keyword',
                            'ignore_above' => 256
                        ]
                    ]
                ],
                'active'      => ['type' => 'keyword'],
                'created_at'  => ['type' => 'date']
            ]
        ];
    }
}