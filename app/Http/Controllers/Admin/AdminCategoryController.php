<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')
                              ->orderBy('name')
                              ->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::orderBy('name')->get();

        return view('admin.categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
            'image_url' => ['nullable', 'url', 'max:500'],
        ]);

        try {
            DB::beginTransaction();

            Category::create([
                'parent_id' => $request->parent_id ?: null,
                'name'      => $request->name,
                'slug'      => Str::slug($request->name),
                'image_url' => $request->image_url,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error al crear la categoría.');
        }

        return redirect()->route('admin.categorias.index')->with('mensaje', 'Categoría creada correctamente.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $parents  = Category::where('id', '!=', $id)->orderBy('name')->get();

        return view('admin.categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
            'image_url' => ['nullable', 'url', 'max:500'],
        ]);

        try {
            DB::beginTransaction();

            $category->update([
                'parent_id' => $request->parent_id ?: null,
                'name'      => $request->name,
                'slug'      => Str::slug($request->name),
                'image_url' => $request->image_url,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error al actualizar la categoría.');
        }

        return redirect()->route('admin.categorias.index')->with('mensaje', 'Categoría actualizada correctamente.');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            Category::findOrFail($id)->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al eliminar la categoría. Puede que tenga productos asociados.');
        }

        return redirect()->route('admin.categorias.index')->with('mensaje', 'Categoría eliminada correctamente.');
    }
}
