@extends('layouts.app')
@section('title', 'Nuestros Artistas')
@section('header')
    <div class="flex flex-col md:flex-row md:justify-between md:items-center">
        <div>
            <h2 class="font-bold text-3xl text-beige-900 leading-tight">
                Directorio de Artistas
            </h2>
            <p class="text-beige-600 mt-2 text-lg">Descubre a los creadores detrás de las obras auténticas.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <input type="text" placeholder="Buscar artista..." class="px-4 py-2 border border-beige-300 rounded-md focus:ring-beige-500 focus:border-beige-500 text-beige-900 shadow-sm w-full md:w-64">
        </div>
    </div>
@endsection

@section('content')
<div class="bg-beige-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse ($artists as $artist)
                <div class="bg-white rounded-2xl shadow-sm border border-beige-200 overflow-hidden group hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                    <div class="h-56 bg-beige-200 relative">
                        <div class="absolute inset-0 flex items-center justify-center text-beige-500 text-sm font-medium">
                            [Foto de {{ $artist->name }}]
                        </div>
                    </div>
                    <div class="p-6 text-center relative">
                        <!-- Pequeño badge superpuesto -->
                        <div class="absolute -top-4 right-4 bg-white p-1 rounded-full shadow-sm border border-beige-100">
                            <span class="bg-green-50 text-green-600 rounded-full w-6 h-6 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-extrabold text-beige-900 mb-1 line-clamp-1">{{ $artist->name }}</h3>
                        <p class="text-sm text-beige-500 font-medium mb-5">{{ $artist->genre->name ?? 'Artista' }}</p>
                        <a href="{{ route('artists.show', $artist->id) }}" class="inline-block border-2 text-sm border-beige-300 text-beige-800 px-6 py-2 rounded-full hover:bg-beige-800 hover:text-white transition font-bold">Ver Perfil Completo</a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-beige-600">No hay artistas disponibles en este momento.</div>
            @endforelse
        </div>
        
        <div class="mt-12 flex justify-center">
             <button class="bg-beige-200 text-beige-800 font-semibold px-8 py-3 rounded-md hover:bg-beige-300 transition">Cargar más artistas</button>
        </div>
    </div>
</div>
@endsection
