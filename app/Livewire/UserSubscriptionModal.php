<?php

namespace App\Livewire;

use App\Actions\Abecert\UserSanitizerAction;
use App\Models\Subscription;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;


class UserSubscriptionModal extends Component
{
    public ?User $user;
    public ?Subscription $subscription;

    public bool $is_active = false;
    public $type;
    public $starts_at;
    public $ends_at;


    public function mount()
    {
        $this->user = null;
        $this->subscription = null;
    }

    #[On('open-modal')]
    public function openModal($userId)
    {
        $this->user = User::find($userId);
        $this->subscription = $this->user->subscription;
        $this->is_active = $this->subscription->is_active;
        $this->type = $this->subscription->type;
        $this->starts_at = $this->subscription->starts_at;
        $this->ends_at = $this->subscription->ends_at;
    }

    public function save()
    {
        $this->subscription->is_active = $this->is_active;
        $this->subscription->type = $this->type;
        $this->subscription->starts_at = $this->starts_at ?: null;
        $this->subscription->ends_at = $this->ends_at ?: null;
        $this->subscription->save();
        $this->user = User::find($this->user->id);
        UserSanitizerAction::sanitize($this->user);
        $this->dispatch('close-modal');
    }

    public function render()
    {
        return view('livewire.user-subscription-modal');
    }
}
