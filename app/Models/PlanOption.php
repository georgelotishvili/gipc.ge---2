<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanOption extends Model
{
    use SoftDeletes;

    public function plans() : HasMany
    {
        return $this->hasMany(Plan::class);
    }
}
