@extends('layouts.app')

@section('header_title','Achievements')
@section('header_subtitle','Showcasing major infrastructure projects from the governor\'s tenure.')
@section('content')

<nav class="flex justify-center items-center space-x-4 sm:space-x-8 mb-12">
<button class="filter-tab active text-text-light dark:text-text-dark font-semibold pb-2 border-b-2 border-text-light dark:border-text-dark transition-colors duration-300" data-filter="all">All</button>
<button class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300" data-filter="roads">Roads</button>
<button class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300" data-filter="education">Education</button>
<button class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300" data-filter="government">New Government House</button>
<button class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300" data-filter="healthcare">Healthcare</button>
</nav>

<main class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="achievements-grid">
@foreach($achievements as $achievement)
<a href="{{ route('achievement', $achievement->slug) }}"
   class="achievement-item relative overflow-hidden rounded-lg group {{ $loop->index === 1 || $loop->index === 4 ? 'row-span-2' : '' }} {{ $loop->index === 5 ? 'col-span-1 md:col-span-2 lg:col-span-1' : 'col-span-1 md:col-span-1 lg:col-span-1' }} cursor-pointer block"
   data-category="{{ $achievement->category }}">
<img alt="{{ $achievement->title }}"
     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
     src="{{ $achievement->images->first()?->url ?? '' }}"/>
<div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent group-hover:from-black/80 transition-all duration-300"></div>
<h3 class="absolute bottom-4 left-4 text-white font-medium text-lg">{{ $achievement->title }}</h3>
</a>
@endforeach
</main>


<footer class="w-full mt-12 flex flex-col md:flex-row items-center justify-between">
    <div class="text-center md:text-left mb-6 md:mb-0">
        <span class="font-display text-6xl font-bold">{{ $achievements->currentPage() }}</span><span class="font-display text-4xl text-text-subtle-light dark:text-text-subtle-dark">/{{ round($total_count/6) }}</span>
    </div>
    <div class="text-center mb-6 md:mb-0">
        <p class="text-text-subtle-light dark:text-text-subtle-dark">Navigate to view more</p>
    </div>
    <div class="flex items-center space-x-4">
        @if($achievements->previousPageUrl())
            <a href="{{ $achievements->previousPageUrl() }}" class="w-14 h-14 rounded-full border border-primary text-primary flex items-center justify-center bg-arrow-bg-light dark:bg-arrow-bg-dark hover:bg-primary hover:text-black transition-colors duration-300">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
        @else
            <div class="w-14 h-14 rounded-full border border-gray-300 text-gray-300 flex items-center justify-center bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-600">
                <span class="material-symbols-outlined">arrow_back</span>
            </div>
        @endif
        @if($achievements->nextPageUrl())
            <a href="{{ $achievements->nextPageUrl() }}" class="w-14 h-14 rounded-full bg-primary text-black flex items-center justify-center hover:bg-primary/80 transition-colors duration-300">
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        @else
            <div class="w-14 h-14 rounded-full bg-gray-300 text-gray-500 flex items-center justify-center dark:bg-gray-600 dark:text-gray-400">
                <span class="material-symbols-outlined">arrow_forward</span>
            </div>
        @endif
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterTabs = document.querySelectorAll('.filter-tab');
    const achievementItems = document.querySelectorAll('.achievement-item');

    // Add click event listeners to filter tabs
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');

            // Update active tab styling
            filterTabs.forEach(t => {
                t.classList.remove('active', 'text-text-light', 'dark:text-text-dark', 'font-semibold', 'pb-2', 'border-b-2', 'border-text-light', 'dark:border-text-dark');
                t.classList.add('text-secondary-text-light', 'dark:text-secondary-text-dark');
            });

            // Add active styling to clicked tab
            this.classList.remove('text-secondary-text-light', 'dark:text-secondary-text-dark');
            this.classList.add('active', 'text-text-light', 'dark:text-text-dark', 'font-semibold', 'pb-2', 'border-b-2', 'border-text-light', 'dark:border-text-dark');

            // Filter achievement items
            achievementItems.forEach(item => {
                const category = item.getAttribute('data-category');

                if (filter === 'all' || category === filter) {
                    item.style.display = 'block';
                    // Add fade-in effect
                    item.style.opacity = '0';
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transition = 'opacity 0.3s ease-in-out';
                    }, 50);
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>

@endsection
