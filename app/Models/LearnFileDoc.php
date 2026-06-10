<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearnFileDoc extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'learn_file_doc';

    protected $primaryKey = 'learn_file_doc_id';

    protected $fillable = [
        'learn_id',
        'file_doc_id',
        'learn_file_doc_status',
        'learn_file_doc_date',
        'pass_year'
    ];

    public function learn()
    {
        return  $this->belongsTo(Learn::class,'learn_id','learn_id');
    }
}
