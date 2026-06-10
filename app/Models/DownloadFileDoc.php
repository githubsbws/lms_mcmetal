<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadFileDoc extends Model
{
    use HasFactory;

    protected $table = 'download_filedoc';

    protected $primaryKey = 'filedoc_id';

    protected $fillable = [
        'active'
    ];

    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('filedoc_id', $id)->first();
    }
    
    public function downloadFile()
    {
        return $this->belongsTo(DownloadFile::class, 'file_id');
    }
}
