@extends('layouts.app')
@section('title', 'Pedido Confirmado')

@section('content')

<div class="container-fluid px-4 px-lg-5 d-flex align-items-center justify-content-center"
     style="min-height: calc(100vh - 76px); padding-top: 76px;">

    <div class="confirm-container text-center" style="max-width: 520px; width: 100%;">

        <div class="confirm-icon-circle d-inline-flex align-items-center justify-content-center rounded-circle mb-5">
            <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 class="confirm-icon-svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <h1 class="confirm-title fw-bolder mb-3">¡Pedido confirmado!</h1>

        <p class="confirm-message mb-5">
            {{ session('mensaje', 'Hemos recibido tu pedido y lo estamos preparando con cuidado. Te avisaremos cuando esté en camino.') }}
        </p>

        <div class="d-flex align-items-center gap-3 mb-5 opacity-25">
            <div class="confirm-divider-line"></div>
            <svg width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                 fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M9 18V5l12-2v13"/>
                <circle cx="6" cy="18" r="3"/>
                <circle cx="18" cy="16" r="3"/>
            </svg>
            <div class="confirm-divider-line"></div>
        </div>

        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
            <a href="{{ route('orders.index') }}" class="btn btn-primary fw-bold px-5 py-3">
                Ver mis pedidos
            </a>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary fw-bold px-5 py-3">
                Seguir comprando
            </a>
        </div>

    </div>
</div>
@endsection
