<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use DateTime;
use App\Facades\AuthFacade;

// use Intervention\Image\Facades\Image;
use App\Models\Questionnaireout;
use Carbon\Carbon;
use App\Models\Image;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\News;
use App\Models\Faq;
use App\Models\Faq_type;
use App\Models\Pgroup;
use App\Models\Pgroupcondition;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;
use App\Imports\UsersImport;

use App\Models\About;
use App\Models\Conditions;
use App\Models\Setting;
use App\Models\Contactus;
use App\Models\Video;
use App\Models\Imgslide;
use App\Models\Downloadcategoty;
use App\Models\DownloadFileDoc;
use App\Models\DownloadFile;
use App\Models\Downloadtitle;
use App\Models\Category;
use App\Models\Teacher;
use App\Models\Users;
use App\Models\Usability;
use App\Models\File;
use App\Models\FileDoc;
use App\Models\Grouptesting;
use App\Models\Manage;
use App\Models\Question;
use App\Models\Logadmin;
use App\Models\Logusers;
use App\Models\Logapprove;
use App\Models\Logapprovepersonal;
use App\Models\Logregister;
use App\Models\Reportproblem;
use App\Models\Coursenotification;
class AdminController extends Controller
{
    public int $limit = 100;
    function admin(){
        if(AuthFacade::useradmin()){
            return view("admin.index.index");
        }
        return redirect()->route('login.admin');
    }
    function loginadmin(Request $request){
        if ($request->isMethod('post')) {
            $request->validate([
                'username' => 'required|validate_username',
                'password' => 'required',
            ]);
            $password = md5($request->password);
            
            $user = Users::join('profiles','profiles.user_id','=','users.id')->where('username', $request->username)->first();
            
            if (!$user || $password != $user->password) {
                // Authentication failed
                
                return back()->withErrors(['username' => 'Invalid credentials'])->withInput($request->only('username'));
            }
            else{
                // Login success
            Auth::login($user);

            $userAdmin = AuthFacade::useradmin();
            
            if($userAdmin){
                return redirect()->intended('admin');
            }else{
                return back()->withErrors(['username' => 'Invalid credentials'])->withInput($request->only('username'));
            }
            
            }
        }
        return view("admin.login.login");
    }
    public function logoutadmin()
    {
        Auth::logout();

        // Redirect to the home page or any other desired page
        return redirect()->route('login.admin');
    }
    function aboutus(){
        $about = About::where('active','y')->get();
        return view("admin.aboutus.aboutus",['about'=>$about]);
    }
    function aboutus_detail($id){
        $about_detail = About::where('about_id',$id)->first();
        return view("admin.aboutus.aboutus_detail",['about_detail'=>$about_detail]);
    }
    function aboutus_update(Request $request, $id) {
        $about_detail = About::where('about_id', $id)->first();
        if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่
            $validator = Validator::make($request->all(), [
                'about_title' => 'nullable|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                'about_detail' =>'nullable|string'
            ]);
            // dd($validator);
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }
    
            $about_update = About::findById($id);
            $about_update->about_title = $request->input('about_title');
            $about_update->about_detail = htmlspecialchars($request->input('about_detail'));    
            $about_update->update_by = Auth::user()->id;
            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต
    
            $about_update->save();
    
            return redirect()->route('aboutus')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
    
        return view("admin.aboutus.aboutus_update", ['about_detail' => $about_detail]);
    }
    function condition(){
        $conditions = Conditions::where('active','y')->get();
        return view("admin.condition.condition",['conditions' =>$conditions]);
    }
    function condition_detail($id){
        $conditions = Conditions::where('conditions_id',$id)->first();
        return view("admin.condition.condition_detail",['conditions' =>$conditions]);
    }
    function condition_update(Request $request, $id) {
        $conditions = Conditions::where('conditions_id', $id)->first();
        if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่
            $validator = Validator::make($request->all(), [
                'conditions_title' => 'nullable|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                'conditions_detail' =>'nullable|string'
            ]);
            // dd($validator);
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }
    
            $conditions_update = Conditions::findById($id);
            $conditions_update->conditions_title = $request->input('conditions_title');
            $conditions_update->conditions_detail = htmlspecialchars($request->input('conditions_detail'));
            $conditions_update->update_by = Auth::user()->id;
            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต
    
            $conditions_update->save();
    
            return redirect()->route('condition')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
    
        return view("admin.condition.condition_update", ['conditions' => $conditions]);
    }
    function setting(){
        $setting = Setting::first();
       
        return view("admin.setting.setting",['setting' => $setting]);
    }
    function setting_update(Request $request, $id){
        $setting = Setting::first();
        if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่
            $validator = Validator::make($request->all(), [
                'email_room' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                'pass_email_room' =>'required|string',
                'settings_user_email' =>'required|string',
                'settings_pass_email' =>'required|string',
                'settings_testing' =>'nullable|string',
                'settings_register' =>'nullable|string',
                'settings_score' => 'required|string',
                'password_expire_day' =>'required|string'

            ]);
            // dd($validator);
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }
    
            $setting_update = Setting::findById($id);
            $setting_update->email_room = $request->input('email_room');
            $setting_update->pass_email_room = $request->input('pass_email_room');
            $setting_update->settings_user_email = $request->input('settings_user_email');
            $setting_update->settings_pass_email = $request->input('settings_pass_email');
            $setting_update->settings_testing = $request->input('settings_testing');
            $setting_update->settings_register = $request->input('settings_register');
            $setting_update->settings_score = $request->input('settings_score');
            $setting_update->password_expire_day = $request->input('password_expire_day');
            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต
            if ($request->has('settings_register')) {
                $setting_update->settings_register = '1';
            }else{
                $setting_update->settings_register = '0';
            }
            if ($request->has('settings_testing')) {
                $setting_update->settings_testing = '1';
            }else{
                $setting_update->settings_testing = '0';
            }

    
            $setting_update->save();
    
            return redirect()->route('setting')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
        return view("admin.setting.setting",['setting' => $setting]);
    }
    function contactus(){
        $contactus= Contactus::where('active','y')->paginate(10);

        return view("admin.contactus.contactus",['contactus' => $contactus]);
    }
    function contactus_view($id){
        $contactus= Contactus::where('contac_id',$id)->first();

        return view("admin.contactus.Contactus_view",['contactus' => $contactus]);
    }
    function contactus_create(){
        $contactus_create= DB::table('contactus')->get();
        return view("admin.contactus.Contactus_create",compact('contactus_create'));
    }
    function contactus_insert(Request $request){
        $request->validate([
            'contac_by_name'=>'required',
            'contac_by_surname'=>'required',
            'contac_by_email'=>'required|email',
            'contac_by_tel'=>'required|numeric',
            'contac_subject'=>'required',
            'contac_detail'=>'required',
            'contac_ans_subject'=>'required',
            'contac_ans_detail'=>'required',

        ]);
        $date=new DateTime('Asia/Bangkok');
        $contact_data=[
            'contac_by_name'=>$request->contac_by_name,
            'contac_by_surname'=>$request->contac_by_surname,
            'contac_by_email'=>$request->contac_by_email,
            'contac_by_tel'=>$request->contac_by_tel,
            'contac_subject'=>$request->contac_subject,
            'contac_detail'=>$request->contac_detail,
            'contac_ans_subject'=>$request->contac_ans_subject,
            'contac_ans_detail'=>$request->contac_ans_detail,
            'contac_answer'=>'y',
            'create_date'=>$date,
            'create_by'=>'1',
            'update_date'=>$date,
            'update_by'=>'1',
            'active'=>'y',
        ];
        DB::table('contactus')->insert($contact_data);
        return redirect('/contactus');
    }
    function contactus_edit_page(Request $request,$id){
        $contactus_edit_page= Contactus::where('contac_id',$id)->first();
        if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่
            $validator = Validator::make($request->all(), [
                'contac_by_name' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                'contac_by_surname' =>'required|string',
                'contac_by_email' =>'required|string',
                'contac_by_tel' =>'required|string',
                'contac_subject' =>'required|string',
                'contac_detail' =>'required|string',
                'contac_ans_subject' => 'required|string',
                'contac_ans_detail' =>'required|string'

            ]);
            // dd($validator);
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }
    
            $contactus_update = Contactus::findById($id);
            $contactus_update->contac_by_name = $request->input('contac_by_name');
            $contactus_update->contac_by_surname = $request->input('contac_by_surname');
            $contactus_update->contac_by_email = $request->input('contac_by_email');
            $contactus_update->contac_by_tel = $request->input('contac_by_tel');
            $contactus_update->contac_subject = $request->input('contac_subject');
            $contactus_update->contac_detail = $request->input('contac_detail');
            $contactus_update->contac_ans_subject = $request->input('contac_ans_subject');
            $contactus_update->contac_ans_detail = $request->input('contac_ans_detail');
            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต
    
            $contactus_update->save();
    
            return redirect()->route('contactus')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
        // dd($contactus_edit_page);
        return view("admin.contactus.Contactus_edit_page",['contactus_edit_page'=>$contactus_edit_page]);
    }
    function contactus_edit(Request $request,$id){
        $request->validate([
            'contac_by_name'=>'required',
            'contac_by_surname'=>'required',
            'contac_by_email'=>'required|email',
            'contac_by_tel'=>'required|numeric',
            'contac_subject'=>'required',
            'contac_detail'=>'required',
            'contac_ans_subject'=>'required',
            'contac_ans_detail'=>'required',
        ]);
        $date=new DateTime('Asia/Bangkok');
        $contactus_edit  =[
            'contac_by_name'=>$request->contac_by_name,
            'contac_by_surname'=>$request->contac_by_surname,
            'contac_by_email'=>$request->contac_by_email,
            'contac_by_tel'=>$request->contac_by_tel,
            'contac_subject'=>$request->contac_subject,
            'contac_detail'=>$request->contac_detail,
            'contac_ans_subject'=>$request->contac_ans_subject,
            'contac_ans_detail'=>$request->contac_ans_detail,
            'update_date'=>$date,
            'update_by'=>'1'
        ];
        DB::table('contactus')->where('contac_id',$id)->update($contactus_edit);
        return redirect("/contactus");
    }
    function contactus_delete($id){

        $contactus_delete=[
            'active'=>'n',
        ];
        DB::table('contactus')->where('contac_id',$id)->update($contactus_delete);
        return redirect("/contactus");
    }
    // new p
    function video_create(){
        return view("admin.video.video-create");
    }
    function video(){
        $vdo =DB::table('vdo')->get();
        return view("admin.video.video",compact('vdo'));
    }
    function video_detail($vdo_id){
        $vdo = Video::where('vdo_id',$vdo_id)->first();
        
        return view("admin.video.video_detail",['vdo'=> $vdo]);
    }
    function video_insert(Request $request){
        $request->validate([
            'vdo_title'=>'required|max:115',
            'vdo_path' => 'required|url|max:255',
        ]);
        $date=new DateTime('Asia/Bangkok');
        $vdo_data=[
            'vdo_title'=>$request->vdo_title,
            'vdo_path'=>$request->vdo_path,
            'create_date'=>$date,
            'create_by'=> Auth::user()->id,               //default
            'update_date'=>$date,
            'update_by'=> Auth::user()->id,               //default
            'active'=>'y'                   //default
        ];
        DB::table('vdo')->insert($vdo_data);
        return redirect()->route('video');
    }
    function video_edit($vdo_id){
        $vdo =DB::table('vdo')->where('vdo_id',$vdo_id)->first();
        return view("admin.video.Video-edit",compact('vdo'));
    }
    function video_update(Request $request,$vdo_id){
        $request->validate([
            'vdo_title'=>'required|max:115',
            'vdo_path' => 'required|url|max:255',
        ]);
        $date=new DateTime('Asia/Bangkok');
        $vdo_data=[
            'vdo_title'=>$request->vdo_title,
            'vdo_path'=>$request->vdo_path,
            'create_date'=>$date,
            'create_by'=> Auth::user()->id,               //default
            'update_date'=>$date,
            'update_by'=> Auth::user()->id,               //default
            'active'=>'y'                   //default
        ];
        DB::table('vdo')->where('vdo_id',$vdo_id)->update($vdo_data);
        return redirect()->route('video');
    }
    function video_delete($vdo_id){
        $vdo_delete=[
            'active'=>'n'
        ];
        DB::table('vdo')->where('vdo_id',$vdo_id)->update($vdo_delete);
        return redirect()->route('video');
    }
    //
    function document(){
        $document = DownloadFileDoc::where('active','y')->orderBy('filedoc_id','DESC')->paginate(10);

        return view("admin.document.document",['document' =>$document]);
    }
    function document_create(Request $request){
        $document_type = Downloadcategoty::where('active','y')->get();
        if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่
            $document_cate = Downloadcategoty::where('download_id',$request->input('download_cate'))->first();

            $document = new DownloadFileDoc;
            $document->filedoc_name = $request->input('filedoc_name');
            $document->active = 'y';

            $document_file = new DownloadFile;
            $document_file->download_id = $document_cate->download_id;
            $document_file->title_id = $document_cate->title_id;
            $document_file->active = 'y';
            $document_file->save();

            $document->file_id = $document_file->file_id;
            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต
            if ($request->hasFile('filedoc')) {
                $fileExtension = $request->file('filedoc')->extension();
        
                if ($fileExtension !== 'pdf') {
                    // คำสั่งสำหรับการแจ้งเตือนว่าไฟล์ที่อัปโหลดไม่ใช่ PDF
                    return back()->with('error', 'กรุณาเลือกไฟล์ที่มีนามสกุล .pdf เท่านั้น');
                }
                $doc = $request->file('filedoc');
                $docname = $doc->getClientOriginalName();
                $document->filedocname = $docname;
                
                $idFolder = public_path('images/uploads/filedoc/');
                
                $doc->move($idFolder, $docname);
 
            }
            // dd($document->toArray());
            $document->save();
            
            return redirect()->route('document')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
        return view("admin.document.document_create",['document_type' => $document_type]);
    }
    function document_edit($id,Request $request){
        $document = DownloadFileDoc::where('filedoc_id',$id)->first();
        $document_file = DownloadFile::where('file_id',$document->file_id)->first();
        $document_type = Downloadcategoty::where('download_id',$document_file->download_id)->first();
        $document_cate = Downloadcategoty::where('active','y')->get();
        if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่

            $document = DownloadFileDoc::findById($id);
            $document->filedoc_name = $request->input('filedoc_name');

            $document_file = DownloadFile::findById($document->file_id);
            $document_file->download_id = $request->input('download_cate');
            $document_file->save();
            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต
            if ($request->hasFile('filedoc')) {
                $fileExtension = $request->file('filedoc')->extension();
        
                if ($fileExtension !== 'pdf') {
                    // คำสั่งสำหรับการแจ้งเตือนว่าไฟล์ที่อัปโหลดไม่ใช่ PDF
                    return back()->with('error', 'กรุณาเลือกไฟล์ที่มีนามสกุล .pdf เท่านั้น');
                }
                $doc = $request->file('filedoc');
                $docname = $doc->getClientOriginalName();
                $document->filedocname = $docname;
                
                $idFolder = public_path('images/uploads/filedoc/');
                
                $doc->move($idFolder, $docname);
                
                
            }
            // dd($document->toArray());
            $document->save();
            
            return redirect()->route('document')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
        return view("admin.document.document_edit",['document' =>$document,'document_type' =>$document_type,'document_cate' =>$document_cate]);
    }
    function document_detail($id){
        $document = DownloadFileDoc::where('filedoc_id',$id)->first();

        $type = DownloadFile::join('download_categoty','download_categoty.download_id','=','download_file.download_id')->where('file_id',$document->file_id)->first();

        return view("admin.document.document_detail",['document' =>$document,'type' => $type]);
    }
    function document_downloadfile($id,Request $request){
        // Retrieve the file information from the database
        $file = DownloadFileDoc::where('filedoc_id',$id)->first();
        // Check if the file exists
        // dd($file->toArray());
        // Construct the full file path
        $file_path = public_path('images/uploads/filedoc/'.$file->filedocname);


        // Check if the file actually exists on the server
        if (file_exists($file_path)) {
            return response()->download($file_path, $file->filedoc_name);
        } else {
            echo "<script>alert('ไม่พบไฟล์'); window.location.href = '/document';</script>";
        }
    }
    function document_delete($id){
        $document_del=[
            'active'=>'n'
        ];
        $document = DownloadFileDoc::findById($id);
        $document->update($document_del);
        return redirect()->route('document');
    }
    function document_type(){
        $document_type = Downloadcategoty::where('active','y')->get();
        return view("admin.document.document_type",['document_type' =>$document_type]);
    }
    function document_type_detail($id){
        $document_type = Downloadcategoty::where('download_id',$id)->first();

        return view("admin.document.document_type_detail",['document_type' =>$document_type]);
    }
    function document_type_edit(Request $request,$id){
        $document_type = Downloadcategoty::join('download_title','download_title.title_id','=','download_categoty.title_id')->where('download_categoty.download_id',$id)->first();
        $document_title = Downloadtitle::where('active','y')->get();
        if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่

            $document_type = Downloadcategoty::findById($id);
            $document_type->download_name = $request->input('download_name');
            $document_type->title_id = $request->input('document_title');
            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต
    
            $document_type->save();
            
            return redirect()->route('document.type')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
        return view("admin.document.document_type_edit",['document_type' =>$document_type,'document_title' =>$document_title]);
    }
    function document_type_create(Request $request){
        $document_title = Downloadtitle::where('active','y')->get();
        if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่

            $document_type = new Downloadcategoty;
            $document_type->download_name = $request->input('download_name');
            $document_type->title_id = $request->input('document_title');
            $document_type->active = 'y';
            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต
    
            $document_type->save();
            
            return redirect()->route('document.type')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
        return view("admin.document.document_type_create",['document_title' => $document_title]);
    }

    function document_type_delete($id){
        $document_del=[
            'active'=>'n'
        ];
        $document_type = Downloadcategoty::findById($id);
        $document_type->update($document_del);
        return redirect()->route('document.type');
    }
    //new p
    function news_create(Request $request){
        if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่
            // dd($request->toArray());
            $validator = Validator::make($request->all(), [
                'cms_title' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                'cms_short_title' =>'required|string',
                'cms_detail' =>'required|string'

            ]);
            // dd($validator);
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }

            $news_create = new News;
            $news_create->cms_title = $request->input('cms_title');
            $news_create->cms_short_title = $request->input('cms_short_title');
            $news_create->cms_detail = htmlspecialchars($request->input('cms_detail'));
            $news_create->create_by = Auth::user()->id;
            $news_create->update_by = Auth::user()->id;
            $news_create->active = 'y';
            ///image
            if($request->file('image')){
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $news_create->cms_picture = $imageName;
            }
            
            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต
    
            $news_create->save();
            // dd($news_create->toArray());
            if($request->file('image')){
                $image = $request->file('image');

                $idFolder = public_path('images/uploads/news/'.$news_create->cms_id.'/original/');
                if (!file_exists($idFolder)) {
                    mkdir($idFolder, 0755, true);
                }

                // ย้ายไฟล์ภาพไปยังโฟลเดอร์ใหม
                $image->move($idFolder, $imageName);

                
            }
            return redirect()->route('news')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
        return view("admin.news.news-create");
    }
    function news_edit (Request $request,$id){
        $news = News::where('cms_id',$id)->first();
        if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่
            // dd($request->toArray());
            $validator = Validator::make($request->all(), [
                'cms_title' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                'cms_short_title' =>'required|string',
                'cms_detail' =>'required|string'

            ]);
            // dd($validator);
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }

            $news_update = News::findById($id);
            $news_update->cms_title = $request->input('cms_title');
            $news_update->cms_short_title = $request->input('cms_short_title');
            $news_update->cms_detail = htmlspecialchars($request->input('cms_detail'));
            $news_update->update_by = Auth::user()->id;
            if($request->file('image')){
                $image = $request->file('image');

                $idFolder = public_path('images/uploads/news/'.$id.'/original/');
                if (!file_exists($idFolder)) {
                    mkdir($idFolder, 0755, true);
                }

                // ย้ายไฟล์ภาพไปยังโฟลเดอร์ใหม่
                $imageName = $image->getClientOriginalName();
                $image->move($idFolder, $imageName);

                $news_update->cms_picture = $imageName;
                
            }
            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต
    
            $news_update->save();
    
            return redirect()->route('news')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
        return view("admin.news.News-edit",['news' => $news]);
    }
    function news(){
        $news = News::where('active','y')->paginate(10);
        return view("admin.news.news",['news' => $news]);
    }
    }  
    function news_detail($id){
        $news = News::where('cms_id',$id)->first();
        return view("admin.news.news_detail",['news' => $news]);
    }  
    function category(){
        $category_on = DB::table('category')->where('category.active', 'y')->orderBy('cate_id', 'desc')->get();
        return view("admin.category.category",compact('category_on'));
    }
    function category_delete($id){
        $category_del=[
            'active'=>'n'
        ];
        $category = Category::findById($id);
        $category->update($category_del);
        return redirect()->route('category');
    }
    function category_create(Request $request){
        if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่
            // dd($request->toArray());
            $validator = Validator::make($request->all(), [
                'cate_title' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                'cate_short_detail' =>'required|string',
                'cate_detail' =>'required|string'

            ]);
            // dd($validator);
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }

            $category_update = new Category;
            $category_update->cate_title = $request->input('cate_title');
            $category_update->cate_short_detail = $request->input('cate_short_detail');
            $category_update->cate_detail = htmlspecialchars($request->input('cate_detail'));
            $category_update->update_by = Auth::user()->id;

            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $category_update->cate_image = $imageName;
            $category_update->save();

            if($request->file('image')){
                $image = $request->file('image');

                $idFolder = public_path('images/uploads/category/'.$category_update->cate_id.'/original/');
                if (!file_exists($idFolder)) {
                    mkdir($idFolder, 0755, true);
                }

                // ย้ายไฟล์ภาพไปยังโฟลเดอร์ใหม่
                $image->move($idFolder, $imageName);

                
                
            }
    
            return redirect()->route('category')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
        return view("admin.category.category_create");
    }
    function category_detail($id){
        $category = Category::where('cate_id',$id)->first();

        return view("admin.category.category_detail",compact('category'));
    }
    function category_edit(Request $request,$id){
        $category = Category::where('cate_id',$id)->first();
        if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่
            // dd($request->toArray());
            $validator = Validator::make($request->all(), [
                'cate_title' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                'cate_short_detail' =>'required|string',
                'cate_detail' =>'required|string'

            ]);
            // dd($validator);
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }

            $category_update = Category::findById($id);
            $category_update->cate_title = $request->input('cate_title');
            $category_update->cate_short_detail = $request->input('cate_short_detail');
            $category_update->cate_detail = htmlspecialchars($request->input('cate_detail'));
            $category_update->update_by = Auth::user()->id;
            if($request->file('image')){
                $image = $request->file('image');

                $idFolder = public_path('images/uploads/category/'.$id.'/original/');
                if (!file_exists($idFolder)) {
                    mkdir($idFolder, 0755, true);
                }

                // ย้ายไฟล์ภาพไปยังโฟลเดอร์ใหม่
                $imageName = $image->getClientOriginalName();
                $image->move($idFolder, $imageName);

                $category_update->cate_image = $imageName;
                
            }
            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต
    
            $category_update->save();
    
            return redirect()->route('category')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
        return view("admin.category.category_edit",compact('category'));
    }
    function category_openshow(Request $request,$id){
        $category = Category::where('cate_id',$id)->first();
        if ($request->has('on')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่
            $showValue = $request->input('on');
            // dd($showValue);
        }elseif($request->has('off')){
            $showValue = $request->input('off');
        }
            // dd($showValue);
            $category_update = Category::findById($id);
            $category_update->cate_show = $showValue;
            $category_update->update_by = Auth::user()->id;
            
            $category_update->save();
    
            return redirect()->route('category')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        return redirect()->route('category');
    }
    
    function courseonline(){
        $course_online = Course::join('category', 'category.cate_id', '=', 'course_online.cate_id')->where('course_online.active', 'y')->orderBy('sortOrder', 'desc')->paginate(10);
        return view("admin.courseonline.courseonline", compact('course_online'));
    }

    function courseonline_delete($id){
        $courseonline_del=[
            'active'=>'n'
        ];
        $courseonline = Course::findById($id);
        $courseonline->update($courseonline_del);
        return redirect()->route('courseonline');
    }
    function courseonline_detail($id){
        $course_online = Course::join('category', 'category.cate_id', '=', 'course_online.cate_id')->where('course_online.course_id',$id)->first();
        return view("admin.courseonline.courseonline_detail", compact('course_online'));
    }

    function courseonline_edit(Request $request, $id)
    {
        $course_detail = DB::table('course_online')->where('course_id', $id)->first();
        $category = DB::table('category')->pluck('cate_title', 'cate_id');
        $teacher = Teacher::where('active','y')->get();
        if ($request->isMethod('post')) {
            // dd($request->toArray());
            $validator = Validator::make($request->all(), [
                'cate_id' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                'teacher_name' =>'required|string',
                'course_title' =>'required|string',
                'course_short_title'=>'required|string',
                'course_detail'=>'required|string',
                'course_note'=>'required|string',

            ]);
            // dd($validator);
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }

            $course_update = Course::findById($id);
            $course_update->cate_id = $request->input('cate_id');
            $course_update->teacher_name = $request->input('teacher_name');
            $course_update->course_title = $request->input('course_title');
            $course_update->course_short_title = htmlspecialchars($request->input('course_short_title'));
            $course_update->course_detail = htmlspecialchars($request->input('course_detail'));
            $course_update->course_note = $request->input('course_note');
            $course_update->update_by = Auth::user()->id;

            if ($request->has('recommend')) {
                $course_update->recommend = 'y';
            }else{
                $course_update->recommend = 'n';
            }

            if($request->file('image')){
                $image = $request->file('image');

                $idFolder = public_path('images/uploads/course/'.$id.'/original/');
                if (!file_exists($idFolder)) {
                    mkdir($idFolder, 0755, true);
                }

                // ย้ายไฟล์ภาพไปยังโฟลเดอร์ใหม่
                $imageName = $image->getClientOriginalName();
                $image->move($idFolder, $imageName);

                $course_update->cate_image = $imageName;
                
            }
            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต

            $course_update->save();

            return redirect()->route('courseonline')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
        return view("admin.courseonline.courseonline_edit", compact('course_detail', 'category','teacher'));
    }
    function courseonline_create(Request $request)
    {
        $category = DB::table('category')->where('active','y')->pluck('cate_title', 'cate_id');
        $teacher = Teacher::where('active','y')->get();
        if ($request->isMethod('post')) {
            // dd($request->toArray());
            $validator = Validator::make($request->all(), [
                'cate_id' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                'teacher_name' =>'required|string',
                'course_title' =>'required|string',
                'course_short_title'=>'required|string',
                'course_detail'=>'required|string',
                'course_note'=>'required|string',

            ]);
            $teacher = Teacher::where('teacher_name',$request->input('teacher_name'))->first();
            
            // dd($validator);
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }

            $course_update = new Course;
            $course_update->cate_id = $request->input('cate_id');
            $course_update->course_lecturer = $teacher->teacher_id;
            $course_update->teacher_name = $request->input('teacher_name');
            $course_update->course_title = $request->input('course_title');
            $course_update->course_short_title = htmlspecialchars($request->input('course_short_title'));
            $course_update->course_note = $request->input('course_note');
            $course_update->course_detail = htmlspecialchars($request->input('course_detail'));
            $course_update->update_by = Auth::user()->id;
            $course_update->create_by = Auth::user()->id;
            $course_update->active = 'y';
            $course_update->special_category = 'n';
            $course_update->status = '1';
            $course_update->cate_amount = '1';
            $course_update->time_test = '60';
            $course_update->lang_id = '1';
            $course_update->random_choice = '0';
            $course_update->average_time_pretest = '0';
            $course_update->average_time_posttest = '0';

            if ($request->has('recommend')) {
                $course_update->recommend = 'y';
            }else{
                $course_update->recommend = 'n';
            }

            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $course_update->course_picture = $imageName;
            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต

            $course_update->save();

            if($request->file('image')){
                $image = $request->file('image');

                $idFolder = public_path('images/uploads/courseonline/'.$course_update->course_id.'/original/');
                if (!file_exists($idFolder)) {
                    mkdir($idFolder, 0755, true);
                }

                // ย้ายไฟล์ภาพไปยังโฟลเดอร์ใหม่
                
                $image->move($idFolder, $imageName);

                
                
            }
            $course_update->sortOrder = $course_update->course_id;
            $course_update->save();

            return redirect()->route('courseonline')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
        return view("admin.courseonline.courseonline_create", compact('category','teacher'));
    }
    function courseonlinecreateto(Request $request)
    {
        $request->validate([
            'course_picture' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);
        // img
        $uploadedFile = $request->file('CourseOnline.course_picture');
        $extension = $uploadedFile->getClientOriginalExtension();
        $filename = now()->format('Ymd') . rand(10000, 99999) . '_Picture.' . $extension;
        $uploadedFile->storeAs('public/images/uploads/', $filename);
        // ข้อมูล
        $data = [
            'cate_id' => $request->input('CourseOnline.cate_id'),
            'course_lecturer' => $request->input('CourseOnline.course_lecturer'),
            'course_title' => $request->input('CourseOnline.course_title'),
            'course_short_title' => $request->input('CourseOnline.course_short_title'),
            'course_detail' => $request->input('CourseOnline.course_detail'),
            'recommend' => $request->input('CourseOnline.recommend'),
            'course_note' => $request->input('CourseOnline.course_note'),
            'course_picture' => $filename,
        ];
        // บันทึก
        DB::table('course_online')->insert($data);
        $redirectUrl = route('courseonline');
        return redirect($redirectUrl);
    }
    // course edit
    function courseonlineedit(Request $request, $id)
    {
        $course_detail = DB::table('course_online')->where('course_id', $id)->first();
        $category = DB::table('category')->pluck('cate_title', 'cate_id');
        return view("admin.courseonline.courseonline-edit", compact('course_detail', 'category'));
    }
    // course edit to 
    function courseonlineeditto(Request $request, $id)
    {
        $request->validate([
            'course_picture' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);
        // img
        $filename = DB::table('course_online')->where('course_id', $id)->value('course_picture');
        $uploadedFile = $request->file('CourseOnline.course_picture');
        if ($uploadedFile) {
            $extension = $uploadedFile->getClientOriginalExtension();
            // ตั้งชื่อไฟล์
            $filename = now()->format('Ymd') . rand(10000, 99999) . '_Picture.' . $extension;
            // บันทึกไฟล์
            $uploadedFile->storeAs('public/images/uploads/', $filename);
            // อัปเดตไฟล์ลงฐานข้อมูล
            DB::table('course_online')->where('course_id', $id)->update([
                'course_picture' => $filename,
            ]);
        }
        // ข้อมูล
        $data = [
            'cate_id' => $request->input('CourseOnline.cate_id'),
            'course_lecturer' => $request->input('CourseOnline.course_lecturer'),
            'course_title' => $request->input('CourseOnline.course_title'),
            'course_short_title' => $request->input('CourseOnline.course_short_title'),
            'course_detail' => $request->input('CourseOnline.course_detail'),
            'recommend' => $request->input('CourseOnline.recommend'),
            'course_note' => $request->input('CourseOnline.course_note'),
            'course_picture' => $filename,
            'update_date' => now(),
        ];
        // บันทึก
        DB::table('course_online')->where('course_id', $id)->update($data);
        $redirectUrl = route('courseonline');
        return redirect($redirectUrl);
    }
    // course change to id
    function courseonlinechange($id)
    {
        $course_detail = DB::table('course_online')->where('course_id', $id)->first();
        // ตรวจสอบค่าปัจจุบันของ 'active' และกำหนดค่าใหม่
        $newActive = ($course_detail->active == 'y') ? 'n' : 'y';
        $data = [
            'active' => $newActive,
        ];
        DB::table('course_online')->where('course_id', $id)->update($data);
        $redirectUrl = route('courseonline');
        return redirect($redirectUrl);
    }
     // course det show
     function courseonlinedet(Request $request, $id)
     {
      
     }
    function lesson(){
        $course_online = Course::where('active', 'y')->orderBy('sortOrder', 'desc')->get();
        $lesson = Lesson::where('lesson.active', 'y')->paginate(10);
        return view("admin.lesson.lesson",compact('course_online','lesson'));
    }

    function lesson_detail($id){
        $lesson = Lesson::join('course_online','course_online.course_id','=','lesson.course_id')->where('lesson.id',$id)->first();
        $file = File::where('lesson_id',$id)->where('active','y')->first();
        $filedoc = FileDoc::where('lesson_id',$id)->where('active','y')->first();
        
        return view("admin.lesson.lesson_detail",compact('lesson','file','filedoc'));
    }
    function downloadfile($id,  Request $request){
         // Retrieve the file information from the database
         $file = FileDoc::where('id',$id)->first();
         // Check if the file exists
     
         // Construct the full file path
         $file_path = public_path('images/uploads/filedoc'.DIRECTORY_SEPARATOR. $file->filename);
    
    
         // Check if the file actually exists on the server
         if (!file_exists($file_path)) {
             return response()->json(['error' => 'File not found on the server'], 404);
         }
     
         // Generate the response for downloading the file
         return response()->download($file_path, $file->original_filename);
    }
    function lesson_delete($id){
        $lesson_del=[
            'active'=>'n'
        ];
        $lesson = Lesson::findById($id);
        $lesson->update($lesson_del);
        return redirect()->route('lesson');
    }  

    function lesson_delete_video($id){
       
        $file_del=[
            'active'=>'n'
        ];
        $file = File::findById($id);
        $file->update($file_del);
        return redirect()->route('lesson');
    }  

    function lesson_edit(Request $request,$id){
        $course_online = Course::where('course_online.active', 'y')->orderBy('course_id', 'desc')->get();
        $lesson = Lesson::join('course_online','course_online.course_id','=','lesson.course_id')->where('lesson.id',$id)->first();
        $file = File::where('lesson_id',$id)->where('active','y')->first();
        $filedoc = FileDoc::where('lesson_id',$id)->where('active','y')->first();

        if ($request->isMethod('post')) {
            // dd($request->toArray());
            $validator = Validator::make($request->all(), [
                'course_id' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                'title' =>'required|string',
                'description' =>'required|string',
                'cate_amount'=>'required|string',
                'time_test'=>'required|string'

            ]);
            
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }

            $lesson_update = Lesson::findById($id);
            $lesson_update->course_id = $request->input('course_id');
            $lesson_update->title = $request->input('title');
            $lesson_update->description = $request->input('description');
            $lesson_update->cate_amount = $request->input('cate_amount');
            $lesson_update->time_test = $request->input('time_test');
            $lesson_update->update_by = Auth::user()->id;

            if ($request->hasFile('filename')) {
                $validator = Validator::make($request->all(), [
                    'filename' => 'required|mimes:mp3,mp4',     
                ]);
        
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $filename = $request->file('filename');
                $file_name = $filename->getClientOriginalName();

                $idFolder = public_path('images/uploads/lesson/');
                if (!file_exists($idFolder)) {
                    mkdir($idFolder, 0755, true);
                }
                $filename->move($idFolder, $file_name);

                
                $file_update = new File;
                $file_update->lesson_id = $id;
                $file_update->file_name = $lesson->title;
                $file_update->filename = $file_name;
                $file_update->length = '2.00';
                $file_update->create_by = Auth::user()->id;
                $file_update->update_by = Auth::user()->id;
                $file_update->active = 'y';
                $file_update->views = '0';
                $file_update->save();

            }
            
            if($request->hasFile('doc')){
                $validator = Validator::make($request->all(), [
                    'doc' => 'required|mimes:pdf,docx,pptx',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $doc = $request->file('doc');
                $doc_name = $doc->getClientOriginalName();

                $idFolder = public_path('images/uploads/filedoc/');
                if (!file_exists($idFolder)) {
                    mkdir($idFolder, 0755, true);
                }
                $doc->move($idFolder, $doc_name);

                $doc_update = FileDoc::where('lesson_id',$id)->first();
                $doc_update->filename = $doc_name;
                $doc_update->update_by = Auth::user()->id;
                $doc_update->save();
            }
            
            if($request->file('image')){
                $image = $request->file('image');

                $idFolder = public_path('images/uploads/lesson/'.$id.'/original/');
                if (!file_exists($idFolder)) {
                    mkdir($idFolder, 0755, true);
                }

                // ย้ายไฟล์ภาพไปยังโฟลเดอร์ใหม่
                $imageName = $image->getClientOriginalName();
                $image->move($idFolder, $imageName);

                $lesson_update->image = $imageName;
                
            }
            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต

            $lesson_update->save();

            return redirect()->route('lesson')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }

        return view("admin.lesson.lesson_edit",compact('course_online','lesson','file','filedoc'));
    }
    function lesson_create(Request $request){
        $course_online = Course::where('course_online.active', 'y')->orderBy('course_id', 'desc')->get();
        

        if ($request->isMethod('post')) {
            // dd($request->toArray());
            $validator = Validator::make($request->all(), [
                'course_id' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                'title' =>'required|string',
                'description' =>'required|string',
                'cate_amount'=>'required|string',
                'time_test'=>'required|string',
                'content' =>'required|string'

            ]);
            
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }

            $lesson_create = new Lesson;
            $lesson_create->course_id = $request->input('course_id');
            $lesson_create->title = $request->input('title');
            $lesson_create->content = htmlspecialchars($request->input('content'));
            $lesson_create->description = $request->input('description');
            $lesson_create->cate_amount = $request->input('cate_amount');
            $lesson_create->time_test = $request->input('time_test');
            $lesson_create->update_by = Auth::user()->id;
            $lesson_create->active = 'y';

            if($request->file('image')){
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $lesson_create->save();


            }
            if ($request->hasFile('filename') || $request->hasFile('doc')) {
                $validator = Validator::make($request->all(), [
                    'filename' => 'required|mimes:mp3,mp4',
                    'doc' => 'required|mimes:pdf,docx,pptx',
                ]);
        
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $filename = $request->file('filename');
                $doc = $request->file('doc');
                $file_name = $filename->getClientOriginalName();
                $doc_name = $doc->getClientOriginalName();

                $file_new = new File;
                $file_new->lesson_id = $lesson_create->id;
                $file_new->file_name = $lesson_create->title;
                $file_new->filename = $file_name;
                $file_new->length = '2.00';
                $file_new->create_by = Auth::user()->id;
                $file_new->update_by = Auth::user()->id;
                $file_new->active = 'y';
                $file_new->view = '0';
                $file_new->domain_id = '15';
                $file_new->save();

                $idFolder = public_path('images/uploads/lesson/');
                if (!file_exists($idFolder)) {
                    mkdir($idFolder, 0755, true);
                }
                $filename->move($idFolder, $file_name);
                //---------------------------------------//

                $doc_new = new FileDoc;
                $doc_new->lesson_id = $lesson_create->id;
                $doc_new->file_name = $lesson_create->title;
                $doc_new->filename = $doc_name;
                $doc_new->length = '2.00';
                $doc_new->create_by = Auth::user()->id;
                $doc_new->update_by = Auth::user()->id;
                $doc_new->active = 'y';
                $doc_new->domain_id = '15';
                $doc_new->save();

                $idFolder = public_path('images/uploads/filedoc/');
                if (!file_exists($idFolder)) {
                    mkdir($idFolder, 0755, true);
                }
                $doc->move($idFolder, $doc_name);
                //-----------------------------------------//

            }
            if($request->file('image')){
                

                $idFolder = public_path('images/uploads/lesson/'.$lesson_create->id.'/original/');
                if (!file_exists($idFolder)) {
                    mkdir($idFolder, 0755, true);
                }

                // ย้ายไฟล์ภาพไปยังโฟลเดอร์ใหม่
               
                $image->move($idFolder, $imageName);

                $lesson_create->image = $imageName;
                
                $lesson_create->save();
            }
            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต
            $lesson_create->sort_lesson = $lesson_create->id;
            $lesson_create->save();

            return redirect()->route('lesson')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }

        return view("admin.lesson.lesson_create",compact('course_online'));
    }
    
    function filemanagers(Request $request, $id = null){
        if($id !== null){
            $file = File::where('lesson_id', $id)->where('active', 'y')->paginate(10);
        } else {
            $file = File::where('active', 'y')->paginate(10);
        }
        return view("admin.file_managers.file_managers", ['file' => $file]);
    }
    //new p
    function grouptesting_create(Request $request){
        $lesson = Lesson::where('active','y')->get();

        if ($request->isMethod('post')) {
            // dd($request->toArray());
            $validator = Validator::make($request->all(), [
                'lesson_id' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                'group_title' =>'required|string'

            ]);
            
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }

            $grouptesting_create = new Grouptesting;
            $grouptesting_create->lesson_id = $request->input('lesson_id');
            $grouptesting_create->group_title = $request->input('group_title');
            $grouptesting_create->step_id = '1';
            $grouptesting_create->create_by = Auth::user()->id;
            $grouptesting_create->update_by = Auth::user()->id;
            $grouptesting_create->active = 'y';
            $grouptesting_create->save();

            return redirect()->route('grouptesting')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }


        return view("admin.grouptesting.grouptesting-create",['lesson' => $lesson]);
    }
    function grouptesting(Request $request, $id = null, $type = null){
        $id = $request->query('id');
        $type = $request->query('type');
        if($id !== null && $type !== null ){
            $manage = Manage::where('id', $id)->where('type', $type)->first();
            // ตรวจสอบว่า $manage ไม่เป็น null ก่อนที่จะดำเนินการต่อ
            if($manage !== null){
                $grouptesting = Grouptesting::where('lesson_id', $manage->id)->where('active', 'y')->paginate(10);
            } else {
                $grouptesting = Grouptesting::where('active','y')->paginate(10);
            }
        } else {
            $grouptesting = Grouptesting::where('active','y')->paginate(10);
        }
        
        return view("admin.grouptesting.grouptesting",['grouptesting' => $grouptesting]);
    }
    //

    //new p
    function coursegrouptesting_create(Request $request){
        $grouptesting = Grouptesting::where('active','y')->get();

        if ($request->isMethod('post')) {
            // dd($request->toArray());
            $validator = Validator::make($request->all(), [
                'group_id' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                'ques_title' =>'required|string',
                'ques_explain' =>'required|string'

            ]);
            
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }

            $coursegrouptesting_create = new Question;
            $coursegrouptesting_create->group_id = $request->input('group_id');
            $coursegrouptesting_create->ques_title = $request->input('ques_title');
            $coursegrouptesting_create->ques_type = $request->input('radio');
            $coursegrouptesting_create->ques_explain = $request->input('ques_explain');
            $coursegrouptesting_create->create_by = Auth::user()->id;
            $coursegrouptesting_create->update_by = Auth::user()->id;
            $coursegrouptesting_create->active = 'y';
            $coursegrouptesting_create->save();

            return redirect()->route('coursegrouptesting')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
        return view("admin.coursegrouptesting.coursegrouptesting-create",['grouptesting' => $grouptesting]);
    }
    function coursegrouptesting(){
        $coursegrouptesting = Question::where('active','y')->paginate(10);
        return view("admin.coursegrouptesting.coursegrouptesting",['coursegrouptesting' =>$coursegrouptesting]);
    }
    //

    //new p
    function questionnaireout(){
        $survey_headers = Questionnaireout::get();
        return view("admin.questionnaireout.questionnaireout",compact('survey_headers'));
    }
    function questionnaireout_create(){
        return view("admin.questionnaireout.questionnaireout-create");
    }
    function questionnaireout_insert(Request $request){
        $request->validate([
            'survey_name' => 'required|max:73',
            'instructions' => 'required|max:752',
        ]);
        $survey_header_data=[
            'survey_name'=>$request->survey_name,
            'instructions'=>$request->instructions,
            'instructions_en'=>'',
            'other_header_info'=>'',               //default
            'type'=>'',
            'active'=>'y'                   //default
        ];
        $survey = new Questionnaireout;
        $survey->fill($survey_header_data);
        $survey->save();
        return redirect()->route('questionnaireout');
    }
    function questionnaireout_edit($survey_header_id){
        $survey_headers = Questionnaireout::get()->where('survey_header_id',$survey_header_id)->first();
        return view("admin.questionnaireout.questionnaireout-edit",compact('survey_headers'));
    }
    function questionnaireout_update(Request $request,$survey_header_id){
        $request->validate([
            'survey_name' => 'required|max:73',
            'instructions' => 'required|max:752',
        ]);
        $survey_header_data=[
            'survey_name'=>$request->survey_name,
            'instructions'=>$request->instructions,
            'instructions_en'=>'',
            'other_header_info'=>'',               //default
            'type'=>'',
            'active'=>'y'                   //default
        ];
        $update_survey = Questionnaireout::where('survey_header_id', $survey_header_id)->first();
        $update_survey->fill($survey_header_data);
        $update_survey->save();
        return redirect()->route('questionnaireout');
    }
    function questionnaireout_delete($survey_header_id){
        $questionnaireout_delete=[
            'active'=>'n'
        ];
        $update_survey = Questionnaireout::where('survey_header_id', $survey_header_id)->first();
        $update_survey->fill($questionnaireout_delete);
        $update_survey->save();
        return redirect()->route('questionnaireout');
    }
    //
    //new p
    function question(){
        $question= DB::table('question')
        ->join('grouptesting', 'question.group_id', '=', 'grouptesting.group_id')
        ->select('question.*', 'grouptesting.group_title')
        ->get();
        return view("admin.Question.Question",compact('question'));
    }
    function question_create(){
        $grouptesting = DB::table('grouptesting')
        ->where('active', 'y')
        ->pluck('group_title', 'group_id');

        $question_create = DB::table('question')
            ->join('grouptesting', 'question.group_id', '=', 'grouptesting.group_id')
            ->select('question.*', 'grouptesting.group_title')
            ->get();
        return view("admin.Question.Question_create",compact('question_create','grouptesting'));
    }
    function question_insert(Request $request){
        $request->validate([
            'group_id'=>'required',
            'ques_type'=>'required',
            'test_type'=>'required',
            'difficult'=>'required',
            'ques_title'=>'required',
            'ques_explain'=>'required',
        ]);
        $date=new DateTime('Asia/Bangkok');
        $question_data=[
            'group_id'=>$request->group_id,
            'ques_type'=>$request->ques_type,
            'test_type'=>$request->test_type,
            'difficult'=>$request->test_type,
            'ques_title'=>$request->ques_title,
            'ques_explain'=>$request->ques_explain,
            'create_date'=>$date,
            'create_by'=> Auth::user()->id,
            'update_date'=>$date,
            'update_by'=> Auth::user()->id,
            'active'=>'y',
        ];
        DB::table('question')->insert($question_data);
        return redirect('/question');
    }
    function question_edit_page($id){
        $grouptesting = DB::table('grouptesting')
        ->where('active', 'y')
        ->pluck('group_title', 'group_id');
        $question_edit_page= DB::table('question')
        ->where('ques_id',$id)
        ->first();
        return view("admin.Question.Question_edit_page",compact('grouptesting','question_edit_page'));
    }
    function question_edit(Request $request,$id){
        $request->validate([
            'group_id'=>'required',
            'ques_type'=>'required',
            'test_type'=>'required',
            'difficult'=>'required',
            'ques_title'=>'required',
            'ques_explain'=>'required',
        ]);
        $date=new DateTime('Asia/Bangkok');
        $question_edit  =[
            'group_id'=>$request->group_id,
            'ques_type'=>$request->ques_type,
            'test_type'=>$request->test_type,
            'difficult'=>$request->test_type,
            'ques_title'=>$request->ques_title,
            'ques_explain'=>$request->ques_explain,
            'update_date'=>$date,
            'update_by'=> Auth::user()->id
        ]; 
        DB::table('question')->where('ques_id',$id)->update($question_edit);
        return redirect("/question");
    }
    function question_delete($id){

        $question_delete=[
            'active'=>'n',
        ];
        DB::table('question')->where('ques_id',$id)->update($question_delete);
        return redirect("/question");
    }
    function orgchart(){
        $orgchart =DB::table('orgchart')->get();
        return view("admin.orgchart.orgchart",compact('orgchart'));
    }
    function orgchart_create(){
        return view("admin.orgchart.orgchart-create");
    }
    function orgchart_insert(Request $request){
        $request->validate([
            'title'=>'required|max:24',
            'level' => 'required|max:1',
        ]);
        $orgchart_data=[
            'title'=>$request->title,
            'level'=>$request->level,
            'active'=>'y'                   //default
        ];
        DB::table('orgchart')->insert($orgchart_data);
        return redirect()->route('orgchart');
    }
    function orgchart_edit($orgchart_id){
        $orgchart =DB::table('orgchart')->where('orgchart_id',$orgchart_id)->first();
        return view("admin.orgchart.orgchart-edit",compact('orgchart'));
    }
    function orgchart_update(Request $request,$orgchart_id){
        $request->validate([
            'title'=>'required|max:24',
            'level' => 'required|max:1',
        ]);
        $orgchart_data=[
            'title'=>$request->title,
            'level'=>$request->level,
            'active'=>'y'                  //default
        ];
        DB::table('orgchart')->where('orgchart_id',$orgchart_id)->update($orgchart_data);
        return redirect()->route('orgchart');
    }
    function orgchart_delete($orgchart_id){
        $orgchart_delete=[
            'active'=>'n'
        ];
        DB::table('orgchart')->where('orgchart_id',$orgchart_id)->update($orgchart_delete);
        return redirect()->route('orgchart');
    }

    //
    function checklecture(){
        return view("admin.checklecture.checklecture");
    }
    function coursecheck(){
        return view("admin.checklecture.checklecture-coursecheck");
    }
    function certificate(){
        return view("admin.certificate.certificate");
    }
    function signnature(){
        return view("admin.signnature.signnature");
    }
    function captcha(){
        return view("admin.captcha.captcha");
    }
    function usability(){
        $usa = Usability::where('active','y')->get();
        return view("admin.usability.usability",['usa' => $usa]);
    }

    function usability_detail($id){
        $usa = Usability::where('usa_id',$id)->first();
        return view("admin.usability.usability_detail",['usa' => $usa]);
    }

    function usability_edit(Request $request,$id){
        $usa = Usability::where('usa_id',$id)->first();
        if ($request->isMethod('post')) {
            // dd($request->toArray());
            $validator = Validator::make($request->all(), [
                'usa_title' => 'required|string' // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
            ]);
            
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }

            $usa_update =  Usability::findById($id);
            $usa_update->usa_title = $request->input('usa_title');
            $usa_update->usa_detail = htmlspecialchars($request->input('usa_detail'));

            $usa_update->update_by = Auth::user()->id;

            $usa_update->save();

            
            


            return redirect()->route('usability')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
        return view("admin.usability.usability_edit",['usa' => $usa]);
    }

    function usability_create(Request $request){
        if ($request->isMethod('post')) {
            // dd($request->toArray());
            $validator = Validator::make($request->all(), [
                'usa_title' => 'required|string' // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
            ]);
            
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }

            $usa_update =  new Usability;
            $usa_update->usa_title = $request->input('usa_title');
            $usa_update->usa_detail = htmlspecialchars($request->input('usa_detail'));
            $usa_update->create_by = Auth::user()->id;
            $usa_update->update_by = Auth::user()->id;
            $usa_update->active ='y';
            $usa_update->save();

            
            


            return redirect()->route('usability')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
        return view("admin.usability.usability_create");
    }
    function usability_delete(Request $request){
       
        if (!$request->has('id')) {
            // คืนค่า JSON แจ้งข้อผิดพลาดว่าไม่มีค่า ID ถูกส่งมา
            return response()->json(['success' => false, 'message' => 'No ID provided'], 400);
        }

        $id = $request->input('id');
        $usability_del=[
            'active'=>'n'
        ];
        $usability = Usability::findById($id);
        $usability->update($usability_del);
        // กรณีที่ไม่มีการส่งค่า id มา
        // คุณสามารถตัดสินใจปฏิเสธคำขอหรือดำเนินการอื่น ๆ ตามที่ต้องการได้
        return response()->json(['success' => true]);
    }  
    

    function reportproblem(){
        $reportproblem = Reportproblem::paginate(10);
        return view("admin.report.reportproblem",['reportproblem' => $reportproblem]);
    }
    function faqtype(){
        $faqtype= Faq_type::get();
        return view("admin.faq.faqtype",compact('faqtype'));
    }
    function faqtype_detail($id){
        $faq_type= Faq_type::where('faq_type_id',$id)->first();
        return view("admin.faq.faqtype_detail",['faq_type'=>$faq_type]);
    }
    function faqtype_create(){
        $faqtype_create= Faq_type::get();
        return view("admin.faq.Faqtype_create",compact('faqtype_create'));
    }
    function faqtype_insert(Request $request){
        $request->validate([
            'faq_type_title_TH'=>'required'
        ]);
        $date=new DateTime('Asia/Bangkok');
        $faqtype_data=[
            'faq_type_title_TH'=>$request->faq_type_title_TH,
            'create_date'=>$date,
            'create_by'=> Auth::user()->id,
            'update_date'=>$date,
            'update_by'=> Auth::user()->id,
            'active'=>'y',
        ];
        $faq_type = new Faq_type;
        $faq_type->insert($faqtype_data);
        return redirect('/faqtype');
    }
    function faqtype_edit_page($id){
        $faqtype_edit_page= Faq_type::where('faq_type_id',$id)
        ->first();
        // dd($faqtype_edit_page);
        return view("admin.faq.Faqtype_edit_page",compact('faqtype_edit_page'));
    }
    function faqtype_edit(Request $request,$id){
        $request->validate([
            'faq_type_title_TH'=>'required',
        ]);
        $date=new DateTime('Asia/Bangkok');
        $faqtype_edit  =[
            'faq_type_title_TH'=>$request->faq_type_title_TH,
            'update_date'=>$date,
            'update_by'=> Auth::user()->id
        ]; 
        $faq_type = Faq_type::where('faq_type_id',$id);

        $faq_type->update($faqtype_edit);
        return redirect("/faqtype");
    }
    function faqtype_delete($id){

        $faqtype_delete=[
            'active'=>'n',
            'update_by' => Auth::user()->id
        ];
        $faq_type = Faq_type::where('faq_type_id',$id);
        $faq_type->update($faqtype_delete);
        return redirect("/faqtype");
    }
    function faq(){
        $faq= Faq::join('cms_faq_type', 'cms_faq.faq_type_id', '=', 'cms_faq_type.faq_type_id')
        ->select('cms_faq.*', 'cms_faq_type.faq_type_title_TH')
        ->get();
        return view("admin.faq.faq",compact('faq'));
    }
    function faq_detail($id){
        $faq= Faq::join('cms_faq_type', 'cms_faq.faq_type_id', '=', 'cms_faq_type.faq_type_id')
        ->where('faq_nid_',$id)
        ->first();
        return view("admin.faq.faq_detail",['faq' => $faq]);
    }
    function faq_create(){
        $faq_types = Faq_type::where('active', 'y')
        ->pluck('faq_type_title_TH', 'faq_type_id');

        $faq_create = DB::table('cms_faq')
            ->join('cms_faq_type', 'cms_faq.faq_type_id', '=', 'cms_faq_type.faq_type_id')
    
        $faq_create = Faq::join('cms_faq_type', 'cms_faq.faq_type_id', '=', 'cms_faq_type.faq_type_id')
            ->select('cms_faq.*', 'cms_faq_type.faq_type_title_TH')
            ->get();

        
        
        return view("admin.faq.Faq_create", compact('faq_create', 'faq_types'));
    }
    function faq_insert(Request $request){
        $request->validate([
            'faq_type_id'=>'required',
            'faq_THtopic'=>'required',
            'faq_THanswer'=>'required'
        ]);
        $date=new DateTime('Asia/Bangkok');
        $faq_data=[
            'faq_THtopic'=>$request->faq_THtopic,
            'faq_THanswer'=>$request->faq_THanswer,
            'faq_type_id'=>$request->faq_type_id,
            'create_date'=>$date,
            'faq_hideStatus'=>'1',
            'create_by'=>Auth::user()->id,
            'update_date'=>$date,
            'update_by'=>Auth::user()->id,
            'active'=>'y',
            'sortOrder'=>''
        ];
        $faq = new Faq;
        $faq->insert($faq_data);
        return redirect('/faq');
    }
    function faq_edit_page(Request $request,$id){
        $faq_edit_page = Faq::where('faq_nid_',$id)->first();
        $faq_types = Faq_type::where('active','y')->get();
        if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่
            
            // dd($request->toArray());
            $validator = Validator::make($request->all(), [
                'faq_THtopic' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                'faq_THanswer' =>'required|string'

            ]);
            // dd($validator);
            if ($validator->fails()) {
                
                return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
            }

            $faq_update = Faq::findById($id);
            $faq_update->faq_type_id = $request->input('faq_type_id');
            $faq_update->faq_THtopic = $request->input('faq_THtopic');
            $faq_update->faq_THanswer = $request->input('faq_THanswer');
            $faq_update->update_by = Auth::user()->id;
            
            // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต
    
            $faq_update->save();
    
            return redirect()->route('faq')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }
        return view("admin.faq.Faq_edit_page",compact('faq_edit_page','faq_types'));
    }
    function faq_edit(Request $request,$id){
        $request->validate([
            'faq_type_id'=>'required',
            'faq_THtopic'=>'required',
            'faq_THanswer'=>'required'
        ]);
        $date=new DateTime('Asia/Bangkok');
        $faq_edit  =[
            'faq_THtopic'=>$request->faq_THtopic,
            'faq_THanswer'=>$request->faq_THanswer,
            'faq_type_id'=>$request->faq_type_id,
            'update_date'=>$date,
            
            'update_by'=>Auth::user()->id,
        ]; 
        DB::table('cms_faq')->where('faq_nid_',$id)->update($faq_edit);
        return redirect("/faq");
    }
    function faq_delete($id){

        $faq_delete=[
            'active'=>'n',
        ];
        $faq = Faq::where('faq_nid_',$id);
        $faq->update($faq_delete);
        return redirect("/faq");
    }
    function generation(){
        $generation= DB::table('org_course')->get();
        return view("admin.Generation.Generation",compact('generation'));
    }
    function generation_create(){
        $generation_create= DB::table('org_course')->get();
        return view("admin.Generation.Generation_create",compact('generation_create'));
    }
    function generation_insert(Request $request){
        $request->validate([
            'orgchart_id'=>'required|numeric',
            'course_id'=>'required|numeric'
        ]);
        $generation_data=[
            'orgchart_id'=>$request->orgchart_id,
            'course_id'=>$request->course_id,
            'parent_id'=>'0',
            'active'=>'y',
        ];
        DB::table('org_course')->insert($generation_data);
        return redirect('/generation');
    }
    function generation_edit_page($id){
        $generation_edit_page= DB::table('org_course')
        ->where('id',$id)
        ->first();
        return view("admin.Generation.Generation_edit_page",compact('generation_edit_page'));
    }
    function generation_edit(Request $request,$id){
        $request->validate([
            'orgchart_id'=>'required|numeric',
            'course_id'=>'required|numeric'
        ]);
        $generation_edit  =[
            'orgchart_id'=>$request->orgchart_id,
            'course_id'=>$request->course_id,
        ];
        DB::table('org_course')->where('id',$id)->update($generation_edit);
        return redirect("/generation");
    }
    function generation_delete($id){

        $generation_delete=[
            'active'=>'n',
        ];
        DB::table('org_course')->where('id',$id)->update($generation_delete);
        return redirect("/generation");
    }

    //new p
    function adminuser(){
        $users =DB::table('users')->paginate(10);
        return view("admin\adminuser\adminuser",compact('users'));
    }
    function adminuser_create(){
        return view("admin\adminuser\adminuser-create");
    }
    function adminuser_insert(Request $request){
        $request->validate([
            'username' => 'required|max:20',
            'password' => 'required|max:32|min:8',
            'email' => 'required|max:39|email',
        ]);
        $date=new DateTime('Asia/Bangkok');
        $adminuser_data=[
            'username'=>$request->username,
            'password'=>$request->password,
            'email'=>$request->email,
            'create_at'=>$date,
            'lastvisit_at'=>$date,
            'last_activity'=>$date,
            'status'=>'1'
        ];
        DB::table('users')->insert($adminuser_data);
        return redirect()->route('adminuser');
    }
    function adminuser_edit($id){
        $users = DB::table('users')->where('id',$id)->first();
        return view("admin\adminuser\adminuser-edit",compact('users'));
    }
    function adminuser_update(Request $request,$id){
        $request->validate([
            'username' => 'required|max:20',
            'password' => 'required|max:32|min:8',
            'email' => 'required|max:39|email',
        ]);
        $date=new DateTime('Asia/Bangkok');
        $adminuser_data=[
            'username'=>$request->username,
            'password'=>$request->password,
            'email'=>$request->email,
            'lastvisit_at'=>$date,
            'last_activity'=>$date,
            'status'=>'1'
        ];
        DB::table('users')->where('id',$id)->update($adminuser_data);
        return redirect()->route('adminuser');
    }
    function adminuser_delete($id){
        $adminuser_delete=[
            'status'=>'0'
        ];
        DB::table('users')->where('id',$id)->update($adminuser_delete);
        return redirect()->route('adminuser');
    }
    //

    // new p
    function pgroup(){
        $p_group = Pgroup::get();
        return view("admin\pgroup\pgroup",compact('p_group'));
    }
    function pgroup_create(){
        return view("admin\pgroup\pgroup-create");
    }
    function pgroup_insert(Request $request){
        $request->validate([
            'group_name' => 'required|max:17',

        ]);
        $date=new DateTime('Asia/Bangkok');
        $pgroup_data=[
            'group_name'=>$request->group_name,
            'create_date'=>$date,
            'create_by'=>'1',               //default
            'update_date'=>$date,
            'update_by'=>'1',               //default
            'active'=>'y'                   //default
        ];
        $p_group = new Pgroup();
        $p_group->fill($pgroup_data);
        $p_group->save();

        $test = $request->input("setting","update","delete");
        $p_groupcondition = new Pgroupcondition();
        $p_groupcondition->pgroup_id = $p_group->pgroup_id;
        $p_groupcondition->permission = '{'.$test.'}';
        $p_groupcondition->save();
        return redirect()->route('pgroup');
    }
    function pgroup_edit($pgroup_id){
        $p_group = Pgroup::get()->where('pgroup_id',$pgroup_id)->first();
        return view("admin\pgroup\pgroup-edit",compact('p_group'));
    }
    function pgroup_update(Request $request,$pgroup_id){
        $request->validate([
            'group_name' => 'required|max:17',
        ]);
        $date=new DateTime('Asia/Bangkok');
        $pgroup_data=[
            'group_name'=>$request->group_name,
            'create_by'=>'1',               //default
            'update_date'=>$date,
            'update_by'=>'2',               //default
            'active'=>'y'                   //default
        ];
        $update_p_group = Pgroup::where('pgroup_id', $pgroup_id)->first();
        $update_p_group->fill($pgroup_data);
        $update_p_group->save();


        return redirect()->route('pgroup');
    }
    function pgroup_delete($pgroup_id){
        $pgroup_delete=[
            'active'=>'n'
        ];
        $update_pgroup = Pgroup::where('pgroup_id', $pgroup_id)->first();
        $update_pgroup->fill($pgroup_delete);
        $update_pgroup->save();
        return redirect()->route('pgroup');
    }
    //

    function user_admin(){
        $query = User::with('profile')->paginate($this->limit);
        return view("admin.user_admin.user-admin",compact('query'));
    }
    //************************* */ import user by chockekr
    public function userExcel(){
        return view("admin.user_admin.user-excel");
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new UsersImport, $request->file('import_excel'));

        return redirect()->back()->with('success', 'Excel imported successfully!');
    }
    //************************** */
    function coursefield(){
        return view("admin.coursefield.coursefield");
    }
    //new p
    function imgslide_create(){
        return view("admin.imgslide.Imgslide-create");
    }
    function imgslide_insert(Request $request){
        $request->validate([
            'imgslide_link'=>'required|url|max:76',
            'imgslide_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:255',
        ]);
        $date=new DateTime('Asia/Bangkok');
        // $dir="upload/";
        $imageName = time().'.'.$request->imgslide_picture->extension();
        $imgslide_data=[
            'imgslide_link'=>$request->imgslide_link,
            'imgslide_picture'=>$imageName,
            'create_date'=>$date,
            'create_by'=>'1',               //default
            'update_date'=>$date,
            'update_by'=>'1',               //default
            'active'=>'y'                   //default
        ];
        DB::table('imgslide')->insert($imgslide_data);
        $request->imgslide_picture->move(public_path('storage/Imgslides'),$imageName);

            $idFolder = public_path('images/uploads/imgslides');
            if (!file_exists($idFolder)) {
                mkdir($idFolder, 0755, true);
            }
            
        $request->imgslide_picture->move($idFolder,$imageName); 
        return redirect()->route('imgslide');
    }
    function imgslide(){
        $imgslide =DB::table('imgslide')->get();
        return view("admin.imgslide.imgslide",compact('imgslide'));
    }
    function imgslide_detail($id){
        $imgslide =Imgslide::where('imgslide_id',$id)->first();
        return view("admin.imgslide.imgslide_detail",['imgslide'=>$imgslide]);
    }
    function imgslide_edit($imgslide_id){
        $imgslide =DB::table('imgslide')->where('imgslide_id',$imgslide_id)->first();
        return view("admin.imgslide.Imgslide-edit",compact('imgslide'));
    }
    function imgslide_update(Request $request,$imgslide_id){
        $request->validate([
            'imgslide_link'=>'required|url|max:76',
            'imgslide_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:255',
        ]);
        $date=new DateTime('Asia/Bangkok');
        $imageName = time().'.'.$request->imgslide_picture->extension();
        $imgslide_data=[
            'imgslide_link'=>$request->imgslide_link,
            'imgslide_picture'=>$imageName,
            'create_date'=>$date,
            'create_by'=>'1',               //default
            'update_date'=>$date,
            'update_by'=>'1',               //default
            'active'=>'y'                   //default
        ];
        DB::table('imgslide')->where('imgslide_id',$imgslide_id)->update($imgslide_data);
        $request->imgslide_picture->move(public_path('storage/Imgslides'),$imageName);

        $idFolder = public_path('images/uploads/imgslides');
            if (!file_exists($idFolder)) {
                mkdir($idFolder, 0755, true);
            }
            
        $request->imgslide_picture->move($idFolder,$imageName); 
        return redirect()->route('imgslide');

    }
    function imgslide_delete($imgslide_id){
        $imgslide_delete=[
            'active'=>'n'
        ];
        DB::table('imgslide')->where('imgslide_id',$imgslide_id)->update($imgslide_delete);
        return redirect()->route('imgslide');
    }
    //
    function librarytype(){
        return view("admin.libraryfile.librarytype");
    }
    function libraryfile(){
        return view("admin.libraryfile.libraryfile");
    }
    function coursenotification(){
        $course_notification = Coursenotification::where('active','1')->paginate(10);
        return view("admin.coursenotification.coursenotification",['course_notification' => $course_notification]);
    }
    function passcourse(){
        return view("admin.passcourse.passcourse");
    }
    function logadmin(){
        $logadmin = Logadmin::join('tbl_users','tbl_users.id','=','log_admin.user_id')->paginate(10);
        return view("admin.logadmin.logadmin",['logadmin' => $logadmin]);
    }
    function logusers(){
        $logusers = Logusers::join('tbl_users','tbl_users.id','=','log_users.user_id')->paginate(10);
        return view("admin.logadmin.logadmin_user",['logusers' => $logusers]);
    }
    function logapprove(){
        $logapprove = Logapprove::join('users','users.id','=','log_approve.user_id')->paginate(10);
        return view("admin.logadmin.logadmin_apporve",['logapprove' => $logapprove]);
    }
    function logapporvepersonal(){
        $logapporvepersonal = Logapprovepersonal::join('users','users.id','=','log_approve_personal.user_id')->paginate(10);
        return view("admin.logadmin.logadmin_apporvepersonal",['logapporvepersonal' => $logapporvepersonal]);
    }
    function logregister(){
        $logregister = Logregister::join('users','users.id','=','log_register.user_id')->paginate(10);
        return view("admin.logadmin.logadmin_register",['logregister' => $logregister]);
    }
    function student_photo(){
        return view("admin.student-photo.student-photo");
    }
    function capture(){
        return view("admin.capture.capture");
    }
   
    function bank(Request $request)
    {
        //dd($request->id);
        if ($request->id == null) {
            return back();
        }
        $banks = DB::table('bank')->paginate(3);
        $ascs = DB::table('asc')->pluck('name', 'id');
        $vedios = DB::table('showvdo')
            ->join('asc', 'showvdo.showvdo_username', '=', 'asc.id')
            ->join('vedio', 'showvdo.showvdo_vdo', '=', 'vedio.id')
            ->select('showvdo.*', 'asc.name', 'vedio.vedio_name')
            ->get();
        $users = DB::table('users')
            ->join('asc', 'users.asc_id', '=', 'asc.id')
            ->select('users.*', 'asc.name')
            ->get();
        $url = url('bank', ['id' => $request->id]);
        return view('bank', compact('banks', 'ascs', 'url', 'users', 'vedios'));
    }

    //----- Popup หน้าเพิ่มข้อมูล
    function insertt()
    {
        return view('bank');
    }

    //----- popup User
    function user(Request $request)
    {
        return view('bank');
    }

    //----- ลบ VDO
    function del(Request $request, $id)
    {
        $del = DB::table('showvdo')->where('id', $id)->first();
        if (!$del) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลที่ต้องการลบ');
        }
        DB::table('showvdo')->where('id', $id)->delete();
        $redirectUrl = route('bank', ['id' => $request->id]);
        return redirect($redirectUrl)->with('success', 'ลบข้อมูลสำเร็จ');
    }


function document_insert(Request $request){
    $request->validate(
        [
            'usa_title'=>'required|max:50',
            'usa_short_title'=>'required'
        ]
        );
        $dir = "uploads/";
        $currentTime = Carbon::now('Asia/Bangkok')->toDateTimeString();

        $data = [
            'usa_title'=>$request->usa_title,
            'usa_detail'=>$request->usa_detail,
            'create_date' => $currentTime,
            'create_by'=>'1',
            'update_date' => $currentTime,
            'update_by'=>'1',
            'active' => 'y'

            // ใส่ข้อมูลที่ต้องการ insert ให้ครบ
        ];

        DB::table('usability')->insert($data);
        // $request->cms_picture->move(public_path('storage/News'),$imageName);
        // return redirect('/document');
        // dd($data);
    }
    function document_delete($usa_id){
        $document_delete=[
            'active'=>'n',
        ];
        DB::table('news')->where('usa_id',$usa_id)->update($document_delete);
        return redirect("/document");
    }
    function document_update(Request $request){
            $currentTime = Carbon::now('Asia/Bangkok')->toDateTimeString(); // รูปแบบเวลาเป็น 'YYYY-MM-DD HH:MM:SS'

            $data = [
                    'usa_title'=>$request->usa_title,
                    'usa_detail'=>$request->usa_detail,
                    'create_date' => $currentTime,
                    'create_by'=>'1',
                    'update_date' => $currentTime,
                    'update_by'=>'1',
                    'active' => 'y'

                // ใส่ข้อมูลที่ต้องการ insert ให้ครบ
            ];
            // dd($data);
            DB::table('usability')->where('usa_id',$usa_id)->update($data);
            // DB::table('news')->where('cms_id',$cms_id)->first($data);
            return redirect('/document');
        }

    function document_edit($usa_id){
        // $news =DB::table('news')->get();
        $usability=DB::table('usability')->where('usa_id',$usa_id)->first();
        // dd($news);
        return view("admin\Document\document-edit",compact('usability'));
    }
    function learnreset_resetuser(){
        $score =DB::table('score')->get();
        // $learnreset =DB::table('score')->get();
        return view("admin\learnreset\learnreset-resetuser",compact('score'));
    }
    function learnreset_resetuser_insert(Request $request){
        $currentTime = Carbon::now('Asia/Bangkok')->toDateTimeString();
        $data = [
            'user_id'=>$request->user_id,
            'lesson_id'=>$request->lesson_id,
            'create_date' => $currentTime,
            'reset_description'=>'resetuser',
            'create_by'=>'1',
            'update_date' => $currentTime,
            'update_by'=>'1',

            // ใส่ข้อมูลที่ต้องการ insert ให้ครบ
        ];

        // DB::table('log_reset1')->insert($data);
        // dd($data);
        $dataupdate = [
            'user_id'=>$request->user_id,
            'score_total'=>'0',
            'score_number'=>'0',
            'update_date' => $currentTime,
            'update_by'=>$request->user_id

            // ใส่ข้อมูลที่ต้องการ insert ให้ครบ
        ];
        DB::table('score')
        ->where('user_id',$request->user_id)
        ->where('lesson_id',$request->lesson_id)
        ->update($dataupdate);
        return redirect('/learnreset_resetuser');
    }
//classroom
    function classroom(){
        $zoom =DB::table('zoom')->get();
        return view("admin\Classroom\Classroom",compact('zoom'));
    }
    function classroom_edit($id){
        $zoom=DB::table('zoom')->where('id',$id)->first();
        return view("admin\Classroom\Classroom-update",compact('zoom'));
    }
        function classroom_delete($id) {
            $classroom_delete = [
                'active' => 'n',
            ];
            DB::table('zoom')->where('id', $id)->update($classroom_delete);
        return redirect()->route('classroom')->with('success', 'Classroom deleted successfully.');
    }
    function classroom_update(Request $request){
        $currentTime = Carbon::now('Asia/Bangkok')->toDateTimeString();;
        $dataupdate = [
            'title'=>$request->title,
            'join_url'=>$request->join_url,
            'start_date'=>$request->start_date,
            'updated_date' => $currentTime,
            'updated_by'=>"1"
        ];
        DB::table('zoom')
        ->where('id',$request->id)
        ->update($dataupdate);
        return redirect()->route('classroom');
    }
        //Captcha
        function captcha_create(){
            return view("admin\captcha\captcha-create");
        }
        function captcha(){
            // อัปเดตเป็นชื่อตารางที่ถูกต้อง 'config_captcha'
            $captcha = Captcha::paginate(10);
            return view("admin\captcha\captcha",compact('captcha'));
        }
        function captcha_edit($capid){
            $captcha = Captcha::get()->where('capid',$capid)->first();
            return view("admin\captcha\captcha-edit",compact('captcha'));
        }
        function captcha_update(Request $request,$capid){
            $currentTime = Carbon::now('Asia/Bangkok')->toDateTimeString();
            $captcha_data=[
                'capt_name'=>$request->capt_name,
                'type'=>$request->type,
                'capt_times'=>$request->capt_times,
                'updated_by'=>'1',
                'updated_date'=>$currentTime               //default
            ];
            $update_captcha = Captcha::where('capid', $capid)->first();
            $update_captcha->fill($captcha_data);
            $update_captcha->save();
            return redirect()->route('captcha');
        }
        function captcha_insert(Request $request){
            $currentTime = Carbon::now('Asia/Bangkok')->toDateTimeString();
            $captcha_data=[
                'capt_name'=>$request->capt_name,
                'type'=>$request->type,
                'capt_times'=>$request->capt_times,
                'capt_time_random'=>'10',
                'capt_time_back'=>'10',
                'capt_wait_time'=>'10',
                'capt_hide'=>'1',
                'capt_active'=>'y',
                'created_by'=>'1',
                'updated_by'=>'1',
                'slide'=>'10',
                'prev_slide'=>'999',
                'domain_id'=>'35',
                'capt_time_random2'=>'2',
                'capt_time_random3'=>'3',
                'created_date'=> $currentTime ,
                'updated_date'=>$currentTime
            ];
            $survey = new Captcha;
            $survey->fill($captcha_data);
            $survey->save();
            return redirect()->route('captcha');
        }
        function captcha_delete(Request $request,$capid) {
            $currentTime = Carbon::now('Asia/Bangkok')->toDateTimeString();
            if ($request->has('capt_active') ) {
                $captcha_delete = [
                    'capt_active' => 'y',
                    'updated_at' => $currentTime,
                    'created_at'=>"1"
                ];
                $captcha_survey = Captcha::where(['capid'=>$request->capid])->first();
                $captcha_survey->fill($Captcha_delete);
                $captcha_survey->save();
                return redirect()->route('captcha');
            }
            else {
                $captcha_delete = [
                    'capt_active' => 'n',
                    'updated_at' => $currentTime,
                    'created_at'=>"1"
                ];
                $captcha_survey  = Captcha::where(['capid'=>$request->capid])->first();
                $captcha_survey->fill($captcha_delete);
                $captcha_survey->save();
                return redirect()->route('captcha');
            }
        } 
}
