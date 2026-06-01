@extends('layouts.app')

@section('title', 'Panel de Control - Fandrobe')

@section('content')
    <div class="w-full mt-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-1">
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-blue-600 text-white p-4">
                        <h5 class="font-bold mb-0">
                            <i class="fas fa-tachometer-alt mr-2"></i>Panel de Control
                        </h5>
                    </div>
                    <div class="p-4">
                        <nav class="flex flex-col space-y-2">
                            <a class="block font-medium active" href="{{ route('dashboard') }}">
                                <i class="fas fa-home mr-2"></i>Inicio
                            </a>
                            <a class="block font-medium" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user mr-2"></i>Mi Perfil
                            </a>
                            <a class="block font-medium" href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart mr-2"></i>Mi Carrito
                            </a>
                            <a class="block font-medium" href="#">
                                <i class="fas fa-heart mr-2"></i>Favoritos
                            </a>
                            <a class="block font-medium" href="#">
                                <i class="fas fa-shopping-bag mr-2"></i>Mis Pedidos
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

            <div class="col-md-9">
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
