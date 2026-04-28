@extends('layouts.app')
@section('title', 'Pedido Confirmado')

@section('content')

<div class="container-fluid px-4 px-lg-5 d-flex align-items-center justify-content-center"
     style="min-height: calc(100vh - 76px); padding-top: 76px;">

    <div class="text-center" style="max-width: 520px; width: 100%;">

        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-5"
             style="width: 96px; height: 96px; background: rgba(110,117,86,0.12);">
            <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 style="color: var(--color-verified);">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <h1 class="fw-bolder mb-3"
            style="font-size: clamp(2rem, 5vw, 3rem); letter-spacing: -0.03em; line-height: 1.05;">
            ¡Pedido confirmado!
        </h1>

        <p class="mb-5" style="font-size: 1.1rem; color: var(--color-muted); line-height: 1.7; max-width: 420px; margin: 0 auto 2rem;">
            {{ session('mensaje', 'Hemos recibido tu pedido y lo estamos preparando con cuidado. Te avisaremos cuando esté en camino.') }}
        </p>

        <div class="d-flex align-items-center gap-3 mb-5" style="opacity: 0.2;">
            <div style="flex: 1; height: 1px; background: var(--color-shadow);"></div>
            <svg width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 21a9 9 0 0 1 -3.665 -17.236l1.092 1.942a7 7 0 0 0 5.146 11.294l-1.093 1.942a9 9 0 0 1 -1.48 .058z"></path>
                <path d="M12 18l-.5 -1l2.5 -4.5l-2 -3.5l1.5 -3l2.5 4.5l-2 3.5l1.5 3l-3.5 1z"></path>
            </svg>
            <div style="flex: 1; height: 1px; background: var(--color-shadow);"></div>
        </div>

        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
            <a href="{{ route('orders.index') }}"
               class="btn btn-primary fw-bold"
               style="font-size: 0.95rem; padding: 0.85rem 2rem;">
                Ver mis pedidos
            </a>
            <a href="{{ route('products.index') }}"
               class="btn btn-outline-secondary fw-bold"
               style="font-size: 0.95rem; padding: 0.85rem 2rem;">
                Seguir comprando
            </a>
        </div>

    </div>
</div>
@endsection
