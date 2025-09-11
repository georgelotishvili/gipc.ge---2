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

        // Use the same logic as hasActiveSubscription
        $isActive = $user->hasActiveSubscription();
        
        // Update is_active to match the calculated status
        if ($user->subscription->is_active !== $isActive) {
            $user->subscription->is_active = $isActive;
            $user->subscription->save();
        }
    }
}
