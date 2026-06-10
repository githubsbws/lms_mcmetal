<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OcrFilePage extends Model
{
    protected $table = 'ocr_file_pages';

    protected $fillable = [
        'ocr_file_id',
        'page_number',
        'text',
    ];

    public function ocrFile()
    {
        return $this->belongsTo(OcrFile::class);
    }
}
