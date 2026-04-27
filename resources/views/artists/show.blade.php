@extends('layouts.app')
@section('title', 'Perfil de Artista')

@section('content')
    <!-- Artist Banner (Spotify Style) -->
    <div class="position-relative" style="height: 50vh; min-height: 400px; background-color: var(--color-secondary); margin-top: -76px;">
        <!-- Placeholder for background image -->
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-light opacity-25">
            <span class="display-1 fw-bold">{{ substr($artist->name, 0, 1) }}</span>
        </div>

        <!-- Gradient overlay -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(transparent 0%, rgba(30, 28, 25, 0.9) 100%);"></div>

        <div class="container-fluid px-4 px-lg-5 position-relative h-100 d-flex align-items-end justify-content-between pb-4">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <svg width="24" height="24" fill="#6E7556" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" clip-rule="evenodd"></path></svg>
                    <span class="text-white fw-bold">Artista Verificado</span>
                </div>

                <h1 class="fw-bolder text-white mb-0" style="letter-spacing: -0.04em; font-size: clamp(4rem, 8vw, 8rem); line-height: 1;">
                    {{ $artist->name }}
                </h1>
            </div>

            <div class="mb-2">
                <button class="btn btn-outline-light rounded-pill fw-bold text-uppercase px-4 border-2">Seguir</button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid px-4 px-lg-5 py-4 pb-5">

        {{-- Toolbar: buscador + filtro de categoría --}}
        @php
            $allProducts = $artist->products ?? collect();
            $categories = $allProducts->pluck('category')->filter()->unique('id')->values();
        @endphp

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-5">
            <div>
                <span class="text-muted fw-bold" style="font-size: 0.9rem;">
                    {{ $allProducts->count() }} obras disponibles
                </span>
            </div>
            <div class="d-flex gap-3 flex-wrap">
                {{-- Buscador --}}
                <div style="width: 250px;">
                    <input type="text" id="artistProductSearch" class="form-control rounded-pill py-2 px-4"
                           placeholder="Buscar obra..."
                           style="font-size: 0.875rem; background: rgba(30,28,25,0.04); border: 1px solid rgba(30,28,25,0.12);">
                </div>
                {{-- Filtro de categoría --}}
                <select id="artistCategoryFilter" class="form-select rounded-pill fw-bold"
                        style="max-width: 200px; font-size: 0.85rem;">
                    <option value="all">Todas las categorías</option>
                    @foreach($categories as $cat)
                        <option value="{{ Str::slug($cat->name) }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- ============================================================
             OBRAS POPULARES — Fila horizontal (todas las categorías)
        ============================================================ --}}
        @if($allProducts->count())
            <div class="artist-category-section mb-5" data-category="all">
                <div class="d-flex justify-content-between align-items-end mb-3">
                    <h3 class="fw-bold mb-0" style="letter-spacing: -0.02em;">Obras Populares</h3>
                    <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.05em;">{{ $allProducts->count() }} obras</span>
                </div>

                <div class="horizontal-scroll-row d-flex gap-3 pb-3"
                     style="overflow-x: auto; scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch;">
                    @foreach($allProducts as $product)
                        <a href="{{ route('products.show', $product->id) }}"
                           class="text-decoration-none flex-shrink-0 artist-product-card"
                           style="width: 200px; scroll-snap-align: start;"
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
                                            <svg width="36" height="36" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                    <button class="card-action-btn" style="width: 40px; height: 40px; bottom: 12px; right: 12px;">
                                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                </div>
                                <h5 class="card-title mt-2" style="font-size: 0.9rem;">{{ $product->name }}</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold" style="font-size: 0.85rem;">€{{ number_format($product->base_price, 2) }}</span>
                                    <span class="badge badge-verified" style="font-size: 0.6rem;">Oficial</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- ============================================================
             LISTAS POR CATEGORÍA — Una fila horizontal por cada categoría
        ============================================================ --}}
        @foreach($categories as $cat)
            @php
                $catProducts = $allProducts->filter(fn($p) => $p->category && $p->category->id === $cat->id);
            @endphp
            @if($catProducts->count())
                <div class="artist-category-section mb-5" data-category="{{ Str::slug($cat->name) }}">
                    <div class="d-flex justify-content-between align-items-end mb-3">
                        <h3 class="fw-bold mb-0" style="letter-spacing: -0.02em;">{{ $cat->name }}</h3>
                        <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.05em;">{{ $catProducts->count() }} obras</span>
                    </div>

                    <div class="horizontal-scroll-row d-flex gap-3 pb-3"
                         style="overflow-x: auto; scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch;">
                        @foreach($catProducts as $product)
                            <a href="{{ route('products.show', $product->id) }}"
                               class="text-decoration-none flex-shrink-0 artist-product-card"
                               style="width: 200px; scroll-snap-align: start;"
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
                                                <svg width="36" height="36" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        @endif
                                        <button class="card-action-btn" style="width: 40px; height: 40px; bottom: 12px; right: 12px;">
                                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <h5 class="card-title mt-2" style="font-size: 0.9rem;">{{ $product->name }}</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="fw-bold" style="font-size: 0.85rem;">€{{ number_format($product->base_price, 2) }}</span>
                                        <span class="badge badge-verified" style="font-size: 0.6rem;">Oficial</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        <!-- About Section -->
        <div class="mt-5">
            <h4 class="fw-bold mb-3 text-dark">Acerca de</h4>
            <div class="p-4 rounded" style="background-color: rgba(30, 28, 25, 0.04); max-width: 800px;">
                <p class="text-muted lh-lg fs-5 mb-4">
                    {{ $artist->bio ?? 'No hay biografía disponible de momento. Este autor colabora en la plataforma ofreciendo contenido exclusivo garantizando el 100% de autenticidad en cada firma.' }}
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
        const searchInput = document.getElementById('artistProductSearch');
        const categoryFilter = document.getElementById('artistCategoryFilter');
        const sections = document.querySelectorAll('.artist-category-section');
        const cards = document.querySelectorAll('.artist-product-card');

        function applyFilters() {
            const searchTerm = (searchInput?.value || '').toLowerCase().trim();
            const selectedCategory = categoryFilter?.value || 'all';

            // Filtrar secciones de categoría
            sections.forEach(section => {
                const sectionCat = section.getAttribute('data-category');

                // Si se seleccionó una categoría específica, ocultar todas las secciones excepto "Obras Populares"
                if (selectedCategory !== 'all') {
                    // Ocultar "Obras Populares" y mostrar solo la sección de la categoría seleccionada
                    if (sectionCat === 'all') {
                        section.style.display = 'none';
                    } else {
                        section.style.display = sectionCat === selectedCategory ? '' : 'none';
                    }
                } else {
                    section.style.display = '';
                }
            });

            // Filtrar tarjetas individuales por búsqueda de texto
            cards.forEach(card => {
                const name = card.getAttribute('data-name') || '';
                const matchesSearch = !searchTerm || name.includes(searchTerm);
                card.style.display = matchesSearch ? '' : 'none';
            });
        }

        if (searchInput) searchInput.addEventListener('input', applyFilters);
        if (categoryFilter) categoryFilter.addEventListener('change', applyFilters);
    })();
</script>
@endpush
