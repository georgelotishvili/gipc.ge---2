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
    public $currentExamRequest;

    public function mount(TestQuestion $testQuestion)
    {

        $this->user = auth()->user();
        $this->testQuestion = $testQuestion;
        $this->currentExamRequest = $this->user->examRequests->where('approved', true)->where('closed', false)->first();
        $this->setActiveTest();
        $this->loadCurrentQuestionIndex();
        $this->initializeFirstQuestion();
    }

    public function goToQuestion($questionId)
    {
        $this->question = Question::findOrFail($questionId);
        $this->updateProgress();
    }

    public function setActiveTest()
    {
        // First deactivate any existing active tests
        Test::where('active', true)->update(['active' => false]);

        // Create a new test
        $this->test = Test::create([
            'name' => 'Test',
            'exam_request_id' => $this->currentExamRequest->id,
            'active' => true,
            'duration' => 240,
            'started_at' => now(),
        ]);

        // Attach random questions from each group
        foreach(Group::all() as $group) 
        {
            $this->test->questions()->attach($group->questions()->select('questions.id')->inRandomOrder()->limit($group->question_count_in_exam)->pluck('questions.id'));
        }

        $this->test->save();
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
        if($this->current_question_index) {
            $this->question = $this->test->questions()->where('questions.id', $this->current_question_index)->withPivot('answer')->first();
        }
        
        if(!$this->question) {
            $this->question = $this->test->questions()->withPivot('answer')->first();
        }

        if($this->question) {
            $this->current_question_index = $this->question->id;
            $this->saveCurrentQuestionIndex();
        }

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
        if($this->progress == 100) 
        {
            $this->finalizeExam();
            return redirect()->route('result', $this->test->id);
        }
    }

    public function saveCurrentQuestionIndex()
    {
        session(['current_question_index' => $this->current_question_index]);
    }

    public function loadCurrentQuestionIndex()
    {
        $this->current_question_index = session('current_question_index', 0);
    }

    public function finalizeExam()
    {
        $totalQuestions = $this->test->questions->count();

        // Calculate correct answers
        $correctAnswers = $this->test->questions->filter(function ($question) {
            return $question->answers->where('id', $question->pivot->answer)->first()?->is_true ?? false;
        })->count();

        // Calculate score percentage
        $score = $totalQuestions > 0 
            ? round(($correctAnswers / $totalQuestions) * 100) 
            : 0;
        
        $this->test->update([
            'questions_count' => $totalQuestions,
            'correct_answers_count' => $correctAnswers,
            'incorrect_answers_count' => $totalQuestions - $correctAnswers,
            'score' => $score
        ]);

        $this->test->save();

        $this->currentExamRequest->closed = true;
        $this->currentExamRequest->save();
    }

    public function render()
    {
        return view('livewire.exam');
    }
}
