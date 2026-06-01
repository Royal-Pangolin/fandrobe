@extends('layouts.app')
@section('title', __('messages.my_favorites'))

@section('content')

<div class="bg-gradient-to-r from-accent/20 to-secondary/20 pt-20 pb-12 px-4 sm:px-6 lg:px-8 mb-12">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-start md:items-end justify-between gap-6">
        <div>
            <h1 class="text-5xl md:text-6xl font-extrabold text-shadow tracking-tighter mb-2">
                {{ __('messages.my_favorites') }}
            </h1>
            <p class="text-shadow/80 font-medium max-w-lg">
                {{ __('messages.favorites_desc') }}
            </p>
        </div>
        <div class="flex gap-3 bg-shadow/5 p-1 rounded-full border border-shadow/10">
            <a href="{{ route('favorites.index') }}" class="px-6 py-2 rounded-full font-bold text-sm bg-shadow text-primary shadow-sm pointer-events-none">{{ __('messages.products_tab') }}</a>
            <a href="{{ route('followings.index') }}" class="px-6 py-2 rounded-full font-bold text-sm text-shadow hover:bg-shadow/10 transition-colors">{{ __('messages.followed_artists_tab') }}</a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">

    @if($favorites->count())
        <div class="flex justify-between items-center mb-8">
            <span class="text-sm font-bold text-muted uppercase tracking-widest">
                <span class="text-shadow font-extrabold">{{ $favorites->count() }}</span> {{ __('messages.saved_products') }}
            </span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($favorites as $fav)
                @php $product = $fav->product; @endphp
                @if($product)
                    <div class="group relative block" id="fav-product-{{ $product->id }}">
                        <form method="POST" action="{{ route('favorites.toggleProduct') }}" class="absolute top-4 right-4 z-10">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="w-10 h-10 rounded-full bg-primary/80 backdrop-blur text-accent flex items-center justify-center hover:bg-primary hover:text-error hover:scale-110 transition-all shadow-sm" title="{{ __('messages.remove_favorite') }}">
                                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                                </svg>
                            </button>
                        </form>

                        <a href="{{ route('products.show', $product->id) }}" class="block">
                            <div class="bg-shadow/5 rounded-2xl p-4 h-full card-hover relative border border-shadow/5">
                                <div class="relative rounded-xl overflow-hidden aspect-[4/5] mb-4 shadow-sm group-hover:shadow-lg transition-shadow">
                                    @if($product->images && $product->images->count() > 0)
                                        @php $imgUrl = $product->images->first()->url; @endphp
                                        <img src="{{ filter_var($imgUrl, FILTER_VALIDATE_URL) ? $imgUrl : asset('storage/' . $imgUrl) }}"
                                             alt="{{ $product->translated_name }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full bg-shadow/10 flex items-center justify-center text-shadow/40">
                                            <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <span class="block text-[10px] font-bold text-muted uppercase tracking-widest mb-1 truncate">
                                    {{ $product->artist->name ?? __('messages.official_artist') }}
                                </span>
                                <h5 class="font-bold text-shadow text-base mb-2 truncate">{{ $product->translated_name }}</h5>
                                <span class="font-extrabold text-shadow text-lg">€{{ number_format($product->base_price, 2) }}</span>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="text-center py-20 bg-shadow/5 rounded-3xl border border-shadow/5 mt-8">
            <svg width="80" height="80" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="mx-auto mb-6 opacity-20 text-shadow">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
            <h3 class="text-2xl font-extrabold text-shadow mb-3">{{ __('messages.no_favorites') }}</h3>
            <p class="text-muted font-medium mb-8 max-w-md mx-auto">
                {{ __('messages.no_favorites_desc') }}
            </p>
            <a href="{{ route('products.index') }}" class="btn-primary inline-block">{{ __('messages.explore_catalog') }}</a>
        </div>
    @endif

</div>
@endsection
