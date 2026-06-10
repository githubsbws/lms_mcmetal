<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Downloadcategoty extends Model
{
    use HasFactory;

    protected $table = 'download_categoty';

    protected $primaryKey = 'download_id';

    protected $fillable = [
        'active',
        'title_id'
    ];

    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('download_id', $id)->first();
    }

    public function downloadTitle()
    {
        return $this->belongsTo(Downloadtitle::class, 'title_id');
    }
    
}
