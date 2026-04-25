<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Muestra el carrito de compra.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $discount = session()->get('discount', null);

        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $discountAmount = 0;

        if ($discount) {
            // Descuento fijo o porcentaje según tipo
            if ($discount['type'] === 'percent') {
                $discountAmount = $subtotal * ($discount['value'] / 100);
            } else {
                $discountAmount = min($discount['value'], $subtotal);
            }
        }

        $total = max(0, $subtotal - $discountAmount);

        return view('cart.index', compact('cart', 'subtotal', 'discount', 'discountAmount', 'total'));
    }

    /**
     * Añade un producto al carrito.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1|max:99',
        ]);

        $product = Product::with('images')->findOrFail($request->product_id);
        $quantity = (int) $request->get('quantity', 1);
        $cart = session()->get('cart', []);
        $key = 'product_' . $product->id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $quantity;
        } else {
            $imgUrl = null;
            if ($product->images && $product->images->count() > 0) {
                $raw = $product->images->first()->url;
                $imgUrl = filter_var($raw, FILTER_VALIDATE_URL) ? $raw : asset('storage/' . $raw);
            }

            $cart[$key] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => (float) $product->base_price,
                'quantity' => $quantity,
                'image' => $imgUrl,
            ];
        }

        session()->put('cart', $cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'count' => collect(session('cart', []))->sum('quantity'),
                'message' => "«{$product->name}» añadido al carrito.",
            ]);
        }

        return redirect()->back()->with('cart_success', "«{$product->name}» añadido al carrito.");
    }

    /**
     * Actualiza la cantidad de un producto en el carrito.
     */
    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1|max:99']);

        $cart = session()->get('cart', []);
        $key = 'product_' . $id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] = (int) $request->quantity;
            session()->put('cart', $cart);
        }

        if ($request->wantsJson()) {
            $subtotal = collect(session('cart', []))->sum(fn($i) => $i['price'] * $i['quantity']);
            return response()->json(['success' => true, 'subtotal' => number_format($subtotal, 2)]);
        }

        return redirect()->route('cart.index');
    }

    /**
     * Elimina un producto del carrito.
     */
    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $key = 'product_' . $id;

        unset($cart[$key]);
        session()->put('cart', $cart);

        if ($request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('cart.index');
    }

    /**
     * Aplica un código de descuento.
     */
    public function applyDiscount(Request $request)
    {
        $request->validate(['code' => 'required|string']);

        // Códigos demo — en producción esto vendría de una tabla de cupones
        $codes = [
            'FANDROBE10' => ['type' => 'percent', 'value' => 10, 'label' => '10% de descuento'],
            'FANDROBE20' => ['type' => 'percent', 'value' => 20, 'label' => '20% de descuento'],
            'ARTE5' => ['type' => 'fixed', 'value' => 5, 'label' => '5€ de descuento'],
        ];

        $code = strtoupper(trim($request->code));

        if (isset($codes[$code])) {
            session()->put('discount', array_merge($codes[$code], ['code' => $code]));
            return redirect()->route('cart.index')->with('discount_success', 'Código aplicado: ' . $codes[$code]['label']);
        }

        session()->forget('discount');
        return redirect()->route('cart.index')->with('discount_error', 'Código de descuento inválido.');
    }
}
