<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conditions extends Model
{
    use HasFactory;

    protected $table = 'conditions';

    protected $primaryKey = 'conditions_id';
    protected $fillable = [
        'conditions_title',
        'conditions_detail'
    ];
    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('conditions_id', $id)->first();
    }
}
