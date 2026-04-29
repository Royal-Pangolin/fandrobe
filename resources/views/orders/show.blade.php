@extends('layouts.app')
@section('title', 'Pedido #' . str_pad($order->id, 5, '0', STR_PAD_LEFT))

@section('content')

<div class="container-fluid px-4 px-lg-5 py-5">
    <div class="navbar-spacer"></div>

    <div class="row g-5 content-container-lg">

        <div class="col-lg-7">

            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb breadcrumb-nav">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none text-dark">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('orders.index') }}" class="text-decoration-none text-dark">Mis Pedidos</a>
                    </li>
                    <li class="breadcrumb-item active fw-bold text-dark" aria-current="page">
                        Pedido #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                    </li>
                </ol>
            </nav>

            @php
                $statusClass = match(strtolower($order->status->name ?? '')) {
                    'enviado', 'shipped',
                    'entregado', 'delivered',
                    'completado', 'completed' => 'badge-verified',
                    'cancelado', 'cancelled'  => 'badge-urgent',
                    default                   => 'badge-limited',
                };
            @endphp

            <div class="d-flex align-items-start justify-content-between mb-5">
                <div>
                    <h1 class="fw-bolder mb-1 text-tighter">
                        Pedido #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                    </h1>
                    <span class="text-muted small">
                        Realizado el {{ \Carbon\Carbon::parse($order->placed_at)->format('d \d\e F \d\e Y') }}
                    </span>
                </div>
                <span class="badge {{ $statusClass }} ms-3 badge-sm py-2 px-3">
                    {{ $order->status->name }}
                </span>
            </div>

            <h5 class="fw-bolder mb-3 text-tight">
                Artículos ({{ $order->items->count() }})
            </h5>

            <div class="d-flex flex-column gap-3">
                @foreach($order->items as $item)
                    <div class="panel-subtle d-flex gap-4 p-4 rounded-3">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="fw-bold mb-1" style="font-size: 1rem;">
                                        {{ $item->product->name }}
                                    </p>
                                    @if($item->variant)
                                        <p class="text-muted small mb-1">SKU: {{ $item->variant->sku }}</p>
                                    @endif
                                    <p class="text-muted small mb-0">
                                        {{ $item->quantity }} × €{{ number_format($item->unit_price, 2) }}
                                    </p>
                                </div>
                                <span class="order-item-price fw-bolder ms-3">
                                    €{{ number_format($item->total_price, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-5">
                <a href="{{ route('orders.index') }}"
                   class="link-back text-decoration-none text-muted fw-bold d-inline-flex align-items-center gap-2">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Volver a mis pedidos
                </a>
            </div>

        </div>

        <div class="col-lg-5">
            <div class="sticky-side">

                <div class="panel p-4 rounded-4 mb-4">
                    <h5 class="fw-bolder mb-4 text-tight">Resumen del pedido</h5>

                    <div class="d-flex flex-column gap-2 mb-4 divider-subtle pb-4">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-bold">€{{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        @if($order->discount_amount > 0)
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Descuento</span>
                                <span class="fw-bold text-verified-color">
                                    −€{{ number_format($order->discount_amount, 2) }}
                                </span>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Envío</span>
                            @if($order->shipping_amount > 0)
                                <span class="fw-bold">€{{ number_format($order->shipping_amount, 2) }}</span>
                            @else
                                <span class="fw-bold text-verified-color">Gratis</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-baseline">
                        <span class="fw-bolder fs-5">Total</span>
                        <span class="cart-total-price fw-bolder">
                            €{{ number_format($order->total_amount, 2) }}
                        </span>
                    </div>
                </div>

                @if($order->address)
                    <div class="panel p-4 rounded-4">
                        <h5 class="fw-bolder mb-3 text-tight">Dirección de envío</h5>
                        <div class="order-address-text text-muted">
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
                                <p class="mb-0 fw-bold text-dark">{{ $order->address->country }}</p>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection
