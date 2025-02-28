<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    
    /**
     * Get all chapters for the course
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }

    /**
     * Get all videos for the course
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
