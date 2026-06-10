<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTokenValidity
{
    public function handle(Request $request, Closure $next)
    {
        // ตรวจสอบความถูกต้องของ _token จาก Session และฐานข้อมูล
        $user = Auth::user();
        $sessionToken = $request->session()->get('_token');

        if ($user && $sessionToken && $user->_token !== $sessionToken) {
            // ลบ Session เก่าออก
            $request->session()->invalidate();

            // เก็บ Session ใหม่
            $request->session()->regenerate();

            Auth::logout();
            // ให้ session ใหม่
            return redirect()->route('login')
                ->withErrors(['username' => 'มีผู้ใช้เข้าสู่ระบบ กรุณาเข้าสู่ระบบใหม่']);
        }

        return $next($request);
    }
}
