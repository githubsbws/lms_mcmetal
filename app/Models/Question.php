<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'question';

    protected $primaryKey = 'ques_id';

    protected $fillable = [
        'step_id',
        'active',
        'ques_type',
        'ques_title',
        'ques_explain',
        'group_id',
        'create_by',
        'update_by',
        'answer'
    ];


    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('ques_id', $id)->first();
    }

    public function choices()
    {
        return $this->hasMany(Choice::class, 'ques_id', 'ques_id');
    }

    // ถ้าต้องการเฉพาะ choice ที่เป็นคำตอบ (choice_answer = '1')
    public function correctChoices()
    {
        return $this->hasMany(Choice::class, 'ques_id', 'ques_id')
                    ->where('active','y')
                    ->where('choice_answer', '1');
    }
    public function images()
    {
        return $this->hasMany(QuestionImage::class, 'ques_id', 'ques_id');
    }

    public function groupTesting()
    {
        return $this->belongsTo(Grouptesting::class, 'group_id', 'group_id');
    }

}
