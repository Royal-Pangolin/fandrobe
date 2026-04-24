@extends('layouts.app')
@section('title', 'Bienvenido')
@section('content')
<div class="bg-beige-200 py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-4xl md:text-6xl font-extrabold text-beige-900 mb-6">
            Arte Eterno, Autenticidad Garantizada
        </h1>
        <p class="text-xl text-beige-700 max-w-2xl mx-auto mb-10">
            Descubre piezas únicas, coleccionables y mercancía oficial de tus artistas favoritos. Cada compra incluye un certificado de autenticidad.
        </p>
        <div class="flex justify-center flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
            <a href="{{ url('/products') }}" class="bg-beige-900 text-beige-50 hover:bg-beige-800 transition px-8 py-3 rounded-md font-semibold text-lg">
                Explorar Catálogo
            </a>
            <a href="{{ url('/artists') }}" class="bg-beige-100 text-beige-900 border border-beige-300 hover:bg-beige-200 transition px-8 py-3 rounded-md font-semibold text-lg">
                Conocer Artistas
            </a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
    <div class="mb-12 text-center">
        <h2 class="text-3xl font-bold text-beige-900">Productos Destacados</h2>
        <div class="h-1 w-20 bg-beige-500 mx-auto mt-4"></div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Bucle temporal para mostrar placeholders --}}
        @for ($i = 0; $i < 3; $i++)
            <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-beige-100 hover:shadow-md transition">
                <div class="h-64 bg-beige-300 flex items-center justify-center text-beige-600">
                    [Imagen del Producto]
                </div>
                <div class="p-6">
                    <span class="text-xs font-semibold text-beige-500 uppercase tracking-wider mb-2 block">Categoría</span>
                    <h3 class="text-lg font-bold text-beige-900 mb-1">Nombre del Producto</h3>
                    <p class="text-sm text-beige-600 mb-4">Por Artista Famoso</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-beige-900">€29.99</span>
                        <a href="{{ url('/products/1') }}" class="bg-beige-100 text-beige-800 px-4 py-2 rounded text-sm font-medium hover:bg-beige-200 transition">Ver Detalle</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
@endsection
