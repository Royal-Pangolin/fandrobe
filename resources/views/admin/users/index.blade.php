@extends('layouts.app')
@section('title', __('messages.users') . ' — Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-12">
        <a href="{{ route('admin.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-muted hover:text-shadow transition-colors uppercase tracking-widest mb-4">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            {{ __('messages.panel') }}
        </a>
        <h1 class="text-4xl font-extrabold text-shadow tracking-tight">{{ __('messages.users') }}</h1>
    </div>

    <div class="bg-shadow/5 border border-shadow/5 rounded-3xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left whitespace-nowrap">
                <thead class="bg-shadow/5 border-b border-shadow/10">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest w-16">#</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.name') }}</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.email_label') }}</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.role') }}</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.status') }}</th>
                        <th class="px-6 py-4 text-xs font-bold text-muted uppercase tracking-widest">{{ __('messages.registered') }}</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-shadow/10">
                    @forelse($users as $user)
                        <tr class="hover:bg-shadow/5 transition-colors">
                            <td class="px-6 py-4 text-sm font-extrabold text-muted">
                                {{ $user->id }}
                            </td>
                            <td class="px-6 py-4 text-sm font-extrabold text-shadow">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </td>
                            <td class="px-6 py-4 text-sm text-muted font-medium">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-shadow/10 text-shadow">
                                    {{ $user->role->name ?? '—' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($user->is_active)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-verified/20 text-verified">
                                        {{ __('messages.active') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest bg-error/20 text-error">
                                        {{ __('messages.inactive') }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-muted">
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.usuarios.show', $user->id) }}" class="inline-flex items-center justify-center px-4 py-2 border-2 border-shadow/20 rounded-full text-sm font-bold text-shadow hover:bg-shadow/5 hover:border-shadow/40 transition-all">
                                    {{ __('messages.view') }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-muted font-medium">
                                {{ __('messages.no_users_registered') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($users->hasPages())
        <div class="mt-8">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection
