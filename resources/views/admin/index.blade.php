@extends('layouts.app')
@section('title', 'Panel de Administración')

@section('content')
<div class="container-fluid px-4 px-lg-5 py-5">
    <div class="admin-container">

        <div class="d-flex align-items-end justify-content-between mb-5">
            <div>
                <h1 class="fw-bolder mb-1">Panel de Administración</h1>
                <p class="text-muted mb-0">Bienvenido, {{ auth()->user()->first_name }}</p>
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
                    <p class="text-muted small fw-bold text-uppercase admin-form-label mb-2">Pedidos pendientes</p>
                    <p class="fw-bolder admin-stat-number mb-3">{{ $pendingOrders }}</p>
                    <a href="{{ route('admin.pedidos.index') }}" class="text-decoration-none fw-bold small text-verified">Ver pedidos →</a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-card p-4 rounded-4 h-100">
                    <p class="text-muted small fw-bold text-uppercase admin-form-label mb-2">Total pedidos</p>
                    <p class="fw-bolder admin-stat-number mb-3">{{ $totalOrders }}</p>
                    <a href="{{ route('admin.pedidos.index') }}" class="text-decoration-none fw-bold small text-verified">Gestionar →</a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-card p-4 rounded-4 h-100">
                    <p class="text-muted small fw-bold text-uppercase admin-form-label mb-2">Productos activos</p>
                    <p class="fw-bolder admin-stat-number mb-3">
                        {{ $activeProducts }}
                        @if($activeProducts < $totalProducts)
                            <span class="text-muted fs-6 fw-normal"> / {{ $totalProducts }}</span>
                        @endif
                    </p>
                    <a href="{{ route('admin.productos.index') }}" class="text-decoration-none fw-bold small text-verified">Gestionar →</a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="admin-card p-4 rounded-4 h-100">
                    <p class="text-muted small fw-bold text-uppercase admin-form-label mb-2">Usuarios registrados</p>
                    <p class="fw-bolder admin-stat-number mb-3">{{ $totalUsers }}</p>
                    <a href="{{ route('admin.usuarios.index') }}" class="text-decoration-none fw-bold small text-verified">Ver usuarios →</a>
                </div>
            </div>
        </div>

        {{-- Quick links --}}
        <h2 class="fw-bolder mb-4 admin-section-title">Accesos rápidos</h2>
        <div class="row g-3">
            <div class="col-md-3">
                <a href="{{ route('admin.pedidos.index') }}"
                   class="d-block p-4 rounded-3 text-decoration-none text-dark fw-bold admin-quick-link">
                    Pedidos
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.productos.index') }}"
                   class="d-block p-4 rounded-3 text-decoration-none text-dark fw-bold admin-quick-link">
                    Productos
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.artistas.index') }}"
                   class="d-block p-4 rounded-3 text-decoration-none text-dark fw-bold admin-quick-link">
                    Artistas
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.usuarios.index') }}"
                   class="d-block p-4 rounded-3 text-decoration-none text-dark fw-bold admin-quick-link">
                    Usuarios
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
