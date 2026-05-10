<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'artist_id',
        'name',
        'slug',
        'description',
        'sku',
        'base_price',
        'is_active',
    ];

    /**
     * Nombre traducido del producto.
     */
    public function getTranslatedNameAttribute(): string
    {
        $key = 'messages.prod_' . str_replace('-', '_', $this->slug) . '_name';
        $translated = __($key);
        return $translated !== $key ? $translated : $this->name;
    }

    /**
     * Descripción traducida del producto.
     */
    public function getTranslatedDescriptionAttribute(): ?string
    {
        $key = 'messages.prod_' . str_replace('-', '_', $this->slug) . '_desc';
        $translated = __($key);
        return $translated !== $key ? $translated : $this->description;
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
