<?php

namespace App\Models;

use App\Enums\CertificateStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Certificate extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'release_date' => 'date',
        'status' => CertificateStatus::class,
    ];

    /**
     * Get the speciality associated with the certificate.
     * 
     * @return BelongsTo
     */
    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class);
    }

    /**
     * Get the user who owns the certificate.
     * 
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the certificate is expired.
     *
     * @return bool
     */
    public function isExpired()
    {
        $expirationDate = $this->release_date->addYears($this->lifetime_years);
        return now()->greaterThan($expirationDate);
    }

    /**
     * Get the image associated with the certificate.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * Get the comments for the certificate.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get the ratings for the certificate.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function getSpecializationsAttribute()
    {
        return explode(',', $this->description);
    }

    public function getTestimonialsAttribute()
    {
        // This is a placeholder. In a real application, you would have a testimonials table
        return [
            [
                'name' => 'John Doe',
                'position' => 'CEO at Tech Corp',
                'avatar' => 'https://ui-avatars.com/api/?name=John+Doe',
                'text' => 'Excellent work and professional attitude.',
                'rating' => 5
            ],
            [
                'name' => 'Jane Smith',
                'position' => 'CTO at Innovation Inc',
                'avatar' => 'https://ui-avatars.com/api/?name=Jane+Smith',
                'text' => 'Highly skilled and reliable professional.',
                'rating' => 4
            ]
        ];
    }

    public function getColorAttribute()
    {
        return match($this->status) {
            CertificateStatus::ACTIVE => 'green',
            CertificateStatus::SUSPENDED => 'yellow',
            CertificateStatus::TERMINATED => 'red',
            CertificateStatus::EXPIRED => 'gray',
        };
    }

    public function getRatingAttribute()
    {
        // This is a placeholder. In a real application, you would calculate this from actual ratings
        return 4.5;
    }


}

