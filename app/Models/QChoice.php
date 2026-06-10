<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class QChoice extends Model
{
    use HasFactory;
    protected $connection = 'pgsql_noprefix';
    protected $table = 'q_option_choices';
    protected $prefix = '';
    protected $primaryKey = 'option_choice_id';
    protected $fillable = [
        'question_id',
        'option_choice_name',
        'option_choice_type'
    ];
    
    public $timestamps = false;

    public static function findById($id)
    {
        return static::where('option_choice_id', $id)->first();
    }

    public function question()
    {    
        return $this->belongsTo(QQuestion::class,'question_id');   
    }

    public function answers()
    {    
        return $this->hasMany(Ques_ans::class,'choice_id');   
    }
}
