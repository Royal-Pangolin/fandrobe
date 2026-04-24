<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Everlasting Art') }} - @yield('title', 'Inicio')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-beige-50 text-beige-900 selection:bg-beige-500 selection:text-white">
        <div class="min-h-screen flex flex-col">
            <!-- Navigation -->
            <nav class="bg-beige-100 border-b border-beige-200 shadow-sm relative z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-20">
                        <div class="flex items-center">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ url('/') }}" class="text-3xl font-bold tracking-tight text-beige-900 hover:text-beige-700 transition">
                                    Everlasting Art
                                </a>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden sm:-my-px sm:ml-10 sm:flex sm:space-x-8">
                                <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold text-beige-700 hover:text-beige-900 hover:border-beige-400 focus:outline-none transition">
                                    Inicio
                                </a>
                                <a href="{{ route('products.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold text-beige-700 hover:text-beige-900 hover:border-beige-400 focus:outline-none transition">
                                    Catálogo
                                </a>
                                <a href="{{ route('artists.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold text-beige-700 hover:text-beige-900 hover:border-beige-400 focus:outline-none transition">
                                    Artistas
                                </a>
                                <a href="{{ route('categories.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-semibold text-beige-700 hover:text-beige-900 hover:border-beige-400 focus:outline-none transition">
                                    Disciplinas
                                </a>
                            </div>
                        </div>
                        
                        <!-- Actions -->
                        <div class="hidden sm:flex sm:items-center sm:space-x-6">
                            <a href="#" class="text-sm text-beige-700 hover:text-beige-900 flex items-center transition">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                (0)
                            </a>
                            <a href="#" class="bg-beige-800 text-beige-50 px-4 py-2 rounded-md text-sm font-medium hover:bg-beige-900 transition">Entrar</a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            @hasSection('header')
                <header class="bg-beige-100 shadow-sm border-b border-beige-200">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-grow w-full">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-beige-900 text-beige-200 py-12 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <h3 class="text-xl font-bold text-beige-50 mb-4">Everlasting Art</h3>
                        <p class="text-sm text-beige-300 max-w-sm">Conectando artistas excepcionales con coleccionistas apasionados. Autenticidad garantizada en cada obra y mercancía.</p>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-beige-50 uppercase tracking-wider mb-4">Enlaces Rápidos</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="{{ route('products.index') }}" class="hover:text-beige-50 transition">Catálogo</a></li>
                            <li><a href="{{ route('artists.index') }}" class="hover:text-beige-50 transition">Artistas</a></li>
                            <li><a href="#" class="hover:text-beige-50 transition">Autenticidad</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-beige-50 uppercase tracking-wider mb-4">Ayuda</h4>
                        <ul class="space-y-2 text-sm">
                            <li><a href="#" class="hover:text-beige-50 transition">Contacto</a></li>
                            <li><a href="#" class="hover:text-beige-50 transition">Envíos y devoluciones</a></li>
                            <li><a href="#" class="hover:text-beige-50 transition">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 pt-8 border-t border-beige-800 text-sm text-center text-beige-400">
                    <p>&copy; {{ date('Y') }} Everlasting Art. Todos los derechos reservados.</p>
                </div>
            </footer>
        </div>
    </body>
</html>
