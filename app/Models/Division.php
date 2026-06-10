<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    
    protected $table = 'division';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'id','company_id', 'dep_code', 'dep_title', 'create_date'
    ];

    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }
}
