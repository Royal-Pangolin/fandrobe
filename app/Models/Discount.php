<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'discount_type_id',
        'code',
        'discount_value',
        'min_order_amount',
        'expires_at',
        'max_uses',
        'used_count',
        'is_active',
    ];

    public function discountType()
    {
        return $this->belongsTo(DiscountType::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
