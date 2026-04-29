@extends('layouts.app')
@section('title', 'Mis Favoritos')

@section('content')

<div class="hero-gradient px-3 mb-5">
    <div class="container-fluid px-4 px-lg-5 pb-5">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-end justify-content-between gap-4">
            <div>
                <h1 class="text-shadow fw-bolder mb-2" style="font-size: clamp(2.5rem, 5vw, 4.5rem); letter-spacing: -0.03em; line-height: 1.05;">
                    Mis Favoritos
                </h1>
                <p class="text-shadow mb-0" style="opacity: 0.85;">
                    Productos que has guardado para más tarde.
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('favorites.index') }}" class="btn btn-primary btn-sm">Productos</a>
                <a href="{{ route('followings.index') }}" class="btn btn-secondary btn-sm">Artistas Seguidos</a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-4 px-lg-5 pb-5">

    @if($favorites->count())
        <div class="d-flex justify-content-between align-items-center mb-4">
            <span class="text-muted" style="font-size: 0.875rem;">
                <span class="fw-bold text-dark">{{ $favorites->count() }}</span> productos guardados
            </span>
        </div>

        <div class="row g-3 row-cols-2 row-cols-md-3 row-cols-xl-4">
            @foreach ($favorites as $fav)
                @php $product = $fav->product; @endphp
                @if($product)
                    <div class="col" id="fav-product-{{ $product->id }}">
                        <div class="card h-100 position-relative">
                            {{-- Botón quitar de favoritos --}}
                            <form method="POST" action="{{ route('favorites.toggleProduct') }}" class="position-absolute" style="top: 24px; right: 24px; z-index: 3;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn-favorite-remove" title="Quitar de favoritos">
                                    <svg width="20" height="20" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </form>

                            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                                <div class="card-img-wrapper">
                                    @if($product->images && $product->images->count() > 0)
                                        @php $imgUrl = $product->images->first()->url; @endphp
                                        <img src="{{ filter_var($imgUrl, FILTER_VALIDATE_URL) ? $imgUrl : asset('storage/' . $imgUrl) }}"
                                             alt="{{ $product->name }}" class="card-img-top">
                                    @else
                                        <div class="card-img-top bg-dark d-flex align-items-center justify-content-center text-secondary">
                                            <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <span class="mt-2 d-block text-muted"
                                      style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em;">
                                    {{ $product->artist->name ?? 'Artista Oficial' }}
                                </span>
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <span class="fw-bold" style="font-size: 0.9rem;">€{{ number_format($product->base_price, 2) }}</span>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <svg width="80" height="80" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="mb-4" style="opacity: 0.15;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
            <h3 class="fw-bold mb-2">Aún no tienes favoritos</h3>
            <p class="text-muted mb-4" style="max-width: 400px; margin: 0 auto;">
                Explora nuestro catálogo y guarda los productos que más te gusten pulsando el corazón.
            </p>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Explorar Catálogo</a>
        </div>
    @endif

</div>

@endsection
