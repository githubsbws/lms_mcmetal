<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'certificate';

    protected $primaryKey = 'id';

    protected $fillable = [
        'cert_name',
        'cert_pic',
        'cert_course',
        'created_by',
        'updated_by',
        'active',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    
    public function course()
    {
        return $this->belongsTo(Course::class, 'cert_course','course_id');
    }
}
