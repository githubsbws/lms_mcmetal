<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'file';

    protected $primaryKey = 'id';

    protected $fillable = [
        'views',
        'lesson_id',
        'filename' ,
        'file_name',
        'active',
        'duration'
    ];

    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'id');
    }
    public function learnFile()
    {
        return $this->hasMany(LearnFile::class, 'file_id', 'id');
    }
}
