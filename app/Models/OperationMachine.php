<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationMachine extends Model
{
    use HasFactory;

    protected $table = 'operation_machine';

    protected $primaryKey = 'id';
    protected $casts = [
        'line' => 'array', // 🔥 คาถาเสกให้ Laravel แปลง JSON ในเบส ออกมาเป็น Array ของ PHP อัตโนมัติ
    ];

    public $timestamps = false;

    protected $fillable = [
        'operation_name',
        'active',
        'line'
    ];

}
