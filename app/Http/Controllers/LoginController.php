<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    //----- หน้า login
    function login()
    {
        return view('login');
    }
    //----- ตรวจสอบความถูกต้องหลังกด login
    function login_in(Request $request): RedirectResponse
    {
        $email = $request->input('email');
        $password = md5($request->input('password'));
        $users = User::where('email', $email)->first();
        if ($users && $users->password == $password) {
            return redirect()->route('bank', ['id' => $users->id])->with('users', $users);
        }
        return redirect()->route('login')->with('error', 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง')->onlyInput('email');
    
    }
    
    //----- ออกจากระบบ
    function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->forget('key');
        return redirect('/');
    }
}
