@extends('layouts.app')
@section('title', 'Catálogo de Productos')
@section('header')
    <h2 class="font-semibold text-2xl text-beige-900 leading-tight">
        Todo el Catálogo
    </h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <!-- Filters and Grid -->
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar filters -->
        <div class="w-full md:w-1/4">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-beige-200">
                <h3 class="text-lg font-bold text-beige-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-beige-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filtros
                </h3>
                <div class="space-y-6">
                    <div>
                        <span class="block text-sm font-semibold text-beige-700 mb-2">Categorías</span>
                        <div class="space-y-2">
                            <label class="flex items-center text-sm text-beige-600"><input type="checkbox" class="mr-2 text-beige-600 focus:ring-beige-500 rounded border-beige-300"> Tazas</label>
                            <label class="flex items-center text-sm text-beige-600"><input type="checkbox" class="mr-2 text-beige-600 focus:ring-beige-500 rounded border-beige-300"> Fundas de móvil</label>
                            <label class="flex items-center text-sm text-beige-600"><input type="checkbox" class="mr-2 text-beige-600 focus:ring-beige-500 rounded border-beige-300"> Láminas</label>
                            <label class="flex items-center text-sm text-beige-600"><input type="checkbox" class="mr-2 text-beige-600 focus:ring-beige-500 rounded border-beige-300"> Originals</label>
                        </div>
                    </div>
                    <div>
                        <span class="block text-sm font-semibold text-beige-700 mb-2">Precio Máximo</span>
                        <input type="range" class="w-full accent-beige-600" min="0" max="1000">
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="w-full md:w-3/4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Bucle temporal para mostrar placeholders --}}
                @for ($i = 0; $i < 6; $i++)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-beige-200 group hover:shadow-md transition">
                        <a href="{{ url('/products/1') }}" class="block">
                            <div class="h-56 bg-beige-200 flex items-center justify-center text-beige-500 group-hover:bg-beige-300 transition">
                                [Imagen del Producto]
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-beige-900 group-hover:text-beige-600 transition truncate">Artículo de Arte Limitado</h3>
                                <p class="text-xs text-beige-500 mb-3">Vendido por: Autor Demo</p>
                                <div class="flex justify-between items-center mt-4">
                                    <span class="text-lg font-bold text-beige-800">€45.00</span>
                                    <span class="text-beige-100 bg-beige-800 px-3 py-1 rounded text-xs font-semibold hover:bg-beige-900 transition">Ver Detalle</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endfor
            </div>
            
            <div class="mt-10 flex justify-center">
                <!-- Pagination placeholder -->
                <nav class="flex space-x-2">
                    <span class="px-4 py-2 border border-beige-300 bg-white text-beige-700 rounded-md">Anterior</span>
                    <span class="px-4 py-2 border-none bg-beige-800 text-white rounded-md">1</span>
                    <span class="px-4 py-2 border border-beige-300 bg-white text-beige-700 rounded-md">2</span>
                    <span class="px-4 py-2 border border-beige-300 bg-white text-beige-700 rounded-md">Siguiente</span>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
