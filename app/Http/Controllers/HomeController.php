<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Artist;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->take(8)->get();
        $artists = Artist::where('is_active', true)->take(6)->get();

        return view('home.index', compact('products', 'artists'));
    }
}
