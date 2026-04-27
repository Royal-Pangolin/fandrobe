@extends('layouts.app')
@section('title', 'Catálogo')

@section('content')

    {{-- Hero del catálogo --}}
    <div class="hero-gradient px-3 mb-5" style="padding-top: calc(76px + 32px);">
        <div class="container-fluid px-4 px-lg-5 pb-5">
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-end justify-content-between gap-4">
                <div>
                    <h1 class="text-shadow fw-bolder mb-2" style="font-size: clamp(2.5rem, 5vw, 4.5rem); letter-spacing: -0.03em; line-height: 1.05;">
                        Catálogo
                    </h1>
                    <p class="text-shadow mb-0" style="opacity: 0.85;">
                        Todas las piezas oficiales y verificadas de nuestros artistas.
                    </p>
                </div>
                {{-- Buscador --}}
                <div style="width: 100%; max-width: 320px;">
                    <input type="text" class="form-control rounded-pill py-3 px-4"
                           placeholder="Buscar obra o artista..."
                           style="background-color: rgba(247,241,231,0.9); border: none; backdrop-filter: blur(4px);">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid px-4 px-lg-5 pb-5">
        <div class="row g-5">

            {{-- ---- Sidebar Filtros ---- --}}
            <div class="col-md-3 col-lg-2">
                <div class="p-4 rounded-3" style="background: rgba(30,28,25,0.04); position: sticky; top: 96px;">
                    <h5 class="fw-bolder mb-4" style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--color-muted);">Filtros</h5>

                    {{-- Categorías --}}
                    <div class="mb-4">
                        <span class="d-block fw-bold mb-3" style="font-size: 0.85rem;">Categorías</span>
                        @foreach($categories as $category)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox"
                                       value="{{ $category->id }}" id="cat-{{ $category->id }}"
                                       style="border-color: rgba(30,28,25,0.3);">
                                <label class="form-check-label text-muted" for="cat-{{ $category->id }}"
                                       style="font-size: 0.875rem;">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    {{-- Precio --}}
                    <div class="mb-4">
                        <span class="d-block fw-bold mb-3" style="font-size: 0.85rem;">Precio máximo</span>
                        <input type="range" class="form-range" min="0" max="500" id="priceRange"
                               oninput="document.getElementById('priceVal').textContent = this.value + '€'">
                        <div class="d-flex justify-content-between text-muted mt-1" style="font-size: 0.8rem;">
                            <span>0€</span>
                            <span id="priceVal" class="fw-bold" style="color: var(--color-shadow);">500€</span>
                        </div>
                    </div>

                    <button class="btn btn-primary fw-bold w-100" style="font-size: 0.85rem;">
                        Aplicar Filtros
                    </button>
                </div>
            </div>

            {{-- ---- Grid de Productos ---- --}}
            <div class="col-md-9 col-lg-10">
                {{-- Toolbar --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="text-muted" style="font-size: 0.875rem;">
                        <span class="fw-bold text-dark">{{ $products->count() }}</span> obras encontradas
                    </span>
                    <select class="form-select rounded-pill fw-bold" style="max-width: 200px; font-size: 0.85rem;">
                        <option>Ordenar: Destacados</option>
                        <option>Precio: menor a mayor</option>
                        <option>Precio: mayor a menor</option>
                        <option>Más recientes</option>
                    </select>
                </div>

                <div class="row g-3 row-cols-2 row-cols-md-3 row-cols-xl-4">
                    @forelse ($products as $product)
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
                                                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                        <button class="card-action-btn">
                                            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </button>
                                    </div>

                                    <span class="mt-2 d-block text-muted"
                                          style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em;">
                                        {{ $product->artist->name ?? 'Artista Oficial' }}
                                    </span>
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <span class="fw-bold" style="font-size: 0.9rem;">€{{ number_format($product->base_price, 2) }}</span>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted py-5">
                            <svg width="64" height="64" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="mb-3 opacity-25"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <h5 class="fw-bold">No hay productos disponibles</h5>
                            <p class="small">Prueba a cambiar los filtros o vuelve pronto.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Paginación --}}
                @if($products->count() >= 12)
                    <div class="mt-5 d-flex justify-content-center">
                        <nav aria-label="Paginación">
                            <ul class="pagination gap-1">
                                <li class="page-item disabled">
                                    <a class="page-link rounded-pill px-4" href="#">Anterior</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link rounded-pill" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link rounded-pill" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link rounded-pill px-4" href="#">Siguiente</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                @endif
            </div>

        </div>
    </div>

@endsection
