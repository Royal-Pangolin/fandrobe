<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)
                           ->where('is_active', true)
                           ->get();

        return view('categories.show', compact('category', 'products'));
    }
}
