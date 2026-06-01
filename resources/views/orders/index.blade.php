@extends('layouts.app')
@section('title', __('messages.my_orders'))

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <nav aria-label="breadcrumb" class="mb-8">
        <ol class="flex items-center space-x-2 text-sm font-bold text-muted">
            <li>
                <a href="{{ route('home') }}" class="hover:text-accent transition-colors">{{ __('messages.breadcrumb_home') }}</a>
            </li>
            <li>
                <span class="mx-2">/</span>
            </li>
            <li class="text-shadow" aria-current="page">{{ __('messages.my_orders') }}</li>
        </ol>
    </nav>

    <div class="flex items-end justify-between mb-10 border-b border-shadow/10 pb-6">
        <h1 class="text-4xl font-extrabold text-shadow tracking-tight">{{ __('messages.my_orders') }}</h1>
        @if($orders->count())
            <span class="text-xs font-bold text-muted uppercase tracking-widest">
                {{ $orders->count() }} {{ __('messages.orders_count') }}
            </span>
        @endif
    </div>

    @if(session('mensaje'))
        <div class="bg-verified/20 border border-verified text-verified px-4 py-3 rounded-xl mb-8 font-bold text-sm flex items-center gap-3">
            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            {{ session('mensaje') }}
        </div>
    @endif

    @if($orders->count())
        <div class="space-y-6">
            @foreach($orders as $order)
                @php
                    $statusClass = match(strtolower($order->status->name ?? '')) {
                        'enviado', 'shipped',
                        'entregado', 'delivered',
                        'completado', 'completed' => 'bg-verified/20 text-verified',
                        'cancelado', 'cancelled'  => 'bg-error/20 text-error',
                        default                   => 'bg-accent/20 text-accent',
                    };
                @endphp
                <div class="bg-shadow/5 border border-shadow/5 rounded-3xl p-6 flex flex-col md:flex-row md:items-center justify-between gap-6 hover:shadow-md transition-shadow">

                    <div class="flex flex-col sm:flex-row sm:items-center gap-6 sm:gap-12">
                        <div>
                            <p class="text-xs font-bold text-muted uppercase tracking-widest mb-1">{{ __('messages.order') }}</p>
                            <span class="text-xl font-extrabold text-shadow">
                                #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-muted uppercase tracking-widest mb-1">{{ __('messages.date') }}</p>
                            <span class="font-bold text-shadow">
                                {{ \Carbon\Carbon::parse($order->placed_at)->format('d M Y') }}
                            </span>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-muted uppercase tracking-widest mb-1">{{ __('messages.status') }}</p>
                            <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $statusClass }}">
                                {{ $order->status->name }}
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between md:justify-end gap-6 sm:gap-12 md:pl-6 md:border-l border-shadow/10">
                        <div class="text-left md:text-right">
                            <p class="text-xs font-bold text-muted uppercase tracking-widest mb-1">{{ __('messages.total') }}</p>
                            <span class="text-2xl font-extrabold text-shadow">
                                €{{ number_format($order->total_amount, 2) }}
                            </span>
                        </div>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn-primary py-2 px-6 text-sm">
                            {{ __('messages.view_detail') }}
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-24 bg-shadow/5 rounded-3xl border border-shadow/5 mt-8">
            <svg width="80" height="80" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 class="mx-auto mb-6 opacity-20 text-shadow">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <h4 class="text-2xl font-extrabold text-shadow mb-3">{{ __('messages.no_orders') }}</h4>
            <p class="text-muted font-medium mb-8 max-w-md mx-auto">{{ __('messages.no_orders_desc') }}</p>
            <a href="{{ route('products.index') }}" class="btn-primary inline-block">
                {{ __('messages.explore_collection') }}
            </a>
        </div>
    @endif

</div>
@endsection
