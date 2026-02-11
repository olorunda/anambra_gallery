<div>
    <nav class="flex justify-center items-center space-x-4 sm:space-x-8 mb-12 flex-wrap gap-y-4">
        <button
            class="filter-tab active text-text-light dark:text-text-dark font-semibold pb-2 border-b-2 border-text-light dark:border-text-dark transition-colors duration-300"
            data-filter="all">All</button>
        <button
            class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300"
            data-filter="sights-sounds">Sights & Sounds</button>
        <button
            class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300"
            data-filter="artefacts">Artefacts</button>
        <button
            class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300"
            data-filter="festivals">Festivals</button>
        <button
            class="filter-tab text-secondary-text-light dark:text-secondary-text-dark hover:text-text-light dark:hover:text-text-dark transition-colors duration-300"
            data-filter="people">People of Anambra</button>
    </nav>

    <div class="w-full grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6" wire:ignore>
        @foreach($artifacts as $artifact)
            <div class="artifact-item" data-category="{{ $artifact->category }}">
                <a href="{{ route('artifact', $artifact->slug) }}" wire:navigate
                    class="relative rounded-lg overflow-hidden h-64 cursor-pointer group block">
                    @if($artifact->images->first())
                        <img alt="{{ $artifact->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            src="{{ $artifact->images->first()->url }}" />
                    @endif
                    <div
                        class="absolute inset-0 bg-black/30 flex items-end p-4 group-hover:bg-black/40 transition-all duration-300">
                        <div class="w-full">
                            <span class="text-white font-semibold block mb-1">{{ $artifact->category }}</span>
                            <h3 class="text-white text-lg font-bold leading-tight">{{ $artifact->title }}</h3>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

@script
<script>
    document.addEventListener('livewire:navigated', function () {
        initArtifactFilters();
    });

    document.addEventListener('DOMContentLoaded', function () {
        initArtifactFilters();
    });

    function initArtifactFilters() {
        const filterTabs = document.querySelectorAll('.filter-tab');
        const artifactItems = document.querySelectorAll('.artifact-item');

        filterTabs.forEach(tab => {
            // Clone to remove old listeners
            const newTab = tab.cloneNode(true);
            tab.parentNode.replaceChild(newTab, tab);

            newTab.addEventListener('click', function () {
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