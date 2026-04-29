<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::with('genre')
                         ->withCount('products')
                         ->orderBy('name')
                         ->paginate(20);

        return view('admin.artists.index', compact('artists'));
    }

    public function create()
    {
        $genres = Genre::orderBy('name')->get();

        return view('admin.artists.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'genre_id'  => ['required', 'integer', 'exists:genres,id'],
            'bio'       => ['nullable', 'string'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'is_active' => ['boolean'],
        ]);

        try {
            DB::beginTransaction();

            Artist::create([
                'genre_id'  => $request->genre_id,
                'name'      => $request->name,
                'bio'       => $request->bio,
                'image_url' => $request->image_url,
                'is_active' => $request->boolean('is_active'),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error al crear el artista.');
        }

        return redirect()->route('admin.artistas.index')->with('mensaje', 'Artista creado correctamente.');
    }

    public function edit($id)
    {
        $artist = Artist::findOrFail($id);
        $genres = Genre::orderBy('name')->get();

        return view('admin.artists.edit', compact('artist', 'genres'));
    }

    public function update(Request $request, $id)
    {
        $artist = Artist::findOrFail($id);

        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'genre_id'  => ['required', 'integer', 'exists:genres,id'],
            'bio'       => ['nullable', 'string'],
            'image_url' => ['nullable', 'url', 'max:500'],
            'is_active' => ['boolean'],
        ]);

        try {
            DB::beginTransaction();

            $artist->update([
                'genre_id'  => $request->genre_id,
                'name'      => $request->name,
                'bio'       => $request->bio,
                'image_url' => $request->image_url,
                'is_active' => $request->boolean('is_active'),
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error al actualizar el artista.');
        }

        return redirect()->route('admin.artistas.index')->with('mensaje', 'Artista actualizado correctamente.');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            Artist::findOrFail($id)->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al eliminar el artista.');
        }

        return redirect()->route('admin.artistas.index')->with('mensaje', 'Artista eliminado correctamente.');
    }
}
