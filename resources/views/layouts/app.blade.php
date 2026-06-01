<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fandrobe - @yield('title', __('messages.nav_home'))</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-primary text-shadow min-h-screen flex flex-col font-sans antialiased">

    <!-- Global Page Loader -->
    <div id="global-loader" class="fixed inset-0 z-[9999] bg-primary flex flex-col items-center justify-center transition-opacity duration-500 ease-in-out">
        <div class="relative w-40 h-40 animate-[spin_2s_linear_infinite]">
            <!-- Vinyl Record Outer -->
            <div class="absolute inset-0 bg-[#111] rounded-full shadow-2xl border-4 border-[#222] flex items-center justify-center">
                <!-- Vinyl Grooves -->
                <div class="absolute inset-2 border border-white/5 rounded-full"></div>
                <div class="absolute inset-4 border border-white/10 rounded-full"></div>
                <div class="absolute inset-6 border border-white/5 rounded-full"></div>
                <div class="absolute inset-8 border border-white/10 rounded-full"></div>
                <div class="absolute inset-10 border border-white/5 rounded-full"></div>
                <div class="absolute inset-12 border border-white/10 rounded-full"></div>
                
                <!-- Vinyl Center Label (Red) -->
                <div class="absolute w-16 h-16 bg-error rounded-full shadow-inner flex items-center justify-center overflow-hidden border border-[#111]">
                    <!-- Label Decoration -->
                    <div class="absolute inset-0 bg-gradient-to-br from-white/30 to-transparent"></div>
                    <div class="absolute w-12 h-12 border border-white/20 rounded-full"></div>
                    
                    <!-- Spindle hole -->
                    <div class="w-3 h-3 bg-primary rounded-full absolute z-10 shadow-inner border border-shadow/20"></div>
                    
                    <!-- Text on Vinyl -->
                    <span class="text-[9px] font-extrabold text-white tracking-widest uppercase z-0 -translate-y-3">Fandrobe</span>
                </div>
                
                <!-- Light reflection -->
                <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-white/10 to-transparent rounded-full"></div>
                <div class="absolute inset-0 bg-gradient-to-bl from-transparent via-white/5 to-transparent rounded-full transform rotate-90"></div>
            </div>
        </div>
        
        <h3 class="mt-10 text-shadow font-extrabold tracking-[0.3em] uppercase animate-pulse text-sm">
            Cargando...
        </h3>
    </div>

    <nav id="navbar" class="fixed w-full top-0 z-50 bg-primary/90 backdrop-blur-md py-4 transition-all duration-300">
        <div class="container mx-auto px-4 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a class="flex items-center gap-2 font-extrabold text-2xl text-shadow" href="{{ route('home') }}">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 18V5l12-2v13" />
                        <circle cx="6" cy="18" r="3" />
                        <circle cx="18" cy="16" r="3" />
                    </svg>
                    Fandrobe
                </a>

                <ul class="hidden md:flex items-center gap-6">
                    <li><a class="font-semibold hover:text-accent transition-colors" href="{{ route('home') }}">{{ __('messages.nav_home') }}</a></li>
                    <li><a class="font-semibold hover:text-accent transition-colors" href="{{ route('products.index') }}">{{ __('messages.nav_catalog') }}</a></li>
                    <li><a class="font-semibold hover:text-accent transition-colors" href="{{ route('artists.index') }}">{{ __('messages.nav_artists') }}</a></li>
                </ul>
            </div>

            <div class="flex items-center gap-4">
                @php
                    $navCart = auth()->check()
                        ? \App\Models\ShoppingCart::where('user_id', auth()->id())
                            ->where('status', 'active')
                            ->first()
                        : null;
                    $cartCount = $navCart ? $navCart->items()->sum('quantity') : 0;
                @endphp

                @auth
                    <a href="{{ route('cart.index') }}" class="relative hover:text-accent transition-colors" title="{{ __('messages.nav_cart') }}">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        @if($cartCount > 0)
                            <span class="absolute -top-2 -right-2 bg-shadow text-primary text-xs font-bold px-1.5 py-0.5 rounded-full">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <div class="relative group">
                        <button class="flex items-center gap-2 font-semibold border-2 border-shadow/20 px-4 py-1.5 rounded-full hover:bg-shadow/5 hover:border-shadow/40 transition-all">
                            {{ auth()->user()->first_name }}
                        </button>
                        
                        <div class="absolute right-0 mt-2 w-56 bg-primary border border-shadow/10 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 py-2">
                            <div class="px-4 py-2 border-b border-shadow/10">
                                <p class="font-bold text-sm">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                                <p class="text-xs text-muted">{{ auth()->user()->email }}</p>
                            </div>

                            @if (auth()->user()->role?->name === 'admin')
                                <a href="{{ route('admin.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-bold text-shadow hover:bg-shadow/5 transition-colors">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ __('messages.nav_admin') }}
                                </a>
                                <div class="border-b border-shadow/10 my-1"></div>
                            @endif

                            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm hover:bg-shadow/5 transition-colors">{{ __('messages.nav_profile') }}</a>
                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm hover:bg-shadow/5 transition-colors">{{ __('messages.nav_orders') }}</a>
                            <a href="{{ route('favorites.index') }}" class="block px-4 py-2 text-sm hover:bg-shadow/5 transition-colors">{{ __('messages.nav_favorites') }}</a>
                            <a href="{{ route('followings.index') }}" class="block px-4 py-2 text-sm hover:bg-shadow/5 transition-colors">{{ __('messages.nav_followed_artists') }}</a>
                            
                            <div class="border-b border-shadow/10 my-1"></div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm font-semibold text-error hover:bg-error/10 transition-colors">
                                    {{ __('messages.nav_logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('cart.index') }}" class="relative hover:text-accent transition-colors" title="{{ __('messages.nav_cart') }}">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </a>
                    <a href="{{ route('login') }}" class="font-bold px-4 py-2 rounded-full hover:bg-shadow/5 transition-colors">{{ __('messages.nav_login') }}</a>
                    <a href="{{ route('signin') }}" class="bg-shadow text-primary font-bold px-6 py-2 rounded-full hover:scale-105 transition-transform">{{ __('messages.nav_register') }}</a>
                @endauth
            </div>
        </div>
    </nav>

    @hasSection('header')
        <header class="bg-gradient-to-b from-accent/40 to-primary pt-32 pb-10">
            <div class="container mx-auto px-4">
                @yield('header')
            </div>
        </header>
    @else
        <div class="h-24"></div>
    @endif

    @auth
        @if (!auth()->user()->hasVerifiedEmail())
            <div class="bg-warning/20 border border-warning/50 text-warning-dark p-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                    </svg>
                    <span>
                        {{ __('messages.email_not_verified') }}
                        <form method="POST" action="{{ route('verification.send') }}" class="inline">
                            @csrf
                            <button type="submit" class="font-semibold underline ml-2 hover:text-warning-darker">
                                {{ __('messages.resend_verification') }}
                            </button>
                        </form>
                    </span>
                </div>
            </div>
        @endif
    @endauth

    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="bg-secondary text-primary py-12 mt-auto">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                <div class="md:col-span-5">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 font-extrabold text-2xl mb-4 text-primary">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 18V5l12-2v13" />
                            <circle cx="6" cy="18" r="3" />
                            <circle cx="18" cy="16" r="3" />
                        </svg>
                        Fandrobe
                    </a>
                    <p class="text-primary/60 text-sm leading-relaxed max-w-sm mb-6">
                        {{ __('messages.footer_description') }}
                    </p>
                    <div class="flex gap-3">
                        <span class="bg-verified text-neutral text-xs font-bold px-3 py-1 rounded-full">{{ __('messages.footer_official') }}</span>
                        <span class="bg-accent text-shadow text-xs font-bold px-3 py-1 rounded-full">{{ __('messages.footer_authenticity') }}</span>
                    </div>
                </div>

                <div class="md:col-span-3 md:col-start-7">
                    <h6 class="font-bold text-xs tracking-widest text-primary/50 uppercase mb-4">{{ __('messages.footer_explore') }}</h6>
                    <ul class="flex flex-col gap-3">
                        <li><a href="{{ route('products.index') }}" class="text-sm font-medium hover:text-neutral transition-colors">{{ __('messages.nav_catalog') }}</a></li>
                        <li><a href="{{ route('artists.index') }}" class="text-sm font-medium hover:text-neutral transition-colors">{{ __('messages.nav_artists') }}</a></li>
                        <li><a href="#" class="text-sm font-medium hover:text-neutral transition-colors">{{ __('messages.footer_authenticity_link') }}</a></li>
                    </ul>
                </div>

                <div class="md:col-span-3">
                    <h6 class="font-bold text-xs tracking-widest text-primary/50 uppercase mb-4">{{ __('messages.footer_help') }}</h6>
                    <ul class="flex flex-col gap-3">
                        <li><a href="#" class="text-sm font-medium hover:text-neutral transition-colors">{{ __('messages.footer_contact') }}</a></li>
                        <li><a href="#" class="text-sm font-medium hover:text-neutral transition-colors">{{ __('messages.footer_shipping') }}</a></li>
                        <li><a href="#" class="text-sm font-medium hover:text-neutral transition-colors">{{ __('messages.footer_faq') }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-primary/10 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-primary/40">
                <p>{{ __('messages.footer_copyright') }}</p>
                <p>{{ __('messages.footer_made_with') }}</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script>
        (function() {
            const navbar = document.getElementById('navbar');
            if (navbar) {
                const onScroll = () => {
                    if (window.scrollY > 20) {
                        navbar.classList.add('shadow-md', 'bg-primary/95');
                        navbar.classList.remove('bg-primary/90');
                    } else {
                        navbar.classList.remove('shadow-md', 'bg-primary/95');
                        navbar.classList.add('bg-primary/90');
                    }
                };
                window.addEventListener('scroll', onScroll, { passive: true });
                onScroll();
            }

            // Global Loader Logic
            const loader = document.getElementById('global-loader');
            if (loader) {
                // Hide loader when page is fully loaded
                window.addEventListener('load', () => {
                    loader.style.opacity = '0';
                    setTimeout(() => loader.style.display = 'none', 500);
                });

                // Helper to show loader
                const showLoader = () => {
                    loader.style.display = 'flex';
                    // Force reflow to trigger transition
                    loader.offsetHeight;
                    loader.style.opacity = '1';
                };

                // Show loader on internal link clicks
                document.querySelectorAll('a').forEach(anchor => {
                    anchor.addEventListener('click', function(e) {
                        // Exclude external links, blank targets, anchors and javascript links
                        if (this.target === '_blank' || 
                            !this.href || 
                            this.href.startsWith('javascript:') || 
                            this.href.includes('#') || 
                            this.getAttribute('download') !== null) {
                            return;
                        }
                        
                        if (this.hostname === window.location.hostname) {
                            // Don't show loader if they pressed cmd/ctrl/shift + click (open in new tab)
                            if (!e.ctrlKey && !e.metaKey && !e.shiftKey) {
                                showLoader();
                            }
                        }
                    });
                });

                // Show loader on form submits
                document.querySelectorAll('form').forEach(form => {
                    form.addEventListener('submit', () => {
                        // Basic validation check - don't show loader if HTML5 validation fails
                        if (form.checkValidity()) {
                            showLoader();
                        }
                    });
                });

                // Fallback: hide loader if page takes too long or fails silently (e.g. back button in some browsers)
                setTimeout(() => {
                    if (loader.style.display !== 'none' && document.readyState === 'complete') {
                        loader.style.opacity = '0';
                        setTimeout(() => loader.style.display = 'none', 500);
                    }
                }, 1000); // Check shortly after load
                
                // Handle pageshow for bfcache (when user clicks back button)
                window.addEventListener('pageshow', (event) => {
                    if (event.persisted) { // Page was loaded from bfcache
                        loader.style.opacity = '0';
                        setTimeout(() => loader.style.display = 'none', 500);
                    }
                });
            }
        })();
    </script>
</body>

</html>
