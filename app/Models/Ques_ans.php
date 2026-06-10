<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ques_ans extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_noprefix';

    protected $table = 'q_answers';

    protected $prefix = '';

    protected $primarykey = 'id';

    protected $fillable = [
        'choice_id'
    ];
    
    public $timestamps = false;

    public static function findById($id)
    {
        return static::where('answer_id', $id)->first();
    }

    public function choice()
    {
        return $this->belongsTo(QChoice::class, 'choice_id');
    }
}
