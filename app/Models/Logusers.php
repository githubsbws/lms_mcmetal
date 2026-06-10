<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logusers extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $connection = 'pgsql_noprefix';

    protected $table = 'log_users';

    protected $primaryKey = 'id';

    protected $fillable = [
        
    ];

    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }

    public function users()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id'); // ตรวจสอบ key ให้ถูกต้อง
    }
}
