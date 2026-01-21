
@extends('layouts.app')

@section('header_title','Profile of the Governor')
@section('header_subtitle',"Learn about the governor's background, leadership journey, and vision for the state")
@section('content')

    <a class="inline-flex items-center gap-2 mb-8 text-stone-700 dark:text-stone-300 hover:text-stone-900 dark:hover:text-white transition-colors" href="{{ route('about') }}">
        <span class="material-icons">arrow_back</span>
        <span>Return back</span>
    </a>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">
        <div class="relative">
            <div class="absolute inset-0 bg-yellow-300/40 dark:bg-yellow-800/30 rounded-3xl translate-x-4 translate-y-4"></div>
            @if($governor && $governor->image)
                <img alt="Portrait of {{ $governor->name }}" class="relative rounded-3xl w-full h-auto object-cover z-10" src="{{ $governor->image }}"/>
            @endif
        </div>
        <div class="relative">
            <div class="absolute top-0 right-0 h-24 w-1 bg-gray-200 dark:bg-gray-700 rounded-full"></div>
            <div class="space-y-6">
                <p class="font-sans text-sm font-medium tracking-widest uppercase text-stone-500 dark:text-stone-400">{{ $governor->position ?? 'Governor' }}</p>
                <h2 class="font-display text-4xl sm:text-5xl font-bold text-stone-900 dark:text-white">{{ $governor->name ?? 'Governor' }}</h2>
                <div class="prose prose-lg text-stone-700 dark:text-stone-300 max-w-none">
                    @if($governor && is_array($governor->biography))
                        @foreach($governor->biography as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    @elseif($governor && $governor->biography)
                        <p>{!! $governor->biography  !!}}</p>
                    @endif
                </div>
                <div class="pt-4">
                    <a class="inline-block bg-primary text-stone-900 font-semibold px-8 py-3 rounded-lg shadow-md hover:bg-yellow-500 transition-colors focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-background-dark" href="{{ route('executive-council-members') }}">
                        Members of Executive Council
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
