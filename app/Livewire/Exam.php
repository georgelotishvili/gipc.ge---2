<?php

namespace App\Livewire;

use App\Models\Group;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestQuestion;
use App\Models\User;
use Livewire\Component;

class Exam extends Component
{

    public $user;
    public $test;
    public $question;
    public $progress;
    public $current_question_index;
    public $testQuestion;

    public function mount(TestQuestion $testQuestion)
    {
        $this->user = auth()->user();
        $this->testQuestion = $testQuestion;
        $this->setActiveTest();
        $this->loadCurrentQuestionIndex();
        $this->initializeFirstQuestion();
    }

    public function setActiveTest()
    {
        $this->test = Test::where('active', true)->first();
        if ($this->test) 
        {
            $this->validateTestActive($this->test);
        }
        else 
        {
            $this->test = Test::create([
                'name' => 'Test',
                'active' => false,
                'duration' => 240,
                'started_at' => now(),
            ]);

            $this->test->questions()->attach(Group::where('name', '255')->first()->questions()->select('questions.id')->inRandomOrder()->limit(8)->pluck('questions.id'));
            $this->test->questions()->attach(Group::where('name', '261')->first()->questions()->select('questions.id')->inRandomOrder()->limit(10)->pluck('questions.id'));
            $this->test->questions()->attach(Group::where('name', 'sert')->first()->questions()->select('questions.id')->inRandomOrder()->limit(2)->pluck('questions.id'));
            $this->test->questions()->attach(Group::where('name', 'konstruqciebi')->first()->questions()->select('questions.id')->inRandomOrder()->limit(3)->pluck('questions.id'));
            $this->test->questions()->attach(Group::where('name', 'kanoni')->first()->questions()->select('questions.id')->inRandomOrder()->limit(2)->pluck('questions.id'));
            $this->test->questions()->attach(Group::where('name', 'kodexi')->first()->questions()->select('questions.id')->inRandomOrder()->limit(2)->pluck('questions.id'));
    
            $this->test->active = true;
            $this->test->save();
        }
    }

    public function validateTestActive($test)
    {
        if (!$test->active) 
        {
            abort(404, 'Test is not active');
        }
        if ($test->finished_at) 
        {
            abort(404, 'Test is finished');
        }
        if ($test->started_at && now()->diffInMinutes($test->started_at) > $test->duration) 
        {
            abort(404, 'Test time has expired');
        }
    }

    public function initializeFirstQuestion()
    {
        if($this->current_question_index)
            $this->question = $this->test->questions()->where('questions.id', $this->current_question_index)->withPivot('answer')->first();
        else
            $this->question = $this->test->questions()->withPivot('answer')->first();

        $this->current_question_index = $this->question->id;
        $this->saveCurrentQuestionIndex();

        $this->updateProgress();
    }

    public function answer($answer)
    {
        if(TestQuestion::where('test_id', $this->test->id)->where('question_id', $this->question->id)->first()->answer) return false;
        $this->test->questions()->syncWithoutDetaching([$this->question->id => ['answer' => $answer]]);
        $this->updateProgress();
        $this->question = $this->test->questions()->where('questions.id', $this->question->id)->withPivot('answer')->first();
    }

    public function nextQuestion()
    {
        $currentQuestionId = $this->question->id;
        $nextQuestion = $this->test->questions()
            ->where('questions.id', '>', $currentQuestionId)
            ->orderBy('questions.id')
            ->first();
        
        if (!$nextQuestion) {
            // If there's no next question, we've reached the end, so we loop back to the first question
            $nextQuestion = $this->test->questions()
                ->orderBy('questions.id')
                ->first();
        }
        
        $this->question = $nextQuestion;
        $this->current_question_index = $this->question->id;
        $this->saveCurrentQuestionIndex();
        $this->updateProgress();
    }

    public function previousQuestion()
    {
        $currentQuestionId = $this->question->id;
        $previousQuestion = $this->test->questions()
            ->where('questions.id', '<', $currentQuestionId)
            ->orderBy('questions.id', 'desc')
            ->first();
        
        if (!$previousQuestion) {
            // If there's no previous question, we've reached the beginning, so we loop back to the last question
            $previousQuestion = $this->test->questions()
                ->orderBy('questions.id', 'desc')
                ->first();
        }
        
        $this->question = $previousQuestion;
        $this->current_question_index = $this->question->id;
        $this->saveCurrentQuestionIndex();
        $this->updateProgress();
    }

    public function updateProgress()
    {
        $answeredCount = $this->test->questions()->whereNotNull('test_question.answer')->count();
        $totalCount = $this->test->questions()->count();
        $this->progress = ($totalCount > 0) ? ($answeredCount / $totalCount) * 100 : 1;
        $this->test->putCache('progress', $this->progress, 600);
    }

    public function saveCurrentQuestionIndex()
    {
        session(['current_question_index' => $this->current_question_index]);
    }

    public function loadCurrentQuestionIndex()
    {
        $this->current_question_index = session('current_question_index', 0);
    }

    public function render()
    {
        return view('livewire.exam');
    }
}
