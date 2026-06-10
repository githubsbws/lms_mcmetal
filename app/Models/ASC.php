<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ASC extends Model
{
    use HasFactory;

    protected $table = 'asc';
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_date'; // Custom created_at column
    const UPDATED_AT = 'updated_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }
}
