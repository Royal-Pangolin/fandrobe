@extends('layouts.app')
@section('title', $product->name)

@section('content')

<div class="container-fluid px-4 px-lg-5 py-5">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb" style="font-size: 0.8rem; letter-spacing: 0.08em; text-transform: uppercase; opacity: 0.6;">
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

    <div class="row g-5" style="max-width: 1200px;">

        <div class="col-lg-6">
            <div style="border-radius: 16px; overflow: hidden; background: rgba(30,28,25,0.04); aspect-ratio: 1/1; width: 100%;">
                @if($product->images && $product->images->count() > 0)
                    @php $imgUrl = $product->images->first()->url; @endphp
                    <img src="{{ filter_var($imgUrl, FILTER_VALIDATE_URL) ? $imgUrl : asset('storage/' . $imgUrl) }}"
                         alt="{{ $product->name }}"
                         style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-muted">
                        <svg width="80" height="80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="mt-3 small text-uppercase fw-bold" style="letter-spacing: 0.1em;">Sin imagen</span>
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
                   class="text-decoration-none text-muted fw-bold text-uppercase mb-2 d-block"
                   style="font-size: 0.85rem; letter-spacing: 0.1em;">
                    {{ $product->artist->name }}
                </a>
            @endif

            <h1 class="fw-bolder mb-4"
                style="font-size: clamp(2rem, 4vw, 3.5rem); letter-spacing: -0.03em; line-height: 1.05;">
                {{ $product->name }}
            </h1>

            <div class="mb-4 d-flex align-items-baseline gap-3">
                <span class="fw-bolder" style="font-size: 2.5rem; letter-spacing: -0.02em;">
                    €{{ number_format($product->base_price, 2) }}
                </span>
                <span class="text-muted small text-uppercase fw-bold" style="letter-spacing: 0.08em;">IVA incluido</span>
            </div>

            @if($product->description)
                <p class="text-muted lh-lg mb-4" style="font-size: 1.05rem; max-width: 480px;">
                    {{ $product->description }}
                </p>
            @endif

            <div class="d-flex flex-column gap-3 mb-5" style="max-width: 400px;">
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="variant_id" value="{{ $product->variants->first()?->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold w-100">
                        Añadir al Carrito
                    </button>
                </form>
                <button class="btn btn-outline-secondary fw-bold w-100 d-flex align-items-center justify-content-center gap-2">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    Guardar en Favoritos
                </button>
            </div>

            <div class="pt-4" style="border-top: 1px solid rgba(30,28,25,0.1);">
                <h4 class="fw-bold mb-3"
                    style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--color-muted);">
                    Detalles
                </h4>
                <div class="d-flex flex-column gap-2">
                    @if($product->sku)
                        <div class="d-flex justify-content-between py-2" style="border-bottom: 1px solid rgba(30,28,25,0.06);">
                            <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.05em;">SKU</span>
                            <span class="fw-bold small">{{ $product->sku }}</span>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between py-2" style="border-bottom: 1px solid rgba(30,28,25,0.06);">
                        <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.05em;">Disponibilidad</span>
                        <span class="fw-bold small" style="color: var(--color-verified);">En stock</span>
                    </div>
                    @if($product->artist)
                        <div class="d-flex justify-content-between py-2">
                            <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.05em;">Artista</span>
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
