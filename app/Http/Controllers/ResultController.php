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
        $test = Test::with(['questions.answers', 'examRequest'])
            ->findOrFail($request->route('test'));

        if ($test->examRequest->user_id !== auth()->user()->id) {
            abort(403);
        }
        
        // Calculate total questions
        $totalQuestions = $test->questions_count;

        // Calculate correct answers
        $correctAnswers = $test->correct_answers_count;

        // Calculate score percentage
        $score = $test->score;


        return view('result', [
            'questions' => $test->questions,
            'correctAnswers' => $correctAnswers,
            'totalQuestions' => $totalQuestions,
            'score' => $score,
        ]);
    }
}
