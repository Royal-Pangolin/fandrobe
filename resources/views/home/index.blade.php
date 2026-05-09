@extends('layouts.app')
@section('title', __('messages.nav_home'))

@section('content')

<div class="home-hero position-relative overflow-hidden">

    <div class="hero-static-bg position-absolute top-0 start-0 w-100 h-100">
        <div class="hero-orb-1"></div>
        <div class="hero-orb-2"></div>
        <div class="hero-orb-3"></div>
    </div>

    <div class="hero-fade position-absolute top-0 start-0 w-100 h-100"></div>

    <div class="container-fluid px-4 px-lg-5 position-relative h-100 d-flex flex-column justify-content-center">
        <div class="row">
            <div class="col-lg-7">
                <div class="mb-3">
                    <span class="hero-label text-white fw-bold text-uppercase">
                        {{ __('messages.hero_label') }}
                    </span>
                </div>

                <h1 class="hero-title text-white mb-4 fw-bolder">
                    {{ __('messages.hero_title_1') }}<br>
                    <span class="text-neutral">{{ __('messages.hero_title_2') }}</span>
                </h1>

                <p class="hero-subtitle text-white mb-5">
                    {{ __('messages.hero_subtitle') }}
                </p>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg fw-bold">
                        {{ __('messages.explore_collection') }}
                    </a>
                    <a href="{{ route('artists.index') }}" class="btn btn-light btn-lg fw-bold rounded-pill">
                        {{ __('messages.view_artists') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@if($latestProducts->count())
    <div class="px-4 px-lg-5 py-5">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div class="d-flex align-items-center gap-3">
                <span class="badge badge-limited badge-sm fw-bold">{{ __('messages.new_badge') }}</span>
                <h2 class="mb-0 fw-bolder text-tight">{{ __('messages.latest_releases') }}</h2>
            </div>
            <a href="{{ route('products.index') }}"
               class="section-link text-muted text-decoration-none fw-bold small text-uppercase">{{ __('messages.view_all') }}</a>
        </div>

        <div class="horizontal-scroll-row d-flex gap-3 pb-3">
            @foreach ($latestProducts as $product)
                <a href="{{ route('products.show', $product->id) }}"
                   class="scroll-card text-decoration-none flex-shrink-0">
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
                        <p class="card-text" style="font-size: 0.78rem;">{{ $product->artist->name ?? __('messages.official_artist') }}</p>
                        <span class="fw-bold" style="font-size: 0.85rem;">€{{ number_format($product->base_price, 2) }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif

<div class="px-4 px-lg-5 pb-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <h2 class="mb-0 fw-bolder text-tight">{{ __('messages.best_sellers') }}</h2>
        <a href="{{ route('products.index') }}"
           class="section-link text-muted text-decoration-none fw-bold small text-uppercase">{{ __('messages.show_all') }}</a>
    </div>

    <div class="row g-3 row-cols-2 row-cols-md-4 row-cols-lg-5 row-cols-xl-6">
        @forelse ($topProducts as $product)
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
                                    <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <button class="card-action-btn">
                                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                        <h5 class="card-title mt-2">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->artist->name ?? __('messages.official_artist') }}</p>
                        <span class="fw-bold" style="font-size: 0.9rem;">€{{ number_format($product->base_price, 2) }}</span>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <p>{{ __('messages.no_products') }}</p>
            </div>
        @endforelse
    </div>
</div>

<div class="px-4 px-lg-5 py-5 mb-4">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="mb-1 fw-bolder text-tight">{{ __('messages.new_artists') }}</h2>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">{{ __('messages.new_artists_desc') }}</p>
        </div>
        <a href="{{ route('artists.index') }}"
           class="section-link text-muted text-decoration-none fw-bold small text-uppercase">{{ __('messages.view_all_artists') }}</a>
    </div>

    <div class="row g-3 row-cols-3 row-cols-md-4 row-cols-lg-6">
        @forelse ($newestArtists as $artist)
            <div class="col">
                <a href="{{ route('artists.show', $artist->id) }}" class="artist-portrait-card">
                    <div class="artist-img-wrapper" style="aspect-ratio: 1/1; border-radius: 50%;">
                        @if($artist->image_url)
                            <img src="{{ asset('storage/artists/' . $artist->image_url) }}"
                                 alt="{{ $artist->name }}" style="border-radius: 50%;">
                        @else
                            <div class="placeholder-img" style="border-radius: 50%;">
                                {{ substr($artist->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="artist-name-reveal" style="font-size: 1rem; margin-top: 10px;">
                        {{ $artist->name }}
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <p>{{ __('messages.no_artists_available') }}</p>
            </div>
        @endforelse
    </div>
</div>

@endsection
