<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionImage extends Model
{
    protected $table = 'question_images';

    protected $fillable = [
        'ques_id',
        'path',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'ques_id', 'ques_id');
    }
}