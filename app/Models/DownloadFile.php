<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadFile extends Model
{
    use HasFactory;

    protected $table = 'download_file';

    protected $primaryKey = 'file_id';

    protected $fillable = [
        'active'
    ];

    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('file_id', $id)->first();
    }

    public function categories()
    {
        return $this->hasMany(Downloadcategoty::class, 'download_id', 'download_id');
    }
    
}
