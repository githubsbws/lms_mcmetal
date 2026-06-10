<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_noprefix';

    protected $table = 'cms_faq';

    protected $prefix = '';

    protected $primaryKey = 'faq_nid_';

    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('faq_nid_', $id)->first();
    }

    public function faqtype()
    {
        return $this->belongsTo(Faq_type::class, 'faq_type_id');
    }
    
}
