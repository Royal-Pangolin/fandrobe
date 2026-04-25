@extends('layouts.app')
@section('title', 'Disciplinas')

@section('content')

    {{-- Header --}}
    <div class="hero-gradient px-3 mb-5">
        <div class="container-fluid px-4 px-lg-5 text-center pb-5">
            <h1 class="display-3 text-shadow mb-3 fw-bolder" style="letter-spacing: -0.03em;">
                Disciplinas Artísticas
            </h1>
            <p class="lead text-shadow mx-auto" style="max-width: 560px; opacity: 0.9;">
                Sumérgete en las corrientes creativas que conforman la red de Everlasting Art.
            </p>
        </div>
    </div>

    {{-- Grid de categorías --}}
    <div class="container-fluid px-4 px-lg-5 pb-5">
        <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
            @forelse ($categories as $category)
                <div class="col">
                    <a href="{{ route('categories.show', $category->id) }}" class="text-decoration-none">
                        <div class="category-card position-relative overflow-hidden rounded-4"
                             style="height: 280px; background-color: {{ ['#4B352A','#2A3B4B','#3B4B2A','#4B2A3B','#2A4B3B','#3B2A4B'][$loop->index % 6] }};">

                            {{-- Letra gigante de fondo --}}
                            <div class="position-absolute top-50 start-50 translate-middle text-white"
                                 style="font-size: 14rem; font-weight: 900; line-height: 1; opacity: 0.08; user-select: none; pointer-events: none;">
                                {{ substr($category->name, 0, 1) }}
                            </div>

                            {{-- Degradado overlay --}}
                            <div class="position-absolute top-0 start-0 w-100 h-100"
                                 style="background: linear-gradient(135deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.5) 100%);"></div>

                            {{-- Contenido --}}
                            <div class="position-absolute bottom-0 start-0 p-4 w-100">
                                <span class="badge badge-limited mb-2" style="font-size: 0.7rem;">Disciplina</span>
                                <h3 class="fw-bolder text-white mb-1" style="font-size: 1.75rem; letter-spacing: -0.02em;">
                                    {{ $category->name }}
                                </h3>
                                <p class="text-white mb-0" style="font-size: 0.9rem; opacity: 0.75;">
                                    {{ Str::limit($category->description ?? 'Explora esta disciplina artística.', 60) }}
                                </p>
                            </div>

                            {{-- Flecha hover --}}
                            <div class="category-arrow position-absolute d-flex align-items-center justify-content-center bg-white rounded-circle"
                                 style="width: 44px; height: 44px; bottom: 24px; right: 24px; opacity: 0; transform: translateY(8px); transition: all 0.3s ease;">
                                <svg width="20" height="20" fill="none" stroke="var(--color-shadow)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <h4>No hay categorías disponibles.</h4>
                </div>
            @endforelse
        </div>
    </div>

@endsection

@push('scripts')
<style>
    /* Hover effects for category cards */
    .category-card {
        cursor: pointer;
        transition: transform 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.35s ease;
    }
    .category-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.2);
    }
    .category-card:hover .category-arrow {
        opacity: 1 !important;
        transform: translateY(0) !important;
    }
</style>
@endpush
