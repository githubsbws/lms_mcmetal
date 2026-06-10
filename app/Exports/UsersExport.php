<?php

namespace App\Exports;

use App\Models\Company;
use App\Models\Score;
use App\Models\Learn;
use App\Models\Users;
use App\Models\Lesson;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $courseId;
    protected $users;
    protected $lessons;

    public function __construct($courseId, $users, $lessons)
    {
        $this->courseId = $courseId;
        $this->users = $users;
        $this->lessons = $lessons;
    }

    public function collection()
    {
        // Return users collection
        return $this->users;
    }

    public function headings(): array
    {
        $lessonHeaders = $this->lessons->map(function($lesson) {
            return $lesson->title;
        })->toArray();

        return [
            'Username',
            'Name',
            'User group',
            'Organization Name',
            'PRE Date',
            'PRE Score',
            'PRE Total',
            ...$lessonHeaders,
            'POST Date',
            'POST Score',
            'POST Total',
            'Pass',
            'Last Score'
        ];
    }

    public function map($user): array
    {
        $company = Company::find($user->company_id);
        $scorePre = Score::where('user_id', $user->id)
                        ->where('course_id', $this->courseId)
                        ->where('type', 'pre')
                        ->first();
        $scorePost = Score::where('user_id', $user->id)
                         ->where('course_id', $this->courseId)
                         ->where('type', 'post')
                         ->first();
        $score = Score::where('user_id', $user->id)
                         ->where('course_id', $this->courseId)
                         ->latest('score_id')->first();

        $preDate = $scorePre ? $scorePre->create_date : '';
        $preScore = $scorePre ? $scorePre->score_number : '';
        $preTotal = $scorePre ? $scorePre->score_total : '';

        $postDate = $scorePost ? $scorePost->create_date : '';
        $postScore = $scorePost ? $scorePost->score_number : '';
        $postTotal = $scorePost ? $scorePost->score_total : '';

        $pass = $scorePre ? ($scorePre->score_past === 'y' ? 'pass' : '') : ($scorePost && $scorePost->score_past === 'y' ? 'pass' : '');

        $lastScore = $score ? $score->score_number : '';

        $lessonData = $this->lessons->map(function($lesson) use ($user) {
            $learn = Learn::where('lesson_id', $lesson->id)
                          ->where('user_id', $user->id)
                          ->first();
            return $learn ? $learn->learn_date : '';
        })->toArray();

        return [
            $user->username,
            $user->firstname . ' ' . $user->lastname,
            $company ? $company->company_title : '-',
            '-',
            $preDate,
            $preScore,
            $preTotal,
            ...$lessonData,
            $postDate,
            $postScore,
            $postTotal,
            $pass,
            $lastScore
        ];
    }
}
