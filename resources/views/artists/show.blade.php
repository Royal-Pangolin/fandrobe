@extends('layouts.app')
@section('title', $artist->name)

@section('content')

@php
    $orbSets = [
        ['#C49A3C', '#8B3A10', '#E8C46A'],
        ['#2D8A7A', '#5E7248', '#C49A3C'],
        ['#B84030', '#7B2D1E', '#E8C46A'],
        ['#7B3070', '#B84030', '#C49A3C'],
        ['#1E4A7F', '#2D8A7A', '#6E8560'],
        ['#2A6B3A', '#C49A3C', '#8B3A10'],
    ];
    $bgColors = ['#100C09','#090C10','#090F0C','#0C0910','#09100F','#100909'];
    $set = $orbSets[$artist->id % 6];
    $bg  = $bgColors[$artist->id % 6];
    $allProducts = $artist->products ?? collect();
    $categories  = $allProducts->flatMap->categories->unique('id')->values();
@endphp

<div class="relative overflow-hidden w-full h-[400px] flex items-end pb-8" style="background-color: {{ $bg }};">
    <div class="absolute rounded-full opacity-70 filter blur-3xl animate-blob" style="width: 65%; aspect-ratio:1; background:{{ $set[0] }}; top:-15%; left:-10%; animation-duration:9s;"></div>
    <div class="absolute rounded-full opacity-70 filter blur-3xl animate-blob" style="width: 50%; aspect-ratio:1; background:{{ $set[1] }}; bottom:-15%; right:-8%; animation-duration:12s; animation-delay:-4s; animation-direction:reverse;"></div>
    <div class="absolute rounded-full opacity-70 filter blur-3xl animate-blob" style="width: 38%; aspect-ratio:1; background:{{ $set[2] }}; top:25%; left:40%; animation-duration:15s; animation-delay:-8s;"></div>

    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent pointer-events-none"></div>

    <div class="relative w-full px-4 lg:px-12 flex justify-between items-end z-10">
        <div>
            <div class="flex items-center gap-2 mb-3">
                <svg width="24" height="24" fill="#6E7556" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-white font-bold tracking-widest text-sm uppercase">{{ __('messages.verified_artist') }}</span>
            </div>
            <h1 class="text-6xl md:text-8xl font-extrabold text-white tracking-tighter">{{ $artist->name }}</h1>
        </div>
        <div class="mb-4">
            @auth
                @php
                    $isFollowing = auth()->user()->followedArtists()->where('artist_id', $artist->id)->exists();
                @endphp
                <form method="POST" action="{{ route('favorites.toggleArtist') }}">
                    @csrf
                    <input type="hidden" name="artist_id" value="{{ $artist->id }}">
                    @if($isFollowing)
                        <button type="submit" class="bg-white text-black rounded-full font-bold uppercase text-sm px-6 py-3 border-0 flex items-center gap-2 hover:bg-opacity-90 transition-all">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" clip-rule="evenodd"></path>
                            </svg>
                            {{ __('messages.following') }}
                        </button>
                    @else
                        <button type="submit" class="bg-transparent border-2 border-white text-white rounded-full font-bold uppercase text-sm px-6 py-3 hover:bg-white hover:text-black transition-all">{{ __('messages.follow') }}</button>
                    @endif
                </form>
            @else
                <a href="{{ route('login') }}" class="inline-block bg-transparent border-2 border-white text-white rounded-full font-bold uppercase text-sm px-6 py-3 hover:bg-white hover:text-black transition-all">{{ __('messages.follow') }}</a>
            @endauth
        </div>
    </div>
</div>

<div class="w-full px-4 lg:px-12 py-12 pb-16">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
        <span class="text-muted font-bold text-sm uppercase tracking-widest">
            {{ $allProducts->count() }} {{ __('messages.works_available') }}
        </span>
        <div class="flex gap-4 flex-wrap w-full md:w-auto">
            <div class="relative w-full md:w-64">
                <input type="text" id="artistProductSearch" class="w-full bg-shadow/5 border border-shadow/10 rounded-full py-2.5 px-5 text-sm focus:ring-2 focus:ring-accent focus:outline-none"
                       placeholder="{{ __('messages.search_work') }}">
            </div>
            <select id="artistCategoryFilter" class="bg-shadow/5 border border-shadow/10 rounded-full py-2.5 px-5 text-sm font-bold focus:ring-2 focus:ring-accent focus:outline-none min-w-[200px]">
                <option value="all">{{ __('messages.all_categories') }}</option>
                @foreach($categories as $cat)
                    <option value="{{ Str::slug($cat->name) }}">{{ $cat->translated_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if($allProducts->count())
        <div class="artist-category-section mb-12" data-category="all">
            <div class="flex justify-between items-end mb-6">
                <h3 class="text-3xl font-extrabold text-shadow tracking-tight m-0">{{ __('messages.popular_works') }}</h3>
                <span class="text-muted text-xs font-bold uppercase tracking-widest">
                    {{ $allProducts->count() }} {{ __('messages.works') }}
                </span>
            </div>
            <div class="flex overflow-x-auto gap-6 pb-6 snap-x snap-mandatory hide-scrollbar">
                @foreach($allProducts as $product)
                    <a href="{{ route('products.show', $product->id) }}"
                       class="group block flex-shrink-0 w-64 snap-start artist-product-card"
                       data-name="{{ strtolower($product->translated_name) }}"
                       data-category="{{ $product->categories->isNotEmpty() ? Str::slug($product->categories->first()->name) : '' }}">
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
                                <button class="absolute bottom-3 right-3 w-10 h-10 bg-accent text-shadow rounded-full flex items-center justify-center shadow-md opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 hover:scale-110">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </div>
                            <h5 class="font-bold text-shadow text-base mb-2 truncate">{{ $product->translated_name }}</h5>
                            <div class="flex justify-between items-center">
                                <span class="font-extrabold text-shadow text-lg">€{{ number_format($product->base_price, 2) }}</span>
                                <span class="bg-accent/10 text-accent text-[10px] font-bold uppercase tracking-widest px-2 py-1 rounded">{{ __('messages.official') }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    @foreach($categories as $cat)
        @php
            $catProducts = $allProducts->filter(fn($p) => $p->categories->contains('id', $cat->id));
        @endphp
        @if($catProducts->count())
            <div class="artist-category-section mb-12" data-category="{{ Str::slug($cat->name) }}">
                <div class="flex justify-between items-end mb-6">
                    <h3 class="text-3xl font-extrabold text-shadow tracking-tight m-0">{{ $cat->translated_name }}</h3>
                    <span class="text-muted text-xs font-bold uppercase tracking-widest">
                        {{ $catProducts->count() }} {{ __('messages.works') }}
                    </span>
                </div>
                <div class="flex overflow-x-auto gap-6 pb-6 snap-x snap-mandatory hide-scrollbar">
                    @foreach($catProducts as $product)
                        <a href="{{ route('products.show', $product->id) }}"
                           class="group block flex-shrink-0 w-64 snap-start artist-product-card"
                           data-name="{{ strtolower($product->translated_name) }}"
                           data-category="{{ Str::slug($cat->name) }}">
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
                                    <button class="absolute bottom-3 right-3 w-10 h-10 bg-accent text-shadow rounded-full flex items-center justify-center shadow-md opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 hover:scale-110">
                                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                </div>
                                <h5 class="font-bold text-shadow text-base mb-2 truncate">{{ $product->translated_name }}</h5>
                                <div class="flex justify-between items-center">
                                    <span class="font-extrabold text-shadow text-lg">€{{ number_format($product->base_price, 2) }}</span>
                                    <span class="bg-accent/10 text-accent text-[10px] font-bold uppercase tracking-widest px-2 py-1 rounded">{{ __('messages.official') }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

    <div class="mt-16 pt-8 border-t border-shadow/10">
        <h4 class="font-extrabold text-3xl text-shadow mb-8">{{ __('messages.about') }}</h4>
        <div class="bg-shadow/5 p-8 rounded-3xl border border-shadow/5">
            <p class="text-muted text-lg leading-relaxed mb-10 max-w-4xl">
                {{ $artist->translated_bio ?? __('messages.no_bio') }}
            </p>
            <div class="flex gap-12 flex-wrap">
                <div>
                    <span class="block text-xs font-bold text-muted uppercase tracking-widest mb-2">{{ __('messages.main_genre') }}</span>
                    <span class="font-extrabold text-xl text-shadow">{{ $artist->genre->name ?? __('messages.various') }}</span>
                </div>
                <div>
                    <span class="block text-xs font-bold text-muted uppercase tracking-widest mb-2">{{ __('messages.available_works') }}</span>
                    <span class="font-extrabold text-xl text-shadow">{{ $allProducts->count() }} {{ __('messages.articles') }}</span>
                </div>
                <div>
                    <span class="block text-xs font-bold text-muted uppercase tracking-widest mb-2">{{ __('messages.member_since') }}</span>
                    <span class="font-extrabold text-xl text-shadow">{{ $artist->created_at ? $artist->created_at->format('M Y') : '2026' }}</span>
                </div>
            </div>
        </div>
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
</style>

@endsection

@push('scripts')
<script>
    (function () {
        const searchInput    = document.getElementById('artistProductSearch');
        const categoryFilter = document.getElementById('artistCategoryFilter');
        const sections       = document.querySelectorAll('.artist-category-section');
        const cards          = document.querySelectorAll('.artist-product-card');

        function applyFilters() {
            const searchTerm       = (searchInput?.value || '').toLowerCase().trim();
            const selectedCategory = categoryFilter?.value || 'all';

            sections.forEach(section => {
                const sectionCat = section.getAttribute('data-category');
                if (selectedCategory !== 'all') {
                    section.style.display = sectionCat === 'all' || sectionCat !== selectedCategory ? 'none' : '';
                } else {
                    section.style.display = '';
                }
            });

            cards.forEach(card => {
                const name = card.getAttribute('data-name') || '';
                card.style.display = !searchTerm || name.includes(searchTerm) ? '' : 'none';
            });
        }

        searchInput?.addEventListener('input', applyFilters);
        categoryFilter?.addEventListener('change', applyFilters);
    })();
</script>
@endpush
