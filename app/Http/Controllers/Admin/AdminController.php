<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Artist;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $pendingOrders  = Order::whereHas('status', fn($q) => $q->where('name', 'pending'))->count();
        $totalOrders    = Order::count();
        $totalProducts  = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $totalArtists   = Artist::count();
        $totalUsers     = User::count();

        return view('admin.index', compact(
            'pendingOrders', 'totalOrders',
            'totalProducts', 'activeProducts',
            'totalArtists', 'totalUsers'
        ));
    }
}
