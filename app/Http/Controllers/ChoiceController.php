<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Choice;
use App\Models\Score;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Manage;
use App\Models\Learn;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Services\MailConfigService;

class ChoiceController extends Controller
{
   function choiceAnswer($id, Request $request)
   {
      $score = 0;
      // $request->input('Choice');
      // dd($request->input('Choice.1905'));
      $score = 0;
      foreach ($request->input('Choice') as $ques_id => $choices) {
         foreach ($choices as $choice) {
            $chk_choice = Choice::where('choice_id', $choice)
            ->where('active', 'y')
            ->where('choice_answer', '1')
            ->first();
             if ($chk_choice != null) {
               $score++; // เพิ่มคะแนนขึ้นเมื่อพบตัวเลือกที่ถูกต้อง
           }
         }
     }
     $score_tot = 0;
     foreach ($request->input('Choice') as $ques_id => $choices) {
      foreach ($choices as $choice) {
         $score_tot++;
      }
  }
      // เช็คคำตอบข้อกา
      // foreach ($request->input('Choice') as $ques_id => $selected_choices) {
      //    $correct_choices = Choice::where([
      //       'ques_id' => $ques_id,
      //       'active' => 'y',
      //       'choice_answer' => 1,
      //    ])->pluck('choice_id')->toArray();
      //    $is_correct = array_diff($selected_choices, $correct_choices) === array_diff($correct_choices, $selected_choices);
      //    if ($is_correct) {
      //       $score++;
      //    }
      // }
      // เช็คคำตอบข้อเขียน
      $choice_text = $request->input('ChoiceText');
      if (!is_null($choice_text) && is_array($choice_text)) {
         foreach ($choice_text as $ques_id => $text_answer) {
            $correct_answer = Choice::where([
               'ques_id' => $ques_id,
               'active' => 'y',
               'choice_answer' => 1,
            ])->value('choice_detail');
            $is_correct_text = ($text_answer == $correct_answer);
            if ($is_correct_text) {
               $score++;
            }
         }
      }
      
      $ptest = Manage::where(['id' => $id, 'active' => 'y'])->first();
      $users = User::where(['id' => Auth::user()->id])->first();
      $lesson = Lesson::where(['id' => $id, 'active' => 'y'])->first();
      $score_total = ($score_tot/2);
      if($score>$score_total){
         $score_past = 'y';
      }else{
         $score_past = 'n';
      }
      // dd($score_past);
      $scores = New Score;
      $scores->lesson_id = $lesson->id;
      $scores->user_id = $users->id;
      $scores->course_id = $lesson->course_id;
      $scores->type = $ptest->type;
      $scores->score_number = $score;
      $scores->score_total = $score_tot;
      $scores->score_past = $score_past;
      $scores->active = 'y';
      $scores->create_by = $users->id;
      $scores->update_by = $users->id;
      $scores->save();
      // $scoress=$scores->create([
      //    'score_id'  => $scores->score_id,
      //    'lesson_id'    => $lesson->id,
      //    'user_id'      => $users->id,
      //    'course_id'    => $lesson->course_id,
      //    'type'         => $ptest->type,
      //    'score_number' => $score,
      //    'score_total'  => $ptest->manage_row,
      //    'score_past'   => $score_past,
      //    'create_by'    => $users->id,
      //    'create_date'  => now(),
      //    'update_by'    => $users->id,
      //    'update_date'  => now(),
      //    'active'       => 'y',
         
      // ]);
      //   dd($scores->toArray());
      
      // dd($scores->toArray());

      try {
            $to = $users->email;
            $subject = "ผลการสอบของคุณในบทเรียน: " . $lesson->lesson_name;
            $data = [
               'name' => $users->name,
               'lesson' => $lesson->lesson_name,
               'score' => $score,
               'total' => $score_tot,
               'result' => $score_past == 'y' ? 'ผ่าน' : 'ไม่ผ่าน',
            ];

            Mail::send('emails.exam_result', $data, function($message) use ($to, $subject) {
               $message->to($to)
                        ->subject($subject);
            });
         } catch (\Exception $e) {
            \Log::error("ส่งอีเมลแจ้งผลสอบไม่สำเร็จ: " . $e->getMessage());
         }

      return redirect()->route('course.lesson',['course_id'=>$lesson->course_id,'id' =>$lesson->id]);
   }
}
