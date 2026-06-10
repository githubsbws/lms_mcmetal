<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Captcha extends Model
{
    use HasFactory;
    protected $connection = 'pgsql_noprefix';

    protected $table = 'config_captcha';

    protected $prefix = '';

    protected $primaryKey = 'capid';
    
    protected $fillable = [
        'cap_active'
        
    ];
    const CREATED_AT = 'created_date'; // Custom created_at column
    const UPDATED_AT = 'updated_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('capid', $id)->first();
    }
}
