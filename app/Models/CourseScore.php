<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseScore extends Model
{
    use HasFactory;

    protected $table = 'coursescore';

    protected $primaryKey = 'score_id';

    public $timestamps = false;

    protected $fillable = [
       'course_id',
       'user_id',
       'type',
       'score_number',
       'score_total',
       'score_status',
       'active',
       'create_date',
       'pass_year'
    ];


}
