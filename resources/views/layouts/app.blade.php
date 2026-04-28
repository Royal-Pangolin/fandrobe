<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Everlasting Art - @yield('title', 'Inicio')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    <style>
        body {
            font-family: var(--bs-body-font-family);
        }

        .navbar-brand svg {
            margin-right: 8px;
        }

        main {
            min-height: calc(100vh - 250px);
            padding-bottom: 60px;
        }
    </style>
</head>

<body class="bg-body text-dark d-flex flex-column min-vh-100">

    <!-- Header -->
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center fw-bolder fs-4 text-dark" href="{{ route('home') }}">
                <svg class="h-8 w-8 text-primary" width="32" height="32" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path
                        d="M12 21a9 9 0 0 1 -3.665 -17.236l1.092 1.942a7 7 0 0 0 5.146 11.294l-1.093 1.942a9 9 0 0 1 -1.48 .058z">
                    </path>
                    <path d="M12 18l-.5 -1l2.5 -4.5l-2 -3.5l1.5 -3l2.5 4.5l-2 3.5l1.5 3l-3.5 1z"></path>
                </svg>
                Fandrobe
            </a>

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ route('home') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ route('products.index') }}">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ route('artists.index') }}">Artistas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ route('categories.index') }}">Disciplinas</a>
                    </li>
                </ul>

                <!-- Right Side -->
                <div class="d-flex align-items-center gap-3">
                    @php
                        $navCart = auth()->check()
                            ? \App\Models\ShoppingCart::where('user_id', auth()->id())
                                ->where('status', 'active')
                                ->first()
                            : null;
                        $cartCount = $navCart ? $navCart->items()->sum('quantity') : 0;
                    @endphp

                    @auth
                        <!-- Cart -->
                        <a href="{{ route('cart.index') }}" class="text-decoration-none position-relative"
                            style="color: var(--color-shadow);" title="Mi carrito">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span id="cart-badge"
                                class="position-absolute top-0 start-100 translate-middle badge bg-primary text-shadow"
                                style="font-size: 0.6rem; border-radius: 500px; {{ $cartCount === 0 ? 'display:none;' : '' }}">
                                {{ $cartCount }}
                            </span>
                        </a>

                        <!-- User dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->first_name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><span class="dropdown-item-text text-muted small">{{ auth()->user()->email }}</span>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Mi perfil</a></li>
                                <li><a class="dropdown-item" href="{{ route('cart.index') }}">Mi carrito</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            Cerrar sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('cart.index') }}" class="text-decoration-none position-relative"
                            style="color: var(--color-shadow);" title="Mi carrito">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Entrar</a>
                        <a href="{{ route('signin') }}" class="btn btn-secondary btn-sm">Registrarse</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Heading -->
    @hasSection('header')
        <header class="hero-gradient">
            <div class="container">
                @yield('header')
            </div>
        </header>
    @else
        <div style="height: 76px;"></div> <!-- Spacer for fixed navbar -->
    @endif

    <!-- Page Content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-5 mt-auto" style="background-color: var(--color-secondary); color: var(--color-primary);">
        <div class="container-fluid px-4 px-lg-5">
            <div class="row g-5">
                <div class="col-md-5">
                    <a href="{{ route('home') }}"
                        class="d-flex align-items-center mb-3 text-decoration-none fw-bolder fs-4"
                        style="color: var(--color-primary);">
                        <svg class="me-2" width="28" height="28" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M12 21a9 9 0 0 1 -3.665 -17.236l1.092 1.942a7 7 0 0 0 5.146 11.294l-1.093 1.942a9 9 0 0 1 -1.48 .058z">
                            </path>
                            <path d="M12 18l-.5 -1l2.5 -4.5l-2 -3.5l1.5 -3l2.5 4.5l-2 3.5l1.5 3l-3.5 1z"></path>
                        </svg>
                        Fandrobe
                    </a>
                    <p style="color: rgba(247,241,231,0.55); font-size: 0.875rem; max-width: 320px; line-height: 1.7;">
                        Conectando artistas excepcionales con coleccionistas apasionados.
                        Autenticidad garantizada en cada obra y mercancía oficial.
                    </p>
                    <div class="d-flex gap-3 mt-4">
                        <span class="badge badge-verified" style="font-size: 0.7rem;">Piezas Oficiales</span>
                        <span class="badge badge-limited" style="font-size: 0.7rem;">Cert. Autenticidad</span>
                    </div>
                </div>

                <div class="col-md-3 offset-md-1">
                    <h6 class="fw-bold mb-4 text-uppercase"
                        style="letter-spacing: 0.12em; font-size: 0.75rem; color: rgba(247,241,231,0.5);">
                        Explorar
                    </h6>
                    <ul class="list-unstyled d-flex flex-column gap-2" style="font-size: 0.9rem;">
                        <li><a href="{{ route('products.index') }}"
                                class="text-decoration-none fw-medium footer-link"
                                style="color: var(--color-primary);">Catálogo</a></li>
                        <li><a href="{{ route('artists.index') }}" class="text-decoration-none fw-medium footer-link"
                                style="color: var(--color-primary);">Artistas</a></li>
                        <li><a href="{{ route('categories.index') }}"
                                class="text-decoration-none fw-medium footer-link"
                                style="color: var(--color-primary);">Disciplinas</a></li>
                        <li><a href="#" class="text-decoration-none fw-medium footer-link"
                                style="color: var(--color-primary);">Autenticidad</a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h6 class="fw-bold mb-4 text-uppercase"
                        style="letter-spacing: 0.12em; font-size: 0.75rem; color: rgba(247,241,231,0.5);">
                        Ayuda
                    </h6>
                    <ul class="list-unstyled d-flex flex-column gap-2" style="font-size: 0.9rem;">
                        <li><a href="#" class="text-decoration-none fw-medium footer-link"
                                style="color: var(--color-primary);">Contacto</a></li>
                        <li><a href="#" class="text-decoration-none fw-medium footer-link"
                                style="color: var(--color-primary);">Envíos y devoluciones</a></li>
                        <li><a href="#" class="text-decoration-none fw-medium footer-link"
                                style="color: var(--color-primary);">FAQ</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-5 pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2"
                style="border-top: 1px solid rgba(247,241,231,0.12);">
                <p class="mb-0 small" style="color: rgba(247,241,231,0.4);">
                    &copy; 2026 Everlasting Art. Todos los derechos reservados.
                </p>
                <p class="mb-0 small" style="color: rgba(247,241,231,0.4);">
                    Hecho con arte · Verificado con confianza
                </p>
            </div>
        </div>
    </footer>
    @stack('scripts')
    <script>
        // Navbar se vuelve sólida al hacer scroll
        (function() {
            const navbar = document.querySelector('.navbar');
            if (!navbar) return;
            const onScroll = () => {
                navbar.classList.toggle('scrolled', window.scrollY > 20);
            };
            window.addEventListener('scroll', onScroll, {
                passive: true
            });
            onScroll(); // run on load
        })();
    </script>
</body>

</html>
