@extends('layouts.app')
@section('title', 'Disciplinas')

@section('content')

    <div class="hero-gradient px-3 mb-5">
        <div class="container-fluid px-4 px-lg-5 text-center pb-5">
            <h1 class="display-3 text-shadow mb-3 fw-bolder text-tighter">
                Disciplinas Artísticas
            </h1>
            <p class="lead text-shadow mx-auto" style="max-width: 560px; opacity: 0.9;">
                Sumérgete en las corrientes creativas que conforman la red de Fandrobe.
            </p>
        </div>
    </div>

    <div class="container-fluid px-4 px-lg-5 pb-5">
        <div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
            @forelse ($categories as $category)
                <div class="col">
                    <a href="{{ route('categories.show', $category->id) }}" class="text-decoration-none">
                        {{-- Color dinámico por índice: debe quedar inline --}}
                        <div class="category-card position-relative overflow-hidden rounded-4"
                             style="background-color: {{ ['#4B352A','#2A3B4B','#3B4B2A','#4B2A3B','#2A4B3B','#3B2A4B'][$loop->index % 6] }};">

                            <div class="category-letter position-absolute top-50 start-50 translate-middle text-white">
                                {{ substr($category->name, 0, 1) }}
                            </div>

                            <div class="position-absolute top-0 start-0 w-100 h-100"
                                 style="background: linear-gradient(135deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.5) 100%);"></div>

                            <div class="position-absolute bottom-0 start-0 p-4 w-100">
                                <span class="badge badge-limited badge-sm mb-2">Disciplina</span>
                                <h3 class="category-title fw-bolder text-white mb-1">{{ $category->name }}</h3>
                                <p class="category-desc text-white mb-0">
                                    {{ Str::limit($category->description ?? 'Explora esta disciplina artística.', 60) }}
                                </p>
                            </div>

                            <div class="category-arrow position-absolute d-flex align-items-center justify-content-center bg-white rounded-circle">
                                <svg width="20" height="20" fill="none" stroke="var(--color-shadow)" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                </svg>
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
