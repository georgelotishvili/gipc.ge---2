<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Test;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::count();
        $tests = Test::count();
        $questions = Question::count();
        $average_score = Test::avg('score');
        return view('admin.index', [
            'users' => $users,
            'tests' => $tests,
            'questions' => $questions,
            'average_score' => $average_score
        ]);
    }

    public function questions()
    {
        $questions = Question::with(['answers'])->latest()->paginate(15);
        return view('admin.questions.questions', [
            'questions' => $questions
        ]);
    }

    public function create()
    {
        return view('admin.questions.create');
    }

    public function store(Request $request)
    {
        $question = Question::create([
            'text' => $request->input('text'),
        ]);

        foreach($request->input('answers') as $index => $answer) {
            Answer::create([
                'text' => $answer['text'],
                'is_true' => $request->input('is_true') == $index,
                'question_id' => $question->id,
            ]);
        }
        
        return redirect()->route('admin.questions');
    }

    public function edit(Question $question)
    {
        return view('admin.questions.edit', [
            'question' => $question
        ]);
    }

    public function update(Request $request, Question $question)
    {
        $question->update([
            'text' => $request->input('text')
        ]);

        // Delete existing answers
        $question->answers()->delete();

        // Create new answers
        foreach($request->input('answers') as $index => $answer) {
            Answer::create([
                'text' => $answer['text'],
                'is_true' => $request->input('correct_answer') == $index,
                'question_id' => $question->id,
            ]);
        }

        return redirect()->route('admin.questions');
    }

    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users', [
            'users' => $users
        ]);
    }

    public function videos()
    {
        return view('admin.videos');
    }


    public function destroy(Question $question)
    {
        $question->answers()->delete();
        $question->delete();
        return redirect()->route('admin.questions');
    }
}
