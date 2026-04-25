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
        <div class="d-flex justify-content-center">
            <div class="position-relative" style="width: 100%; max-width: 400px;">
                <input type="text" class="form-control rounded-pill py-3 px-4 shadow-sm" placeholder="Buscar artista..." style="background-color: var(--color-primary); border: none;">
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-4 px-lg-5 mb-5 pb-5">
    <div class="row g-4 row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
        @forelse ($artists as $artist)
            <div class="col">
                <a href="{{ route('artists.show', $artist->id) }}" class="artist-portrait-card">
                    <div class="artist-img-wrapper">
                        <!-- Reemplazar con la imagen real cuando el backend la soporte -->
                        <div class="placeholder-img">
                            {{ substr($artist->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="artist-name-reveal">
                        {{ $artist->name }}
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <h4>No hay artistas disponibles en este momento.</h4>
            </div>
        @endforelse
    </div>
    
    <div class="mt-5 pt-4 d-flex justify-content-center">
        <button class="btn btn-outline-secondary rounded-pill fw-bold px-5 py-3">Cargar Más</button>
    </div>
</div>
@endsection
