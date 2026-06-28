<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ReportProblem;

class ReportProblemController extends Controller
{
    function index(){
        return view("reportproblem.index");
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'fullname'      => 'required',
                'lastname'      => 'required',
                'email'         => 'required|email',
                'report_type'   => 'required',
                'report_title'  => 'required',
                'report_detail' => 'required',
                'report_pic'    => 'nullable|image|max:2048',
            ]);

            $report = new ReportProblem();

            if(Auth::check()){
                $report->user_id = Auth::id();
                $report->type_user = 1;
            }else{
                $report->type_user = 2;
            }

            $report->fullname = $request->fullname;
            $report->lastname = $request->lastname;
            $report->companyname = $request->companyname;
            $report->agency = $request->agency;
            $report->email = $request->email;
            $report->tel = $request->tel;
            $report->report_type = $request->report_type;
            $report->report_title = $request->report_title;
            $report->report_course = $request->report_course;
            $report->report_detail = $request->report_detail;

            if($request->hasFile('report_pic')){
                $filename = time().'.'.$request->report_pic->extension();
                $request->report_pic->move(public_path('uploads/report_problem'),$filename);
                $report->report_pic = $filename;
            }

            $report->report_date = now();
            $report->status = 'waiting';

            $report->save();

            return redirect()->back()->with('success','ส่งข้อมูลเรียบร้อย');
            } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง');
        }
    }
}
