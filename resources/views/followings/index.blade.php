@extends('layouts.app')
@section('title', __('messages.followed_artists_title'))

@section('content')

<div class="hero-gradient px-3 mb-5">
    <div class="container-fluid px-4 px-lg-5 pb-5">
        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-end justify-content-between gap-4">
            <div>
                <h1 class="text-shadow fw-bolder mb-2" style="font-size: clamp(2.5rem, 5vw, 4.5rem); letter-spacing: -0.03em; line-height: 1.05;">
                    {{ __('messages.followed_artists_title') }}
                </h1>
                <p class="text-shadow mb-0" style="opacity: 0.85;">
                    {{ __('messages.followed_artists_desc') }}
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('favorites.index') }}" class="btn btn-secondary btn-sm">{{ __('messages.favorite_products_tab') }}</a>
                <a href="{{ route('followings.index') }}" class="btn btn-primary btn-sm">{{ __('messages.artists_tab') }}</a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-4 px-lg-5 mb-5 pb-5">

    @if($artists->count())
        <div class="d-flex justify-content-between align-items-center mb-4">
            <span class="text-muted" style="font-size: 0.875rem;">
                {{ __('messages.following_count') }} <span class="fw-bold text-dark">{{ $artists->count() }}</span> {{ $artists->count() !== 1 ? __('messages.artists_plural') : __('messages.artist_singular') }}
            </span>
        </div>

        <div class="row g-4 row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
            @foreach ($artists as $artist)
                <div class="col" id="followed-artist-{{ $artist->id }}">
                    <div class="position-relative">
                        <a href="{{ route('artists.show', $artist->id) }}" class="artist-portrait-card">
                            <div class="artist-img-wrapper">
                                @if($artist->image_url)
                                    @php $imgUrl = asset('storage/artists/' . $artist->image_url); @endphp
                                    <img src="{{ $imgUrl }}" alt="{{ $artist->name }}">
                                @else
                                    <div class="placeholder-img">{{ substr($artist->name, 0, 1) }}</div>
                                @endif
                            </div>
                            <div class="artist-name-reveal" style="opacity: 1; transform: none;">
                                {{ $artist->name }}
                            </div>
                        </a>
                        <form method="POST" action="{{ route('favorites.toggleArtist') }}" class="text-center mt-2">
                            @csrf
                            <input type="hidden" name="artist_id" value="{{ $artist->id }}">
                            <button type="submit" class="btn btn-sm btn-following-active rounded-pill fw-bold px-3">
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24" class="me-1">
                                    <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" clip-rule="evenodd"></path>
                                </svg>
                                {{ __('messages.following') }}
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <svg width="80" height="80" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="mb-4" style="opacity: 0.15;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <h3 class="fw-bold mb-2">{{ __('messages.no_following') }}</h3>
            <p class="text-muted mb-4" style="max-width: 400px; margin: 0 auto;">
                {{ __('messages.no_following_desc') }}
            </p>
            <a href="{{ route('artists.index') }}" class="btn btn-primary">{{ __('messages.explore_artists') }}</a>
        </div>
    @endif

</div>

@endsection
