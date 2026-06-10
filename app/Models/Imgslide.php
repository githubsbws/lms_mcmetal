<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imgslide extends Model
{
    use HasFactory;
    protected $table = 'imgslide';

    protected $primaryKey = 'imgslide_id';
    
    protected $fillable = ['imgslide_link','imgslide_picture'];

    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column


    public static function findById($id)
    {
        return static::where('imgslide_id', $id)->first();
    }
}
