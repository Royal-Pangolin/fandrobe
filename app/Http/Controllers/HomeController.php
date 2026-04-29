<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Artist;

class HomeController extends Controller
{
    public function index()
    {
        // Últimos lanzamientos (fila horizontal, hasta 12)
        $latestProducts = Product::where('is_active', true)
            ->latest()
            ->take(12)
            ->get();

        // Obras más vendidas (excluyendo los últimos lanzamientos para no repetir)
        $latestIds = $latestProducts->pluck('id');
        $topProducts = Product::where('is_active', true)
            ->whereNotIn('id', $latestIds)
            ->take(10)
            ->get();

        // Artistas más nuevos
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
