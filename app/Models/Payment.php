<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    public $fillable = [
        'user_id',
        'subscription_id',
        'subscription_type',
        'order_status',
        'actual_amount',
        'order_id',
        'card_type',
        'order_time',
        'bank_name',
        'payment_method',
        'transaction_id'
    ];

    protected $casts = [
        'order_time' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    protected function actualAmount(): Attribute
    {
        return Attribute::make(
            get: fn (?float $value) => (float) ($value / 100),
            set: fn (?float $value) => (float) ($value * 100),
        );
    }


}
