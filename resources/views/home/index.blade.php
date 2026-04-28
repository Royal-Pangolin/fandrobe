@extends('layouts.app')
@section('title', 'Bienvenido')

@section('content')

<div class="home-hero position-relative overflow-hidden" style="height: 90vh; min-height: 500px; margin-top: -76px;">

    <div class="hero-slides position-absolute top-0 start-0 w-100 h-100">
        @forelse ($heroArtists as $i => $artist)
            @php
                $orbSets = [
                    ['#C49A3C', '#8B3A10', '#E8C46A'],
                    ['#2D8A7A', '#5E7248', '#C49A3C'],
                    ['#B84030', '#7B2D1E', '#E8C46A'],
                    ['#7B3070', '#B84030', '#C49A3C'],
                    ['#1E4A7F', '#2D8A7A', '#6E8560'],
                    ['#2A6B3A', '#C49A3C', '#8B3A10'],
                ];
                $bgColors = ['#100C09','#090C10','#090F0C','#0C0910','#09100F','#100909'];
                $set = $orbSets[$artist->id % 6];
                $bg  = $bgColors[$artist->id % 6];
            @endphp
            <div class="hero-slide position-absolute top-0 start-0 w-100 h-100 {{ $i === 0 ? 'active' : '' }}"
                 data-index="{{ $i }}"
                 style="background-color: {{ $bg }}; overflow: hidden;">
                <div class="hero-orb" style="width: 65%; aspect-ratio:1; background:{{ $set[0] }}; top:-15%; left:-10%; animation-duration:9s;"></div>
                <div class="hero-orb" style="width: 50%; aspect-ratio:1; background:{{ $set[1] }}; bottom:-15%; right:-8%; animation-duration:12s; animation-delay:-4s; animation-direction:reverse;"></div>
                <div class="hero-orb" style="width: 38%; aspect-ratio:1; background:{{ $set[2] }}; top:25%; left:40%; animation-duration:15s; animation-delay:-8s;"></div>
            </div>
        @empty
            <div class="hero-slide position-absolute top-0 start-0 w-100 h-100 active"
                 style="background-color: #100C09;"></div>
        @endforelse
    </div>

    <div class="position-absolute top-0 start-0 w-100 h-100"
         style="background: linear-gradient(to bottom, rgba(30,28,25,0.3) 0%, rgba(30,28,25,0.0) 30%, rgba(247,241,231,0.0) 60%, var(--color-primary) 100%);
                pointer-events: none;"></div>

    <div class="container-fluid px-4 px-lg-5 position-relative h-100 d-flex flex-column justify-content-center">
        <div class="row">
            <div class="col-lg-7">
                <div class="hero-artist-name mb-3">
                    @foreach ($heroArtists as $i => $artist)
                        <span class="d-block hero-artist-label text-white fw-bold text-uppercase"
                              style="letter-spacing: 0.15em; font-size: 0.9rem; opacity: 0.8; {{ $i === 0 ? '' : 'display: none !important;' }}"
                              data-slide="{{ $i }}">
                            Artista Destacado · {{ $artist->name }}
                        </span>
                    @endforeach
                    @if($heroArtists->isEmpty())
                        <span class="text-white fw-bold text-uppercase"
                              style="letter-spacing: 0.15em; font-size: 0.9rem; opacity: 0.8;">
                            Descubre nuestros artistas
                        </span>
                    @endif
                </div>

                <h1 class="text-white mb-4 fw-bolder"
                    style="font-size: clamp(2.5rem, 5vw, 5rem); letter-spacing: -0.03em; line-height: 1.05; text-shadow: 0 2px 20px rgba(0,0,0,0.3);">
                    Coleccionables Oficiales.<br>
                    <span style="color: var(--color-neutral);">Arte con Firma.</span>
                </h1>

                <p class="text-white mb-5"
                   style="font-size: 1.125rem; max-width: 520px; opacity: 0.85; line-height: 1.7;">
                    Piezas verificadas de tus artistas favoritos. Cada producto incluye certificado de autenticidad.
                </p>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg fw-bold">
                        Explorar Colección
                    </a>
                    <a href="{{ route('artists.index') }}" class="btn btn-outline-light btn-lg fw-bold rounded-pill">
                        Ver Artistas
                    </a>
                </div>
            </div>
        </div>

        @if($heroArtists->count() > 1)
            <div class="position-absolute d-flex gap-2" style="bottom: 40px; left: 50%; transform: translateX(-50%);">
                @foreach ($heroArtists as $i => $artist)
                    <button class="hero-dot border-0 rounded-pill"
                            data-slide="{{ $i }}"
                            style="width: {{ $i === 0 ? '24px' : '8px' }}; height: 8px;
                                   background: {{ $i === 0 ? 'white' : 'rgba(255,255,255,0.4)' }};
                                   padding: 0; cursor: pointer; transition: all 0.3s ease;">
                    </button>
                @endforeach
            </div>
        @endif
    </div>
</div>

@if($latestProducts->count())
    <div class="px-4 px-lg-5 py-5">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div class="d-flex align-items-center gap-3">
                <span class="badge badge-limited fw-bold"
                      style="font-size: 0.7rem; letter-spacing: 0.1em; border-radius: 4px; padding: 0.45em 0.9em;">NUEVO</span>
                <h2 class="mb-0 fw-bolder" style="letter-spacing: -0.02em;">Últimos Lanzamientos</h2>
            </div>
            <a href="{{ route('products.index') }}"
               class="text-muted text-decoration-none fw-bold small text-uppercase"
               style="letter-spacing: 0.05em; white-space: nowrap;">Ver todo</a>
        </div>

        <div class="horizontal-scroll-row d-flex gap-3 pb-3"
             style="overflow-x: auto; scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch;
                    scrollbar-width: thin; scrollbar-color: rgba(30,28,25,0.2) transparent;">
            @foreach ($latestProducts as $product)
                <a href="{{ route('products.show', $product->id) }}"
                   class="text-decoration-none flex-shrink-0"
                   style="width: 200px; scroll-snap-align: start;">
                    <div class="card h-100">
                        <div class="card-img-wrapper" style="aspect-ratio: 1/1;">
                            @if($product->images && $product->images->count() > 0)
                                @php $imgUrl = $product->images->first()->url; @endphp
                                <img src="{{ filter_var($imgUrl, FILTER_VALIDATE_URL) ? $imgUrl : asset('storage/' . $imgUrl) }}"
                                     alt="{{ $product->name }}" class="card-img-top">
                            @else
                                <div class="card-img-top bg-dark d-flex align-items-center justify-content-center text-secondary">
                                    <svg width="36" height="36" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <button class="card-action-btn" style="width: 40px; height: 40px; bottom: 12px; right: 12px;">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                        <h5 class="card-title mt-2" style="font-size: 0.9rem;">{{ $product->name }}</h5>
                        <p class="card-text" style="font-size: 0.78rem;">{{ $product->artist->name ?? 'Artista Oficial' }}</p>
                        <span class="fw-bold" style="font-size: 0.85rem;">€{{ number_format($product->base_price, 2) }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif

<div class="px-4 px-lg-5 pb-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <h2 class="mb-0 fw-bolder" style="letter-spacing: -0.02em;">Obras Más Vendidas</h2>
        <a href="{{ route('products.index') }}"
           class="text-muted text-decoration-none fw-bold small text-uppercase"
           style="letter-spacing: 0.05em;">Mostrar todo</a>
    </div>

    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-5 row-cols-xl-6">
        @forelse ($topProducts as $product)
            <div class="col">
                <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                    <div class="card h-100">
                        <div class="card-img-wrapper">
                            @if($product->images && $product->images->count() > 0)
                                @php $imgUrl = $product->images->first()->url; @endphp
                                <img src="{{ filter_var($imgUrl, FILTER_VALIDATE_URL) ? $imgUrl : asset('storage/' . $imgUrl) }}"
                                     alt="{{ $product->name }}" class="card-img-top">
                            @else
                                <div class="card-img-top bg-dark d-flex align-items-center justify-content-center text-secondary">
                                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <button class="card-action-btn">
                                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                        <h5 class="card-title mt-2">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->artist->name ?? 'Artista Oficial' }}</p>
                        <span class="fw-bold" style="font-size: 0.9rem;">€{{ number_format($product->base_price, 2) }}</span>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <p>No hay obras disponibles.</p>
            </div>
        @endforelse
    </div>
</div>

<div class="px-4 px-lg-5 py-5 mb-4">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="mb-1 fw-bolder" style="letter-spacing: -0.02em;">Nuestros Artistas Nuevos</h2>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">Las últimas incorporaciones a la plataforma.</p>
        </div>
        <a href="{{ route('artists.index') }}"
           class="text-muted text-decoration-none fw-bold small text-uppercase"
           style="letter-spacing: 0.05em; white-space: nowrap;">Ver todos</a>
    </div>

    <div class="row g-3 row-cols-3 row-cols-md-4 row-cols-lg-6">
        @forelse ($newestArtists as $artist)
            <div class="col">
                <a href="{{ route('artists.show', $artist->id) }}" class="artist-portrait-card">
                    <div class="artist-img-wrapper" style="aspect-ratio: 1/1; border-radius: 50%;">
                        @if($artist->image_url)
                            <img src="{{ asset('storage/artists/' . $artist->image_url) }}"
                                 alt="{{ $artist->name }}" style="border-radius: 50%;">
                        @else
                            <div class="placeholder-img" style="border-radius: 50%;">
                                {{ substr($artist->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="artist-name-reveal" style="font-size: 1rem; margin-top: 10px;">
                        {{ $artist->name }}
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <p>No hay artistas disponibles.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection

@push('scripts')
<script>
    (function () {
        const slides  = document.querySelectorAll('.hero-slide');
        const dots    = document.querySelectorAll('.hero-dot');
        const labels  = document.querySelectorAll('.hero-artist-label');
        let current   = 0;
        const total   = slides.length;
        if (total <= 1) return;

        function goTo(index) {
            slides[current].classList.remove('active');
            slides[index].classList.add('active');

            dots[current].style.width      = '8px';
            dots[current].style.background = 'rgba(255,255,255,0.4)';
            dots[index].style.width        = '24px';
            dots[index].style.background   = 'white';

            labels.forEach((l, i) => l.style.display = i === index ? '' : 'none');
            current = index;
        }

        let timer = setInterval(() => goTo((current + 1) % total), 4000);

        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                clearInterval(timer);
                goTo(i);
                timer = setInterval(() => goTo((current + 1) % total), 4000);
            });
        });
    })();
</script>
@endpush
