<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reportproblem extends Model
{
    use HasFactory;

    protected $table = 'report_problem';

    protected $primaryKey = 'id';

    protected $fillable = [

    ];
    public $timestamps = false;
    
    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }

    public function users()
    {
        return $this->belongsTo(Users::class,'user_id','id');   
        
    }

    public function profile()
    {
        return $this->belongsTo(Profiles::class,'user_id');   
        
    }
    
}
