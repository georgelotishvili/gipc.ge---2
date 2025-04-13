<?php

namespace App\Actions\Abecert;

use App\Models\ExamRequest;
use App\Models\Group;
use App\Models\Test;
use App\Models\User;

class CreateTestAction
{
    public static function execute(ExamRequest $examRequest): void
    {
        // First deactivate any existing active tests
        $examRequest->test()->where('active', true)->update(['active' => false]);

        // Create a new test
        $test = Test::create([
            'name' => 'Test',
            'exam_request_id' => $examRequest->id,
            'active' => true,
            'duration' => 240,
            'started_at' => now(),
        ]);

        // Attach random questions from each group
        foreach(Group::all() as $group) 
        {
            $test->questions()->attach($group->questions()->select('questions.id')->inRandomOrder()->limit($group->question_count_in_exam)->pluck('questions.id'));
        }

        $test->save();
    }
}
