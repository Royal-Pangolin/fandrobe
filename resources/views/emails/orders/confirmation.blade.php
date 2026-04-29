<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de pedido</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f5f0e8; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f5f0e8; padding: 40px 0;">
    <tr>
        <td align="center">
            <table role="presentation" width="600" cellspacing="0" cellpadding="0" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.06);">

                {{-- HEADER --}}
                <tr>
                    <td style="background-color: #1a1a1a; padding: 32px 40px; text-align: center;">
                        <h1 style="color: #f7f1e7; font-size: 22px; font-weight: 800; margin: 0; letter-spacing: -0.03em;">
                            FANDROBE
                        </h1>
                    </td>
                </tr>

                {{-- CONFIRMATION ICON --}}
                <tr>
                    <td style="padding: 40px 40px 24px; text-align: center;">
                        <div style="width: 64px; height: 64px; border-radius: 50%; background-color: rgba(110,117,86,0.12); display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                            <span style="font-size: 28px;">✓</span>
                        </div>
                        <h2 style="color: #1a1a1a; font-size: 24px; font-weight: 800; margin: 0 0 8px; letter-spacing: -0.02em;">
                            ¡Pedido confirmado!
                        </h2>
                        <p style="color: #888; font-size: 14px; margin: 0;">
                            Hola {{ $order->user->first_name }}, hemos recibido tu pedido correctamente.
                        </p>
                    </td>
                </tr>

                {{-- ORDER INFO --}}
                <tr>
                    <td style="padding: 0 40px 24px;">
                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #faf7f2; border-radius: 12px; padding: 20px;">
                            <tr>
                                <td style="padding: 16px 20px;">
                                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="color: #888; font-size: 12px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.06em;">
                                                Nº de pedido
                                            </td>
                                            <td align="right" style="color: #1a1a1a; font-size: 14px; font-weight: 700;">
                                                #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding: 8px 0;">
                                                <hr style="border: none; border-top: 1px solid #eee; margin: 0;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="color: #888; font-size: 12px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.06em;">
                                                Fecha
                                            </td>
                                            <td align="right" style="color: #1a1a1a; font-size: 14px; font-weight: 600;">
                                                {{ \Carbon\Carbon::parse($order->placed_at)->format('d/m/Y H:i') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding: 8px 0;">
                                                <hr style="border: none; border-top: 1px solid #eee; margin: 0;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="color: #888; font-size: 12px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.06em;">
                                                Estado
                                            </td>
                                            <td align="right" style="color: #6e7556; font-size: 14px; font-weight: 700;">
                                                {{ ucfirst($order->status->name ?? 'Pendiente') }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- ITEMS --}}
                <tr>
                    <td style="padding: 0 40px 24px;">
                        <h3 style="color: #1a1a1a; font-size: 14px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.06em; margin: 0 0 16px;">
                            Artículos
                        </h3>
                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                            @foreach($order->items as $item)
                                <tr>
                                    <td style="padding: 12px 0; border-bottom: 1px solid #f0ece4;">
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="color: #1a1a1a; font-size: 14px; font-weight: 600;">
                                                    {{ $item->product->name ?? 'Producto' }}
                                                </td>
                                                <td align="right" style="color: #1a1a1a; font-size: 14px; font-weight: 700; white-space: nowrap;">
                                                    €{{ number_format($item->total_price, 2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" style="color: #999; font-size: 12px; padding-top: 4px;">
                                                    {{ $item->quantity }} × €{{ number_format($item->unit_price, 2) }}
                                                    @if($item->variant)
                                                        · SKU: {{ $item->variant->sku }}
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>

                {{-- TOTALS --}}
                <tr>
                    <td style="padding: 0 40px 32px;">
                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #faf7f2; border-radius: 12px;">
                            <tr>
                                <td style="padding: 20px;">
                                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="color: #888; font-size: 13px; padding-bottom: 8px;">Subtotal</td>
                                            <td align="right" style="color: #1a1a1a; font-size: 13px; font-weight: 600; padding-bottom: 8px;">
                                                €{{ number_format($order->subtotal, 2) }}
                                            </td>
                                        </tr>
                                        @if($order->discount_amount > 0)
                                            <tr>
                                                <td style="color: #888; font-size: 13px; padding-bottom: 8px;">Descuento</td>
                                                <td align="right" style="color: #6e7556; font-size: 13px; font-weight: 600; padding-bottom: 8px;">
                                                    −€{{ number_format($order->discount_amount, 2) }}
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td style="color: #888; font-size: 13px; padding-bottom: 12px;">Envío</td>
                                            <td align="right" style="color: #1a1a1a; font-size: 13px; font-weight: 600; padding-bottom: 12px;">
                                                @if($order->shipping_amount > 0)
                                                    €{{ number_format($order->shipping_amount, 2) }}
                                                @else
                                                    Gratis
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding-bottom: 12px;">
                                                <hr style="border: none; border-top: 2px solid #e8e3da; margin: 0;">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="color: #1a1a1a; font-size: 18px; font-weight: 800;">Total</td>
                                            <td align="right" style="color: #1a1a1a; font-size: 18px; font-weight: 800;">
                                                €{{ number_format($order->total_amount, 2) }}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- CTA --}}
                <tr>
                    <td style="padding: 0 40px 40px; text-align: center;">
                        <a href="{{ route('orders.show', $order->id) }}"
                           style="display: inline-block; background-color: #1a1a1a; color: #f7f1e7; text-decoration: none; padding: 14px 32px; border-radius: 50px; font-weight: 700; font-size: 14px;">
                            Ver mi pedido
                        </a>
                    </td>
                </tr>

                {{-- FOOTER --}}
                <tr>
                    <td style="background-color: #faf7f2; padding: 24px 40px; text-align: center; border-top: 1px solid #ece7dd;">
                        <p style="color: #aaa; font-size: 12px; margin: 0 0 4px;">
                            {{ config('app.name', 'Fandrobe') }} — Moda y arte, sin límites.
                        </p>
                        <p style="color: #ccc; font-size: 11px; margin: 0;">
                            Este email fue enviado a {{ $order->user->email }}
                        </p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>
