<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationMachine extends Model
{
    use HasFactory;

    protected $table = 'operation_machine';

    protected $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'operation_name',
        'active',
        'operation_code'
    ];

}
