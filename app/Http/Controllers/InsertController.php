<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class InsertController extends Controller
{
    //----- หน้าส่งเพิ่มข้อมูลBank
    function insert(Request $request)
    {
        $request->validate([
            'bank_user' => 'required|string|max:50',
            'bank_name' => 'required|string|max:50',
            'bank_branch' => 'required|string|max:50',
            'bank_number' => 'required|string|max:50',
            'bank_picture' => 'required|image|mimes:jpeg,png,jpg,gif',
            // 'bank_vdo' => 'required|mimetypes:video/mp4|max:10240',
            'create_date' => 'required',
        ], [
            'bank_user.required' => 'กรุณากรอกชื่อเจ้าของบัญชี',
            'bank_name.required' => 'กรุณากรอกชื่อธนาคาร',
            'bank_branch.required' => 'กรุณากรอกชื่อสาขา',
            'bank_number.required' => 'กรุณากรอกเลขบัญชี',
            'create_date.required' => 'กรุณาใส่วันที่',
            'bank_picture.required' => 'กรุณาใส่รูป',
            'bank_picture.image' => 'ไฟล์ที่อัปโหลดต้องเป็นรูปภาพ',
            'bank_picture.mimes' => 'รูปภาพต้องมีนามสกุล jpeg, png, jpg, หรือ gif',
            // 'bank_vdo.mimetypes' => 'ไฟล์ที่อัปโหลดต้องเป็นวิดีโอ',
            // 'bank_vdo.max' => 'ขนาดวีดีโอ 10 MB',
        ]);
        // จัดการการอัพโหลดไฟล์รูป
        $uploadedFile = $request->file('bank_picture');
        $extension = $uploadedFile->getClientOriginalExtension();
        $filename = now()->format('Ymd') . rand(10000, 99999) . '_Picture.' . $extension;
        $uploadedFile->storeAs('public/images/', $filename);
        // รับข้อมูลเก็บไว้ที่ตัวแปร data และส่งไปที่ตาราง tbl_bank
        $data_bank = [
            'bank_user' => $request->input('bank_user'),
            'bank_name' => $request->input('bank_name'),
            'bank_branch' => $request->input('bank_branch'),
            'bank_number' => $request->input('bank_number'),
            'create_date' => $request->input('create_date'),
            'update_date' => $request->input('create_date'),
            'bank_picture' => $filename,
            // 'bank_vdo' => $filename_vdo,
        ];
        DB::table('bank')->insert($data_bank);
        $redirectUrl = route('bank', ['id' => $request->id]);
        return redirect($redirectUrl)->with('message', 'บันทึกข้อมูลสำเร็จ');
    }
}
