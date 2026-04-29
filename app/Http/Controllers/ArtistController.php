<?php

namespace App\Http\Controllers;

use App\Models\Artist;

class ArtistController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Artist::where('is_active', true);

        if ($search = $request->input('q')) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $artists = $query->orderBy('name')->get();

        return view('artists.index', compact('artists'));
    }

    public function show($id)
    {
        $artist = Artist::with(['products.category', 'products.images', 'genre'])->findOrFail($id);

        return view('artists.show', compact('artist'));
    }
}
