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

        <div class="lg:col-span-7">

            <div class="flex items-end justify-between mb-8">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">{{ __('messages.my_cart') }}</h1>
                @if($items->count())
                    <span class="text-gray-500 text-sm font-bold uppercase tracking-wider">
                        {{ $items->sum('quantity') }} {{ __('messages.items_count') }}
                    </span>
                @endif
            </div>

            @if(session('mensaje'))
                <div class="bg-green-50 text-green-800 p-4 rounded-3xl mb-8 flex items-center gap-3">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('mensaje') }}
                </div>
            @endif

            @if($items->count())
                <div class="flex flex-col gap-6" id="cart-items">
                    @foreach($items as $item)
                        @php
                            $product = $item->product;
                            $imgUrl = null;
                            if ($product->images && $product->images->count() > 0) {
                                $raw = $product->images->first()->url;
                                $imgUrl = filter_var($raw, FILTER_VALIDATE_URL) ? $raw : asset('storage/' . $raw);
                            }
                            $unitPrice = $product->base_price + ($item->variant ? $item->variant->price_delta : 0);
                        @endphp
                        <div class="bg-white/60 backdrop-blur-xl shadow-xl shadow-gray-200/50 p-6 rounded-[2rem] flex flex-col sm:flex-row gap-6 border border-white/50 transition-all hover:shadow-2xl" id="item-{{ $item->id }}">

                            <div class="w-full sm:w-32 h-32 flex-shrink-0 rounded-2xl overflow-hidden bg-gray-100 relative">
                                @if($imgUrl)
                                    <img src="{{ $imgUrl }}" alt="{{ $product->translated_name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-800 text-gray-400">
                                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-grow flex flex-col justify-between">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <a href="{{ route('products.show', $product->id) }}"
                                           class="text-lg font-bold text-gray-900 hover:text-[var(--primary)] transition-colors">
                                            {{ $product->translated_name }}
                                        </a>
                                        @if($item->variant && ($item->variant->size || $item->variant->color))
                                            <p class="text-gray-500 text-sm mt-1">
                                                @if($item->variant->size){{ $item->variant->size->name }}@endif
                                                @if($item->variant->size && $item->variant->color) · @endif
                                                @if($item->variant->color){{ $item->variant->color->name }}@endif
                                            </p>
                                        @endif
                                        <p class="text-gray-500 text-sm mt-1">
                                            €{{ number_format($unitPrice, 2) }} {{ __('messages.per_unit') }}
                                        </p>
                                    </div>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="ml-4">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-1"
                                                title="Eliminar">
                                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>

                                <div class="flex items-center justify-between mt-4">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                          class="flex items-center gap-2">
                                        @csrf @method('PUT')
                                        <div class="flex items-center bg-gray-100 rounded-full overflow-hidden p-1">
                                            <button type="button" class="qty-btn w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-200 text-gray-700 font-medium transition-colors"
                                                    data-action="minus" data-target="qty-{{ $item->id }}">−</button>
                                            <input type="number" name="quantity"
                                                   id="qty-{{ $item->id }}"
                                                   value="{{ $item->quantity }}"
                                                   min="1" max="99"
                                                   class="w-12 bg-transparent text-center font-bold text-gray-900 focus:outline-none focus:ring-0 p-0 border-0"
                                                   onchange="this.form.submit()">
                                            <button type="button" class="qty-btn w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-200 text-gray-700 font-medium transition-colors"
                                                    data-action="plus" data-target="qty-{{ $item->id }}">+</button>
                                        </div>
                                    </form>

                                    <span class="text-xl font-extrabold text-gray-900">
                                        €{{ number_format($unitPrice * $item->quantity, 2) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center gap-2 text-gray-500 font-bold hover:text-gray-900 transition-colors">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                        {{ __('messages.continue_shopping') }}
                    </a>
                </div>

            @else
                <div class="text-center py-16 mt-8 bg-white/60 backdrop-blur-xl rounded-[2rem] border border-white/50 shadow-xl shadow-gray-200/50">
                    <svg width="80" height="80" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         class="mx-auto mb-6 text-gray-300">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <h4 class="text-2xl font-bold mb-3 text-gray-900">{{ __('messages.cart_empty') }}</h4>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">{{ __('messages.cart_empty_desc') }}</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-[var(--primary)] text-[var(--accent)] rounded-full font-bold shadow-lg shadow-[var(--primary)]/30 hover:scale-105 hover:shadow-xl transition-all">
                        {{ __('messages.explore_collection') }}
                    </a>
                </div>
            @endif
        </div>

        @if($items->count())
            <div class="lg:col-span-5">
                <div class="bg-[var(--accent)] p-8 rounded-[2rem] shadow-xl shadow-gray-200/50 sticky top-28">

                    <h3 class="text-2xl font-extrabold mb-6 text-gray-900 tracking-tight">{{ __('messages.order_summary') }}</h3>

                    <div class="flex flex-col gap-4 mb-6 border-b border-gray-200/50 pb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">{{ __('messages.subtotal') }}</span>
                            <span class="font-bold text-gray-900">€{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-500">{{ __('messages.shipping') }}</span>
                            <span class="font-bold text-gray-900">€{{ number_format($shipping, 2) }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-end mb-8">
                        <span class="text-xl font-extrabold text-gray-900">{{ __('messages.total') }}</span>
                        <span class="text-4xl font-extrabold text-gray-900 tracking-tight">
                            €{{ number_format($total, 2) }}
                        </span>
                    </div>

                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center py-4 bg-shadow text-primary font-bold rounded-full shadow-lg shadow-shadow/30 hover:scale-[1.02] hover:shadow-xl transition-all">
                            {{ __('messages.checkout') }}
                        </button>
                    </form>

                    <div class="flex justify-center mt-6">
                        <span class="text-sm font-medium text-gray-400 flex items-center gap-2">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                            {{ __('messages.secure_payment') }}
                        </span>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200/50">
                        <p class="text-sm font-bold text-gray-700 mb-3">{{ __('messages.discount_code') }}</p>
                        <form class="flex gap-2">
                            <input type="text" name="code" placeholder="{{ __('messages.code_placeholder') }}"
                                   class="flex-1 rounded-full border border-gray-300 shadow-sm focus:border-[var(--primary)] focus:ring focus:ring-[var(--primary)]/20 px-4 py-2.5 text-sm uppercase tracking-widest font-bold">
                            <button type="submit" class="px-6 py-2.5 bg-gray-900 text-white font-bold rounded-full hover:bg-gray-800 transition-colors text-sm">
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
