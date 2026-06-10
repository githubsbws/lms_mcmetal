<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreAssessment extends Model
{
    use HasFactory;

    protected $table = 'score_assessment';

    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'passcours_id',
        'id_course_score_weight',
        'score',
        'type_course_score_weight',
        'active',
        'detail',
        'created_at',
        'updated_at',
        'pass_year',
    ];
}
