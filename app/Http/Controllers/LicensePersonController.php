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
            $licenseOperate = OperationMachine::where('active','y')->get();
            return view("admin.licenseperson.operate",compact('licenseOperate'));
        }
        return redirect()->route('login.admin');
    }

    public function indexParameter(){
        if(AuthFacade::useradmin()){
            $licenseParameter = ParameterSetting::where('active','y')->get();
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

            return back()->with('success', 'นำเข้าข้อมูลรายการเรียบร้อยแล้ว');
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

            return back()->with('success', 'นำเข้าข้อมูลรายการเรียบร้อยแล้ว');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // ดึง Error จากแถวใน Excel มาโชว์ (Defensive)
            return back()->with('import_errors', $e->failures());
        } catch (\Exception $e) {
            Log::error("Import Error: " . $e->getMessage());
            return back()->with('error', 'ระบบขัดข้อง: ' . $e->getMessage());
        }
    }


}
