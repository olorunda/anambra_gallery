
@extends('layouts.app')

@section('header_title','History & Culture of Anambra')
@section('header_subtitle','Discover the rich history and vibrant culture that define Anambra')
@section('content')
    <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($artifacts as $index => $artifact)
            @if($index === 0)
                <div class="md:col-span-1 flex flex-col gap-6">
                    <a href="{{ route('artifact', $artifact->slug) }}" class="relative rounded-lg overflow-hidden h-48 cursor-pointer group">
                        @if($artifact->images->first())
                            <img alt="{{ $artifact->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $artifact->images->first()->url }}"/>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-end p-4 group-hover:bg-opacity-40 transition-all duration-300">
                            <span class="text-white font-semibold">{{ $artifact->category }}</span>
                        </div>
                    </a>
            @elseif($index === 1)
                    <a href="{{ route('artifact', $artifact->slug) }}" class="relative rounded-lg overflow-hidden h-48 cursor-pointer group">
                        @if($artifact->images->first())
                            <img alt="{{ $artifact->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $artifact->images->first()->url }}"/>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-end p-4 group-hover:bg-opacity-40 transition-all duration-300">
                            <span class="text-white font-semibold">{{ $artifact->category }}</span>
                        </div>
                    </a>
                </div>
            @elseif($index === 2)
                <a href="{{ route('artifact', $artifact->slug) }}" class="md:col-span-1 relative rounded-lg overflow-hidden h-96 md:h-auto cursor-pointer group">
                    @if($artifact->images->first())
                        <img alt="{{ $artifact->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $artifact->images->first()->url }}"/>
                    @endif
                    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
                        <button class="w-3 h-3 bg-white rounded-full"></button>
                        <button class="w-3 h-3 bg-white/50 rounded-full"></button>
                        <button class="w-3 h-3 bg-white/50 rounded-full"></button>
                        <button class="w-3 h-3 bg-white/50 rounded-full"></button>
                    </div>
                </a>
            @elseif($index === 3)
                <div class="md:col-span-1 flex flex-col gap-6">
                    <a href="{{ route('artifact', $artifact->slug) }}" class="relative rounded-lg overflow-hidden h-48 cursor-pointer group">
                        @if($artifact->images->first())
                            <img alt="{{ $artifact->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $artifact->images->first()->url }}"/>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-end p-4 group-hover:bg-opacity-40 transition-all duration-300">
                            <span class="text-white font-semibold">{{ $artifact->category }}</span>
                        </div>
                    </a>
            @elseif($index === 4)
                    <a href="{{ route('artifact', $artifact->slug) }}" class="relative rounded-lg overflow-hidden h-48 cursor-pointer group">
                        @if($artifact->images->first())
                            <img alt="{{ $artifact->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $artifact->images->first()->url }}"/>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-end p-4 group-hover:bg-opacity-40 transition-all duration-300">
                            <span class="text-white font-semibold">{{ $artifact->category }}</span>
                        </div>
                    </a>
                </div>
            @elseif($index === 5)
                <a href="{{ route('artifact', $artifact->slug) }}" class="w-full mt-6 relative rounded-lg overflow-hidden h-48 cursor-pointer group block">
                    @if($artifact->images->first())
                        <img alt="{{ $artifact->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $artifact->images->first()->url }}"/>
                    @endif
                    <div class="absolute inset-0 bg-black bg-opacity-30 flex items-end p-4 group-hover:bg-opacity-40 transition-all duration-300">
                        <span class="text-white font-semibold">{{ $artifact->category }}</span>
                    </div>
                </a>
            @endif
        @endforeach
    </div>
    </main>
    <footer class="w-full mt-12 flex flex-col md:flex-row items-center justify-between">
        <div class="text-center md:text-left mb-6 md:mb-0">
            <span class="font-display text-6xl font-bold">{{ $artifacts->currentPage() }}</span><span class="font-display text-4xl text-text-subtle-light dark:text-text-subtle-dark">/{{ round($total_count/6) }}</span>
        </div>
        <div class="text-center mb-6 md:mb-0">
            <p class="text-text-subtle-light dark:text-text-subtle-dark">Navigate to view more</p>
        </div>
        <div class="flex items-center space-x-4">
            @if($artifacts->previousPageUrl())
                <a href="{{ $artifacts->previousPageUrl() }}" class="w-14 h-14 rounded-full border border-primary text-primary flex items-center justify-center bg-arrow-bg-light dark:bg-arrow-bg-dark hover:bg-primary hover:text-black transition-colors duration-300">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
            @else
                <div class="w-14 h-14 rounded-full border border-gray-300 text-gray-300 flex items-center justify-center bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-600">
                    <span class="material-symbols-outlined">arrow_back</span>
                </div>
            @endif
            @if($artifacts->nextPageUrl())
                <a href="{{ $artifacts->nextPageUrl() }}" class="w-14 h-14 rounded-full bg-primary text-black flex items-center justify-center hover:bg-primary/80 transition-colors duration-300">
                    <span class="material-symbols-outlined">arrow_forward</span>
                </a>
            @else
                <div class="w-14 h-14 rounded-full bg-gray-300 text-gray-500 flex items-center justify-center dark:bg-gray-600 dark:text-gray-400">
                    <span class="material-symbols-outlined">arrow_forward</span>
                </div>
            @endif
        </div>
    </footer>
    </div>
@endsection
