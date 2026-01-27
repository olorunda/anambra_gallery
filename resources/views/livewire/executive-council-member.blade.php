<div>
    <a class="inline-flex items-center gap-2 mb-8 text-stone-700 dark:text-stone-300 hover:text-stone-900 dark:hover:text-white transition-colors" href="{{ route('executive-council-members') }}" wire:navigate>
        <span class="material-icons">arrow_back</span>
        <span>Return back</span>
    </a>

    <main class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24 items-start relative">
        <div class="lg:sticky lg:top-8">
            <div class="bg-primary p-4 rounded-xl">
                <img alt="Portrait of {{ $member->name }}"
                     class="w-full h-auto object-cover rounded-lg"
                     src="{{ $member->image_url }}"/>
            </div>
        </div>

        <div class="flex flex-col h-full relative">
            <div class="flex-grow">
                <p class="tracking-widest text-sm font-semibold uppercase text-stone-500 dark:text-stone-400">
                    {{ $member->position }}
                </p>
                <h2 class="font-display text-4xl md:text-5xl mt-2 mb-6 text-stone-900 dark:text-stone-100">
                    {{ $member->name }}
                </h2>
                <div class="space-y-6 text-stone-700 dark:text-stone-300 leading-relaxed">
                        <p>{!! $member->biography !!}  </p>
                </div>
            </div>

            <div class="flex justify-between items-center mt-12 lg:mt-16">
                <p class="font-display text-5xl text-stone-900 dark:text-stone-100">
                    {{ $member->id }}<span class="text-3xl text-gray-500 dark:text-gray-400">/{{ $totalMembers }}</span>
                </p>
                <div class="flex items-center gap-4">
                    @if($previousMember)
                        <a href="{{ route('executive-council-member', $previousMember->slug) }}" wire:navigate class="w-12 h-12 rounded-full border border-stone-300 dark:border-stone-600 flex items-center justify-center text-stone-700 dark:text-stone-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                            <span class="material-icons">arrow_back</span>
                        </a>
                    @else
                        <div class="w-12 h-12 rounded-full border border-stone-300 dark:border-stone-600 flex items-center justify-center text-stone-400 dark:text-stone-600">
                            <span class="material-icons">arrow_back</span>
                        </div>
                    @endif

                    @if($nextMember)
                        <a href="{{ route('executive-council-member', $nextMember->slug) }}" wire:navigate class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white hover:bg-yellow-500 transition-colors">
                            <span class="material-icons">arrow_forward</span>
                        </a>
                    @else
                        <div class="w-12 h-12 rounded-full bg-stone-400 dark:bg-stone-600 flex items-center justify-center text-white">
                            <span class="material-icons">arrow_forward</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="absolute right-[-10px] top-0 h-full w-1 hidden lg:block">
                <div class="w-1 h-24 bg-primary/30 rounded-full"></div>
            </div>
        </div>
    </main>
</div>
