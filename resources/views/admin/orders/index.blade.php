@extends('layouts.app')
@section('title', __('messages.orders') . ' — Admin')

@section('content')
<div class="container-fluid px-4 px-lg-5 py-5">
    <div class="admin-container">

        <div class="d-flex align-items-end justify-content-between mb-5">
            <div>
                <a href="{{ route('admin.index') }}" class="text-decoration-none text-muted small fw-bold d-inline-flex align-items-center gap-1 mb-2">
                    ← {{ __('messages.panel') }}
                </a>
                <h1 class="fw-bolder mb-0">{{ __('messages.orders') }}</h1>
            </div>
        </div>

        @if(session('mensaje'))
            <div class="alert alert-admin-success rounded-3 mb-4">{{ session('mensaje') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-admin-error rounded-3 mb-4">{{ session('error') }}</div>
        @endif

        <div class="admin-table-wrapper rounded-4 overflow-hidden">
            <table class="table mb-0 admin-table">
                <thead class="admin-thead">
                    <tr>
                        <th class="fw-bold px-4 py-3">#</th>
                        <th class="fw-bold py-3">{{ __('messages.customer') }}</th>
                        <th class="fw-bold py-3">{{ __('messages.total') }}</th>
                        <th class="fw-bold py-3">{{ __('messages.status') }}</th>
                        <th class="fw-bold py-3">{{ __('messages.date') }}</th>
                        <th class="fw-bold py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="admin-tr">
                            <td class="px-4 py-3 fw-bold text-muted">{{ $order->id }}</td>
                            <td class="py-3">
                                {{ $order->user->first_name }} {{ $order->user->last_name }}
                                <span class="d-block text-muted admin-email-small">{{ $order->user->email }}</span>
                            </td>
                            <td class="py-3 fw-bold">€{{ number_format($order->total_amount, 2) }}</td>
                            <td class="py-3">
                                <span class="badge rounded-pill fw-semibold px-3 py-2 badge-admin-status">
                                    {{ $order->status->name ?? '—' }}
                                </span>
                            </td>
                            <td class="py-3 text-muted">{{ \Carbon\Carbon::parse($order->placed_at)->format('d/m/Y') }}</td>
                            <td class="py-3">
                                <a href="{{ route('admin.pedidos.show', $order->id) }}"
                                   class="btn btn-sm fw-bold px-3 btn-admin-ghost">
                                    {{ __('messages.view') }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">{{ __('messages.no_orders_registered') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $orders->links() }}</div>

    </div>
</div>
@endsection
