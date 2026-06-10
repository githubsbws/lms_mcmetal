<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LessonController extends Controller
{
    // lession create
    function lessioncreate()
    {
        $course_online = Course::join('category', 'category.cate_id', '=', 'course_online.cate_id')->where('course_online.active', 'y')->orderBy('course_id', 'desc')->get();
        return view("admin\lesson\lesson-create", compact('course_online'));
    }
    // lession  create to
    function lessioncreateto(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);
        // img
        $uploadedFile = $request->file('Lesson.image');
        $extension = $uploadedFile->getClientOriginalExtension();
        $filename = now()->format('Ymd') . rand(10000, 99999) . '_Picture.' . $extension;
        $uploadedFile->storeAs('public/images/uploads/lesson/', $filename);
        // video
        $videoFileNames = $request->file('File.filename');
        $extension_vdo = $videoFileNames->getClientOriginalExtension();
        $filename_vdo = rand(10000000, 99999999) . '-1.' . $extension_vdo;
        $filename_name_vdo = $videoFileNames->getClientOriginalName();
        $videoFileNames->storeAs('public/vdo/uploads/lesson/', $filename_vdo);
        // doc
        $docFileNames = $request->file('FileDoc.doc');
        $extension_doc = $docFileNames->getClientOriginalExtension();
        $filename_doc = rand(100000000, 999999999) . '-1.' . $extension_doc;
        $filename_name_doc = $docFileNames->getClientOriginalName();
        $docFileNames->storeAs('public/doc/uploads/lesson/', $filename_name_doc);
        // ข้อมูล
        $data = Lesson::create([
            'course_id' => $request->input('Lesson.course_id'),
            'title' => $request->input('Lesson.title'),
            'description' => $request->input('Lesson.description'),
            'view_all' => $request->input('Lesson.view_all'),
            'cate_amount' => $request->input('Lesson.cate_amount'),
            'time_test' => $request->input('Lesson.time_test'),
            'content' => $request->input('Lesson.content'),
            'image' => $filename,
        ]);
        $vdo = $data->file()->create([
            'filename' => $filename_vdo,
            'file_name' => $filename_name_vdo,

        ]);
        $doc = $data->filedoc()->create([
            'filename' => $filename_doc,
            'file_name' => $filename_name_doc,

        ]);
        // DB::table('lesson')->insert($data);
        $redirectUrl = route('lesson');
        return redirect($redirectUrl);
    }

    // lession edit
    function lessionedit(Request $request, $id)
    {
        $lesson = Lesson::find($id);
        $course_online = Course::join('category', 'category.cate_id', '=', 'course_online.cate_id')
            ->where('course_online.active', 'y')
            ->orderBy('course_id', 'desc')
            ->select('course_title', 'course_id', 'cate_title')
            ->get();
        $selectedCourseId = $lesson->course_id;
        $vdo = DB::table('file')->where('lesson_id', $id)->get();
        $doc = DB::table('file_doc')->where('lesson_id', $id)->get();
        return view("admin\lesson\lesson-edit", compact('lesson', 'course_online', 'selectedCourseId', 'vdo', 'doc'));
    }

    // lession edit to
    function lessioneditto(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);
        // img
        $filename_image =  DB::table('lesson')->where('id', $id)->value('image');
        $uploadedFile_imag = $request->file('Lesson.image');
        if ($uploadedFile_imag) {
            $extension = $uploadedFile_imag->getClientOriginalExtension();
            // ตั้งชื่อไฟล์
            $filename_image = now()->format('Ymd') . rand(10000, 99999) . '_Picture.' . $extension;
            // บันทึกไฟล์
            $uploadedFile_imag->storeAs('public/images/uploads/lesson/', $filename_image);
            // อัปเดตไฟล์ลงฐานข้อมูล
            DB::table('lesson')->where('id', $id)->update([
                'image' => $filename_image,
            ]);
        }
        // vdo
        $filename_vdo = DB::table('file')->where('lesson_id', $id)->value('filename');
        $filename_name_vdo = DB::table('file')->where('lesson_id', $id)->value('file_name');
        $uploadedFile_vdo = $request->file('File.filename');
        if ($uploadedFile_vdo) {
            $extension_vdo = $uploadedFile_vdo->getClientOriginalExtension();
            $filename_vdo = rand(10000000, 99999999) . '-1.' . $extension_vdo;
            $filename_name_vdo = $uploadedFile_vdo->getClientOriginalName();
            $uploadedFile_vdo->storeAs('public/vdo/uploads/lesson/', $filename_vdo);
            // อัปเดตไฟล์ลงฐานข้อมูล
            DB::table('file')->where('lesson_id', $id)->update([
                'filename' => $filename_vdo,
                'file_name' => $filename_name_vdo,
            ]);
        }
        // doc
        $filename_doc = DB::table('file_doc')->where('lesson_id', $id)->value('filename');
        $filename_name_doc = DB::table('file_doc')->where('lesson_id', $id)->value('file_name');
        $uploadedFile_doc = $request->file('FileDoc.doc');
        if ($uploadedFile_doc) {
            $extension_doc = $uploadedFile_doc->getClientOriginalExtension();
            $filename_doc = rand(100000000, 999999999) . '-1.' . $extension_doc;
            $filename_name_doc = $uploadedFile_doc->getClientOriginalName();
            $uploadedFile_doc->storeAs('public/doc/uploads/lesson/', $filename_name_doc);
            // อัปเดตไฟล์ลงฐานข้อมูล
            DB::table('file_doc')->where('lesson_id', $id)->update([
                'filename' => $filename_doc,
                'file_name' => $filename_name_doc,
            ]);
        }
        // ข้อมูล
        $lesson = Lesson::find($id);
        $lesson->update([
            'course_id' => $request->input('Lesson.course_id'),
            'title' => $request->input('Lesson.title'),
            'description' => $request->input('Lesson.description'),
            'view_all' => $request->input('Lesson.view_all'),
            'cate_amount' => $request->input('Lesson.cate_amount'),
            'time_test' => $request->input('Lesson.time_test'),
            'content' => $request->input('Lesson.content'),
            'image' => $filename_image,
            'update_date' => now(),
        ]);
        $lesson->file()->update([
            'filename' => $filename_vdo,
            'file_name' => $filename_name_vdo,
            'update_date' => now(),
        ]);
        $lesson->filedoc()->update([
            'filename' => $filename_doc,
            'file_name' => $filename_name_doc,
            'update_date' => now(),
        ]);
        $redirectUrl = route('lesson');
        return redirect($redirectUrl);
    }

    // lession change to id
    function lessionchange($id)
    {
        $lesson = DB::table('lesson')->where('id', $id)->first();
        // ตรวจสอบค่าปัจจุบันของ 'active' และกำหนดค่าใหม่
        $newActive = ($lesson->active == 'y') ? 'n' : 'y';
        $data = [
            'active' => $newActive,
        ];
        DB::table('lesson')->where('id', $id)->update($data);
        $redirectUrl = route('lesson');
        return redirect($redirectUrl);
    }

    // lession det show
    function lessiondet(Request $request, $id)
    {
    }
}
