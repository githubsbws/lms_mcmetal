<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class EditController extends Controller
{
   //----- แก้ไขข้อมูล
   function edit(Request $request,$bank_id)
   {
       $banks = DB::table('bank')->where('bank_id', $bank_id)->first();
       $ascs = DB::table('asc')->pluck('name', 'id');
       return view('edit', compact('banks', 'ascs'));
   }

   //----- อัปเดตข้อมูลที่ฐานข้อมูล
   function update(Request $request, $bank_id)
   {
       $request->validate([
           'bank_user' => 'required|string|max:50',
           'bank_name' => 'required|string|max:50',
           'bank_branch' => 'required|string|max:50',
           'bank_number' => 'required|string|max:50',
           'bank_picture_n' => 'image|mimes:jpeg,png,jpg,gif',
           'update_date' => 'required',
       ], [
           'bank_user.required' => 'กรุณากรอกชื่อเจ้าของบัญชี',
           'bank_name.required' => 'กรุณากรอกชื่อธนาคาร',
           'bank_branch.required' => 'กรุณากรอกชื่อสาขา',
           'bank_number.required' => 'กรุณากรอกเลขบัญชี',
           'update_date.required' => 'กรุณาใส่วันที่',
           'bank_picture_n.image' => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพ',
           'bank_picture_n.mimes' => 'รูปภาพต้องมีนามสกุล jpeg, png, jpg, หรือ gif',
       ]);
       // จัดการการอัพโหลดไฟล์
       $uploadedFile = $request->file('bank_picture_n');
       if ($uploadedFile) {
           $extension = $uploadedFile->getClientOriginalExtension();
           // ตั้งชื่อไฟล์
           $filename = now()->format('Ymd') . rand(10000, 99999) . '_Picture.' . $extension;
           // บันทึกไฟล์
           $uploadedFile->storeAs('public/images', $filename);
           // อัปเดตไฟล์ลงฐานข้อมูล
           DB::table('bank')->where('bank_id', $bank_id)->update([
               'bank_picture' => $filename,
           ]);
       }
       // จัดการการอัพโหลดไฟล์ vdo
       $uploadedFile_vdo = $request->file('bank_vdo_n');
       if ($uploadedFile_vdo) {
           $extension_vdo = $uploadedFile_vdo->getClientOriginalExtension();
           // ตั้งชื่อไฟล์
           $filename_vdo = now()->format('Ymd') . rand(10000, 99999) . '_Video.' . $extension_vdo;
           // บันทึกไฟล์
           $uploadedFile_vdo->storeAs('public/vdo', $filename_vdo);
           // อัปเดตไฟล์ลงฐานข้อมูล
           DB::table('bank')->where('bank_id', $bank_id)->update([
               'bank_vdo' => $filename_vdo,
           ]);
       }
       $data = [
           'bank_user' => $request->input('bank_user'),
           'bank_name' => $request->input('bank_name'),
           'bank_branch' => $request->input('bank_branch'),
           'bank_number' => $request->input('bank_number'),
           'create_date' => $request->input('create_date'),
           'update_date' => $request->input('update_date'),
       ];
       DB::table('bank')->where('bank_id', $bank_id)->update($data);
       $redirectUrl = route('bank', ['id' => $request->id]);
       return redirect($redirectUrl)->with('message', 'แก้ไขข้อมูลสำเร็จ');
   }
   
   //----- อัปเดตสถานะ
   function change($bank_id)
   {
       $banks = DB::table('bank')->where('bank_id', $bank_id)->first();
       // ตรวจสอบค่าปัจจุบันของ 'active' และกำหนดค่าใหม่
       $newActive = ($banks->active == 'y') ? 'n' : 'y';
       $data = [
           'active' => $newActive,
       ];
       DB::table('bank')->where('bank_id', $bank_id)->update($data);
       return redirect('bank');
   }
}
