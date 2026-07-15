<?php

namespace App\Http\Controllers;

use App\Facades\AuthFacade;
use App\Imports\OperationMachineImport;
use App\Imports\ParameterMachineImport;
use App\Models\OperationMachine;
use App\Models\ParameterSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class LicensePersonController extends Controller
{
    public function indexOperate(){
        if(AuthFacade::useradmin()){
            $licenseOperate = OperationMachine::where('active','y')->orderBy('id','ASC')->paginate(20);
            return view("admin.licenseperson.operate",compact('licenseOperate'));
        }
        return redirect()->route('login.admin');
    }

    public function indexParameter(){
        if(AuthFacade::useradmin()){
            $licenseParameter = ParameterSetting::where('active','y')->orderBy('id','ASC')->paginate(20);
            return view("admin.licenseperson.parameter",compact('licenseParameter'));
        }
        return redirect()->route('login.admin');
    }


    public function operateImportExcel(Request $request)
    {
        $request->validate(['excel_file' => ['required','file','mimes:xlsx,xls','max:51200', ],// 50MB
        ]);

        try {
            // ใช้ Transaction คลุมเพื่อให้เกิด Atomicity (All or Nothing)
            DB::transaction(function () use ($request) {
                Excel::import(new OperationMachineImport, $request->file('excel_file'));
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Imported successfully'
            ]);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // ดึง Error จากแถวใน Excel มาโชว์ (Defensive)
            return back()->with('import_errors', $e->failures());
        } catch (\Exception $e) {
            Log::error("Import Error: " . $e->getMessage());
            return back()->with('error', 'ระบบขัดข้อง: ' . $e->getMessage());
        }
    }

    public function parameterImportExcel(Request $request)
    {
        $request->validate(['excel_file' => ['required','file','mimes:xlsx,xls','max:51200', ],// 50MB
        ]);

        try {
            // ใช้ Transaction คลุมเพื่อให้เกิด Atomicity (All or Nothing)
            DB::transaction(function () use ($request) {
                Excel::import(new ParameterMachineImport, $request->file('excel_file'));
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Imported successfully'
            ]);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // ดึง Error จากแถวใน Excel มาโชว์ (Defensive)
            return back()->with('import_errors', $e->failures());
        } catch (\Exception $e) {
            Log::error("Import Error: " . $e->getMessage());
            return back()->with('error', 'ระบบขัดข้อง: ' . $e->getMessage());
        }
    }

    public function operateEdit(Request $request, $id)
    {
        $operation = OperationMachine::findOrFail($id);
        if($request->isMethod('post'))
            {
                $operation_update = OperationMachine::findOrFail($id);
                // 1. รับก้อนข้อความดิบมาจากหน้าบ้าน เช่น "mix 1 ,  mix 2 ,mix 3 "
                $linesString = $request->input('lines_string', '');

                $cleanLines = [];
                if (!empty($linesString)) {
                    // 2. 🧙‍♂️ ใช้สูตรเดิม: ตัดคอมม่า -> ลบช่องว่างหัวท้าย -> กรองค่าว่างออก
                    $cleanLines = array_values(array_filter(array_map('trim', explode(',', $linesString))));
                }

                // 3. สั่งอัปเดตลง PostgreSQL ในรูปแบบ JSONB สวยๆ ปิดประตูบั๊กคำแฝง
                $operation_update->update([
                    'operation_name' => $request->input('operation_name'),
                    'line'          => $cleanLines, // เซฟเป็น Array คลีนๆ เข้าฟิลด์ JSON
                ]);
                return redirect()->route('license.operate.index')->with('success','บันทึกสำเร็จ');

            }
        return view('admin.licenseperson.operate_edit',compact('operation'));

    }

    public function parameterEdit(Request $request, $id)
    {
        $parameter = ParameterSetting::findOrFail($id);
        if($request->isMethod('post'))
            {
                $parameter_update = ParameterSetting::findOrFail($id);
                // 1. รับก้อนข้อความดิบมาจากหน้าบ้าน เช่น "mix 1 ,  mix 2 ,mix 3 "
                $linesString = $request->input('lines_string', '');

                $cleanLines = [];
                if (!empty($linesString)) {
                    // 2. 🧙‍♂️ ใช้สูตรเดิม: ตัดคอมม่า -> ลบช่องว่างหัวท้าย -> กรองค่าว่างออก
                    $cleanLines = array_values(array_filter(array_map('trim', explode(',', $linesString))));
                }

                // 3. สั่งอัปเดตลง PostgreSQL ในรูปแบบ JSONB สวยๆ ปิดประตูบั๊กคำแฝง
                $parameter_update->update([
                    'parameter_name' => $request->input('parameter_name'),
                    'line'          => $cleanLines, // เซฟเป็น Array คลีนๆ เข้าฟิลด์ JSON
                ]);
                return redirect()->route('license.parameter.index')->with('success','บันทึกสำเร็จ');

            }
        return view('admin.licenseperson.parameter_edit',compact('parameter'));

    }

    public function operateDelete($id)
    {
        $operation = OperationMachine::findOrFail($id);
        $operation->update([
            'active' => 'n'
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'ลบข้อมูลสำเร็จ'
        ]);
    }

    public function parameterDelete($id)
    {
        $parameter = ParameterSetting::findOrFail($id);
        $parameter->update([
            'active' => 'n'
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'ลบข้อมูลสำเร็จ'
        ]);
    }

}
