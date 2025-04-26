<?php

namespace App\Livewire;

use App\Models\Subscription;
use Livewire\Component;

class AdminUserRow extends Component
{
    public $user;
    public $subscription;

    public function mount()
    {
        $this->subscription = $this->user->subscription;
    }

    public function render()
    {
        return view('livewire.admin-user-row');
    }
}
