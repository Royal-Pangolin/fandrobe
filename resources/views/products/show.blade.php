@extends('layouts.app')
@section('title', $product->translated_name)

@section('content')

<div class="w-full px-4 lg:px-12 py-12 max-w-7xl mx-auto">

    <nav aria-label="breadcrumb" class="mb-8">
        <ol class="flex text-sm font-medium text-muted space-x-2">
            <li>
                <a href="{{ route('home') }}" class="hover:text-shadow transition-colors">{{ __('messages.breadcrumb_home') }}</a>
            </li>
            <li><span class="mx-2">/</span></li>
            @foreach($product->categories as $category)
                <li>
                    <a href="{{ route('categories.show', $category->id) }}" class="hover:text-shadow transition-colors">
                        {{ $category->translated_name }}
                    </a>
                </li>
                <li><span class="mx-2">/</span></li>
            @endforeach
            <li class="font-bold text-shadow" aria-current="page">{{ $product->translated_name }}</li>
        </ol>
    </nav>

    <div class="flex flex-col lg:flex-row gap-12">

        <div class="w-full lg:w-1/2">
            <div class="bg-shadow/5 rounded-3xl overflow-hidden aspect-square border border-shadow/5 shadow-sm">
                @if($product->images && $product->images->count() > 0)
                    @php $imgUrl = $product->images->first()->url; @endphp
                    <img src="{{ filter_var($imgUrl, FILTER_VALIDATE_URL) ? $imgUrl : asset('storage/' . $imgUrl) }}"
                         alt="{{ $product->translated_name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-muted bg-shadow/5">
                        <svg width="80" height="80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="mt-4 text-sm font-bold tracking-widest uppercase">{{ __('messages.no_image') }}</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col justify-center">

            <div class="flex items-center gap-3 mb-6 flex-wrap">
                <span class="inline-flex items-center gap-1 bg-accent/10 text-accent text-xs font-bold px-3 py-1 rounded-full">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ __('messages.authenticated') }}
                </span>
                @foreach($product->categories as $category)
                    <span class="bg-shadow/10 text-shadow text-xs font-bold px-3 py-1 rounded-full">{{ $category->translated_name }}</span>
                @endforeach
            </div>

            @if($product->artist)
                <a href="{{ route('artists.show', $product->artist->id) }}"
                   class="text-muted font-bold text-sm tracking-widest uppercase mb-2 hover:text-accent transition-colors">
                    {{ $product->artist->name }}
                </a>
            @endif

            <h1 class="text-4xl lg:text-5xl font-extrabold text-shadow mb-6 tracking-tight">{{ $product->translated_name }}</h1>

            <div class="mb-8 flex items-baseline gap-4">
                <span class="text-3xl font-extrabold text-shadow">
                    €{{ number_format($product->base_price, 2) }}
                </span>
                <span class="text-muted text-xs font-bold tracking-widest uppercase">{{ __('messages.vat_included') }}</span>
            </div>

            @if($product->translated_description)
                <p class="text-muted text-lg leading-relaxed mb-8">{{ $product->translated_description }}</p>
            @endif

            <div class="flex flex-col gap-4 mb-10">
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="variant_id" value="{{ $product->variants->first()?->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn-primary w-full py-4 text-lg">
                        {{ __('messages.add_to_cart') }}
                    </button>
                </form>
                @auth
                    @php
                        $isFavorite = auth()->user()->favorites()->where('product_id', $product->id)->exists();
                    @endphp
                    <form method="POST" action="{{ route('favorites.toggleProduct') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="w-full flex items-center justify-center gap-2 py-4 rounded-full font-bold transition-all border-2 {{ $isFavorite ? 'bg-accent/10 border-accent text-accent' : 'border-shadow/20 text-shadow hover:border-shadow/40 hover:bg-shadow/5' }}">
                            <svg width="20" height="20" fill="{{ $isFavorite ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            {{ $isFavorite ? __('messages.saved_favorites') : __('messages.save_favorites') }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="w-full flex items-center justify-center gap-2 py-4 rounded-full font-bold transition-all border-2 border-shadow/20 text-shadow hover:border-shadow/40 hover:bg-shadow/5">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        {{ __('messages.save_favorites') }}
                    </a>
                @endauth
            </div>

            <div class="pt-8 border-t border-shadow/10">
                <h4 class="text-xs font-bold tracking-widest text-muted uppercase mb-4">{{ __('messages.details') }}</h4>
                <div class="flex flex-col gap-3">
                    @if($product->sku)
                        <div class="flex justify-between items-center py-2 border-b border-shadow/5">
                            <span class="text-muted text-xs font-bold uppercase tracking-widest">SKU</span>
                            <span class="font-bold text-sm text-shadow">{{ $product->sku }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between items-center py-2 border-b border-shadow/5">
                        <span class="text-muted text-xs font-bold uppercase tracking-widest">{{ __('messages.availability') }}</span>
                        <span class="font-bold text-sm text-accent">{{ __('messages.in_stock') }}</span>
                    </div>
                    @if($product->artist)
                        <div class="flex justify-between items-center py-2">
                            <span class="text-muted text-xs font-bold uppercase tracking-widest">{{ __('messages.artist_label') }}</span>
                            <a href="{{ route('artists.show', $product->artist->id) }}"
                               class="font-bold text-sm text-shadow hover:text-accent transition-colors">
                                {{ $product->artist->name }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
