@extends('layouts.app')
@section('title', __('messages.admin_panel'))

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="mb-12">
            <h1 class="text-4xl font-extrabold text-shadow mb-2 tracking-tight">{{ __('messages.admin_panel') }}</h1>
            <p class="text-muted font-medium">{{ __('messages.admin_welcome') }} {{ auth()->user()->first_name }}</p>
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

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            <!-- Pending Orders -->
            <div class="bg-shadow/5 border border-shadow/5 p-6 rounded-3xl flex flex-col justify-between">
                <div>
                    <p class="text-xs font-bold text-muted uppercase tracking-widest mb-4">{{ __('messages.pending_orders') }}</p>
                    <p class="text-5xl font-extrabold text-shadow mb-6">{{ $pendingOrders }}</p>
                </div>
                <a href="{{ route('admin.pedidos.index') }}" class="text-sm font-bold text-accent hover:text-shadow transition-colors inline-flex items-center gap-1">
                    {{ __('messages.view_orders') }}
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <!-- Total Orders -->
            <div class="bg-shadow/5 border border-shadow/5 p-6 rounded-3xl flex flex-col justify-between">
                <div>
                    <p class="text-xs font-bold text-muted uppercase tracking-widest mb-4">{{ __('messages.total_orders') }}</p>
                    <p class="text-5xl font-extrabold text-shadow mb-6">{{ $totalOrders }}</p>
                </div>
                <a href="{{ route('admin.pedidos.index') }}" class="text-sm font-bold text-accent hover:text-shadow transition-colors inline-flex items-center gap-1">
                    {{ __('messages.manage') }}
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <!-- Active Products -->
            <div class="bg-shadow/5 border border-shadow/5 p-6 rounded-3xl flex flex-col justify-between">
                <div>
                    <p class="text-xs font-bold text-muted uppercase tracking-widest mb-4">{{ __('messages.active_products') }}</p>
                    <p class="text-5xl font-extrabold text-shadow mb-6">
                        {{ $activeProducts }}
                        @if($activeProducts < $totalProducts)
                            <span class="text-2xl text-muted font-medium">/ {{ $totalProducts }}</span>
                        @endif
                    </p>
                </div>
                <a href="{{ route('admin.productos.index') }}" class="text-sm font-bold text-accent hover:text-shadow transition-colors inline-flex items-center gap-1">
                    {{ __('messages.manage') }}
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <!-- Registered Users -->
            <div class="bg-shadow/5 border border-shadow/5 p-6 rounded-3xl flex flex-col justify-between">
                <div>
                    <p class="text-xs font-bold text-muted uppercase tracking-widest mb-4">{{ __('messages.registered_users') }}</p>
                    <p class="text-5xl font-extrabold text-shadow mb-6">{{ $totalUsers }}</p>
                </div>
                <a href="{{ route('admin.usuarios.index') }}" class="text-sm font-bold text-accent hover:text-shadow transition-colors inline-flex items-center gap-1">
                    {{ __('messages.view_users') }}
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        <h2 class="text-2xl font-extrabold text-shadow mb-6 tracking-tight">{{ __('messages.quick_links') }}</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.pedidos.index') }}"
                class="bg-shadow/5 hover:bg-shadow text-shadow hover:text-primary p-6 rounded-2xl font-bold transition-all duration-300 shadow-sm hover:shadow-md flex items-center justify-between group">
                {{ __('messages.orders') }}
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" class="opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            
            <a href="{{ route('admin.productos.index') }}"
                class="bg-shadow/5 hover:bg-shadow text-shadow hover:text-primary p-6 rounded-2xl font-bold transition-all duration-300 shadow-sm hover:shadow-md flex items-center justify-between group">
                {{ __('messages.products') }}
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" class="opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            
            <a href="{{ route('admin.artistas.index') }}"
                class="bg-shadow/5 hover:bg-shadow text-shadow hover:text-primary p-6 rounded-2xl font-bold transition-all duration-300 shadow-sm hover:shadow-md flex items-center justify-between group">
                {{ __('messages.nav_artists') }}
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" class="opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            
            <a href="{{ route('admin.usuarios.index') }}"
                class="bg-shadow/5 hover:bg-shadow text-shadow hover:text-primary p-6 rounded-2xl font-bold transition-all duration-300 shadow-sm hover:shadow-md flex items-center justify-between group">
                {{ __('messages.users') }}
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" class="opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            
            <a href="{{ route('admin.favoritos') }}"
                class="bg-shadow/5 hover:bg-shadow text-shadow hover:text-primary p-6 rounded-2xl font-bold transition-all duration-300 shadow-sm hover:shadow-md flex items-center justify-between group">
                {{ __('messages.favorite_products') }}
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" class="opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            
            <a href="{{ route('admin.mas-vendidos') }}"
                class="bg-shadow/5 hover:bg-shadow text-shadow hover:text-primary p-6 rounded-2xl font-bold transition-all duration-300 shadow-sm hover:shadow-md flex items-center justify-between group">
                {{ __('messages.best_selling_products') }}
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" class="opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
            
            <a href="{{ route('admin.categorias.index') }}"
               class="bg-shadow/5 hover:bg-shadow text-shadow hover:text-primary p-6 rounded-2xl font-bold transition-all duration-300 shadow-sm hover:shadow-md flex items-center justify-between group">
                {{ __('messages.admin_categories') }}
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" class="opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

    </div>
@endsection
