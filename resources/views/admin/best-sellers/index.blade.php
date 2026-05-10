@extends('layouts.app')
@section('title', __('messages.best_selling_products') . ' - Admin')

@section('content')
<div class="container-fluid px-4 px-lg-5 py-5">
    <div class="admin-container">

        <div class="d-flex align-items-end justify-content-between mb-5">
            <div>
                <a href="{{ route('admin.index') }}" class="text-decoration-none text-muted small fw-bold d-inline-flex align-items-center gap-1 mb-2">
                    &larr; {{ __('messages.panel') }}
                </a>
                <h1 class="fw-bolder mb-0">{{ __('messages.best_selling_products') }}</h1>
            </div>
        </div>

        <div class="admin-table-wrapper rounded-4 overflow-hidden">
            <table class="table mb-0 admin-table">
                <thead class="admin-thead">
                    <tr>
                        <th class="fw-bold px-4 py-3">#</th>
                        <th class="fw-bold py-3">{{ __('messages.name') }}</th>
                        <th class="fw-bold py-3">{{ __('messages.artist_label') }}</th>
                        <th class="fw-bold py-3 text-end pe-4">{{ __('messages.units_sold') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                        <tr class="admin-tr">
                            <td class="px-4 py-3 text-muted fw-bold">{{ $index + 1 }}</td>
                            <td class="py-3 fw-bold">
                                <a href="{{ route('admin.productos.edit', $product->id) }}"
                                   class="text-decoration-none text-dark">
                                    {{ $product->translated_name }}
                                </a>
                            </td>
                            <td class="py-3 text-muted">{{ $product->artist->name ?? '-' }}</td>
                            <td class="py-3 text-end pe-4">
                                <span class="badge rounded-pill fw-semibold px-3 py-2 badge-admin-status">
                                    {{ $product->units_sold ?? 0 }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">{{ __('messages.no_sales_data') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
