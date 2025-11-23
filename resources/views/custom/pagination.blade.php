@if ($paginator->hasPages())
    <div class="flex justify-center items-center gap-4 mt-8">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <div class="w-12 h-12 rounded-full border border-stone-300 dark:border-stone-600 flex items-center justify-center text-stone-400 dark:text-stone-600">
                <span class="material-icons">arrow_back</span>
            </div>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="w-12 h-12 rounded-full border border-stone-300 dark:border-stone-600 flex items-center justify-center text-stone-700 dark:text-stone-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                <span class="material-icons">arrow_back</span>
            </a>
        @endif

        {{-- Page Information --}}
        <div class="px-4 py-2">
            <p class="text-sm text-stone-700 dark:text-stone-300">
                Page {{ $paginator->currentPage() }}
            </p>
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white hover:bg-yellow-500 transition-colors">
                <span class="material-icons">arrow_forward</span>
            </a>
        @else
            <div class="w-12 h-12 rounded-full bg-stone-400 dark:bg-stone-600 flex items-center justify-center text-white">
                <span class="material-icons">arrow_forward</span>
            </div>
        @endif
    </div>
@endif
