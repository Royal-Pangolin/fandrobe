@extends('layouts.app')
@section('title', $artist->name)

@section('content')

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
    $allProducts = $artist->products ?? collect();
    $categories  = $allProducts->pluck('category')->filter()->unique('id')->values();
@endphp

<div class="artist-hero position-relative overflow-hidden" style="background-color: {{ $bg }};">
    {{-- Orbes dinámicos: color depende del artista, deben quedar inline --}}
    <div class="hero-orb" style="width: 65%; aspect-ratio:1; background:{{ $set[0] }}; top:-15%; left:-10%; animation-duration:9s;"></div>
    <div class="hero-orb" style="width: 50%; aspect-ratio:1; background:{{ $set[1] }}; bottom:-15%; right:-8%; animation-duration:12s; animation-delay:-4s; animation-direction:reverse;"></div>
    <div class="hero-orb" style="width: 38%; aspect-ratio:1; background:{{ $set[2] }}; top:25%; left:40%; animation-duration:15s; animation-delay:-8s;"></div>

    <div class="artist-hero-fade position-absolute top-0 start-0 w-100 h-100"></div>

    <div class="container-fluid px-4 px-lg-5 position-relative h-100 d-flex align-items-end justify-content-between pb-4">
        <div>
            <div class="d-flex align-items-center gap-2 mb-2">
                <svg width="24" height="24" fill="#6E7556" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-white fw-bold">Artista Verificado</span>
            </div>
            <h1 class="artist-hero-title fw-bolder text-white mb-0">{{ $artist->name }}</h1>
        </div>
        <div class="mb-2">
            <button class="btn btn-outline-light rounded-pill fw-bold text-uppercase px-4 border-2">Seguir</button>
        </div>
    </div>
</div>

<div class="container-fluid px-4 px-lg-5 py-4 pb-5">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-5">
        <span class="text-muted fw-bold" style="font-size: 0.9rem;">
            {{ $allProducts->count() }} obras disponibles
        </span>
        <div class="d-flex gap-3 flex-wrap">
            <div class="artist-filter-search">
                <input type="text" id="artistProductSearch" class="form-control rounded-pill py-2 px-4"
                       placeholder="Buscar obra..." style="font-size: 0.875rem;">
            </div>
            <select id="artistCategoryFilter" class="form-select rounded-pill fw-bold" style="max-width: 200px; font-size: 0.85rem;">
                <option value="all">Todas las categorías</option>
                @foreach($categories as $cat)
                    <option value="{{ Str::slug($cat->name) }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if($allProducts->count())
        <div class="artist-category-section mb-5" data-category="all">
            <div class="d-flex justify-content-between align-items-end mb-3">
                <h3 class="fw-bold mb-0 text-tight">Obras Populares</h3>
                <span class="section-link text-muted small fw-bold text-uppercase">
                    {{ $allProducts->count() }} obras
                </span>
            </div>
            <div class="horizontal-scroll-row d-flex gap-3 pb-3 overflow-hidden">
                @foreach($allProducts as $product)
                    <a href="{{ route('products.show', $product->id) }}"
                       class="scroll-card text-decoration-none flex-shrink-0 artist-product-card"
                       data-name="{{ strtolower($product->name) }}"
                       data-category="{{ $product->category ? Str::slug($product->category->name) : '' }}">
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
                                <button class="card-action-btn card-action-btn-sm">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </div>
                            <h5 class="card-title mt-2 badge-sm">{{ $product->name }}</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold" style="font-size: 0.85rem;">€{{ number_format($product->base_price, 2) }}</span>
                                <span class="badge badge-verified badge-sm">Oficial</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    @foreach($categories as $cat)
        @php
            $catProducts = $allProducts->filter(fn($p) => $p->category && $p->category->id === $cat->id);
        @endphp
        @if($catProducts->count())
            <div class="artist-category-section mb-5" data-category="{{ Str::slug($cat->name) }}">
                <div class="d-flex justify-content-between align-items-end mb-3">
                    <h3 class="fw-bold mb-0 text-tight">{{ $cat->name }}</h3>
                    <span class="section-link text-muted small fw-bold text-uppercase">
                        {{ $catProducts->count() }} obras
                    </span>
                </div>
                <div class="horizontal-scroll-row d-flex gap-3 pb-3 overflow-hidden">
                    @foreach($catProducts as $product)
                        <a href="{{ route('products.show', $product->id) }}"
                           class="scroll-card text-decoration-none flex-shrink-0 artist-product-card"
                           data-name="{{ strtolower($product->name) }}"
                           data-category="{{ Str::slug($cat->name) }}">
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
                                    <button class="card-action-btn card-action-btn-sm">
                                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                </div>
                                <h5 class="card-title mt-2 badge-sm">{{ $product->name }}</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold" style="font-size: 0.85rem;">€{{ number_format($product->base_price, 2) }}</span>
                                    <span class="badge badge-verified badge-sm">Oficial</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

    <div class="mt-5">
        <h4 class="fw-bold mb-3 text-dark">Acerca de</h4>
        <div class="artist-bio-panel p-4 rounded">
            <p class="text-muted lh-lg fs-5 mb-4">
                {{ $artist->bio ?? 'No hay biografía disponible de momento.' }}
            </p>
            <div class="d-flex gap-5 flex-wrap">
                <div>
                    <span class="d-block small text-muted text-uppercase mb-1">Género Principal</span>
                    <span class="fw-bold fs-5">{{ $artist->genre->name ?? 'Varios' }}</span>
                </div>
                <div>
                    <span class="d-block small text-muted text-uppercase mb-1">Obras Disponibles</span>
                    <span class="fw-bold fs-5">{{ $allProducts->count() }} Artículos</span>
                </div>
                <div>
                    <span class="d-block small text-muted text-uppercase mb-1">Miembro desde</span>
                    <span class="fw-bold fs-5">{{ $artist->created_at ? $artist->created_at->format('M Y') : '2026' }}</span>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
    (function () {
        const searchInput    = document.getElementById('artistProductSearch');
        const categoryFilter = document.getElementById('artistCategoryFilter');
        const sections       = document.querySelectorAll('.artist-category-section');
        const cards          = document.querySelectorAll('.artist-product-card');

        function applyFilters() {
            const searchTerm       = (searchInput?.value || '').toLowerCase().trim();
            const selectedCategory = categoryFilter?.value || 'all';

            sections.forEach(section => {
                const sectionCat = section.getAttribute('data-category');
                if (selectedCategory !== 'all') {
                    section.style.display = sectionCat === 'all' || sectionCat !== selectedCategory ? 'none' : '';
                } else {
                    section.style.display = '';
                }
            });

            cards.forEach(card => {
                const name = card.getAttribute('data-name') || '';
                card.style.display = !searchTerm || name.includes(searchTerm) ? '' : 'none';
            });
        }

        searchInput?.addEventListener('input', applyFilters);
        categoryFilter?.addEventListener('change', applyFilters);
    })();
</script>
@endpush
