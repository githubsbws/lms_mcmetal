<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Roadmap;
use App\Models\RoadmapCourse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoadmapController extends Controller
{
    public function indexNewEmp(Request $request) {
        $newEmpRoadmap = Roadmap::with('roadmapCourse')
                                ->where('department_org_id',Auth::user()->department_org_id)
                                ->where('active','y')
                                ->when($request->search, function($query, $search) {
                                    return $query->where('name', 'LIKE', "%{$search}%");
                                })->get();

        if ($request->ajax()) {
            // ส่งกลับเฉพาะส่วนที่อยู่ใน fragment 'roadmap-cards' ของหน้าเดิม
            return view('admin.roadmap.newemp', compact('newEmpRoadmap'))->fragment('roadmap-cards'); //แดงเฉยๆ intelephense มันอัพเดตไม่ถึง fragment
        }
        return view('admin.roadmap.newemp',compact('newEmpRoadmap'));
    }

    public function newEmpDetail(Request $request) {
        $roadmapCourse = Roadmap::with(['roadmapCourse'=> function($q) {
                                $q->orderBy('order', 'asc');
                                }])->findOrFail($request->id);
        return view('admin.roadmap.newemp_detail',compact('roadmapCourse'));
    }

    public function updateOrder(Request $request) {
        DB::beginTransaction();
        try {
            foreach ($request->orders as $data) {
                RoadmapCourse::where('id', $data['id'])
                    ->update(['order' => $data['order']]);
            }
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'บันทึกลำดับเรียบร้อย']);

        } catch (\Exception $e) {
            // 3. ถ้ามีอะไรพังแม้แต่นิดเดียว ให้ยกเลิกทั้งหมดที่ทำมา (Rollback)
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
            ], 500);
        }
        return response()->json(['status' => 'success']);
    }
}
