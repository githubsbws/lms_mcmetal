<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lesson';

    protected $primaryKey = 'id';
    protected $fillable = [
        'course_id',
        'title' ,
        'description',
        'view_all' ,
        'cate_amount',
        'time_test',
        'content',
        'image',
        'active'
    ];

    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }
    public function file()
    {
        return $this->hasMany(File::class, 'lesson_id', 'id');
    }
    public function filedoc()
    {
        return $this->hasMany(FileDoc::class, 'lesson_id', 'id');
    }

    public function manage()
    {
        return $this->hasMany(Manage::class, 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id','course_id');
    }

    public function Qheader()
    {
        return $this->belongsTo(QHeader::class, 'header_id','survey_header_id');
    }

    public function learn()
    {
        return $this->hasMany(Learn::class, 'lesson_id','id');
    }

}
