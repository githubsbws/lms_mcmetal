<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $primaryKey = 'cate_id';
    protected $fillable = [
        'cate_title',
        'cate_short_detail',
        'cate_detail',
        'cate_image',
        'create_date',
        'update_date',
        'active',
        'cate_org_id'
    ];
    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('cate_id', $id)->first();
    }
}
