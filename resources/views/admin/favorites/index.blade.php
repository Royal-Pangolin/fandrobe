@extends('layouts.app')
@section('title', __('messages.favorite_products') . ' — Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-12">
        <a href="{{ route('admin.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-muted hover:text-shadow transition-colors uppercase tracking-widest mb-4">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            {{ __('messages.panel') }}
        </a>
        <h1 class="text-4xl font-extrabold text-shadow tracking-tight">{{ __('messages.favorite_products') }}</h1>
    </div>

    <div class="bg-shadow/5 border border-shadow/5 rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="bg-shadow/5 border-b border-shadow/10">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest w-16">#</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.name') }}</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.artist_label') }}</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest text-right">{{ __('messages.favorites') }}</th>
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
                                {{ $product->artist->name ?? '—' }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold bg-shadow/10 text-shadow">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24" class="text-error mr-2"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                    {{ $product->favorites_count }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-muted font-medium">
                                {{ __('messages.no_favorites_yet') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
