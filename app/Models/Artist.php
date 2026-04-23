<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = [
        'genre_id',
        'name',
        'bio',
        'is_active',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
