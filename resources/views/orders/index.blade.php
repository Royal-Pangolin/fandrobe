@extends('layouts.app')
@section('title', 'Mis Pedidos')

@section('content')

<div class="container-fluid px-4 px-lg-5 py-5">
    <div style="height: 76px;"></div>

    <div style="max-width: 900px; margin: 0 auto;">

        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb" style="font-size: 0.8rem; letter-spacing: 0.08em; text-transform: uppercase; opacity: 0.6;">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none text-dark">Inicio</a>
                </li>
                <li class="breadcrumb-item active fw-bold text-dark" aria-current="page">Mis Pedidos</li>
            </ol>
        </nav>

        <div class="d-flex align-items-end justify-content-between mb-5">
            <h1 class="fw-bolder mb-0" style="letter-spacing: -0.03em;">Mis Pedidos</h1>
            @if($orders->count())
                <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.06em;">
                    {{ $orders->count() }} pedido(s)
                </span>
            @endif
        </div>

        @if(session('mensaje'))
            <div class="alert d-flex align-items-center gap-2 rounded-3 mb-4"
                 style="background: rgba(110,117,86,0.12); border: 1px solid rgba(110,117,86,0.3); color: #4a5240;">
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ session('mensaje') }}
            </div>
        @endif

        @if($orders->count())
            <div class="d-flex flex-column gap-3">
                @foreach($orders as $order)
                    @php
                        $statusClass = match(strtolower($order->status->name ?? '')) {
                            'enviado', 'shipped',
                            'entregado', 'delivered',
                            'completado', 'completed' => 'badge-verified',
                            'cancelado', 'cancelled'  => 'badge-urgent',
                            default                   => 'badge-limited',
                        };
                    @endphp
                    <div class="d-flex align-items-center justify-content-between p-4 rounded-3"
                         style="background: rgba(30,28,25,0.03); border: 1px solid rgba(30,28,25,0.08);">

                        <div class="d-flex flex-column flex-md-row align-items-md-center gap-3 gap-md-5">
                            <div>
                                <p class="text-muted mb-1"
                                   style="font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase; font-weight: 700;">
                                    Pedido
                                </p>
                                <span class="fw-bolder" style="font-size: 1.05rem;">
                                    #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-muted mb-1"
                                   style="font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase; font-weight: 700;">
                                    Fecha
                                </p>
                                <span class="fw-bold" style="font-size: 0.95rem;">
                                    {{ \Carbon\Carbon::parse($order->placed_at)->format('d M Y') }}
                                </span>
                            </div>
                            <div>
                                <p class="text-muted mb-1"
                                   style="font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase; font-weight: 700;">
                                    Estado
                                </p>
                                <span class="badge {{ $statusClass }}">{{ $order->status->name }}</span>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-md-row align-items-md-center gap-3 gap-md-5 ms-3">
                            <div class="text-md-end">
                                <p class="text-muted mb-1"
                                   style="font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase; font-weight: 700;">
                                    Total
                                </p>
                                <span class="fw-bolder" style="font-size: 1.25rem; letter-spacing: -0.02em;">
                                    €{{ number_format($order->total_amount, 2) }}
                                </span>
                            </div>
                            <a href="{{ route('orders.show', $order->id) }}"
                               class="btn btn-primary fw-bold"
                               style="font-size: 0.85rem; padding: 0.6rem 1.5rem; white-space: nowrap;">
                                Ver detalle
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 mt-4">
                <svg width="80" height="80" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     class="mb-4 opacity-25">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <h4 class="fw-bold mb-2">Aún no tienes pedidos</h4>
                <p class="text-muted mb-4">Descubre nuestras piezas oficiales y realiza tu primer pedido.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary fw-bold px-5">
                    Explorar Colección
                </a>
            </div>
        @endif

    </div>
</div>
@endsection
