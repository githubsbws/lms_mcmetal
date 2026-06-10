<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pgroup extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_noprefix';
    protected $table = 'p_group';
    protected $primaryKey = 'id';
    protected $fillable = [
        'group_name',
        'active',
        'create_by',               
        'update_by'
    ];

    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }
}
