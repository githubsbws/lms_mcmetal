<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Learn extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'learn';

    protected $primaryKey = 'learn_id';

    protected $fillable = [
        'course_id',
        'user_id',
        'lesson_id',
        'learn_date',
        'created_at',
        'lesson_status',
        'pass_year'
    ];

    public static function findById($id)
    {
        return static::where('learn_id', $id)->first();
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class,'lesson_id','id');
    }
}
