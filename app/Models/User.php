<?php

namespace App\Models;

// Uncomment the following line when you want to enable email verification
// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\SubscriptionType;
use App\Models\Traits\HasSubscription;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

// To enable email verification, uncomment MustVerifyEmail implementation
class User extends Authenticatable /* implements MustVerifyEmail */
{
    use HasApiTokens;
    use SoftDeletes;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasSubscription;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'terms_accepted',
        'terms_accepted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'terms_accepted' => 'boolean',
            'terms_accepted_at' => 'datetime',
        ];
    }

    /**
     * User's exam requests relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examRequests(): HasMany
    {
        return $this->hasMany(ExamRequest::class);
    }

    /**
     * Send the email verification notification.
     * Uncomment this method when you want to enable email verification
     *
     * @return void

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyEmailNotification());
    }
    */

    /**
     * User's employer relationship.
     *
     * @return HasMany
     */
    public function employers(): HasMany
    {
        return $this->hasMany(Employer::class);
    }

    /**
     * Get the payments for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function currentSubscriptionRecord(): ?Subscription
    {
        return $this->subscriptions()
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('ends_at')->orWhere('ends_at', '>', now());
            })
            ->orderByDesc('ends_at')
            ->orderByDesc('id')
            ->first()
            ?? $this->subscriptions()
                ->orderByDesc('ends_at')
                ->orderByDesc('id')
                ->first();
    }

    /**
     * Get the employees for the user.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * Get the user's profile image.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * Get the subscription for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class);
    }

    /**
     * Get the subscription for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function isSubscriptionActive(): bool
    {
        // Use the trait method which is consistent
        return $this->hasActiveSubscription();
    }
}
