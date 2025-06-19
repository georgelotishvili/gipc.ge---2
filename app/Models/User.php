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

    /**
     * Get the employees for the user.
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * Get the certificates for the user.
     */
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    /**
     * Get the comments created by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
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
     * Get the ratings for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
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
        // If the user doesn't have a subscription, return false
        if (!$this->subscription)
        {
            return false;
        }

        if($this->subscription->is_active) //ბეკურამ დავამატე ეს ახლა
        {
            return true;
        }

        // If the subscription type is unlimited, it's always active
        if ($this->subscription->type === SubscriptionType::UNLIMITED->value)
        {
            return true;
        }

        // If starts_at is null, subscription hasn't started yet
        if (!$this->subscription->starts_at)
        {
            return false;
        }

        // Calculate end date based on subscription type
        $endDate = null;
        $startDate = Carbon::parse($this->subscription->starts_at);

        switch ($this->subscription->type)
        {
            case SubscriptionType::WEEKLY->value:
                $endDate = $startDate->copy()->addWeek();
                break;
            case SubscriptionType::MONTHLY->value:
                $endDate = $startDate->copy()->addMonth();
                break;
            case SubscriptionType::YEARLY->value:
                $endDate = $startDate->copy()->addYear();
                break;
        }

        $now = now();
        $isActive = $now->greaterThanOrEqualTo($startDate) && $now->lessThan($endDate);
        $this->subscription->is_active = $isActive;
        $this->subscription->ends_at = $endDate;
        $this->subscription->save();
        return $isActive;
    }
}
