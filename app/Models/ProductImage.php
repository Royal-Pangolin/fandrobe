<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'product_id',
        'variant_id',
        'url',
        'alt_text',
        'is_cover',
        'sort_order',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}