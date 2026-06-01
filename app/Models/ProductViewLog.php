<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class ProductViewLog extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'product_view_logs';

    protected $fillable = [
        'product_id',
        'user_id',
        'ip_address',
        'user_agent',
        'viewed_at'
    ];
}
