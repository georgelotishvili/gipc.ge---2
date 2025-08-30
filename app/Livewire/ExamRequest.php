<?php

namespace App\Livewire;

use App\Actions\Abecert\CreateTestAction;
use App\Actions\Abecert\FinalizeExamAction;
use App\Models\User;
use Livewire\Component;

class ExamRequest extends Component
{
    public $user;
    public $examRequests;
    public $approvedExamRequest;
    public $nonApprovedExamRequest;

    public function mount()
    {
        $this->user = auth()->user();
        $this->fetchExamRequests();
    }

    public function fetchExamRequests()
    {
        $this->examRequests = $this->user->examRequests->where('closed', false)->first();
        $this->user = User::find($this->user->id);
        $this->approvedExamRequest = $this->user->examRequests->where('approved', true)->where('closed', false)->first();
        $this->nonApprovedExamRequest = $this->user->examRequests->where('approved', false)->where('closed', false)->first();
    }

    public function requestExam()
    {
        if ($this->examRequests) {
            return;
        }

        // Block unpaid users from creating exam requests
        if (!$this->user || method_exists($this->user, 'hasActiveSubscription') && !$this->user->hasActiveSubscription()) {
            return redirect()->route('pricing');
        }

        $examRequest = $this->user->examRequests()->create([
            'approved' => true,
            'closed' => false,
        ]);
        CreateTestAction::execute($examRequest);
        $this->fetchExamRequests();
    }

    public function startExam()
    {
        // Block unpaid users from starting exams
        if (!$this->user || method_exists($this->user, 'hasActiveSubscription') && !$this->user->hasActiveSubscription()) {
            return redirect()->route('pricing');
        }

        if (!$this->examRequests) {
            $examRequest = $this->user->examRequests()->create([
                'approved' => true,
                'closed' => false,
            ]);
            CreateTestAction::execute($examRequest);
            $this->fetchExamRequests();
        }
        
        if(!$this->approvedExamRequest) {
            return;
        }
        return redirect()->route('exam', $this->approvedExamRequest);
    }

    public function cancelExam()
    {
        if(!$this->approvedExamRequest) {
            return;
        }
        FinalizeExamAction::execute($this->approvedExamRequest->test, $this->approvedExamRequest);
        $this->fetchExamRequests();
        return redirect()->route('workspace');
    }

    public function render()
    {
        return view('livewire.exam-request');
    }
}
