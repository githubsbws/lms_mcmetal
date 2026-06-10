<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $primaryKey = 'user_id';
    public $timestamps = false;
    
    protected $fillable = [
        'user_id','title_id', 'firstname', 'lastname', 'firstname_en', 'lastname_en','identification','phone', 'advisor_email1', 'advisor_email2'
    ];

    public function user()
    {
        return $this->hasOne(Users::class,'id','user_id');
    }
    public function ProfTitle()
    {
        return $this->belongsTo(ProfilesTitle::class,'prof_id','title_id');
    }
    public function Fullname()
    {
        if($this->firstname != null && $this->lastname != null)
        {
            return $this->firstname . ' ' . $this->lastname;
        }else{
            return $this->firstname = "-".' '.$this->lastname = "-";
        }
        
    }
    public function FullnameEn()
    {
        return $this->firstname_en . ' ' . $this->lastname_en;
    }
}