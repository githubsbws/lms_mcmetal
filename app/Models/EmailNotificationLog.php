<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailNotificationLog extends Model
{
    use HasFactory;

    protected $table = 'email_notification_log';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
       'supervisor_id',
       'supervisor_email',
       'status',
       'error_log',
       'run_at',
    ];
}
