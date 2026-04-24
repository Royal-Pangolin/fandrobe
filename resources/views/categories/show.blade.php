@extends('layouts.app')
@section('title', 'Categoría')

@section('header')
    <div class="flex items-center text-sm text-beige-500 mb-4 font-medium tracking-wide">
        <a href="{{ route('categories.index') }}" class="hover:text-beige-800 transition">Disciplinas</a>
        <span class="mx-3 border-r border-beige-300 h-4"></span>
        <span class="text-beige-900 font-bold">{{ $category->name }}</span>
    </div>
    
    <div class="md:flex md:items-center md:justify-between">
        <div class="md:w-2/3">
            <h1 class="text-4xl md:text-5xl font-extrabold text-beige-900 mb-6 tracking-tight">{{ $category->name }}</h1>
            <p class="text-lg text-beige-600 max-w-3xl leading-relaxed">{{ $category->description ?? 'Bienvenido a esta colección. Aquí encontrarás piezas únicas y certificadas.' }}</p>
        </div>
        <div class="mt-8 md:mt-0 md:w-1/3 flex md:justify-end">
            <div class="bg-beige-50 border border-beige-200 rounded-xl p-6 text-center shadow-sm">
                <span class="block text-3xl font-black text-beige-900 mb-1">{{ $products->count() }}</span>
                <span class="block text-sm font-semibold text-beige-600 uppercase tracking-widest">Obras Disponibles</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="bg-beige-50 min-h-screen">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        
        <!-- Controls -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-10 pb-6 border-b border-beige-200">
            <div class="text-beige-600 font-medium text-sm mb-4 sm:mb-0">
                Mostrando <span class="font-bold text-beige-900">24</span> de 124 productos
            </div>
            <div class="flex items-center space-x-4 w-full sm:w-auto">
                <label class="text-sm font-bold text-beige-700 whitespace-nowrap">Ordenar por:</label>
                <select class="form-select block w-full sm:w-48 pl-3 pr-10 py-2 text-base border-beige-300 focus:outline-none focus:ring-beige-500 focus:border-beige-500 sm:text-sm rounded-md bg-white text-beige-900 font-medium">
                    <option>Más recientes</option>
                    <option>Precio: Mayor a Menor</option>
                    <option>Precio: Menor a Mayor</option>
                    <option>Más populares</option>
                </select>
            </div>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse ($products as $product)
                <div class="bg-white rounded-xl shadow-sm border border-beige-200 group hover:shadow-lg hover:-translate-y-1 transition duration-300 overflow-hidden flex flex-col h-full">
                    <a href="{{ route('products.show', $product->id) }}" class="block flex-grow relative">
                        <div class="absolute top-3 left-3 z-10 space-y-2">
                             <!-- Badge opcional -->
                             @if($loop->first)
                                <span class="bg-beige-900 text-beige-50 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wider shadow">Destaque</span>
                             @endif
                        </div>
                        <div class="h-64 bg-beige-200 flex items-center justify-center text-beige-500 group-hover:bg-beige-300 transition duration-300">
                            @if($product->images && $product->images->count() > 0)
                                @php $imgUrl = $product->images->first()->url; @endphp
                                <img src="{{ filter_var($imgUrl, FILTER_VALIDATE_URL) ? $imgUrl : asset('storage/' . $imgUrl) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                [Imagen de {{ $product->name }}]
                            @endif
                        </div>
                        <div class="p-5">
                            <span class="text-xs font-semibold text-beige-500 uppercase tracking-widest block mb-2">{{ $product->artist->name ?? 'Autor Demo' }}</span>
                            <h3 class="text-lg font-bold text-beige-900 mb-2 line-clamp-2">{{ $product->name }}</h3>
                        </div>
                    </a>
                    <div class="p-5 pt-0 mt-auto border-t border-beige-100 bg-beige-50/30 flex justify-between items-center">
                        <span class="font-black text-xl text-beige-900">€{{ number_format($product->base_price, 2) }}</span>
                        <a href="{{ route('products.show', $product->id) }}" class="text-sm font-bold bg-white border border-beige-300 text-beige-800 px-4 py-2 rounded-md hover:bg-beige-100 transition shadow-sm">Ver info</a>
                    </div>
                </div>
            @empty
                <p class="text-beige-600 col-span-full text-center">No hay productos en esta categoría por ahora.</p>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="mt-16 flex justify-center">
            <button class="bg-beige-900 text-white font-bold px-10 py-4 rounded-md hover:bg-beige-800 shadow-md transition">Ver más de esta disciplina</button>
        </div>
    </div>
</div>
@endsection
