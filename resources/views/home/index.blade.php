@extends('layouts.app')
@section('title', 'Bienvenido')
@section('content')
    <div class="bg-beige-200 py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-beige-900 mb-6">
                Arte Eterno, Autenticidad Garantizada
            </h1>
            <p class="text-xl text-beige-700 max-w-2xl mx-auto mb-10">
                Descubre piezas únicas, coleccionables y mercancía oficial de tus artistas favoritos. Cada compra incluye un
                certificado de autenticidad.
            </p>
            <div class="flex justify-center flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ url('/products') }}"
                    class="bg-beige-900 text-beige-50 hover:bg-beige-800 transition px-8 py-3 rounded-md font-semibold text-lg">
                    Explorar Catálogo
                </a>
                <a href="{{ url('/artists') }}"
                    class="bg-beige-100 text-beige-900 border border-beige-300 hover:bg-beige-200 transition px-8 py-3 rounded-md font-semibold text-lg">
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
            @forelse ($products->take(3) as $product)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-beige-100 hover:shadow-md transition">
                    <div class="h-64 bg-beige-300 flex items-center justify-center text-beige-600">
                        @if($product->images && $product->images->count() > 0)
                            @php $imgUrl = $product->images->first()->url; @endphp
                            <img src="{{ filter_var($imgUrl, FILTER_VALIDATE_URL) ? $imgUrl : asset('storage/' . $imgUrl) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <span>[Imagen de {{ $product->name }}]</span>
                        @endif
                    </div>
                    <div class="p-6">
                        <span class="text-xs font-semibold text-beige-500 uppercase tracking-wider mb-2 block">{{ $product->category->name ?? 'Categoría' }}</span>
                        <h3 class="text-lg font-bold text-beige-900 mb-1">{{ $product->name }}</h3>
                        <p class="text-sm text-beige-600 mb-4">Por {{ $product->artist->name ?? 'Artista' }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-beige-900">€{{ number_format($product->base_price, 2) }}</span>
                            <a href="{{ route('products.show', $product->id) }}"
                                class="bg-beige-100 text-beige-800 px-4 py-2 rounded text-sm font-medium hover:bg-beige-200 transition">Ver
                                Detalle</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center col-span-3 text-beige-600">No hay productos destacados por el momento.</p>
            @endforelse
        </div>
    </div>
@endsection