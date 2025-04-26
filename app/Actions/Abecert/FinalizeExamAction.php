<?php

namespace App\Actions\Abecert;

use App\Models\ExamRequest;
use App\Models\Test;

class FinalizeExamAction
{
    public static function execute(Test $test, ExamRequest $examRequest): void 
    {
        $totalQuestions = $test->questions->count();

        // Calculate correct answers
        $correctAnswers = $test->questions->filter(function ($question) {
            return $question->answers->where('id', $question->pivot->answer)->first()?->is_true ?? false;
        })->count();

        // Calculate score percentage
        $score = $totalQuestions > 0 
            ? round(($correctAnswers / $totalQuestions) * 100) 
            : 0;
        
        $test->update([
            'questions_count' => $totalQuestions,
            'correct_answers_count' => $correctAnswers,
            'incorrect_answers_count' => $totalQuestions - $correctAnswers,
            'score' => $score
        ]);

        $test->save();

        $examRequest->closed = true;
        $examRequest->save();
    }
}
