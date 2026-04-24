<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->get();
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with(['variants', 'images', 'artist', 'reviews'])->findOrFail($id);

        return view('products.show', compact('product'));
    }
}
