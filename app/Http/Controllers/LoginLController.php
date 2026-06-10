<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class LoginLController extends Controller
{
    function loginL()
    {
        // ตรวจสอบว่าผู้ใช้เคยทำการเข้าสู่ระบบไว้แล้วหรือไม่
        if (Auth::check()) {
            // ถ้าเคยเข้าสู่ระบบแล้ว ให้เปลี่ยนไปที่หน้าindex
            return redirect()->route('index');
        }
        // ถ้ายังไม่ได้เข้าสู่ระบบให้แสดงหน้า login
        return view('login.login');
    }

    // ตรวจสอบข้อมูล
    function login_to(Request $request)
    {
        // ดึงข้อมูล
        $username = $request->input('UserLogin.username');
        $password = md5($request->input('UserLogin.password'));
        $remember = $request->input('UserLogin.rememberMe');

        // ตรวจสอบฐานข้อมูล
        $user = User::where('username', $username)
            ->orWhere('email', $username)
            ->first();
        // dd($credentials);
        // ทำการเข้าสู่ระบบ
        if ($user && $user->password === $password) {
            // เช็คจดจำ
            if ($remember == 1) {
                Auth::login($user);
                return redirect()->route('index');
            }
            // Redirect ไปที่หน้า user
            return redirect()->route('index');
        } else {
            // เข้าสู่ระบบไม่สำเร็จ, ให้กลับไปหน้า login พร้อมแจ้งเตือน
            return redirect()->route('login.login')->with('error', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง')->withInput(['username' => $username, 'remember' => $remember]);
        }
    }

    //----- ออกจากระบบ
    function logout_t(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->forget('key');
        return redirect('/login/login');
    }
}
