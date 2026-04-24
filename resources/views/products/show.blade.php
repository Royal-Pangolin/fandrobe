@extends('layouts.app')
@section('title', 'Detalle de Producto')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-sm border border-beige-200 overflow-hidden">
        <div class="md:flex">
            <!-- Product Images -->
            <div class="md:w-1/2 p-8 bg-beige-50 border-r border-beige-200 flex items-center justify-center min-h-[400px]">
                <div class="text-beige-400 font-medium text-lg">
                    [Galería de Imágenes]
                </div>
            </div>
            
            <!-- Product Info -->
            <div class="md:w-1/2 p-8 lg:p-12">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-semibold tracking-widest text-beige-500 uppercase">
                        <a href="{{ url('/categories/1') }}" class="hover:text-beige-800">Categoría</a> / Tazas
                    </span>
                    <span class="text-xs text-green-700 bg-green-50 px-2 py-1 rounded-sm border border-green-200 flex items-center font-medium shadow-sm">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Autenticado
                    </span>
                </div>
                
                <h1 class="text-3xl lg:text-4xl font-extrabold text-beige-900 mb-2">Mug de Cerámica Exclusivo</h1>
                <p class="text-lg text-beige-600 mb-6 border-b border-beige-200 pb-4">Obra original de <a href="{{ url('/artists/1') }}" class="font-semibold text-beige-800 hover:text-beige-600 transition">Autor Demo</a></p>
                
                <div class="text-4xl font-bold text-beige-900 mb-8">€15.00</div>
                
                <div class="prose prose-beige text-beige-700 mb-8">
                    <p>Esta taza cuenta con una reproducción de alta calidad y verificada de una de las pinturas más célebres de nuestro autor. Supervisado durante todo su proceso creativo para asegurar que los colores coinciden con la obra original.</p>
                </div>
                
                <div class="bg-beige-50 p-6 rounded-lg border border-beige-200 mb-8">
                    <label class="block text-sm font-bold text-beige-800 mb-3">Cantidad</label>
                    <div class="flex items-center space-x-4">
                        <input type="number" value="1" min="1" class="w-24 pl-4 pr-2 py-3 border border-beige-300 rounded-md shadow-sm focus:ring-beige-500 focus:border-beige-500 text-beige-900 font-medium">
                        <button class="flex-1 bg-beige-900 text-beige-50 font-bold py-3 px-8 rounded-md hover:bg-beige-800 transition flex justify-center items-center shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Añadir al carrito
                        </button>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <div class="flex text-sm border-b border-beige-100 pb-2">
                        <span class="font-semibold text-beige-800 w-32">SKU:</span>
                        <span class="text-beige-600">EXT-ART-99901</span>
                    </div>
                    <div class="flex text-sm pb-2">
                        <span class="font-semibold text-beige-800 w-32">Disponibilidad:</span>
                        <span class="text-beige-600">En stock (15)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
