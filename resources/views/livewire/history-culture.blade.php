<div>
    <nav class="flex justify-center items-center space-x-4 sm:space-x-8 mb-12 flex-wrap gap-y-4">
        <button class="filter-tab active text-text-light dark:text-text-dark font-semibold pb-2 border-b-2 border-text-light dark:border-text-dark transition-colors duration-300" data-filter="all">All</button>
        <button class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300" data-filter="sights-sounds">Sights & Sounds</button>
        <button class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300" data-filter="artefacts">Artefacts</button>
        <button class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300" data-filter="festivals">Festivals</button>
        <button class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300" data-filter="people">People of Anambra</button>
    </nav>

    <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-6" wire:ignore>
        @foreach($artifacts as $index => $artifact)
            @if($index === 0)
                <div class="md:col-span-1 flex flex-col gap-6 artifact-item" data-category="{{ $artifact->category }}">
                    <a href="{{ route('artifact', $artifact->slug) }}" wire:navigate class="relative rounded-lg overflow-hidden h-48 cursor-pointer group">
                        @if($artifact->images->first())
                            <img alt="{{ $artifact->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $artifact->images->first()->url }}"/>
                        @endif
                        <div class="absolute inset-0 bg-black/30 flex items-end p-4 group-hover:bg-black/40 transition-all duration-300">
                            <span class="text-white font-semibold">{{ $artifact->category }}</span>
                        </div>
                    </a>
            @elseif($index === 1)
                    <a href="{{ route('artifact', $artifact->slug) }}" wire:navigate class="relative rounded-lg overflow-hidden h-48 cursor-pointer group artifact-item" data-category="{{ $artifact->category }}">
                        @if($artifact->images->first())
                            <img alt="{{ $artifact->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $artifact->images->first()->url }}"/>
                        @endif
                        <div class="absolute inset-0 bg-black/30 flex items-end p-4 group-hover:bg-black/40 transition-all duration-300">
                            <span class="text-white font-semibold">{{ $artifact->category }}</span>
                        </div>
                    </a>
                </div>
            @elseif($index === 2)
                <a href="{{ route('artifact', $artifact->slug) }}" wire:navigate class="md:col-span-1 relative rounded-lg overflow-hidden h-96 md:h-auto cursor-pointer group artifact-item" data-category="{{ $artifact->category }}">
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
                <div class="md:col-span-1 flex flex-col gap-6 artifact-item" data-category="{{ $artifact->category }}">
                    <a href="{{ route('artifact', $artifact->slug) }}" wire:navigate class="relative rounded-lg overflow-hidden h-48 cursor-pointer group">
                        @if($artifact->images->first())
                            <img alt="{{ $artifact->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $artifact->images->first()->url }}"/>
                        @endif
                        <div class="absolute inset-0 bg-black/30 flex items-end p-4 group-hover:bg-black/40 transition-all duration-300">
                            <span class="text-white font-semibold">{{ $artifact->category }}</span>
                        </div>
                    </a>
            @elseif($index === 4)
                    <a href="{{ route('artifact', $artifact->slug) }}" wire:navigate class="relative rounded-lg overflow-hidden h-48 cursor-pointer group artifact-item" data-category="{{ $artifact->category }}">
                        @if($artifact->images->first())
                            <img alt="{{ $artifact->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $artifact->images->first()->url }}"/>
                        @endif
                        <div class="absolute inset-0 bg-black/30 flex items-end p-4 group-hover:bg-black/40 transition-all duration-300">
                            <span class="text-white font-semibold">{{ $artifact->category }}</span>
                        </div>
                    </a>
                </div>
            @elseif($index === 5)
                <a href="{{ route('artifact', $artifact->slug) }}" wire:navigate class="w-full mt-6 relative rounded-lg overflow-hidden h-48 cursor-pointer group block artifact-item" data-category="{{ $artifact->category }}">
                    @if($artifact->images->first())
                        <img alt="{{ $artifact->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $artifact->images->first()->url }}"/>
                    @endif
                    <div class="absolute inset-0 bg-black/30 flex items-end p-4 group-hover:bg-black/40 transition-all duration-300">
                        <span class="text-white font-semibold">{{ $artifact->category }}</span>
                    </div>
                </a>
            @endif
        @endforeach
    </div>
    
    <footer class="w-full mt-12 flex flex-col md:flex-row items-center justify-between">
        <div class="text-center md:text-left mb-6 md:mb-0">
            <span class="font-display text-6xl font-bold">{{ $artifacts->currentPage() }}</span><span class="font-display text-4xl text-text-subtle-light dark:text-text-subtle-dark">/{{ round($total_count/6) }}</span>
        </div>
        <div class="text-center mb-6 md:mb-0">
            <p class="text-text-subtle-light dark:text-text-subtle-dark">Navigate to view more</p>
        </div>
        <div class="flex items-center space-x-4">
            @if($artifacts->previousPageUrl())
                <button wire:click="previousPage" class="w-14 h-14 rounded-full border border-primary text-primary flex items-center justify-center bg-arrow-bg-light dark:bg-arrow-bg-dark hover:bg-primary hover:text-black transition-colors duration-300">
                    <span class="material-symbols-outlined">arrow_back</span>
                </button>
            @else
                <div class="w-14 h-14 rounded-full border border-gray-300 text-gray-300 flex items-center justify-center bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-600">
                    <span class="material-symbols-outlined">arrow_back</span>
                </div>
            @endif
            @if($artifacts->nextPageUrl())
                <button wire:click="nextPage" class="w-14 h-14 rounded-full bg-primary text-black flex items-center justify-center hover:bg-primary/80 transition-colors duration-300">
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
            @else
                <div class="w-14 h-14 rounded-full bg-gray-300 text-gray-500 flex items-center justify-center dark:bg-gray-600 dark:text-gray-400">
                    <span class="material-symbols-outlined">arrow_forward</span>
                </div>
            @endif
        </div>
    </footer>
</div>

    @script
    <script>
    document.addEventListener('livewire:navigated', function() {
        initArtifactFilters();
    });

    document.addEventListener('DOMContentLoaded', function() {
        initArtifactFilters();
    });

    function initArtifactFilters() {
        const filterTabs = document.querySelectorAll('.filter-tab');
        const artifactItems = document.querySelectorAll('.artifact-item');

        filterTabs.forEach(tab => {
            // Clone to remove old listeners
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

                // Filter artifact items
                const items = document.querySelectorAll('.artifact-item');
                items.forEach(item => {
                    const category = item.getAttribute('data-category');

                    if (filter === 'all' || category === filter) {
                        item.style.display = 'flex'; // Default for items is block/flex mixed, try flex as safe default or specific
                         if(item.tagName === 'A' || item.classList.contains('block')) {
                             item.style.display = 'block';
                         }
                         if(item.classList.contains('flex')) {
                             item.style.display = 'flex';
                         }
                        
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
