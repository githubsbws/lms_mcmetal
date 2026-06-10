<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'course_online';

    protected $primaryKey = 'course_id';

    protected $fillable = [
        'course_lecturer',
        'active',
        'recommend',
        'course_retest_amount',
        'cate_amount',
        'time_test',
        'lang_id',
        'random_choice',
        'average_time_pretest',
        'average_time_posttest',
        'course_picture',
        'op_mac_id',
        'par_st_id',
        'start_date',
        'end_date',
        'is_onboarding',
        'department_org_id'
    ];

    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('course_id', $id)->first();
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id','cate_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'course_lecturer','teacher_id');
    }

    public function orgcourse()
    {
        return $this->belongsToMany(Orgchart::class,'org_course', 'course_id', 'orgchart_id');
    }

    public function operation()
    {
        return $this->belongsTo(OperationMachine::class,'op_mac_id','id');
    }

    public function parameters()
    {
        return $this->belongsTo(ParameterSetting::class,'par_st_id','id');
    }

    public function courseWeight()
    {
        return $this->hasOne(CourseScoreWeight::class,'course_id');
    }

    public function roadmapCourse()
    {
        return $this->hasOne(RoadmapCourse::class,'course_id');
    }

    public function lesson()
    {
        return $this->hasMany(Lesson::class,'course_id','course_id');
    }
    public function passcourse()
    {
        return $this->hasMany(Passcourse::class,'passcours_cours','course_id');
    }

    public function courseScore()
    {
        return $this->hasMany(CourseScore::class,'course_id','course_id');
    }

    public function groupTesting()
    {
        return $this->hasOne(Grouptesting::class, 'course_id', 'course_id');
    }

}
