<?php

namespace App\Livewire;

use App\Models\ExamRequest;
use Livewire\Component;

class AdminExamRequests extends Component
{
    public $user;
    public $examRequests;

    public function mount()
    {
        $this->user = auth()->user();

        if (!$this->user->is_admin) {
            return redirect('/');
        }

        $this->fetchExamRequests();
    }

    public function fetchExamRequests()
    {
        $this->examRequests = ExamRequest::all();
    }

    public function approveRequest($id)
    {
        $examRequest = ExamRequest::find($id);
        $examRequest->approved = true;
        $examRequest->save();

        $this->fetchExamRequests();
    }

    public function cancelRequest($id)
    {
        $examRequest = ExamRequest::find($id);
        $examRequest->approved = false;
        $examRequest->save();

        $this->fetchExamRequests();
    }

    public function render()
    {
        return view('livewire.admin-exam-requests');
    }
}
