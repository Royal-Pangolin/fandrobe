<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido confirmado</title>
</head>

<body class="email-body">
    <div class="email-wrapper">

        <div class="email-header">
            <h1 class="email-brand">Fandrobe</h1>
            <p class="email-header-sub">Confirmación de pedido</p>
        </div>

        <div class="email-body-content">

            <p class="email-greeting">¡Gracias, {{ $order->user->first_name }}!</p>
            <p class="email-subtext">
                Hemos recibido tu pedido y lo estamos preparando con cuidado.
                Te avisaremos cuando esté en camino.
            </p>

            <div class="email-meta-row">
                <div class="email-meta-item">
                    <span class="email-meta-label">Pedido</span>
                    <span class="email-meta-value">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="email-meta-item">
                    <span class="email-meta-label">Fecha</span>
                    <span
                        class="email-meta-value">{{ \Carbon\Carbon::parse($order->placed_at)->format('d M Y') }}</span>
                </div>
                <div class="email-meta-item">
                    <span class="email-meta-label">Estado</span>
                    <span class="email-meta-value">{{ $order->status->name }}</span>
                </div>
            </div>

            <p class="email-section-title">Artículos</p>
            <table class="email-items-table">
                @foreach ($order->items as $item)
                    <tr class="email-item-row">
                        <td class="email-item-info">
                            <span class="email-item-name">{{ $item->product->name }}</span>
                            <span class="email-item-meta">
                                @if ($item->variant)
                                    SKU: {{ $item->variant->sku }} ·
                                @endif
                                Cantidad: {{ $item->quantity }}
                            </span>
                        </td>
                        <td class="email-item-price">€{{ number_format($item->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </table>

            <p class="email-section-title">Resumen</p>
            <div class="email-totals">
                <div class="email-totals-row">
                    <span class="email-totals-label">Subtotal</span>
                    <span>€{{ number_format($order->subtotal, 2) }}</span>
                </div>
                @if ($order->discount_amount > 0)
                    <div class="email-totals-row">
                        <span class="email-totals-label">Descuento</span>
                        <span class="email-discount">−€{{ number_format($order->discount_amount, 2) }}</span>
                    </div>
                @endif
                <div class="email-totals-row">
                    <span class="email-totals-label">Envío</span>
                    <span>
                        @if ($order->shipping_amount > 0)
                            €{{ number_format($order->shipping_amount, 2) }}
                        @else
                            Gratis
                        @endif
                    </span>
                </div>
                <div class="email-totals-row email-totals-final">
                    <span>Total</span>
                    <span>€{{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>

            @if ($order->address)
                <p class="email-section-title">Dirección de envío</p>
                <div class="email-address">
                    @if ($order->address->street)
                        <p>{{ $order->address->street }}</p>
                    @endif
                    @if ($order->address->zip_code || $order->address->city)
                        <p>{{ $order->address->zip_code }} {{ $order->address->city }}</p>
                    @endif
                    @if ($order->address->state)
                        <p>{{ $order->address->state }}</p>
                    @endif
                    @if ($order->address->country)
                        <p class="email-address-country">{{ $order->address->country }}</p>
                    @endif
                </div>
            @endif

            <div class="email-cta">
                <a href="{{ route('orders.show', $order->id) }}" class="email-cta-btn">
                    Ver mi pedido
                </a>
            </div>

        </div>

        <div class="email-footer">
            <p>© 2026 Fandrobe · Todos los derechos reservados.</p>
            <p>Hecho con arte · Verificado con confianza</p>
        </div>

    </div>
</body>

</html>
