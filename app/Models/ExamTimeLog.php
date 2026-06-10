<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTimeLog extends Model
{
    use HasFactory;

    protected $table = 'exam_time_log';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'course_id',
        'start_at',
        'expire_at',
        'status'
    ];
}
