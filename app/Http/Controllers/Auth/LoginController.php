<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('checkIdleTimeout'); // Middleware ตรวจสอบ Session Idle Timeout
        $this->middleware('single_login')->only('login'); // Middleware จำกัดการเข้าถึงเพียงคนเดียว
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // ตรวจสอบข้อมูลเข้าสู่ระบบ
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => [
                'required',
                'min:8', // ต้องมีความยาวอย่างน้อย 8 ตัวอักษร
            ],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->only('username'));
        }

        // ตรวจสอบว่าข้อมูลที่กรอกมาเป็น email หรือไม่
        $usernameInput = $request->input('username');
        // สร้างข้อมูล credentials
        $credentials = ['username' => $usernameInput, 'password' => $request->input('password')];


        if (Auth::attempt($credentials)) {
            // Authentication passed
            $user = Auth::user();
            $user->_token = $request->session()->get('_token'); // หรือดึงจาก $request->_token ตามที่ถูกต้อง
            $user->tokens()->delete();

        // [Standards] ออกกุญแจใหม่ใบเดียว
        // plainTextToken คือสิ่งที่จะส่งไปให้หน้าบ้าน ส่วนใน DB จะเก็บเป็น Hash SHA-256
            $token = $user->createToken('web_access_token')->plainTextToken;

            $ipAddress = request()->ip();
            $user->last_ip = $ipAddress;
            $user->last_activity = now();
            $user->save();

            return redirect()->intended('/index')->with('api_token', $token);
        } else {
            // Authentication failed
            return back()->withErrors(['username' => 'username or password is incorrect']);
        }
    }
    public function logout(Request $request)
{
    // ตรวจสอบการ login และหากเข้าสู่ระบบอยู่ให้ตั้งค่า online_status เป็น false
    if (Auth::check()) {
        $user = Auth::user();
        $user->online_status = 0;
        $user->last_activity = now();
        $user->lastvisit_at = now();
        $user->save();
    }

    // ลบ Cookie 'api_token'
    cookie()->forget('api_token');

    // ทำการ logout ผู้ใช้จากระบบ
    Auth::logout();

    // Redirect ไปยังหน้าแรกหรือหน้าอื่น ๆ ตามที่ต้องการ
    return redirect('/');
}
}
