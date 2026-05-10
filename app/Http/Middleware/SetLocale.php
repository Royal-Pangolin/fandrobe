<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Establece el idioma de la aplicación según la preferencia del usuario.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->locale) {
            app()->setLocale(auth()->user()->locale);
        }

        return $next($request);
    }
}
