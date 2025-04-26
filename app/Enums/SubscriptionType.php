<?php

namespace App\Enums;

enum SubscriptionType: string
{
    case WEEKLY = 'weekly';
    case MONTHLY = 'monthly';
    case YEARLY = 'yearly';
    case UNLIMITED = 'unlimited';
} 