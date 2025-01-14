<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Get the groups that this question belongs to.
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_question')->withPivot('question_id')->withTimestamps();
    }

    public function scopeFilterByGroup($query, $groupName)
    {
        if (!$groupName) {
            return $query;
        }

        return $query->whereHas('groups', function ($query) use ($groupName) {
            $query->where('name', $groupName);
        });
    }
}
