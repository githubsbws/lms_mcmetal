<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAssessment extends Model
{
    use HasFactory;

    protected $table = 'personal_assessment';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'topic_id',
        'assessment_date',
        'training_hours',
        'ojt',
        'lecture',
        'demonstration',
        'qa_score',
        'practice_score',
        'exam_score',
        'work_score',
        'total_score',
        'level',
        'passed',
        'remark'
    ];

    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }

    public function user(){
    return $this->belongsTo(Users::class);
    }

    public function topic()
    {
        return $this->belongsTo(AssessmentTopic::class,'topic_id');
    }
}
