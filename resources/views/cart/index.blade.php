@extends('layouts.app')
@section('title', __('messages.my_cart'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pt-28">

    @php
        $subtotal = $items->sum(fn($item) => $item->product->base_price * $item->quantity);
        $shipping = 4.99;
        $total = $subtotal + $shipping;
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

        {{-- ── LEFT COLUMN: Cart Items ── --}}
        <div class="lg:col-span-7 flex flex-col gap-6">

            {{-- Header --}}
            <div class="flex items-end justify-between">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">{{ __('messages.my_cart') }}</h1>
                @if($items->count())
                    <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">
                        {{ $items->sum('quantity') }} {{ __('messages.items_count') }}
                    </span>
                @endif
            </div>

            {{-- Flash message --}}
            @if(session('mensaje'))
                <div class="flex items-center gap-3 bg-green-50 text-green-800 border border-green-200 rounded-2xl px-5 py-4 text-sm font-medium">
                    <svg class="shrink-0" width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('mensaje') }}
                </div>
            @endif

            {{-- Cart items or empty state --}}
            @if($items->count())
                <div class="flex flex-col gap-4" id="cart-items">
                    @foreach($items as $item)
                        @php
                            $product   = $item->product;
                            $imgUrl    = null;
                            if ($product->images && $product->images->count() > 0) {
                                $raw    = $product->images->first()->url;
                                $imgUrl = filter_var($raw, FILTER_VALIDATE_URL) ? $raw : asset('storage/' . $raw);
                            }
                            $unitPrice = $product->base_price + ($item->variant ? $item->variant->price_delta : 0);
                        @endphp

                        <div id="item-{{ $item->id }}"
                             class="flex flex-col sm:flex-row gap-5 bg-white/70 backdrop-blur-md border border-white/60 rounded-3xl p-5 shadow-md shadow-gray-100/80 hover:shadow-lg transition-shadow">

                            {{-- Product image --}}
                            <a href="{{ route('products.show', $product->id) }}"
                               class="shrink-0 w-full sm:w-28 h-28 rounded-2xl overflow-hidden bg-gray-100 block">
                                @if($imgUrl)
                                    <img src="{{ $imgUrl }}" alt="{{ $product->translated_name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </a>

                            {{-- Product info --}}
                            <div class="flex-1 flex flex-col justify-between gap-3">
                                <div class="flex justify-between items-start gap-4">
                                    <div>
                                        <a href="{{ route('products.show', $product->id) }}"
                                           class="text-base font-bold text-gray-900 hover:text-shadow transition-colors leading-snug">
                                            {{ $product->translated_name }}
                                        </a>
                                        @if($item->variant && ($item->variant->size || $item->variant->color))
                                            <p class="text-xs text-gray-400 mt-0.5">
                                                @if($item->variant->size){{ $item->variant->size->name }}@endif
                                                @if($item->variant->size && $item->variant->color) · @endif
                                                @if($item->variant->color){{ $item->variant->color->name }}@endif
                                            </p>
                                        @endif
                                        <p class="text-xs text-gray-400 mt-0.5">
                                            €{{ number_format($unitPrice, 2) }} {{ __('messages.per_unit') }}
                                        </p>
                                    </div>

                                    {{-- Delete button --}}
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="text-gray-300 hover:text-red-400 transition-colors p-1 rounded-lg hover:bg-red-50"
                                                title="{{ __('messages.remove') }}">
                                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                {{-- Quantity + Price --}}
                                <div class="flex items-center justify-between">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                          class="flex items-center">
                                        @csrf @method('PUT')
                                        <div class="flex items-center bg-gray-100 rounded-full overflow-hidden">
                                            <button type="button"
                                                    class="qty-btn w-9 h-9 flex items-center justify-center text-gray-600 hover:bg-gray-200 transition-colors font-bold text-lg leading-none"
                                                    data-action="minus" data-target="qty-{{ $item->id }}">−</button>
                                            <input type="number" name="quantity"
                                                   id="qty-{{ $item->id }}"
                                                   value="{{ $item->quantity }}"
                                                   min="1" max="99"
                                                   class="w-10 bg-transparent text-center text-sm font-bold text-gray-900 focus:outline-none border-0 p-0"
                                                   onchange="this.form.submit()">
                                            <button type="button"
                                                    class="qty-btn w-9 h-9 flex items-center justify-center text-gray-600 hover:bg-gray-200 transition-colors font-bold text-lg leading-none"
                                                    data-action="plus" data-target="qty-{{ $item->id }}">+</button>
                                        </div>
                                    </form>

                                    <span class="text-xl font-extrabold text-gray-900 tracking-tight">
                                        €{{ number_format($unitPrice * $item->quantity, 2) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Continue shopping --}}
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-gray-700 transition-colors">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ __('messages.continue_shopping') }}
                </a>

            @else
                {{-- Empty cart --}}
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center mb-6">
                        <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-extrabold text-gray-900 mb-2">{{ __('messages.cart_empty') }}</h2>
                    <p class="text-gray-400 mb-8 max-w-xs">{{ __('messages.cart_empty_desc') }}</p>
                    <a href="{{ route('products.index') }}"
                       class="btn-primary inline-flex items-center gap-2 px-8 py-3">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        {{ __('messages.explore_collection') }}
                    </a>
                </div>
            @endif
        </div>

        {{-- ── RIGHT COLUMN: Order Summary ── --}}
        @if($items->count())
            <div class="lg:col-span-5">
                <div class="sticky top-28 bg-white/70 backdrop-blur-md border border-white/60 rounded-3xl p-7 shadow-md shadow-gray-100/80 flex flex-col gap-6">

                    <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">{{ __('messages.order_summary') }}</h2>

                    {{-- Line items --}}
                    <div class="flex flex-col gap-3 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">{{ __('messages.subtotal') }}</span>
                            <span class="font-semibold text-gray-900">€{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">{{ __('messages.shipping') }}</span>
                            <span class="font-semibold text-gray-900">€{{ number_format($shipping, 2) }}</span>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="h-px bg-gray-200/70"></div>

                    {{-- Total --}}
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-extrabold text-gray-900">{{ __('messages.total') }}</span>
                        <span class="text-3xl font-extrabold text-gray-900 tracking-tight">
                            €{{ number_format($total, 2) }}
                        </span>
                    </div>

                    {{-- Checkout button --}}
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center justify-center gap-2 py-4 px-6 bg-shadow text-primary font-bold text-base rounded-full shadow-lg shadow-shadow/20 hover:scale-[1.02] hover:shadow-xl transition-all">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ __('messages.checkout') }}
                        </button>
                    </form>

                    {{-- Secure payment badge --}}
                    <div class="flex items-center justify-center gap-2 text-xs text-gray-400">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                        {{ __('messages.secure_payment') }}
                    </div>

                    {{-- Discount code --}}
                    <div class="border-t border-gray-200/70 pt-4">
                        <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">{{ __('messages.discount_code') }}</p>
                        <form class="flex gap-2">
                            <input type="text" name="code"
                                   placeholder="{{ __('messages.code_placeholder') }}"
                                   class="flex-1 rounded-full border border-gray-200 bg-gray-50 px-4 py-2.5 text-xs font-bold uppercase tracking-widest focus:outline-none focus:border-gray-400 focus:ring-2 focus:ring-gray-200 transition-all">
                            <button type="submit"
                                    class="px-5 py-2.5 bg-gray-900 text-white text-xs font-bold rounded-full hover:bg-gray-700 transition-colors whitespace-nowrap">
                                {{ __('messages.apply') }}
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @endif

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.qty-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const input = document.getElementById(btn.dataset.target);
            if (!input) return;
            let val = parseInt(input.value) || 1;
            if (btn.dataset.action === 'plus')  val = Math.min(val + 1, 99);
            if (btn.dataset.action === 'minus') val = Math.max(val - 1, 1);
            input.value = val;
            input.form.submit();
        });
    });
</script>
@endpush
