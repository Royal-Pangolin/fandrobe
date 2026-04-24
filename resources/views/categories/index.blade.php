@extends('layouts.app')
@section('title', 'Disciplinas Artísticas')
@section('header')
    <div class="text-center py-8">
        <h2 class="font-extrabold text-4xl text-beige-900 mb-4 tracking-tight">
            Explora por Disciplina
        </h2>
        <p class="text-xl text-beige-600 max-w-2xl mx-auto">Selecciona el tipo de arte y mercancía que estás buscando. Todo nuestro catálogo está ordenado por las disciplinas de nuestros artistas registrados.</p>
    </div>
@endsection

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @for ($i = 0; $i < 6; $i++)
                <a href="{{ url('/categories/1') }}" class="block group">
                    <div class="relative rounded-2xl overflow-hidden shadow-sm h-80 bg-beige-200 transform group-hover:-translate-y-2 group-hover:shadow-xl transition duration-300">
                        <div class="absolute inset-0 flex items-center justify-center text-beige-500 font-medium text-lg bg-beige-300 group-hover:scale-105 transition duration-700 ease-in-out">
                            [Fondo Representativo]
                        </div>
                        <!-- Degradado inferior -->
                        <div class="absolute inset-0 bg-gradient-to-t from-beige-900 via-beige-900/40 to-transparent opacity-80 group-hover:opacity-90 transition duration-300"></div>
                        
                        <div class="absolute bottom-0 w-full p-8 text-white">
                            <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-xs font-bold mb-3 uppercase tracking-wider border border-white/30">Categoría</span>
                            <h3 class="text-3xl font-bold mb-2">Pintura Clásica</h3>
                            <p class="text-beige-100 text-sm opacity-0 group-hover:opacity-100 transition duration-300 translate-y-4 group-hover:translate-y-0">Explora el arte tradicional en lienzo y óleos exclusivos.</p>
                        </div>
                    </div>
                </a>
            @endfor
        </div>
    </div>
</div>
@endsection
