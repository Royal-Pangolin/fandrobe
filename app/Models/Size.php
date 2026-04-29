<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sort_order',
    ];

    public $timestamps = false;

    protected static function booted(): void
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('sort_order', 'asc');
        });
    }
}
