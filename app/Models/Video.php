<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'free' => 'boolean',
    ];

    /**
     * Get the course that owns the video
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the video title attribute
     */
    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->weight . '. ' . $this->name,
        );
    }

    /**
     * Get the chapter that owns the video
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function imageUrl(): string
    {
        $image = $this->image()->first();
        if ($image && $image->url) {
            return asset('storage/' . $image->path);
        }
        return asset('https://' . config('video.cdn_hostname') . '/' . $this->video_id . '/' . config('video.default_thumbnail_filename'));
    }
}
