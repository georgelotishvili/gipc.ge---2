<?php

namespace App\Enums;

enum CertificateStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case EXPIRED = 'expired';
    case REVOKED = 'revoked';

    public function label(): string
    {
        return match($this) {
            self::PENDING => 'მიმდინარე',
            self::APPROVED => 'დადასტურებული',
            self::REJECTED => 'უარყოფილი',
            self::EXPIRED => 'ვადა გასული',
            self::REVOKED => 'გაუქმებული',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::PENDING => 'yellow',
            self::APPROVED => 'green',
            self::REJECTED => 'red',
            self::EXPIRED => 'gray',
            self::REVOKED => 'red',
        };
    }
} 