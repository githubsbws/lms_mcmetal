<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class VedioController extends Controller
{
    // หน้าเพิ่ม vdo
    function vedio(Request $request, $bank_id)
    {
        $banks = DB::table('bank')->where('bank_id', $bank_id)->first();
        $ascs = DB::table('asc')->pluck('name', 'id');
        $vedios = DB::table('vedio')->get();
        return view('vedio', compact('banks', 'ascs' ,'vedios'));
    }

    // เพิ่ม vdo
    function vedioIn(Request $request)
    {
        try {
            // เริ่มต้น
            DB::beginTransaction();
            // จัดกาวิดีโอ
            $videoFileNames = $request->file('vedio_name');
            $extension_vdo = $videoFileNames->getClientOriginalExtension();
            $filename_vdo = now()->format('Ymd') . rand(10000, 99999) . '_Video.' . $extension_vdo;
            $videoFileNames->storeAs('public/vdo', $filename_vdo);
            $data_vedio = [
                'vedio_name' => $filename_vdo,
            ];
            DB::table('vedio')->insert($data_vedio);
            // จบ
            DB::commit();
            $redirectUrl = route('bank', ['id' => $request->id]);
            return redirect($redirectUrl)->with('message', 'บันทึกข้อมูลสำเร็จ');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการอัปโหลด');
        }
    }
}
