<?php

namespace App\Models;

// Uncomment the following line when you want to enable email verification
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
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

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

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
}
