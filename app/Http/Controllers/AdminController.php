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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Imagick;
use Spatie\PdfToImage\Pdf;
use Google\Cloud\DocumentAI\V1\Client\DocumentProcessorServiceClient;
use Google\Cloud\DocumentAI\V1\ProcessRequest;
use Google\Cloud\DocumentAI\V1\RawDocument;
use App\Jobs\ProcessPdfJob;
use App\Jobs\ProcessPdfPageJob;
use Illuminate\Support\Facades\Cache;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\File as FileStore;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;

// use Intervention\Image\Facades\Image;
use App\Models\Questionnaireout;
use Carbon\Carbon;
use App\Models\Image;
use App\Models\Course;
use App\Models\Passcourse;
use App\Models\Lesson;
use App\Models\Learn;
use App\Models\News;
use App\Models\Faq;
use App\Models\Faq_type;
use App\Models\Pgroup;
use App\Models\Pgroupcondition;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QuesImport;
use App\Imports\UsersImport;
use App\Imports\QuestionnaireImport;
use App\Exports\LessonsExport;
use App\Exports\UsersExport;
use App\Exports\UsersAdminExport;
use App\Imports\QuesImportEssay;

use App\Models\ASC;
use App\Models\About;
use App\Models\Captcha;
use App\Models\Conditions;
use App\Models\Setting;
use App\Models\Contactus;
use App\Models\Video;
use App\Models\Orgchart;
use App\Models\Orgcourse;
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
use App\Models\Coursegrouptesting;
use App\Models\Manage;
use App\Models\Question;
use App\Models\Logadmin;
use App\Models\Logusers;
use App\Models\Logapprove;
use App\Models\Logapprovepersonal;
use App\Models\Logregister;
use App\Models\Logreset;
use App\Models\Reportproblem;
use App\Models\Coursenotification;
use App\Models\Score;
use App\Models\Choice;
use App\Models\Company;
use App\Models\Division;
use App\Models\QHeader;
use App\Models\QSection;
use App\Models\QQuestion;
use App\Models\QChoice;
use App\Models\Ques_ans;
use App\Models\Zoom;
use App\Models\OrgchartUser;
use App\Models\OcrFile;
use App\Models\OcrFilePage;
use App\Models\Team;


use App\Models\AdminMenu;
use App\Models\CourseScoreWeight;
use App\Models\OperationMachine;
use App\Models\ParameterSetting;
// use App\Models\Company;
// use App\Models\Division;
use App\Models\Permission;
use App\Models\Position;
use App\Models\Profiles;
use App\Models\ProfilesTitle;
use App\Models\Roadmap;
use App\Models\RoadmapCourse;
use App\Models\ScoreAssessment;
use getID3;
// use App\Models\Users;
use App\Helpers\ChildOrgHelper;

use App\Services\RoadmapService;
use Google\LongRunning\Operation;

class AdminController extends Controller
{
    //
    public int $limit = 100;
    function admin(){
        if(AuthFacade::useradmin()){
            return view("admin.index.index");
        }
        return redirect()->route('login.admin');
    }
    function loginadmin(Request $request){
        if ($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => [
                    'required',
                    'min:8', // ต้องมีความยาวอย่างน้อย 8 ตัวอักษร
                ],
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput($request->only('username'));
            }
            // ตรวจสอบความถูกต้องของข้อมูลผู้ใช้งาน
            $credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials)) {
                // Authentication passed

                // เก็บ _token ลงในฐานข้อมูล
                $user = Auth::user();
                $user->_token = $request->session()->get('_token'); // หรือดึงจาก $request->_token ตามที่ถูกต้อง
                $user->save();

                $userAdmin = AuthFacade::useradmin();
                // dd($userAdmin->toArray());

                if($userAdmin){
                    return redirect()->intended('admin');
                }else{
                    return back()->withErrors(['username' => 'ผู้ใช้งานไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง'])->withInput($request->only('username'));
                }
            } else {
                // Authentication failed
                return back()->withErrors(['username' => 'username or password i incorrect']);
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
        if(AuthFacade::useradmin()){
            $about = About::where('active','y')->get();
            return view("admin.aboutus.aboutus",['about'=>$about]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function aboutus_create(Request $request){
        if(AuthFacade::useradmin()){
            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'about_title' => 'nullable|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                    'about_detail' =>'nullable|string'
                ]);

                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
                }

                $about_new = new About;
                $about_new->about_title = $request->input('about_title');
                $about_new->about_detail = htmlspecialchars($request->input('about_detail'));
                $about_new->create_by = Auth::user()->id;
                $about_new->update_by = Auth::user()->id;
                $about_new->active = 'y';
                // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต

                $about_new->save();

                return redirect()->route('aboutus')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');

            }
            return view("admin.aboutus.aboutus_create");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function aboutus_detail($id){
        if(AuthFacade::useradmin()){
            $about_detail = About::where('about_id',$id)->first();
            return view("admin.aboutus.aboutus_detail",['about_detail'=>$about_detail]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function aboutus_update(Request $request, $id) {
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function aboutus_delete($id){
        if(AuthFacade::useradmin()){
            $aboutus_del=[
                'active'=>'n'
            ];
            $aboutus = About::findById($id);
            $aboutus->update($aboutus_del);

            // dd($aboutus->toArray());
            return redirect()->route('aboutus');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function condition(){
        if(AuthFacade::useradmin()){
            $conditions = Conditions::where('active','y')->get();
            return view("admin.condition.condition",['conditions' =>$conditions]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function condition_detail($id){
        if(AuthFacade::useradmin()){
            $conditions = Conditions::where('conditions_id',$id)->first();
            return view("admin.condition.condition_detail",['conditions' =>$conditions]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function condition_update(Request $request, $id) {
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function setting(){
        if(AuthFacade::useradmin()){
            $setting = Setting::first();

            return view("admin.setting.setting",['setting' => $setting]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function setting_update(Request $request, $id){
        if(AuthFacade::useradmin()){
            $setting = Setting::first();
            if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่
                $validator = Validator::make($request->all(), [
                    'email_room' => 'nullable', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                    'pass_email_room' =>'nullable',
                    'settings_user_email' =>'nullable',
                    'settings_pass_email' =>'nullable',
                    'settings_testing' =>'nullable',
                    'settings_register' =>'nullable',
                    'settings_score' => 'nullable',
                    'password_expire_day' =>'nullable'

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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function contactus(){
        if(AuthFacade::useradmin()){
            $contactus= Contactus::where('active','y')->get();

            return view("admin.contactus.contactus",['contactus' => $contactus]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function contactus_view($id){
        if(AuthFacade::useradmin()){
            $contactus= Contactus::where('contac_id',$id)->first();

            return view("admin.contactus.Contactus_view",['contactus' => $contactus]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function contactus_create(){
        if(AuthFacade::useradmin()){
            $contactus_create= DB::table('contactus')->get();
            return view("admin.contactus.Contactus_create",compact('contactus_create'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function contactus_insert(Request $request){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function contactus_edit_page(Request $request,$id){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function contactus_edit(Request $request,$id){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function contactus_delete($id){
        if(AuthFacade::useradmin()){
            $contactus_delete=[
                'active'=>'n',
            ];
            DB::table('contactus')->where('contac_id',$id)->update($contactus_delete);
            return redirect("/contactus");
        }else{
            return redirect()->route('login.admin');
        }
    }
    // new p
    function video_create(){
        if(AuthFacade::useradmin()){
            return view("admin.video.video-create");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function video(){
        if(AuthFacade::useradmin()){
            $vdo =Video::where('active','y')->OrderBy('vdo_id','desc')->get();
            return view("admin.video.video",compact('vdo'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function video_detail($vdo_id){
        if(AuthFacade::useradmin()){
            $vdo = Video::where('vdo_id',$vdo_id)->first();

            return view("admin.video.video_detail",['vdo'=> $vdo]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function video_insert(Request $request){
        if(AuthFacade::useradmin()){
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
            return redirect()->route('video')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function video_edit($vdo_id){
        if(AuthFacade::useradmin()){
            $vdo =DB::table('vdo')->where('vdo_id',$vdo_id)->first();
            return view("admin.video.Video-edit",compact('vdo'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function video_update(Request $request,$vdo_id){
        if(AuthFacade::useradmin()){
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
            return redirect()->route('video')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function video_delete($vdo_id){
        if(AuthFacade::useradmin()){
            $vdo_delete=[
                'active'=>'n'
            ];
            DB::table('vdo')->where('vdo_id',$vdo_id)->update($vdo_delete);
            return redirect()->route('video')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
        }else{
            return redirect()->route('login.admin');
        }
    }
    //
    public function document(Request $request)
    {
        if (AuthFacade::useradmin()) {
            // ดึงข้อมูล Document ที่มีสถานะ active และเรียงลำดับจากใหม่ไปเก่า
            $document = DownloadFileDoc::where('active', 'y')->orderBy('filedoc_id', 'DESC')->get();

            // ดึงข้อมูลประเภทเอกสาร (Downloadcategoty)
            $document_categories = Downloadcategoty::where('active', 'y')->get();

            // ดึงข้อมูลหัวข้อเอกสาร (Downloadtitle)
            $document_title = Downloadtitle::where('active', 'y')->get();

            // ส่งข้อมูลไปยัง view
            return view("admin.document.document", [
                'document' => $document,
                'document_categories' => $document_categories,
                'document_title' => $document_title
            ]);
        } else {
            return redirect()->route('login.admin');
        }
    }

    function document_create(Request $request){
        if(AuthFacade::useradmin()){
            $document_title = Downloadtitle::where('active','y')->get();
            $document_type = Downloadcategoty::where('active','y')->get();
            if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่
                $document_cate = Downloadcategoty::where('download_id',$request->input('download_cate'))->first();
                if(!$document_cate){
                    return back()->with('error');
                }
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
                if($request->file('filedoc')){
                    $doc = $request->file('filedoc');
                    $docname = $doc->getClientOriginalName();
                    $document->filedocname = $docname;

                    $tmp = explode('.', $docname);
                    $fileExtension = end($tmp);

                    if (strtolower($fileExtension) !== 'pdf' && strtolower($fileExtension) !== 'zip' ) {
                        // คำสั่งสำหรับการแจ้งเตือนว่าไฟล์ที่อัปโหลดไม่ใช่ PDF
                        return back()->with('error', 'กรุณาเลือกไฟล์ที่มีนามสกุล .pdf เท่านั้น');
                    }else{
                        $idFolder = public_path('images/uploads/filedoc/');
                        $doc->move($idFolder, $docname);
                    }
                    $document->save();
                }
                // dd($document->toArray());
                $document->save();

                return redirect()->route('document')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            }
            return view("admin.document.document_create",['document_type' => $document_type,'document_title' => $document_title]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function getDocumentTypes(Request $request, $titleId)
    {
        if($titleId){
            $documentTypes = Downloadcategoty::where('title_id', $titleId)->where('active', 'y')->get();

            if ($documentTypes->isEmpty()) {
                return response()->json(['error' => 'No document types found for the provided titleId'], 404);
            }
            return response()->json($documentTypes);
        }
        // Assuming 'download_id' is the foreign key linking document types to titles
        return response()->json(['error' => 'No titleId provided'], 400);
    }
    function document_edit($id,Request $request){
        if(AuthFacade::useradmin()){
            $document = DownloadFileDoc::where('filedoc_id',$id)->first();
            $document_file = DownloadFile::where('file_id',$document->file_id)->first();
            if($document_file){
                $document_type = Downloadcategoty::where('download_id',$document_file->download_id)->first();
            }else{
                $document_type = null ;
            }
            $document_cate = Downloadcategoty::where('active','y')->get();
            if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่

                $document = DownloadFileDoc::findById($id);
                $document->filedoc_name = $request->input('filedoc_name');

                $document_file = DownloadFile::findById($document->file_id);
                $document_file->download_id = $request->input('download_cate');
                $document_file->save();
                // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต
                if($request->file('filedoc')){
                    $doc = $request->file('filedoc');
                    $docname = $doc->getClientOriginalName();
                    $document->filedocname = $docname;

                    $tmp = explode('.', $docname);
                    $fileExtension = end($tmp);

                    // $fileExtension = $request->file('filedoc')->extension();

                    if (strtolower($fileExtension) !== 'pdf' && strtolower($fileExtension) !== 'zip') {
                        // คำสั่งสำหรับการแจ้งเตือนว่าไฟล์ที่อัปโหลดไม่ใช่ PDF
                        return back()->with('error', 'กรุณาเลือกไฟล์ที่มีนามสกุล .pdf เท่านั้น');
                    }else{
                        $idFolder = public_path('images/uploads/filedoc/');
                        $doc->move($idFolder, $docname);
                    }
                    $document->save();
                }
                // dd($document->toArray());
                $document->save();
                return redirect()->route('document')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            }
            return view("admin.document.document_edit",['document' =>$document,'document_type' =>$document_type,'document_cate' =>$document_cate]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function document_detail($id){
        if(AuthFacade::useradmin()){
            $document = DownloadFileDoc::where('filedoc_id',$id)->first();

            $type = DownloadFile::join('download_categoty','download_categoty.download_id','=','download_file.download_id')->where('file_id',$document->file_id)->first();

            return view("admin.document.document_detail",['document' =>$document,'type' => $type]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function document_downloadfile($id,Request $request){
            // Retrieve the file information from the database
            $file = DownloadFileDoc::where('filedoc_id',$id)->first();
            $doc_name = $file->filedocname;
            // Check if the file exists
            // dd($file->toArray());
            // Construct the full file path
            $file_path = public_path('images/uploads/filedoc/'.$doc_name);


            // Check if the file actually exists on the server
            if (file_exists($file_path)) {
                return response()->download($file_path, $doc_name);
            } else {
                echo "<script>alert('ไม่พบไฟล์'); window.location.href = '/document';</script>";
            }
    }
    function document_delete($id){
        if(AuthFacade::useradmin()){
            $document_del=[
                'active'=>'n'
            ];
            $document = DownloadFileDoc::findById($id);
            $document->update($document_del);
            return redirect()->route('document');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function document_head(Request $request){
        if(AuthFacade::useradmin()){
            $document_head = Downloadtitle::where('active','y')->get();
            return view("admin.document.document_head",['document_head' =>$document_head]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function document_head_edit(Request $request,$id){
        if(AuthFacade::useradmin()){
            $document_head = Downloadtitle::where('title_id',$id)->first();
            if ($request->isMethod('post')) { // ตรวจสอบว่าเป็นการร้องขอ POST หรือไม่

                $document_type = Downloadtitle::findById($id);
                $document_type->title_name = $request->input('title_name');
                // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต

                $document_type->save();

                return redirect()->route('document.head')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            }
            return view("admin.document.document_head_edit",['document_head' =>$document_head]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function document_head_del($id){
        if(AuthFacade::useradmin()){
            $document_del=[
                'active'=>'n'
            ];
            $document_type = Downloadtitle::findById($id);
            $document_type->update($document_del);
            return redirect()->route('document.head');
        }else{
            return redirect()->route('login.admin');
        }
    }

    function document_type(Request $request){
        if(AuthFacade::useradmin()){
            $document_type = Downloadcategoty::where('active','y')->get();
            return view("admin.document.document_type",['document_type' =>$document_type]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function document_type_detail($id){
        if(AuthFacade::useradmin()){
            $document_type = Downloadcategoty::where('download_id',$id)->first();

            return view("admin.document.document_type_detail",['document_type' =>$document_type]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function document_type_edit(Request $request,$id){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function document_type_create(Request $request){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }

    function document_type_delete($id){
        if(AuthFacade::useradmin()){
            $document_del=[
                'active'=>'n'
            ];
            $document_type = Downloadcategoty::findById($id);
            $document_type->update($document_del);
            return redirect()->route('document.type');
        }else{
            return redirect()->route('login.admin');
        }
    }
    //new p
    function news_create(Request $request){
        if(AuthFacade::useradmin()){
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
                $news_create->expired_date = $request->input('cms_expire');
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

                    $idFolder = public_path('images/uploads/news/'.$news_create->cms_id);
                    if (!FileStore::isDirectory($idFolder)) {
                        FileStore::makeDirectory($idFolder,0777,true,true);

                        $idFolder2 = public_path('images/uploads/news/'.$news_create->cms_id.'/original/');
                        if (!FileStore::isDirectory($idFolder2)) {
                            FileStore::makeDirectory($idFolder2,0777,true,true);
                        }
                    }

                    // ย้ายไฟล์ภาพไปยังโฟลเดอร์ใหม
                    $image->move($idFolder2, $imageName);


                }
                return redirect()->route('news')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            }
            return view("admin.news.news-create");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function news_edit (Request $request,$id){
        if(AuthFacade::useradmin()){
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
                $news_update->expired_date = $request->input('cms_expire');
                if($request->file('image')){
                    $image = $request->file('image');
                    // dd($image);
                    $idFolder = public_path('images/uploads/news/'.$id);
                    if (!FileStore::isDirectory($idFolder)) {
                        FileStore::makeDirectory($idFolder, 0777, true, true);
                    }

                    $idFolder2 = public_path('images/uploads/news/'.$id.'/original/');
                    if (!FileStore::isDirectory($idFolder2)) {
                        FileStore::makeDirectory($idFolder2,0777, true, true);
                    }
                    // ย้ายไฟล์ภาพไปยังโฟลเดอร์ใหม่
                    $imageName = $image->getClientOriginalName();
                    $image->move($idFolder2, $imageName);

                    $news_update->cms_picture = $imageName;

                }
                // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต

                $news_update->save();

                return redirect()->route('news')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            }
            return view("admin.news.News-edit",['news' => $news]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function news(){
        if(AuthFacade::useradmin()){
            $news = News::where('active','y')->get();
            return view("admin.news.news",['news' => $news]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function news_detail($id){
        if(AuthFacade::useradmin()){
            $news = News::where('cms_id',$id)->first();
            return view("admin.news.news_detail",['news' => $news]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function news_delete($id){
        if(AuthFacade::useradmin()){
            $news_del=[
                'active'=>'n'
            ];
            $news = News::findById($id);
            $news->update($news_del);

            // dd($news->toArray());
            return redirect()->route('news');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function category(){
        if(AuthFacade::useradmin()){
            $category_on = Category::where('category.active', 'y')
            ->when(auth()->user()->superuser == 0 ,function($query){
                return $query->where('create_by',auth()->user()->id);
            })
            ->orderBy('cate_id', 'desc')
            ->get();

            return view("admin.category.category",compact('category_on'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function category_delete($id){
        if(AuthFacade::useradmin()){
            $category_del=[
                'active'=>'n'
            ];
            $category = Category::findById($id);
            $category->update($category_del);
            return redirect()->route('category');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function category_create(Request $request){
        if(AuthFacade::useradmin()){
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

                $category_create = new Category;
                $category_create->cate_title = '1';
                $category_create->cate_title = $request->input('cate_title');
                $category_create->cate_short_detail = $request->input('cate_short_detail');
                $category_create->cate_detail = htmlspecialchars($request->input('cate_detail'));
                $category_create->create_by = Auth::user()->id;
                $category_create->update_by = Auth::user()->id;
                $category_create->cate_show = '1';
                $category_create->active = 'y';
                $category_create->save();
                // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต

                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . '_' . $image->getClientOriginalName(); // ตั้งชื่อไฟล์ใหม่ป้องกันซ้ำ
                    $idFolder = public_path('images/uploads/category/' . $category_create->cate_id . '/original');

                    if (!file_exists($idFolder)) {
                        mkdir($idFolder, 0775, true); // ใช้ recursive และกำหนด permission
                    }

                    $image->move($idFolder, $imageName); // ย้ายไฟล์ไปโฟลเดอร์

                    // อัปเดตชื่อไฟล์ภาพลงฐานข้อมูล
                    $category_create->cate_image = $imageName;
                    $category_create->save();
                }

                return redirect()->route('category')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            }
            return view("admin.category.category_create");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function category_detail($id){
        if(AuthFacade::useradmin()){
            $category = Category::where('cate_id',$id)->first();

            return view("admin.category.category_detail",compact('category'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function category_edit(Request $request, $id)
    {
        if (AuthFacade::useradmin()) {
            $category = Category::where('cate_id', $id)->first();

            if ($request->isMethod('post')) {
                $validator = Validator::make($request->all(), [
                    'cate_title' => 'required|string',
                    'cate_short_detail' => 'required|string',
                    'cate_detail' => 'required|string',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $category_update = Category::where('cate_id', $id)->first();
                $category_update->cate_title = $request->input('cate_title');
                $category_update->cate_short_detail = $request->input('cate_short_detail');
                $category_update->cate_detail = htmlspecialchars($request->input('cate_detail'));
                $category_update->update_by = Auth::user()->id;

                if ($request->hasFile('image')) {
                    $image = $request->file('image');

                    $idFolder = public_path('images/uploads/category/'.$id);
                    $idFolder2 = public_path('images/uploads/category/'.$id.'/original');

                    if (!file_exists($idFolder)) {
                        mkdir($idFolder, 0775, true);
                    }
                    if (!file_exists($idFolder2)) {
                        mkdir($idFolder2, 0775, true);
                    }

                    $imageName = time().'_'.$image->getClientOriginalName();
                    $image->move($idFolder2, $imageName);

                    $category_update->cate_image = $imageName;
                }

                $category_update->save();

                return redirect()->route('category')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            }

            return view('admin.category.category_edit', compact('category'));
        }

        return redirect()->route('login.admin');
    }
    function category_openshow(Request $request,$id){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }

    function courseonline(){
        if(AuthFacade::useradmin()){
            $course_online = Course::with('category')
                ->where('active', 'y')
                // ถ้าไม่ใช่ superuser (เป็น 0) ให้เพิ่มเงื่อนไขกรองตาม id ผู้สร้าง
                ->when(auth()->user()->superuser == 0, function ($query) {
                    return $query->where('create_by', auth()->id());
                })
                ->orderBy('sortOrder', 'desc')
                ->get();
            return view("admin.courseonline.courseonline", compact('course_online'));
        }else{
            return redirect()->route('login.admin');
        }
    }

    function courseonline_delete($id){
        if(AuthFacade::useradmin()){
            $courseonline_del=[
                'active'=>'n'
            ];
            $courseonline = Course::findById($id);
            $courseonline->update($courseonline_del);
            return redirect()->route('courseonline');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function courseonline_detail($id){
        if(AuthFacade::useradmin()){
            $course_online = Course::join('category', 'category.cate_id', '=', 'course_online.cate_id')->where('course_online.course_id',$id)->first();
            return view("admin.courseonline.courseonline_detail", compact('course_online'));
        }else{
            return redirect()->route('login.admin');
        }
    }

    function courseonline_edit(Request $request, $id)
    {
        if(AuthFacade::useradmin()){
            $course_detail = Course::with(['courseWeight'])->where('course_id', $id)->first();
            $category = DB::table('category')->pluck('cate_title', 'cate_id');
            $teacher = Teacher::where('active','y')->get();
            $licenseOperation = OperationMachine::where('active','y')->get();
            $licenseParameter = ParameterSetting::where('active','y')->get();
            // 2. แยก Logic การหา Selected IDs
            if ($course_detail->is_onboarding) {
                // --- กรณีเป็นพนักงานใหม่ (Onboarding) ---
                // ไปดึง line_id จากตาราง roadmaps มาเป็นตัว Selected
                $selectedIds = DB::table('roadmap_course')
                    ->join('roadmap', 'roadmap_course.roadmap_id', '=', 'roadmap.id')
                    ->where('roadmap_course.course_id', $course_detail->course_id)
                    ->pluck('roadmap.line_id')
                    ->map(fn($id) => (string)$id)
                    ->toArray();
            } else {
                // --- กรณีพนักงานทั่วไป (Normal) ---
                // ใช้ท่าเดิมที่น้องเคยใช้ ดึงจาก orgcourse
                $selectedIds = $course_detail->orgcourse->pluck('id')->map(fn($id) => (string)$id)->toArray();
            }
            $targetIds = $this->getMergeOrg();
            $orgtree = Orgchart::whereIn('id', $targetIds)
            ->where('active', 'y')
            ->get()->map(function ($item) use ($selectedIds) {
                return [
                    'id'     => (string)$item->id,
                    // Logic: ถ้าไอเทมนี้อยู่ Level 2 ให้มันเป็น "ตัวแม่สูงสุด" ของ Tree นี้
                    // เราจึงต้องส่ง parent เป็น '#' ให้ jstree
                    'parent' => ($item->level === '2') ? '#' : (string)$item->parent_id,
                    'text'   => $item->title, // ชื่อแผนก/ไลน์/ตำแหน่ง
                    'state'  => [
                        'opened' => false, // ให้พับไว้ก่อน ถ้าอยากให้กางหมดค่อยแก้เป็น true
                        'selected' => in_array((string)$item->id, $selectedIds)
                    ],
                    'icon' => 'fa fa-user text-success'
                ];
            });
            if ($request->isMethod('post')) {
                // dd($request->toArray());
                $validator = Validator::make($request->all(), [
                    'cate_id' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                    'course_title' =>'required|string',
                    'course_short_title'=>'required|string',
                    'course_detail'=>'required|string',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'org_ids' => 'required',
                    'retest_amount' => 'required|integer',

                ]);
                // dd($validator);
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
                }

                $course_update = Course::findById($id);
                $course_update->cate_id = $request->input('cate_id');
                $course_update->course_lecturer = $request->input('teacher_name');
                $course_update->course_title = $request->input('course_title');
                $course_update->course_short_title = htmlspecialchars($request->input('course_short_title'));
                $course_update->course_detail = htmlspecialchars($request->input('course_detail'));
                $course_update->course_retest_amount = $request->input('retest_amount');
                $course_update->course_note = $request->input('course_note');
                $course_update->update_by = Auth::user()->id;
                $course_update->active = 'y';
                $course_update->department_org_id = Auth::user()->department_org_id;
                $course_update->is_onboarding = $request->boolean('onboarding');

                if($request->has('op_mac_id')){
                    $course_update->op_mac_id = $request->input('op_mac_id');
                }

                if($request->has('par_st_id')){
                    $course_update->par_st_id = $request->input('par_st_id');
                }

                if($request->has('start_date')){
                    $course_update->start_date = $request->input('start_date');
                }

                if($request->has('end_date')){
                    $course_update->end_date = $request->input('end_date');
                }

                if($request->file('image')){
                    $image = $request->file('image');

                    $idFolder = public_path('images/uploads/courseonline/'.$course_update->course_id.'/original/');
                    if (!FileStore::isDirectory($idFolder)) {
                        FileStore::makeDirectory($idFolder, 0775, true, true);
                    }

                    Log::info('Uploading image...');

                    $imageName = time().'_'.$image->getClientOriginalName();
                    Log::info('Image name: '.$imageName);

                    $destination = public_path('images/uploads/courseonline/'.$id.'/original/');
                    Log::info('Destination: '.$destination);

                    $success = $image->move($destination, $imageName);
                    if ($success) {
                        Log::info('Image uploaded successfully.');
                    } else {
                        Log::error('Image upload failed.');
                    }

                    $course_update->course_picture = $imageName;
                }
                // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต

                $course_update->save();

                if($request->boolean('onboarding') && $request->has('milestone')){
                    $oldRoadmapCourse = DB::table('roadmap_course')
                        ->where('course_id', $course_update->course_id)
                        ->first();
                    $firstLeafId = collect(explode(',', $request->input('org_ids')))->first();

                    $lineId = Orgchart::with('line')->find($firstLeafId);

                    if ($lineId) {
                    // 3. หาหรือสร้าง Roadmap (ท่า save() แบบที่ต้องการ)
                    $roadmap = Roadmap::where('line_id', $lineId->parent_id)
                                    ->first();

                    DB::beginTransaction();
                    try{
                        if (!$roadmap) {
                        $roadmap = new Roadmap();
                        $roadmap->name = $lineId->line->title . ' Roadmap';
                        $roadmap->org_id = Auth::user()->org_id;
                        $roadmap->line_id = $lineId->parent_id;
                        $roadmap->active = 'y';
                        $roadmap->created_by = Auth::user()->id;
                        $roadmap->updated_by = Auth::user()->id;
                        $roadmap->department_org_id = Auth::user()->department_org_id;
                        $roadmap->save();
                        }

                        if ($oldRoadmapCourse && $oldRoadmapCourse->roadmap_id != $roadmap->id) {
                            // ถ้าบ้านใหม่คนละหลังกับบ้านเก่า ให้ลบชื่อออกจากบ้านเก่าซะ
                            DB::table('roadmap_course')
                                ->where('course_id', $course_update->course_id)
                                ->where('roadmap_id', $oldRoadmapCourse->roadmap_id)
                                ->delete();
                        }
                    // -

                        $lastOrder = RoadmapCourse::where('roadmap_id', $roadmap->id)->max('order');
                        DB::table('roadmap_course')->updateOrInsert(
                            [
                                'roadmap_id' => $roadmap->id,
                                'course_id'  => $course_update->course_id,
                            ],
                            [
                                'order'         => $lastOrder ? $lastOrder + 1 : 1,
                                'active'         => 'y',
                                'milestone_days' => $request->input('milestone'),
                            ]
                        );
                        DB::commit();
                    }catch (\Exception $e) {
                        DB::rollBack();
                        return back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
                    }

                }

                }else{
                    if ($request->filled('org_ids')){
                        $course_update->orgcourse()->sync(collect(explode(',',$request->input('org_ids')))
                        ->mapWithKeys(fn($id, $index) => [
                            $id => ['active' =>'y','order' => $index + 1]
                            ])
                        );
                    }
                }

                $scoreWeight = CourseScoreWeight::where('course_id',$course_update->course_id)->first();
                $scoreWeight->q_a_weight = $request->w_q_and_a;
                $scoreWeight->operate_weight = $request->w_operate;
                $scoreWeight->observe_weight = $request->w_observe;
                $scoreWeight->exam_weight = $request->w_exam;
                $scoreWeight->assign_weight = $request->w_assign;

                $scoreWeight->eval_knowledge = $request->has('eval_knowledge') ? true : false;
                $scoreWeight->eval_skill     = $request->has('eval_skill') ? true : false;
                $scoreWeight->eval_attitude  = $request->has('eval_attitude') ? true : false;
                $scoreWeight->eval_problem_solv = $request->has('eval_problem_solv') ? true : false;
                $scoreWeight->eval_awareness = $request->has('eval_awareness') ? true : false;

                $scoreWeight->save();

                return redirect()->route('courseonline')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            }
            return view("admin.courseonline.courseonline_edit", compact('course_detail', 'category','teacher','orgtree','licenseOperation','licenseParameter'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function courseonline_create(Request $request)
    {
        if(AuthFacade::useradmin()){
            $category = DB::table('category')->where('active','y')->pluck('cate_title', 'cate_id');
            $teacher = Teacher::where('active','y')->where('department_org_id',auth()->user()->department_org_id)->get();
            $licenseOperation = OperationMachine::where('active','y')->get();
            $licenseParameter = ParameterSetting::where('active','y')->get();
            // 3. รวม ID ทั้งหมด (สาขา + แผนก + ลูกหลานทุกชั้น)
            $targetIds = $this->getMergeOrg();

            // 4. Query ครั้งเดียวจบ
            $orgtree = Orgchart::whereIn('id', $targetIds)
            ->where('active', 'y')
            ->get()->map(function ($item){
                return [
                    'id'     => (string)$item->id,
                    // Logic: ถ้าไอเทมนี้อยู่ Level 2 ให้มันเป็น "ตัวแม่สูงสุด" ของ Tree นี้
                    // เราจึงต้องส่ง parent เป็น '#' ให้ jstree
                    'parent' => ($item->level === '2') ? '#' : (string)$item->parent_id,
                    'text'   => $item->title, // ชื่อแผนก/ไลน์/ตำแหน่ง
                    'state'  => [
                        'opened' => false // ให้พับไว้ก่อน ถ้าอยากให้กางหมดค่อยแก้เป็น true
                    ],
                    'icon' => 'fa fa-user text-success'
                ];
            });

            if ($request->isMethod('post')) {

                // dd($request->toArray());
                $validator = Validator::make($request->all(), [
                    'cate_id' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                    'course_title' =>'required|string',
                    'course_short_title'=>'required|string',
                    'course_detail'=>'required|string',
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'retest_amount' => 'required|integer',

                ]);
                $teacher = Teacher::where('teacher_name',$request->input('teacher_name'))->first();

                // dd($validator);
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
                }

                $course_update = new Course;
                $course_update->cate_id = $request->input('cate_id');
                $course_update->course_lecturer = $request->input('teacher_name');
                $course_update->course_title = $request->input('course_title');
                $course_update->course_short_title = htmlspecialchars($request->input('course_short_title'));
                $course_update->course_note = $request->input('course_note');
                $course_update->course_detail = htmlspecialchars($request->input('course_detail'));
                $course_update->course_retest_amount = $request->input('retest_amount');
                $course_update->update_by = Auth::user()->id;
                $course_update->create_by = Auth::user()->id;
                $course_update->active = 'y';
                $course_update->department_org_id = Auth::user()->department_org_id;
                $course_update->is_onboarding = $request->boolean('onboarding');

                if($request->has('op_mac_id')){
                    $course_update->op_mac_id = $request->input('op_mac_id');
                }

                if($request->has('par_st_id')){
                    $course_update->par_st_id = $request->input('par_st_id');
                }

                if($request->has('start_date')){
                    $course_update->start_date = $request->input('start_date');
                }

                if($request->has('end_date')){
                    $course_update->end_date = $request->input('end_date');
                }

                $course_update->save();

                if($request->file('image')){
                    $image = $request->file('image');
                    $imageName = $image->getClientOriginalName();
                    $course_update->course_picture = $imageName;

                    $idFolder = public_path('images/uploads/courseonline/'.$course_update->course_id.'/original/');
                    if (!FileStore::isDirectory($idFolder)) {
                        FileStore::makeDirectory($idFolder, 0775, true, true);
                    }

                    // ย้ายไฟล์ภาพไปยังโฟลเดอร์ใหม่

                    $image->move($idFolder, $imageName);

                }
                $course_update->sortOrder = $course_update->course_id;
                $course_update->save();

                if($request->boolean('onboarding') && $request->has('milestone')){
                    $firstLeafId = collect(explode(',', $request->input('org_ids')))->first();

                    $lineId = Orgchart::with('line')->find($firstLeafId);

                    if ($lineId) {
                    // 3. หาหรือสร้าง Roadmap (ท่า save() แบบที่ต้องการ)
                    $roadmap = Roadmap::where('line_id', $lineId->parent_id)
                                    ->first();

                    DB::beginTransaction();
                    try{
                        if (!$roadmap) {
                        $roadmap = new Roadmap();
                        $roadmap->name = $lineId->line->title . ' Roadmap';
                        $roadmap->org_id = Auth::user()->org_id;
                        $roadmap->line_id = $lineId->parent_id;
                        $roadmap->active = 'y';
                        $roadmap->created_by = Auth::user()->id;
                        $roadmap->updated_by = Auth::user()->id;
                        $roadmap->department_org_id = Auth::user()->department_org_id;
                        $roadmap->save();
                        }

                        // 4. บันทึกลง roadmap_course (เช็คซ้ำก่อนเซฟ)
                        $exists = DB::table('roadmap_course')
                                    ->where('roadmap_id', $roadmap->id)
                                    ->where('course_id', $course_update->course_id)
                                    ->exists();

                        if (!$exists) {
                            $lastOrder = RoadmapCourse::where('roadmap_id', $roadmap->id)->max('order');
                            $roadmapCourse = new RoadmapCourse();
                            $roadmapCourse->roadmap_id = $roadmap->id;
                            $roadmapCourse->course_id = $course_update->course_id;
                            $roadmapCourse->active = 'y';
                            $roadmapCourse->milestone_days = $request->input('milestone');
                            $roadmapCourse->order = $lastOrder ? $lastOrder + 1 : 1;
                            $roadmapCourse->save();
                        }
                        DB::commit();
                    }catch (\Exception $e) {
                        DB::rollBack();
                        return back()->with('error', 'เกิดข้อผิดพลาด: ' . $e->getMessage());
                    }

                }

                }else{
                    if ($request->filled('org_ids')){
                        $course_update->orgcourse()->sync(collect(explode(',',$request->input('org_ids')))
                        ->mapWithKeys(fn($id, $index) => [
                            $id => ['active' =>'y','order' => $index + 1]
                            ])
                        );
                    }
                }


                $scoreWeight = new CourseScoreWeight;
                $scoreWeight->course_id = $course_update->course_id;
                $scoreWeight->q_a_weight = $request->w_q_and_a;
                $scoreWeight->operate_weight = $request->w_operate;
                $scoreWeight->observe_weight = $request->w_observe;
                $scoreWeight->exam_weight = $request->w_exam;
                $scoreWeight->assign_weight = $request->w_assign;

                $scoreWeight->eval_knowledge = $request->has('eval_knowledge') ? true : false;
                $scoreWeight->eval_skill     = $request->has('eval_skill') ? true : false;
                $scoreWeight->eval_attitude  = $request->has('eval_attitude') ? true : false;
                $scoreWeight->eval_problem_solv = $request->has('eval_problem_solv') ? true : false;
                $scoreWeight->eval_awareness = $request->has('eval_awareness') ? true : false;

                $scoreWeight->save();

                return redirect()->route('courseonline')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            }
            return view("admin.courseonline.courseonline_create", compact('category','teacher','orgtree','licenseOperation','licenseParameter'));
        }else{
            return redirect()->route('login.admin');
        }
    }

    private function getAllChildIds($parentId) {
        $ids = [];
        $children = Orgchart::where('parent_id', $parentId)->pluck('id')->toArray();

        foreach ($children as $childId) {
            $ids[] = (string)$childId;
            // เรียกตัวเองซ้ำเพื่อไปหา "ลูกของลูก" (หลาน/เหลน/โหลน)
            $ids = array_merge($ids, $this->getAllChildIds($childId));
        }
        return $ids;
    }

    private function getMergeOrg() {
        $myDeptId = (string)auth()->user()->department_org_id;
        $myDept   = Orgchart::find($myDeptId);
        $myBranchId = (string)$myDept->parent_id;

        // 2. เรียกใช้ฟังก์ชันหาลูกหลานทั้งหมด (จะลึกถึงเลเวล 10 ก็เก็บหมด)
        $allDescendantIds = $this->getAllChildIds($myDeptId);
        $allMerge = array_unique(array_merge([$myBranchId, $myDeptId], $allDescendantIds));

        return $allMerge;
    }


     function teacher_create(Request $request)
    {
        if(AuthFacade::useradmin()){
            $teacher = Teacher::where('active','y')->get();
            if ($request->isMethod('post')) {
                // dd($request->toArray());
                $validator = Validator::make($request->all(), [
                    'teacher_name' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                    'teacher_detail' =>'nullable',
                    // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

                ]);

                // dd($validator);
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
                }

                $teacher = new Teacher;
                $teacher->teacher_name = $request->input('teacher_name');
                $teacher->teacher_detail = htmlspecialchars($request->input('teacher_detail'));
                $teacher->update_by = auth()->user()->id;
                $teacher->create_by = auth()->user()->id;
                $teacher->active = 'y';
                $teacher->department_org_id = auth()->user()->department_org_id;
                $teacher->save();
                // if($request->file('image')){
                //     $image = $request->file('image');
                //     $imageName = $image->getClientOriginalName();
                //     $teacher->teacher_picture = $imageName;

                //     $idFolder = public_path('images/uploads/teacher/'.$teacher->teacher_id);
                //     if (!file_exists($idFolder)) {
                //         mkdir($idFolder, 0777, true);
                //     }

                //     $idFolder2 = $idFolder . '/thumb/';
                //     if (!file_exists($idFolder2)) {
                //         mkdir($idFolder2, 0777, true);
                //     }

                //     // ย้ายไฟล์ภาพไปยังโฟลเดอร์ thumb
                //     $image->move($idFolder2, $imageName);
                // }
                $teacher->save();

                return redirect()->route('courseonline')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            }
            return view("admin.courseonline.teacher_create",compact('teacher'));
        }else{
            return redirect()->route('login.admin');
        }
    }

     function teacher_edit(Request $request, $id)
    {
        if(AuthFacade::useradmin()){
            $teacher = Teacher::findById($id);
            if ($request->isMethod('post')) {
                // dd($request->toArray());
                $validator = Validator::make($request->all(), [
                    'teacher_name' => 'nullable', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                    'teacher_detail' =>'nullable',
                    // 'image' => 'nullable'

                ]);
                // dd($validator);
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
                }

                $teacher = Teacher::findById($id);
                $teacher->teacher_name = $request->input('teacher_name');
                $teacher->teacher_detail = htmlspecialchars($request->input('teacher_detail'));
                $teacher->update_by = auth()->user()->id;
                $teacher->create_by = auth()->user()->id;
                $teacher->department_org_id = auth()->user()->department_org_id;
                // if($request->file('image')){
                //     $image = $request->file('image');
                //     $imageName = $image->getClientOriginalName();
                //     $teacher->teacher_picture = $imageName;

                //     $idFolder = public_path('images/uploads/teacher/'.$teacher->teacher_id);
                //     if (!file_exists($idFolder)) {
                //         mkdir($idFolder, 0777, true);
                //     }

                //     $idFolder2 = $idFolder . '/thumb/';
                //     if (!file_exists($idFolder2)) {
                //         mkdir($idFolder2, 0777, true);
                //     }

                //     // ย้ายไฟล์ภาพไปยังโฟลเดอร์ thumb
                //     $image->move($idFolder2, $imageName);
                // }
                $teacher->save();

                return redirect()->route('teacher.create')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            }
            return view("admin.courseonline.teacher_edit", compact('teacher'));
        }else{
            return redirect()->route('login.admin');
        }
    }

    function teacher_delete($id){
        if(AuthFacade::useradmin()){
            $teacher_del=[
                'active'=>'n'
            ];
            $teacher = Teacher::findById($id);
            $teacher->update($teacher_del);
            return redirect()->route('teacher.create');
        }else{
            return redirect()->route('login.admin');
        }
    }

    function courseonlinecreateto(Request $request)
    {
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    // course edit
    function courseonlineedit(Request $request, $id)
    {
        if(AuthFacade::useradmin()){
            $course_detail = DB::table('course_online')->where('course_id', $id)->first();
            $category = DB::table('category')->pluck('cate_title', 'cate_id');
            return view("admin.courseonline.courseonline-edit", compact('course_detail', 'category'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    // course edit to
    function courseonlineeditto(Request $request, $id)
    {
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    // course change to id
    function courseonlinechange($id)
    {
        if(AuthFacade::useradmin()){
            $course_detail = DB::table('course_online')->where('course_id', $id)->first();
            // ตรวจสอบค่าปัจจุบันของ 'active' และกำหนดค่าใหม่
            $newActive = ($course_detail->active == 'y') ? 'n' : 'y';
            $data = [
                'active' => $newActive,
            ];
            DB::table('course_online')->where('course_id', $id)->update($data);
            $redirectUrl = route('courseonline');
            return redirect($redirectUrl);
        }else{
            return redirect()->route('login.admin');
        }
    }
     // course det show
     function courseonlinedet(Request $request, $id)
     {
        if(AuthFacade::useradmin()){

        }else{
            return redirect()->route('login.admin');
        }
     }
    function lesson(){
        if(AuthFacade::useradmin()){
            $lesson = Lesson::where('lesson.active', 'y')
            ->when(auth()->user()->superuser == 0 ,function($query){
                return $query->where('lesson.create_by',auth()->user()->id);
            })
            ->orderBy('id','DESC')
            ->get();
            return view("admin.lesson.lesson",compact('lesson'));
        }else{
            return redirect()->route('login.admin');
        }
    }

    function lesson_detail($id){
        if(AuthFacade::useradmin()){
            $lesson = Lesson::join('course_online','course_online.course_id','=','lesson.course_id')->where('lesson.id',$id)->first();
            $file = File::where('lesson_id',$id)->where('active','y')->first();
            $filedoc = FileDoc::where('lesson_id',$id)->where('active','y')->first();

            return view("admin.lesson.lesson_detail",compact('lesson','file','filedoc'));
        }else{
            return redirect()->route('login.admin');
        }
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
        if(AuthFacade::useradmin()){
            $lesson_del=[
                'active'=>'n'
            ];
            $lesson = Lesson::findById($id);
            $lesson->update($lesson_del);
            return redirect()->route('lesson');
        }else{
            return redirect()->route('login.admin');
        }
    }

    function lesson_delete_video($id){
        if(AuthFacade::useradmin()){
            $file_del=[
                'active'=>'n'
            ];
            $file = File::findById($id);
            $file->update($file_del);
            return redirect()->route('lesson');
        }else{
            return redirect()->route('login.admin');
        }
    }

    function lesson_edit(Request $request,$id){
        if(AuthFacade::useradmin()){
            $course_online = Course::where('course_online.active', 'y')->orderBy('course_id', 'desc')->get();
            $lesson = Lesson::join('course_online','course_online.course_id','=','lesson.course_id')->where('lesson.id',$id)->first();
            $file = File::where('lesson_id',$id)->where('active','y')->first();
            $filedoc = FileDoc::where('lesson_id',$id)->where('active','y')->first();

            if ($request->isMethod('post')) {
                // dd($request->all());

                $validator = Validator::make($request->all(), [
                    'course_id' => 'nullable', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                    'title' =>'nullable',
                    'course_short_title' =>'nullable',
                    'view_all' =>'nullable',
                    'cate_amount'=>'nullable',
                    'time_test'=>'nullable',
                    'content'=>'nullable',
                    // 'filename.*' => 'nullable|mimes:mp3,mp4',
                    'doc.*' => 'nullable|mimes:pdf',//docx,pptx (ล็อคไว้ก่อน)
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif'

                ]);

                if ($validator->fails()) {
                    //dd($validator->errors()->all());
                    return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
                }

                $lesson_update = Lesson::findById($id);
                $lesson_update->course_id = $request->input('course_id');
                $lesson_update->title = $request->input('title');
                $lesson_update->description = htmlspecialchars($request->input('course_short_title'));
                $lesson_update->content = htmlspecialchars($request->input('content'));
                $lesson_update->view_all = $request->input('view_all');
                $lesson_update->cate_amount = $request->input('cate_amount');
                $lesson_update->time_test = $request->input('time_test');
                $lesson_update->create_by = auth()->user()->id;
                $lesson_update->update_by = Auth::user()->id;

                // if ($request->has('view_all')) {
                //     $lesson_update->view_all = "y";
                // }else{
                //     $lesson_update->view_all = "n";
                // }

                if ($request->has('uploaded_files')) {
                    $tempPath = public_path("temp_upload/");
                    if (!FileStore::isDirectory($tempPath)) {
                        FileStore::makeDirectory($tempPath, 0777, true, true);
                    }

                    $realPath = public_path("images/uploads/lesson/");
                    if (!FileStore::isDirectory($realPath)) {
                        FileStore::makeDirectory($realPath, 0777, true, true);
                    }

                    foreach ($request->uploaded_files as $fileData) {
                        [$fileName, $duration] = explode('|', $fileData);

                        $sourceFile = $tempPath . $fileName; // พิกัดไฟล์ในโฟลเดอร์ temp
                        $destinationFile = $realPath . $fileName; // พิกัดที่จะย้ายไปอยู่จริง

                        // เพิ่มจุดนี้: ตรวจสอบว่ามีไฟล์ตัวเป็นๆ รออยู่ใน temp ไหม ค่อยสั่งย้าย
                        if (file_exists($sourceFile)) {
                            rename($sourceFile, $destinationFile); // ย้ายไฟล์ในเสี้ยววินาที (0.001 วินาที)
                        }
                        File::create([
                            'lesson_id' => $lesson_update->id,
                            'file_name' => $lesson_update->title,
                            'filename'  => $fileName,
                            'length'    => '2.00',
                            'create_by' => Auth::id(),
                            'update_by' => Auth::id(),
                            'active'    => 'y',
                            'views'     => 0,
                            'duration'  => (int)$duration,
                        ]);
                    }
                }

                // if ($request->hasFile('filename')) {
                //     $getID3 = new getID3;
                //     foreach ($request->file('filename') as $file) {
                //         $Folder_file = public_path("images/uploads/lesson/");
                //         $fileName = time() . "_" . $file->getClientOriginalName();

                //         $fileInfo = $getID3->analyze($file->getRealPath());
                //         $duration = isset($fileInfo['playtime_seconds']) ? floor($fileInfo['playtime_seconds']) : 0;
                //         $file->move($Folder_file, $fileName);

                //         // 🔹 บันทึกลง Database
                //         File::create([
                //             'lesson_id' => $id,
                //             'file_name' => $lesson->title,
                //             'filename' => $fileName,
                //             'length' => '2.00',
                //             'create_by' => Auth::id(),
                //             'update_by' => Auth::id(),
                //             'active' => 'y',
                //             'views' => 0,
                //             'duration' => $duration
                //         ]);
                //     }
                // }

                if($request->hasFile('doc')){
                    $doc = $request->file('doc');
                    $doc_name = $doc->getClientOriginalName();
                    // dd($doc_name);
                    if(!$doc_name){
                        return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $doc_update = FileDoc::where('lesson_id',$id)->first();
                    // dd($doc_update->toArray());
                    if($doc_update == null){
                        $doc_new = new FileDoc;
                        $doc_new->file_position = 1;
                        $doc_new->file_name = $lesson->title;
                        $doc_new->filename = $doc_name;
                        $doc_new->length = '2.00';
                        $doc_new->create_by = Auth::user()->id;
                        $doc_new->update_by = Auth::user()->id;
                        $doc_new->active = 'y';
                        $doc_new->save();

                        $idFolder = public_path('images/uploads/filedoc/');
                        if (!FileStore::isDirectory($idFolder)) {
                            FileStore::makeDirectory($idFolder, 0777, true,true);
                        }
                        $doc->move($idFolder, $doc_name);
                    }else{
                        $doc_update->file_position = 1;
                        $doc_update->filename = $doc_name;
                        $doc_update->update_by = Auth::user()->id;
                        $doc_update->save();

                        $idFolder = public_path('images/uploads/filedoc/');
                        if (!FileStore::isDirectory($idFolder)) {
                            FileStore::makeDirectory($idFolder, 0777, true,true);
                        }
                        $doc->move($idFolder, $doc_name);
                    }
                }

                if($request->file('image')){
                    $image = $request->file('image');

                    $idFolder2 = public_path('images/uploads/lesson/'.$id.'/original/');
                    if (!FileStore::isDirectory($idFolder2)) {
                            FileStore::makeDirectory($idFolder2, 0777, true,true);
                        }

                    // ย้ายไฟล์ภาพไปยังโฟลเดอร์ใหม่
                    $imageName = $image->getClientOriginalName();
                    $image->move($idFolder2, $imageName);

                    $lesson_update->image = $imageName;

                }
                // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต

                $lesson_update->save();

                return redirect()->route('lesson')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            }

            return view("admin.lesson.lesson_edit",compact('course_online','lesson','file','filedoc'));
        }else{
            return redirect()->route('login.admin');
        }
    }

    public function lesson_create(Request $request)
    {
        if (!Auth::check() || !AuthFacade::useradmin()) {
            return redirect()->route('login.admin');
        }

        $course_online = Course::where('course_online.active', 'y')->orderBy('course_id', 'desc')->get();

        if ($request->isMethod('post')) {
            // ✅ ตรวจสอบข้อมูลที่ส่งมา

            $validator = Validator::make($request->all(), [
                'course_id' => 'required',
                'title' => 'required|string',
                'description' => 'required|string',
                'content' => 'required',
                // 'filename.*' => 'nullable|mimes:mp3,mp4',
                'doc.*' => 'nullable|mimes:pdf',//docx,pptx (ล็อคไว้ก่อน)
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif'
            ]);

            if ($validator->fails()) {
                Log::error('Validation failed: ', $validator->errors()->toArray());
                return redirect()->back()->withErrors($validator)->withInput();
            }
            DB::beginTransaction();
            try{
                $lesson_create = new Lesson();
                $lesson_create->course_id = $request->course_id;
                $lesson_create->title = $request->title;
                $lesson_create->content = htmlspecialchars($request->content);
                $lesson_create->description = $request->description;

                $lesson_create->view_all = $request->view_all;
                $lesson_create->cate_amount = $request->cate_amount;
                $lesson_create->time_test = $request->time_test;
                $lesson_create->create_by = auth()->user()->id;
                $lesson_create->update_by = Auth::id();
                $lesson_create->active = 'y';
                $lesson_create->save();

                // 📂 **จัดการการสร้างโฟลเดอร์**
                $lessonFolder = public_path("images/uploads/lesson/".$lesson_create->id);
                if (!FileStore::isDirectory($lessonFolder)) {
                    FileStore::makeDirectory($lessonFolder, 0777, true,true);
                }
                $Folder = public_path("images/uploads/lesson/{$lesson_create->id}");
                $originalFolder = "{$Folder}/original";
                $filedocFolder = public_path("images/uploads/filedoc/");

                foreach ([$originalFolder, $filedocFolder] as $folder) {
                    if (!FileStore::isDirectory($folder)) {
                        FileStore::makeDirectory($folder, 0777, true,true);
                    }
                }

                if ($request->has('uploaded_files')) {
                    $tempPath = public_path("temp_upload/");
                    $realPath = public_path("images/uploads/lesson/");
                    foreach ($request->uploaded_files as $fileData) {
                        [$fileName, $duration] = explode('|', $fileData);

                        $sourceFile = $tempPath . $fileName; // พิกัดไฟล์ในโฟลเดอร์ temp
                        $destinationFile = $realPath . $fileName; // พิกัดที่จะย้ายไปอยู่จริง

                        // เพิ่มจุดนี้: ตรวจสอบว่ามีไฟล์ตัวเป็นๆ รออยู่ใน temp ไหม ค่อยสั่งย้าย
                        if (file_exists($sourceFile)) {
                            rename($sourceFile, $destinationFile); // ย้ายไฟล์ในเสี้ยววินาที (0.001 วินาที)
                        }
                        File::create([
                            'lesson_id' => $lesson_create->id,
                            'file_name' => $lesson_create->title,
                            'filename'  => $fileName,
                            'length'    => '2.00',
                            'create_by' => Auth::id(),
                            'update_by' => Auth::id(),
                            'active'    => 'y',
                            'views'     => 0,
                            'duration'  => (int)$duration,
                        ]);
                    }
                }
                // 📌 **อัปโหลดไฟล์ mp3/mp4**
                // if ($request->hasFile('filename')) {

                //     $getID3 = new getID3;
                //     foreach ($request->file('filename') as $file) {
                //         $Folder_file = public_path("images/uploads/lesson/");
                //         $fileName = time() . "_" . $file->getClientOriginalName();

                //         $fileInfo = $getID3->analyze($file->getRealPath());
                //         $duration = isset($fileInfo['playtime_seconds']) ? floor($fileInfo['playtime_seconds']) : 0;
                //         $file->move($Folder_file, $fileName);

                //         // 🔹 บันทึกลง Database
                //         File::create([
                //             'lesson_id' => $lesson_create->id,
                //             'file_name' => $lesson_create->title,
                //             'filename' => $fileName,
                //             'length' => '2.00',
                //             'create_by' => Auth::id(),
                //             'update_by' => Auth::id(),
                //             'active' => 'y',
                //             'views' => 0,
                //             'duration' => $duration,
                //         ]);
                //     }
                // }

                // 📌 **อัปโหลดไฟล์เอกสาร**
                if ($request->hasFile('doc')) {
                    foreach ($request->file('doc') as $doc) {
                        $Folder_doc = public_path("images/uploads/filedoc/");
                        $docName = time() . "_" . $doc->getClientOriginalName();
                        $doc->move($Folder_doc, $docName);

                        // 🔹 บันทึกลง Database
                        FileDoc::create([
                            'lesson_id' => $lesson_create->id,
                            'file_name' => $lesson_create->title,
                            'filename' => $docName,
                            'length' => '2.00',
                            'create_by' => Auth::id(),
                            'update_by' => Auth::id(),
                            'active' => 'y'
                        ]);
                    }
                }

                // 📌 **อัปโหลดภาพประกอบ**
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $Folder_pic = public_path("images/uploads/lesson/".$lesson_create->id."/original");
                    $imageName = time() . "." . $image->getClientOriginalExtension();
                    if (!FileStore::isDirectory($Folder_pic)) {
                        FileStore::makeDirectory($Folder_pic, 0777, true,true);
                    }

                    $image->move($Folder_pic, $imageName);

                    $lesson_create->image = $imageName;
                    $lesson_create->save();
                }

                // 🔥 **ตั้งค่าการเรียงลำดับ**s
                $lesson_create->sort_lesson = $lesson_create->id;
                $lesson_create->save();

                DB::commit();
            }catch (\Exception $e){
                DB::rollBack();

                Log::error($e->getMessage());
                return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล');
            }


            return redirect()->route('lesson')->with('success', 'อัปโหลดข้อมูลเรียบร้อยแล้ว!');
        }
        return view("admin.lesson.lesson_create", compact('course_online'));
    }

    function filemanagers(Request $request, $id = null){
        if(AuthFacade::useradmin()){
            if($id !== null){
                $file = File::where('lesson_id', $id)->where('active', 'y')->orderBy('file_position', 'ASC')->get();
            } else {
                $file = File::where('active', 'y')->get();
            }
            return view("admin.file_managers.file_managers", ['file' => $file,'id' => $id]);
        }else{
            return redirect()->route('login.admin');
        }
    }

    public function sort(Request $request)
    {
        // ตรวจสอบว่า order มีก่อนหรือไม่
        if (empty($request->order)) {
            return response()->json(['success' => false, 'message' => 'No order data provided.']);
        }

        // ใช้ transaction เพื่อความปลอดภัย
        DB::beginTransaction();

        try {
            // อัปเดตการจัดเรียงในฐานข้อมูล
            foreach ($request->order as $item) {
                // ตรวจสอบว่า id และ position มีอยู่ในแต่ละรายการหรือไม่
                if (isset($item['id'], $item['position'])) {
                    File::where('id', $item['id'])->update(['file_position' => $item['position']]);
                }
            }

            // คอมมิทการทำงานหากทุกอย่างไม่มีข้อผิดพลาด
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // ย้อนกลับหากเกิดข้อผิดพลาด
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update file positions.', 'error' => $e->getMessage()]);
        }
    }

    function file_edit(Request $request, $id){
        if(AuthFacade::useradmin()){
            if($id !== null){
                $file = File::where('lesson_id', $id)->where('active', 'y')->orderBy('file_position', 'ASC')->get();
            } else {
                $file = File::where('active', 'y')->get();
            }
            return view("admin.file_managers.file_managers", ['file' => $file]);
        }else{
            return redirect()->route('login.admin');
        }
    }

    function file_delete($id){
        if(AuthFacade::useradmin()){
            $file_del=[
                'active'=>'n'
            ];
            $file = File::findById($id);
            $file->update($file_del);
            return redirect()->route('filemanagers',['id' => $id]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    //new p
    function grouptesting_create(Request $request){
        if(AuthFacade::useradmin()){
             $usedCourseIds = Grouptesting::where('active', 'y')
                ->pluck('course_id')
                ->toArray();

            $lesson = Course::where('active', 'y')
                ->whereNotIn('course_id', $usedCourseIds)
                ->get();

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
                $grouptesting_create->course_id = $request->input('lesson_id');
                $grouptesting_create->group_title = $request->input('group_title');
                $grouptesting_create->step_id = '1';
                $grouptesting_create->create_by = Auth::user()->id;
                $grouptesting_create->update_by = Auth::user()->id;
                $grouptesting_create->active = 'y';
                $grouptesting_create->save();

                return redirect()->route('grouptesting')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            }


            return view("admin.grouptesting.grouptesting-create",['lesson' => $lesson]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function grouptesting(Request $request, $id = null, $type = null){
        if(AuthFacade::useradmin()){
            $id = $request->query('id');
            $type = $request->query('type');
            if($id !== null && $type !== null ){
                $grouptesting = Grouptesting::whereIn('active', ['y', 'w'])->where('create_by',auth()->user()->id)->orderBy('create_date','DESC')->get();

            } else {
                $grouptesting = Grouptesting::whereIn('active', ['y', 'w'])->where('create_by',auth()->user()->id)->orderBy('create_date','DESC')->get();
            }

            return view("admin.grouptesting.grouptesting",['grouptesting' => $grouptesting]);
        }else{
            return redirect()->route('login.admin');
        }
    }

    function grouptesting_plan(Request $request, $id = null, $type = null){
        if(AuthFacade::useradmin()){
            $group = Grouptesting::where('lesson_id',$id)->where('active','w')->get();

            $group_active = Grouptesting::join('lesson', 'lesson.id', '=', 'grouptesting.lesson_id')
                ->join('manage', 'manage.group_id', '=', 'grouptesting.group_id')
                ->where('grouptesting.active', 'y')
                ->where('lesson.id', $id)
                ->where('manage.type', $type)
                ->where('manage.active', 'y')
                ->select('grouptesting.*', 'manage.*', 'lesson.title as title')
                ->get();


            if ($request->has('id') && !empty($request->id)) {
                $group_id = $request->input('id');
                $group_del = ['active' => 'y'];
                $group = Grouptesting::findById($group_id);

                if (!$group) {
                    return response()->json(['success' => false, 'error' => 'ไม่พบข้อมูล group']);
                }

                $group->update($group_del);

                $manage = Manage::where('group_id', $group_id)->where('type', $type)->first();

                if ($manage == null) {
                    $manage = new Manage;
                    $manage->id = $group->lesson_id;
                    $manage->group_id = $group->group_id;
                    $manage->type = $type;
                    $manage->manage_row = '5';
                    $manage->create_by = Auth::user()->id;
                    $manage->update_by = Auth::user()->id;
                    $manage->active = 'y';
                    $manage->save();
                } else {
                    $manage->active = 'y';
                    $manage->save();
                }

                return response()->json(['success' => true, 'manage' => $manage]);
            }
            return view("admin.grouptesting.grouptesting_plan",['group' => $group,'group_active' => $group_active,'type'=>$type,'id' => $id]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    //
    function grouptesting_plan_delete($id) {
        if (AuthFacade::useradmin()) {
            $manage = Manage::findById($id);

            if ($manage) {
                $manage->update(['active' => 'n']);

                $grouptesting = Grouptesting::findById($manage->group_id);
                if ($grouptesting) {
                    $grouptesting->update(['active' => 'w']);
                }
            }
            Log::info($manage);
            return back();
        } else {
            return redirect()->route('login.admin');
        }
    }

    function grouptesting_edit(Request $request, $id){
        if(AuthFacade::useradmin()){
            $group = Grouptesting::where('group_id',$id)->first();
            $lesson = Course::where('active','y')->get();
            if ($request->isMethod('post')) {
                // dd($request->toArray());
                $validator = Validator::make($request->all(), [
                    'group_title' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                ]);

                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
                }

                $group_update = Grouptesting::findById($id);
                $group_update->group_title = $request->input('group_title');
                $group_update->course_id = $request->input('lesson_id');
                $group_update->update_by = Auth::user()->id;

                // เพิ่มข้อมูลอื่น ๆ ที่ต้องการอัปเดต

                $group_update->save();

                return redirect()->route('grouptesting')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            }

            return view("admin.grouptesting.grouptesting-edit",['lesson' => $lesson,'group' => $group ]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function grouptesting_detail($id){
        if(AuthFacade::useradmin()){
            $group = Grouptesting::with('course')
                    ->where('group_id', $id)
                    ->first();

            return view("admin.grouptesting.grouptesting_detail",['group' => $group ]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function grouptesting_delete($id){
        if(AuthFacade::useradmin()){
            $grouptesting_del=[
                'active'=>'n'
            ];
            $grouptesting = Grouptesting::findById($id);
            $grouptesting->update($grouptesting_del);

            $manage = Manage::where('id',$grouptesting->lesson_id)->first();
            if($manage){
                $manage_del=[
                'active'=>'n'
                ];
                $manage->update($manage_del);
            }

            return redirect()->route('grouptesting');
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function group_question_create(Request $request,$id = null){
        if(AuthFacade::useradmin()){
            if(request()->has('Question')) {
                // dd($_POST['Question']);
                // dd(request()->input('QuestionType'));
                // dd(request()->input('QuestionType'));
                foreach(request('Question') as $ques => $question) {
                    // dump($question);
                    $key = 1;
                    $questionTypeArray = ['checkbox' => 1, 'radio' => 2, 'textarea' => 3];
                    // $questionTitle = $question;
                    $questionType = null;
                    $questionTypeArray = request()->input('QuestionType');
                    if ($questionTypeArray && isset($questionTypeArray[$key])) {
                        $questionType = $questionTypeArray[$key];
                        // dd($questionType);
                    }
                    $question_title = $question[$key];
                    if ($question_title && isset($question[$key])) {
                        // dd($question_title);
                        $question_title = $question[$key];
                    }
                    $questionModel = new Question();
                    $questionModel->group_id = $id;
                    $questionModel->ques_type = $questionType;
                    $questionModel->ques_title = $question_title;
                    $questionModel->ques_explain = '';
                    $questionModel->create_by = Auth::user()->id;
                    $questionModel->update_by = Auth::user()->id;
                    $questionModel->active = 'y';

                    if ($questionModel->save()) {
                        if($questionType != 'textarea') {
                            $choicesss =request('Choice');
                            $choices = $choicesss['choice_detail'];
                            $choiceTypes = $choicesss['choice_type'];
                            $choiceAnswers = $choicesss['choice_answer'];
                            // dd($choicesss);
                            // dd($choicesss['choice_answer']);
                            if (is_array($choices) && is_array($choiceTypes) && is_array($choiceAnswers)) {
                                foreach ($choices as $key => $choiceDetails) {
                                    // dd($choiceDetails);
                                    // ตรวจสอบว่าข้อมูลในอาร์เรย์ $choiceDetails เป็นอาร์เรย์หรือไม่ก่อนที่จะวนลูป
                                    if (is_array($choiceDetails)) {
                                        // dd($choiceDetails);
                                        foreach ($choiceDetails as $index => $choiceDetail) {

                                            // สร้างและบันทึกข้อมูลตัวเลือก (Choice)
                                            $choiceModel = new Choice();
                                            $choiceModel->ques_id = $questionModel->ques_id;
                                            $choiceModel->choice_detail = $choiceDetail;
                                            $choiceModel->choice_type = $choiceTypes[$key][$index];
                                            $choiceModel->choice_answer = $choiceTypes[$key][$index];
                                            $choiceModel->create_by = Auth::user()->id;
                                            $choiceModel->update_by = Auth::user()->id;
                                            $choiceModel->save();
                                        }
                                    }
                                }
                            }
                        }
                    }else{
                        $errors = $questionModel->errors();
                        // แสดงข้อผิดพลาด
                        dd($errors);
                    }
                }
                return redirect()->route('grouptesting');
            }

            return view("admin.grouptesting.group_question_create",['id' => $id]);
        }else{
            return redirect()->route('login.admin');
        }
    }

    function group_question($id = null){
        if(AuthFacade::useradmin()){
            if($id !== null){
                $coursegrouptesting = Question::with(['correctChoices'])
                    ->when($id !== null, function ($query) use ($id) {
                        return $query->where('group_id', $id);
                    })
                    ->where('active', 'y')
                    ->orderBy('create_date', 'DESC')
                    ->get();
                // dd($coursegrouptesting);
            }else{
                $coursegrouptesting = Question::where('active','y')->orderBy('create_date','DESC')->get();
            }
            return view("admin.grouptesting.group_question",['coursegrouptesting' =>$coursegrouptesting]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function group_question_detail($id){
        if(AuthFacade::useradmin()){
            $group = Question::with(['images'])->where('ques_id',$id)->first();
            $choice = Choice::where('ques_id',$group->ques_id)
                        ->where('active','y')
                        ->get();

            return view("admin.grouptesting.ques_detail",['group' => $group,'choice' => $choice ]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function group_question_edit(Request $request,$id){
        if(AuthFacade::useradmin()){
            $group = Question::with(['images'])->where('ques_id',$id)->first();
            if($request->isMethod('post')){
                $validator = Validator::make($request->all(), [
                    'ques_title' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                ]);

                $ques = Question::findById($id);
                $ques->ques_title = htmlspecialchars($request->input('ques_title'));
                $ques->save();

                return redirect()->route('group_question');
            }

            return view("admin.grouptesting.ques_edit",['group' => $group,'id' => $id ]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function group_question_delete($id){
        if(AuthFacade::useradmin()){
            $ques_del=[
                'active'=>'n'
            ];
            $ques = Question::findById($id);
            $ques->update($ques_del);

            return redirect()->route('grouptesting');
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function group_question_excel(Request $request,$id){
        if (!AuthFacade::useradmin()) {
            return redirect()->route('login.admin');
        }

        $group = Grouptesting::where('group_id', $id)->first();


        if ($request->isMethod('post')) {

            $request->validate([
                'import_excel' => 'required|file|mimes:xlsx,xls,docx'
            ], [
                'import_excel.required' => 'คุณยังไม่ได้ Upload file',
                'import_excel.mimes'    => 'รองรับเฉพาะ xlsx, xls, docx',
                'import_type'  => 'required'
            ]);

            $file = $request->file('import_excel');
            $extension = $file->getClientOriginalExtension();
            $type = $request->input('import_type');

            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $drawings = $sheet->getDrawingCollection();

            \Log::info('STEP 1: DRAWINGS COUNT', [
                'count' => count($drawings)
            ]);

            $imagesByRow = [];

            $fileExt = $file->getClientOriginalExtension();

            foreach ($drawings as $drawing) {

                $coordinates = $drawing->getCoordinates();

                if (!preg_match('/([A-Z]+)(\d+)/', $coordinates, $matches)) {
                    continue;
                }

                $excelRow = (int)$matches[2];

                if ($drawing instanceof \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing) {

                    ob_start();
                    call_user_func(
                        $drawing->getRenderingFunction(),
                        $drawing->getImageResource()
                    );
                    $imageContents = ob_get_clean();

                } elseif ($drawing instanceof \PhpOffice\PhpSpreadsheet\Worksheet\Drawing) {

                    $path = $drawing->getPath();

                    $imageContents = @file_get_contents($path);

                    if (!$imageContents) continue;

                } else {
                    continue;
                }

                $imageExt = 'png';

                $fileName = 'images/uploads/' . uniqid('q_') . '.' . $imageExt;

                Storage::disk('public')->put($fileName, $imageContents);

                \Log::info('STEP 2: IMAGE MAP', [
                    'row' => $excelRow,
                    'file' => $fileName
                ]);

                $imagesByRow[$excelRow][] = $fileName;
            }


            try {

                // 🔥 Excel
                if (in_array($extension, ['xlsx', 'xls'])) {

                 if ($type === 'essay') {
                    Excel::import(new QuesImportEssay($id, $imagesByRow), $file);
                }

                if ($type === 'choice') {
                    Excel::import(new QuesImport($id), $file);
                }


                }


                return redirect()->route('grouptesting')
                    ->with('success', 'Import สำเร็จ');

            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        }

        return view("admin.grouptesting.ques_excel", ['group' => $group]);
    }

    public function questions_create($id)
    {
        $group = Grouptesting::where('group_id', $id)->first();

        if (!$group) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูล group');
        }

        return view('admin.grouptesting.create_questions', [
            'group_id' => $id,
            'group' => $group
        ]);
    }

    public function questions_store(Request $request, $id)
    {
        $request->validate([
            'ques_type' => 'required',
            'ques_title' => 'required',
            'answer'     => 'required_if:ques_type,3',
        ]);

        $userId = auth()->id();

        // สร้าง question
        $question = Question::create([
            'ques_type'   => $request->ques_type,
            'ques_title'  => htmlspecialchars($request->ques_title),
            'answer'      => $request->ques_type == '3'
                        ? htmlspecialchars($request->answer)
                        : null,
            'group_id'    => $id,
            'active'      => 'y',
            'create_date' => Carbon::now(),
            'update_date' => Carbon::now(),
            'create_by'   => $userId,
            'update_by'   => $userId,
        ]);

        // ถ้ามี choices
        if (in_array($request->ques_type, ['1','2']) && $request->choices) {
            foreach ($request->choices as $choice) {
                if (!empty($choice['choice_detail'])) {

                    Choice::create([
                        'ques_id'       => $question->ques_id,
                        'choice_detail' => $choice['choice_detail'],
                        'choice_answer' => isset($choice['is_answer']) ? '1' : '2',
                        'choice_type'   => $request->ques_type,
                        'active'        => 'y',
                        'create_date'   => Carbon::now(),
                        'update_date'   => Carbon::now(),
                        'create_by'     => $userId,
                        'update_by'     => $userId,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'บันทึกสำเร็จ');
    }

    public function questions_edit($id)
    {
        $question = Question::where('ques_id', $id)->first();
        $choices = Choice::where('ques_id', $id)->get();

        return view('admin.grouptesting.edit_question', [
            'question' => $question,
            'choices' => $choices
        ]);
    }

    public function questions_update(Request $request, $id)
    {
        $question = Question::where('ques_id', $id)->first();

        $question->update([
            'ques_type' => $request->ques_type,
            'ques_title' => htmlspecialchars($request->ques_title),
            'answer'     => $request->ques_type == '3'
                        ? htmlspecialchars($request->answer)
                        : null,
            'update_by' => auth()->id(),
        ]);


        Choice::where('ques_id', $id)->delete();


        if (in_array($request->ques_type, ['1','2'])) {
            foreach ($request->choices as $choice) {
                if (!empty($choice['choice_detail'])) {

                    Choice::create([
                        'ques_id'       => $id,
                        'choice_detail' => $choice['choice_detail'],
                        'choice_answer' => isset($choice['is_answer']) ? '1' : '2',
                        'choice_type'   => $request->ques_type,
                        'active'        => 'y',
                        'create_by'     => auth()->id(),
                    ]);
                }
            }
        }

        return redirect()->back()->with('success','อัพเดทสำเร็จ');
    }

    //new p
    function coursegrouptesting_create(Request $request){
        if(AuthFacade::useradmin()){
            $course = Course::where('active','y')->get();

            if ($request->isMethod('post')) {
                // dd($request->toArray());
                $validator = Validator::make($request->all(), [
                    'course_id' => 'required|string', // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                    'group_title' =>'required|string'

                ]);

                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
                }

                $grouptesting_create = new Coursegrouptesting;
                $grouptesting_create->course_id = $request->input('course_id');
                $grouptesting_create->group_title = $request->input('group_title');
                $grouptesting_create->step_id = '1';
                $grouptesting_create->create_by = Auth::user()->id;
                $grouptesting_create->update_by = Auth::user()->id;
                $grouptesting_create->active = 'y';
                $grouptesting_create->lang_id = '1';
                $grouptesting_create->domain_id = '15';
                $grouptesting_create->save();

                return redirect()->route('coursegrouptesting')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            }
            return view("admin.coursegrouptesting.coursegrouptesting-create",['course' => $course]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function coursegrouptesting(Request $request, $id = null){
        if(AuthFacade::useradmin()){
            if($id !== null){
                $coursegrouptesting = Coursegrouptesting::join('course_online','course_online.course_id','=','coursegrouptesting.course_id')->where('group_id',$id)->paginate(10);
            }else{
                $coursegrouptesting = Coursegrouptesting::join('course_online','course_online.course_id','=','coursegrouptesting.course_id')->where('coursegrouptesting.active','y')->paginate(10);
            }
            return view("admin.coursegrouptesting.coursegrouptesting",['coursegrouptesting' =>$coursegrouptesting]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function coursegrouptesting_plan(Request $request, $id = null){
        if(AuthFacade::useradmin()){
            $course_group = Coursegrouptesting::where('course_id',$id)->where('active','n')->get();

            $course_group_active = Coursegrouptesting::join('course_online','course_online.course_id','=','coursegrouptesting.course_id')->where('coursegrouptesting.active','y')->where('coursegrouptesting.course_id',$id)->get();

            if ($request->has('id')) {
                // คืนค่า JSON แจ้งข้อผิดพลาดว่าไม่มีค่า ID ถูกส่งมา
                $group_id = $request->input('id');
                $group_del=[
                    'active'=>'y'
                ];
                $group = Coursegrouptesting::findById($group_id);
                $group->update($group_del);

                // กรณีที่ไม่มีการส่งค่า id มา
                // คุณสามารถตัดสินใจปฏิเสธคำขอหรือดำเนินการอื่น ๆ ตามที่ต้องการได้
                return response()->json(['success' => true]);
            }
            return view("admin.coursegrouptesting.coursegrouptesting_plan",['course_group' => $course_group,'course_group_active' => $course_group_active,'id' => $id]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    //

    //new p
    function questionnaireout(){
        if(AuthFacade::useradmin()){
            $survey_headers = QHeader::where('active','y')->get();
            return view("admin.questionnaireout.questionnaireout",compact('survey_headers'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function questionnaireout_excel(Request $request){
        if(AuthFacade::useradmin()){
            if ($request->isMethod('post')) {
                $request->validate([
                    'import_excel' =>
                    ['required','file','mimes:xlsx, xls'],
                    [
                        'import_excel.required' => 'คุณยังไม่ได้ Uploadfile',
                        'import_excel.mimes' => 'กรุณาใช้ไฟล์สกุล xlsx xls'
                    ]


                ]);

                $excel = Excel::import(new QuestionnaireImport, $request->file('import_excel'));
                // dd($excel);

                // dd($excel);

                // return redirect()->back()->with('success', 'Excel imported successfully!');
                return redirect()->route('questionnaireout');
            }

            return view("admin.questionnaireout.questionnaireout_excel");
        }else{
            return redirect()->route('login.admin');
        }
    }

    function questionnaireout_plan(Request $request, $id){
        if(AuthFacade::useradmin()){
            $lesson_id = Lesson::findById($id);
            $survey_headers = QHeader::where('active','y')->paginate(10);
            if ($request->has('id')) {
                // คืนค่า JSON แจ้งข้อผิดพลาดว่าไม่มีค่า ID ถูกส่งมา
                $lesson_id = $request->input('id');
                $header_id = $request->input('header_id');

                $lesson = Lesson::findById($lesson_id);

                if (!$lesson) {
                    return response()->json(['error' => 'Lesson not found'], 404);
                }

                $lesson->header_id = $header_id;
                $lesson->save();

                return response()->json(['success' => true]);
            }
            return view("admin.questionnaireout.questionnaireout_plan",compact('survey_headers','lesson_id'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function questionnaireout_create(Request $request){
        if(AuthFacade::useradmin()){
            if ($request->isMethod('post')) {
                if ($request->has('sectionTitle') && $request->has('questionType') && $request->has('questionTitle')) {
                    $inputTypeArray = ['input' => 1, 'radio' => 2, 'checkbox' => 3, 'contentment' => 4, 'text' => 5];

                    $headerModel = new QHeader;
                    $headerModel->survey_name = $request->input('surveyHeader');
                    $headerModel->instructions = htmlspecialchars($request->input('surveyHeaderDetail'));
                    $headerModel->active = "y";

                    if ($headerModel->save()) {
                        foreach ($request->input('sectionTitle') as $sectionKey => $sectionValue) {
                            $sectionModel = new QSection;
                            $sectionModel->survey_header_id = $headerModel->survey_header_id;
                            $sectionModel->section_title = $sectionValue;
                            $sectionModel->section_required_yn = "n";

                            if ($sectionModel->save()) {
                                foreach ($request->input('questionType')[$sectionKey] as $questionKey => $questionValue) {
                                    $questionModel = new QQuestion;
                                    $questionModel->survey_section_id = $sectionModel->survey_section_id;
                                    $questionModel->input_type_id = $inputTypeArray[$questionValue];
                                    $questionModel->question_name = $request->input('questionTitle')[$sectionKey][$questionKey];
                                    $questionModel->answer_required_yn = "n";
                                    $questionModel->allow_multiple_option_answers_yn = "n";

                                    if ($questionModel->input_type_id == 4) {
                                        $questionModel->question_range = $request->input('questionRange')[$sectionKey][$questionKey];
                                    }

                                    if ($questionModel->save()) {
                                        if ($questionModel->input_type_id != 5 && $questionModel->input_type_id != 1) {
                                            foreach ($request->input('choiceTitle')[$sectionKey][$questionKey] as $choiceKey => $choiceValue) {
                                                $choiceModel = new QChoice;
                                                $choiceModel->question_id = $questionModel->question_id;
                                                $choiceModel->option_choice_name = $choiceValue;
                                                $choiceModel->option_choice_type = 'normal';

                                                if ($request->input('choiceSpecify')[$sectionKey][$questionKey][$choiceKey] == "y") {
                                                    $choiceModel->option_choice_type = 'specify';
                                                }

                                                $choiceModel->save();
                                            }
                                        } else {
                                            $choiceModel = new QChoice;
                                            $choiceModel->question_id = $questionModel->question_id;

                                            if ($questionModel->input_type_id == 5) {
                                                $choiceModel->option_choice_name = "text";
                                                $choiceModel->option_choice_type = "normal";
                                            } else {
                                                $choiceModel->option_choice_name = "input";
                                                $choiceModel->option_choice_type = "normal";
                                            }

                                            $choiceModel->save();
                                        }
                                    }
                                }
                            }
                        }
                        return redirect()->route('questionnaireout')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
                    }
                }
            }
            return view("admin.questionnaireout.questionnaireout-create");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function questionnaireout_insert(Request $request){
        if(AuthFacade::useradmin()){
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
            $survey = new QHeader;
            $survey->fill($survey_header_data);
            $survey->save();
            return redirect()->route('questionnaireout');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function questionnaireout_edit($survey_header_id){
        if(AuthFacade::useradmin()){
            $survey_headers = QHeader::get()->where('survey_header_id',$survey_header_id)->first();
            return view("admin.questionnaireout.questionnaireout-edit",compact('survey_headers'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function questionnaireout_update(Request $request,$survey_header_id){
        if(AuthFacade::useradmin()){
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
            $update_survey = QHeader::where('survey_header_id', $survey_header_id)->first();
            $update_survey->fill($survey_header_data);
            $update_survey->save();
            return redirect()->route('questionnaireout');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function questionnaireout_delete($survey_header_id){
        if(AuthFacade::useradmin()){
            $questionnaireout_delete=[
                'active'=>'n'
            ];
            $update_survey = QHeader::where('survey_header_id', $survey_header_id)->first();
            $update_survey->fill($questionnaireout_delete);
            $update_survey->save();
            return redirect()->route('questionnaireout');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function questionnaireout_exam($id, Request $request){
        if(AuthFacade::useradmin()){
            $survey_headers = QHeader::where('survey_header_id',$id)->first();
            $survey_section = QSection::where('survey_header_id',$survey_headers->survey_header_id)->first();
            $question = QQuestion::where('survey_section_id',$survey_section->survey_section_id)->get();

            if ($request->isMethod('post')) {
                // dd($request->input('Choice'));
                if($request->input('Choice')){
                    foreach ($request->input('Choice') as $ques_id => $choices) {
                        foreach ($choices as $choice){
                            $ques = QChoice::findById($choice);
                            $ans = new Ques_ans;
                            $ans->user_id = Auth::user()->id;
                            $ans->choice_id = $choice;
                            $ans->quest_ans_id = $ques->question_id;
                            $ans->save();
                        }
                    }
                    if($request->input('ChoiceText')){
                        $option = $request->input('Question_type');
                        foreach($option as $op){
                            $ques = QChoice::findById($op);
                            $ans = new Ques_ans;
                            $ans->user_id = Auth::user()->id;
                            $ans->choice_id = $ques->choice_id;
                            foreach($request->input('ChoiceText') as $answer){
                                $ans->answer_textarea = $answer;
                            }
                            $ans->quest_ans_id = $ques->question_id;
                            $ans->save();
                        }
                    }
                }elseif($request->input('ChoiceText')){
                    $option = $request->input('Question_type');
                    $ques = QChoice::findById($option);
                    $ans = new Ques_ans;
                    $ans->user_id = Auth::user()->id;
                    $ans->answer_textarea = $request->input('ChoiceText');
                    $ans->quest_ans_id = $ques->question_id;
                    $ans->save();
                }
                return redirect()->route('index');
            }
            return view("admin.questionnaireout.questionnaireout_exam",compact('survey_headers','survey_section','question'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    //
    //new p
    function question(){
        if(AuthFacade::useradmin()){
            $question= DB::table('question')
            ->join('grouptesting', 'question.group_id', '=', 'grouptesting.group_id')
            ->select('question.*', 'grouptesting.group_title')
            ->paginate(10);
            return view("admin.Question.Question",compact('question'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function question_create(){
        if(AuthFacade::useradmin()){
            $grouptesting = DB::table('grouptesting')
            ->where('active', 'y')
            ->pluck('group_title', 'group_id');

            $question_create = DB::table('question')
                ->join('grouptesting', 'question.group_id', '=', 'grouptesting.group_id')
                ->select('question.*', 'grouptesting.group_title')
                ->get();
            return view("admin.Question.Question_create",compact('question_create','grouptesting'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function question_insert(Request $request){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function question_edit_page($id){
        if(AuthFacade::useradmin()){
            $grouptesting = DB::table('grouptesting')
            ->where('active', 'y')
            ->pluck('group_title', 'group_id');
            $question_edit_page= DB::table('question')
            ->where('ques_id',$id)
            ->first();
            return view("admin.Question.Question_edit_page",compact('grouptesting','question_edit_page'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function question_edit(Request $request,$id){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function question_delete($id){
        if(AuthFacade::useradmin()){
            $question_delete=[
                'active'=>'n',
            ];
            DB::table('question')->where('ques_id',$id)->update($question_delete);
            return redirect("/question");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function orgchart(){
        if(AuthFacade::useradmin()){
            $orgchart =DB::table('orgchart')->get();
            return view("admin.orgchart.orgchart",compact('orgchart'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function orgchart_ifram(){
        if(AuthFacade::useradmin()){
            $org = Orgchart::where('active','y')->get();
            return view("admin.orgchart.orgchart_ifram",['org' => $org]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function orgchart_users(Request $request, $id)
{
    if (AuthFacade::useradmin()) {
        $org_id = $id;
        $filterUsername = $request->input('filter_username');
        $filterUser = $request->input('filter_user');

        // Base query for users
        $query = Users::where('status', '1');

        // Apply filter if provided
        if ($filterUsername) {
            $query->where('username', 'like', '%' . $filterUsername . '%');
        }

        // Paginate filtered or non-filtered results
        $user = $query->get();

        $querys = Users::where('status', '1')
                        ->where('department_id', $org_id);

        if ($filterUser) {
            $querys->where('username', 'like', '%' . $filterUser . '%');
        }
        // Fetch users in the department for the given org_id
        $user_chart = OrgchartUser::where('orgchart_id',$id)->get();

        return view("admin.orgchart.orgchart_users", [
            'org_id' => $org_id,
            'user' => $user,
            'user_chart' => $user_chart
        ]);
    } else {
        return redirect()->route('login.admin');
    }
}
    function orgchart_unuser(Request $request,$org_id){
        if(AuthFacade::useradmin()){
            if ($request->has('remove_users')) {
                // รับข้อมูลผู้ใช้ที่ถูกเลือกจากฟอร์ม
                $selectedUsers = $request->input('remove_users');

                // ดำเนินการต่อไปตามต้องการ เช่น ลบผู้ใช้ หรือทำการปรับปรุงข้อมูลต่าง ๆ
                foreach ($selectedUsers as $userId) {
                    OrgchartUser::where('user_id', $userId)
                                ->where('orgchart_id', $org_id)
                                ->delete();
                }

                // สามารถทำการ redirect หรือส่งข้อมูลกลับไปยังหน้าอื่นตามต้องการ
                return redirect()->route('orgchart.users',['org_id' => $org_id])->with('success', 'ข้อมูลผู้ใช้ถูกลบเรียบร้อยแล้ว');
            } else {
                // กรณีที่ไม่มีผู้ใช้ถูกเลือก สามารถดำเนินการต่อไปตามต้องการได้
                return redirect()->route('orgchart.users',['org_id' => $org_id])->with('error', 'กรุณาเลือกผู้ใช้ก่อนทำการลบ');
            }
        }else{
            return redirect()->route('login.admin');
        }
    }
    function orgchart_adduser(Request $request,$org_id){
        if (AuthFacade::useradmin()) {
            if ($request->has('add_users')) {
                $selectedUsers = $request->input('add_users');
                $added = 0;
                $skipped = 0;

                foreach ($selectedUsers as $userId) {
                    $created = OrgchartUser::firstOrCreate([
                        'user_id' => $userId,
                        'orgchart_id' => $org_id,
                    ]);

                    // เช็คว่าเป็นการเพิ่มใหม่จริงหรือไม่
                    if ($created->wasRecentlyCreated) {
                        $added++;
                    } else {
                        $skipped++;
                    }
                }

                $message = "เพิ่มผู้ใช้ใหม่จำนวน {$added} คน";
                if ($skipped > 0) {
                    $message .= " (ข้าม {$skipped} คนที่มีอยู่แล้ว)";
                }

                return redirect()->route('orgchart.users', ['org_id' => $org_id])
                                ->with('success', $message);
            } else {
                return redirect()->route('orgchart.users', ['org_id' => $org_id])
                                ->with('error', 'กรุณาเลือกผู้ใช้ก่อนทำการเพิ่ม');
            }
        } else {
            return redirect()->route('login.admin');
        }
    }
    function orgchart_unactive(Request $request,$id,$org_id){
        if(AuthFacade::useradmin()){
            if ($request) {
                // dd($id);
                 OrgchartUser::where('user_id', $id)
                            ->where('orgchart_id', $org_id)
                            ->delete();

                // สามารถทำการ redirect หรือส่งข้อมูลกลับไปยังหน้าอื่นตามต้องการ
                return redirect()->route('orgchart.users',['org_id' => $org_id])->with('success', 'ข้อมูลผู้ใช้ถูกลบเรียบร้อยแล้ว');
            } else {
                // กรณีที่ไม่มีผู้ใช้ถูกเลือก สามารถดำเนินการต่อไปตามต้องการได้
                return redirect()->route('orgchart.users',['org_id' => $org_id])->with('error', 'กรุณาเลือกผู้ใช้ก่อนทำการลบ');
            }
        }else{
            return redirect()->route('login.admin');
        }
    }
    function orgchart_active(Request $request,$id,$org_id){
        if(AuthFacade::useradmin()){
            if ($request) {
                    $chk = OrgchartUser::where('user_id', $id)
                        ->where('orgchart_id', $org_id)
                        ->exists();
                    if(!$chk){
                        $user = new OrgchartUser;
                        $user->user_id = $id;
                        $user->orgchart_id = $org_id;
                        $user->save();

                        return redirect()->route('orgchart.users',['org_id' => $org_id])->with('success', 'ข้อมูลผู้ใช้เพิ่มเสร็จสิ้น');
                    }
                // สามารถทำการ redirect หรือส่งข้อมูลกลับไปยังหน้าอื่นตามต้องการ
                return redirect()->route('orgchart.users',['org_id' => $org_id])->with('warning', 'ข้อมูลผู้ใช้ถูกเพิ่มแล้ว');
            } else {
                // กรณีที่ไม่มีผู้ใช้ถูกเลือก สามารถดำเนินการต่อไปตามต้องการได้
                return redirect()->route('orgchart.users',['org_id' => $org_id])->with('error', 'กรุณาเลือกผู้ใช้ก่อนทำการลบ');
            }
        }else{
            return redirect()->route('login.admin');
        }
    }
    function orgchart_new(Request $request){
        if(AuthFacade::useradmin()){
            if($request->has('post_value') && $request->has('text') ){
                $res = $request->input('post_value');
                $text = $request->input('text');

                $find_id = Orgchart::findById($request->post_value);
                if($find_id){
                    $org = new Orgchart;
                    $org->title = $text;
                    $org->parent_id = $res;
                    $org->level = $find_id->level + 1;
                    $org->active = 'y';
                    $org->save();
                }else{
                    $org = new Orgchart;
                    $org->title = $text;
                    $org->parent_id = '1';
                    $org->level = 2;
                    $org->active = 'y';
                    $org->save();
                }
            }
            return redirect()->route('orgchart');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function orgchart_delete(Request $request){
        if(AuthFacade::useradmin()){
            if($request->has('post_del')){
                $res = $request->input('post_del');

                $find_id = Orgchart::findById($res);
                    $find_id->active = 'n';
                    $find_id->save();

            }
            return redirect()->route('orgchart');
        }else{
            return redirect()->route('login.admin');
        }
    }

    function orgchart_edit(Request $request){
        if(AuthFacade::useradmin()){
            if($request->has('post_edit')){
                $res = $request->input('post_edit');
                $text = $request->input('text');

                $find_id = Orgchart::findById($res);
                $find_id->title = $text;
                $find_id->save();

            }
            return redirect()->route('orgchart');
        }else{
            return redirect()->route('login.admin');
        }
    }

    function orgchart_saveorgchart(Request $request){
        if(AuthFacade::useradmin()){
            $allorg = OrgChart::all();
            $chk_org = array();
            foreach ($allorg as $value) {
                $chk_org[] = $value->id;
            }

            if(isset($_POST['post_value'])){
                $chk_org_new = array();
                foreach($_POST['post_value'] as $value){
                    $chk_org_new[] = $value['id'];
                    $model_org = OrgChart::findById($value['id']);
                    // var_dump($_POST['post_value']);
                    // exit();
                    if($value['id']!=1 && $value['parent_id']==""){
                        $parent_value = 1;
                        $level_value = 2;
                    }else{
                        $parent_value = $value['parent_id'];
                        $level_value = $value['level'];
                    }
                    if($model_org){
                        $model_org->title = $value['key'];
                        $model_org->parent_id = $parent_value;
                        $model_org->level = $level_value;
                        $model_org->save();
                    }else{
                        $model = new OrgChart;
                        $model->title = $value['key'];
                        $model->parent_id = $parent_value;
                        $model->level = $level_value;
                        $model->save();
                    }
                }
            }

            $result_org = array_diff($chk_org,$chk_org_new);

            foreach ($result_org as $value) {
                    $model_orgchart = OrgChart::findById($value);
                    $model_orgchart->active = 'n';
                    $model_orgchart->save();
            }

            return route('orgchart'); // การใช้ $this->render('index') จะถูกแทนที่ด้วย return view('index')
        }else{
            return redirect()->route('login.admin');
        }
    }
    function orgchart_control($id){
        if(AuthFacade::useradmin()){
            // dd($id);
            $org = Orgchart::where('id',$id)->first();

            $course = Course::where('active','y')->get();
            $sub_courses = Orgcourse::where('active', 'y')
            ->where('orgchart_id', $id)
            ->whereNotNull('parent_id') // เป็นคอร์สรอง
            ->get();
            return view("admin.orgchart.orgchart_Control",['org' => $org,'course' => $course,'sub_courses' => $sub_courses]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function orgchart_y(Request $request,$id){
        if(AuthFacade::useradmin()){
            // dd($id);
            if($request->has('id')){
                $id = $request->input('id');
                $org_id = $request->input('org_id');

                $org = new Orgcourse;
                $org->orgchart_id = $org_id;
                $org->course_id = $id;
                $org->parent_id = '0';
                $org->active = 'y';
                $org->save();

                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }
        }else{
            return redirect()->route('login.admin');
        }
    }
    function orgchart_n(Request $request,$id){
        if(AuthFacade::useradmin()){
            // dd($id);
            if($request->has('id')){
                $id = $request->input('id');

                $org = Orgcourse::where('id',$id)->first();
                $org->active = 'n';
                $org->save();

                return response()->json(['success' => true]);
            }else{
                return response()->json(['error' => true]);
            }
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function saveNestedCourses(Request $request)
    {
        $orgchartId = $request->input('orgchart_id');
        $nested = $request->input('nested');

        if (empty($nested)) {
            return response()->json(['error' => 'ไม่มีข้อมูล nested ส่งมา'], 400);
        }

        // แนะนำ: ล้างข้อมูลเก่าก่อนใส่ใหม่
        Orgcourse::where('orgchart_id', $orgchartId)->update(['active' => 'n']);

        foreach ($nested as $row) {
            Orgcourse::updateOrCreate(
                [
                    'orgchart_id' => $orgchartId,
                    'course_id' => $row['course_id']
                ],
                [
                    'parent_id' => $row['parent_id'],
                    'order' => $row['order'],
                    'active' => 'y'
                ]
            );
        }

        return response()->json(['status' => 'success']);
    }
    function orgchart_course(Request $request, $id) {
         if (!AuthFacade::useradmin()) {
        return redirect()->route('login.admin');
        }
    }

    function orgchart_create(){
        if(AuthFacade::useradmin()){
            return view("admin.orgchart.orgchart-create");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function orgchart_insert(Request $request){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }

    function orgchart_update(Request $request,$orgchart_id){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }

    //
    function checklecture(){
        if(AuthFacade::useradmin()){
            return view("admin.checklecture.checklecture");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function coursecheck(){
        if(AuthFacade::useradmin()){
            return view("admin.checklecture.checklecture-coursecheck");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function certificate(){
        if(AuthFacade::useradmin()){
            return view("admin.certificate.certificate");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function signnature(){
        if(AuthFacade::useradmin()){
            return view("admin.signnature.signnature");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function usability(){
        if(AuthFacade::useradmin()){
            $usa = Usability::where('active','y')->get();
            return view("admin.usability.usability",['usa' => $usa]);
        }else{
            return redirect()->route('login.admin');
        }
    }

    function usability_detail($id){
        if(AuthFacade::useradmin()){
            $usa = Usability::where('usa_id',$id)->first();
            return view("admin.usability.usability_detail",['usa' => $usa]);
        }else{
            return redirect()->route('login.admin');
        }
    }

    function usability_edit(Request $request,$id){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }

    function usability_create(Request $request){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function usability_delete($id)
    {
        if (AuthFacade::useradmin()) {
            $usability = Usability::find($id);

            if (!$usability) {
                return response()->json([
                    'success' => false,
                    'message' => 'ไม่พบข้อมูลที่ต้องการลบ'
                ], 404);
            }

            $usability->update(['active' => 'n']);

            return response()->json([
                'success' => true,
                'message' => 'ลบข้อมูลเรียบร้อยแล้ว'
            ]);
        }

        return redirect()->route('login.admin');
    }


    function reportproblem(){
        if(AuthFacade::useradmin()){
            $reportproblem = Reportproblem::get();
            return view("admin.report.reportproblem",['reportproblem' => $reportproblem]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function reportproblem_edit(Request $request,$id){
        if(AuthFacade::useradmin()){
            $reportproblem = Reportproblem::where('id',$id)->first();
            if($request->isMethod('post')){
                $validator = Validator::make($request->all(), [
                    'answer' => 'required|string' // ตัวอย่างกำหนดเงื่อนไขในการตรวจสอบข้อมูล
                ]);

                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
                }

                $report_update = Reportproblem::findById($id);
                $report_update->answer = $request->input('answer');
                $report_update->status = 'success';
                $report_update->accept_report_date = now();
                $report_update->save();

                return redirect()->route('reportproblem')->with('success', 'อัปเดตข้อมูลเรียบร้อยแล้ว');
            }
            return view("admin.report.reportproblem_edit",['reportproblem' => $reportproblem]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function reportproblem_detail($id){
        if(AuthFacade::useradmin()){
            $reportproblem = Reportproblem::where('id',$id)->first();
            return view("admin.report.reportproblem_detail",['reportproblem' => $reportproblem]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function faqtype(){
        if(AuthFacade::useradmin()){
            $faqtype= Faq_type::get();
            return view("admin.faq.faqtype",compact('faqtype'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function faqtype_detail($id){
        if(AuthFacade::useradmin()){
            $faq_type= Faq_type::where('faq_type_id',$id)->first();
            return view("admin.faq.faqtype_detail",['faq_type'=>$faq_type]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function faqtype_create(){
        if(AuthFacade::useradmin()){
            $faqtype_create= Faq_type::get();
            return view("admin.faq.Faqtype_create",compact('faqtype_create'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function faqtype_insert(Request $request){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function faqtype_edit_page($id){
        if(AuthFacade::useradmin()){
            $faqtype_edit_page= Faq_type::where('faq_type_id',$id)
            ->first();
            // dd($faqtype_edit_page);
            return view("admin.faq.Faqtype_edit_page",compact('faqtype_edit_page'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function faqtype_edit(Request $request,$id){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function faqtype_delete($id){
        if(AuthFacade::useradmin()){
            $faqtype_delete=[
                'active'=>'n',
                'update_by' => Auth::user()->id
            ];
            $faq_type = Faq_type::where('faq_type_id',$id);
            $faq_type->update($faqtype_delete);
            return redirect("/faqtype");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function faq(){
        if(AuthFacade::useradmin()){
            $faq= Faq::where('active','y')
            ->get();
            return view("admin.faq.faq",compact('faq'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function faq_detail($id){
        if(AuthFacade::useradmin()){
            $faq= Faq::join('cms_faq_type', 'cms_faq.faq_type_id', '=', 'cms_faq_type.faq_type_id')
            ->where('faq_nid_',$id)
            ->first();
            return view("admin.faq.faq_detail",['faq' => $faq]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function faq_create(){
        if(AuthFacade::useradmin()){
            $faq_types = Faq_type::where('active', 'y')
            ->pluck('faq_type_title_TH', 'faq_type_id');

            $faq_create = Faq::join('cms_faq_type', 'cms_faq.faq_type_id', '=', 'cms_faq_type.faq_type_id')
                ->select('cms_faq.*', 'cms_faq_type.faq_type_title_TH')
                ->get();



            return view("admin.faq.Faq_create", compact('faq_create', 'faq_types'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function faq_insert(Request $request){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function faq_edit_page(Request $request,$id){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function faq_edit(Request $request,$id){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function faq_delete($id){
        if(AuthFacade::useradmin()){
            $faq_delete=[
                'active'=>'n',
            ];
            $faq = Faq::where('faq_nid_',$id);
            $faq->update($faq_delete);
            return redirect("/faq");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function generation(){
        if(AuthFacade::useradmin()){
            $generation= DB::table('org_course')->get();
            return view("admin.Generation.Generation",compact('generation'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function generation_create(){
        if(AuthFacade::useradmin()){
            $generation_create= DB::table('org_course')->get();
            return view("admin.Generation.Generation_create",compact('generation_create'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function generation_insert(Request $request){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function generation_edit_page($id){
        if(AuthFacade::useradmin()){
            $generation_edit_page= DB::table('org_course')
            ->where('id',$id)
            ->first();
            return view("admin.Generation.Generation_edit_page",compact('generation_edit_page'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function generation_edit(Request $request,$id){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function generation_delete($id){
        if(AuthFacade::useradmin()){
            $generation_delete=[
                'active'=>'n',
            ];
            DB::table('org_course')->where('id',$id)->update($generation_delete);
            return redirect("/generation");
        }else{
            return redirect()->route('login.admin');
        }
    }

    //new p
    function adminuser(){
        if(AuthFacade::useradmin()){
            $users = Users::whereNotNull('group_id')
                    ->where('status','1')
                    ->get();
            return view("admin.adminuser.adminuser",compact('users'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function adminuser_permission_add($id){
        if(AuthFacade::useradmin()){
            $user = Profiles::where('user_id',$id)->first();
            $groupRole = Pgroup::where('active','y')->get();
            return view("admin.adminuser.adminuser-permis-add",compact('groupRole','user','id'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function adminuser_permission_insert(Request $request,$id){
        if(AuthFacade::useradmin()){
            $request->validate([
                'group_role' => 'required'
            ]);
            //dd($request);
            $userRole = Users::where('id',$id)->first();
            //dd($userRole);

            $userRole->update([
                'group_id' => $request->group_role,
                'teacher_status' => $request->has('supervisor_permission') ? 1 : 0
            ]);

            $userRole->save();
            return redirect()->route('user_admin')->with('success','บันทึกสำเร็จ');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function adminuser_insert(Request $request){
        if(AuthFacade::useradmin()){
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => [
                    'required',
                    'min:8', // ต้องมีความยาวอย่างน้อย 8 ตัวอักษร
                    function ($attribute, $value, $fail) use ($request) {
                        // ตรวจสอบว่า password ไม่เป็นตัวเลขเดียวกันทั้งหมด
                        if (preg_match('/(\d)\1{7,}/', $value)) {
                            $fail('รหัสผ่านไม่สามารถเป็นตัวเลขเดียวกันซ้ำกันได้');
                        }

                        // ตรวจสอบว่า password มีอักษรพิเศษอย่างน้อย 1 ตัว
                        if (!preg_match('/[^a-zA-Z0-9]/', $value)) {
                            $fail('รหัสผ่านต้องมีอักษรพิเศษอย่างน้อย 1 ตัว');
                        }
                    },
                ],
                'email' => 'required|max:39|email',
            ]);

            // ถ้า validation ไม่ผ่าน กลับไปยังหน้า login form พร้อมแสดง errors
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput($request->only('username'));
            }

            $date=new DateTime('Asia/Bangkok');
            $password = Hash::make($request->password);
            $adminuser_data=[
                'username'=>$request->username,
                'password'=>$password,
                'email'=>$request->email,
                'create_at'=>$date,
                'lastvisit_at'=>$date,
                'last_activity'=>$date,
                'status'=>'1'
            ];
            DB::table('users')->insert($adminuser_data);
            return redirect()->route('adminuser');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function adminuser_edit($id){
        if(AuthFacade::useradmin()){
            $users = DB::table('users')->where('id',$id)->first();
            return view("admin.adminuser.adminuser-edit",compact('users'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function adminuser_update(Request $request,$id){
        if(AuthFacade::useradmin()){
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required | min:8 | confirmed | regex:/^(?=.*[^\w\d]).+$/ | regex:/^(?!(\d)\1{7,}).+$/'
            ]);

            // ถ้า validation ไม่ผ่าน กลับไปยังหน้า login form พร้อมแสดง errors
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput($request->only('password'));
            }

                $date=new DateTime('Asia/Bangkok');
                $password = Hash::make($request->password);
                $adminuser_data=[
                    'username'=>$request->username,
                    'password'=>$password,
                    'email'=>$request->email,
                    'lastvisit_at'=>$date,
                    'last_activity'=>$date,
                    'status'=>'1'
                ];
                DB::table('users')->where('id',$id)->update($adminuser_data);
                return redirect()->route('adminuser');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function adminuser_delete($id){
        if(AuthFacade::useradmin()){
            $adminuser_delete=[
                'status'=>'0'
            ];
            DB::table('users')->where('id',$id)->update($adminuser_delete);
            return redirect()->route('adminuser');
        }else{
            return redirect()->route('login.admin');
        }
    }

    function adminuser_cancle($id){
        if(AuthFacade::useradmin()){
            $adminuser_cancle=[
                'group_id'=> null
            ];
            DB::table('users')->where('id',$id)->update($adminuser_cancle);
            return redirect()->route('adminuser');
        }else{
            return redirect()->route('login.admin');
        }
    }
    //

    // new p
    function pgroup(){

        if(AuthFacade::useradmin()){
            $p_group = Pgroup::where('active','y')->orderBy('id')->get();

            return view("admin.pgroup.pgroup",compact('p_group'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function pgroup_create(){
        if(AuthFacade::useradmin()){
            $menuHead = AdminMenu::whereNull('parent_id')->where('active','y')->get();
            // $menuList = AdminMenu::whereNotNull('parent_id')->get();
            // dd($menuHead);
            return view("admin.pgroup.pgroup-create",compact('menuHead'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function pgroup_insert(Request $request){
        if(AuthFacade::useradmin()){
            $request->validate([
                'group_name' => 'required|max:17',

            ]);
            $pgroup_data=[
                'group_name'=>$request->group_name,
                'create_by'=>'1',               //default
                'update_by'=>'1',               //default
                'active'=>'y'                   //default
            ];
            $p_group = new Pgroup();
            $p_group->fill($pgroup_data);
            $p_group->save();
            if($p_group->save()){
                $group_id =  $p_group->id;
            }

            // Retrieve the selected menu IDs from the form
            $selected_menus = $request->input('menu');

            // Loop through the selected menu IDs and insert them into the tbl_permission table
            foreach ($selected_menus as $menu_id) {
                //$menu = AdminMenu::find($menu_id); // ดึงข้อมูลเมนูโดยใช้ $menu_id
                $permission = new Permission();
                $permission->group_id = $group_id;
                $permission->group_parent_id = $menu_id; // เริ่มต้นให้ใช้ admin_menu_id เป็นเมนูย่อยที่เลือก
                $permission->active = 1;
                // $permission->group_parent_id = $menu->parent_id;

                $permission->save();
            }
            return redirect()->route('pgroup');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function pgroup_edit($pgroup_id){
        if(AuthFacade::useradmin()){
            $group_id = Pgroup::get()->where('id',$pgroup_id)->first();
            $menuHead = AdminMenu::whereNull('parent_id')->where('active','y')->get();
            $checkMenu = Permission::where('group_id',$pgroup_id)->where('active',1)->get();
            foreach ($checkMenu as $data)
            {
                $checked[] = $data->group_parent_id;
            }

            return view("admin.pgroup.pgroup-edit",compact('group_id','menuHead','checked'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function pgroup_update(Request $request,$pgroup_id){
        if(AuthFacade::useradmin()){
            $selected_menus = $request->input('menu');
            $all_menus = $request->input('checkMenu');
            foreach ($all_menus as $menu) {
                // ตรวจสอบว่า $menu อยู่ใน $selected_menus หรือไม่
                if (in_array($menu, $selected_menus)) {
                    // หากมีใน $selected_menus ให้ดำเนินการตามเงื่อนไข
                    // เช่น ตรวจสอบในฐานข้อมูล และดำเนินการตามเงื่อนไขที่ต้องการ
                    // เรียกใช้ Model เพื่อตรวจสอบว่ามีข้อมูลในฐานข้อมูลหรือไม่
                    $existing_menu = Permission::where('group_id', $pgroup_id)->where('group_parent_id', $menu)->first();

                    if ($existing_menu) {
                        // ตรวจสอบว่า active เป็น 0 หรือไม่
                        if ($existing_menu->active == 0) {
                            // เปลี่ยนค่า active เป็น 1
                            $existing_menu->active = 1;
                            $existing_menu->save(); // บันทึกการเปลี่ยนแปลง
                        }
                    } else {
                        // หากไม่มีในฐานข้อมูลให้ทำการเพิ่มข้อมูลใหม่
                        Permission::create([
                            'group_id' => $pgroup_id,
                            'group_parent_id' => $menu,
                            'active' => 1, // กำหนดค่า active เป็น 1
                        ]);
                    }
                }
            }

            // สำหรับการตรวจสอบและดำเนินการตามเงื่อนไขใน array ที่มีข้อมูลไม่เหมือนกัน
            foreach ($all_menus as $menu) {
                if (!in_array($menu, $selected_menus)) {
                    // ดำเนินการตามเงื่อนไขต่อไป
                    $existing_menu = Permission::where('group_id', $pgroup_id)->where('group_parent_id', $menu)->first();

                    if ($existing_menu) {
                        // ตรวจสอบว่า active เป็น 1 หรือไม่
                        if ($existing_menu->active == 1) {
                            // เปลี่ยนค่า active เป็น 0
                            $existing_menu->active = 0;
                            $existing_menu->save(); // บันทึกการเปลี่ยนแปลง
                        }
                    }
                }
            }
            return redirect()->route('pgroup');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function pgroup_delete($pgroup_id){
        if(AuthFacade::useradmin()){
            $pgroup_delete=[
                'active'=>'n'
            ];
            $update_pgroup = Pgroup::findById($pgroup_id);
            $update_pgroup->update($pgroup_delete);
            return redirect()->route('pgroup');
        }else{
            return redirect()->route('login.admin');
        }
    }
    //

    function user_admin(Request $request){
        if(AuthFacade::useradmin()){
                $query = Users::where('del_status', 0)
                ->get();
                // dd($query->toArray());
            return view("admin.user_admin.user-admin",['query' => $query]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function updateUserStatus()
    {
        // อัปเดตสถานะของผู้ใช้ทั้งหมดเป็น 0
        Users::query()->delete();

        // อาจจะ redirect ไปยังหน้าอื่นพร้อมกับข้อความยืนยัน
        return redirect()->route('user_admin')->with('status', 'ข้อมูลผู้ใช้ทั้งหมดถูกลบแล้ว');
    }

    public function exportUseradmin()
    {
        $users = Users::join('profiles', 'profiles.user_id', '=', 'users.id')
                    ->where('status', '1')
                    ->orderBy('id', 'DESC')
                    ->get();

        return Excel::download(new UsersAdminExport($users), 'users_admin_export.xlsx'); // Corrected line
    }

    function userAdminView($id){
        if(AuthFacade::useradmin()){
            $query = Users::with('Profiles')
                ->where('id', $id)->first();
            $orgPath = array_slice($this->getOrgPath($query->org_id), 1);
            return view("admin.user_admin.user-admin-view", compact('query','orgPath'));
        }else{
            return redirect()->route('login.admin');
        }
    }

    // function userAdminCreate(){
    //     if(AuthFacade::useradmin()){
    //         $profTitle = ProfilesTitle::get();
    //         $company = Company::get();

    //         return view("admin.user_admin.user-admin-create", compact('profTitle', 'company'));
    //     }else{
    //         return redirect()->route('login.admin');
    //     }
    // }
    public function userAdminEdit($id){
        if(AuthFacade::useradmin()){
            $user = Users::with(['Team'])->where('id',$id)->first();
            $orgchart = Orgchart::where('active','y')
                    ->where('level',2)
                    ->get();
            $team = Team::where('active','y')->get();
            $orgPath = array_slice($this->getOrgPath($user->org_id), 1);
            // $profTitle = ProfilesTitle::get();

            return view('admin.user_admin.user-admin-edit',compact('user','orgchart','team','orgPath'));
        }else{
            return redirect()->route('login.admin');
        }
    }

    private function getOrgPath(int $orgId): array
    {
        $path = [];
        $current = Orgchart::find($orgId);

        // วนขึ้นไปหา parent จนถึง root
        while ($current) {
            array_unshift($path, $current->id);
            $current = $current->parent_id
                ? Orgchart::find($current->parent_id)
                : null;
        }

        return $path;
    }

    // public function userAdminInsert(Request $request){
    //     if(AuthFacade::useradmin()){
    //         $validator = Validator::make($request->all(), [
    //             'username' => 'required',
    //             'password' => [
    //                     'required',
    //                     'min:8',
    //                     function ($attribute, $value, $fail) use ($request) {
    //                         // ตรวจสอบว่า password ไม่เป็นตัวเลขเดียวกันทั้งหมด
    //                         if (preg_match('/(\d)\1{7,}/', $value)) {
    //                             $fail('รหัสผ่านไม่สามารถเป็นตัวเลขเดียวกันซ้ำกันได้');
    //                         }

    //                         // ตรวจสอบว่า password มีอักษรพิเศษอย่างน้อย 1 ตัว
    //                         // if (!preg_match('/[^a-zA-Z0-9]/', $value)) {
    //                         //     $fail('รหัสผ่านต้องมีอักษรพิเศษอย่างน้อย 1 ตัว');
    //                         // }

    //                         // ตรวจสอบว่า password มีตัวอักษรทั้งพิมพ์เล็กและพิมพ์ใหญ่อย่างน้อย 1 ตัว
    //                         if (!preg_match('/[a-z]/', $value) || !preg_match('/[A-Z]/', $value)) {
    //                             $fail('รหัสผ่านต้องมีตัวอักษรทั้งพิมพ์เล็กและพิมพ์ใหญ่อย่างน้อย 1 ตัว');
    //                         }
    //                     },
    //                 ],
    //             'firstname' => 'required',
    //             'lastname' => 'required',
    //             'identification' => 'required|min:13|max:13'
    //         ]);
    //         // ถ้า validation ไม่ผ่าน กลับไปยังหน้า login form พร้อมแสดง errors
    //         if ($validator->fails()) {
    //             return back()->withErrors($validator)->withInput($request->only('username'));
    //         }
    //         $user = new Users();
    //         $user->username = $request->username;
    //         $user->password = Hash::make($request->password);
    //         $user->email = $request->email ?? null;
    //         $user->company_id = $request->company ?? null;
    //         $user->asc_id = $request->asc ?? null;
    //         $user->position_id = $request->position ?? null;
    //         $user->department_id = '1';
    //         $user->activkey = md5(microtime().$request->password);
    //         $user->create_at = now()->format('Y-m-d H:i:s');
    //         $user->_token = $request->_token;
    //         $user->save();
    //         // dd($user->toArray());

    //         $profile = new Profiles();
    //         $profile->user_id = $user->id;
    //         $profile->title_id = $request->title ?? null;
    //         $profile->firstname = $request->firstname;
    //         $profile->lastname = $request->lastname;
    //         $profile->identification = $request->identification;
    //         $profile->phone = $request->phone ?? null;
    //         $profile->firstname_en = $request->firstname_en ?? null;
    //         $profile->lastname_en = $request->lastname_en ?? null;
    //         $profile->save();

    //         return redirect()->route('user_admin')->with('success','Register Successful');
    //     }else{
    //         return redirect()->route('login.admin');
    //     }
    // }

    private function updateUserProfile($request, $user) {
        $user->email = $request->email ?? null;
        $user->org_id = $request->org_id ?? null;
        $user->department_org_id = $request->department_id ?? null;
        $user->team_id = $request->team_id ?? null;
        $user->save();

        $profile = Profiles::where('user_id', $request->id)->first();
        $profile->user_id = $user->id;
        $profile->title_id = $request->title ?? null;
        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;
        $profile->identification = $request->identification;
        $profile->phone = $request->phone ?? null;
        $profile->firstname_en = $request->firstname_en ?? null;
        $profile->lastname_en = $request->lastname_en ?? null;
        $profile->save();
    }
    public function userAdminUpdate(Request $request){
        if(AuthFacade::useradmin()){
            if ($request->filled('password')) {
                // Password validation
                $validator = Validator::make($request->all(), [
                    'password' => [
                        'required',
                        'min:8',
                        function ($attribute, $value, $fail) use ($request) {
                            if (preg_match('/(\d)\1{7,}/', $value)) {
                                $fail('รหัสผ่านไม่สามารถเป็นตัวเลขเดียวกันซ้ำกันได้');
                            }
                            // if (!preg_match('/[^a-zA-Z0-9]/', $value)) {
                            //     $fail('รหัสผ่านต้องมีอักษรพิเศษอย่างน้อย 1 ตัว');
                            // }
                            if (!preg_match('/[a-z]/', $value) || !preg_match('/[A-Z]/', $value)) {
                                $fail('รหัสผ่านต้องมีตัวอักษรทั้งพิมพ์เล็กและพิมพ์ใหญ่อย่างน้อย 1 ตัว');
                            }
                        },
                    ],
                ]);

                // Redirect if validation fails
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput($request->only('password'));
                }

                // Update user with new password
                $user = Users::where('id', $request->id)->first();
                $user->password = Hash::make($request->password);
                $this->updateUserProfile($request, $user);

                return redirect()->route('user_admin')->with('success', 'Update Successful');
            } else {
                // Update user without changing password
                $user = Users::where('id', $request->id)->first();
                // Ensure you do not update password if not provided
                $this->updateUserProfile($request, $user);

                return redirect()->route('user_admin')->with('success', 'Update Successful');
            }
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function userAdminDelete($id){
        if(AuthFacade::useradmin()){
            $userDelete = Users::where('id',$id)->first();
            $userDelete->del_status = 1;
            $userDelete->save();
            return redirect()->route('user_admin')->with('success','Delete Successful');
        }else{
            return redirect()->route('login.admin');
        }
    }

    public function toggleStatus($id)
    {
        $user = Users::findOrFail($id);

        // กลับค่า status (1 → 0, 0 → 1)
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();

        return back()->with('success', 'เปลี่ยนสถานะสำเร็จ');
    }

    public function asc(Request $request){
        if(AuthFacade::useradmin()){
            $asc = ASC::where('active','y')->get();
            if($request->isMethod('post')){
                $validator = Validator::make($request->all(), [
                    'title'=>'required|string',

                ]);
                // dd($validator);
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
                }
                $asc_create = new ASC;
                $asc_create->asc_code = $request->input('asc_code');
                $asc_create->name = $request->input('title');
                $asc_create->lat = 0;
                $asc_create->long = 0;
                $asc_create->created_by = Auth::user()->id;
                $asc_create->updated_by = Auth::user()->id;
                $asc_create->active = 'y';
                $asc_create->save();

                return redirect()->route('asc_del')->with('success', 'Update Successful');
            }
            return view("admin.user_admin.asc",compact('asc'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function asc_del(Request $request){
        if(AuthFacade::useradmin()){
            $asc = ASC::where('active','y')->get();

            return view("admin.user_admin.asc_del",compact('asc'));
        }else{
            return redirect()->route('login.admin');
        }
    }

    public function company(Request $request){
        if(AuthFacade::useradmin()){
            $company = Company::get();
            if($request->isMethod('post')){
                $validator = Validator::make($request->all(), [
                    'company_title'=>'required|string',

                ]);
                // dd($validator);
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
                }
                $company_create = new Company;
                $company_create->company_title = $request->input('company_title');
                $company_create->create_date = now();
                $company_create->save();

                 return redirect()->route('company_del')->with('success', 'Update Successful');
            }
            return view("admin.user_admin.company",compact('company'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function company_del(Request $request){
        if(AuthFacade::useradmin()){
            $company = Company::get();

            return view("admin.user_admin.company_del",compact('company'));
        }else{
            return redirect()->route('login.admin');
        }
    }


    public function position(Request $request){
        if(AuthFacade::useradmin()){
            $position = Position::get();
            if($request->isMethod('post')){
                $validator = Validator::make($request->all(), [
                    'company_id' => 'required',
                    'position_title'=>'required',

                ],[
                    'company_id.required' => 'กรุณาเลือก Company',
                    'position_title.required' => 'กรุณากรอกชื่อ Position',
                ]);
                // dd($validator);
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
                }
                $position_create = new Position;
                $position_create->company_id = $request->input('company_id');
                $position_create->position_title = $request->input('position_title');
                $position_create->create_date = now();
                $position_create->save();

                return redirect()->route('position_del')->with('success', 'Update Successful');
            }
            return view("admin.user_admin.position",compact('position'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function position_del(Request $request){
        if(AuthFacade::useradmin()){
            $position = Position::get();

            return view("admin.user_admin.position_del",compact('position'));
        }else{
            return redirect()->route('login.admin');
        }
    }

    public function company_delete($id)
    {
        if (AuthFacade::useradmin()) {
            $company = Company::find($id);

            if (!$company) {
                return response()->json([
                    'success' => false,
                    'message' => 'ไม่พบบริษัทนี้'
                ], 404);
            }

            $company->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'ลบบริษัทเรียบร้อยแล้ว'
                ]);
            }

            return redirect()->route('asc')->with('success', 'Delete Successful');
        }

        return redirect()->route('login.admin');
    }

    public function asc_delete($id)
    {
        if (AuthFacade::useradmin()) {
            $asc = ASC::find($id);

            if (!$asc) {
                return response()->json([
                    'success' => false,
                    'message' => 'ไม่พบข้อมูล ASC นี้'
                ], 404);
            }

            $asc->active = 'n';
            $asc->updated_by = Auth::user()->id;
            $asc->updated_date = now();
            $asc->save();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'ปิดการใช้งาน ASC เรียบร้อยแล้ว'
                ]);
            }

            return redirect()->route('asc')->with('success', 'Delete Successful');
        }

        return redirect()->route('login.admin');
    }

    public function position_delete($id)
    {
        if (AuthFacade::useradmin()) {
            $position = Position::find($id);

            if (!$position) {
                return response()->json([
                    'success' => false,
                    'message' => 'ไม่พบข้อมูลตำแหน่งนี้'
                ], 404);
            }

            $position->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'ลบข้อมูลตำแหน่งเรียบร้อยแล้ว'
                ]);
            }

            return redirect()->route('asc')->with('success', 'Delete Successful');
        }

        return redirect()->route('login.admin');
    }
    //************************* */ import user by chockekr
    public function userExcel(){
        if(AuthFacade::useradmin()){
            return view("admin.user_admin.user-excel");
        }else{
            return redirect()->route('login.admin');
        }
    }

    public function importExcel(Request $request){
        if(AuthFacade::useradmin()){
            $request->validate([
                'import_excel' =>
                ['required','file','mimes:xlsx, xls'],
                [
                    'import_excel.required' => 'คุณยังไม่ได้ Uploadfile',
                    'import_excel.mimes' => 'กรุณาใช้ไฟล์สกุล xlsx xls'
                ]


            ]);
            // dd( $request->file('import_excel'));
            Excel::import(new UsersImport, $request->file('import_excel'));

            return redirect()->back()->with('success', 'Excel imported successfully!');
        }else{
            return redirect()->route('login.admin');
        }
    }
    //************************** */
    function coursefield(){
        if(AuthFacade::useradmin()){
            return view("admin.coursefield.coursefield");
        }else{
            return redirect()->route('login.admin');
        }
    }
    //new p
    function imgslide_create(){
        if(AuthFacade::useradmin()){
            return view("admin.imgslide.Imgslide-create");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function imgslide_insert(Request $request){
        if(AuthFacade::useradmin()){
            $request->validate([
                'imgslide_link'=>'required|url|max:76',
                'imgslide_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
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
            // $request->imgslide_picture->move(public_path('storage/Imgslides'),$imageName);

                $idFolder = public_path('images/uploads/imgslides');
                if (!file_exists($idFolder)) {
                    mkdir($idFolder);
                }

            $request->imgslide_picture->move($idFolder,$imageName);
            return redirect()->route('imgslide');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function imgslide(){
        if(AuthFacade::useradmin()){
            $imgslide =Imgslide::where('active','y')->get();
            return view("admin.imgslide.imgslide",compact('imgslide'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function imgslide_detail($id){
        if(AuthFacade::useradmin()){
            $imgslide =Imgslide::where('imgslide_id',$id)->first();
            return view("admin.imgslide.imgslide_detail",['imgslide'=>$imgslide]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function imgslide_edit($imgslide_id){
        if(AuthFacade::useradmin()){
            $imgslide =DB::table('imgslide')->where('imgslide_id',$imgslide_id)->first();
            return view("admin.imgslide.Imgslide-edit",compact('imgslide'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function imgslide_update(Request $request,$imgslide_id){
        if(AuthFacade::useradmin()){
            $request->validate([
                'imgslide_link'=>'required|url|max:76',
                'imgslide_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $imgslide_data=[
                'imgslide_link'=>$request->imgslide_link,
                'update_by'=>Auth::user()->id,               //default                  //default
            ];
            $imgslide_update = Imgslide::findById($imgslide_id);
            $imgslide_update->update($imgslide_data);
            if($request->file('imgslide_picture')){
                $image = $request->file('imgslide_picture');

                $idFolder = public_path('images/uploads/imgslides');
                if (!file_exists($idFolder)) {
                    mkdir($idFolder);
                }

                // ย้ายไฟล์ภาพไปยังโฟลเดอร์ใหม่
                $imageName = $image->getClientOriginalName();
                $image->move($idFolder, $imageName);

                $imgslide_update->imgslide_picture = $imageName;
                // dd($imageName);

            }
            $imgslide_update->save();
            return redirect()->route('imgslide');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function imgslide_delete($imgslide_id){
        if(AuthFacade::useradmin()){
            $imgslide_delete=[
                'active'=>'n'
            ];
            DB::table('imgslide')->where('imgslide_id',$imgslide_id)->update($imgslide_delete);
            return redirect()->route('imgslide');
        }else{
            return redirect()->route('login.admin');
        }
    }
    //
    function librarytype(){
        if(AuthFacade::useradmin()){
            return view("admin.libraryfile.librarytype");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function libraryfile(){
        if(AuthFacade::useradmin()){
            return view("admin.libraryfile.libraryfile");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function coursenotification(){
        if(AuthFacade::useradmin()){
            $course_notification = Coursenotification::where('active','1')->paginate(10);
            return view("admin.coursenotification.coursenotification",['course_notification' => $course_notification]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function passcourse(){
        if(AuthFacade::useradmin()){
            return view("admin.passcourse.passcourse");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function logadmin(){
        if(AuthFacade::useradmin()){

            return view("admin.logadmin.logadmin");
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function getadminData(Request $request)
    {
        $query = Logadmin::join('tbl_users as u', 'log_admin.user_id', '=', 'u.id')
                ->leftJoin('tbl_asc as a', 'u.asc_id', '=', 'a.id')
                ->select('log_admin.controller', 'log_admin.action', 'u.username','a.name', 'log_admin.create_date');

        return DataTables::of($query)
            ->addColumn('controller', fn($row) => $row->controller ?? '-')
            ->addColumn('action', fn($row) => $row->action ?? '-')
            ->addColumn('username', fn($row) => $row->username ?? '-')
            ->addColumn('name', fn($row) => $row->name ?? '-')
            ->addColumn('create_date', fn($row) => $row->create_date ?? '-')
            ->make(true);
    }

    function logusers(){
        if(AuthFacade::useradmin()){

            return view("admin.logadmin.logadmin_user");
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function getTextData(Request $request)
    {
        $query = Logusers::join('tbl_users as u', 'log_users.user_id', '=', 'u.id')
                            ->leftJoin('tbl_asc as a', 'u.asc_id', '=', 'a.id')
                            ->select('log_users.controller', 'log_users.action', 'u.username', 'a.name', 'log_users.create_date');

        return DataTables::of($query)
            ->addColumn('controller', fn($row) => $row->controller ?? '-')
            ->addColumn('action', fn($row) => $row->action ?? '-')
            ->addColumn('username', fn($row) => $row->username ?? '-')
            ->addColumn('name', fn($row) => $row->name ?? '-')
            ->addColumn('create_date', fn($row) => $row->create_date ?? '-')
            ->make(true);
    }

    function logapprove(){
        if(AuthFacade::useradmin()){
            $logapprove = Logapprove::join('users','users.id','=','log_approve.user_id')->paginate(10);
            return view("admin.logadmin.logadmin_apporve",['logapprove' => $logapprove]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function logapporvepersonal(){
        if(AuthFacade::useradmin()){
            $logapporvepersonal = Logapprovepersonal::join('users','users.id','=','log_approve_personal.user_id')->paginate(10);
            return view("admin.logadmin.logadmin_apporvepersonal",['logapporvepersonal' => $logapporvepersonal]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function logregister(){
        if(AuthFacade::useradmin()){
            $logregister = Logregister::join('users','users.id','=','log_register.user_id')->paginate(10);
            return view("admin.logadmin.logadmin_register",['logregister' => $logregister]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function student_photo(){
        if(AuthFacade::useradmin()){
            return view("admin.student-photo.student-photo");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function capture(){
        if(AuthFacade::useradmin()){
            return view("admin.capture.capture");
        }else{
            return redirect()->route('login.admin');
        }
    }

    function learnreset(){
        if(AuthFacade::useradmin()){
            $users = Cache::remember('learnreset_users', 300, function() {
                return Users::with(['learns','scores'])
                            ->join('profiles','profiles.user_id','=','users.id')
                            ->where('users.status','1')
                            ->get();
            });
            // $score =Score::where('active','y')->paginate(10);
            // $learnreset =DB::table('score')->get();
            return view("admin.learnreset.learnreset",compact('users'));
        }else{
            return redirect()->route('login.admin');
        }
    }

    public function updateLearnresetStatus()
    {
        // อัปเดตสถานะของผู้ใช้ทั้งหมดเป็น 0
        Learn::query()->delete();

        Score::query()->delete();
        // อาจจะ redirect ไปยังหน้าอื่นพร้อมกับข้อความยืนยัน
        return redirect()->route('learnreset')->with('status', 'ข้อมูลผู้ใช้ทั้งหมดถูกลบแล้ว');
    }

    function learnreset_course(Request $request,$id){
        if(AuthFacade::useradmin()){
            $learn = Learn::where('user_id',$id)->where('lesson_active','y')->get();
            if ($request->has('chk')) {
                // รับค่าที่ส่งมาจากฟอร์ม
                $inputData = $request->input('inputData');
                // dd($inputData);
                $chkValues = $request->input('chk');

                foreach ($chkValues as $chkValue) {
                    $reset = Learn::findById($chkValue);
                    if($reset){
                        $reset->lesson_active = 'n';
                        $reset->save();

                        $log_reset = new Logreset;
                        $log_reset->user_id = $reset->user_id;
                        $log_reset->course_id = $reset->course_id;
                        $log_reset->lesson_id = $reset->lesson_id;
                        $log_reset->reset_description = $inputData;
                        $log_reset->reset_type = '0';
                        $log_reset->reset_by = Auth::user()->id;
                        $log_reset->reset_date = now();
                        $log_reset->save();
                    }
                }
                return redirect()->route('learnreset.course',['id' => $id]);
            }
            return view("admin.learnreset.learnreset_course",['learn' => $learn,'id' => $id]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function learnreset_score(Request $request,$id){
        if(AuthFacade::useradmin()){
            $score = Score::where('user_id',$id)->where('active','y')->get();
            if ($request->has('chk')) {
                // รับค่าที่ส่งมาจากฟอร์ม

                $chkValues = $request->input('chk');

                foreach ($chkValues as $chkValue) {
                    $reset = Score::findById($chkValue);
                    $reset->active = 'n';
                    $reset->save();

                     $log_reset = new Logreset;
                    $log_reset->user_id = $reset->user_id;
                    $log_reset->course_id = $reset->course_id ?? null;
                    $log_reset->lesson_id = null;
                    $log_reset->reset_description = 'รีเซ็ตคะแนนสอบ';
                    $log_reset->reset_type = '0';
                    $log_reset->reset_by = Auth::user()->id;
                    $log_reset->reset_date = now();
                    $log_reset->save();

                }
                return redirect()->route('learnreset.score',['id' => $id]);
            }
            return view("admin.learnreset.learnreset_score",['score' => $score,'id' => $id]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function learnreset_reset(Request $request,$id){
        if(AuthFacade::useradmin()){
            if ($request->has('checkbox_name')) {
                $checkboxValue = $request->input('checkbox_name');
                // dd($checkboxValue);
                if (!empty($checkboxValue)) {
                    foreach($checkboxValue as $re){
                        $score = Score::findById($re);

                        $score->active = 'n';
                        $score->save();
                    }
                    return redirect()->route('learnreset');
                }
            }
            if ($request->has('checkbox_name_course')) {
                $checkboxValue = $request->input('checkbox_name_course');
                // dd($checkboxValue);
                if (!empty($checkboxValue)) {
                    foreach($checkboxValue as $re){
                        $score = Learn::findById($re);

                        $score->lesson_active = 'n';
                        $score->save();
                    }
                    return redirect()->route('learnreset');
                }
            }
            if ($request->has('checkbox_name_lesson')) {
                $checkboxValue = $request->input('checkbox_name_lesson');
                // dd($checkboxValue);
                if (!empty($checkboxValue)) {
                    foreach($checkboxValue as $re){
                        $score = Learn::findById($re);

                        $score->lesson_active = 'n';
                        $score->save();
                    }
                    return redirect()->route('learnreset');
                }
            }
            return redirect()->route('learnreset');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function learnreset_resetuser_insert(Request $request){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
//classroom
    function classroom(){
        if(AuthFacade::useradmin()){
            $zoom =DB::table('zoom')->get();
            return view("admin.Classroom.Classroom",compact('zoom'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function classroom_create(Request $request){
        if(AuthFacade::useradmin()){
            if ($request->isMethod('post')){
                $validator = Validator::make($request->all(), [
                    'title'=>'required|string',
                    'join_url' => 'required|string',
                    'start_date' => 'required|string'

                ]);
                // dd($validator);
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
                }
                $zoom_create = new Zoom;
                $zoom_create->title = $request->input('title');
                $zoom_create->join_url = $request->input('join_url');
                $zoom_create->duration = $request->input('duration');
                $zoom_create->start_date = $request->input('start_date');
                $zoom_create->created_by = Auth::user()->id;
                $zoom_create->updated_by = Auth::user()->id;
                $zoom_create->active = 'y';
                $zoom_create->save();

                return redirect()->route('classroom');
            }
            return view("admin.Classroom.classroom-create");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function classroom_edit($id){
        if(AuthFacade::useradmin()){
            $zoom=DB::table('zoom')->where('id',$id)->first();
            return view("admin.Classroom.classroom-update",compact('zoom'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function classroom_delete($id) {
        if(AuthFacade::useradmin()){
            $classroom_delete = [
                'active' => 'n',
            ];
            DB::table('zoom')->where('id', $id)->update($classroom_delete);
            return redirect()->route('classroom')->with('success', 'Classroom deleted successfully.');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function classroom_update(Request $request){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    //Captcha
    function captcha_create(){
        if(AuthFacade::useradmin()){
            return view("admin.captcha.captcha-create");
        }else{
            return redirect()->route('login.admin');
        }
    }
    function captcha(){
        if(AuthFacade::useradmin()){
            // อัปเดตเป็นชื่อตารางที่ถูกต้อง 'config_captcha'
            $captcha = Captcha::where('capt_hide','0')->paginate(10);
            $courseOnline = Course::where('active','y')->get();
            return view("admin.captcha.captcha_2",compact('captcha','courseOnline'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function addCourse(Request $request)
    {
        $capid = $request->input('capid');
        $courseId = $request->input('course_id');

        // หาหลักสูตรและเชื่อมโยงกับ capid
        $course = Course::find($courseId);
        if ($course && !$course->course_point) {
            $course->course_point = $capid;
            $course->save();
        }

        return response()->json(['status' => 'success']);
    }

    public function removeCourse(Request $request)
    {
        $capid = $request->input('capid');
        $courseId = $request->input('course_id');

        // หาหลักสูตรและยกเลิกการเชื่อมโยงกับ capid
        $course = Course::find($courseId);
        if ($course && $course->course_point == $capid) {
            $course->course_point = null;
            $course->save();
        }

        return response()->json(['status' => 'success']);
    }

    function captcha_course(Request $request){
        if(AuthFacade::useradmin()){
            if ($request->input('data-id')) {
                // รับค่าที่ส่งมาจากฟอร์ม

                $dataId = $request->input('data-id');
                $checkedIds = $request->input('chk');

                if ($checkedIds !== null) {
                    // ดำเนินการกับ checkbox ที่ถูกติ๊กที่นี่
                    foreach ($checkedIds as $chkValue) {
                        $reset = Course::findById($chkValue);
                        if($reset){
                            $reset->course_point = $dataId;
                            $reset->save();
                        }
                    }
                }
                return redirect()->route('captcha');
            }

        }else{
            return redirect()->route('login.admin');
        }
    }
    function captcha_edit(Request $request,$capid){
        if(AuthFacade::useradmin()){
            $captcha = Captcha::get()->where('capid',$capid)->first();
            if ($request->isMethod('post')){
                $validator = Validator::make($request->all(), [
                    'capt_name'=>'required|string',

                    'capt_times' => 'required|string'
                ]);
                // dd($request);
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput(); // ส่งกลับไปยังหน้าก่อนหน้าพร้อมกับข้อมูลที่ผู้ใช้ป้อนเพื่อแสดงข้อผิดพลาด
                }
                $cap = Captcha::findById($capid);
                $cap->capt_name = $request->input('capt_name');
                $cap->type = null;
                $cap->capt_times = $request->input('capt_times');
                $cap->updated_by = Auth::user()->id;
                $cap->save();

                return redirect()->route('captcha');
            }
            return view("admin.captcha.captcha-edit",compact('captcha'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function captcha_detail($capid){
        if(AuthFacade::useradmin()){
            $captcha = Captcha::get()->where('capid',$capid)->first();
            return view("admin.captcha.captcha-detail",compact('captcha'));
        }else{
            return redirect()->route('login.admin');
        }
    }
    function captcha_update(Request $request,$capid){
        if(AuthFacade::useradmin()){
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
        }else{
            return redirect()->route('login.admin');
        }
    }
    function captcha_insert(Request $request){
        if(AuthFacade::useradmin()){
            $survey = new Captcha;
            $survey->capt_name = $request->input('capt_name');
            $survey->type = null;
            $survey->capt_times = $request->input('capt_times');
            $survey->capt_time_random = '10';
            $survey->capt_time_back = '10';
            $survey->capt_wait_time = '10';
            $survey->capt_hide = '0';
            $survey->created_by = Auth::user()->id;
            $survey->updated_by = Auth::user()->id;
            $survey->capt_active ='y';
            $survey->save();
            return redirect()->route('captcha');
        }else{
            return redirect()->route('login.admin');
        }
    }
    function captcha_y($capid,$capt_active) {
        if(AuthFacade::useradmin()){
            $cap = Captcha::findById($capid);
            if($cap){
                $cap->capt_active = $capt_active;
                $cap->save();

                return redirect()->route('captcha');
            }
        }else{
            return redirect()->route('login.admin');
        }
    }
    function captcha_n($capid,$capt_active) {
        if(AuthFacade::useradmin()){
            $cap = Captcha::findById($capid);
            if($cap){
                $cap->capt_active = $capt_active;
                $cap->save();

                return redirect()->route('captcha');
            }
        }else{
            return redirect()->route('login.admin');
        }
    }
    function captcha_delete($capid) {
        if(AuthFacade::useradmin()){
           $cap = Captcha::findById($capid);
           if($cap){
            $cap->capt_hide = '1';
            $cap->save();

            return redirect()->route('captcha');
        }
        }else{
            return redirect()->route('login.admin');
        }
    }
    function report_logallregister(Request $request) {
        if(AuthFacade::useradmin()){
            $query = $request->input('fname');
            $position = $request->input('position');

            if($query) {
                $report = Logregister::where(function($q) use ($query) {
                    $q->where('firstname', 'like', "%$query%")
                    ->orWhere('lastname', 'like', "%$query%");
                })->where('active', 'y')->get();
            } elseif(isset($position) && !empty($position)) {
                $report = Logregister::where('position_id', $position)->get();
            } else {
                $report = Logregister::where('active', 'y')->get();
            }

            return view("admin.report.report_logallregister", ['report' => $report]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function report_loguserstatus(Request $request) {
        if(AuthFacade::useradmin()){
            $query = $request->input('fname');
            $email = $request->input('email');

            if($query && !empty($query)) {
                $user = Users::join('profiles', 'profiles.user_id', '=', 'users.id')
                            ->where(function($q) use ($query) {
                                $q->where('profiles.firstname', 'like', "%$query%")
                                    ->orWhere('profiles.lastname', 'like', "%$query%")
                                    ->orWhere('profiles.firstname_en', 'like', "%$query%")
                                    ->orWhere('profiles.lastname_en', 'like', "%$query%");
                            })
                            ->where('status', '1')
                            ->where('superuser', '0')
                            ->orderBy('id','DESC')
                            ->paginate(10);
            } elseif(isset($email) && !empty($email)) {
                $user = Users::join('profiles', 'profiles.user_id', '=', 'users.id')
                            ->where('users.email', '=', $email)
                            ->where('status', '1')
                            ->where('superuser', '0')
                            ->orderBy('id','DESC')
                            ->paginate(10);
            }  else {
                $user = Users::join('profiles', 'profiles.user_id', '=', 'users.id')
                            ->where('status', '1')
                            ->where('superuser', '0')
                            ->orderBy('id','DESC')
                            ->paginate(10);
            }

            return view("admin.report.report_loguserstatus", ['user' => $user]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function report_user(Request $request)
    {
        if(AuthFacade::useradmin()){

            $line_id = $request->line_id;
            $section_id = $request->section_id;
            $team_id = $request->team_id;
            $cate_id = $request->cate_id;

            $userDetail = auth()->user();

            /*
            |--------------------------------------------------------------------------
            | Users Query
            |--------------------------------------------------------------------------
            */

            $usersQuery = Users::join(
                    'profiles',
                    'profiles.user_id',
                    '=',
                    'users.id'
                )
                ->leftJoin(
                    'orgchart',
                    'orgchart.id',
                    '=',
                    'users.org_id'
                )
                ->leftJoin(
                    'team',
                    'team.id',
                    '=',
                    'users.team_id'
                )
                ->where('users.status', '1');

            /*
            |--------------------------------------------------------------------------
            | Section Filter
            |--------------------------------------------------------------------------
            */

            if($section_id){

                $orgIds = collect([$section_id])
                    ->merge(
                        ChildOrgHelper::getAllChildOrgIds([$section_id])
                    );

                $usersQuery->whereIn(
                    'users.org_id',
                    $orgIds
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Line Filter
            |--------------------------------------------------------------------------
            */

            if($line_id){

                $orgIds = collect([$line_id])
                    ->merge(
                        ChildOrgHelper::getAllChildOrgIds([$line_id])
                    );

                $usersQuery->whereIn(
                    'users.org_id',
                    $orgIds
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Team Filter
            |--------------------------------------------------------------------------
            */

            if($team_id){

                $usersQuery->where(
                    'users.team_id',
                    $team_id
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Users
            |--------------------------------------------------------------------------
            */

            $users = $usersQuery
                ->select(
                    'users.*',
                    'profiles.firstname',
                    'profiles.lastname'
                )
                ->orderBy('users.id', 'DESC')
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Categories
            |--------------------------------------------------------------------------
            */

            $categories = Category::where('active','y')
                ->orderBy('cate_title')
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Courses / Learns
            |--------------------------------------------------------------------------
            */

            $courses = collect();
            $passCourses = collect();
            $assessmentScores = collect();

           if($cate_id){

                $courses = Course::join(
                        'category',
                        'category.cate_id',
                        '=',
                        'course_online.cate_id'
                    )
                    ->where('course_online.active','y')
                    ->where('course_online.cate_id', $cate_id)
                    ->select(
                        'course_online.course_id',
                        'course_online.course_title',
                        'course_online.cate_id',
                        'category.cate_title as cate_name'
                    )
                    ->orderBy('course_online.course_id')
                    ->get();

                /*
                |--------------------------------------------------------------------------
                | Course ที่ผ่านแล้ว
                |--------------------------------------------------------------------------
                */

                $passCourses = Passcourse::whereIn(
                        'passcours_cours',
                        $courses->pluck('course_id')
                    )
                    ->whereIn(
                        'passcours_user',
                        $users->pluck('id')
                    )
                    ->where(
                        'passcours_status',
                        'pass'
                    )
                    ->get();

                /*
                |--------------------------------------------------------------------------
                | Assessment Score
                |--------------------------------------------------------------------------
                */

                $assessmentScores = ScoreAssessment::whereIn(
                        'passcours_id',
                        $passCourses->pluck('passcours_id')
                    )
                    ->where(
                        'active',
                        'y'
                    )
                    ->get()
                    ->groupBy('passcours_id');

                /*
                |--------------------------------------------------------------------------
                | Map user_id + course_id
                |--------------------------------------------------------------------------
                */

                $passCourses = $passCourses->keyBy(function($item){
                    return $item->passcours_user.'_'.$item->passcours_cours;
                });
            }

            /*
            |--------------------------------------------------------------------------
            | Department
            |--------------------------------------------------------------------------
            */

            $departments = Orgchart::where(
                    'id',
                    $userDetail->department_org_id
                )
                ->first();

            /*
            |--------------------------------------------------------------------------
            | Sections
            |--------------------------------------------------------------------------
            */

            $sections = Orgchart::where(
                    'parent_id',
                    $userDetail->department_org_id
                )
                ->where('active','y')
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Lines
            |--------------------------------------------------------------------------
            */

            $lines = collect();

            if($section_id){

                $lines = Orgchart::where(
                        'parent_id',
                        (string)$section_id
                    )
                    ->where('active','y')
                    ->get();
            }

            /*
            |--------------------------------------------------------------------------
            | Teams
            |--------------------------------------------------------------------------
            */

            $teams = Team::where('active','y')->get();

            return view("admin.report.report_user", [

                'users' => $users,
                'courses' => $courses,
                'passCourses' => $passCourses,
                'assessmentScores' => $assessmentScores,

                'departments' => $departments,
                'sections' => $sections,
                'lines' => $lines,
                'teams' => $teams,
                'categories' => $categories,

                'line_id' => $line_id,
                'section_id' => $section_id,
                'team_id' => $team_id,
                'cate_id' => $cate_id
            ]);

        }

        return redirect()->route('login.admin');
    }

    public function getLines($section_id)
    {
        $lines = Orgchart::where(
                'parent_id',
                (string)$section_id
            )
            ->where('active', 'y')
            ->get(['id', 'title']);

        return response()->json($lines);
    }

    function report_user_skill($user_id) {
        if(AuthFacade::useradmin()){

            $lessons = Lesson::where('active', 'y')->get();

            $learns = Learn::where('user_id', $user_id)->get()
                        ->keyBy('lesson_id');

            return view("admin.report.report_user_skill", [
                'lessons' => $lessons,
                'learns' => $learns,
                'user_id' => $user_id
            ]);

        }else{
            return redirect()->route('login.admin');
        }
    }
    function report_course(Request $request) {
        if(AuthFacade::useradmin()){
            $course = Course::where('active', 'y')
                            ->orderBy('course_id', 'DESC')
                            ->get();

            return view("admin.report.report_course", ['course' => $course]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function report_lesson($id) {
        if(AuthFacade::useradmin()){
            // $query = $request->input('cate');
                $user = Users::join('profiles','profiles.user_id','=','users.id')
                        ->where('status', '1')
                        ->orderBy('id', 'DESC')
                        ->get();
                $lesson = Lesson::where('course_id',$id)
                            ->where('active', 'y')
                            ->orderBy('course_id', 'DESC')
                            ->get();

                $course = Lesson::where('course_id',$id)
                ->where('active', 'y')
                ->orderBy('course_id', 'DESC')
                ->first();

            return view("admin.report.report_lesson", ['lesson' => $lesson,'user' => $user,'id' => $id, 'course' => $course]);
        }else{
            return redirect()->route('login.admin');
        }
    }

    public function exportUsers($id)
    {
        $users = Users::join('profiles', 'profiles.user_id', '=', 'users.id')
                      ->where('status', '1')
                      ->orderBy('id', 'DESC')
                      ->get();
        $course = Course::where('course_id',$id)->first();
        $lessons = Lesson::where('course_id', $id)
                         ->where('active', 'y')
                         ->orderBy('course_id', 'DESC')
                         ->get();

        return Excel::download(
            new UsersExport($id, $users, $lessons),
            preg_replace('/[\/\\\\]/', '-', $course->course_title) . '.xlsx'
        );
    }

    function report_reset(Request $request) {
        if(AuthFacade::useradmin()){
            // $query = $request->input('cate');
            $course_name = $request->input('course_name');
            $lesson_name = $request->input('lesson_name');

            if(isset($course_name) && !empty($course_name)) {
                $reset = Logreset::where('course_id',$course_name)
                            ->paginate(10);
            }elseif(isset($lesson_name) && !empty($lesson_name)) {
                $reset = Logreset::where('lesson_id',$lesson_name)
                            ->paginate(10);
            }else {
                $reset = Logreset::paginate(10);
            }

            return view("admin.report.report_logreset", ['reset' => $reset]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    function report_byuser(Request $request) {
        if(AuthFacade::useradmin()){
            // $query = $request->input('cate');
            $company = Company::get();
            $division = Division::get();
            $course_name = $request->input('fnam');
            $division_s = $request->input('division');
            $company_s = $request->input('company');
            if(isset($course_name) && !empty($course_name)) {
                $user = Users::where('username',$course_name)
                            ->where('status', '1')
                            ->orderBy('id', 'DESC')
                            ->paginate(10);
            }elseif(isset($division_s) && !empty($division_s)){
                $user = Users::where('division_id',$division_s)
                            ->where('status', '1')
                            ->orderBy('id', 'DESC')
                            ->paginate(10);

            } elseif(isset($company_s) && !empty($company_s)){
                $user = Users::where('company_id',$company_s)
                            ->where('status', '1')
                            ->orderBy('id', 'DESC')
                            ->paginate(10);

            }else {
                $user = Users::where('status', '1')
                            ->orderBy('id', 'DESC')
                            ->paginate(10);
            }

            return view("admin.report.report_byuser", ['user' => $user,'company' => $company,'division' => $division]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    public function fetchCoursesAndLessons(Request $request){
        if(AuthFacade::useradmin()){
            $user_id = $request->input('user_id');

            // ดึงข้อมูลการเรียนของผู้ใช้จากตาราง learn
            $learn = Learn::select('course_id')->where('user_id', $user_id)->distinct()->get();


            $courses = [];
            $lessons = [];

            // ดึงข้อมูลหลักสูตรและบทเรียนที่เกี่ยวข้อง
            foreach ($learns as $learn) {
                // ดึงข้อมูลหลักสูตรจากตาราง Course ด้วย course_id ที่ได้จากการเรียน
                $course = Course::find($learn->course_id);

                if ($course) {
                    // เพิ่มข้อมูลหลักสูตรในรายการ
                    $courses[] = [
                        'course_id' => $course->course_id,
                        'course_title' => $course->course_title,
                    ];

                    // ดึงข้อมูลบทเรียนที่เกี่ยวข้องกับหลักสูตร
                    $courseLessons = Lesson::where('course_id', $course->course_id)->get();

                    // เพิ่มข้อมูลบทเรียนในรายการ
                    $lessons[$course->id] = $courseLessons->map(function ($lesson) {
                        return [
                            'lesson_id' => $lesson->id,
                            'lesson_title' => $lesson->title,
                        ];
                    });
                }
            }

        // ส่งข้อมูลกลับเป็น JSON
            return response()->json([
                'success' => true,
                'courses' => $courses,
                'lessons' => $lessons,
                'user_id' => $user_id,
            ]);
        }else{
            return redirect()->route('login.admin');
        }
    }
    //dynamic dropdown company by chockker
    public function companySelector($id){
        if(AuthFacade::useradmin()){
            $position = Position::where('company_id', $id)->get();
            $division = Division::where('company_id', $id)->get();
            return response()->json([
                'position' => $position,
                'division' => $division
            ]);
        }else{
            return redirect()->route('login.admin');
        }
    }

        public function questionnaireout_assessment(Request $request){
        if (AuthFacade::useradmin()) {

            $query = DB::table('course_online');

                    if ((string) auth()->user()->superuser !== '1') {
                        $query->where('create_by', auth()->user()->id);
                    }

                    $courses = $query->get(); // 👈 สำคัญ

            $results = []; // กัน error หน้าแรก

            return view(
                "admin.questionnaireout.questionnaireout_assessment",
                compact('courses', 'results')
            );

        } else {
            return redirect()->route('login.admin');
        }
    }
    public function questionnaireout_result(Request $request){
        if(AuthFacade::useradmin()){
            // $course_online = Course::join('category', 'category.cate_id', '=', 'course_online.cate_id')->where('course_online.active', 'y')->orderBy('sortOrder', 'desc')->get();
            $course_online = Passcourse::join('course_online', 'course_online.course_id', '=', 'passcours.passcours_cours')
            ->join('category', 'category.cate_id', '=', 'course_online.cate_id')
            // เพิ่มการ Join กับตาราง tbl_profiles
            ->join('profiles', 'profiles.user_id', '=', 'passcours.passcours_user')
            ->where(function($query) {
                // $query->where('passcours.passcours_status', '!=', 'pass')
                //     ->orWhereNull('passcours.passcours_status');
                $query->orWhereNull('passcours.passcours_status');
            })
            ->select(
                'passcours.*',
                'course_online.course_title',
                'category.cate_title',
                // เพิ่มการ Select ชื่อและนามสกุล
                'profiles.firstname',
                'profiles.lastname'
            )
            ->get();
            return view("admin.questionnaireout.questionnaireout_result", compact('course_online'));
        }else{
            return redirect()->route('login.admin');
        }
    }

    public function questionnaireout_assessment_ajax(Request $request)
{
    if (AuthFacade::useradmin()) {

        $query = DB::table('passcours')
            ->join(
                'course_online',
                'passcours.passcours_cours',
                '=',
                'course_online.course_id'
            )
            ->leftJoin(
                'users',
                'passcours.passcours_user',
                '=',
                'users.id'
            )
            ->leftJoin(
                'profiles',
                'users.id',
                '=',
                'profiles.user_id'
            )
            ->select(
                'passcours.passcours_id as passcours_id',
                'course_online.course_id',
                'course_online.course_title',
                'profiles.firstname',
                'profiles.lastname',
                'passcours.passcours_status'
            );


        // 🔍 filter course
        if (!empty($request->course_id)) {

            $query->where(
                'course_online.course_id',
                $request->course_id
            );

        }


        // 🔍 filter firstname
        if (!empty($request->firstname)) {

            $query->where(
                'profiles.firstname',
                'like',
                '%' . $request->firstname . '%'
            );

        }


        // 🔍 filter lastname
        if (!empty($request->lastname)) {

            $query->where(
                'profiles.lastname',
                'like',
                '%' . $request->lastname . '%'
            );

        }


        // 🔥 filter status
        if (!empty($request->status)) {

            // กรอกข้อมูลแล้ว
            if ($request->status == 'pass') {

                $query->where(
                    'passcours.passcours_status',
                    'pass'
                );

            }

            // ยังไม่ได้กรอกข้อมูล
            if ($request->status == 'wait') {

                $query->where(function($q){

                    $q->whereNull('passcours.passcours_status')
                    ->orWhere(
                        'passcours.passcours_status',
                        'wait'
                    );

                });

            }

        }


        $results = $query->get();

        // ✅ ใช้ partial เท่านั้น (ห้ามใช้ view หลัก)
        $html = view(
            "admin.questionnaireout.partials.table",
            compact('results')
        )->render();

        return response()->json(['html' => $html]);

    } else {
        return response()->json(['html' => 'Unauthorized'], 403);
    }
}

public function questionnaireout_detail($id)
{
    try {

        // 🔹 ข้อมูลหลัก
        $data = DB::table('passcours')
            ->join('course_online', 'passcours.passcours_cours', '=', 'course_online.course_id')
            ->leftJoin('users', 'passcours.passcours_user', '=', 'users.id')
            ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
            ->leftJoin('course_score_weight', 'course_online.course_id', '=', 'course_score_weight.course_id')
            ->where('passcours.passcours_id', $id)
            ->select(
                'passcours.passcours_id',
                'course_online.course_title',
                'profiles.firstname',
                'profiles.lastname',
                'course_score_weight.id as weight_id',
                'course_score_weight.q_a_weight',
                'course_score_weight.operate_weight',
                'course_score_weight.assign_weight',
                'course_score_weight.observe_weight'
            )
            ->first();

        // 🔥 ดึง score เก่า
        $scores = DB::table('score_assessment')
                ->where('passcours_id', $id)
                ->where('active', 'y')
                ->get()
                ->keyBy('type_course_score_weight');


        // 🔥 ดึง file เก่า
        $files = DB::table('file_assessment')
                ->where('passcours_id', $id)
                ->where('active', 'y')
                ->get()
                ->keyBy('type_course_score_weight');

        return view(
            'admin.questionnaireout.questionnaireout_detail',
            compact('data', 'scores', 'files')
        );

    } catch (\Exception $e) {

        return $e->getMessage();
    }
}

public function questionnaireout_save(Request $request)
{
    $request->validate([
        'q_a_file'       => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:5120',
        'operate_file'   => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:5120',
        'assign_file'    => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:5120',
        'observe_file'   => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:5120',
    ]);

    DB::beginTransaction();

    try {

        $passcours_id = $request->passcours_id;

        // =====================================================
        // หา course_score_weight
        // =====================================================
        $courseWeight = DB::table('course_score_weight')
            ->join(
                'passcours',
                'passcours.passcours_cours',
                '=',
                'course_score_weight.course_id'
            )
            ->where('passcours.passcours_id', $passcours_id)
            ->select(
                'course_score_weight.id',
                'course_score_weight.q_a_weight',
                'course_score_weight.operate_weight',
                'course_score_weight.assign_weight',
                'course_score_weight.observe_weight'
            )
            ->first();

        if (!$courseWeight) {
            throw new \Exception('ไม่พบข้อมูล course_score_weight');
        }

        $weight_id = $courseWeight->id;

        // =====================================================
        // update passcours
        // =====================================================
        DB::table('passcours')
            ->where('passcours_id', $passcours_id)
            ->update([
                'passcours_status' => 'pass',
                'updated_at' => now()
            ]);

        // =====================================================
        // ปิดข้อมูลเก่า
        // =====================================================
        DB::table('score_assessment')
            ->where('passcours_id', $passcours_id)
            ->where('active', 'y')
            ->update([
                'active' => 'n',
                'updated_at' => now()
            ]);

        DB::table('file_assessment')
            ->where('passcours_id', $passcours_id)
            ->where('active', 'y')
            ->update([
                'active' => 'n',
                'updated_at' => now()
            ]);

        // =====================================================
        // สร้าง type ตาม weight จริง
        // =====================================================
        $types = [];

        if (($courseWeight->q_a_weight ?? 0) > 0) {
            $types[1] = 'q_a';
        }

        if (($courseWeight->operate_weight ?? 0) > 0) {
            $types[2] = 'operate';
        }

        if (($courseWeight->assign_weight ?? 0) > 0) {
            $types[3] = 'assign';
        }

        if (($courseWeight->observe_weight ?? 0) > 0) {
            $types[4] = 'observe';
        }

        // =====================================================
        // upload path
        // =====================================================
        $destinationPath = public_path('images/uploads/assessment_files');

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0775, true);
        }

        // =====================================================
        // loop save
        // =====================================================
        foreach ($types as $type => $prefix) {

            $score  = $request->input($prefix . '_score');
            $remark = $request->input($prefix . '_remark');
            $file   = $request->file($prefix . '_file');

            // =================================================
            // score เดิม
            // =================================================
            $oldScore = DB::table('score_assessment')
                ->where('passcours_id', $passcours_id)
                ->where('type_course_score_weight', $type)
                ->where('active', 'n')
                ->latest('id')
                ->first();

            // =================================================
            // save score ใหม่
            // =================================================
            if (
                ($score !== null && $score !== '')
                || !empty($remark)
            ) {

                DB::table('score_assessment')->insert([
                    'passcours_id'            => $passcours_id,
                    'id_course_score_weight' => $weight_id,
                    'score'                  => $score,
                    'detail'                 => $remark,
                    'type_course_score_weight' => $type,
                    'active'                 => 'y',
                    'created_at'             => now(),
                    'updated_at'             => now()
                ]);

            } else if ($oldScore) {

                // =============================================
                // clone score เดิม
                // =============================================
                DB::table('score_assessment')->insert([
                    'passcours_id'            => $oldScore->passcours_id,
                    'id_course_score_weight' => $oldScore->id_course_score_weight,
                    'score'                  => $oldScore->score,
                    'detail'                 => $oldScore->detail,
                    'type_course_score_weight' => $oldScore->type_course_score_weight,
                    'active'                 => 'y',
                    'created_at'             => now(),
                    'updated_at'             => now()
                ]);
            }

            // =================================================
            // file เดิม
            // =================================================
            $oldFile = DB::table('file_assessment')
                ->where('passcours_id', $passcours_id)
                ->where('type_course_score_weight', $type)
                ->where('active', 'n')
                ->latest('id')
                ->first();

            // =================================================
            // save file ใหม่
            // =================================================
            if ($file) {

                $extension = $file->getClientOriginalExtension();

                $filename = Str::uuid() . '.' . $extension;

                $file->move($destinationPath, $filename);

                DB::table('file_assessment')->insert([
                    'passcours_id'            => $passcours_id,
                    'id_course_score_weight' => $weight_id,
                    'file_name'              => $filename,
                    'type_course_score_weight' => $type,
                    'active'                 => 'y',
                    'created_at'             => now(),
                    'updated_at'             => now()
                ]);

            } else if ($oldFile) {

                // =============================================
                // clone file เดิม
                // =============================================
                DB::table('file_assessment')->insert([
                    'passcours_id'            => $oldFile->passcours_id,
                    'id_course_score_weight' => $oldFile->id_course_score_weight,
                    'file_name'              => $oldFile->file_name,
                    'type_course_score_weight' => $oldFile->type_course_score_weight,
                    'active'                 => 'y',
                    'created_at'             => now(),
                    'updated_at'             => now()
                ]);
            }
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'บันทึกสำเร็จ'
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
}

public function questionnaireout_retest(Request $request){
        if(AuthFacade::useradmin()){

            $query = DB::table('course_online');

                    if ((string) auth()->user()->superuser !== '1') {
                        $query->where('create_by', auth()->user()->id);
                    }

                    $courses = $query->get(); // 👈 สำคัญ

            $results = []; // กัน error หน้าแรก

            return view(
                "admin.questionnaireout.questionnaireout_retest",
                compact('courses', 'results')
            );

        }else{
            return redirect()->route('login.admin');
        }
    }

        public function questionnaireout_assessment_ajax_test(Request $request)
{
    if (AuthFacade::useradmin()) {

       $query = DB::table('coursescore')
    ->join('course_online', 'coursescore.course_id', '=', 'course_online.course_id')
    ->leftJoin('users', 'coursescore.user_id', '=', 'users.id')
    ->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
    ->select(
        'coursescore.course_id',
        'coursescore.user_id',
        'course_online.course_title',
        'profiles.firstname',
        'profiles.lastname'
    )
    ->where('coursescore.active', 'y');

if (!empty($request->course_id)) {
    $query->where('coursescore.course_id', $request->course_id);
}

if (!empty($request->firstname)) {
    $query->where('profiles.firstname', 'like', '%' . $request->firstname . '%');
}

if (!empty($request->lastname)) {
    $query->where('profiles.lastname', 'like', '%' . $request->lastname . '%');
}

$query->groupBy(
    'coursescore.course_id',
    'coursescore.user_id',
    'course_online.course_title',
    'profiles.firstname',
    'profiles.lastname'
);

$results = $query->get();

        // ✅ ใช้ partial เท่านั้น (ห้ามใช้ view หลัก)
        $html = view(
            "admin.questionnaireout.partials.table_test",
            compact('results')
        )->render();

        return response()->json(['html' => $html]);

    } else {
        return response()->json(['html' => 'Unauthorized'], 403);
    }
}

public function questionnaireout_reset_action(Request $request)
{
    DB::table('coursescore')
        ->where('course_id', $request->course_id)
        ->where('user_id', $request->user_id)
        ->where('active', 'y')
        ->update([
            'active' => 'n',
            'update_date' => now()
        ]);

    return response()->json([
        'success' => true
    ]);
}

public function questionnaireout_check_exam(Request $request){
        if (AuthFacade::useradmin()) {

            $query = DB::table('course_online');

                    if ((string) auth()->user()->superuser !== '1') {
                        $query->where('create_by', auth()->user()->id);
                    }

                    $courses = $query->get(); // 👈 สำคัญ

            $results = []; // กัน error หน้าแรก

            return view(
                "admin.questionnaireout.questionnaireout_check_exam",
                compact('courses', 'results')
            );

        } else {
            return redirect()->route('login.admin');
        }
    }

public function questionnaireout_check_exam_ajax(Request $request)
{
    if (AuthFacade::useradmin()) {

$query = DB::table('course_exam_essay_answer as exam')

    ->join(
        'course_online as course',
        'exam.course_id',
        '=',
        'course.course_id'
    )

    ->leftJoin(
        'users as u',
        'exam.user_id',
        '=',
        'u.id'
    )

    ->leftJoin(
        'profiles as p',
        'u.id',
        '=',
        'p.user_id'
    )

    ->leftJoin(
        'question as q',
        'exam.ques_id',
        '=',
        'q.ques_id'
    )

    ->select(
        'exam.course_id',
        'exam.user_id',
        'exam.status',
        'course.course_title',
        'p.firstname',
        'p.lastname',

        DB::raw("
            CASE
                WHEN tbl_exam.status = 'wait' THEN 'รอ'
                WHEN tbl_exam.status = 'pass' THEN 'ผ่าน'
                WHEN tbl_exam.status = 'fail' THEN 'ไม่ผ่าน'
                ELSE '-'
            END as status_text
        ")
    );


// 🔍 เช็คว่ามีการค้นหาไหม
$hasSearch = !empty($request->course_id)
    || !empty(trim($request->firstname))
    || !empty(trim($request->lastname));


// ❌ ถ้าไม่ค้นหา ไม่แสดงข้อมูล
if (!$hasSearch) {

    $query->whereRaw('1 = 0');

}


// 🔍 filter course
if (!empty($request->course_id)) {

    $query->where(
        'exam.course_id',
        $request->course_id
    );

}


// 🔍 filter firstname
if (!empty(trim($request->firstname))) {

    $query->where(
        'p.firstname',
        'like',
        '%' . trim($request->firstname) . '%'
    );

}


// 🔍 filter lastname
if (!empty(trim($request->lastname))) {

    $query->where(
        'p.lastname',
        'like',
        '%' . trim($request->lastname) . '%'
    );

}


// 🔥 group by
$query->groupBy(
    'exam.course_id',
    'exam.user_id',
    'exam.status',
    'course.course_title',
    'p.firstname',
    'p.lastname'
);


// 🔥 เรียงล่าสุด
$query->orderBy('exam.course_id', 'desc');


$results = $query->get();

        // ✅ partial table
        $html = view(
            "admin.questionnaireout.partials.table_exam",
            compact('results')
        )->render();

        return response()->json([
            'html' => $html
        ]);

    } else {

        return response()->json([
            'html' => 'Unauthorized'
        ], 403);
    }
}

public function questionnaireout_check_exam_detail(Request $request)
{
    try {

$data = DB::table('course_exam_essay_answer')

    ->join(
        'course_online',
        'course_exam_essay_answer.course_id',
        '=',
        'course_online.course_id'
    )

    ->leftJoin(
        'users',
        'course_exam_essay_answer.user_id',
        '=',
        'users.id'
    )

    ->leftJoin(
        'profiles',
        'users.id',
        '=',
        'profiles.user_id'
    )

    ->leftJoin(
        'question',
        'course_exam_essay_answer.ques_id',
        '=',
        'question.ques_id'
    )

    ->leftJoin(
        'course_score_weight',
        'course_exam_essay_answer.course_id',
        '=',
        'course_score_weight.course_id'
    )

    // ✅ เพิ่ม join coursescore
    ->leftJoin(
        'coursescore',
        function ($join) {

            $join->on(
                'course_exam_essay_answer.course_id',
                '=',
                'coursescore.course_id'
            );

            $join->on(
                'course_exam_essay_answer.user_id',
                '=',
                'coursescore.user_id'
            );

        }
    )

    ->where(
        'course_exam_essay_answer.course_id',
        $request->course_id
    )

    ->where(
        'course_exam_essay_answer.user_id',
        $request->user_id
    )

    ->select(
        'course_exam_essay_answer.id',

        'course_exam_essay_answer.course_id as course_id',

        'course_exam_essay_answer.user_id as user_id',

        'course_exam_essay_answer.ques_id',

        'course_online.course_title',

        'profiles.firstname',

        'profiles.lastname',

        'question.ques_title',

        'question.answer',

        'course_exam_essay_answer.answer_text',

        'course_score_weight.exam_weight',

        // ✅ เพิ่มคะแนน
        'coursescore.score_number as score'
    )

    ->distinct()

    ->orderBy(
        'course_exam_essay_answer.ques_id',
        'DESC'
    )

    ->get();

        return view(
            'admin.questionnaireout.partials.check_exam_detail',
            compact('data')
        );

    } catch (\Exception $e) {

        return $e->getMessage();
    }
}

public function questionnaireout_check_exam_save(Request $request)
{
    try {

        DB::beginTransaction();

        // =========================
        // คำนวณผลสอบ
        // =========================
        $score = (float) $request->score;

        $scoreTotal = (float) $request->score_total;

        // 🔥 คิดเปอร์เซ็นต์
        $percent = 0;

        if ($scoreTotal > 0) {

            $percent = ($score / $scoreTotal) * 100;

        }

        // 🔥 สถานะผ่าน/ไม่ผ่าน
        $passStatus = $percent >= 70 ? 'pass' : 'fail';


        // =========================
        // update coursescore
        // =========================
        $updated = DB::table('coursescore')
            ->where('course_id', $request->course_id)
            ->where('user_id', $request->user_id)
            ->where('type', '3')
            ->update([

                'score_number' => $score,

                'score_total' => $scoreTotal,

                'score_status' => $passStatus,

                'update_date' => now()

            ]);

        if ($updated == 0) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'ไม่พบข้อมูล coursescore'
            ]);

        }


        // =========================
        // update essay answer
        // =========================
        DB::table('course_exam_essay_answer')
            ->where('course_id', $request->course_id)
            ->where('user_id', $request->user_id)
            ->update([

                'status' => $passStatus,

                'updated_date' => now()

            ]);


        // =========================
        // insert passcours เฉพาะผ่าน
        // =========================
        if ($passStatus == 'pass') {

            DB::table('passcours')->insert([

                'passcours_cours' => $request->course_id,

                'passcours_user' => $request->user_id,

                'passcours_status' => $passStatus,

                'academic_year' => date('Y'),

                'created_at' => now()

            ]);

        }


        DB::commit();

        return response()->json([
            'success' => true,
            'status' => $passStatus
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);

    }
}

}
