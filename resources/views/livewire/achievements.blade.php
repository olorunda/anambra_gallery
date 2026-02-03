<div>
<nav class="flex justify-center items-center space-x-4 sm:space-x-8 mb-12 flex-wrap gap-y-4">
<button class="filter-tab active text-text-light dark:text-text-dark font-semibold pb-2 border-b-2 border-text-light dark:border-text-dark transition-colors duration-300" data-filter="all">All</button>
<button class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300" data-filter="infrastructure-transportation">Infrastructure and Transportation</button>
<button class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300" data-filter="healthcare">Healthcare Sector</button>
<button class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300" data-filter="education-human-capital">Education and Human Capital Development</button>
<button class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300" data-filter="technology-digital">Technology and Digital Transformation</button>
<button class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300" data-filter="security-safety">Security and Safety</button>
<button class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300" data-filter="economic-social">Economic and Social Development</button>
</nav>

<main class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="achievements-grid" wire:ignore>
@foreach($achievements as $achievement)
<a href="{{ route('achievement', $achievement->slug) }}" wire:navigate
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
    
    <!-- Assuming pagination is not implemented in the controller yet, preserving structure -->
    {{-- Pagination block --}}
    
    @script
    <script>
    document.addEventListener('livewire:navigated', function() {
        initFilters();
    });

    document.addEventListener('DOMContentLoaded', function() {
        initFilters();
    });

    function initFilters() {
        const filterTabs = document.querySelectorAll('.filter-tab');
        const achievementItems = document.querySelectorAll('.achievement-item');

        // Add click event listeners to filter tabs
        filterTabs.forEach(tab => {
            // Remove existing listeners to avoid duplicates if re-initialized
            const newTab = tab.cloneNode(true);
            tab.parentNode.replaceChild(newTab, tab);
            
            newTab.addEventListener('click', function() {
                const filter = this.getAttribute('data-filter');
                const allTabs = document.querySelectorAll('.filter-tab');

                // Update active tab styling
                allTabs.forEach(t => {
                    t.classList.remove('active', 'text-text-light', 'dark:text-text-dark', 'font-semibold', 'pb-2', 'border-b-2', 'border-text-light', 'dark:border-text-dark');
                    t.classList.add('text-secondary-text-light', 'dark:text-secondary-text-dark');
                });

                // Add active styling to clicked tab
                this.classList.remove('text-secondary-text-light', 'dark:text-secondary-text-dark');
                this.classList.add('active', 'text-text-light', 'dark:text-text-dark', 'font-semibold', 'pb-2', 'border-b-2', 'border-text-light', 'dark:border-text-dark');

                // Filter achievement items
                const items = document.querySelectorAll('.achievement-item');
                items.forEach(item => {
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
    }
    </script>
    @endscript
</div>
