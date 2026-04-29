<?php

namespace App\Models;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\ArtistUser;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'role_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'email_verified',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'email_verified' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Productos favoritos del usuario.
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Productos marcados como favoritos (acceso directo).
     */
    public function favoriteProducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'favorites')
            ->withPivot('added_at');
    }

    /**
     * Artistas seguidos por el usuario.
     */
    public function followedArtists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class, 'artist_user')
            ->using(ArtistUser::class)
            ->withPivot('followed_at');
    }

    public function hasVerifiedEmail(): bool
    {
        return (bool) $this->email_verified;
    }

    public function markEmailAsVerified(): bool
    {
        return $this->forceFill([
            'email_verified' => true,
        ])->save();
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmail);
    }

    public function getEmailForVerification(): string
    {
        return $this->email;
    }
}
