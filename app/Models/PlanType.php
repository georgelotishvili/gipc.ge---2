<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanType extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type_name',
        'type_duration',
        'payment_days',
        'is_free',
    ];

    public function plans() : HasMany
    {
        return $this->hasMany(Plan::class);
    }

}
