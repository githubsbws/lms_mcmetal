<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Downloadtitle;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Profiles;
use App\Models\Users;
use App\Models\Company;
use App\Models\Division;
use App\Models\Position;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
   function profile(){
      if((Auth::check())){
         $profile = Profiles::where('user_id',Auth::user()->id)->first();
         if(!$profile){
            return redirect()->route('create.profile');
         }
         $company = Company::where('company_id',Auth::user()->company_id)->first();
         $division = Division::where('id',Auth::user()->division_id)->first();
         $position = Position::where('id',Auth::user()->position_id)->first();
         return view("profile.profile",['profile' => $profile,'company' => $company,'division' => $division,'position' => $position]);
      }
      return redirect()->route('index');
   }

   public function repass(Request $request){
      if((Auth::check())){
         $validator = Validator::make($request->all(), [
            'password' => [
                  'required',
                  'min:8',
                  function ($attribute, $value, $fail) use ($request) {
                     // ตรวจสอบว่า password ไม่เป็นตัวเลขเดียวกันทั้งหมด
                     if (preg_match('/(\d)\1{7,}/', $value)) {
                        $fail('รหัสผ่านไม่สามารถเป็นตัวเลขเดียวกันซ้ำกันได้');
                     }
                     
                     // ตรวจสอบว่า password มีอักษรพิเศษอย่างน้อย 1 ตัว
                     if (!preg_match('/[^a-zA-Z0-9]/', $value)) {
                        $fail('รหัสผ่านต้องมีอักษรพิเศษอย่างน้อย 1 ตัว');
                     }
                     
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
         $user = Users::where('id',Auth::user()->id)->first();
         // dd($user);
         if($request){
            $password = Hash::make($request->input('password'));

            if($user){
               $user->password = $password;
               $user->save();
            }
         }
         return redirect()->route('profile');
      }
      return redirect()->route('index');
   }

   public function create_profile(Request $request){
      if((Auth::check())){
         $company = Company::where('company_id',Auth::user()->company_id)->first();
         $division = Division::where('id',Auth::user()->division_id)->first();
         $position = Position::where('id',Auth::user()->position_id)->first();
         if ($request->isMethod('post')) {
            // dd($request->toArray());
            $validator = Validator::make($request->all(), [
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'identification' => [
                     'required',
                     'regex:/^[0-9]{13}$/',
                  ],
            ]);
            
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }

            $profile =  new Profiles;
            $profile->user_id = Auth::user()->id;
            $profile->firstname = $request->input('firstname');
            $profile->firstname_en = $request->input('firstname_en');
            $profile->lastname = $request->input('lastname');
            $profile->lastname_en = $request->input('lastname_en');
            $profile->identification = $request->input('identification');
            $profile->phone = $request->input('phone');
            $profile->save();

            return redirect()->route('profile')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
         return view("profile.createprofile",['company' => $company,'division' => $division,'position' => $position]);
      }
      return redirect()->route('index');
   }
}
