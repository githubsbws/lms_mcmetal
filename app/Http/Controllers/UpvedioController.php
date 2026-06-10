<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class UpvedioController extends Controller
{
    // หน้า up load vdo
    function up_vedio(Request $request, $bank_id)
    {
        $banks = DB::table('bank')->where('bank_id', $bank_id)->first();
        $ascs = DB::table('asc')->pluck('name', 'id');
        $vedios = DB::table('vedio')->get();
        return view('vedioup', compact('banks', 'ascs', 'vedios'));
    }

    // up load
    function vedioInUp(Request $request)
    {
        // เริ่มต้น
        DB::beginTransaction();
        $check_user = DB::table('showvdo')->where('showvdo_username', $request)->count();
        // ดึงค่าเพื่อมาเช็คไอดี
        $bankUserInput = $request->input('bank_user');
        $bank_username = DB::table('asc')->where('name', $bankUserInput)->first();
        if (!$bank_username) {
            return redirect()->with('error', 'เกิดข้อผิดพลาดที่ชื่อ');
        }
        $bankUserId = $bank_username->id;
        $check_user = DB::table('showvdo')->where('showvdo_username', $bankUserId)->count();
        // เช็คการอัปวิดีโอ
        if ($check_user < 3) {
            // จัดกาวิดีโอ
            $vdo_name = $request->input('vdo_name');
            $vdo_nameuser = DB::table('vedio')->where('vedio_name', $vdo_name)->first();
            if (!$vdo_nameuser) {
                return redirect()->back()->with('error', 'ไม่พบข้อมูลวิดีโอที่มีชื่อนี้');
            }
            $vdoUserId = $vdo_nameuser->id;
            // จัดเก็บข้อมูล
            $data_vedio = [
                'showvdo_vdo' => $vdoUserId,
                'showvdo_username' => $bankUserId,
            ];
            DB::table('showvdo')->insert($data_vedio);
            // จบ
            DB::commit();
            $redirectUrl = route('bank', ['id' => $vdo_nameuser->id]);
            return redirect($redirectUrl)->with('message', 'บันทึกข้อมูลสำเร็จ');
        }
        else {
            // ถ้าเต็มแล้ว
            return redirect()->back()->with('error', 'ไม่สามารถเพิ่มข้อมูลได้ เนื่องจากข้อมูลเต็ม');
        }
    }
}
