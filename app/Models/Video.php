<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $table = 'vdo';
    protected $primaryKey = 'vdo_id';
    protected $fillable = ['vdo_title','vdo_path'];
}
