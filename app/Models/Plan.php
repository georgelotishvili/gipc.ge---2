<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plan extends Model
{
    use SoftDeletes;

    public function planType(): BelongsTo
    {
        return $this->belongsTo(PlanType::class);
    }

    public function planOptions(): HasMany
    {
        return $this->hasMany(PlanOption::class);
    }

}
