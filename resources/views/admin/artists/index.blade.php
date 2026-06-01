@extends('layouts.app')
@section('title', __('messages.nav_artists') . ' — Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
        <div>
            <a href="{{ route('admin.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-muted hover:text-shadow transition-colors uppercase tracking-widest mb-4">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                {{ __('messages.panel') }}
            </a>
            <h1 class="text-4xl font-extrabold text-shadow tracking-tight">{{ __('messages.nav_artists') }}</h1>
        </div>
        <a href="{{ route('admin.artistas.create') }}" class="btn-primary py-2 px-6 shadow-sm">
            {{ __('messages.new_artist') }}
        </a>
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
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.name') }}</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.genre') }}</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.products') }}</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.status') }}</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-shadow/10">
                    @forelse($artists as $artist)
                        <tr class="hover:bg-shadow/5 transition-colors">
                            <td class="px-6 py-4 text-sm font-extrabold text-muted">
                                {{ $artist->id }}
                            </td>
                            <td class="px-6 py-4 text-sm font-extrabold text-shadow">
                                {{ $artist->name }}
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-muted">
                                {{ $artist->genre->name ?? '—' }}
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-muted">
                                {{ $artist->products_count }}
                            </td>
                            <td class="px-6 py-4">
                                @if($artist->is_active)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-verified/20 text-verified">
                                        {{ __('messages.active') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-error/20 text-error">
                                        {{ __('messages.inactive') }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right flex items-center justify-end gap-2">
                                <a href="{{ route('admin.artistas.edit', $artist->id) }}" class="inline-flex items-center justify-center px-4 py-2 border-2 border-shadow/20 rounded-full text-sm font-bold text-shadow hover:bg-shadow/5 hover:border-shadow/40 transition-all">
                                    {{ __('messages.edit') }}
                                </a>
                                <form action="{{ route('admin.artistas.destroy', $artist->id) }}" method="POST"
                                      onsubmit="return confirm('{{ __('messages.confirm_delete_artist') }}')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border-2 border-error/20 rounded-full text-sm font-bold text-error hover:bg-error/10 hover:border-error/40 transition-all">
                                        {{ __('messages.delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-muted font-medium">
                                {{ __('messages.no_artists_registered') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($artists->hasPages())
        <div class="mt-8">
            {{ $artists->links() }}
        </div>
    @endif
</div>
@endsection
