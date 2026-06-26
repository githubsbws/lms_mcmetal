<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profiles;
use App\Models\Users;

class Logadmin extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $connection = 'pgsql_noprefix';

    protected $table = 'log_admin';

    protected $primaryKey = 'id';

    protected $fillable = [
        
    ];

    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }

    public function profile()
    {
        return $this->hasOne(Profiles::class, 'user_id', 'user_id');
    }
}
