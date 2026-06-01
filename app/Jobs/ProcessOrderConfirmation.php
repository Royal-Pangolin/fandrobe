<?php

namespace App\Jobs;

use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessOrderConfirmation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    public function handle(): void
    {
        try {
            $order = Order::with('user', 'items.product', 'status', 'address')->findOrFail($this->orderId);

            Log::info("Starting to process order confirmation for Order ID: {$this->orderId}");

            Mail::to($order->user->email)->send(new OrderConfirmationMail($order));

            Log::info("Order confirmation email sent for Order ID: {$this->orderId}");

        } catch (\Exception $e) {
            Log::error("Failed to process order confirmation for Order ID: {$this->orderId}", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }
}
