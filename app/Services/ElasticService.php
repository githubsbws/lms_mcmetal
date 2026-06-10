<?php

namespace App\Services;

use Elastic\Elasticsearch\ClientBuilder; // v8 ใช้ namespace นี้
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\OcrFilePage;
use Illuminate\Http\Request;

class ElasticService
{
    protected $client;
    protected $index = 'ocr_pages';

    public function __construct()
    {
        $host = env('ELASTICSEARCH_HOST', 'https://localhost:9200');
        $user = env('ELASTICSEARCH_USER', 'elastic');
        $pass = env('ELASTICSEARCH_PASS', '');

        $this->client = ClientBuilder::create()
                        ->setHosts([env('ELASTICSEARCH_HOST', 'https://localhost:9200')])
                        ->setBasicAuthentication(
                            env('ELASTICSEARCH_USER', 'elastic'),
                            env('ELASTICSEARCH_PASS', '')
                        )
                        ->setCABundle(env('ELASTICSEARCH_SSL_VERIFICATION'))
                        ->build();
    }

     public function searchOcrPages(string $query, int $from = 0, int $limit = 10, ?string $fileId = null)
    {
        $terms = $this->parse_query_terms($query);
        $minimum_should_match = max(1, count($terms) > 2 ? 2 : count($terms));

        $should = [];

        // 1️⃣ exact phrase (คำที่ตรงเป๊ะ)
        $should[] = [
            'match_phrase' => [
                'text' => [
                    'query' => $query,
                    'boost' => 3.0,
                    'slop'  => 2
                ]
            ]
        ];

        // 2️⃣ flexible match (ยืดหยุ่น)
        $should[] = [
            'match' => [
                'text' => [
                    'query' => $query,
                    'operator' => 'and',
                    'boost' => 2.0
                ]
            ]
        ];

        // 3️⃣ wildcard สำหรับชื่อไฟล์
        $should[] = [
            'wildcard' => [
                'filename.keyword_lower' => [
                    'value' => '*' . strtolower($query) . '*',
                    'boost' => 1.5
                ]
            ]
        ];

        // 4️⃣ match ทีละคำย่อย
        foreach ($terms as $term) {
            $should[] = [
                'match_phrase' => [
                    'text' => [
                        'query' => $term,
                        'boost' => 1.2,
                        'slop'  => 3
                    ]
                ]
            ];
            $should[] = [
                'match' => [
                    'text' => [
                        'query' => $term,
                        'operator' => 'and',
                        'boost' => 1.0
                    ]
                ]
            ];
        }

        $params = [
            'index' => 'ocr_pages',
            'body' => [
                'from' => $from,
                'size' => $limit,
                'track_scores' => true,
                'query' => [
                    'bool' => [
                        'must' => [
                            ['term' => ['active' => 'y']]
                        ],
                        'should' => $should,
                        'minimum_should_match' => $minimum_should_match,
                    ]
                ],
                'sort' => [
                    ['_score' => ['order' => 'desc']],
                    ['created_at' => ['order' => 'desc']],
                ],
                'highlight' => [
                    'fields' => [
                        'text' => new \stdClass(),
                        'filename' => new \stdClass(),
                    ],
                    'type' => 'unified',
                    'pre_tags' => ['<mark>'],
                    'post_tags' => ['</mark>'],
                    'fragment_size' => 200,
                    'number_of_fragments' => 3,
                    'boundary_scanner' => 'sentence',
                    'boundary_scanner_locale' => 'th-TH',
                    'require_field_match' => false,
                ]
            ]
        ];

        if ($fileId) {
            $params['body']['query']['bool']['filter'] = [
                ['term' => ['ocr_file_id' => $fileId]]
            ];
        }

        $results = $this->client->search($params);

        return collect($results['hits']['hits'])->map(function ($hit) {
            return [
                'id' => $hit['_id'],
                'score' => $hit['_score'],
                'text' => $hit['_source']['text'],
                'page_number' => $hit['_source']['page_number'] ?? null,
                'ocr_file_id' => $hit['_source']['ocr_file_id'] ?? null,
                'filename' => $hit['_source']['filename'] ?? null,
                'folder_name' => $hit['_source']['folder_name'] ?? null,
                'highlight_text' => isset($hit['highlight']['text']) ? implode(' ... ', $hit['highlight']['text']) : null,
                'highlight_filename'=> $hit['highlight']['filename'][0] ?? null,
            ];
        });
    }


    public function checkTextFile(Request $request)
    {
        $q = $request->search;
        $textFiles = OcrFilePage::where('text', 'like', "%$q%")->get();

        return $textFiles;
        dd($textFiles->toArray());
    }

    protected function arabicToThaiDigits(string $text): string
    {
        return strtr($text, [
            '0' => '๐',
            '1' => '๑',
            '2' => '๒',
            '3' => '๓',
            '4' => '๔',
            '5' => '๕',
            '6' => '๖',
            '7' => '๗',
            '8' => '๘',
            '9' => '๙',
        ]);
    }

    function thai2arabic(string $input): string
    {
        $thaiDigits   = ['๐', '๑', '๒', '๓', '๔', '๕', '๖', '๗', '๘', '๙'];
        $arabicDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($thaiDigits, $arabicDigits, $input);
    }


    function parse_query_terms(string $query): array
    {
        $regex = '/
                "[^"]+"                                                # 1) ข้อความใน quotes
                |
                (?:\d{1,2}|[๐-๙]{2})\s+[\p{L}\p{M}]+\s+(?:\d{4}|[๐-๙]{4})  # 2) dd เดือน yyyy
                |
                ครั้งที่\s*(?:\d+|[๐-๙]+)                              # 3) ครั้งที่ xx
                |
                \S+                                                    # 4) คำทั่วไป (non-space)
            /xu';

        preg_match_all($regex, trim($query), $m);
        $raw = $m[0];

        // ลบ " รอบๆ term ด้วย regex เดียวเลย
        return array_map(function (string $w): string {
            return preg_replace('/^"(.*)"$/u', '$1', $w);
        }, $raw);
    }
}