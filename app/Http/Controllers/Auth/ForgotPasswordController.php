<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Models\Users;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    function forgotPass(){
        return view('forgot.forgot-pass');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'login_or_email' => 'required|string',
        ]);

        $loginOrEmail = $request->input('login_or_email');
        $user = Users::where('username', $loginOrEmail)
                    ->first();

        if (!$user) {
            return back()->with('status', 'เราได้ส่งลิงก์รีเซ็ตรหัสผ่านไปยังอีเมลของคุณแล้ว!');
        }

        $token = Str::random(60);

        // เก็บ token ในตาราง password_resets
        $reset = new PasswordReset;
        $reset->email = $user->email;
        $reset->token = $token;
        $reset->created_at = now();
        $reset->save();

        // ส่งอีเมลรีเซ็ตรหัสผ่าน
        Mail::send('emails.password_reset', ['token' => $token], function($message) use ($user) {
            $message->to($user->email);
            $message->subject('แจ้งเตือนการรีเซ็ตรหัสผ่าน');
        });

        return back()->with('status', 'เราได้ส่งลิงก์รีเซ็ตรหัสผ่านไปยังอีเมลของคุณแล้ว!');
    }

    public function showResetForm($token)
    {
    return view('auth.passwords.reset', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
    $validator = Validator::make($request->all(), [
        'token' => 'required',
        'password' => [
            'required',
            'min:8',
            function ($attribute, $value, $fail) use ($request) {
                // ตรวจสอบว่า password ไม่เป็นตัวเลขเดียวกันทั้งหมด
                if (preg_match('/(\d)\1{7,}/', $value)) {
                    $fail('รหัสผ่านไม่สามารถเป็นตัวเลขเดียวกันซ้ำกันได้');
                }

                // ตรวจสอบว่า password มีอักษรพิเศษอย่างน้อย 1 ตัว
                // if (!preg_match('/[^a-zA-Z0-9]/', $value)) {
                //     $fail('รหัสผ่านต้องมีอักษรพิเศษอย่างน้อย 1 ตัว');
                // }

                // ตรวจสอบว่า password มีตัวอักษรทั้งพิมพ์เล็กและพิมพ์ใหญ่อย่างน้อย 1 ตัว
                if (!preg_match('/[a-z]/', $value) || !preg_match('/[A-Z]/', $value)) {
                    $fail('รหัสผ่านต้องมีตัวอักษรทั้งพิมพ์เล็กและพิมพ์ใหญ่อย่างน้อย 1 ตัว');
                }
            },
        ],
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput($request->only('password'));
    }
    $passwordReset = PasswordReset::where('token', $request->input('token'))->first();

    if (!$passwordReset) {
        return back()->withErrors(['token' => 'โทเค็นไม่ถูกต้อง']);
    }

    $user = Users::where('email', $passwordReset->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'ไม่พบผู้ใช้']);
    }

    $user->password = Hash::make($request->input('password'));
    $user->save();

    // ลบโทเค็นออก
    PasswordReset::where('email', $user->email)->delete();

    return redirect('/logins')->with('status', 'รหัสผ่านของคุณได้ถูกรีเซ็ตเรียบร้อยแล้ว!');
    }

}
