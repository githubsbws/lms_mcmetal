<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filecategory extends Model
{
    protected $table = 'filecategory';
    protected $fillable = [
        'category_id',
        'filename',
        // 'create_date',
        // 'update_date',
    ];
    public $timestamps = false;
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'cate_id');
    }

    public static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $model->update_date = now();
        });
    }
}
