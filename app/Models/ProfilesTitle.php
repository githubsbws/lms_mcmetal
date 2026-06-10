<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilesTitle extends Model
{
    use HasFactory;

    protected $table = 'profiles_title';

    protected $primarykey = 'prof_id';
    public $timestamps = false;

    protected $fillable = [
        'prof_id','prof_title'
    ];
}
