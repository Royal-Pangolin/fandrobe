<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->load(['addresses' => function ($q) {
            $q->orderByDesc('is_default')->orderBy('created_at');
        }]);

        return view('profile.index', [
            'user' => $user,
        ]);
    }

    /**
     * Actualiza el idioma preferido del usuario.
     */
    public function updateLocale(Request $request)
    {
        $request->validate([
            'locale' => 'required|in:es,en',
        ]);

        try {
            DB::beginTransaction();
            $request->user()->update(['locale' => $request->locale]);
            DB::commit();

            app()->setLocale($request->locale);

            return back()->with('status', __('messages.language_updated'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}
