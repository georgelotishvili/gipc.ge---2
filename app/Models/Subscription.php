<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'plan_type_id',
        'plan_id',
        'is_active',
        'recToken',
        'starts_at',
        'ends_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function planType(): BelongsTo
    {
        return $this->belongsTo(PlanType::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class)->ofMany('id', 'MAX');
    }
}
