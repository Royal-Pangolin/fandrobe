<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password ' => ' hashed ',
            'email_verified' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the role associated with the user.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
