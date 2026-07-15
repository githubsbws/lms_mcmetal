<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterSetting extends Model
{
    use HasFactory;

    protected $table = 'parameter_setting';

    protected $primaryKey = 'id';
    protected $casts = [
        'line' => 'array', // 🔥 คาถาเสกให้ Laravel แปลง JSON ในเบส ออกมาเป็น Array ของ PHP อัตโนมัติ
    ];

    public $timestamps = false;

    protected $fillable = [
        'parameter_name',
        'active',
        'line',
    ];
}
