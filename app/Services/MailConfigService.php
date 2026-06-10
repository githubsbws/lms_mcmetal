<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;

class MailConfigService
{
    public static function apply()
    {
        $setting = Setting::first();

        if (!$setting) {
            return; // ไม่มีข้อมูล ก็ไม่ต้องตั้งค่าอะไร
        }

        // ตั้งค่า mail runtime จาก DB
        Config::set('mail.mailers.smtp.transport', 'smtp');
        // Config::set('mail.mailers.smtp.host', 'webmail.brother.in.th');
        // Config::set('mail.mailers.smtp.port', 465);
        Config::set('mail.mailers.smtp.encryption', 'ssl');
        Config::set('mail.mailers.smtp.username', $setting->settings_user_email);
        Config::set('mail.mailers.smtp.password', $setting->settings_pass_email);

        Config::set('mail.from.address', $setting->settings_user_email);
        Config::set('mail.from.name', config('app.name'));
    }
}
