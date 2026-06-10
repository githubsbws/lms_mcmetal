<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'position';

    protected $primarykey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id','company_id', 'position_title', 'create_date'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
