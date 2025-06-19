<?php

namespace App\Models\Traits;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasSubscription
{
    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class);
    }

    public function hasActiveSubscription(): bool
    {
        $endDate = $this->subscription?->ends_at ? Carbon::parse($this->subscription?->ends_at) : null;
        return $endDate && $endDate->greaterThan(now()) && $this->subscription?->is_active;
    }

    public function createOrUpdateSubscription(array $data)
    {
        return $this->subscription()->updateOrCreate(
            ['user_id' => $this->id],
            $data
        );
    }

    public function activeSubscriptionType(): int|bool
    {
        if($this->hasActiveSubscription()){
            return $this->subscription?->plan_id;
        }
        return false;


    }


    public function activeSubscriptionName(): string
    {
        if($this->hasActiveSubscription()){
            return $this->subscription?->plan?->plan_name ?: 'არ აქვს გამოწერილი';
        }
        return 'არ აქვს გამოწერილი';
    }



}
