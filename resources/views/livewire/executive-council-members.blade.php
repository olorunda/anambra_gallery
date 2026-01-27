<div>
    <a class="inline-flex items-center gap-2 mb-8 text-stone-700 dark:text-stone-300 hover:text-stone-900 dark:hover:text-white transition-colors" href="{{ route('executive-council') }}" wire:navigate>
        <span class="material-icons">arrow_back</span>
        <span>Return back</span>
    </a>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12">
        @forelse($members as $member)
            <a href="{{ route('executive-council-member', $member->slug) }}" wire:navigate class="group block space-y-4 cursor-pointer transform transition-all duration-300 hover:scale-105">
                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-sm group-hover:shadow-lg transition-shadow duration-300">
                    <img alt="Portrait of {{ $member->name }}" class="w-full h-auto object-cover aspect-[4/3] group-hover:opacity-90 transition-opacity duration-300" src="{{ $member->image_url }}"/>
                </div>
                <div>
                    <h3 class="font-medium text-lg text-gray-900 dark:text-gray-100 group-hover:text-primary transition-colors duration-300">{{ $member->name }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $member->position }}</p>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-600 dark:text-gray-400">No executive council members found.</p>
            </div>
        @endforelse
    </div>

    <!-- Custom Pagination Links -->
    <div class="mt-8">
        {{ $members->links() }} 
        {{-- If you had a custom pagination view, you can use: {{ $members->links('your.custom.view') }} --}}
    </div>
</div>
