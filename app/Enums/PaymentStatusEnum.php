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


    //აქ შეგიძლია გაუწერეო სტატუსის სათაურები მაგალითად approved - წარმატებული გადახდა და ა.შ.
    public function title(): string
    {
        return match($this) {
            self::PROCESSING => 'Order is still in processing by payment gateway; merchant must continue to request the status of the order',
            self::DECLINED => 'Order is declined by Flitt payment gateway or by a bank or by an external payment system',
            self::APPROVED => 'წარმატებული გადახდა!',
            self::EXPIRED => 'Order lifetime expired',
            self::REVERSED => 'Previously approved transaction was fully reversed. In this case, parameter reversal_amount will be equal to actual_amount',
        };
    }


    public function description(): string
    {
        return match($this) {
            self::PROCESSING => 'Order is still in processing by payment gateway; merchant must continue to request the status of the order',
            self::DECLINED => 'Order is declined by Flitt payment gateway or by a bank or by an external payment system',
            self::APPROVED => 'Order completed successfully, funds are held on the payer’s account and soon will be credited of the merchant; merchant can provide the service or ship goods',
            self::EXPIRED => 'Order lifetime expired',
            self::REVERSED => 'Previously approved transaction was fully reversed. In this case, parameter reversal_amount will be equal to actual_amount',
        };
    }
}
