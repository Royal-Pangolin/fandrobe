<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Artist;

class HomeController extends Controller
{
    public function index()
    {
        $latestProducts = Product::where('is_active', true)
            ->latest()
            ->take(12)
            ->get();

        $latestIds = $latestProducts->pluck('id');
        $topProducts = Product::where('is_active', true)
            ->whereNotIn('id', $latestIds)
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
