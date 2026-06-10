<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq_type extends Model
{
    use HasFactory;

    protected $connection = 'pgsql_noprefix';

    protected $table = 'cms_faq_type';
    
    protected $prefix = '';

    protected $primarykey = 'faq_type_id';

    const CREATED_AT = 'create_date'; // Custom created_at column
    const UPDATED_AT = 'update_date'; // Custom update_at column

    public static function findById($id)
    {
        return static::where('faq_type_id', $id)->first();
    }
    
}
