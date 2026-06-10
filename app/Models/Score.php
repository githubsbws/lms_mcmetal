<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $table = 'score';
    protected $primaryKey = 'score_id';
    protected $fillable = [
        'lesson_id',
        'user_id',
        'course_id',
        'type',
        'score_number',
        'score_total',
        'score_past',
        'create_by',
        'create_date',
        'update_by',
        'update_date',
        'active',
    ];
    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('score_id', $id)->first();
    }
}
