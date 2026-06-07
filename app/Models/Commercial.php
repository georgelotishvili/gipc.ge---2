<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;

class Commercial extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    protected $casts = [
        'expiration_date' => 'datetime',
        'weight' => 'float',
        'duration_weight' => 'float',
    ];

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getImageLinkAttribute()
    {
        if ($this->image) {
            return Storage::url($this->image->path);
        }

        if (!$this->img_link) {
            return null;
        }

        if (str_starts_with($this->img_link, 'http://') || str_starts_with($this->img_link, 'https://') || str_starts_with($this->img_link, '/')) {
            return $this->img_link;
        }

        return Storage::url($this->img_link);
    }
}
