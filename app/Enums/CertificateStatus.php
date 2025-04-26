<?php

namespace App\Enums;

enum CertificateStatus: string
{
    case ACTIVE = 'active';
    case SUSPENDED = 'suspended';
    case TERMINATED = 'terminated';
    case EXPIRED = 'expired';

    public function label(): string
    {
        return match($this) {
            self::ACTIVE => 'მოქმედი',
            self::SUSPENDED => 'შეჩერებული',
            self::TERMINATED => 'შეწყვეტილი',
            self::EXPIRED => 'ვადაგასული',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::ACTIVE => 'green',
            self::SUSPENDED => 'yellow',
            self::TERMINATED => 'red',
            self::EXPIRED => 'gray',
        };
    }
}