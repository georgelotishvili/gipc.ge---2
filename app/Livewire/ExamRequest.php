<?php

namespace App\Livewire;

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
        if($this->examRequests) {
            return;
        }

        $this->user->examRequests()->create([
            'approved' => false,
            'closed' => false,
        ]);

        $this->fetchExamRequests();
    }

    public function startExam()
    {
        if(!$this->approvedExamRequest) {
            return;
        }
        return redirect()->route('exam');
    }

    public function render()
    {
        return view('livewire.exam-request');
    }
}
