<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usability extends Model
{
    use HasFactory;

    protected $table = 'usability';

    protected $primaryKey = 'usa_id';

    protected $fillable = [
        'active'
    ];

    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('usa_id', $id)->first();
    }
    
}
