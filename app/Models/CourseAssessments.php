<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseAssessments extends Model
{
    use HasFactory;

    protected $table = 'course_assessments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'course_id',
        'score_type',
        'current_score',
        'max_score',
        'active',
        'created_at',
        'updated_at'
    ];
}
