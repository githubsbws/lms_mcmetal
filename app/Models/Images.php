<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    protected $table = 'images';

    protected $primaryKey = 'image_id';
    
    protected $fillable = ['image_time','user_id','lesson_id','file_id'];

    public $timestamps = false;


    public static function findById($id)
    {
        return static::where('image_id', $id)->first();
    }
}
