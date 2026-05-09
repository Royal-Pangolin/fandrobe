<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Artist;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('artist', 'categories')
                           ->orderBy('created_at', 'desc')
                           ->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $artists    = Artist::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create', compact('artists', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'artist_id'   => ['required', 'integer', 'exists:artists,id'],
            'categories'  => ['required', 'array', 'min:1'],
            'categories.*'=> ['integer', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'base_price'  => ['required', 'numeric', 'min:0'],
            'sku'         => ['nullable', 'string', 'max:100', 'unique:products,sku'],
            'is_active'   => ['boolean'],
        ]);

        try {
            DB::beginTransaction();

            $product = Product::create([
                'artist_id'   => $request->artist_id,
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'description' => $request->description,
                'sku'         => $request->sku,
                'base_price'  => $request->base_price,
                'is_active'   => $request->boolean('is_active'),
            ]);

            $product->categories()->sync($request->categories);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', __('messages.product_create_error'));
        }

        return redirect()->route('admin.productos.index')->with('mensaje', __('messages.product_created'));
    }

    public function edit($id)
    {
        $product           = Product::with('categories')->findOrFail($id);
        $artists           = Artist::orderBy('name')->get();
        $categories        = Category::orderBy('name')->get();
        $selectedCategories = $product->categories->pluck('id')->toArray();

        return view('admin.products.edit', compact('product', 'artists', 'categories', 'selectedCategories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'artist_id'   => ['required', 'integer', 'exists:artists,id'],
            'categories'  => ['required', 'array', 'min:1'],
            'categories.*'=> ['integer', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'base_price'  => ['required', 'numeric', 'min:0'],
            'sku'         => ['nullable', 'string', 'max:100', "unique:products,sku,{$id}"],
            'is_active'   => ['boolean'],
        ]);

        try {
            DB::beginTransaction();

            $product->update([
                'artist_id'   => $request->artist_id,
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'description' => $request->description,
                'sku'         => $request->sku,
                'base_price'  => $request->base_price,
                'is_active'   => $request->boolean('is_active'),
            ]);

            $product->categories()->sync($request->categories);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', __('messages.product_update_error'));
        }

        return redirect()->route('admin.productos.index')->with('mensaje', __('messages.product_updated'));
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            Product::findOrFail($id)->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', __('messages.product_delete_error'));
        }

        return redirect()->route('admin.productos.index')->with('mensaje', __('messages.product_deleted'));
    }
}
