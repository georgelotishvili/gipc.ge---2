<?php

namespace App\Enums;

enum PaymentStatusEnum : string
{
    case PROCESSING = 'processing';
    case DECLINED = 'declined';
    case APPROVED = 'approved';
    case EXPIRED = 'expired';
    case REVERSED = 'reversed';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function title(): string
    {
        return match($this) {
            self::PROCESSING => 'დაელოდეთ დამტიკცებას',
            self::DECLINED => 'გადახდა უარყოფილია',
            self::APPROVED => 'წარმატებული გადახდა!',
            self::EXPIRED => 'გადახდას ვადა გაუვიდა',
            self::REVERSED => 'წინა დამტკიცებული გადახდა სრულად გაუქმებულია.',
        };
    }


    public function description(): string
    {
        return match($this) {
            self::PROCESSING => 'დაელოდეთ დამტიკცებას',
            self::DECLINED => 'გადახდა უარყოფილია',
            self::APPROVED => 'წარმატებული გადახდა!',
            self::EXPIRED => 'გადახდას ვადა გაუვიდა',
            self::REVERSED => 'წინა დამტკიცებული გადახდა სრულად გაუქმებულია.',
        };
    }
}
