@extends('layouts.app')
@section('title', 'Perfil de Artista')

@section('content')
<div class="bg-white">
    <!-- Artist Banner -->
    <div class="h-[400px] bg-beige-300 relative overflow-hidden">
        <div class="absolute inset-0 flex items-center justify-center text-beige-600 text-lg font-medium">
            [Banner del Artista Cover]
        </div>
        <div class="absolute bottom-0 w-full bg-gradient-to-t from-beige-900/90 via-beige-900/50 to-transparent pt-32 pb-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-end">
                <div class="w-32 h-32 md:w-40 md:h-40 bg-white rounded-xl border-4 border-white shadow-2xl overflow-hidden mb-4 md:mb-0 md:mr-8 flex items-center justify-center text-beige-500 bg-beige-100 shrink-0">
                    [Avatar]
                </div>
                <div class="pb-2">
                    <span class="inline-block bg-beige-50/20 backdrop-blur-sm text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-3 border border-white/20">Pintor</span>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-2 tracking-tight">Autor Demo</h1>
                    <div class="flex items-center text-beige-100 text-sm font-medium">
                        <svg class="w-5 h-5 mr-1.5 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Identidad Verificada por Everlasting Art
                    </div>
                </div>
                <!-- Action button -->
                <div class="mt-6 md:mt-0 md:ml-auto pb-2">
                    <button class="bg-white text-beige-900 font-bold px-6 py-3 rounded-md hover:bg-beige-100 transition shadow-lg flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        Seguir Artista
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Artist Bio / Info -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 lg:gap-16">
            <div class="md:col-span-2">
                <h2 class="text-3xl font-extrabold text-beige-900 mb-6">Sobre el Autor</h2>
                <div class="prose prose-lg prose-beige text-beige-700">
                    <p>Esta es la biografía del artista. Aquí se detallan sus inspiraciones académicas, la proveniencia de su arte y los valores que comparte con el público.</p>
                    <p>Todas las obras adquiridas a través de Everlasting Art vienen firmadas o certificadas, asegurando al comprador que recibe un artículo legítimo y con altos estándares de calidad, supervisando mano a mano con el artista cada impresión o producto derivado de su obra magna.</p>
                </div>
            </div>
            <div>
                <div class="bg-beige-50/50 p-8 rounded-2xl border border-beige-200 shadow-sm">
                    <h3 class="text-sm font-bold uppercase tracking-widest text-beige-500 mb-6 pb-4 border-b border-beige-200">Información Rápida</h3>
                    <ul class="space-y-5">
                        <li class="flex flex-col">
                            <span class="text-xs font-semibold text-beige-500 uppercase tracking-wide mb-1">Género Principal</span>
                            <span class="font-bold text-beige-900">Pintura y Óleo</span>
                        </li>
                        <li class="flex flex-col">
                            <span class="text-xs font-semibold text-beige-500 uppercase tracking-wide mb-1">Obras Disponibles</span>
                            <span class="font-bold text-beige-900">24 Artículos</span>
                        </li>
                        <li class="flex flex-col">
                            <span class="text-xs font-semibold text-beige-500 uppercase tracking-wide mb-1">Miembro desde</span>
                            <span class="font-bold text-beige-900">Marzo 2026</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Merch / Products -->
<div class="bg-beige-100 py-20 border-t border-beige-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-10">
            <h2 class="text-3xl font-bold text-beige-900">Catálogo del Artista</h2>
            <a href="#" class="text-beige-600 hover:text-beige-900 font-semibold text-sm">Ver todo &rarr;</a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @for ($i = 0; $i < 4; $i++)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-beige-200 group hover:shadow-md transition duration-300">
                    <a href="{{ url('/products/1') }}" class="block">
                        <div class="h-56 bg-beige-200 flex items-center justify-center text-beige-500 group-hover:bg-beige-300 transition duration-500 relative">
                            [Imagen]
                        </div>
                        <div class="p-5">
                            <h3 class="text-md font-bold text-beige-900 mb-2 truncate group-hover:text-beige-600 transition">Cuadro Edición Limitada</h3>
                            <div class="flex items-center justify-between mt-4">
                                <span class="text-lg font-black text-beige-900">€245.00</span>
                                <span class="text-xs font-bold bg-beige-100 text-beige-800 px-2 py-1 rounded">Stock Bajísimo</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endfor
        </div>
    </div>
</div>
@endsection
