@extends('layouts.app')
@section('title', $product->name)

@section('content')

<div class="container-fluid px-4 px-lg-5 py-5">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb breadcrumb-nav">
            <li class="breadcrumb-item">
                <a href="{{ route('home') }}" class="text-decoration-none text-dark">Inicio</a>
            </li>
            @if($product->category)
                <li class="breadcrumb-item">
                    <a href="{{ route('categories.show', $product->category->id) }}" class="text-decoration-none text-dark">
                        {{ $product->category->name }}
                    </a>
                </li>
            @endif
            <li class="breadcrumb-item active fw-bold text-dark" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-5 content-container-lg">

        <div class="col-lg-6">
            <div class="product-img-frame">
                @if($product->images && $product->images->count() > 0)
                    @php $imgUrl = $product->images->first()->url; @endphp
                    <img src="{{ filter_var($imgUrl, FILTER_VALIDATE_URL) ? $imgUrl : asset('storage/' . $imgUrl) }}"
                         alt="{{ $product->name }}">
                @else
                    <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                        <svg width="80" height="80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="mt-3 small text-uppercase fw-bold label-xs">Sin imagen</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-6">

            <div class="d-flex align-items-center gap-2 mb-4">
                <span class="badge badge-verified d-flex align-items-center gap-1">
                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Autenticado
                </span>
                @if($product->category)
                    <span class="badge badge-limited">{{ $product->category->name }}</span>
                @endif
            </div>

            @if($product->artist)
                <a href="{{ route('artists.show', $product->artist->id) }}"
                   class="product-artist-link text-decoration-none text-muted fw-bold text-uppercase mb-2 d-block">
                    {{ $product->artist->name }}
                </a>
            @endif

            <h1 class="product-title fw-bolder mb-4">{{ $product->name }}</h1>

            <div class="mb-4 d-flex align-items-baseline gap-3">
                <span class="product-price-lg fw-bolder">
                    €{{ number_format($product->base_price, 2) }}
                </span>
                <span class="text-muted small text-uppercase fw-bold label-xs">IVA incluido</span>
            </div>

            @if($product->description)
                <p class="product-description text-muted lh-lg mb-4">{{ $product->description }}</p>
            @endif

            <div class="product-actions d-flex flex-column gap-3 mb-5">
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="variant_id" value="{{ $product->variants->first()?->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold w-100">
                        Añadir al Carrito
                    </button>
                </form>
                @auth
                    @php
                        $isFavorite = auth()->user()->favorites()->where('product_id', $product->id)->exists();
                    @endphp
                    <form method="POST" action="{{ route('favorites.toggleProduct') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn {{ $isFavorite ? 'btn-favorite-active' : 'btn-outline-secondary' }} fw-bold w-100 d-flex align-items-center justify-content-center gap-2">
                            <svg width="18" height="18" fill="{{ $isFavorite ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            {{ $isFavorite ? 'Guardado en Favoritos' : 'Guardar en Favoritos' }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary fw-bold w-100 d-flex align-items-center justify-content-center gap-2">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        Guardar en Favoritos
                    </a>
                @endauth
            </div>

            <div class="product-details-section pt-4">
                <h4 class="label-xs fw-bold mb-3" style="color: var(--color-muted);">Detalles</h4>
                <div class="d-flex flex-column gap-2">
                    @if($product->sku)
                        <div class="product-detail-row d-flex justify-content-between py-2">
                            <span class="product-detail-label text-muted small fw-bold text-uppercase">SKU</span>
                            <span class="fw-bold small">{{ $product->sku }}</span>
                        </div>
                    @endif
                    <div class="product-detail-row d-flex justify-content-between py-2">
                        <span class="product-detail-label text-muted small fw-bold text-uppercase">Disponibilidad</span>
                        <span class="fw-bold small text-verified-color">En stock</span>
                    </div>
                    @if($product->artist)
                        <div class="d-flex justify-content-between py-2">
                            <span class="product-detail-label text-muted small fw-bold text-uppercase">Artista</span>
                            <a href="{{ route('artists.show', $product->artist->id) }}"
                               class="fw-bold small text-decoration-none text-dark">
                                {{ $product->artist->name }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
