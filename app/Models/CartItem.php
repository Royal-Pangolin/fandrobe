<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'cart_id',
        'product_id',
        'variant_id',
        'quantity',
    ];

    public function cart()
    {
        return $this->belongsTo(ShoppingCart::class, 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }
}
