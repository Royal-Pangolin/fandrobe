@extends('layouts.app')
@section('title', 'Pedido #{{ $order->id }} — Admin')

@section('content')
<div class="container-fluid px-4 px-lg-5 py-5">
    <div class="admin-container-md">

        <div class="mb-5">
            <a href="{{ route('admin.pedidos.index') }}" class="text-decoration-none text-muted small fw-bold d-inline-flex align-items-center gap-1 mb-2">
                ← Pedidos
            </a>
            <h1 class="fw-bolder mb-0">Pedido #{{ $order->id }}</h1>
        </div>

        @if(session('mensaje'))
            <div class="alert alert-admin-success rounded-3 mb-4">{{ session('mensaje') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-admin-error rounded-3 mb-4">{{ session('error') }}</div>
        @endif

        <div class="row g-4">
            {{-- Items --}}
            <div class="col-lg-7">
                <h2 class="fw-bold mb-3 admin-label">Artículos</h2>
                <div class="d-flex flex-column gap-2">
                    @foreach($order->items as $item)
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3 admin-item-row">
                            <div>
                                <p class="fw-bold mb-0">{{ $item->product->name ?? '—' }}</p>
                                @if($item->variant)
                                    <p class="text-muted small mb-0">
                                        @if($item->variant->size){{ $item->variant->size->name }}@endif
                                        @if($item->variant->size && $item->variant->color) · @endif
                                        @if($item->variant->color){{ $item->variant->color->name }}@endif
                                    </p>
                                @endif
                                <p class="text-muted small mb-0">Cantidad: {{ $item->quantity }}</p>
                            </div>
                            <span class="fw-bold">€{{ number_format($item->total_price, 2) }}</span>
                        </div>
                    @endforeach
                </div>

                {{-- Totals --}}
                <div class="mt-4 p-4 rounded-3 admin-item-row">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-bold">€{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    @if($order->discount_amount > 0)
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Descuento</span>
                            <span class="fw-bold">−€{{ number_format($order->discount_amount, 2) }}</span>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Envío</span>
                        <span class="fw-bold">€{{ number_format($order->shipping_amount, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between pt-2 admin-total-divider">
                        <span class="fw-bolder">Total</span>
                        <span class="fw-bolder admin-total-amount">€{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-5">
                <div class="p-4 rounded-4 admin-sidebar">

                    <h2 class="fw-bold mb-3 admin-label">Cliente</h2>
                    <p class="fw-bold mb-0">{{ $order->user->first_name }} {{ $order->user->last_name }}</p>
                    <p class="text-muted small mb-4">{{ $order->user->email }}</p>

                    <h2 class="fw-bold mb-3 admin-label">Fecha</h2>
                    <p class="mb-4">{{ \Carbon\Carbon::parse($order->placed_at)->format('d/m/Y H:i') }}</p>

                    <h2 class="fw-bold mb-3 admin-label">Estado actual</h2>
                    <p class="mb-4">
                        <span class="badge rounded-pill fw-semibold px-3 py-2 badge-admin-status">
                            {{ $order->status->name ?? '—' }}
                        </span>
                    </p>

                    <h2 class="fw-bold mb-3 admin-label">Cambiar estado</h2>
                    <form action="{{ route('admin.pedidos.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status_id" class="form-select mb-3 rounded-pill fw-bold admin-table">
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}"
                                    {{ $order->status_id === $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary fw-bold w-100">
                            Actualizar estado
                        </button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
