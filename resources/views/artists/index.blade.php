@extends('layouts.app')
@section('title', 'Nuestros Artistas')

@section('content')
<div class="hero-gradient px-3 mb-5">
    <div class="container-fluid px-4 px-lg-5 text-center pb-5">
        <h1 class="display-3 text-shadow mb-3 fw-bolder" style="letter-spacing: -0.03em;">
            Nuestros Artistas
        </h1>
        <p class="lead text-shadow mx-auto mb-5" style="max-width: 600px; opacity: 0.9;">
            Descubre el talento que da vida a nuestras piezas exclusivas. Cada artista es verificado oficialmente.
        </p>
        <form method="GET" action="{{ route('artists.index') }}" class="d-flex justify-content-center">
            <div class="position-relative" style="width: 100%; max-width: 400px;">
                <input type="text" name="q" value="{{ request('q') }}"
                       class="form-control rounded-pill py-3 px-4 shadow-sm"
                       placeholder="Buscar artista..."
                       style="background-color: var(--color-primary); border: none; padding-right: 3.5rem !important;">
                <button type="submit" class="btn position-absolute top-50 end-0 translate-middle-y me-2 p-1"
                        style="background: none; border: none; color: var(--color-secondary);">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="container-fluid px-4 px-lg-5 mb-5 pb-5">
    <div class="row g-4 row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
        @forelse ($artists as $artist)
            <div class="col">
                <a href="{{ route('artists.show', $artist->id) }}" class="artist-portrait-card">
                    <div class="artist-img-wrapper">
                        @if($artist->image_url)
                            @php $imgUrl = asset('storage/artists/' . $artist->image_url); @endphp
                            <img src="{{ $imgUrl }}" alt="{{ $artist->name }}">
                        @else
                            <div class="placeholder-img">{{ substr($artist->name, 0, 1) }}</div>
                        @endif
                    </div>
                    <div class="artist-name-reveal">
                        {{ $artist->name }}
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                @if(request('q'))
                    <h4>No se encontraron artistas para "{{ request('q') }}".</h4>
                    <a href="{{ route('artists.index') }}" class="btn btn-secondary mt-3">Ver todos los artistas</a>
                @else
                    <h4>No hay artistas disponibles en este momento.</h4>
                @endif
            </div>
        @endforelse
    </div>
    
</div>
@endsection
