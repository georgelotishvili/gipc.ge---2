<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chapter extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get the course that owns the chapter
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get all videos for the chapter
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }
}
