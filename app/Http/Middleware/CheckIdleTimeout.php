<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\Store;

class CheckIdleTimeout
{
    protected $session;
    protected $timeout = 70; // หน่วยเป็นนาที

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function handle($request, Closure $next)
    {
        // ตรวจสอบว่าผู้ใช้เข้าสู่ระบบอยู่หรือไม่
        if (Auth::check()) {
            $lastActivity = $this->session->get('last_activity');

            // ถ้ามีการกิจกรรมล่าสุดและเวลาผ่านไปมากกว่า timeout
            if (!is_null($lastActivity) && time() - $lastActivity > $this->timeout * 60) {
                Auth::logout();

                $this->session->flush(); // เคลียร์ session หลังจาก logout

                return redirect()->route('login')->with('หมดเวลาการเชื่อมต่อ', 'กรุณาเข้าสู่ระบบใหม่อีกครั้ง.');
            }

            // บันทึกเวลาล่าสุดที่มีกิจกรรมใน session
            $this->session->put('last_activity', time());
        }

        return $next($request);
    }
}
