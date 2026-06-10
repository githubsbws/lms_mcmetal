<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logreset extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $table = 'log_reset';

    protected $primaryKey = 'id';

    protected $fillable = [
        
    ];


    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }
}
