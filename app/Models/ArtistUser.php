<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ArtistUser extends Pivot
{
    public $timestamps = false;

    protected $table = 'artist_user';

    protected $fillable = [
        'user_id',
        'artist_id',
    ];

    protected $dates = ['followed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
