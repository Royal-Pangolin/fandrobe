@extends('layouts.app')
@section('title', $category->name)

@section('content')

    {{-- Color dinámico por ID: debe quedar inline --}}
    <div class="position-relative overflow-hidden"
         style="height: 40vh; min-height: 300px; margin-top: -76px;
                background-color: {{ ['#4B352A','#2A3B4B','#3B4B2A','#4B2A3B','#2A4B3B'][$category->id % 5] }};">

        <div class="category-letter position-absolute top-50 start-50 translate-middle text-white"
             style="font-size: 40vw;">
            {{ substr($category->name, 0, 1) }}
        </div>

        <div class="hero-fade position-absolute top-0 start-0 w-100 h-100"></div>

        <div class="container-fluid px-4 px-lg-5 position-relative h-100 d-flex flex-column justify-content-end pb-4">
            <nav aria-label="breadcrumb" class="mb-2">
                <ol class="breadcrumb breadcrumb-nav mb-0" style="opacity: 0.7;">
                    <li class="breadcrumb-item">
                        <a href="{{ route('categories.index') }}" class="text-white text-decoration-none">Disciplinas</a>
                    </li>
                    <li class="breadcrumb-item active text-white fw-bold" aria-current="page">{{ $category->name }}</li>
                </ol>
            </nav>

            <div class="d-flex align-items-end justify-content-between">
                <h1 class="artist-hero-title fw-bolder text-white mb-0">{{ $category->name }}</h1>
                <span class="text-white fw-bold mb-2 opacity-75">{{ $products->count() }} obras</span>
            </div>
        </div>
    </div>

    <div class="container-fluid px-4 px-lg-5 py-4 pb-5">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5 gap-3">
            <p class="text-muted mb-0 lh-lg" style="max-width: 500px;">
                {{ $category->description ?? 'Bienvenido a esta colección. Aquí encontrarás piezas únicas y certificadas.' }}
            </p>
            <select class="form-select rounded-pill fw-bold" style="max-width: 220px; font-size: 0.85rem;">
                <option>Ordenar: Destacados</option>
                <option>Precio: menor a mayor</option>
                <option>Precio: mayor a menor</option>
            </select>
        </div>

        <div class="row g-4 row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
            @forelse ($products as $product)
                <div class="col">
                    <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none">
                        <div class="card h-100 position-relative">

                            @if($loop->first)
                                <span class="badge badge-limited badge-sm position-absolute m-2"
                                      style="top: 0; left: 0; z-index: 2;">Destaque</span>
                            @endif

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

                            <span class="label-xs text-muted mt-2 d-block">
                                {{ $product->artist->name ?? 'Artista Oficial' }}
                            </span>
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <span class="fw-bold" style="font-size: 0.9rem;">€{{ number_format($product->base_price, 2) }}</span>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <h4>No hay obras en esta categoría.</h4>
                </div>
            @endforelse
        </div>

        @if($products->count() >= 12)
            <div class="mt-5 d-flex justify-content-center">
                <button class="btn btn-outline-secondary rounded-pill fw-bold px-5 py-3">
                    Cargar más resultados
                </button>
            </div>
        @endif
    </div>

@endsection
