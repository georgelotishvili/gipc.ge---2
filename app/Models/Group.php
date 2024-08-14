<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the material that owns this bim material.
     */
    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'group_question')->withPivot('group_question')->withTimestamps();
    }
}
