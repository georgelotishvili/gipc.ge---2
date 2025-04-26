<?php

namespace App\Livewire;

use App\Actions\Abecert\CreateTestAction;
use App\Actions\Abecert\FinalizeExamAction;
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
        $this->approvedExamRequest = $this->user->examRequests->where('approved', true)->where('closed', false)->first();
        $this->nonApprovedExamRequest = $this->user->examRequests->where('approved', false)->where('closed', false)->first();
    }

    public function requestExam()
    {
        if($this->examRequests)
        {
            return;
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
        if(!$this->examRequests)
        {
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
    }

    public function render()
    {
        return view('livewire.exam-request');
    }
}
