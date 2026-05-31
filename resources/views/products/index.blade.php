@extends('layouts.app')
@section('title', __('messages.catalog_title'))

@section('content')

    <form method="GET" action="{{ route('products.index') }}">

    <div class="relative px-4 lg:px-12 mb-12" style="padding-top: calc(76px + 32px);">
        <div class="w-full pb-12">
            <div class="flex flex-col md:flex-row items-start md:items-end justify-between gap-6">
                <div>
                    <h1 class="text-shadow font-extrabold mb-4 text-5xl lg:text-6xl tracking-tight leading-tight">
                        {{ __('messages.catalog_title') }}
                    </h1>
                    <p class="text-shadow/80 mb-0 text-xl font-medium">
                        {{ __('messages.catalog_subtitle') }}
                    </p>
                </div>
                <div class="relative w-full max-w-xs">
                    <input type="text" name="q" value="{{ request('q') }}"
                           class="w-full rounded-full py-3 px-6 shadow-sm focus:outline-none focus:ring-2 focus:ring-accent bg-primary/90 backdrop-blur-sm text-shadow"
                           placeholder="{{ __('messages.search_placeholder') }}"
                           style="padding-right: 3.5rem;">
                    <button type="submit" class="absolute top-1/2 right-2 -translate-y-1/2 p-2 text-secondary hover:text-accent transition-colors">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full px-4 lg:px-12 pb-16">
        <div class="flex flex-col md:flex-row gap-10">

            <!-- Sidebar Filters -->
            <div class="w-full md:w-1/4 lg:w-1/5 shrink-0">
                <div class="bg-shadow/5 p-6 rounded-2xl sticky top-24 border border-shadow/5">
                    <h5 class="font-extrabold mb-6 text-xs uppercase tracking-widest text-muted">{{ __('messages.filters') }}</h5>

                    <div class="mb-8">
                        <span class="block font-bold mb-4 text-sm">{{ __('messages.categories') }}</span>
                        @foreach($categories as $category)
                            <label class="flex items-center gap-3 mb-3 cursor-pointer group">
                                <input type="checkbox"
                                       name="categories[]"
                                       value="{{ $category->id }}"
                                       {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                                       class="w-5 h-5 rounded border-shadow/30 text-accent focus:ring-accent bg-transparent cursor-pointer">
                                <span class="text-muted text-sm group-hover:text-shadow transition-colors">
                                    {{ $category->translated_name }}
                                </span>
                            </label>
                        @endforeach
                    </div>

                    <div class="mb-8">
                        <span class="block font-bold mb-4 text-sm">{{ __('messages.max_price') }}</span>
                        <input type="range" 
                               name="price_max"
                               min="0" max="{{ $absoluteMax }}"
                               value="{{ request('price_max', $absoluteMax) }}"
                               id="priceRange"
                               class="w-full h-2 bg-shadow/20 rounded-lg appearance-none cursor-pointer accent-accent"
                               oninput="document.getElementById('priceVal').textContent = this.value + '€'">
                        <div class="flex justify-between text-muted mt-2 text-xs">
                            <span>0€</span>
                            <span id="priceVal" class="font-bold text-shadow">{{ request('price_max', $absoluteMax) }}€</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full btn-primary py-3 text-sm">
                        {{ __('messages.apply_filters') }}
                    </button>

                    @if(request()->hasAny(['q', 'categories', 'price_max', 'sort']))
                        <a href="{{ route('products.index') }}" class="block text-center w-full btn-secondary mt-3 py-3 text-sm">
                            {{ __('messages.clear_filters') }}
                        </a>
                    @endif
                </div>
            </div>

            <!-- Products Grid -->
            <div class="w-full md:w-3/4 lg:w-4/5">
                <div class="flex justify-between items-center mb-8">
                    <span class="text-muted text-sm font-medium">
                        <span class="font-bold text-shadow">{{ $products->total() }}</span> {{ __('messages.products_found') }}
                    </span>
                    <select name="sort" class="bg-primary border border-shadow/10 text-shadow text-sm rounded-full focus:ring-accent focus:border-accent block py-2.5 px-4 font-bold"
                            onchange="this.form.submit()">
                        <option value="featured" {{ request('sort', 'featured') === 'featured' ? 'selected' : '' }}>{{ __('messages.sort_featured') }}</option>
                        <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>{{ __('messages.sort_price_asc') }}</option>
                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>{{ __('messages.sort_price_desc') }}</option>
                        <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>{{ __('messages.sort_newest') }}</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse ($products as $product)
                        <a href="{{ route('products.show', $product->id) }}" class="group block">
                            <div class="bg-shadow/5 rounded-2xl p-4 h-full card-hover border border-shadow/5">
                                <div class="relative rounded-xl overflow-hidden aspect-square mb-4 shadow-sm group-hover:shadow-md transition-all">
                                    @if($product->images && $product->images->count() > 0)
                                        @php $imgUrl = $product->images->first()->url; @endphp
                                        <img src="{{ filter_var($imgUrl, FILTER_VALIDATE_URL) ? $imgUrl : asset('storage/' . $imgUrl) }}"
                                             alt="{{ $product->translated_name }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full bg-shadow/10 flex items-center justify-center text-shadow/40">
                                            <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                    <button class="absolute bottom-3 right-3 w-10 h-10 bg-accent text-shadow rounded-full flex items-center justify-center shadow-md opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 hover:scale-110">
                                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </button>
                                </div>
                                <span class="block text-muted text-xs font-bold uppercase tracking-widest mb-1">
                                    {{ $product->artist->name ?? __('messages.official_artist') }}
                                </span>
                                <h5 class="font-bold text-shadow text-base mb-1 line-clamp-1">{{ $product->translated_name }}</h5>
                                <span class="font-extrabold text-shadow">€{{ number_format($product->base_price, 2) }}</span>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-center text-muted py-16 bg-shadow/5 rounded-2xl border border-shadow/10 border-dashed">
                            <svg width="64" height="64" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="mx-auto mb-4 opacity-25"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <h5 class="font-bold text-xl mb-2">{{ __('messages.no_products_available') }}</h5>
                            <p class="text-sm">{{ __('messages.try_change_filters') }}</p>
                        </div>
                    @endforelse
                </div>

                @if($products->hasPages())
                    <div class="mt-12 flex justify-center">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>

    </form>

@endsection
