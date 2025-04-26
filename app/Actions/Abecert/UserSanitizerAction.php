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
        // If the user doesn't have a subscription, return false
        if (!$user->subscription)
        {
            return;
        }

        // If the subscription type is unlimited, it's always active
        if ($user->subscription->type === SubscriptionType::UNLIMITED->value)
        {
            $user->subscription->is_active = true;
            $user->subscription->save();
            return;
        }

        // If starts_at is null, subscription hasn't started yet
        if (!$user->subscription->starts_at)
        {
            $user->subscription->is_active = false;
            $user->subscription->save();
            return;
        }

        // Calculate end date based on subscription type
        $endDate = null;
        $startDate = Carbon::parse($user->subscription->starts_at);

        switch ($user->subscription->type)
        {
            case SubscriptionType::WEEKLY->value:
                $endDate = $startDate->copy()->addWeek();
                break;
            case SubscriptionType::MONTHLY->value:
                $endDate = $startDate->copy()->addMonth();
                break;
            case SubscriptionType::YEARLY->value:
                $endDate = $startDate->copy()->addYear();
                break;
        }
        // dd($user);
        $now = now();
        $isActive = $now->greaterThanOrEqualTo($startDate) && $now->lessThan($endDate);
        $user->subscription->is_active = $isActive;
        $user->subscription->ends_at = $endDate;
        $user->subscription->save();
    }
}
