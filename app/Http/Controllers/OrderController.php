<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\ShoppingCart;
use App\Models\Discount;
use App\Models\Payment;

class OrderController extends Controller
{
    // Ver todos los pedidos del usuario
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
                       ->with('status')
                       ->orderBy('placed_at', 'desc')
                       ->get();

        return view('orders.index', compact('orders'));
    }

    // Ver detalle de un pedido
    public function show($id)
    {
        $order = Order::where('user_id', auth()->id())
                      ->with('items.product', 'items.variant', 'status', 'address')
                      ->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    // Confirmar el pedido — convierte el carrito en pedido
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // 1. Coger el carrito activo
            $cart = ShoppingCart::where('user_id', auth()->id())
                                ->where('status', 'active')
                                ->with('items.product')
                                ->first();

            if (!$cart || $cart->items->isEmpty()) {
                return redirect()->route('cart.index')
                                 ->with('error', 'Tu carrito está vacío.');
            }

            // 2. Calcular subtotal
            $subtotal = $cart->items->sum(
                fn($item) => $item->product->base_price * $item->quantity
            );

            // 3. Aplicar descuento si existe en sesión
            $discountAmount = 0;
            $discountId = null;

            if (session('discount')) {
                $discount = Discount::find(session('discount'));
                if ($discount) {
                    $discountId = $discount->id;
                    if ($discount->discountType->name === 'percent') {
                        $discountAmount = $subtotal * ($discount->discount_value / 100);
                    } else {
                        $discountAmount = min($discount->discount_value, $subtotal);
                    }
                    // Incrementar el contador de usos
                    $discount->increment('used_count');
                }
            }

            // 4. Coger el estado inicial (pending)
            $status = OrderStatus::where('name', 'pending')->first();

            // 5. Crear el pedido
            $shippingAmount = 4.99;
            $total = max(0, $subtotal - $discountAmount) + $shippingAmount;

            $order = Order::create([
                'user_id'         => auth()->id(),
                'status_id'       => $status->id,
                'discount_id'     => $discountId,
                'currency'        => 'EUR',
                'subtotal'        => $subtotal,
                'discount_amount' => $discountAmount,
                'shipping_amount' => $shippingAmount,
                'total_amount'    => $total,
                'placed_at'       => now(),
            ]);

            // 6. Copiar los items del carrito al pedido
            foreach ($cart->items as $item) {
                $unitPrice  = $item->product->base_price;
                $totalPrice = $unitPrice * $item->quantity;

                OrderItem::create([
                    'order_id'    => $order->id,
                    'product_id'  => $item->product_id,
                    'variant_id'  => $item->variant_id,
                    'quantity'    => $item->quantity,
                    'unit_price'  => $unitPrice,
                    'total_price' => $totalPrice,
                ]);
            }

            // 7. Vaciar el carrito
            $cart->items()->delete();
            $cart->update(['status' => 'completed']);

            // 8. Limpiar el cupón de la sesión
            session()->forget('discount');

            DB::commit();

            return redirect()->route('orders.show', $order->id)
                             ->with('mensaje', '¡Pedido realizado correctamente!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.index')
                             ->with('error', 'Error al procesar el pedido. Inténtalo de nuevo.');
        }
    }
}
