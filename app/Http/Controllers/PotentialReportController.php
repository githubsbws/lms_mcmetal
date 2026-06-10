<?php

namespace App\Http\Controllers;

use App\Exports\PotentialReportExport;
use App\Models\Course;
use App\Models\Orgchart;
use App\Models\Team;
use App\Services\ReportPotentialService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PotentialReportController extends Controller
{
    public function __construct(
        protected ReportPotentialService $reportPotentialService,
    ) {}

    public function PotentialReport(Request $request)
    {
        if(auth()->check())
        {
            $userDetail = auth()->user();
            $courses = Course::where('active','y')
            ->when(auth()->user()->superuser == 0,function($q){
                return $q->where('create_by',auth()->user()->id);
            })
            ->get();

            $departments = Orgchart::where('id',$userDetail->department_org_id)->first();
            $sections = Orgchart::where('parent_id',$userDetail->department_org_id)->get();
            $teams = Team::where('active','y')->get();

            $potentialData = $this->reportPotentialService->getPotentialData($request);
            // dd($potentialData);
            return view('admin.report.report_learning_potential',compact('potentialData','courses','departments','sections','teams'));
        }
        return redirect()->route('login.admin');
    }

    public function getLines($section_id)
    {
        // ค้นหาคนที่มี parent_id ตรงกับ section ที่ส่งมา
        // อย่าลืม CAST id เป็น string ถ้าใช้ PostgreSQL แล้วเจอปัญหาเดิมนะครับ
        $lines = Orgchart::where('parent_id', (string)$section_id)
                        ->where('active', 'y')
                        ->get(['id', 'title']);

        return response()->json($lines);
    }

    public function exportPotentialReport(Request $request)
    {
        if(auth()->check()) {
        // 1. เรียก Query ข้อมูลดิบเหมือนหน้าค้นหาเป๊ะๆ (ใช้เงื่อนไขเดียวกัน)
        $potentialData = $this->reportPotentialService->getPotentialData($request);
        // 2. ส่งข้อมูลที่ปรุงเสร็จแล้วเข้าไฟล์ Export และสั่ง Download
        $fileName = 'Learning Potential Report' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new PotentialReportExport($potentialData), $fileName);
    }
    return redirect()->route('login.admin');
    }
}
