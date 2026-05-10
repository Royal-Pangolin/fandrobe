@extends('layouts.app')
@section('title', __('messages.admin_panel'))

@section('content')
    <div class="container-fluid px-4 px-lg-5 py-5">
        <div class="admin-container">

            <div class="d-flex align-items-end justify-content-between mb-5">
                <div>
                    <h1 class="fw-bolder mb-1">{{ __('messages.admin_panel') }}</h1>
                    <p class="text-muted mb-0">{{ __('messages.admin_welcome') }} {{ auth()->user()->first_name }}</p>
                </div>
            </div>

            @if(session('mensaje'))
                <div class="alert alert-admin-success rounded-3 mb-4">{{ session('mensaje') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-admin-error rounded-3 mb-4">{{ session('error') }}</div>
            @endif

            {{-- Stats --}}
            <div class="row g-4 mb-5">
                <div class="col-sm-6 col-lg-3">
                    <div class="admin-card p-4 rounded-4 h-100">
                        <p class="text-muted small fw-bold text-uppercase admin-form-label mb-2">{{ __('messages.pending_orders') }}</p>
                        <p class="fw-bolder admin-stat-number mb-3">{{ $pendingOrders }}</p>
                        <a href="{{ route('admin.pedidos.index') }}"
                            class="text-decoration-none fw-bold small text-verified">{{ __('messages.view_orders') }}</a>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="admin-card p-4 rounded-4 h-100">
                        <p class="text-muted small fw-bold text-uppercase admin-form-label mb-2">{{ __('messages.total_orders') }}</p>
                        <p class="fw-bolder admin-stat-number mb-3">{{ $totalOrders }}</p>
                        <a href="{{ route('admin.pedidos.index') }}"
                            class="text-decoration-none fw-bold small text-verified">{{ __('messages.manage') }}</a>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="admin-card p-4 rounded-4 h-100">
                        <p class="text-muted small fw-bold text-uppercase admin-form-label mb-2">{{ __('messages.active_products') }}</p>
                        <p class="fw-bolder admin-stat-number mb-3">
                            {{ $activeProducts }}
                            @if($activeProducts < $totalProducts)
                                <span class="text-muted fs-6 fw-normal"> / {{ $totalProducts }}</span>
                            @endif
                        </p>
                        <a href="{{ route('admin.productos.index') }}"
                            class="text-decoration-none fw-bold small text-verified">{{ __('messages.manage') }}</a>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="admin-card p-4 rounded-4 h-100">
                        <p class="text-muted small fw-bold text-uppercase admin-form-label mb-2">{{ __('messages.registered_users') }}</p>
                        <p class="fw-bolder admin-stat-number mb-3">{{ $totalUsers }}</p>
                        <a href="{{ route('admin.usuarios.index') }}"
                            class="text-decoration-none fw-bold small text-verified">{{ __('messages.view_users') }}</a>
                    </div>
                </div>
            </div>

            {{-- Quick links --}}
            <h2 class="fw-bolder mb-4 admin-section-title">{{ __('messages.quick_links') }}</h2>
            <div class="row g-3">
                <div class="col-md-3">
                    <a href="{{ route('admin.pedidos.index') }}"
                        class="d-block p-4 rounded-3 text-decoration-none text-dark fw-bold admin-quick-link">
                        {{ __('messages.orders') }}
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.productos.index') }}"
                        class="d-block p-4 rounded-3 text-decoration-none text-dark fw-bold admin-quick-link">
                        {{ __('messages.products') }}
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.artistas.index') }}"
                        class="d-block p-4 rounded-3 text-decoration-none text-dark fw-bold admin-quick-link">
                        {{ __('messages.nav_artists') }}
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.usuarios.index') }}"
                        class="d-block p-4 rounded-3 text-decoration-none text-dark fw-bold admin-quick-link">
                        {{ __('messages.users') }}
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.favoritos') }}"
                        class="d-block p-4 rounded-3 text-decoration-none text-dark fw-bold admin-quick-link">
                        {{ __('messages.favorite_products') }}
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.categorias.index') }}"
                   class="d-block p-4 rounded-3 text-decoration-none text-dark fw-bold admin-quick-link">
                    Categorías
                </a>
            </div>
        </div>

        </div>
    </div>
@endsection