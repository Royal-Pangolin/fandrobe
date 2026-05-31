@extends('layouts.app')
@section('title', __('messages.order') . ' #' . str_pad($order->id, 5, '0', STR_PAD_LEFT))

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

        <div class="lg:col-span-7">

            <nav aria-label="breadcrumb" class="mb-8">
                <ol class="flex items-center space-x-2 text-sm font-bold text-muted">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-accent transition-colors">{{ __('messages.breadcrumb_home') }}</a>
                    </li>
                    <li>
                        <span class="mx-2">/</span>
                    </li>
                    <li>
                        <a href="{{ route('orders.index') }}" class="hover:text-accent transition-colors">{{ __('messages.my_orders') }}</a>
                    </li>
                    <li>
                        <span class="mx-2">/</span>
                    </li>
                    <li class="text-shadow" aria-current="page">
                        {{ __('messages.order') }} #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                    </li>
                </ol>
            </nav>

            @php
                $statusClass = match(strtolower($order->status->name ?? '')) {
                    'enviado', 'shipped',
                    'entregado', 'delivered',
                    'completado', 'completed' => 'bg-verified/20 text-verified',
                    'cancelado', 'cancelled'  => 'bg-error/20 text-error',
                    default                   => 'bg-accent/20 text-accent',
                };
            @endphp

            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-10 border-b border-shadow/10 pb-8">
                <div>
                    <h1 class="text-4xl font-extrabold text-shadow tracking-tight mb-2">
                        {{ __('messages.order') }} #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                    </h1>
                    <span class="text-sm font-bold text-muted uppercase tracking-widest">
                        {{ __('messages.placed_on') }} {{ \Carbon\Carbon::parse($order->placed_at)->format('d/m/Y') }}
                    </span>
                </div>
                <span class="inline-block px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest {{ $statusClass }}">
                    {{ $order->status->name }}
                </span>
            </div>

            <h5 class="text-xl font-extrabold text-shadow mb-6">
                {{ __('messages.items_label') }} ({{ $order->items->count() }})
            </h5>

            <div class="space-y-4">
                @foreach($order->items as $item)
                    <div class="bg-shadow/5 border border-shadow/5 rounded-2xl p-6 flex items-start gap-4">
                        <div class="flex-grow">
                            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                                <div>
                                    <p class="font-extrabold text-shadow mb-1 text-lg">
                                        {{ $item->product->translated_name }}
                                    </p>
                                    @if($item->variant)
                                        <p class="text-xs font-bold text-muted uppercase tracking-widest mb-2">SKU: {{ $item->variant->sku }}</p>
                                    @endif
                                    <p class="text-sm font-medium text-muted">
                                        {{ $item->quantity }} × €{{ number_format($item->unit_price, 2) }}
                                    </p>
                                </div>
                                <span class="font-extrabold text-shadow text-xl sm:text-right">
                                    €{{ number_format($item->total_price, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                <a href="{{ route('orders.index') }}"
                   class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-muted hover:text-accent transition-colors">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ __('messages.back_to_orders') }}
                </a>
            </div>

        </div>

        <div class="lg:col-span-5">
            <div class="sticky top-24 space-y-6">

                <div class="bg-shadow/5 border border-shadow/5 p-8 rounded-3xl">
                    <h5 class="text-xl font-extrabold text-shadow mb-6">{{ __('messages.order_summary') }}</h5>

                    <div class="flex flex-col gap-4 mb-6 border-b border-shadow/10 pb-6">
                        <div class="flex justify-between items-center text-sm font-bold">
                            <span class="text-muted uppercase tracking-widest">{{ __('messages.subtotal') }}</span>
                            <span class="text-shadow text-lg">€{{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        @if($order->discount_amount > 0)
                            <div class="flex justify-between items-center text-sm font-bold">
                                <span class="text-muted uppercase tracking-widest">{{ __('messages.discount') }}</span>
                                <span class="text-error text-lg">
                                    −€{{ number_format($order->discount_amount, 2) }}
                                </span>
                            </div>
                        @endif
                        <div class="flex justify-between items-center text-sm font-bold">
                            <span class="text-muted uppercase tracking-widest">{{ __('messages.shipping') }}</span>
                            @if($order->shipping_amount > 0)
                                <span class="text-shadow text-lg">€{{ number_format($order->shipping_amount, 2) }}</span>
                            @else
                                <span class="text-verified text-lg">{{ __('messages.free') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-between items-end">
                        <span class="text-2xl font-extrabold text-shadow">{{ __('messages.total') }}</span>
                        <span class="text-3xl font-extrabold text-shadow">
                            €{{ number_format($order->total_amount, 2) }}
                        </span>
                    </div>
                </div>

                @if($order->address)
                    <div class="bg-shadow/5 border border-shadow/5 p-8 rounded-3xl">
                        <h5 class="text-xl font-extrabold text-shadow mb-4">{{ __('messages.shipping_address') }}</h5>
                        <div class="text-muted font-medium leading-relaxed">
                            @if($order->address->street)
                                <p class="mb-1">{{ $order->address->street }}</p>
                            @endif
                            @if($order->address->city || $order->address->postal_code)
                                <p class="mb-1">{{ $order->address->postal_code }} {{ $order->address->city }}</p>
                            @endif
                            @if($order->address->state)
                                <p class="mb-1">{{ $order->address->state }}</p>
                            @endif
                            @if($order->address->country)
                                <p class="mt-2 font-extrabold text-shadow">{{ $order->address->country }}</p>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection
