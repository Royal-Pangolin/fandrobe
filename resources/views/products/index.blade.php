@extends('layouts.app')
@section('title', 'Catálogo')

@section('content')

    <form method="GET" action="{{ route('products.index') }}">

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
                <div class="position-relative" style="width: 100%; max-width: 320px;">
                    <input type="text" name="q" value="{{ request('q') }}"
                           class="form-control rounded-pill py-3 px-4"
                           placeholder="Buscar producto o artista..."
                           style="background-color: rgba(247,241,231,0.9); border: none; backdrop-filter: blur(4px); padding-right: 3.5rem !important;">
                    <button type="submit" class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-1"
                            style="background: none; border: none; color: var(--color-secondary);">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/>
                        </svg>
                    </button>
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
                                       name="categories[]"
                                       value="{{ $category->id }}" id="cat-{{ $category->id }}"
                                       {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
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
                        <input type="range" class="form-range"
                               name="price_max"
                               min="0" max="{{ $absoluteMax }}"
                               value="{{ request('price_max', $absoluteMax) }}"
                               id="priceRange"
                               oninput="document.getElementById('priceVal').textContent = this.value + '€'">
                        <div class="d-flex justify-content-between text-muted mt-1" style="font-size: 0.8rem;">
                            <span>0€</span>
                            <span id="priceVal" class="fw-bold" style="color: var(--color-shadow);">{{ request('price_max', $absoluteMax) }}€</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary fw-bold w-100" style="font-size: 0.85rem;">
                        Aplicar Filtros
                    </button>

                    @if(request()->hasAny(['q', 'categories', 'price_max', 'sort']))
                        <a href="{{ route('products.index') }}" class="btn btn-secondary fw-bold w-100 mt-2" style="font-size: 0.85rem;">
                            Limpiar filtros
                        </a>
                    @endif
                </div>
            </div>

            {{-- ---- Grid de Productos ---- --}}
            <div class="col-md-9 col-lg-10">
                {{-- Toolbar --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="text-muted" style="font-size: 0.875rem;">
                        <span class="fw-bold text-dark">{{ $products->total() }}</span> productos encontrados
                    </span>
                    <select name="sort" class="form-select rounded-pill fw-bold" style="max-width: 200px; font-size: 0.85rem;"
                            onchange="this.form.submit()">
                        <option value="featured" {{ request('sort', 'featured') === 'featured' ? 'selected' : '' }}>Ordenar: Destacados</option>
                        <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Precio: menor a mayor</option>
                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Precio: mayor a menor</option>
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Más recientes</option>
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

                {{-- Paginación real de Laravel --}}
                @if($products->hasPages())
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>

    </form>

@endsection
