<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Test;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        // Get the active test with questions and answers
        $test = Test::where('active', true)
            ->with(['questions.answers'])
            ->firstOrFail();

        // Calculate total questions
        $totalQuestions = $test->questions->count();

        // Calculate correct answers
        $correctAnswers = $test->questions->filter(function ($question) {
            return $question->answers->where('id', $question->pivot->answer)->first()?->is_true ?? false;
        })->count();

        // Calculate score percentage
        $score = $totalQuestions > 0 
            ? round(($correctAnswers / $totalQuestions) * 100) 
            : 0;

        return view('result', [
            'questions' => $test->questions,
            'correctAnswers' => $correctAnswers,
            'totalQuestions' => $totalQuestions,
            'score' => $score,
        ]);
    }
}
