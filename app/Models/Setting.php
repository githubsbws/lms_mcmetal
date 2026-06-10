<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'setting';

    protected $primaryKey = 'setting_id';

    public static function findById($id)
    {
        return static::where('setting_id', $id)->first();
    }
}
