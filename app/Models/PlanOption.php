<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanOption extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function plans() : BelongsTo
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }
}
