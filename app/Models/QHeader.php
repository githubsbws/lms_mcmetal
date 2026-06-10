<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class QHeader extends Model
{
    use HasFactory;
    protected $connection = 'pgsql_noprefix';
    protected $table = 'q_survey_headers';
    protected $prefix = '';
    protected $primaryKey = 'survey_header_id';
    protected $fillable = [
        'survey_name',
        'instructions',
        'active',

    ];
    
    public $timestamps = false;

    public static function findById($id)
    {
        return static::where('survey_header_id', $id)->first();
    }

    public function sections()
    {
        return $this->hasMany(QSection::class,'survey_header_id');   
        
    }
}
