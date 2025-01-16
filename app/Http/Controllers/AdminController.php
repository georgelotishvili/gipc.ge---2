<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Test;
use App\Models\User;
use App\Models\Group;

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
            'average_score' => $average_score,
        ]);
    }

    public function questions()
    {
        $questions = Question::with(['answers'])->orderBy('id')->filterByGroup(request('g'))->paginate(30)->withQueryString();
        $groups = Group::all();

        return view('admin.questions.questions', [
            'questions' => $questions,
            'groups' => $groups

        ]);
    }

    public function create()
    {
        $groups = Group::all();

        return view('admin.questions.create', [
            'groups' => $groups
        ]);
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

        $question->groups()->attach($request->input('group'));

        return redirect()->route('admin.questions');
    }

    public function edit(Question $question)
    {
        $groups = Group::all();
        return view('admin.questions.edit', [
            'question' => $question,
            'groups' => $groups
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
        
        $question->groups()->detach();
        $question->groups()->attach($request->input('group'));
        //$question->save();

        //dd($request->input('group'));

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


    public function destroy($question)
    {
        if($question === 'bulk') {   
            $questionIds = request('selected_questions', []);
            Question::whereIn('id', $questionIds)->each(function($question) {
                $question->answers()->delete();
                $question->delete();
            });
        } else {
            $question = Question::findOrFail($question);
            $question->answers()->delete();
            $question->delete();
        }
        
        return redirect()->back();
    }
}
