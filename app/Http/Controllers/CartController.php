<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use App\Models\CartItem;

class CartController extends Controller
{
    // Ver el carrito
    public function index()
    {
        $cart = ShoppingCart::where('user_id', auth()->id())
            ->where('status', 'active')
            ->first();

        $items = $cart ? $cart->items()->with(['product.images', 'variant.size', 'variant.color'])->get() : collect();

        return view('cart.index', compact('cart', 'items'));
    }

    // Añadir producto al carrito
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'variant_id' => ['nullable', 'integer', 'exists:product_variants,id'],
            'quantity'   => ['nullable', 'integer', 'min:1'],
        ]);

        $cart = ShoppingCart::firstOrCreate(
            ['user_id' => auth()->id(), 'status' => 'active']
        );

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->where('variant_id', $request->variant_id)
            ->first();

        if ($item) {
            $item->quantity += $request->quantity ?? 1;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
                'quantity' => $request->quantity ?? 1,
            ]);
        }

        return redirect()->route('cart.index')->with('mensaje', 'Producto añadido al carrito');
    }

    // Actualizar cantidad
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $item = CartItem::findOrFail($id);
        $item->quantity = $request->quantity;
        $item->save();

        return redirect()->route('cart.index')->with('mensaje', 'Cantidad actualizada');
    }

    // Eliminar item
    public function remove($id)
    {
        $item = CartItem::findOrFail($id);
        $item->delete();

        return redirect()->route('cart.index')->with('mensaje', 'Producto eliminado');
    }
}
