<?php

namespace App\Http\Controllers;

use App\Services\CourseExamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseExamController extends Controller
{
    public function __construct(
        protected CourseExamService $courseExamService,
    ) {}
    public function multipleExam(Request $request,int $course_id)
    {
        if(Auth::check()){
            try{
                session(['exam_from_page' => $request->query('page', 1)]);
                $course = $this->courseExamService->getMultipleChoiceExam($course_id);

                return view('course.exam.exam-multiple',compact('course'));
            }catch(\Exception $e){
                $page = session('exam_from_page', 1);
                // 🚨 พอ Service "โยน (throw)" มา Controller จะ "รับ (catch)" ไว้ตรงนี้
                // แล้วเปลี่ยนจากหน้า Error เป็นการ Redirect กลับหน้าเดิมพร้อม Alert
                return redirect()->route('course', ['page' => $page])
                     ->with('error', $e->getMessage())
                     ->withFragment('course-' . $course_id);
            }
        }
    }

    public function essayExam(Request $request,int $course_id)
    {
        if(Auth::check()){
            try{
                session(['exam_from_page' => $request->query('page', 1)]);
                $course = $this->courseExamService->getEssayExam($course_id);

                return view('course.exam.exam-essay',compact('course'));
            }catch(\Exception $e){
                $page = session('exam_from_page', 1);
                // 🚨 พอ Service "โยน (throw)" มา Controller จะ "รับ (catch)" ไว้ตรงนี้
                // แล้วเปลี่ยนจากหน้า Error เป็นการ Redirect กลับหน้าเดิมพร้อม Alert
                return redirect()->route('course', ['page' => $page])
                     ->with('error', $e->getMessage())
                     ->withFragment('course-' . $course_id);
            }

        }
    }

    public function essayExamSubmit(Request $request,int $course_id)
    {
        if(Auth::check())
        {
            $this->courseExamService->essayExamAnswerSubmit($course_id,$request);
            $page = session('exam_from_page', 1);
            return redirect()->route('course', ['page' => $page])
                     ->with('success', 'ส่งข้อสอบเรียบร้อยแล้ว รอผลการตรวจ')
                     ->withFragment('course-' . $course_id);
        }
    }

    public function multipleExamSubmit(Request $request,int $course_id)
    {
        if(Auth::check())
        {
            $this->courseExamService->multipleExamAnswerSubmit($course_id,$request);

            $page = session('exam_from_page', 1);
            return redirect()->route('course', ['page' => $page])
                     ->with('success', 'ส่งข้อสอบเรียบร้อยแล้ว รอผลการตรวจ')
                     ->withFragment('course-' . $course_id);
        }
    }

}
