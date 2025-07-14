<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the full URL for the image
     *
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return Storage::url($this->path);
    }
}
