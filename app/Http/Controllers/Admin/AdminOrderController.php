<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'status')
                       ->orderBy('placed_at', 'desc')
                       ->paginate(20);

        $statuses = OrderStatus::all();

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    public function show($id)
    {
        $order = Order::with('user', 'status', 'items.product', 'items.variant')
                      ->findOrFail($id);

        $statuses = OrderStatus::all();

        return view('admin.orders.show', compact('order', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status_id' => ['required', 'integer', 'exists:order_statuses,id'],
        ]);

        try {
            DB::beginTransaction();

            $order = Order::findOrFail($id);
            $order->update(['status_id' => $request->status_id]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al actualizar el estado del pedido.');
        }

        return back()->with('mensaje', 'Estado del pedido actualizado.');
    }
}
