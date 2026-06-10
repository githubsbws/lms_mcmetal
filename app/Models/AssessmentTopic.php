<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentTopic extends Model
{
    use HasFactory;

    protected $table = 'assessment_topics';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'topic_code',
        'topic_name'
    ];

    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }
}
