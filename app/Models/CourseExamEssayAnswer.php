<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseExamEssayAnswer extends Model
{
    use HasFactory;

    protected $table = 'course_exam_essay_answer';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'course_id',
        'ques_id',
        'answer_text',
        'status',
        'active',
        'created_date'
    ];
}
