<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Artist;

class HomeController extends Controller
{
    public function index()
    {
        $latestProducts = Product::with(['images', 'artist'])
            ->where('is_active', true)
            ->latest()
            ->take(12)
            ->get();

        $topProducts = Product::with(['images', 'artist'])
            ->withSum('orderItems as units_sold', 'quantity')
            ->where('is_active', true)
            ->has('orderItems')
            ->orderByDesc('units_sold')
            ->latest()
            ->take(10)
            ->get();

        $newestArtists = Artist::where('is_active', true)
            ->latest()
            ->take(6)
            ->get();

        return view('home.index', compact(
            'latestProducts',
            'topProducts', 'newestArtists'
        ));
    }
}
