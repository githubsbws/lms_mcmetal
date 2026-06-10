<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckTokenValidity;
use App\Http\Middleware\CheckTokenValidityAdmin;
use App\Models\Profiles;
use Illuminate\Http\Request;
use App\Models\Course;

use App\Http\Controllers\EditController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\InsertController;
use App\Http\Controllers\VedioController;
use App\Http\Controllers\UpvedioController;
use App\Http\Middleware\Authenticate;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportLicensePersonController;
use App\Http\Controllers\PersonalAssessmentController;
use App\Http\Controllers\OcrSearchController;
// -------
use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginLController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NewController;
use App\Http\Controllers\UsabilityController;
use App\Http\Controllers\VirtualclassroomController;
use App\Http\Controllers\WebboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\ReportExcelController;
//-------
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseExamController;
use App\Http\Controllers\LicensePersonController;
use App\Http\Controllers\PotentialReportController;
use App\Http\Controllers\RoadmapController;
use App\Http\Controllers\UploadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware([CheckTokenValidity::class])->group(function () {
Route::get('/', [IndexController::class,'index'])->name('index')->middleware('checkIdleTimeout', 'single_login');


Route::get('logins', [LoginController::class,'showLoginForm'])->name('login');

    Route::post('logins', [LoginController::class,'login'])->name('logins')->middleware('single_login');
    Route::post('logout', [LoginController::class,'logout'])->name('logout');


Route::get('registers', [RegisterController::class,'registers'])->name('registers');

Route::post('register', [RegisterController::class,'store'])->name('register');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.forgot');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
Route::get('forgot-pass',[ForgotPasswordController::class,'forgotPass'])->name('forgot.pass');
Route::get('profile',[ProfileController::class,'profile'])->name('profile');
Route::get('repass',[ProfileController::class,'repass'])->name('repass');
Route::post('repass',[ProfileController::class,'repass'])->name('repass');
Route::get('create_profile',[ProfileController::class,'create_profile'])->name('create.profile');
Route::post('create_profile',[ProfileController::class,'create_profile'])->name('create.profile');
// Route::get('/admin', function () {
//     return view('admin/index/index');
// });





// Route::group(['middleware' => ['auth']], function () {
//     Route::get('/admin', 'AdminController@index');
// });
// Route::get('admin', [AdminController::class,'admin'])->name('admin')->middleware('auth');
//----- ในส่วนของหน้า Bank
// รายชื่อธนาคาร
Route::get('bank', [AdminController::class,'bank'])->name('bank')->middleware('auth');
// ข้อมูลผู้ใช้
Route::get('/user', [AdminController::class,'user'])->name('user');
// ลบ VDO
Route::get('del/{id}',[AdminController::class,'del'])->name('del');

//----- ในส่วนของหน้า Insert
// ส่งเพิ่มข้อมูล
Route::post('insert',[InsertController::class,'insert'])->name('insert');

//----- ในส่วนของหน้า vdo
Route::get('vedio/{id}',[VedioController::class,'vedio'])->name('vedio');
// เพิ่ม vedio
Route::post('/vedio/vedio_in',[VedioController::class,'vedioIn'])->name('vedio.vedio_in');

//----- ในส่วนของหน้า up_vdo
Route::get('up_vedio/{id}',[UpvedioController::class,'up_vedio'])->name('up_vedio');
// เพิ่ม vedio
Route::post('/up_vedio/up_vedio_in',[UpvedioController::class,'vedioInUp'])->name('up_vedio.up_vedio_in');


//----- ในส่วนของหน้า Login
// หน้า login
// Route::get('login',[LoginController::class,'login'])->name('login');
// // ส่งตรวจสอบ
// Route::post('login_in',[LoginController::class,'login_in'])->name('login_in');
// // ออกจาระบบ
// Route::get('logout',[LoginController::class,'logout'])->name('logout');

// ------------------------------------------
// ----- login
Route::get('/login/login',[LoginLController::class,'loginL'])->name('login.login');
Route::post('/lms_brother_docker/lms/app/index/user/login',[LoginLController::class,'login_to'])->name('login_to');
Route::get('logout_t',[LoginLController::class,'logout_t'])->name('logout_t');
// ----- index
Route::get('index/my',[IndexController::class,'index'])->name('index');
// ----- Forgot
Route::post('/lms_brother_docker/lms/app/index/user/recovery',[ForgotController::class,'forgotRecovery'])->name('forgot.recovery');
// ----- course
Route::get('course',[CourseController::class,'course'])->name('course')->middleware('checkIdleTimeout');
//เข้าหน้าสอบ
Route::get('course/exam/multiple/{course_id}', [CourseExamController::class, 'multipleExam'])->name('course.exam.multiple')->middleware('checkIdleTimeout');
Route::get('course/exam/essay/{course_id}', [CourseExamController::class, 'essayExam'])->name('course.exam.essay')->middleware('checkIdleTimeout');
//บันทึกการสอบ
Route::post('course/exam/multiple/submit/{course_id}', [CourseExamController::class, 'multipleExamSubmit'])->name('course.exam.submit-multiple')->middleware('checkIdleTimeout');
Route::post('course/exam/essay/submit/{course_id}', [CourseExamController::class, 'essayExamSubmit'])->name('course.exam.submit-essay')->middleware('checkIdleTimeout');
//กรณีไม่มี ข้อสอบให้บันทึกเลย
Route::post('course/complete/{course_id}', [CourseController::class, 'courseComplete'])->name('course.complete')->middleware('checkIdleTimeout');
//หน้าเรียน
Route::prefix('course/learning')
    ->middleware(['checkIdleTimeout']) // รวม Middleware ไว้ที่ Group
    ->group(function () {

        // 1. Specific Path (ต้องอยู่บนสุดเสมอ)
        Route::get('video-stream/{file_id}', [CourseController::class, 'streamVideo'])
            ->name('course.videostream')
            ->whereNumber('file_id'); // Defensive: บังคับให้เป็นตัวเลขเท่านั้น

        // 2. Generic Path (Wildcards)
        Route::get('{id}/{file_id}', [CourseController::class, 'lessonLearn'])
            ->name('course.lessonLearn')
            ->whereNumber(['id', 'file_id']); // Defensive: ป้องกันการรับ String เข้ามาปน
});

Route::get('course/question/{group}',[CourseController::class,'coursequestion'])->name('course.question')->middleware('checkIdleTimeout');
Route::get('course/images', [CourseController::class, 'store'])->name('images.store')->middleware('checkIdleTimeout');
Route::post('course/images', [CourseController::class, 'store'])->name('images.store')->middleware('checkIdleTimeout');
// Route::get('download/learn-file-doc',[CourseController::class,'downloadfile'])->name('course.downloadfile')->middleware('checkIdleTimeout');
Route::post('course/doc/progress', [CourseController::class, 'markDocProgress'])->name('course.doc.progress')->middleware('checkIdleTimeout');

// เปิด PDF viewer อย่างเดียว
Route::get('/course/viewfile', [CourseController::class, 'viewfile'])->name('course.viewfile')->middleware('checkIdleTimeout');
// stream PDF ให้ PDF.js
Route::get('/course/pdf-stream', [CourseController::class, 'pdfStream'])->name('course.pdfstream')->middleware('checkIdleTimeout');
Route::post('course/reset/{course_id}', [CourseController::class, 'courseReset'])->name('course.reset')->middleware('checkIdleTimeout');
// choice
Route::post('/choiceAnswer/{id}',[ChoiceController::class,'choiceAnswer'])->name('choice.Answer')->middleware('checkIdleTimeout');
// ----- dashboard
Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard')->middleware('checkIdleTimeout');

Route::get('download',[DownloadController::class,'download'])->name('download')->middleware('checkIdleTimeout');
Route::get('downloads/{id}',[DownloadController::class,'downloadfiles'])->name('download.downloadfiles')->middleware('checkIdleTimeout');
// ----- faq
Route::get('faq_f',[FaqController::class,'faq_front'])->name('faq_front')->middleware('checkIdleTimeout');
Route::get('faq_f_seach', [FaqController::class, 'faq_front'])->middleware('checkIdleTimeout');
// ----- Forgot
Route::get('forgot/pass',[ForgotController::class,'forgotPass'])->name('forgot.pass')->middleware('checkIdleTimeout');
// ----- index
Route::get('index',[IndexController::class,'index'])->name('index')->middleware('checkIdleTimeout')->middleware('single_login');
// ----- login
// Route::get('logins',[LoginLController::class,'loginL'])->name('loginL.login');

// ----- new
Route::get('new',[NewController::class,'new'])->name('new')->middleware('checkIdleTimeout');
Route::get('new_detail/{id}',[NewController::class,'new_detail'])->name('new_detail')->middleware('checkIdleTimeout');
Route::get('new_search', [NewController::class, 'new'])->middleware('checkIdleTimeout');
// ----- usability
Route::get('usability_front',[UsabilityController::class,'usability_front'])->name('usability_front')->middleware('checkIdleTimeout');
// ----- virtualclassroom
Route::get('virtualclassroom',[VirtualclassroomController::class,'virtualclassroom'])->name('virtualclassroom')->middleware('checkIdleTimeout');
// ----- WebboardController
Route::get('about',[AboutController::class,'about'])->name('about')->middleware('checkIdleTimeout');

Route::get('conditions',[ConditionController::class,'conditions'])->name('conditions')->middleware('checkIdleTimeout');

Route::get('/site/contactus',[ContactusController::class,'contactus'])->name('site.contactus')->middleware('checkIdleTimeout');
// Route::get('contactus_f',[ContactusController::class,'contactus_f'])->name('contactus_f')->middleware('checkIdleTimeout');
// Route::post('contactus_f',[ContactusController::class,'contactus_f'])->name('contactus_f')->middleware('checkIdleTimeout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('checkIdleTimeout');

Route::get('/ocr/search', [OcrSearchController::class, 'search']);
Route::get('/ocr/file/{ocrFileId}', [OcrSearchController::class, 'showPdf']);
});

// ----- admin src
Route::middleware([CheckTokenValidityAdmin::class])->group(function () {
Route::get('admin',[AdminController::class,'admin'])->name('admin')->middleware('checkIdleTimeout');
Route::get('loginadmin',[AdminController::class,'loginadmin'])->name('login.admin');
Route::post('loginadmin',[AdminController::class,'loginadmin'])->name('login.admin');
// Route::post('loginadmin',[AdminController::class,'loginadmin'])->name('login.admin')->middleware('recaptcha');
Route::get('logoutadmin', [AdminController::class,'logoutadmin'])->name('logout.admin');
Route::get('/aboutus',[AdminController::class,'aboutus'])->name('aboutus')->middleware('checkIdleTimeout');
Route::get('aboutus_create',[AdminController::class,'aboutus_create'])->name('aboutus.create')->middleware('checkIdleTimeout');
Route::post('aboutus_create',[AdminController::class,'aboutus_create'])->name('aboutus.create')->middleware('checkIdleTimeout');

Route::get('aboutus_detail/{id}',[AdminController::class,'aboutus_detail'])->name('aboutus.detail')->middleware('checkIdleTimeout');
Route::get('aboutus_update/{id}',[AdminController::class,'aboutus_update'])->name('aboutus.update')->middleware('checkIdleTimeout');
Route::post('aboutus_update/{id}',[AdminController::class,'aboutus_update'])->name('aboutus.update')->middleware('checkIdleTimeout');
Route::post('aboutus_delete/{id}',[AdminController::class,'aboutus_delete'])->name('aboutus.delete')->middleware('checkIdleTimeout');

Route::get('/condition',[AdminController::class,'condition'])->name('condition')->middleware('checkIdleTimeout');
Route::get('condition_detail/{id}',[AdminController::class,'condition_detail'])->name('condition.detail')->middleware('checkIdleTimeout');
Route::get('condition_update/{id}',[AdminController::class,'condition_update'])->name('condition.update')->middleware('checkIdleTimeout');
Route::post('condition_update/{id}',[AdminController::class,'condition_update'])->name('condition.update')->middleware('checkIdleTimeout');

Route::get('/setting',[AdminController::class,'setting'])->name('setting')->middleware('checkIdleTimeout');
Route::post('setting_update/{id}',[AdminController::class,'setting_update'])->name('setting.update')->middleware('checkIdleTimeout');

Route::get('/contactus',[AdminController::class,'contactus'])->name('contactus')->middleware('checkIdleTimeout');
Route::get('contactus_create',[AdminController::class,'contactus_create'])->name('contactus_create')->middleware('checkIdleTimeout');
Route::get('contactus_view/{id}',[AdminController::class,'contactus_view'])->name('contactus.view')->middleware('checkIdleTimeout');

Route::get('/contactus_create',[AdminController::class,'contactus_create'])->name('contactus_create')->middleware('checkIdleTimeout');

Route::post('/contactus_insert',[AdminController::class,'contactus_insert'])->name('contactus_insert')->middleware('checkIdleTimeout');

Route::get('/contactus_edit_page/{id}',[AdminController::class,'contactus_edit_page'])->name('contactus.edit_page')->middleware('checkIdleTimeout');
Route::post('/contactus_edit_page/{id}',[AdminController::class,'contactus_edit_page'])->name('contactus.edit_page')->middleware('checkIdleTimeout');

Route::post('/contactus_edit/{id}',[AdminController::class,'contactus_edit'])->name('contactus_edit')->middleware('checkIdleTimeout');

Route::post('/contactus_delete/{id}',[AdminController::class,'contactus_delete'])->name('contactus_delete')->middleware('checkIdleTimeout');

//  new p
Route::get('/video_create',[AdminController::class,'video_create'])->name('video_create')->middleware('checkIdleTimeout');
Route::get('/video',[AdminController::class,'video'])->name('video')->middleware('checkIdleTimeout');
Route::get('video_detail/{vdo_id}',[AdminController::class,'video_detail'])->name('video.detail')->middleware('checkIdleTimeout');
Route::post('/video_insert',[AdminController::class,'video_insert'])->name('video_insert')->middleware('checkIdleTimeout');
Route::get('/video_edit/{vdo_id}',[AdminController::class,'video_edit'])->name('video_edit')->middleware('checkIdleTimeout');
Route::post('/video_update/{vdo_id}',[AdminController::class,'video_update'])->name('video_update')->middleware('checkIdleTimeout');
Route::post('/video_delete/{vdo_id}',[AdminController::class,'video_delete'])->name('video_delete')->middleware('checkIdleTimeout');
Route::get('/video_sort',[AdminController::class,'video_sort'])->name('video.sort')->middleware('checkIdleTimeout');
//

//---- category
Route::get('/category',[AdminController::class,'category'])->name('category')->middleware('checkIdleTimeout');

Route::get('category_create',[AdminController::class,'category_create'])->name('category.create')->middleware('checkIdleTimeout');
Route::post('category_create',[AdminController::class,'category_create'])->name('category.create')->middleware('checkIdleTimeout');

Route::get('category_detail/{id}',[AdminController::class,'category_detail'])->name('category.detail')->middleware('checkIdleTimeout');

Route::get('category_edit/{id}',[AdminController::class,'category_edit'])->name('category.edit')->middleware('checkIdleTimeout');
Route::post('category_edit/{id}',[AdminController::class,'category_edit'])->name('category.edit')->middleware('checkIdleTimeout');

Route::post('category_delete/{id}',[AdminController::class,'category_delete'])->name('category.delete')->middleware('checkIdleTimeout');

Route::get('category_openshow/{id}',[AdminController::class,'category_openshow'])->name('category.openshow')->middleware('checkIdleTimeout');

//---- end category

//---- courseoline
Route::get('courseonline',[AdminController::class,'courseonline'])->name('courseonline')->middleware('checkIdleTimeout');
Route::get('courseonline_create',[AdminController::class,'courseonline_create'])->name('courseonline.create')->middleware('checkIdleTimeout');
Route::post('courseonline_create',[AdminController::class,'courseonline_create'])->name('courseonline.create')->middleware('checkIdleTimeout');

Route::get('teacher_create',[AdminController::class,'teacher_create'])->name('teacher.create')->middleware('checkIdleTimeout');
Route::post('teacher_create',[AdminController::class,'teacher_create'])->name('teacher.create')->middleware('checkIdleTimeout');
Route::get('teacher_edit/{id}',[AdminController::class,'teacher_edit'])->name('teacher.edit')->middleware('checkIdleTimeout');
Route::post('teacher_edit/{id}',[AdminController::class,'teacher_edit'])->name('teacher.edit')->middleware('checkIdleTimeout');
Route::post('teacher_delete/{id}',[AdminController::class,'teacher_delete'])->name('teacher.delete')->middleware('checkIdleTimeout');

Route::get('courseonline_detail/{id}',[AdminController::class,'courseonline_detail'])->name('courseonline.detail')->middleware('checkIdleTimeout');

Route::get('courseonline_edit/{id}',[AdminController::class,'courseonline_edit'])->name('courseonline.edit')->middleware('checkIdleTimeout');
Route::post('courseonline_edit/{id}',[AdminController::class,'courseonline_edit'])->name('courseonline.edit')->middleware('checkIdleTimeout');

Route::post('courseonline_delete/{id}',[AdminController::class,'courseonline_delete'])->name('courseonline.delete')->middleware('checkIdleTimeout');

//---- end courseoline

//---- lesson
Route::get('/lesson',[AdminController::class,'lesson'])->name('lesson')->middleware('checkIdleTimeout');
Route::get('lesson_search',[AdminController::class,'lesson'])->name('lesson.search')->middleware('checkIdleTimeout');

Route::get('lesson_edit/{id}',[AdminController::class,'lesson_edit'])->name('lesson.edit')->middleware('checkIdleTimeout');
Route::post('lesson_edit/{id}',[AdminController::class,'lesson_edit'])->name('lesson.edit')->middleware('checkIdleTimeout');

Route::get('lesson_create',[AdminController::class,'lesson_create'])->name('lesson.create')->middleware('checkIdleTimeout');
Route::post('lesson_create',[AdminController::class,'lesson_create'])->name('lesson.create')->middleware('checkIdleTimeout');

Route::get('lesson_detail/{id}',[AdminController::class,'lesson_detail'])->name('lesson.detail')->middleware('checkIdleTimeout');

Route::post('lesson_delete/{id}',[AdminController::class,'lesson_delete'])->name('lesson.delete')->middleware('checkIdleTimeout');

Route::post('lesson_delete_video/{id}',[AdminController::class,'lesson_delete_video'])->name('lesson_video.delete')->middleware('checkIdleTimeout');

Route::post('lesson_move',[AdminController::class,'lesson_move'])->name('lesson.move')->middleware('checkIdleTimeout');

Route::get('downloadlesson/{id}',[AdminController::class,'downloadfile'])->name('lesson.downloadfile')->middleware('checkIdleTimeout');

Route::get('filemanagers/{id?}', [AdminController::class,'filemanagers'])->name('filemanagers')->middleware('checkIdleTimeout');

Route::get('file_edit/{id?}', [AdminController::class,'file_edit'])->name('file.edit')->middleware('checkIdleTimeout');

Route::post('file_delete/{id?}', [AdminController::class,'file_delete'])->name('file_delete')->middleware('checkIdleTimeout');

Route::post('/file/sort', [AdminController::class, 'sort'])->name('file.sort');

Route::post('/upload/chunk', [UploadController::class, 'uploadChunk'])->name('upload.chunk')->middleware('checkIdleTimeout');
Route::post('/upload/merge', [UploadController::class, 'mergeChunks'])->name('upload.merge')->middleware('checkIdleTimeout');

// Route::get('/lession-create',[LessonController::class,'lessioncreate'])->name('lession-create');
// Route::post('/admin/index.php/Lesson/create',[LessonController::class,'lessioncreateto'])->name('lession-create-to');
// Route::get('/admin/index.php/lesson/update/{id}',[LessonController::class,'lessionedit'])->name('lession-edit');
// Route::post('/admin/index.php/lesson/edit/{id}',[LessonController::class,'lessioneditto'])->name('lession-edit-to');
// Route::get('/admin/index.php/lesson/change/{id}',[LessonController::class,'lessionchange'])->name('lession-change');
// Route::get('/admin/index.php/lesson/{id}',[LessonController::class,'lessiondet'])->name('lession-det');
//----end lesson

Route::get('grouptesting/{id?}/{type?}',[AdminController::class,'grouptesting'])->name('grouptesting')->middleware('checkIdleTimeout');

Route::get('grouptesting_plan/{id?}/{type?}',[AdminController::class,'grouptesting_plan'])->name('grouptesting.plan')->middleware('checkIdleTimeout');
Route::post('grouptesting_plan/{id?}/{type?}',[AdminController::class,'grouptesting_plan'])->name('grouptesting.plan')->middleware('checkIdleTimeout');

Route::post('grouptesting_plan_delete/{id?}',[AdminController::class,'grouptesting_plan_delete'])->name('grouptesting_plan.delete')->middleware('checkIdleTimeout');

Route::get('/grouptesting_create',[AdminController::class,'grouptesting_create'])->name('grouptesting_create')->middleware('checkIdleTimeout');
Route::post('/grouptesting_create',[AdminController::class,'grouptesting_create'])->name('grouptesting_create')->middleware('checkIdleTimeout');

Route::get('/group_question_create/{id?}',[AdminController::class,'group_question_create'])->name('group_question.create')->middleware('checkIdleTimeout');
Route::post('/group_question_create/{id?}',[AdminController::class,'group_question_create'])->name('group_question.create')->middleware('checkIdleTimeout');

Route::get('/group_question/{id?}',[AdminController::class,'group_question'])->name('group_question')->middleware('checkIdleTimeout');

Route::get('/group_question_detail/{id?}',[AdminController::class,'group_question_detail'])->name('ques.detail')->middleware('checkIdleTimeout');

Route::get('/group_question_edit/{id?}',[AdminController::class,'group_question_edit'])->name('ques.edit')->middleware('checkIdleTimeout');

Route::post('/group_question_edit/{id?}',[AdminController::class,'group_question_edit'])->name('ques.edit')->middleware('checkIdleTimeout');

Route::post('/group_question_delete/{id?}',[AdminController::class,'group_question_delete'])->name('ques.delete')->middleware('checkIdleTimeout');

Route::get('/group_question_excel/{id}',[AdminController::class,'group_question_excel'])->name('ques.excel')->middleware('checkIdleTimeout');
Route::post('/group_question_excel/{id}',[AdminController::class,'group_question_excel'])->name('ques.excel')->middleware('checkIdleTimeout');

Route::get('/create-question/{id}', [AdminController::class, 'questions_create'])->name('questions.create')->middleware('checkIdleTimeout');
Route::post('/store-question/{id}', [AdminController::class, 'questions_store'])->name('questions.store')->middleware('checkIdleTimeout');

Route::get('/edit_question/{id}', [AdminController::class, 'questions_edit'])->name('questions.edit');
Route::post('/update_question/{id}', [AdminController::class, 'questions_update'])->name('questions.update');

Route::get('/grouptesting_edit/{id}',[AdminController::class,'grouptesting_edit'])->name('grouptesting.edit')->middleware('checkIdleTimeout');
Route::post('/grouptesting_edit/{id}',[AdminController::class,'grouptesting_edit'])->name('grouptesting.edit')->middleware('checkIdleTimeout');

Route::post('/grouptesting_delete/{id}',[AdminController::class,'grouptesting_delete'])->name('grouptesting.delete')->middleware('checkIdleTimeout');

Route::get('/grouptesting_detail/{id}',[AdminController::class,'grouptesting_detail'])->name('grouptesting.detail')->middleware('checkIdleTimeout');

Route::get('coursegrouptesting/{id?}',[AdminController::class,'coursegrouptesting'])->name('coursegrouptesting')->middleware('checkIdleTimeout');

Route::get('coursegrouptesting_plan/{id?}',[AdminController::class,'coursegrouptesting_plan'])->name('coursegrouptesting.plan')->middleware('checkIdleTimeout');

Route::get('coursegrouptesting_create',[AdminController::class,'coursegrouptesting_create'])->name('coursegrouptesting.create')->middleware('checkIdleTimeout');
Route::post('coursegrouptesting_create',[AdminController::class,'coursegrouptesting_create'])->name('coursegrouptesting.create')->middleware('checkIdleTimeout');

//new p
Route::get('/questionnaireout',[AdminController::class,'questionnaireout'])->name('questionnaireout')->middleware('checkIdleTimeout');

Route::get('/questionnaireout_excel',[AdminController::class,'questionnaireout_excel'])->name('questionnaireout.excel')->middleware('checkIdleTimeout');
Route::post('/questionnaireout_excel',[AdminController::class,'questionnaireout_excel'])->name('questionnaireout.excel')->middleware('checkIdleTimeout');

Route::get('/questionnaireout_assessment',[AdminController::class,'questionnaireout_assessment'])->name('questionnaireout.assessment')->middleware('checkIdleTimeout');
Route::get('/questionnaireout_assessment/ajax',[AdminController::class,'questionnaireout_assessment_ajax'])->name('questionnaireout.assessment.ajax')->middleware('checkIdleTimeout');
Route::get('/questionnaireout_detail/{id}', [AdminController::class, 'questionnaireout_detail'])->name('questionnaireout.detail')->middleware('checkIdleTimeout');
Route::post('/questionnaireout_save', [AdminController::class, 'questionnaireout_save'])->name('questionnaireout_save')->middleware('checkIdleTimeout');

// Route::get('/questionnaireout_result',[AdminController::class,'questionnaireout_result'])->name('questionnaireout.result')->middleware('checkIdleTimeout');
// Route::post('/questionnaireout_result',[AdminController::class,'questionnaireout_result'])->name('questionnaireout.result')->middleware('checkIdleTimeout');
Route::get('/questionnaireout_retest',[AdminController::class,'questionnaireout_retest'])->name('questionnaireout.retest')->middleware('checkIdleTimeout');
Route::get('/questionnaireout_assessment/ajax_test',[AdminController::class,'questionnaireout_assessment_ajax_test'])->name('questionnaireout.assessment.ajax_test')->middleware('checkIdleTimeout');
Route::post('/questionnaireout_reset_action',[AdminController::class, 'questionnaireout_reset_action'])->name('questionnaireout.reset.action');

Route::get('/questionnaireout_exam/{id}',[AdminController::class,'questionnaireout_exam'])->name('questionnaireout.exam')->middleware('checkIdleTimeout');
Route::post('/questionnaireout_exam/{id}',[AdminController::class,'questionnaireout_exam'])->name('questionnaireout.Answer')->middleware('checkIdleTimeout');

Route::get('/questionnaireout_check_exam',[AdminController::class,'questionnaireout_check_exam'])->name('questionnaireout.check.exam')->middleware('checkIdleTimeout');
Route::get('/questionnaireout_check_exam/ajax',[AdminController::class,'questionnaireout_check_exam_ajax'])->name('questionnaireout.check.exam.ajax')->middleware('checkIdleTimeout');
Route::post('/questionnaireout_check_exam/{id}',[AdminController::class,'questionnaireout_check_exam'])->name('questionnaireout.check.exam')->middleware('checkIdleTimeout');
Route::get('/questionnaireout_check_exam_detail',[AdminController::class, 'questionnaireout_check_exam_detail'])->name('questionnaireout.check.exam.detail');
Route::post('/questionnaireout_check_exam_save',[AdminController::class, 'questionnaireout_check_exam_save'])->name('questionnaireout.check.exam.save');

Route::get('/questionnaireout_plan/{id?}',[AdminController::class,'questionnaireout_plan'])->name('questionnaireout.plan')->middleware('checkIdleTimeout');
Route::post('/questionnaireout_plan/{id?}/{header_id?}',[AdminController::class,'questionnaireout_plan'])->name('questionnaireout.plan')->middleware('checkIdleTimeout');

Route::get('/questionnaireout_create',[AdminController::class,'questionnaireout_create'])->name('questionnaireout_create')->middleware('checkIdleTimeout');
Route::post('/questionnaireout_create',[AdminController::class,'questionnaireout_create'])->name('questionnaireout.create')->middleware('checkIdleTimeout');
Route::post('/questionnaireout_insert',[AdminController::class,'questionnaireout_insert'])->name('questionnaireout_insert')->middleware('checkIdleTimeout');
Route::get('/questionnaireout_edit/{survey_header_id}',[AdminController::class,'questionnaireout_edit'])->name('questionnaireout_edit')->middleware('checkIdleTimeout');
Route::post('/questionnaireout_update/{survey_header_id}',[AdminController::class,'questionnaireout_update'])->name('questionnaireout_update')->middleware('checkIdleTimeout');
Route::post('/questionnaireout_delete/{survey_header_id}',[AdminController::class,'questionnaireout_delete'])->name('questionnaireout_delete')->middleware('checkIdleTimeout');
//

//new p
Route::get('/orgchart',[AdminController::class,'orgchart'])->name('orgchart')->middleware('checkIdleTimeout');
Route::post('/orgchart',[AdminController::class,'orgchart'])->name('orgchart')->middleware('checkIdleTimeout');

Route::get('/orgchart_ifram',[AdminController::class,'orgchart_ifram'])->name('orgchart.ifram')->middleware('checkIdleTimeout');
Route::post('/orgchart_ifram', [AdminController::class,'orgchart_ifram'])->name('orgchart.ifram.post')->middleware('checkIdleTimeout');

Route::post('/orgchart_new',[AdminController::class,'orgchart_new'])->name('orgchart.new')->middleware('checkIdleTimeout');

Route::post('/orgchart_delete',[AdminController::class,'orgchart_delete'])->name('orgchart.delete')->middleware('checkIdleTimeout');

Route::post('/orgchart_edit',[AdminController::class,'orgchart_edit'])->name('orgchart.edit')->middleware('checkIdleTimeout');

Route::get('/orgchart_saveorgchart',[AdminController::class,'orgchart_saveorgchart'])->name('orgchart.saveorgchart')->middleware('checkIdleTimeout');
Route::post('/orgchart_saveorgchart',[AdminController::class,'orgchart_saveorgchart'])->name('orgchart.saveorgchart')->middleware('checkIdleTimeout');

Route::get('/orgchart_users/{org_id}',[AdminController::class,'orgchart_users'])->name('orgchart.users')->middleware('checkIdleTimeout');
Route::post('/orgchart_adduser/{org_id}',[AdminController::class,'orgchart_adduser'])->name('orgchart.adduser')->middleware('checkIdleTimeout');
Route::post('/orgchart_unuser/{org_id}',[AdminController::class,'orgchart_unuser'])->name('orgchart.unuser')->middleware('checkIdleTimeout');
Route::get('orgchart_users_search/{org_id}', [AdminController::class, 'orgchart_users'])->name('orgchart.search');
Route::get('orgchart_users_searchuser/{org_id}', [AdminController::class, 'orgchart_users'])->name('orgchart.searchuser');

Route::get('/orgchart_unactive/{id}/{org_id}',[AdminController::class,'orgchart_unactive'])->name('orgchart.unactive')->middleware('checkIdleTimeout');
Route::get('/orgchart_active/{id}/{org_id}',[AdminController::class,'orgchart_active'])->name('orgchart.active')->middleware('checkIdleTimeout');

Route::get('/orgchart_control/{id}',[AdminController::class,'orgchart_control'])->name('orgchart.control')->middleware('checkIdleTimeout');
Route::get('orgchart_course/{id}/{course_title}',[AdminController::class,'orgchart_course'])->name('orgchart.course')->middleware('checkIdleTimeout');
Route::post('orgchart_course/{id}',[AdminController::class,'orgchart_course'])->name('orgchart.course')->middleware('checkIdleTimeout');
Route::post('/orgchart/save-nested', [AdminController::class, 'saveNestedCourses'])->name('orgchart.saveNested');
Route::post('/orgchart_y/{id}',[AdminController::class,'orgchart_y'])->name('orgchart.y')->middleware('checkIdleTimeout');
Route::post('/orgchart_n/{id}',[AdminController::class,'orgchart_n'])->name('orgchart.n')->middleware('checkIdleTimeout');


// Route::get('/orgchart_create',[AdminController::class,'orgchart_create'])->name('orgchart_create');
// Route::post('/orgchart_insert',[AdminController::class,'orgchart_insert'])->name('orgchart_insert');
// Route::get('/orgchart_edit/{orgchart_id}',[AdminController::class,'orgchart_edit'])->name('orgchart_edit');
// Route::post('/orgchart_update/{orgchart_id}',[AdminController::class,'orgchart_update'])->name('orgchart_update');
// Route::get('/orgchart_delete/{orgchart_id}',[AdminController::class,'orgchart_delete'])->name('orgchart_delete');
//

Route::get('/checklecture',[AdminController::class,'checklecture'])->name('checklecture')->middleware('checkIdleTimeout');

Route::get('/coursecheck',[AdminController::class,'coursecheck'])->name('coursecheck')->middleware('checkIdleTimeout');

Route::get('/certificate',[AdminController::class,'certificate'])->name('certificate')->middleware('checkIdleTimeout');

Route::get('/signnature',[AdminController::class,'signnature'])->name('signnature')->middleware('checkIdleTimeout');

Route::get('/captcha',[AdminController::class,'captcha'])->name('captcha')->middleware('checkIdleTimeout');

Route::get('/usability',[AdminController::class,'usability'])->name('usability')->middleware('checkIdleTimeout');

Route::get('usability_detail/{id}',[AdminController::class,'usability_detail'])->name('usability.detail')->middleware('checkIdleTimeout');

Route::get('usability_edit/{id}',[AdminController::class,'usability_edit'])->name('usability.edit')->middleware('checkIdleTimeout');
Route::post('usability_edit/{id}',[AdminController::class,'usability_edit'])->name('usability.edit')->middleware('checkIdleTimeout');

Route::get('usability_create',[AdminController::class,'usability_create'])->name('usability.create')->middleware('checkIdleTimeout');
Route::post('usability_create',[AdminController::class,'usability_create'])->name('usability.create')->middleware('checkIdleTimeout');

Route::get('usability_delete',[AdminController::class,'usability_delete'])->name('usability.delete')->middleware('checkIdleTimeout');
Route::post('usability_delete/{id}', [AdminController::class, 'usability_delete'])->name('usability.delete');

Route::get('/reportproblem',[AdminController::class,'reportproblem'])->name('reportproblem')->middleware('checkIdleTimeout');

Route::get('/reportproblem_detail/{id}',[AdminController::class,'reportproblem_detail'])->name('reportproblem.detail')->middleware('checkIdleTimeout');

Route::get('/reportproblem_edit/{id}',[AdminController::class,'reportproblem_edit'])->name('reportproblem.edit')->middleware('checkIdleTimeout');
Route::post('/reportproblem_edit/{id}',[AdminController::class,'reportproblem_edit'])->name('reportproblem.edit')->middleware('checkIdleTimeout');


Route::get('/faqtype',[AdminController::class,'faqtype'])->name('faqtype')->middleware('checkIdleTimeout');

Route::get('faqtype_detail/{id}',[AdminController::class,'faqtype_detail'])->name('faqtype.detail')->middleware('checkIdleTimeout');

Route::get('/faqtype_create',[AdminController::class,'faqtype_create'])->name('faqtype_create')->middleware('checkIdleTimeout');

Route::post('/faqtype_insert',[AdminController::class,'faqtype_insert'])->name('faqtype_insert')->middleware('checkIdleTimeout');

Route::get('/faqtype_edit_page/{id}',[AdminController::class,'faqtype_edit_page'])->name('faqtype_edit_page')->middleware('checkIdleTimeout');

Route::post('/faqtype_edit/{id}',[AdminController::class,'faqtype_edit'])->name('faqtype_edit')->middleware('checkIdleTimeout');

Route::post('/faqtype_delete/{id}',[AdminController::class,'faqtype_delete'])->name('faqtype_delete')->middleware('checkIdleTimeout');

Route::get('/learnreset_resetuser',[AdminController::class,'learnreset_resetuser'])->name('learnreset_resetuser')->middleware('checkIdleTimeout');

Route::get('/learnreset_resetuser_insert',[AdminController::class,'learnreset_resetuser_insert'])->name('learnreset_resetuser_insert')->middleware('checkIdleTimeout');

Route::get('/faq',[AdminController::class,'faq'])->name('faq')->middleware('checkIdleTimeout');
Route::get('faq_detail/{id}',[AdminController::class,'faq_detail'])->name('faq.detail')->middleware('checkIdleTimeout');

Route::get('/faq_create',[AdminController::class,'faq_create'])->name('faq_create')->middleware('checkIdleTimeout');

Route::post('/faq_insert',[AdminController::class,'faq_insert'])->name('faq_insert')->middleware('checkIdleTimeout');

Route::get('/faq_edit_page/{id}',[AdminController::class,'faq_edit_page'])->name('faq_edit_page')->middleware('checkIdleTimeout');
Route::post('faq_edit_page/{id}',[AdminController::class,'faq_edit_page'])->name('faq.edit')->middleware('checkIdleTimeout');

Route::post('/faq_edit/{id}',[AdminController::class,'faq_edit'])->name('faq_edit')->middleware('checkIdleTimeout');

Route::post('/faq_delete/{id}',[AdminController::class,'faq_delete'])->name('faq_delete')->middleware('checkIdleTimeout');
// new p
Route::get('/adminuser',[AdminController::class,'adminuser'])->name('adminuser')->middleware('checkIdleTimeout');
Route::post('/adminuser_insert',[AdminController::class,'adminuser_insert'])->name('adminuser_insert')->middleware('checkIdleTimeout');
Route::post('/adminuser_update/{id}',[AdminController::class,'adminuser_update'])->name('adminuser_update')->middleware('checkIdleTimeout');
Route::post('/adminuser_delete/{id}',[AdminController::class,'adminuser_delete'])->name('adminuser_delete')->middleware('checkIdleTimeout');
Route::get('/adminuser_edit/{id}',[AdminController::class,'adminuser_edit'])->name('adminuser_edit')->middleware('checkIdleTimeout');
Route::post('/adminuser_cancle/{id}',[AdminController::class,'adminuser_cancle'])->name('adminuser_cancle')->middleware('checkIdleTimeout');
//


Route::post('/adminuser_permission_insert/{id}',[AdminController::class,'adminuser_permission_insert'])->name('permission_insert')->middleware('checkIdleTimeout');
Route::get('/adminuser_permission_add/{id}',[AdminController::class,'adminuser_permission_add'])->name('permission_add')->middleware('checkIdleTimeout');
// new p
Route::get('/pgroup',[AdminController::class,'pgroup'])->name('pgroup')->middleware('checkIdleTimeout');
Route::get('/pgroup_create',[AdminController::class,'pgroup_create'])->name('pgroup_create')->middleware('checkIdleTimeout');
Route::post('/pgroup_insert',[AdminController::class,'pgroup_insert'])->name('pgroup_insert')->middleware('checkIdleTimeout');
Route::post('/pgroup_update/{pgroup_id}',[AdminController::class,'pgroup_update'])->name('pgroup_update')->middleware('checkIdleTimeout');
Route::post('/pgroup_delete/{pgroup_id}',[AdminController::class,'pgroup_delete'])->name('pgroup_delete')->middleware('checkIdleTimeout');
Route::get('/pgroup_edit/{pgroup_id}',[AdminController::class,'pgroup_edit'])->name('pgroup_edit')->middleware('checkIdleTimeout');
//

//old
// Route::get('/user_admin',[AdminController::class,'user_admin'])->name('user_admin')->middleware('checkIdleTimeout');
// Route::get('/userexcel',[AdminController::class,'userExcel'])->name('user_excel')->middleware('checkIdleTimeout');
// Route::post('/userexcel/import', [AdminController::class,'importExcel'])->name('import.excel')->middleware('checkIdleTimeout');
// Route::get('/user_admin_create',[AdminController::class,'user_admin_create'])->name('user_admin.create')->middleware('checkIdleTimeout');

//chockker
//user-get
Route::get('/user_admin',[AdminController::class,'user_admin'])->name('user_admin')->middleware('checkIdleTimeout');
Route::get('/user_admin_search',[AdminController::class,'user_admin'])->name('user_admin.search')->middleware('checkIdleTimeout');
Route::get('/update-user-status', [AdminController::class, 'updateUserStatus'])->name('update.user.status');
Route::get('/export-user-admin', [AdminController::class, 'exportUseradmin'])->name('export.user.admin');

Route::get('/asc',[AdminController::class,'asc'])->name('asc')->middleware('checkIdleTimeout');
Route::post('/asc',[AdminController::class,'asc'])->name('asc.create')->middleware('checkIdleTimeout');
Route::get('/asc_del', [AdminController::class, 'asc_del'])->name('asc.del');
Route::post('/asc/delete/{id}', [AdminController::class, 'asc_delete'])->name('asc.delete');

Route::get('/company',[AdminController::class,'company'])->name('company')->middleware('checkIdleTimeout');
Route::post('/admin/company',[AdminController::class,'company'])->name('admin.company')->middleware('checkIdleTimeout');
Route::get('/company_del',[AdminController::class,'company_del'])->name('company_del')->middleware('checkIdleTimeout');
Route::post('/company/delete/{id}', [AdminController::class, 'company_delete'])->name('company.delete');

Route::get('/position',[AdminController::class,'position'])->name('position')->middleware('checkIdleTimeout');
Route::get('/position_del',[AdminController::class,'position_del'])->name('position_del')->middleware('checkIdleTimeout');
Route::post('/position/delete/{id}', [AdminController::class, 'position_delete'])->name('position.delete');
Route::post('/admin/position',[AdminController::class,'position'])->name('admin.position')->middleware('checkIdleTimeout');

Route::get('/userexcel',[AdminController::class,'userExcel'])->name('user_excel')->middleware('checkIdleTimeout');
Route::get('/useradmin_view/{id}',[AdminController::class,'userAdminView'])->name('user_view')->middleware('checkIdleTimeout');
Route::get('/useradmin_edit/{id}',[AdminController::class,'userAdminEdit'])->name('user_edit')->middleware('checkIdleTimeout');
Route::get('/useradmin_create',[AdminController::class,'userAdminCreate'])->name('user_create')->middleware('checkIdleTimeout');
Route::post('/useradmin_delete/{id}',[AdminController::class,'userAdminDelete'])->name('user_delete')->middleware('checkIdleTimeout');
//user-post
Route::post('/useradmin_update',[AdminController::class,'userAdminUpdate'])->name('user_update')->middleware('checkIdleTimeout');
Route::post('/useradmin_insert',[AdminController::class,'userAdminInsert'])->name('user_insert')->middleware('checkIdleTimeout');
Route::post('/userexcel/import', [AdminController::class,'importExcel'])->name('import.excel')->middleware('checkIdleTimeout');
Route::get('/user/toggle/{id}', [AdminController::class, 'toggleStatus'])->name('user.toggle');
// js
Route::get('/useradmin_create/company_selector/{id}', [AdminController::class,'companySelector'])->name('company_selector')->middleware('checkIdleTimeout');
// chockker

Route::get('/coursefield',[AdminController::class,'coursefield'])->name('coursefield')->middleware('checkIdleTimeout');

// new p
Route::get('/imgslide',[AdminController::class,'imgslide'])->name('imgslide')->middleware('checkIdleTimeout');
Route::get('imgslide_detail/{id}',[AdminController::class,'imgslide_detail'])->name('imgslide.detail')->middleware('checkIdleTimeout');
Route::get('/imgslide_create',[AdminController::class,'imgslide_create'])->name('imgslide_create')->middleware('checkIdleTimeout');
Route::post('/imgslide_insert',[AdminController::class,'imgslide_insert'])->name('imgslide_insert')->middleware('checkIdleTimeout');
Route::post('/imgslide_update/{imgslide_id}',[AdminController::class,'imgslide_update'])->name('imgslide_update')->middleware('checkIdleTimeout');
Route::post('/imgslide_delete/{imgslide_id}',[AdminController::class,'imgslide_delete'])->name('imgslide_delete')->middleware('checkIdleTimeout');
Route::get('/imgslide_edit/{imgslide_id}',[AdminController::class,'imgslide_edit'])->name('imgslide_edit')->middleware('checkIdleTimeout');
//

Route::get('/librarytype',[AdminController::class,'librarytype'])->name('librarytype')->middleware('checkIdleTimeout');

Route::get('/libraryfile',[AdminController::class,'libraryfile'])->name('libraryfile')->middleware('checkIdleTimeout');

Route::get('/coursenotification',[AdminController::class,'coursenotification'])->name('coursenotification')->middleware('checkIdleTimeout');

Route::get('/passcourse',[AdminController::class,'passcourse'])->name('passcourse')->middleware('checkIdleTimeout');

Route::get('/student_photo',[AdminController::class,'student_photo'])->name('student_photo')->middleware('checkIdleTimeout');

Route::get('/capture',[AdminController::class,'capture'])->name('capture')->middleware('checkIdleTimeout');

Route::get('/document',[AdminController::class,'document'])->name('document')->middleware('checkIdleTimeout');

Route::post('document/per_page',[AdminController::class,'document'])->middleware('checkIdleTimeout');

Route::get('/document/document_type',[AdminController::class,'searchByDocumentType'])->name('document.search.type');

Route::get('/document/document_name',[AdminController::class,'document'])->name('document.search.name');

Route::get('document_downloadfile/{id}',[AdminController::class,'document_downloadfile'])->name('document.downloadfile')->middleware('checkIdleTimeout');

Route::get('document_create',[AdminController::class,'document_create'])->name('document.create')->middleware('checkIdleTimeout');
Route::post('document_create',[AdminController::class,'document_create'])->name('document.create')->middleware('checkIdleTimeout');

Route::get('/getDocumentTypes/{titleId}', [AdminController::class, 'getDocumentTypes'])->middleware('checkIdleTimeout');

Route::get('document_detail/{id}',[AdminController::class,'document_detail'])->name('document.detail')->middleware('checkIdleTimeout');

Route::get('document_edit/{id}',[AdminController::class,'document_edit'])->name('document.edit')->middleware('checkIdleTimeout');
Route::post('document_edit/{id}',[AdminController::class,'document_edit'])->name('document.edit')->middleware('checkIdleTimeout');

Route::post('document_delete/{id}',[AdminController::class,'document_delete'])->name('document.delete')->middleware('checkIdleTimeout');

Route::get('document_head',[AdminController::class,'document_head'])->name('document.head')->middleware('checkIdleTimeout');
Route::get('document_head_edit/{id}',[AdminController::class,'document_head_edit'])->name('document.head_edit')->middleware('checkIdleTimeout');
Route::post('document_head_edit/{id}',[AdminController::class,'document_head_edit'])->name('document.head_edit')->middleware('checkIdleTimeout');
Route::post('document_head_delete/{id}',[AdminController::class,'document_head_del'])->name('document.head_del')->middleware('checkIdleTimeout');

Route::get('document_type',[AdminController::class,'document_type'])->name('document.type')->middleware('checkIdleTimeout');

Route::post('document_type/per_page',[AdminController::class,'document_type'])->middleware('checkIdleTimeout');

Route::get('document_type_detail/{id}',[AdminController::class,'document_type_detail'])->name('document_type.detail')->middleware('checkIdleTimeout');

Route::get('document_type_create',[AdminController::class,'document_type_create'])->name('document_type.create')->middleware('checkIdleTimeout');
Route::post('document_type_create',[AdminController::class,'document_type_create'])->name('document_type.create')->middleware('checkIdleTimeout');

Route::get('document_type_edit/{id}',[AdminController::class,'document_type_edit'])->name('document_type.edit')->middleware('checkIdleTimeout');
Route::post('document_type_edit/{id}',[AdminController::class,'document_type_edit'])->name('document_type.edit')->middleware('checkIdleTimeout');

Route::post('document_type_delete/{id}',[AdminController::class,'document_type_delete'])->name('document_type.delete')->middleware('checkIdleTimeout');

Route::get('/document_create',[AdminController::class,'document_create'])->name('document_create')->middleware('checkIdleTimeout');

Route::get('/document_index_type',[AdminController::class,'document_index_type'])->name('document_index_type')->middleware('checkIdleTimeout');

Route::post('/document_insert',[AdminController::class,'document_insert'])->name('document_insert')->middleware('checkIdleTimeout');

Route::post('/document_delete/{usa_id}',[AdminController::class,'document_delete'])->name('document_delete')->middleware('checkIdleTimeout');

Route::get('/document_edit/{usa_id}',[AdminController::class,'document_edit'])->name('document_edit')->middleware('checkIdleTimeout');

Route::post('/document_update/{usa_id}',[AdminController::class,'document_update'])->name('document_update')->middleware('checkIdleTimeout');

Route::get('/news',[AdminController::class,'news'])->name('news')->middleware('checkIdleTimeout');
Route::get('news_detail/{id}',[AdminController::class,'news_detail'])->name('news.detail')->middleware('checkIdleTimeout');

Route::get('/news_create',[AdminController::class,'news_create'])->name('news_create')->middleware('checkIdleTimeout');
Route::post('news_create',[AdminController::class,'news_create'])->name('news.create')->middleware('checkIdleTimeout');

Route::post('/news_insert',[AdminController::class,'news_insert'])->name('news_insert')->middleware('checkIdleTimeout');

Route::get('/news_edit/{cms_id}',[AdminController::class,'news_edit'])->name('news_edit')->middleware('checkIdleTimeout');
Route::post('/news_edit/{cms_id}',[AdminController::class,'news_edit'])->name('news.edit')->middleware('checkIdleTimeout');

Route::post('/news_delete/{cms_id}',[AdminController::class,'news_delete'])->name('news_delete')->middleware('checkIdleTimeout');

Route::post('/news_update/{cms_id}',[AdminController::class,'news_update'])->name('news_update')->middleware('checkIdleTimeout');

Route::get('/grouptesting',[AdminController::class,'grouptesting'])->name('grouptesting')->middleware('checkIdleTimeout');

// Route::get('/grouptesting_create',[AdminController::class,'grouptesting_create'])->name('grouptesting_create')->middleware('checkIdleTimeout');

Route::post('/grouptesting_insert',[AdminController::class,'grouptesting_insert'])->name('grouptesting_insert')->middleware('checkIdleTimeout');

Route::post('/grouptesting_delete/{group_id}',[AdminController::class,'grouptesting_delete'])->name('grouptesting_delete')->middleware('checkIdleTimeout');

Route::get('/grouptesting_edit/{group_id}',[AdminController::class,'grouptesting_edit'])->name('grouptesting_edit')->middleware('checkIdleTimeout');

Route::post('/grouptesting_update/{group_id}',[AdminController::class,'grouptesting_update'])->name('grouptesting_update')->middleware('checkIdleTimeout');

Route::get('/question',[AdminController::class,'question'])->name('question')->middleware('checkIdleTimeout');

Route::get('/question_create',[AdminController::class,'question_create'])->name('question_create')->middleware('checkIdleTimeout');

Route::post('/question_insert',[AdminController::class,'question_insert'])->name('question_insert')->middleware('checkIdleTimeout');

Route::get('/question_edit_page/{id}',[AdminController::class,'question_edit_page'])->name('question_edit_page')->middleware('checkIdleTimeout');

Route::post('/question_edit/{id}',[AdminController::class,'question_edit'])->name('question_edit')->middleware('checkIdleTimeout');

Route::post('/question_delete/{id}',[AdminController::class,'question_delete'])->name('question_delete')->middleware('checkIdleTimeout');



Route::get('/generation',[AdminController::class,'generation'])->name('generation')->middleware('checkIdleTimeout');

Route::get('/generation_create',[AdminController::class,'generation_create'])->name('generation_create')->middleware('checkIdleTimeout');

Route::post('/generation_insert',[AdminController::class,'generation_insert'])->name('generation_insert')->middleware('checkIdleTimeout');

Route::get('/generation_edit_page/{id}',[AdminController::class,'generation_edit_page'])->name('generation_edit_page')->middleware('checkIdleTimeout');

Route::post('/generation_edit/{id}',[AdminController::class,'generation_edit'])->name('generation_edit')->middleware('checkIdleTimeout');

Route::post('/generation_delete/{id}',[AdminController::class,'generation_delete'])->name('generation_delete')->middleware('checkIdleTimeout');

// ----- Classroom
Route::get('classroom',[AdminController::class,'classroom'])->name('classroom')->middleware('checkIdleTimeout');

Route::get('/classroom_create',[AdminController::class,'classroom_create'])->name('classroom_create')->middleware('checkIdleTimeout');
Route::post('/classroom_create',[AdminController::class,'classroom_create'])->name('classroom_create')->middleware('checkIdleTimeout');

Route::get('/classroom_edit/{id}',[AdminController::class,'classroom_edit'])->name('classroom_edit')->middleware('checkIdleTimeout');

Route::get('/classroom_delete/{id}',[AdminController::class,'classroom_delete'])->name('classroom_delete')->middleware('checkIdleTimeout');

Route::post('/classroom_update/{id}',[AdminController::class,'classroom_update'])->name('classroom_update')->middleware('checkIdleTimeout');

// ----- Captcha
Route::get('/captcha',[AdminController::class,'captcha'])->name('captcha')->middleware('checkIdleTimeout');

Route::post('/captcha_course/{id?}',[AdminController::class,'captcha_course'])->name('captcha.course')->middleware('checkIdleTimeout');

Route::get('/path-to-check-selected-courses', function (Request $request) {
    $capid = $request->input('capid');

    // ดึงข้อมูลหลักสูตรที่เลือกแล้วใน capid นี้
    $selectedCourses = Course::where('course_point', $capid)->pluck('course_id');

    return response()->json([
        'courses' => $selectedCourses,
    ]);
});

Route::get('/path-to-check-all-selected-courses', function (Request $request) {
    $capid = $request->input('capid');
    // ดึงข้อมูลหลักสูตรที่เลือกไปแล้วจาก capid อื่นๆ
    $selectedCourses = Course::whereNotNull('course_point')->where('course_point','!=',$capid)->pluck('course_id');

    return response()->json([
        'courses' => $selectedCourses,
    ]);
});

Route::post('/path-to-add-course',[AdminController::class,'addCourse'])->name('captcha.addCourse')->middleware('checkIdleTimeout');

Route::post('/path-to-remove-course',[AdminController::class,'removeCourse'])->name('captcha.removeCourse')->middleware('checkIdleTimeout');

Route::get('/captcha_create',[AdminController::class,'captcha_create'])->name('captcha_create')->middleware('checkIdleTimeout');

Route::post('/captcha_insert',[AdminController::class,'captcha_insert'])->name('captcha_insert')->middleware('checkIdleTimeout');

Route::get('/captcha_detail/{capid}',[AdminController::class,'captcha_detail'])->name('captcha_detail')->middleware('checkIdleTimeout');

Route::get('/captcha_edit/{capid}',[AdminController::class,'captcha_edit'])->name('captcha_edit')->middleware('checkIdleTimeout');
Route::post('/captcha_edit/{capid}',[AdminController::class,'captcha_edit'])->name('captcha_edit')->middleware('checkIdleTimeout');

Route::post('/captcha_delete/{capid}',[AdminController::class,'captcha_delete'])->name('captcha_delete')->middleware('checkIdleTimeout');

Route::get('/captcha_n/{capid}/{capt_active}',[AdminController::class,'captcha_n'])->name('captcha_n')->middleware('checkIdleTimeout');

Route::get('/captcha_y/{capid}/{capt_active}',[AdminController::class,'captcha_y'])->name('captcha_y')->middleware('checkIdleTimeout');

Route::post('/captcha_update/{capid}',[AdminController::class,'captcha_update'])->name('captcha_update')->middleware('checkIdleTimeout');

Route::get('/logadmin',[AdminController::class,'logadmin'])->name('logadmin')->middleware('checkIdleTimeout');
Route::get('/admin/admin-data', [AdminController::class, 'getadminData'])->name('admin.admin_data');

Route::get('/logusers',[AdminController::class,'logusers'])->name('logusers')->middleware('checkIdleTimeout');
Route::get('/admin/text-data', [AdminController::class, 'getTextData'])->name('admin.text_data');

Route::get('/logapprove',[AdminController::class,'logapprove'])->name('logapprove')->middleware('checkIdleTimeout');

Route::get('/logapporvepersonal',[AdminController::class,'logapporvepersonal'])->name('logapporvepersonal')->middleware('checkIdleTimeout');

Route::get('/logregister',[AdminController::class,'logregister'])->name('logregister')->middleware('checkIdleTimeout');

Route::get('learnreset',[AdminController::class,'learnreset'])->name('learnreset')->middleware('checkIdleTimeout');
Route::get('/update-learnreset-status', [AdminController::class, 'updateLearnresetStatus'])->name('update.learnreset.status');

Route::get('learnreset_course/{id}',[AdminController::class,'learnreset_course'])->name('learnreset.course')->middleware('checkIdleTimeout');
Route::post('learnreset_course/{id}',[AdminController::class,'learnreset_course'])->name('learnreset.course')->middleware('checkIdleTimeout');

Route::get('learnreset_score/{id}',[AdminController::class,'learnreset_score'])->name('learnreset.score')->middleware('checkIdleTimeout');
Route::post('learnreset_score/{id}',[AdminController::class,'learnreset_score'])->name('learnreset.score')->middleware('checkIdleTimeout');

Route::post('learnreset_reset/{id?}',[AdminController::class,'learnreset_reset'])->name('learnreset.reset')->middleware('checkIdleTimeout');

Route::get('report_logallregister',[AdminController::class,'report_logallregister'])->name('report.allregister')->middleware('checkIdleTimeout');
Route::get('report_seach',[AdminController::class,'report_logallregister'])->name('report.search')->middleware('checkIdleTimeout');

Route::get('report_loguserstatus',[AdminController::class,'report_loguserstatus'])->name('report.alluserstatus')->middleware('checkIdleTimeout');
Route::get('report_userseach',[AdminController::class,'report_loguserstatus'])->name('report.usersearch')->middleware('checkIdleTimeout');

Route::get('report_user',[AdminController::class,'report_user'])->name('report.user')->middleware('checkIdleTimeout');
Route::get('report_user_skill/{id}',[AdminController::class,'report_user_skill'])->name('report.user_skill')->middleware('checkIdleTimeout');
Route::get('/get-lines/{section_id}',[AdminController::class, 'getLines'])->name('get.lines');

Route::get('/report-user-export', [ReportExcelController::class, 'export'])->name('report.user.export')->middleware('checkIdleTimeout');

Route::get('report_license',[ReportLicensePersonController::class,'report_license'])->name('report.license')->middleware('checkIdleTimeout');
Route::get('/get-lines-license/{section_id}',[AdminController::class, 'getLines'])->name('get.lines.license');

Route::get('/report/license/export',[ReportExcelController::class, 'report_license_export'])->name('report.license.export');

Route::get('/personal-assessment',[PersonalAssessmentController::class,'index'])->name('personal.assessment');
Route::get('/get-lines-personal/{section_id}',[AdminController::class, 'getLines'])->name('get.lines.personal');

Route::get('/personal-assessment/{id}',[PersonalAssessmentController::class,'detail'])->name('personal.assessment.detail');

Route::get('/report/personal-assessment/{id}/export',[ReportExcelController::class, 'detail_export'])->name('personal.assessment.detail.export');

Route::get('report_course',[AdminController::class,'report_course'])->name('report.course')->middleware('checkIdleTimeout');
Route::get('report_courseseach',[AdminController::class,'report_course'])->name('report.coursesearch')->middleware('checkIdleTimeout');

Route::get('report_questionnaire',[ReportController::class,'report_questionnaire'])->name('report.questionnaire')->middleware('checkIdleTimeout');

Route::get('report_lesson/{id}',[AdminController::class,'report_lesson'])->name('report.lesson')->middleware('checkIdleTimeout');
Route::get('/export-lessons/{id}', [AdminController::class, 'exportLessons'])->name('export.lessons');
Route::get('/export-users/{id}', [AdminController::class, 'exportUsers'])->name('export.users');

Route::get('report_byuser',[AdminController::class,'report_byuser'])->name('report.byuser')->middleware('checkIdleTimeout');
Route::get('report_byuserseach',[AdminController::class,'report_byuser'])->name('report.byusersearch')->middleware('checkIdleTimeout');

Route::get('report_reset',[AdminController::class,'report_reset'])->name('report.reset')->middleware('checkIdleTimeout');
Route::get('report_resetseach',[AdminController::class,'report_reset'])->name('report.resetsearch')->middleware('checkIdleTimeout');

Route::get('report/learning_potential',[PotentialReportController::class,'PotentialReport'])->name('report.learning_potential')->middleware('checkIdleTimeout');
Route::get('report/learning_potential/getLines/{section_id}',[PotentialReportController::class,'getLines'])->name('report.learning_potential.get_line')->middleware('checkIdleTimeout');
Route::get('report/learning_potential/export/excel',[PotentialReportController::class,'exportPotentialReport'])->name('report.learning_potential.export.excel')->middleware('checkIdleTimeout');

Route::get('fetch-courses-and-lessons', [AdminController::class, 'fetchCoursesAndLessons'])->middleware('checkIdleTimeout');

Route::get('/ocr/upload', [AdminController::class, 'uploadOCR'])->name('ocr.upload');
Route::post('/ocr/upload', [AdminController::class, 'uploadOCR'])->name('ocr.upload');
Route::get('/ocr/page/{id}', [AdminController::class, 'OCRpage'])->name('ocr.page');
Route::post('/ocr_del/{id}', [AdminController::class, 'OCRdel'])->name('ocr.del');
Route::get('/ocr/edit/{id}/{page_number}', [AdminController::class, 'OCRedit'])->name('ocr.edit');
Route::put('/ocr/update/{id}/{page_number}', [AdminController::class, 'OCRupdate'])->name('ocr.update');

Route::get('/licenseperson/operate',[LicensePersonController::class, 'indexOperate'])->name('license.operate.index');
Route::post('/licenseperson/operate/import',[LicensePersonController::class, 'operateImportExcel'])->name('license.operate.excel');

Route::get('/licenseperson/parameter',[LicensePersonController::class, 'indexParameter'])->name('license.parameter.index');
Route::post('/licenseperson/parameter/import',[LicensePersonController::class, 'parameterImportExcel'])->name('license.parameter.excel');


Route::middleware(['auth.admin'])->group(function(){
    Route::get('/roadmap/new-emp',[RoadmapController::class, 'indexNewEmp'])->name('roadmap.newemp.index');
    Route::get('/roadmap/new-emp/course/{id}',[RoadmapController::class, 'newEmpDetail'])->name('roadmap.newemp.detail');
    Route::post('/roadmap/new-emp/course/order',[RoadmapController::class, 'updateOrder'])->name('admin.roadmap.updateOrder');
});

});
