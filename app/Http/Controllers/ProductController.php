<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Product::with(['images', 'artist'])
            ->where('is_active', true);

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhereHas('artist', fn ($q) => $q->where('name', 'like', '%' . $search . '%'));
            });
        }

        if ($cats = $request->input('categories')) {
            $query->whereIn('category_id', $cats);
        }

        if ($priceMax = $request->input('price_max')) {
            $query->where('base_price', '<=', $priceMax);
        }

        match ($request->input('sort')) {
            'price_asc'  => $query->orderBy('base_price', 'asc'),
            'price_desc' => $query->orderBy('base_price', 'desc'),
            'newest'     => $query->latest(),
            default      => $query->orderBy('id'),
        };

        $products    = $query->paginate(12)->withQueryString();
        $categories  = Category::all();
        $absoluteMax = (int) (Product::where('is_active', true)->max('base_price') ?? 500);

        return view('products.index', compact('products', 'categories', 'absoluteMax'));
    }

    public function show($id)
    {
        $product = Product::with(['variants', 'images', 'artist', 'reviews'])->findOrFail($id);

        return view('products.show', compact('product'));
    }
}
