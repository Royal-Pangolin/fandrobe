<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('role')
                     ->orderBy('created_at', 'desc')
                     ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with('role')->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }
}
