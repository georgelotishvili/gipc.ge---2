<?php

namespace App\Livewire;

use App\Actions\Abecert\UserSanitizerAction;
use App\Models\Plan;
use App\Models\PlanType;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;


class UserSubscriptionModal extends Component
{
    public ?User $user;
    public ?Subscription $subscription;

    public bool $is_active = true;
    public $type;
    public $starts_at;
    public $ends_at;

    public function mount(): void
    {
        $this->user = null;
        $this->subscription = null;
    }

    #[On('open-modal')]
    public function openModal($userId): void
    {
        $this->user = User::find($userId);
        if (!$this->user) {
            return;
        }
        $this->subscription = $this->user->subscription;
        $this->is_active = $this->user->subscription?->is_active ?? true;
        $this->type = $this->user->subscription?->plan_id ?: 0;
        $this->starts_at = $this->user->subscription?->starts_at
            ? Carbon::parse($this->user->subscription?->starts_at)->format('Y-m-d')
            : null;
        $this->ends_at = $this->user->subscription?->ends_at
            ? Carbon::parse($this->user->subscription?->ends_at)->format('Y-m-d')
            : null;
    }

    public function save(): void
    {
        if (!$this->user) {
            return;
        }

        $plan = Plan::find($this->type);
        if (!$plan) {
            $this->addError('type', 'Invalid plan selected');
            return;
        }

        $planType = PlanType::find($plan->plan_type_id);
        if (!$planType) {
            $this->addError('type', 'Plan type not found');
            return;
        }

        $data = [
            'plan_type_id' => $planType->id,
            'plan_id' => $plan->id,
            'is_active' => (bool) $this->is_active,
            'starts_at' => $this->starts_at ? Carbon::parse($this->starts_at)->startOfDay() : now(),
            'ends_at' => $this->ends_at ? Carbon::parse($this->ends_at)->endOfDay() : Carbon::now()->addDays($planType->type_duration),
            'recToken' => md5(time()),
        ];

        $this->user->createOrUpdateSubscription($data);
        $this->dispatch('close-modal');
        $this->dispatch('update_user_row');
    }

    public function render(): View
    {
        return view('livewire.user-subscription-modal', [
            'plans' => Plan::get()
        ]);
    }
}
