<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgchartUser extends Model
{
    use HasFactory;

    protected $table = 'orgchart_user';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'orgchart_id',
    ];
    
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ความสัมพันธ์ไปยัง Orgchart
    public function orgchart()
    {
        return $this->belongsTo(Orgchart::class, 'orgchart_id');
    }

    public static function findById($id)
    {
        return static::where('id', $id)->first();
    }
}
