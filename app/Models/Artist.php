<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Artist extends Model
{
    protected $fillable = [
        'genre_id',
        'name',
        'bio',
        'image_url',
        'is_active',
    ];

    /**
     * Biografía traducida del artista.
     */
    public function getTranslatedBioAttribute(): ?string
    {
        $key = 'messages.bio_' . str_replace('-', '_', Str::slug($this->name));
        $translated = __($key);
        return $translated !== $key ? $translated : $this->bio;
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Usuarios que siguen a este artista.
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'artist_user')
            ->withPivot('followed_at');
    }
}
