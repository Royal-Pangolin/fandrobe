<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fandrobe - @yield('title', 'Inicio')</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-body text-dark d-flex flex-column min-vh-100">

    <!-- Header -->
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand d-flex align-items-center fw-bolder fs-4 text-dark" href="{{ route('home') }}">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 18V5l12-2v13" />
                    <circle cx="6" cy="18" r="3" />
                    <circle cx="18" cy="16" r="3" />
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
                        <a href="{{ route('cart.index') }}" class="nav-cart-link text-decoration-none position-relative"
                            title="Mi carrito">
                            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span id="cart-badge"
                                class="position-absolute top-0 start-100 translate-middle badge bg-dark text-white"
                                style="{{ $cartCount === 0 ? 'display:none;' : '' }}">
                                {{ $cartCount }}
                            </span>
                        </a>

                        <!-- User dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-sm fw-semibold dropdown-toggle btn-user-menu" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->first_name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm dropdown-menu-user">

                                {{-- Identidad --}}
                                <li class="px-3 py-2">
                                    <p class="fw-bold mb-0 small">{{ auth()->user()->first_name }}
                                        {{ auth()->user()->last_name }}</p>
                                    <p class="text-muted mb-0 admin-email-small">{{ auth()->user()->email }}</p>
                                </li>

                                @if (auth()->user()->role?->name === 'admin')
                                    <li>
                                        <hr class="dropdown-divider my-1">
                                    </li>
                                    <li>
                                        <a class="dropdown-item fw-bold d-flex align-items-center gap-2 rounded-2 dropdown-item-admin"
                                            href="{{ route('admin.index') }}">
                                            <svg width="14" height="14" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                                </path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                            Panel de administración
                                        </a>
                                    </li>
                                @endif

                                <li>
                                    <hr class="dropdown-divider my-1">
                                </li>

                                <li><a class="dropdown-item rounded-2 dropdown-item-sm" href="{{ route('profile') }}">Mi
                                        perfil</a></li>
                                <li><a class="dropdown-item rounded-2 dropdown-item-sm"
                                        href="{{ route('orders.index') }}">Mis pedidos</a></li>

                                <li>
                                    <hr class="dropdown-divider my-1">
                                </li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="dropdown-item rounded-2 dropdown-item-sm text-danger fw-semibold">
                                            Cerrar sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('cart.index') }}" class="nav-cart-link text-decoration-none position-relative"
                            title="Mi carrito">
                            <svg width="24" height="24" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
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
        <div class="navbar-spacer"></div>
    @endif

    <!-- Page Content -->
    @auth
        @if (!auth()->user()->hasVerifiedEmail())
            <div class="alert alert-warning alert-dismissible fade show mb-0 rounded-0 d-flex align-items-center gap-2"
                role="alert">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    style="flex-shrink:0;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                </svg>
                <span>
                    Tu correo electrónico no está verificado.
                    <form method="POST" action="{{ route('verification.send') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="alert-link btn btn-link p-0 align-baseline fw-semibold">
                            Reenviar correo de verificación
                        </button>
                    </form>
                </span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
    @endauth

    @yield('content')
    <!-- Footer -->
    <footer class="site-footer py-5 mt-auto">
        <div class="container-fluid px-4 px-lg-5">
            <div class="row g-5">
                <div class="col-md-5">
                    <a href="{{ route('home') }}"
                        class="footer-brand d-flex align-items-center mb-3 text-decoration-none fw-bolder fs-4">
                        <svg class="me-2" width="28" height="28" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 18V5l12-2v13" />
                            <circle cx="6" cy="18" r="3" />
                            <circle cx="18" cy="16" r="3" />
                        </svg>
                        Fandrobe
                    </a>
                    <p class="footer-description">
                        Conectando artistas excepcionales con coleccionistas apasionados.
                        Autenticidad garantizada en cada obra y mercancía oficial.
                    </p>
                    <div class="d-flex gap-3 mt-4">
                        <span class="badge badge-verified badge-sm">Piezas Oficiales</span>
                        <span class="badge badge-limited badge-sm">Cert. Autenticidad</span>
                    </div>
                </div>

                <div class="col-md-3 offset-md-1">
                    <h6 class="footer-section-title fw-bold mb-4 text-uppercase">Explorar</h6>
                    <ul class="footer-nav-list list-unstyled d-flex flex-column gap-2">
                        <li><a href="{{ route('products.index') }}"
                                class="footer-link text-decoration-none fw-medium">Catálogo</a></li>
                        <li><a href="{{ route('artists.index') }}"
                                class="footer-link text-decoration-none fw-medium">Artistas</a></li>
                        <li><a href="#" class="footer-link text-decoration-none fw-medium">Autenticidad</a></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <h6 class="footer-section-title fw-bold mb-4 text-uppercase">Ayuda</h6>
                    <ul class="footer-nav-list list-unstyled d-flex flex-column gap-2">
                        <li><a href="#" class="footer-link text-decoration-none fw-medium">Contacto</a></li>
                        <li><a href="#" class="footer-link text-decoration-none fw-medium">Envíos y
                                devoluciones</a></li>
                        <li><a href="#" class="footer-link text-decoration-none fw-medium">FAQ</a></li>
                    </ul>
                </div>
            </div>

            <div
                class="footer-bottom mt-5 pt-4 d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <p class="footer-copyright mb-0 small">&copy; 2026 Fandrobe. Todos los derechos reservados.</p>
                <p class="footer-copyright mb-0 small">Hecho con arte · Verificado con confianza</p>
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
