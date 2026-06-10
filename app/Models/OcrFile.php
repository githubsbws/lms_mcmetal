<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OcrFile extends Model
{
    protected $table = 'ocr_files';

    protected $fillable = [
        'filename',
        'folder_name',
        'active'
    ];

    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }

    public function pages()
    {
        return $this->hasMany(OcrFilePage::class);
    }
}
