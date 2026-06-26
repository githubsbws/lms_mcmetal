<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryFile extends Model
{
    use HasFactory;

    protected $table = 'library_file';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'file_id',
        'view',
        'created_date',
        'updated_date',
        'created_by',
        'updated_by',
        'filename',
        'active'
    ];
}
