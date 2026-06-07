<?php

namespace App\Models;

use App\Actions\Abecert\DeleteImageAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Enums\WorkTimeType;

class Employer extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'worktime' => WorkTimeType::class,
        'salary' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Employer $employer) {
            $employer->deleteImages();
        });
    }

    /**
     * Get the user that owns the employer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->latestOfMany();
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function deleteImages(): void
    {
        $this->images()->get()->each(function (Image $image) {
            DeleteImageAction::execute($image);
        });
    }
}
