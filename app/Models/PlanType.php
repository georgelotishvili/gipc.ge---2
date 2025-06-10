<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanType extends Model
{
    use SoftDeletes;

    public function plans() : HasMany
    {
        return $this->hasMany(Plan::class);
    }


    protected function typePrice(): Attribute
    {
        return Attribute::make(
            get: fn (?float $value) => (float) ($value / 100),
            set: fn (?float $value) => (float) ($value * 100),
        );
    }

    protected function typeDiscount(): Attribute
    {
        return Attribute::make(
            get: fn (?float $value) => (float) ($value / 100),
            set: fn (?float $value) => (float) ($value * 100),
        );
    }
}
