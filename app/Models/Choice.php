<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;

    protected $table = 'choice';

    protected $primaryKey = 'choice_id';

    protected $fillable = [
        'choice_detail',
        'choice_answer',
        'choice_type',
        'ques_id',
        'create_by',
        'update_by',
        'active'
    ];


    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('choice_id', $id)->first();
    }
}
