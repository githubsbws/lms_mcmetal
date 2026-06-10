<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passcourse extends Model
{
    use HasFactory;

    protected $table = 'passcours';

    protected $primaryKey = 'passcours_id';
    // public $timestamps = false;

    protected $fillable = [
        'passcours_cates',
        'passcours_cours',
        'passcours_user',
        'passcours_date',
        'passcours_status',
        'academic_year'
    ];

    public function user()
    {
        return $this->belongsTo(Users::class,'passcours_user','id');
    }
    public function courseonline()
    {
        return $this->belongsTo(Course::class,'passcours_course','course_id');
    }

    public function scoreAssessment()
    {
        return $this->hasMany(ScoreAssessment::class,'passcours_id','passcours_id');
    }

}
