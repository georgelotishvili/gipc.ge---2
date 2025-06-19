<?php

namespace App\Enums;

enum SubscriptionPricesEnum : int
{
    case WEEKLY = 150;
    case MONTHLY = 350;
    case YEARLY = 1150;
    // this change to


    
    // there
    public static function getPrices(): array
    {
        return array_map(function ($pricing) {
            return $pricing->price;
        }, App\Models\Pricing::all());
    }


    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
