<?php

namespace App\Actions\Abecert;

use App\Enums\SubscriptionType;
use App\Models\User;
use Carbon\Carbon;

class UserSanitizerAction
{
    public static function execute(): void 
    {
        $users = User::all();
        foreach ($users as $user)
        {
            self::sanitize($user);
        }
    }

    public static function sanitize(User $user): void
    {
        if (!$user->subscription) {
            return;
        }

        // Calculate actual subscription status based on dates, not is_active field
        $isActive = $this->calculateSubscriptionStatus($user->subscription);
        
        // Update is_active to match the calculated status
        if ($user->subscription->is_active !== $isActive) {
            $user->subscription->is_active = $isActive;
            $user->subscription->save();
        }
    }

    private function calculateSubscriptionStatus($subscription): bool
    {
        if (!$subscription) {
            return false;
        }

        // If ends_at is set, use it
        if ($subscription->ends_at) {
            $endDate = \Carbon\Carbon::parse($subscription->ends_at);
            return $endDate->greaterThan(now());
        }

        // If ends_at is not set but starts_at is, calculate it
        if ($subscription->starts_at && $subscription->planType) {
            $startDate = \Carbon\Carbon::parse($subscription->starts_at);
            $endDate = $startDate->copy()->addDays($subscription->planType->type_duration);
            return $endDate->greaterThan(now());
        }

        return false;
    }
}
