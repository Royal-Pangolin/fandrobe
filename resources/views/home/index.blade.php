@extends('layouts.app')
@section('title', __('messages.nav_home'))

@section('content')

<div class="relative overflow-hidden rounded-3xl mb-16 -mx-4 sm:mx-0 bg-gradient-to-br from-[#f5ecd5] to-[#e6d198] shadow-inner border border-shadow/5">
    <div class="relative flex flex-col lg:flex-row items-center justify-between min-h-[70vh]">
        
        <!-- Text Area (Left) -->
        <div class="w-full lg:w-1/2 px-6 py-16 sm:px-12 lg:pl-24 lg:pr-12 flex flex-col justify-center relative z-10">
            <div class="mb-6">
                <span class="bg-shadow text-primary text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full shadow-lg">
                    {{ __('messages.hero_label') }}
                </span>
            </div>
            
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-shadow mb-6 leading-tight tracking-tight">
                {{ __('messages.hero_title_1') }}<br>
                <span class="text-secondary">{{ __('messages.hero_title_2') }}</span>
            </h1>
            
            <p class="text-lg md:text-xl text-shadow/80 mb-10 max-w-xl leading-relaxed font-medium">
                {{ __('messages.hero_subtitle') }}
            </p>
            
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('products.index') }}" class="btn-primary shadow-xl">
                    {{ __('messages.explore_collection') }}
                </a>
                <a href="{{ route('artists.index') }}" class="bg-transparent border-2 border-shadow text-shadow hover:bg-shadow hover:text-primary px-8 py-3 rounded-full font-bold transition-all duration-200 hover:scale-105 active:scale-95 shadow-xl">
                    {{ __('messages.view_artists') }}
                </a>
            </div>
        </div>

        <!-- Carousel Area (Right) -->
        <div class="w-full lg:w-1/2 h-[50vh] lg:h-[70vh] relative overflow-hidden flex items-center justify-center">
            <!-- Decorative Blobs -->
            <div class="absolute top-1/4 right-1/4 w-72 h-72 bg-white/40 rounded-full mix-blend-overlay filter blur-3xl opacity-70 animate-blob"></div>
            <div class="absolute bottom-1/4 right-1/3 w-72 h-72 bg-accent/30 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
            
            <!-- 3D Carousel container -->
            <div class="relative w-full h-full" style="perspective: 1200px;">
                <div class="w-full h-full flex items-center justify-center relative" id="hero-carousel">
                    @php
                        $carouselArtists = \App\Models\Artist::whereNotNull('image_url')->take(5)->get();
                    @endphp
                    @foreach($carouselArtists as $index => $artist)
                        <a href="{{ route('artists.show', $artist->id) }}" class="carousel-item absolute w-48 sm:w-64 aspect-[3/4] rounded-3xl overflow-hidden shadow-2xl transition-all duration-700 ease-out border-4 border-white/20" data-index="{{ $index }}">
                            <img src="{{ asset('storage/artists/' . $artist->image_url) }}" alt="{{ $artist->name }}" class="w-full h-full object-cover">
                            <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent p-6 pt-12 flex items-end">
                                <p class="text-white font-extrabold text-xl w-full">{{ $artist->name }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@if($latestProducts->count())
    <div class="py-12">
        <div class="flex justify-between items-end mb-8">
            <div class="flex items-center gap-4">
                <span class="bg-accent text-shadow text-xs font-bold uppercase px-3 py-1 rounded-full">{{ __('messages.new_badge') }}</span>
                <h2 class="text-3xl font-extrabold text-shadow tracking-tight m-0">{{ __('messages.latest_releases') }}</h2>
            </div>
            <a href="{{ route('products.index') }}"
               class="text-sm font-bold text-muted hover:text-shadow uppercase tracking-wider transition-colors">{{ __('messages.view_all') }}</a>
        </div>

        <div class="flex overflow-x-auto gap-6 pb-6 snap-x snap-mandatory hide-scrollbar">
            @foreach ($latestProducts as $product)
                <a href="{{ route('products.show', $product->id) }}"
                   class="group block flex-shrink-0 w-64 snap-start">
                    <div class="bg-shadow/5 rounded-2xl p-4 h-full card-hover relative border border-shadow/5">
                        <div class="relative rounded-xl overflow-hidden aspect-square mb-4 shadow-sm group-hover:shadow-lg transition-shadow">
                            @if($product->images && $product->images->count() > 0)
                                @php $imgUrl = $product->images->first()->url; @endphp
                                <img src="{{ filter_var($imgUrl, FILTER_VALIDATE_URL) ? $imgUrl : asset('storage/' . $imgUrl) }}"
                                     alt="{{ $product->translated_name }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-shadow/10 flex items-center justify-center text-shadow/40">
                                    <svg width="36" height="36" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <button class="absolute bottom-3 right-3 w-10 h-10 bg-accent text-shadow rounded-full flex items-center justify-center shadow-md opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 hover:scale-110 hover:bg-accent/90">
                                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </div>
                        <h5 class="font-bold text-shadow text-base mb-1 truncate">{{ $product->translated_name }}</h5>
                        <p class="text-sm text-muted mb-2 truncate">{{ $product->artist->name ?? __('messages.official_artist') }}</p>
                        <span class="font-extrabold text-shadow text-lg">€{{ number_format($product->base_price, 2) }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif

<div class="py-12">
    <div class="flex justify-between items-end mb-8">
        <h2 class="text-3xl font-extrabold text-shadow tracking-tight m-0">{{ __('messages.best_sellers') }}</h2>
        <a href="{{ route('products.index') }}"
           class="text-sm font-bold text-muted hover:text-shadow uppercase tracking-wider transition-colors">{{ __('messages.show_all') }}</a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
        @forelse ($topProducts as $product)
            <a href="{{ route('products.show', $product->id) }}" class="group block">
                <div class="bg-shadow/5 rounded-2xl p-4 h-full card-hover border border-shadow/5">
                    <div class="relative rounded-xl overflow-hidden aspect-square mb-4 shadow-sm group-hover:shadow-md transition-all">
                        @if($product->images && $product->images->count() > 0)
                            @php $imgUrl = $product->images->first()->url; @endphp
                            <img src="{{ filter_var($imgUrl, FILTER_VALIDATE_URL) ? $imgUrl : asset('storage/' . $imgUrl) }}"
                                 alt="{{ $product->translated_name }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-shadow/10 flex items-center justify-center text-shadow/40">
                                <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <button class="absolute bottom-3 right-3 w-10 h-10 bg-accent text-shadow rounded-full flex items-center justify-center shadow-md opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 hover:scale-110">
                            <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                    </div>
                    <h5 class="font-bold text-shadow text-base mb-1 line-clamp-1">{{ $product->translated_name }}</h5>
                    <p class="text-sm text-muted mb-2 line-clamp-1">{{ $product->artist->name ?? __('messages.official_artist') }}</p>
                    <span class="font-extrabold text-shadow">€{{ number_format($product->base_price, 2) }}</span>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-16 bg-shadow/5 rounded-2xl border border-shadow/10 border-dashed">
                <p class="text-muted font-medium">{{ __('messages.no_products') }}</p>
            </div>
        @endforelse
    </div>
</div>

<div class="py-16 mb-8 border-t border-shadow/5 mt-8">
    <div class="flex justify-between items-end mb-10">
        <div>
            <h2 class="text-3xl font-extrabold text-shadow tracking-tight mb-2">{{ __('messages.new_artists') }}</h2>
            <p class="text-muted font-medium">{{ __('messages.new_artists_desc') }}</p>
        </div>
        <a href="{{ route('artists.index') }}"
           class="text-sm font-bold text-muted hover:text-shadow uppercase tracking-wider transition-colors hidden sm:block">{{ __('messages.view_all_artists') }}</a>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-8">
        @forelse ($newestArtists as $artist)
            <a href="{{ route('artists.show', $artist->id) }}" class="group block text-center">
                <div class="relative rounded-full overflow-hidden aspect-square mx-auto w-32 md:w-40 shadow-sm group-hover:shadow-xl transition-shadow duration-300 mb-4 border-4 border-primary group-hover:border-accent">
                    @if($artist->image_url)
                        <img src="{{ asset('storage/artists/' . $artist->image_url) }}"
                             alt="{{ $artist->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-secondary flex items-center justify-center text-primary text-4xl font-extrabold transform group-hover:scale-110 transition-transform duration-500">
                            {{ substr($artist->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <div class="font-extrabold text-shadow text-lg group-hover:text-accent transition-colors">
                    {{ $artist->name }}
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-muted">{{ __('messages.no_artists_available') }}</p>
            </div>
        @endforelse
    </div>
</div>

<style>
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}
.animate-blob {
    animation: blob 7s infinite;
}
.animation-delay-2000 {
    animation-delay: 2s;
}
</style>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const items = document.querySelectorAll('.carousel-item');
    if (!items.length) return;
    
    let activeIndex = 0;
    const total = items.length;

    function updateCarousel() {
        items.forEach((item, i) => {
            let diff = (i - activeIndex + total) % total;
            
            if (diff === 0) {
                item.style.transform = 'translateX(0) scale(1) translateZ(50px) rotateY(0deg)';
                item.style.zIndex = 30;
                item.style.opacity = 1;
                item.style.filter = 'brightness(1)';
            } else if (diff === 1 || diff === - (total - 1)) {
                item.style.transform = 'translateX(55%) scale(0.85) translateZ(-50px) rotateY(-15deg)';
                item.style.zIndex = 20;
                item.style.opacity = 0.9;
                item.style.filter = 'brightness(0.7)';
            } else if (diff === total - 1 || diff === -1) {
                item.style.transform = 'translateX(-55%) scale(0.85) translateZ(-50px) rotateY(15deg)';
                item.style.zIndex = 20;
                item.style.opacity = 0.9;
                item.style.filter = 'brightness(0.7)';
            } else {
                item.style.transform = 'translateX(0) scale(0.7) translateZ(-100px) rotateY(0deg)';
                item.style.zIndex = 10;
                item.style.opacity = 0;
            }
        });
    }

    updateCarousel();

    setInterval(() => {
        activeIndex = (activeIndex + 1) % total;
        updateCarousel();
    }, 3000);
});
</script>
@endpush
