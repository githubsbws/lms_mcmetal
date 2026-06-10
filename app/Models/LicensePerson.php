<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicensePerson extends Model
{
    use HasFactory;

    protected $table = 'license_person';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'operation_machine_id',
        'parameter_setting_id',
        'score',
        'license_level',
        'status'
    ];

    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }

    public function user(){
    return $this->belongsTo(Users::class);
    }

    public function operationMachine(){
        return $this->belongsTo(OperationMachine::class);
    }

    public function parameterSetting(){
        return $this->belongsTo(ParameterSetting::class);
    }
}
