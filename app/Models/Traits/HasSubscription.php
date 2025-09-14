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
        if (!$this->subscription) {
            return false;
        }

        // If ends_at is set, use it
        if ($this->subscription->ends_at) {
            $endDate = Carbon::parse($this->subscription->ends_at);
            return $endDate->greaterThan(now());
        }

        // If ends_at is not set but starts_at is, calculate it
        if ($this->subscription->starts_at && $this->subscription->planType) {
            $startDate = Carbon::parse($this->subscription->starts_at);
            $endDate = $startDate->copy()->addDays($this->subscription->planType->type_duration);
            
            // Update the database with calculated end date
            $this->subscription->ends_at = $endDate;
            $this->subscription->save();
            
            return $endDate->greaterThan(now());
        }

        return false;
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
