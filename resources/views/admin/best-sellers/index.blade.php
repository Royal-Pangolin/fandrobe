@extends('layouts.app')
@section('title', __('messages.best_selling_products') . ' - Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-12">
        <a href="{{ route('admin.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-muted hover:text-shadow transition-colors uppercase tracking-widest mb-4">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            {{ __('messages.panel') }}
        </a>
        <h1 class="text-4xl font-extrabold text-shadow tracking-tight">{{ __('messages.best_selling_products') }}</h1>
    </div>

    <div class="bg-shadow/5 border border-shadow/5 rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="bg-shadow/5 border-b border-shadow/10">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest w-16">#</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.name') }}</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.artist_label') }}</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest text-right">{{ __('messages.units_sold') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-shadow/10">
                    @forelse($products as $index => $product)
                        <tr class="hover:bg-shadow/5 transition-colors">
                            <td class="px-6 py-4 text-sm font-extrabold text-muted">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 text-sm font-extrabold text-shadow">
                                <a href="{{ route('admin.productos.edit', $product->id) }}" class="hover:text-accent transition-colors">
                                    {{ $product->translated_name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-muted">
                                {{ $product->artist->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold bg-verified/20 text-verified">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" class="mr-2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                                    {{ $product->units_sold ?? 0 }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-muted font-medium">
                                {{ __('messages.no_sales_data') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
