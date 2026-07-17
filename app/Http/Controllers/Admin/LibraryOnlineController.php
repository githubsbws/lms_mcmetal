<?php

namespace App\Http\Controllers\Admin;

use App\Facades\AuthFacade;
use App\Http\Controllers\Controller;
use App\Models\LibraryFile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LibraryOnlineController extends Controller
{
    protected $userId;
    const STATUS_ACTIVE = 'y';
    const SHOW_LIMIT = '10';

    public function __construct()
    {
        // ต้องครอบด้วยฟังก์ชัน Middleware เสมอ เพื่อรอให้ระบบ Auth โหลดเสร็จก่อน
        $this->middleware(function ($request, $next) {

            // ดึง ID ของคนที่ Login มาใส่ตัวแปรนอกสุดที่เราประกาศไว้ข้างบน
            $this->userId = auth()->id();

            return $next($request);
        });
    }

    public function index()
    {
        if(AuthFacade::useradmin()){
            $libraryFiles = LibraryFile::where('active',self::STATUS_ACTIVE)->orderBy('created_at','DESC')->paginate(self::SHOW_LIMIT);
            return view('admin.library.library-online',compact('libraryFiles'));
        }
        return redirect()->route('login.admin');
    }

    public function uploadfile(Request $request)
    {
        if(AuthFacade::useradmin()){
            $request->validate([
                'uploaded_file' => ['required', 'mimes:pdf,mp4'],
                'file_title' => ['required','string','max:255'],
            ]);
            if($request->hasFile('uploaded_file')){
                $uploadedFile = $request->file('uploaded_file');
                $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
                $filePath = $uploadedFile->storeAs('public/library', $fileName);

                $fileTitle = $request->input('file_title');

                DB::transaction(function () use ($fileTitle,$fileName){
                    LibraryFile::create([
                        'name' => $fileTitle,
                        'filename' => $fileName,
                        'view' => 0,
                        'created_by' => $this->userId,
                        'active' => 'y',
                    ]);
                });
                return redirect()->back()->with('success','อัพโหลดไฟล์สำเร็จ');
            }
            return redirect()->back()->with('error','ไม่พบไฟล์ที่อัพโหลด');
        }
        return redirect()->route('login.admin');
    }

    public function deletefile(int $id) {
        $file = LibraryFile::findOrFail($id);
        $file->update(['active' => 'n']);

        return response()->json(['status' => 'success','message' => 'สำเร็จ']);
    }

    public function viewFile(int $id)
    {
        $file = LibraryFile::findOrFail($id);
        $file->increment('view');

        $path = storage_path('app/public/library/' . $file->filename);
        if (!file_exists($path)) abort(404);

        $extension = strtolower(pathinfo($file->filename, PATHINFO_EXTENSION));
        $mimeType  = match($extension) {
            'pdf' => 'application/pdf',
            'mp4' => 'video/mp4',
            default => mime_content_type($path)
        };

        return response()->file($path, [
            'Content-Type'        => $mimeType,
            'Content-Disposition' => 'inline',
        ]);
    }
}
