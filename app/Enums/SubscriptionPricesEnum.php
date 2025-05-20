<?php

namespace App\Enums;

enum SubscriptionPricesEnum : int
{
    case WEEKLY = 150;
    case MONTHLY = 350;
    case YEARLY = 1150;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
