@extends('layouts.app')
@section('title', __('messages.disciplines'))

@section('content')

    <div class="hero-gradient px-3 mb-5">
        <div class="w-full px-4 md:px-6 text-center pb-5">
            <h1 class="text-5xl text-shadow mb-3 font-bold text-tighter">
                {{ __('messages.disciplines') }}
            </h1>
            <p class="text-lg text-shadow mx-auto" style="max-width: 560px; opacity: 0.9;">
                {{ __('messages.disciplines_desc') }}
            </p>
        </div>
    </div>

    <div class="w-full px-4 md:px-6 pb-5">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($categories as $category)
                <div class="">
                    <a href="{{ route('categories.show', $category->id) }}" class="text-decoration-none">
                        <div class="category-card relative overflow-hidden rounded-3xl"
                            style="background-color: {{ ['#4B352A', '#2A3B4B', '#3B4B2A', '#4B2A3B', '#2A4B3B', '#3B2A4B'][$loop->index % 6] }};">

                            <div
                                class="category-letter absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white">
                                {{ substr($category->translated_name, 0, 1) }}
                            </div>

                            <div class="absolute top-0 left-0 w-full h-full"
                                style="background: linear-gradient(135deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.5) 100%);">
                            </div>

                            <div class="absolute bottom-0 left-0 p-4 w-full">
                                <span class="badge badge-limited badge-sm mb-2">{{ __('messages.discipline') }}</span>
                                <h3 class="category-title font-bold text-white mb-1">{{ $category->translated_name }}</h3>
                                <p class="category-desc text-white mb-0">
                                    {{ Str::limit($category->description ?? __('messages.explore_discipline'), 60) }}
                                </p>
                            </div>

                            <div class="category-arrow absolute flex items-center justify-center bg-white rounded-full">
                                <svg width="20" height="20" fill="none" stroke="var(--color-shadow)"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 py-5">
                    <h4>{{ __('messages.no_categories') }}</h4>
                </div>
            @endforelse
        </div>
    </div>

@endsection
