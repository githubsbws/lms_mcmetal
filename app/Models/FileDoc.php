<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileDoc extends Model
{
    use HasFactory;

    protected $table = 'file_doc';

    protected $primaryKey = 'id';

    protected $fillable = [
        'lesson_id',
        'filename' ,
        'file_name',
        'active',
        'file_position'
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

    public function learnFileDoc()
    {
        return $this->hasMany(LearnFileDoc::class, 'file_doc_id', 'id');
    }

}
