<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function planType(): BelongsTo
    {
        return $this->belongsTo(PlanType::class);
    }

    public function planOptions(): HasMany
    {
        return $this->hasMany(PlanOption::class);
    }

    protected function planPrice(): Attribute
    {
        return Attribute::make(
            get: fn (?float $value) => (float) ($value / 100),
            set: fn (?float $value) => (float) ($value * 100),
        );
    }

    protected function planDiscount(): Attribute
    {
        return Attribute::make(
            get: fn (?float $value) => (float) ($value / 100),
            set: fn (?float $value) => (float) ($value * 100),
        );
    }

}
