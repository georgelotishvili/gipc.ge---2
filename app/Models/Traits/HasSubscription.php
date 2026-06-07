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
        $subscription = $this->activeSubscription();

        if (!$subscription) {
            return false;
        }

        if ($subscription->starts_at && Carbon::parse($subscription->starts_at)->isFuture()) {
            return false;
        }

        if ($subscription->ends_at) {
            return Carbon::parse($subscription->ends_at)->greaterThan(now());
        }

        if ($subscription->starts_at && $subscription->planType) {
            $startDate = Carbon::parse($subscription->starts_at);
            $endDate = $startDate->copy()->addDays($subscription->planType->type_duration);
            
            $subscription->ends_at = $endDate;
            $subscription->save();
            
            return $endDate->greaterThan(now());
        }

        return false;
    }

    public function activeSubscription(): ?Subscription
    {
        return $this->subscriptions()
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('ends_at')->orWhere('ends_at', '>', now());
            })
            ->orderByDesc('ends_at')
            ->orderByDesc('id')
            ->first();
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
        if($subscription = $this->activeSubscription()){
            return $subscription->plan_id;
        }
        return false;


    }


    public function activeSubscriptionName(): string
    {
        if($subscription = $this->activeSubscription()){
            return $subscription->plan?->plan_name ?: 'არ აქვს გამოწერილი';
        }
        return 'არ აქვს გამოწერილი';
    }



}
