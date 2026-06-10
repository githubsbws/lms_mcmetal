<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearnFile extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'learn_file';

    protected $primaryKey = 'learn_file_id';

    protected $fillable = [
        'learn_id',
        'file_id',
        'learn_file_date',
        'learn_file_status',
        'last_watched_second',
        'pass_year'
    ];

    public static function findById($id)
    {
        return static::where('learn_file_id', $id)->first();
    }
    public function learn()
    {
        return  $this->belongsTo(Learn::class,'learn_id','learn_id');
    }
}
