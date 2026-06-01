@extends('layouts.app')
@section('title', __('messages.order') . ' #' . $order->id . ' — Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-12">
        <a href="{{ route('admin.pedidos.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-muted hover:text-shadow transition-colors uppercase tracking-widest mb-4">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            {{ __('messages.orders') }}
        </a>
        <h1 class="text-4xl font-extrabold text-shadow tracking-tight">{{ __('messages.order') }} #{{ $order->id }}</h1>
    </div>

    @if(session('mensaje'))
        <div class="bg-verified/20 border border-verified text-verified px-6 py-4 rounded-2xl mb-8 font-bold shadow-sm">
            {{ session('mensaje') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-error/20 border border-error text-error px-6 py-4 rounded-2xl mb-8 font-bold shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Order Items and Totals -->
        <div class="lg:col-span-7">
            <h2 class="text-xs font-bold text-muted uppercase tracking-widest mb-6">{{ __('messages.items_label') }}</h2>
            
            <div class="space-y-4 mb-8">
                @foreach($order->items as $item)
                    <div class="bg-shadow/5 border border-shadow/5 rounded-2xl p-4 flex justify-between items-center">
                        <div>
                            <p class="font-extrabold text-shadow">{{ $item->product->translated_name ?? '—' }}</p>
                            @if($item->variant)
                                <p class="text-xs font-bold text-muted uppercase tracking-widest mt-1">
                                    @if($item->variant->size){{ $item->variant->size->name }}@endif
                                    @if($item->variant->size && $item->variant->color) · @endif
                                    @if($item->variant->color){{ $item->variant->color->name }}@endif
                                </p>
                            @endif
                            <p class="text-sm font-medium text-muted mt-1">Cantidad: {{ $item->quantity }}</p>
                        </div>
                        <span class="font-extrabold text-shadow text-lg">€{{ number_format($item->total_price, 2) }}</span>
                    </div>
                @endforeach
            </div>

            <div class="bg-shadow/5 border border-shadow/5 p-6 rounded-3xl space-y-4">
                <div class="flex justify-between items-center text-sm font-bold text-muted uppercase tracking-widest">
                    <span>{{ __('messages.subtotal') }}</span>
                    <span class="text-shadow">€{{ number_format($order->subtotal, 2) }}</span>
                </div>
                @if($order->discount_amount > 0)
                    <div class="flex justify-between items-center text-sm font-bold uppercase tracking-widest">
                        <span class="text-muted">{{ __('messages.discount') }}</span>
                        <span class="text-error">−€{{ number_format($order->discount_amount, 2) }}</span>
                    </div>
                @endif
                <div class="flex justify-between items-center text-sm font-bold text-muted uppercase tracking-widest">
                    <span>{{ __('messages.shipping') }}</span>
                    <span class="text-shadow">€{{ number_format($order->shipping_amount, 2) }}</span>
                </div>
                
                <div class="pt-4 mt-4 border-t border-shadow/10 flex justify-between items-end">
                    <span class="text-2xl font-extrabold text-shadow">{{ __('messages.total') }}</span>
                    <span class="text-3xl font-extrabold text-shadow">€{{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Sidebar Details -->
        <div class="lg:col-span-5">
            <div class="bg-shadow/5 border border-shadow/5 p-8 rounded-3xl sticky top-24">
                <div class="mb-8">
                    <h2 class="text-xs font-bold text-muted uppercase tracking-widest mb-3">{{ __('messages.customer') }}</h2>
                    <p class="font-extrabold text-shadow text-lg">{{ $order->user->first_name }} {{ $order->user->last_name }}</p>
                    <p class="text-sm text-muted font-medium">{{ $order->user->email }}</p>
                </div>

                <div class="mb-8">
                    <h2 class="text-xs font-bold text-muted uppercase tracking-widest mb-3">{{ __('messages.date') }}</h2>
                    <p class="font-extrabold text-shadow">{{ \Carbon\Carbon::parse($order->placed_at)->format('d/m/Y H:i') }}</p>
                </div>

                <div class="mb-8">
                    <h2 class="text-xs font-bold text-muted uppercase tracking-widest mb-3">{{ __('messages.status') }}</h2>
                    <div>
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest bg-shadow/10 text-shadow">
                            {{ $order->status->name ?? '—' }}
                        </span>
                    </div>
                </div>

                <div>
                    <h2 class="text-xs font-bold text-muted uppercase tracking-widest mb-4">{{ __('messages.update_status') }}</h2>
                    <form action="{{ route('admin.pedidos.update', $order->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <select name="status_id" class="appearance-none w-full bg-primary border border-shadow/20 text-shadow text-sm rounded-xl focus:ring-2 focus:ring-accent focus:border-accent block p-3 font-bold">
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{ $order->status_id === $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="w-full bg-shadow text-primary px-6 py-3 rounded-full font-bold transition-all hover:bg-shadow/90 hover:scale-105">
                            {{ __('messages.update_status') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
