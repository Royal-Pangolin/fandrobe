@extends('layouts.app')
@section('title', __('messages.user') . ' — Admin')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-12">
        <a href="{{ route('admin.usuarios.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-muted hover:text-shadow transition-colors uppercase tracking-widest mb-4">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            {{ __('messages.users') }}
        </a>
        <h1 class="text-4xl font-extrabold text-shadow tracking-tight">{{ $user->first_name }} {{ $user->last_name }}</h1>
    </div>

    <div class="flex flex-col gap-6">

        <div class="bg-shadow/5 border border-shadow/5 p-8 rounded-3xl">
            <h2 class="text-xs font-bold text-muted uppercase tracking-widest mb-6">{{ __('messages.personal_info') }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div>
                    <p class="text-xs font-bold text-muted uppercase tracking-widest mb-1">{{ __('messages.name') }}</p>
                    <p class="font-extrabold text-shadow text-lg">{{ $user->first_name }} {{ $user->last_name }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-muted uppercase tracking-widest mb-1">{{ __('messages.email_label') }}</p>
                    <p class="font-extrabold text-shadow text-lg">{{ $user->email }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-muted uppercase tracking-widest mb-1">{{ __('messages.phone') }}</p>
                    <p class="font-extrabold text-shadow text-lg">{{ $user->phone ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-muted uppercase tracking-widest mb-1">{{ __('messages.registration_date') }}</p>
                    <p class="font-extrabold text-shadow text-lg">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-shadow/5 border border-shadow/5 p-8 rounded-3xl">
            <h2 class="text-xs font-bold text-muted uppercase tracking-widest mb-6">{{ __('messages.account') }}</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <div>
                    <p class="text-xs font-bold text-muted uppercase tracking-widest mb-3">{{ __('messages.role') }}</p>
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-shadow/10 text-shadow">
                        {{ $user->role->name ?? '—' }}
                    </span>
                </div>
                <div>
                    <p class="text-xs font-bold text-muted uppercase tracking-widest mb-3">{{ __('messages.status') }}</p>
                    @if($user->is_active)
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-verified/20 text-verified">
                            {{ __('messages.active') }}
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-error/20 text-error">
                            {{ __('messages.inactive') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
