<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Profiles;
use App\Models\Line;
use App\Models\Department;
use App\Models\Section;
use App\Models\Position;
use App\Models\Orgchart;
use App\Models\Team;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    //----- หน้า login
    function registers()
    {
        $orgchart = Orgchart::where('active','y')
                    ->where('level',2)
                    ->get();

        $team = Team::where('active','y')->get();

        return view('reg.register',compact('orgchart','team'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => ['required','min:8'],
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'orgchart_id' => 'required',
            'team_id' => 'required',
            'work_start_date' => 'required',

        ],[
            'username.required' => 'กรุณาใส่เลขพนักงาน',
            // 'username.min'      => 'ชื่อผู้ใช้งานต้องมีอย่างน้อย :min ตัวอักษรนะ',
            'password.required'   => 'กรุณาใส่รหัสผ่าน',
            'password.min'   => 'รหัสผ่านต้องมีความยาวอย่างน้อย8หลัก',
            'firstname.required'   => 'กรุณาใส่ชื่อ',
            'lastname.required'   => 'กรุณาใส่นามสกุล',
            'email.required'   => 'กรุณาใส่Email',
            'orgchart_id.required'   => 'กรุณาเลือกแผนกของท่าน',
            'team_id.required'   => 'กรุณาเลือกทีม',
            'work_start_date' => 'กรุณาเลือกวันที่เริ่มงาน'
        ]);

        $user = new Users();

        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->org_id = $request->org_id;
        $user->superuser = 0;
        $user->status = 1;
        $user->del_status = 0;
        $user->team_id = $request->team_id;
        $user->department_org_id = $request->department_id;
        $user->work_start = $request->work_start_date;

        $user->save();

        $profile = new Profiles();

        $profile->user_id = $user->id;
        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;

        $profile->save();


        return redirect()->route('login')->with('success','สมัครสมาชิกเรียบร้อย');
    }

    public function getSubOrg($parentId)
    {
        $subs = Orgchart::where('parent_id', $parentId)
                        ->where('active', 'y')
                        ->get(['id', 'title']);

        return response()->json([
            'data' => $subs,
            'has_child' => $subs->isNotEmpty() // ส่งสถานะไปบอกว่ามีลูกต่อไหม
        ]);
    }
}
