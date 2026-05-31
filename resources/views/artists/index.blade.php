@extends('layouts.app')
@section('title', __('messages.our_artists'))

@section('content')
<div class="relative px-4 lg:px-12 mb-12">
    <div class="text-center pb-12">
        <h1 class="text-5xl lg:text-6xl font-extrabold text-shadow mb-4 tracking-tight">
            {{ __('messages.our_artists') }}
        </h1>
        <p class="text-xl text-shadow/90 mx-auto mb-12 max-w-2xl font-medium">
            {{ __('messages.artists_subtitle') }}
        </p>
        <form method="GET" action="{{ route('artists.index') }}" class="flex justify-center">
            <div class="relative w-full max-w-md">
                <input type="text" name="q" value="{{ request('q') }}"
                       class="w-full rounded-full py-3 px-6 shadow-sm focus:outline-none focus:ring-2 focus:ring-accent bg-primary text-shadow"
                       placeholder="{{ __('messages.search_artist') }}"
                       style="padding-right: 3.5rem;">
                <button type="submit" class="absolute top-1/2 right-2 -translate-y-1/2 p-2 text-secondary hover:text-accent transition-colors">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="w-full px-4 lg:px-12 mb-16 pb-16">
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @forelse ($artists as $artist)
            <a href="{{ route('artists.show', $artist->id) }}" class="group relative block overflow-hidden rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 aspect-[3/4]">
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
        @empty
            <div class="col-span-full text-center text-muted py-12">
                @if(request('q'))
                    <h4 class="text-2xl font-bold mb-4">{{ __('messages.no_artists_for') }} "{{ request('q') }}".</h4>
                    <a href="{{ route('artists.index') }}" class="inline-block bg-secondary text-primary font-bold px-6 py-2 rounded-full mt-4 hover:bg-opacity-90 transition-colors">{{ __('messages.view_all_artists_btn') }}</a>
                @else
                    <h4 class="text-2xl font-bold">{{ __('messages.no_artists_now') }}</h4>
                @endif
            </div>
        @endforelse
    </div>
    
</div>
@endsection
