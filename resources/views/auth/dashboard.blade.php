@extends('layouts.app')

@section('title', 'Panel de Control - Fandrobe')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-tachometer-alt me-2"></i>Panel de Control
                        </h5>
                    </div>
                    <div class="card-body">
                        <nav class="nav flex-column">
                            <a class="nav-link active" href="{{ route('dashboard') }}">
                                <i class="fas fa-home me-2"></i>Inicio
                            </a>
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user me-2"></i>Mi Perfil
                            </a>
                            <a class="nav-link" href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart me-2"></i>Mi Carrito
                            </a>
                            <a class="nav-link" href="#">
                                <i class="fas fa-heart me-2"></i>Favoritos
                            </a>
                            <a class="nav-link" href="#">
                                <i class="fas fa-shopping-bag me-2"></i>Mis Pedidos
                            </a>
                            @if (Auth::user()->role_id == 1)
                                <hr>
                                <a class="nav-link text-warning" href="#">
                                    <i class="fas fa-cog me-2"></i>Administración
                                </a>
                            @endif
                        </nav>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <!-- Welcome Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">
                            ¡Bienvenido, {{ Auth::user()->first_name }}! 👋
                        </h2>
                        <p class="card-text text-muted">
                            Gestiona tus compras, pedidos y preferencias desde tu panel personal.
                        </p>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="fas fa-shopping-cart fa-2x text-primary mb-2"></i>
                                <h4 class="card-title">Carrito</h4>
                                <p class="card-text">{{ $cartCount ?? 0 }} productos</p>
                                <a href="{{ route('cart.index') }}" class="btn btn-primary btn-sm">Ver Carrito</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="fas fa-heart fa-2x text-danger mb-2"></i>
                                <h4 class="card-title">Favoritos</h4>
                                <p class="card-text">{{ $favoritesCount ?? 0 }} productos</p>
                                <a href="#" class="btn btn-outline-danger btn-sm">Ver Favoritos</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="fas fa-shopping-bag fa-2x text-success mb-2"></i>
                                <h4 class="card-title">Pedidos</h4>
                                <p class="card-text">{{ $ordersCount ?? 0 }} pedidos</p>
                                <a href="#" class="btn btn-outline-success btn-sm">Ver Pedidos</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="fas fa-star fa-2x text-warning mb-2"></i>
                                <h4 class="card-title">Reseñas</h4>
                                <p class="card-text">{{ $reviewsCount ?? 0 }} reseñas</p>
                                <a href="#" class="btn btn-outline-warning btn-sm">Ver Reseñas</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-history me-2"></i>Actividad Reciente
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-3x mb-3"></i>
                            <h5>No hay actividad reciente</h5>
                            <p>¡Empieza explorando nuestros productos!</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i>Explorar Productos
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
