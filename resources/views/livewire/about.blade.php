<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <a class="group block overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300" href="{{route('executive-council')}}" wire:navigate>
        <div class="relative">
            <img alt="Anambra State Executive Council members posing for a photo" class="w-full min-h-[600px] object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('Executive.jpg') }}"/>
            <div class="absolute bottom-0 left-0 w-full h-2/3 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-6 text-white">
                <h2 class="font-display text-2xl font-bold mb-1">Anambra State Executive Council</h2>
                <p class="text-gray-200">Lorem ipsum dolor sit amet consectetur. Est tempus.</p>
            </div>
        </div>
    </a>
    <a class="group block overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300" href="{{ route('achievements') }}" wire:navigate>
        <div class="relative">
            <img alt="A modern building under construction in Anambra State" class="w-full min-h-[600px] object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('Achievements.jpg') }}"/>
            <div class="absolute bottom-0 left-0 w-full h-2/3 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-6 text-white">
                <h2 class="font-display text-2xl font-bold mb-1">Achievements</h2>
                <p class="text-gray-200">Lorem ipsum dolor sit amet consectetur. Est tempus.</p>
            </div>
        </div>
    </a>
    <a class="group block overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300" href="{{ route('history-culture') }}" wire:navigate>
        <div class="relative">
            <img alt="Two ornate, traditional Igbo pottery vases" class="w-full min-h-[600px] object-cover group-hover:scale-105 transition-transform duration-300" src="{{ asset('Culture.jpg') }}"/>
            <div class="absolute bottom-0 left-0 w-full h-2/3 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-6 text-white">
                <h2 class="font-display text-2xl font-bold mb-1">History & Culture</h2>
                <p class="text-gray-200">Lorem ipsum dolor sit amet consectetur. Est tempus.</p>
            </div>
        </div>
    </a>
</div>
