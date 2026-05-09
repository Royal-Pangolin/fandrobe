<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
