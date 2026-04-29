@extends('layouts.app')
@section('title', 'Mi Carrito')

@section('content')
<div class="container-fluid px-4 px-lg-5 py-5">

    <div class="navbar-spacer"></div>

    @php
        $subtotal = $items->sum(fn($item) => $item->product->base_price * $item->quantity);
        $total = $subtotal;
    @endphp

    <div class="row g-5 content-container-lg">

        {{-- Columna izquierda: productos del carrito --}}
        <div class="col-lg-7">

            <div class="d-flex align-items-end justify-content-between mb-4">
                <h1 class="fw-bolder mb-0 text-tighter">Mi Carrito</h1>
                @if($items->count())
                    <span class="section-link text-muted small fw-bold text-uppercase">
                        {{ $items->sum('quantity') }} artículo(s)
                    </span>
                @endif
            </div>

            @if(session('mensaje'))
                <div class="alert alert-success-flash d-flex align-items-center gap-2 rounded-3 mb-4">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('mensaje') }}
                </div>
            @endif

            @if($items->count())
                <div class="d-flex flex-column gap-3" id="cart-items">
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
                        <div class="cart-item-card d-flex gap-4 p-4 rounded-3" id="item-{{ $item->id }}">

                            <div class="cart-item-thumbnail">
                                @if($imgUrl)
                                    <img src="{{ $imgUrl }}" alt="{{ $product->name }}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-dark text-secondary">
                                        <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-grow-1 d-flex flex-column justify-content-between">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <a href="{{ route('products.show', $product->id) }}"
                                           class="fw-bold text-decoration-none text-dark"
                                           style="font-size: 1.05rem;">
                                            {{ $product->name }}
                                        </a>
                                        @if($item->variant && ($item->variant->size || $item->variant->color))
                                            <p class="text-muted small mb-0 mt-1">
                                                @if($item->variant->size){{ $item->variant->size->name }}@endif
                                                @if($item->variant->size && $item->variant->color) · @endif
                                                @if($item->variant->color){{ $item->variant->color->name }}@endif
                                            </p>
                                        @endif
                                        <p class="text-muted small mb-0 mt-1">
                                            €{{ number_format($unitPrice, 2) }} / unidad
                                        </p>
                                    </div>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="ms-3">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn p-0 border-0 text-muted opacity-50"
                                                onmouseover="this.classList.remove('opacity-50')"
                                                onmouseout="this.classList.add('opacity-50')"
                                                title="Eliminar">
                                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>

                                <div class="d-flex align-items-center justify-content-between mt-3">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST"
                                          class="d-flex align-items-center gap-2">
                                        @csrf @method('PUT')
                                        <div class="cart-qty-control d-flex align-items-center rounded-pill overflow-hidden">
                                            <button type="button" class="btn px-3 py-1 border-0 qty-btn fs-5"
                                                    data-action="minus" data-target="qty-{{ $item->id }}">−</button>
                                            <input type="number" name="quantity"
                                                   id="qty-{{ $item->id }}"
                                                   value="{{ $item->quantity }}"
                                                   min="1" max="99"
                                                   class="cart-qty-input form-control border-0 text-center fw-bold p-0"
                                                   onchange="this.form.submit()">
                                            <button type="button" class="btn px-3 py-1 border-0 qty-btn fs-5"
                                                    data-action="plus" data-target="qty-{{ $item->id }}">+</button>
                                        </div>
                                    </form>

                                    <span class="cart-price-lg fw-bolder">
                                        €{{ number_format($unitPrice * $item->quantity, 2) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    <a href="{{ route('products.index') }}"
                       class="link-back text-decoration-none text-muted fw-bold d-inline-flex align-items-center gap-2">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Seguir comprando
                    </a>
                </div>

            @else
                <div class="text-center py-5 mt-4">
                    <svg width="80" height="80" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         class="mb-4 opacity-25">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <h4 class="fw-bold mb-2">Tu carrito está vacío</h4>
                    <p class="text-muted mb-4">Descubre nuestras piezas oficiales y añade las que más te gusten.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary fw-bold px-5">
                        Explorar Colección
                    </a>
                </div>
            @endif
        </div>

        {{-- Columna derecha: resumen del pedido --}}
        @if($items->count())
            <div class="col-lg-5">
                <div class="panel p-4 rounded-4 cart-summary-panel">

                    <h3 class="fw-bolder mb-4 text-tight">Resumen del pedido</h3>

                    <div class="d-flex flex-column gap-2 mb-4 divider-subtle pb-4">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-bold">€{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between text-muted small">
                            <span>Envío</span>
                            <span class="fw-bold text-verified-color">Gratis</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-baseline mb-5">
                        <span class="fw-bolder fs-5">Total</span>
                        <span class="cart-total-price fw-bolder">
                            €{{ number_format($total, 2) }}
                        </span>
                    </div>

                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary fw-bold w-100 mb-3 py-3">
                            Finalizar Compra
                        </button>
                    </form>

                    <div class="d-flex justify-content-center gap-3 mb-4 opacity-50">
                        <span class="payment-label">Pago seguro · Visa · Mastercard · PayPal</span>
                    </div>

                    <div class="divider-subtle pt-4">
                        <p class="fw-bold mb-2" style="font-size: 0.875rem;">¿Tienes un código de descuento?</p>
                        <form class="d-flex gap-2">
                            <input type="text" name="code" placeholder="CÓDIGO"
                                   class="form-control rounded-pill"
                                   style="font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.08em; font-weight: 700;">
                            <button type="submit" class="btn btn-outline-secondary rounded-pill fw-bold px-4"
                                    style="font-size: 0.875rem; white-space: nowrap;">
                                Aplicar
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
