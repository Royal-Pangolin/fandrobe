@extends('layouts.app')
@section('title', __('messages.orders') . ' — Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-12">
        <a href="{{ route('admin.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-muted hover:text-shadow transition-colors uppercase tracking-widest mb-4">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            {{ __('messages.panel') }}
        </a>
        <h1 class="text-4xl font-extrabold text-shadow tracking-tight">{{ __('messages.orders') }}</h1>
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

    <div class="bg-shadow/5 border border-shadow/5 rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="bg-shadow/5 border-b border-shadow/10">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest w-16">#</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.customer') }}</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.total') }}</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.status') }}</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.date') }}</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-shadow/10">
                    @forelse($orders as $order)
                        <tr class="hover:bg-shadow/5 transition-colors">
                            <td class="px-6 py-4 text-sm font-extrabold text-muted">
                                {{ $order->id }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-extrabold text-shadow">{{ $order->user->first_name }} {{ $order->user->last_name }}</p>
                                <p class="text-xs text-muted">{{ $order->user->email }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm font-extrabold text-shadow">
                                €{{ number_format($order->total_amount, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-shadow/10 text-shadow">
                                    {{ $order->status->name ?? '—' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-muted">
                                {{ \Carbon\Carbon::parse($order->placed_at)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.pedidos.show', $order->id) }}" class="inline-flex items-center justify-center px-4 py-2 border-2 border-shadow/20 rounded-full text-sm font-bold text-shadow hover:bg-shadow/5 hover:border-shadow/40 transition-all">
                                    {{ __('messages.view') }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-muted font-medium">
                                {{ __('messages.no_orders_registered') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($orders->hasPages())
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
