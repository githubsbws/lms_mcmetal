<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class ForgotController extends Controller
{
    function forgotPass(){
        return view('forgot.forgot-pass');
    }

    function forgotRecovery(Request $request){
        $username = $request->input('UserRecoveryForm.login_or_email');
        // เช็คฐานข้อมูล
        $users = User::where('username', $username)
        ->orWhere('email', $username)
        ->first();
        $password = $users->password;
        // dd($password);
        return redirect()->route('forgot.pass')->with('show', $password);
    }
}
