<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $table = 'users';

    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'created_at', 'id', 'username', 'password', 'email',
        'company_id', 'division_id', 'position_id', 'pic_user', 'department_id', 'activkey', 'create_at', 'lastvisit_at', 'superuser', 'status', 'online_status', 'online_user', 'last_ip', 'last_activity',
        'avatar', '_token', 'group', 'del_status', 'asc_id'
      ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        '_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //-------------relations----------------//

    public function profile()
    {
        return $this->hasOne(Profiles::class, 'user_id', 'id');
    }

    
}
