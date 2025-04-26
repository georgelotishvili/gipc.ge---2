<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

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
        if($this->image)
        {
            if($this->image->url)
            {
                return asset('storage/' . $this->image->path);
            }
        }
        return asset('https://'. config('video.cdn_hostname') .'/'. $this->video_id .'/'. config('video.default_thumbnail_filename'));
    }
}
