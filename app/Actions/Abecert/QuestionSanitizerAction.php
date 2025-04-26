<?php

namespace App\Actions\Abecert;

use App\Models\Question;

class QuestionSanitizerAction
{
    public static function execute(): void 
    {
        $questions = Question::all();
        foreach ($questions as $question)
        {
            if ($question->answers->isEmpty())
            {
                $question->delete();
            }
        }
    }
}
