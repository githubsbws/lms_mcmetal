<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Facades\AuthFacade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File as FileStore;
use App\Models\Course;
use App\Models\Certificate;
use Mpdf\Mpdf;

class CertificateController extends Controller
{
    public function certificate()
    {
        $certificate = Certificate::where('active', 'y')->orderBy('id', 'desc')->get();

        return view('admin.certificate.certificate', compact('certificate'));
    }

    public function certificate_create(Request $request)
    {
        if (!Auth::check() || !AuthFacade::useradmin()) {
            return redirect()->route('login.admin');
        }

        $course_online = Course::where('course_online.active', 'y')->orderBy('course_id', 'desc')->get();

        if ($request->isMethod('post')) {
            // ✅ ตรวจสอบข้อมูลที่ส่งมา

            $validator = Validator::make($request->all(), [
                'course_id' => 'required',
                'cert_name' => 'required|string',
                'cert_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif'
            ]);

            if ($validator->fails()) {
                Log::error('Validation failed: ', $validator->errors()->toArray());
                return redirect()->back()->withErrors($validator)->withInput();
            }
            DB::beginTransaction();
            try{
                $cert_create = new Certificate();
                $cert_create->cert_course = $request->course_id;
                $cert_create->cert_name = $request->cert_name;

                $cert_create->created_at = now();
                $cert_create->created_by = auth()->user()->id;
                $cert_create->active = 'y';
                $cert_create->save();

                // 📂 **จัดการการสร้างโฟลเดอร์**
                $certFolder = public_path("images/uploads/certificate/".$cert_create->id);
                if (!FileStore::isDirectory($certFolder)) {
                    FileStore::makeDirectory($certFolder, 0777, true,true);
                }
                $Folder = public_path("images/uploads/certificate/{$cert_create->id}");
                $originalFolder = "{$Folder}/original";
                $filedocFolder = public_path("images/uploads/filedoc/");

                foreach ([$originalFolder, $filedocFolder] as $folder) {
                    if (!FileStore::isDirectory($folder)) {
                        FileStore::makeDirectory($folder, 0777, true,true);
                    }
                }


                // 📌 **อัปโหลดภาพประกอบ**
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $Folder_pic = public_path("images/uploads/certificate/".$cert_create->id."/original");
                    $imageName = time() . "." . $image->getClientOriginalExtension();
                    if (!FileStore::isDirectory($Folder_pic)) {
                        FileStore::makeDirectory($Folder_pic, 0777, true,true);
                    }

                    $image->move($Folder_pic, $imageName);

                    $cert_create->cert_pic = $imageName;
                    $cert_create->save();
                }

                DB::commit();
            }catch (\Exception $e){
                DB::rollBack();

                Log::error($e->getMessage());
                return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล');
            }


            return redirect()->route('certificate')->with('success', 'อัปโหลดข้อมูลเรียบร้อยแล้ว!');
        }
        return view("admin.certificate.certificate_create", compact('course_online'));
    }

    public function certificate_detail($id)
    {
        $certificate = Certificate::findOrFail($id);


        $bg = public_path(
            'images/uploads/certificate/'.$certificate->id.'/original/'.$certificate->cert_pic
        );


        $html = view(
            'admin.certificate.certificate_detail',
            compact('certificate')
        )->render();

    $mpdf = new Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4-L',
        'margin_left' => 0,
        'margin_right' => 0,
        'margin_top' => 0,
        'margin_bottom' => 0,
        'default_font' => 'garuda',
    ]);

    $mpdf->SetWatermarkImage(
        $bg,
        1,
        [297,210]
    );

    $mpdf->watermarkImgBehind = true; // สำคัญมาก
    $mpdf->showWatermarkImage = true;

    $mpdf->WriteHTML($html);

        return response(
            $mpdf->Output('certificate.pdf', 'S'),
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="certificate.pdf"',
            ]
        );
    }

    public function certificate_edit(Request $request, $id)
    {
        if (!Auth::check() || !AuthFacade::useradmin()) {
            return redirect()->route('login.admin');
        }

        $certificate = Certificate::findOrFail($id);

        $course_online = Course::where('course_online.active', 'y')
            ->orderBy('course_id', 'desc')
            ->get();

        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'course_id' => 'required',
                'cert_name' => 'required|string',
                'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            DB::beginTransaction();

            try {

                $certificate->cert_course = $request->course_id;
                $certificate->cert_name   = $request->cert_name;

                $certificate->updated_by = auth()->user()->id;
                $certificate->updated_at = now();
                $certificate->save();

                // อัพโหลดรูปใหม่
                if ($request->hasFile('image')) {

                    $folder = public_path(
                        "images/uploads/certificate/{$certificate->id}/original"
                    );

                    if (!FileStore::isDirectory($folder)) {
                        FileStore::makeDirectory($folder, 0777, true, true);
                    }

                    // ลบรูปเก่า
                    if (
                        !empty($certificate->cert_pic) &&
                        file_exists($folder.'/'.$certificate->cert_pic)
                    ) {
                        unlink($folder.'/'.$certificate->cert_pic);
                    }

                    $image = $request->file('image');

                    $imageName = time().'.'.$image->getClientOriginalExtension();

                    $image->move($folder, $imageName);

                    $certificate->cert_pic = $imageName;
                    $certificate->save();
                }

                DB::commit();

                return redirect()
                    ->route('certificate')
                    ->with('success', 'แก้ไขข้อมูลสำเร็จ');

            } catch (\Exception $e) {

                DB::rollBack();

                Log::error($e->getMessage());

                return redirect()
                    ->back()
                    ->with('error', 'เกิดข้อผิดพลาดในการแก้ไขข้อมูล');
            }
        }

        return view(
            'admin.certificate.certificate_edit',
            compact('certificate', 'course_online')
        );
    }
    public function certificate_delete($id)
{
    if (!AuthFacade::useradmin()) {
        return redirect()->route('login.admin');
    }

    $certificate = Certificate::findOrFail($id);

    $certificate->update([
        'active' => 'n'
    ]);

    return redirect()->route('certificate');
}
}
