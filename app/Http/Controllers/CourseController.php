<?php

namespace App\Http\Controllers;

use App\Enums\LessonStatus;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Score;
use App\Models\Lesson;
use App\Models\Manage;
use App\Models\Question;
use App\Models\FileDoc;
use App\Models\Learn;
use App\Models\LearnFile;
use App\Models\Orgchart;
use App\Models\Orgcourse;
use App\Models\File;
use App\Models\Grouptesting;
use App\Models\Images;
use App\Models\LearnFileDoc;
use App\Models\OrgchartUser;
use App\Models\Roadmap;
use App\Models\RoadmapCourse;
use App\Models\Users;
use App\Services\CourseService;
use App\Services\LessonProgressService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CourseController extends Controller
{


    // ฉีด Service เข้ามาทาง Constructor
    public function __construct(
        protected CourseService $courseService,
        protected LessonProgressService $progressService,
    ) {}

    function course(Request $request)
    {
        if(Auth::check()){
            $course_detail = $this->courseService->getCoursesForUser(Auth::user());

            return view("course.course",compact('course_detail'));
        }else{
            return redirect()->route('index');
        }
    }
    // Lession

    public function lessonLearn(Request $request, int $lessonId, int $fileId,)
    {
        session([
            'lesson_from_course' => $request->query('course_id'),
            'lesson_from_page'   => $request->query('from_page', 1)
        ]);
        // โหลด Lesson พร้อม Course และไฟล์ที่ระบุ รวมถึงสถานะการเรียนล่าสุด
        $lesson = Lesson::with('course')->findOrFail($lessonId);
        $file = File::findOrFail($fileId);

        $this->authorize('view', $lesson);

        // ดึงสถานะการเรียนปัจจุบัน (ถ้ามี)
        $learnFile = LearnFile::whereHas('learn', function($q) use ($lessonId) {
                $q->where('user_id', auth()->id())->where('lesson_id', $lessonId);
            })
            ->where('file_id', $fileId)
            ->first();
        $hasLearnComplete = $learnFile && $learnFile->learn_file_status === LessonStatus::Success->value;
        return view('course.course-lesson', compact('lesson', 'file', 'learnFile','hasLearnComplete'));
    }

    public function streamVideo(int $fileId): BinaryFileResponse
    {
        try{
            $file = File::findOrFail($fileId);

        // Security: เช็คสิทธิ์ก่อนส่งไฟล์
        // $this->authorize('view', $file->lesson);

        $path = public_path('images/uploads/lesson/' . $file->filename);
        if (!file_exists($path)) {
            abort(404);
        }

        // BinaryFileResponse รองรับ HTTP 206 Partial Content อัตโนมัติ
        return response()->file($path, [
            'Content-Type' => 'video/mp4',
            'Cache-Control' => 'private, max-age=3600',
        ]);
        }catch (\Exception $e){
            Log::error("Video Stream Failed: " . $e->getMessage(), [
                'user_id' => auth()->id(),
                'file_id' => $file_id ?? 'N/A',
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                // ไม่ต้องเก็บ Trace ทั้งหมดลง Log ปกติ เพราะมันเปลืองเนื้อที่
                // ยกเว้นจะเป็นเคสที่หาสาเหตุยากจริงๆ
            ]);

            // 2. Return Response (External Visibility)
            // ส่ง HTTP 500 หรือ 400 พร้อมข้อความที่ User อ่านแล้วเข้าใจแต่ไม่รู้ไส้ในระบบ
            return response()->json([
                'status'  => 'error',
                'message' => 'ไม่สามารถเล่นวิดีโอได้ในขณะนี้ กรุณาลองใหม่อีกครั้งหรือติดต่อเจ้าหน้าที่',
            ], 500);
                }

    }

    public function updateProgress(Request $request): JsonResponse
    {

        if (!auth()->check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated. Please log in again.'
            ], 401); // Return 401 แทนที่จะปล่อยให้ 500
        }

        $data = $request->only(['course_id', 'lesson_id', 'file_id', 'seconds', 'status']);
        // 2. เรียก Service โดยส่ง ID และ Array ข้อมูล
        $result = $this->progressService->updateVideoProgress(
            auth()->id(),
            $data
        );

        return response()->json([
            'status' => 'success',
            'data'   => $result
        ]);
    }

    // 1. บันทึก progress อย่างเดียว ไม่ download
    public function markDocProgress(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['status' => 'error'], 401);
        }

        $data = $request->only(['course_id', 'lesson_id', 'file_doc_id']);
        $this->progressService->updateDocProgress(auth()->id(), $data);

        return response()->json(['status' => 'success']);
    }

    // 2. download อย่างเดียว ไม่บันทึก
    // public function downloadfile(Request $request)
    // {
    //     if (!auth()->check()) {
    //         return response()->json(['status' => 'error'], 401);
    //     }

    //     $file = FileDoc::where('id', $request->query('file_doc_id'))->first();
    //     if (!$file) return response()->json(['error' => 'File not found'], 404);

    //     $file_path = public_path('images/uploads/filedoc' . DIRECTORY_SEPARATOR . $file->filename);
    //     if (!file_exists($file_path)) return response()->json(['error' => 'File not found on server'], 404);

    //     return response()->download($file_path, $file->original_filename);
    // }

    public function viewfile(Request $request)
    {
        if (!auth()->check()) abort(401);

        $file = FileDoc::where('id', $request->query('file_doc_id'))->first();
        if (!$file) abort(404);

        $pdfUrl   = route('course.pdfstream', ['file_doc_id' => $file->id]);
        $fileName = $file->original_filename;

        return view('course.pdf-viewer', compact('pdfUrl', 'fileName'));
    }

    // endpoint stream PDF ให้ PDF.js ดึงครับ
    public function pdfStream(Request $request)
    {
        if (!auth()->check()) abort(401);

        $file = FileDoc::where('id', $request->query('file_doc_id'))->first();
        if (!$file) abort(404);

        $file_path = public_path('images/uploads/filedoc' . DIRECTORY_SEPARATOR . $file->filename);

        return response()->file($file_path, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline',
            'Cache-Control'       => 'no-store, no-cache',
        ]);
    }

    public function courseComplete(Request $request, int $course_id)
    {
        if(auth()->check())
        {
            $this->courseService->completeCourse(auth()->id(), $course_id);
            $page = $request->input('from_page', 1);
            return redirect()->route('course',['page' => $page])
                            ->with('success', 'สำเร็จการเรียนเรียบร้อยแล้ว')
                            ->withFragment('course-' . $course_id);
        }
    }

    public function courseReset(Request $request, int $course_id)
    {
        if(auth()->check())
        {
            $this->courseService->resetCourseLearn(auth()->id(), $course_id);
            $page = $request->input('from_page', 1);
            return redirect()->route('course',['page' => $page])
                            ->with('success', 'สำเร็จการเรียนเรียบร้อยแล้ว')
                            ->withFragment('course-' . $course_id);
        }
    }

}
