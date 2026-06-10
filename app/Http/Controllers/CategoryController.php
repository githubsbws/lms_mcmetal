<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Filecategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    // category create
    function categorycreate()
    {
        // $category_on = DB::table('category');
        return view("admin.category.category-create");
    }
    // category create to
    function categorycreateto(Request $request)
    {
        $request->validate([
            'cate_image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);
        // img
        $uploadedFile = $request->file('Category.cate_image');
        $extension = $uploadedFile->getClientOriginalExtension();
        $filename = now()->format('Ymd') . rand(10000, 99999) . '_Picture.' . $extension;
        $uploadedFile->storeAs('public/images/uploads/category/', $filename);
        // video
        $videoFileNames = $request->file('Filecategory.filename');
        // dd($request);
        $extension_vdo = $videoFileNames->getClientOriginalExtension();
        $filename_vdo = now()->format('Ymd') . rand(10000, 99999) . '_Video.' . $extension_vdo;
        $videoFileNames->storeAs('public/vdo/uploads/category/', $filename_vdo);
        // ข้อมูล
        $category = Category::create([
            'cate_title' => $request->input('Category.cate_title'),
            'cate_short_detail' => $request->input('Category.cate_short_detail'),
            'cate_detail' => $request->input('Category.cate_detail'),
            'cate_image' => $filename
            // 'cate_org_id' => Auth::user()->
        ]);
        $fileCategory = $category->filecategories()->create([
            'filename' => $filename_vdo,
        ]);
        $redirectUrl = route('category');
        return redirect($redirectUrl);
    }

    // category edit
    function categoryedit(Request $request, $id)
    {
        $category = DB::table('category')->where('cate_id', $id)->first();
        $vdo = DB::table('filecategory')->where('category_id', $id)->get();
        return view("admin.category.category-edit", compact('category', 'vdo'));
    }

    // category edit to
    function categoryeditto(Request $request, $id)
    {
        $request->validate([
            'cate_image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);
        // img
        $filename_image = DB::table('category')->where('cate_id', $id)->value('cate_image');
        $uploadedFile_imag = $request->file('Category.cate_image');
        if ($uploadedFile_imag) {
            $extension = $uploadedFile_imag->getClientOriginalExtension();
            // ตั้งชื่อไฟล์
            $filename_image = now()->format('Ymd') . rand(10000, 99999) . '_Picture.' . $extension;
            // บันทึกไฟล์
            $uploadedFile_imag->storeAs('public/images/uploads/category/', $filename_image);
            // อัปเดตไฟล์ลงฐานข้อมูล
            DB::table('category')->where('cate_id', $id)->update([
                'cate_image' => $filename_image,
            ]);
        }
        // vdo
        $filename_vdo = DB::table('filecategory')->where('category_id', $id)->value('filename');
        $uploadedFile_vdo = $request->file('Filecategory.filename');
        if ($uploadedFile_vdo) {
            $extension = $uploadedFile_vdo->getClientOriginalExtension();
            // ตั้งชื่อไฟล์
            $filename_vdo = now()->format('Ymd') . rand(10000, 99999) . '_Video.' . $extension;
            // บันทึกไฟล์
            $uploadedFile_vdo->storeAs('public/vdo/uploads/category/', $filename_vdo);
            // อัปเดตไฟล์ลงฐานข้อมูล
            DB::table('filecategory')->where('category_id', $id)->update([
                'filename' => $filename_vdo,
            ]);
        }
        // ข้อมูล
        $category = Category::find($id);
        $category->update([
            'cate_title' => $request->input('Category.cate_title'),
            'cate_short_detail' => $request->input('Category.cate_short_detail'),
            'cate_detail' => $request->input('Category.cate_detail'),
            'cate_image' => $filename_image,
            'update_date' => now(),
        ]);
        $category->filecategories()->update([
            'filename' => $filename_vdo,
            'update_date' => now(),
        ]);
        $redirectUrl = route('category');
        return redirect($redirectUrl);
    }

    // category change to id
    function categorychange($id)
    {
        $category = DB::table('category')->where('cate_id', $id)->first();
        // ตรวจสอบค่าปัจจุบันของ 'active' และกำหนดค่าใหม่
        $newActive = ($category->active == 'y') ? 'n' : 'y';
        $data = [
            'active' => $newActive,
        ];
        DB::table('category')->where('cate_id', $id)->update($data);
        Filecategory::where('category_id', $id)->update($data);
        DB::table('course_online')->where('cate_id', $id)->update($data);
        $redirectUrl = route('category');
        return redirect($redirectUrl);
    }

    // category det show
    function categorydet(Request $request, $id)
    {
    }
}
