<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoadmapCourse extends Model
{
    protected $table = 'roadmap_course';

    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'roadmap_id', 'course_id', 'order',
        'milestone_days', 'active'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','course_id');
    }

    public function roadmap()
    {
        return $this->belongsTo(Roadmap::class,'roadmap_id','id');
    }
}
