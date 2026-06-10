<?php

namespace App\Http\Controllers;

use App\Models\Contactus;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class ContactusController extends Controller
{
    // function contactus_f(Request $request){
    //     if(Auth::check()){
    //         if ($request->isMethod('post')) {
    //             $validator = Validator::make($request->all(), [
    //                 'contact_by_name' => 'required|string|max:255', // ต้องไม่ว่างเปล่าและมีความยาวไม่เกิน 255 ตัวอักษร
    //                 'contact_by_surname' => 'required|string|max:255', // ต้องไม่ว่างเปล่าและมีความยาวไม่เกิน 255 ตัวอักษร
    //                 'contact_by_email' => 'required|string|email|max:255', // ต้องไม่ว่างเปล่าและเป็นอีเมลที่ถูกต้อง และมีความยาวไม่เกิน 255 ตัวอักษร
    //                 'contact_by_tel' => 'required|string|max:20', // ต้องไม่ว่างเปล่าและมีความยาวไม่เกิน 20 ตัวอักษร (เบอร์โทรศัพท์)
    //                 'contact_by_subject' => 'required|string|max:255', // ต้องไม่ว่างเปล่าและมีความยาวไม่เกิน 255 ตัวอักษร
    //                 'contact_by_detail' => 'required|string', // ต้องไม่ว่างเปล่าและเป็นข้อความ
    //             ]);
    //             if ($validator->fails()) {

    //                 return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
    //             }
    //             $contact_new = new Contactus;
    //             $contact_new->contac_by_name = $request->input('contact_by_name');
    //             $contact_new->contac_by_surname = $request->input('contact_by_surname');
    //             $contact_new->contac_by_email = $request->input('contact_by_email');
    //             $contact_new->contac_by_tel = $request->input('contact_by_tel');
    //             $contact_new->contac_subject = $request->input('contact_by_subject');
    //             $contact_new->contac_detail = $request->input('contact_by_detail');
    //             $contact_new->create_by = Auth::user()->id;
    //             $contact_new->update_by = Auth::user()->id;
    //             $contact_new->active = 'y';
    //             $contact_new->save();
    //             // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต

    //             sleep(10);

    //             return redirect()->route('contactus_f')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
    //         }

    //         return view('contactus_f.contactus_f');
    //     }else{
    //         return view('auth.login');
    //     }
    // }

    public function contactus()
    {
        return view('index.contact');
    }
}
