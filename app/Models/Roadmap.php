<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    protected $table = 'roadmap';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'org_id','active', 'created_by', 'updated_by','department_org_id','line_id'
    ];

    public static function getMilestones()
    {
        return [
            '1' => ['title' => 'เดือนที่ 1', 'days' => '0-30 วัน', 'color' => 'primary', 'val' => 30],
            '2' => ['title' => 'เดือนที่ 2', 'days' => '31-60 วัน', 'color' => 'info',    'val' => 60],
            '3' => ['title' => 'เดือนที่ 3', 'days' => '61-90 วัน', 'color' => 'warning', 'val' => 90],
            '4' => ['title' => 'เดือนที่ 4', 'days' => '91-119 วัน', 'color' => 'success', 'val' => 119]
        ];
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'roadmap_course', 'roadmap_id', 'course_id')
                    ->withPivot(['order','mandatory','active'])
                    ->orderBy('pivot_order', 'asc');
    }

    public function roadmapCourse()
    {
        return $this->hasMany(RoadmapCourse::class,'roadmap_id','id');
    }

}
