<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\ArtistUser;
use App\Models\Product;
use App\Models\Artist;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Alternar producto como favorito (añadir/quitar).
     */
    public function toggleProduct(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        $userId    = auth()->id();
        $productId = $request->input('product_id');

        $existing = Favorite::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($existing) {
            $existing->delete();
            $isFavorite = false;
        } else {
            Favorite::create([
                'user_id'    => $userId,
                'product_id' => $productId,
            ]);
            $isFavorite = true;
        }

        // Si es petición AJAX, devolver JSON
        if ($request->expectsJson()) {
            return response()->json(['is_favorite' => $isFavorite]);
        }

        return back();
    }

    /**
     * Alternar seguir/dejar de seguir artista.
     */
    public function toggleArtist(Request $request)
    {
        $request->validate(['artist_id' => 'required|exists:artists,id']);

        $userId   = auth()->id();
        $artistId = $request->input('artist_id');

        $existing = ArtistUser::where('user_id', $userId)
            ->where('artist_id', $artistId)
            ->first();

        if ($existing) {
            $existing->delete();
            $isFollowing = false;
        } else {
            ArtistUser::create([
                'user_id'   => $userId,
                'artist_id' => $artistId,
            ]);
            $isFollowing = true;
        }

        // Si es petición AJAX, devolver JSON
        if ($request->expectsJson()) {
            return response()->json(['is_following' => $isFollowing]);
        }

        return back();
    }

    /**
     * Vista: Productos favoritos del usuario.
     */
    public function favoriteProducts()
    {
        $favorites = Favorite::where('user_id', auth()->id())
            ->with(['product.images', 'product.artist'])
            ->orderByDesc('added_at')
            ->get();

        return view('favorites.products', compact('favorites'));
    }

    /**
     * Vista: Artistas seguidos por el usuario.
     */
    public function followedArtists()
    {
        $artists = auth()->user()
            ->followedArtists()
            ->withPivot('followed_at')
            ->orderByDesc('artist_user.followed_at')
            ->get();

        return view('favorites.artists', compact('artists'));
    }
}
