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
        $products = Product::with('artist', 'category')
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
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'base_price'  => ['required', 'numeric', 'min:0'],
            'sku'         => ['nullable', 'string', 'max:100', 'unique:products,sku'],
            'is_active'   => ['boolean'],
        ]);

        try {
            DB::beginTransaction();

            Product::create([
                'artist_id'   => $request->artist_id,
                'category_id' => $request->category_id,
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'description' => $request->description,
                'sku'         => $request->sku,
                'base_price'  => $request->base_price,
                'is_active'   => $request->boolean('is_active'),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error al crear el producto.');
        }

        return redirect()->route('admin.productos.index')->with('mensaje', 'Producto creado correctamente.');
    }

    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $artists    = Artist::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'artists', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'artist_id'   => ['required', 'integer', 'exists:artists,id'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'base_price'  => ['required', 'numeric', 'min:0'],
            'sku'         => ['nullable', 'string', 'max:100', "unique:products,sku,{$id}"],
            'is_active'   => ['boolean'],
        ]);

        try {
            DB::beginTransaction();

            $product->update([
                'artist_id'   => $request->artist_id,
                'category_id' => $request->category_id,
                'name'        => $request->name,
                'slug'        => Str::slug($request->name),
                'description' => $request->description,
                'sku'         => $request->sku,
                'base_price'  => $request->base_price,
                'is_active'   => $request->boolean('is_active'),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error al actualizar el producto.');
        }

        return redirect()->route('admin.productos.index')->with('mensaje', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            Product::findOrFail($id)->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al eliminar el producto.');
        }

        return redirect()->route('admin.productos.index')->with('mensaje', 'Producto eliminado correctamente.');
    }
}
