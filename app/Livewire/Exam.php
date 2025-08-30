<?php

namespace App\Livewire;

use App\Actions\Abecert\FinalizeExamAction;
use App\Models\Group;
use App\Models\Question;
use App\Models\Test;
use App\Models\TestQuestion;
use App\Models\User;
use Livewire\Component;
use App\Models\ExamRequest as ExamRequestModel;
use App\Models\SystemSetting;

class Exam extends Component
{

    public $user;
    public $test;
    public $question;
    public $progress;
    public $current_question_index;
    public $testQuestion;
    public $currentExamRequest;
    public $timer;
    public $examDuration;

    public function mount(TestQuestion $testQuestion, $examRequest)
    {
        if(SystemSetting::where('key', 'exam_duration')->first()) $this->examDuration = SystemSetting::where('key', 'exam_duration')->first()->value;
        else $this->examDuration = 72000;
        $this->user = auth()->user();
        $this->currentExamRequest = ExamRequestModel::findOrFail($examRequest);
        // Check if the exam request belongs to the authenticated user
        if ($this->currentExamRequest->user_id !== $this->user->id)
        {
            session()->flash('error', 'You do not have permission to access this exam.');
            return redirect(null, 500);
        }
        $this->test = $this->currentExamRequest->test;
        // dd($this->currentExamRequest);
        $this->validateTestActive($this->test);
        $this->testQuestion = $testQuestion;
        
        // Check if this is a new exam start or resuming an ongoing exam
        $this->loadCurrentQuestionIndex();
        
        // If no saved question index (new exam) or exam just started, go to first question
        if (is_null($this->current_question_index) || !$this->test->started_at) {
            $this->current_question_index = $this->test->questions()->orderBy('id', 'asc')->first()->id;
            session()->forget('current_question_index');
        }
        
        $this->initializeFirstQuestion();
        $this->examDuration = SystemSetting::where('key', 'exam_duration')->first()->value;
    }

    public function goToQuestion($questionId): void
    {
        $this->question = Question::findOrFail($questionId);
        $this->updateProgress();
    }

    public function updateTimer()
    {
        $timer = now()->diffInSeconds($this->test->started_at) + $this->examDuration; // Adding 1 hour (3600 seconds)
        // Calculate hours, minutes, and seconds from total seconds
        $hours = floor($timer / 3600);
        $minutes = floor(($timer % 3600) / 60);
        $seconds = $timer % 60;
        
        // Format the time as HH:MM:SS
        $this->timer = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

        // Check if timer is in negative (time has expired)
        if (strpos($this->timer, '-') === 0) {
            $this->finalizeExam();
            return redirect()->route('result', $this->test->id);
        }
    }

    public function validateTestActive(Test $test): void
    {
        if (!$test->active) 
        {
            abort(404, 'Test is not active');
        }
        if ($test->finished_at) 
        {
            abort(404, 'Test is finished');
        }
        if ($test->started_at && now()->diffInMinutes($test->started_at) > $this->examDuration) 
        {
            abort(404, 'Test time has expired');
        }
    }

    public function initializeFirstQuestion(): void
    {
        // If we have a saved question index, load that question
        if ($this->current_question_index) {
            $this->question = $this->test->questions()->where('questions.id', $this->current_question_index)->withPivot('answer')->first();
        }
        
        // If no saved question or question not found, go to first question
        if (!$this->question) {
            $this->question = $this->test->questions()->orderBy('id', 'asc')->withPivot('answer')->first();
            if ($this->question) {
                $this->current_question_index = $this->question->id;
            }
        }
        
        if($this->question) {
            $this->saveCurrentQuestionIndex();
        }

        $this->updateProgress();
    }

    public function answer($answer)
    {
        if(TestQuestion::where('test_id', $this->test->id)->where('question_id', $this->question->id)->first()->answer) return false;
        
        // Save the answer
        $this->test->questions()->syncWithoutDetaching([$this->question->id => ['answer' => $answer]]);
        
        // Update progress
        $this->updateProgress();
        
        // Reload current question with answer
        $this->question = $this->test->questions()->where('questions.id', $this->question->id)->withPivot('answer')->first();
        
        // Check if this was the last question
        $currentQuestionId = $this->question->id;
        $nextQuestion = $this->test->questions()
            ->where('questions.id', '>', $currentQuestionId)
            ->orderBy('questions.id')
            ->first();
        
        // If there's a next question, go to it after a brief delay
        if ($nextQuestion) {
            $this->dispatch('goToNextQuestion', questionId: $nextQuestion->id);
        }
    }

    public function nextQuestion(): void
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

    public function previousQuestion(): void
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
        $this->current_question_index = session('current_question_index', null);
    }

    public function finalizeExam()
    {
        FinalizeExamAction::execute($this->test, $this->currentExamRequest);
    }
    
    public function goToQuestionAfterAnswer($questionId): void
    {
        $this->question = Question::findOrFail($questionId);
        $this->current_question_index = $this->question->id;
        $this->saveCurrentQuestionIndex();
        $this->updateProgress();
    }

    public function render()
    {
        return view('livewire.exam');
    }
}
