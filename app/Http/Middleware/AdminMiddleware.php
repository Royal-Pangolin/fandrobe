<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role->name !== 'admin') {
            abort(403, 'Acceso restringido al panel de administración.');
        }

        return $next($request);
    }
}
