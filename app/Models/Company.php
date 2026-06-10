<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    
    protected $table = 'company';

    protected $primaryKey = 'company_id';
    public $timestamps = false;

    protected $fillable = [
        'company_id','company_title'
    ];

    public static function findById($id)
    {
        return static::where('company_id', $id)->first();
    }
}
