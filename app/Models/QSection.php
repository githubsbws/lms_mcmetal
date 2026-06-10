<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class QSection extends Model
{
    use HasFactory;
    protected $connection = 'pgsql_noprefix';
    protected $table = 'q_survey_sections';
    protected $prefix = '';
    protected $primaryKey = 'survey_section_id';

    protected $fillable = [
        'survey_header_id',
        'section_title',
        'section_required_yn'
    ];
    
    public $timestamps = false;

    public static function findById($id)
    {
        return static::where('survey_section_id', $id)->first();
    }

    public function header()
    {    
        return $this->belongsTo(QHeader::class,'survey_header_id');   
    }

    public function questions()
    {    
        return $this->hasMany(QQuestion::class,'survey_section_id');   
    }
}
