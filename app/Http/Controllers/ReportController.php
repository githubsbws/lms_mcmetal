<?php

namespace App\Http\Controllers;

use App\Models\Conditions;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use App\Models\QHeader;

class ReportController extends Controller
{
    public function report_questionnaire(Request $request)
    {
        $surveys = QHeader::with(['sections.questions.choices.answers'])
            ->where('active', 'y')
            ->get()
            ->filter(function ($sur) {
                foreach ($sur->sections as $section) {
                    foreach ($section->questions as $question) {
                        foreach ($question->choices as $choice) {
                            foreach ($choice->answers as $answer) {
                                if ($answer->answer_numeric !== null) {
                                    return true;
                                }
                            }
                        }
                    }
                }
                return false;
            });

        // Manual pagination
        $perPage = 5;
        $currentPage = $request->input('page', 1);
        $pagedData = $surveys->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedData,
            $surveys->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.report.report_questionnaire', [
            'survey' => $paginator
        ]);
    }
}
