@extends('layouts.app')
@section('title', __('messages.followed_artists_title'))

@section('content')

<div class="bg-gradient-to-r from-accent/20 to-secondary/20 pt-20 pb-12 px-4 sm:px-6 lg:px-8 mb-12">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-start md:items-end justify-between gap-6">
        <div>
            <h1 class="text-5xl md:text-6xl font-extrabold text-shadow tracking-tighter mb-2">
                {{ __('messages.followed_artists_title') }}
            </h1>
            <p class="text-shadow/80 font-medium max-w-lg">
                {{ __('messages.followed_artists_desc') }}
            </p>
        </div>
        <div class="flex gap-3 bg-shadow/5 p-1 rounded-full border border-shadow/10">
            <a href="{{ route('favorites.index') }}" class="px-6 py-2 rounded-full font-bold text-sm text-shadow hover:bg-shadow/10 transition-colors">{{ __('messages.favorite_products_tab') }}</a>
            <a href="{{ route('followings.index') }}" class="px-6 py-2 rounded-full font-bold text-sm bg-shadow text-primary shadow-sm pointer-events-none">{{ __('messages.artists_tab') }}</a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">

    @if($artists->count())
        <div class="flex justify-between items-center mb-8">
            <span class="text-sm font-bold text-muted uppercase tracking-widest">
                {{ __('messages.following_count') }} <span class="text-shadow font-extrabold">{{ $artists->count() }}</span> {{ $artists->count() !== 1 ? __('messages.artists_plural') : __('messages.artist_singular') }}
            </span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach ($artists as $artist)
                <div class="relative group" id="followed-artist-{{ $artist->id }}">
                    <a href="{{ route('artists.show', $artist->id) }}" class="block overflow-hidden rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 aspect-[3/4]">
                        @if($artist->image_url)
                            @php $imgUrl = asset('storage/artists/' . $artist->image_url); @endphp
                            <img src="{{ $imgUrl }}" alt="{{ $artist->name }}" class="absolute inset-0 w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="absolute inset-0 w-full h-full bg-secondary flex items-center justify-center text-primary text-6xl font-extrabold transform group-hover:scale-110 transition-transform duration-500">
                                {{ substr($artist->name, 0, 1) }}
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-4">
                            <h3 class="text-white font-extrabold text-2xl text-center translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                {{ $artist->name }}
                            </h3>
                        </div>
                    </a>
                    
                    <form method="POST" action="{{ route('favorites.toggleArtist') }}" class="absolute top-3 right-3 z-10">
                        @csrf
                        <input type="hidden" name="artist_id" value="{{ $artist->id }}">
                        <button type="submit" class="bg-shadow/80 backdrop-blur text-primary rounded-full font-bold text-xs px-3 py-1.5 flex items-center gap-1 hover:bg-error transition-colors" title="{{ __('messages.following') }}">
                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" clip-rule="evenodd"></path>
                            </svg>
                            {{ __('messages.following') }}
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-20 bg-shadow/5 rounded-3xl border border-shadow/5 mt-8">
            <svg width="80" height="80" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="mx-auto mb-6 opacity-20 text-shadow">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <h3 class="text-2xl font-extrabold text-shadow mb-3">{{ __('messages.no_following') }}</h3>
            <p class="text-muted font-medium mb-8 max-w-md mx-auto">
                {{ __('messages.no_following_desc') }}
            </p>
            <a href="{{ route('artists.index') }}" class="btn-primary inline-block">{{ __('messages.explore_artists') }}</a>
        </div>
    @endif

</div>
@endsection
