<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orgcourse extends Model
{
    use HasFactory;

    protected $table = 'org_course';

    protected $primaryKey = 'id';

    protected $fillable = [
        'active'
    ];

    public $timestamps = false;
    
    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }
}
