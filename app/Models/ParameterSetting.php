<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterSetting extends Model
{
    use HasFactory;

    protected $table = 'parameter_setting';

    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'parameter_name',
        'active',
        'parameter_code',
    ];
}
