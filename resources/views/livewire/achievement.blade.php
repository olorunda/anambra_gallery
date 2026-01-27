<div>
    <a class="inline-flex items-center gap-2 mb-8 text-stone-700 dark:text-stone-300 hover:text-stone-900 dark:hover:text-white transition-colors" href="{{ route('achievements') }}" wire:navigate>
        <span class="material-icons">arrow_back</span>
        <span>Return back</span>
    </a>
    @php
        $images = $achievement->images->pluck('url')->toArray();
    @endphp

    <div 
        x-data="{
            images: {{ json_encode($images) }},
            currentSlide: 0,
            modalOpen: false,
            currentModalSlide: 0,
            get totalImages() { return this.images.length },
            
            init() {
                // Keyboard navigation
                document.addEventListener('keydown', (e) => {
                    if (this.modalOpen) {
                        if (e.key === 'ArrowLeft') this.prevModalImage();
                        if (e.key === 'ArrowRight') this.nextModalImage();
                        if (e.key === 'Escape') this.closeModal();
                    } else {
                        // Optional: Add main slider keyboard nav if desired
                        // if (e.key === 'ArrowLeft') this.prevImage();
                        // if (e.key === 'ArrowRight') this.nextImage();
                    }
                });
            },
            
            nextImage() {
                if (this.currentSlide < this.totalImages - 1) {
                    this.currentSlide++;
                }
            },
            prevImage() {
                if (this.currentSlide > 0) {
                    this.currentSlide--;
                }
            },
            goToSlide(index) {
                this.currentSlide = index;
            },
            
            openModal(index) {
                this.currentModalSlide = index;
                this.modalOpen = true;
                document.body.style.overflow = 'hidden';
            },
            closeModal() {
                this.modalOpen = false;
                document.body.style.overflow = 'auto';
            },
            nextModalImage() {
                if (this.currentModalSlide < this.totalImages - 1) {
                    this.currentModalSlide++;
                }
            },
            prevModalImage() {
                if (this.currentModalSlide > 0) {
                    this.currentModalSlide--;
                }
            },
            goToModalSlide(index) {
                this.currentModalSlide = index;
            }
        }"
        class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16"
    >
        <div class="flex flex-col items-center">
            <div class="relative w-full max-w-lg">
                <!-- Image Slider Container -->
                <div id="imageSlider" class="relative overflow-hidden">
                    <div 
                        class="flex transition-transform duration-300 ease-in-out"
                        :style="`transform: translateX(-${currentSlide * 100}%)`"
                    >
                        @foreach($images as $index => $image)
                            <img
                                alt="{{ $achievement->title }} - Image {{ $index + 1 }}"
                                class="w-full h-auto object-cover rounded-xl shadow-lg flex-shrink-0 cursor-pointer"
                                src="{{ $image }}"
                                @click="openModal({{ $index }})"
                            />
                        @endforeach
                    </div>
                </div>

                <!-- Navigation Arrows -->
                <button 
                    class="absolute top-1/2 left-4 -translate-y-1/2 bg-button-bg-light dark:bg-button-bg-dark text-button-text-light dark:text-button-text-dark rounded-full p-2.5 shadow-md hover:bg-opacity-80 transition-opacity z-10" 
                    @click="prevImage()"
                    :class="{ 'opacity-50 cursor-not-allowed': currentSlide === 0 }"
                    :disabled="currentSlide === 0"
                >
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button 
                    class="absolute top-1/2 right-4 -translate-y-1/2 bg-button-bg-light dark:bg-button-bg-dark text-button-text-light dark:text-button-text-dark rounded-full p-2.5 shadow-md hover:bg-opacity-80 transition-opacity z-10" 
                    @click="nextImage()"
                    :class="{ 'opacity-50 cursor-not-allowed': currentSlide === totalImages - 1 }"
                    :disabled="currentSlide === totalImages - 1"
                >
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>

                <!-- Indicator Dots -->
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2 z-10">
                    <template x-for="(image, index) in images" :key="index">
                        <button
                            class="w-3 h-3 rounded-full transition-all duration-200"
                            :class="index === currentSlide ? 'bg-white' : 'bg-white/50'"
                            @click="goToSlide(index)"
                        ></button>
                    </template>
                </div>
            </div>
            <p class="mt-6 text-sm text-text-light/70 dark:text-text-dark/70">Swipe to view more images</p>
        </div>
        <div class="flex flex-col justify-center">
            <h2 class="font-display text-4xl md:text-5xl font-bold mb-6">{{ $achievement->title }}</h2>
            <p class="text-base leading-relaxed text-text-light/90 dark:text-text-dark/90">
             {!! $achievement->description !!}
            </p>
        </div>

        <!-- Modal for enlarged image view -->
        <div 
            x-show="modalOpen" 
            x-transition
            class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50"
            style="display: none;" 
        >
            <div class="relative max-w-4xl max-h-screen p-4 w-full flex flex-col items-center">
                <!-- Close button -->
                <button @click="closeModal()" class="absolute -top-12 right-4 lg:right-0 text-white hover:text-gray-300 z-10 p-2">
                    <span class="material-symbols-outlined text-4xl">close</span>
                </button>

                <!-- Modal image container -->
                <div class="relative w-full flex justify-center">
                    <img 
                        :src="images[currentModalSlide]" 
                        :alt="`{{ $achievement->title }} - Image ${currentModalSlide + 1}`"
                        class="max-w-full max-h-[80vh] object-contain rounded-lg"
                    >

                    <!-- Modal navigation arrows -->
                    <button 
                        @click="prevModalImage()" 
                        class="absolute top-1/2 left-0 lg:-left-12 -translate-y-1/2 bg-button-bg-light dark:bg-button-bg-dark text-button-text-light dark:text-button-text-dark rounded-full p-3 shadow-lg hover:bg-opacity-80 transition-opacity"
                        :class="{ 'opacity-50 cursor-not-allowed': currentModalSlide === 0 }"
                        :disabled="currentModalSlide === 0"
                    >
                        <span class="material-symbols-outlined text-xl">chevron_left</span>
                    </button>
                    <button 
                        @click="nextModalImage()" 
                        class="absolute top-1/2 right-0 lg:-right-12 -translate-y-1/2 bg-button-bg-light dark:bg-button-bg-dark text-button-text-light dark:text-button-text-dark rounded-full p-3 shadow-lg hover:bg-opacity-80 transition-opacity"
                        :class="{ 'opacity-50 cursor-not-allowed': currentModalSlide === totalImages - 1 }"
                        :disabled="currentModalSlide === totalImages - 1"
                    >
                        <span class="material-symbols-outlined text-xl">chevron_right</span>
                    </button>
                </div>
                
                 <!-- Modal indicator dots -->
                <div class="flex items-center gap-2 mt-4">
                    <template x-for="(image, index) in images" :key="index">
                         <button
                            class="w-3 h-3 rounded-full transition-all duration-200"
                            :class="index === currentModalSlide ? 'bg-white' : 'bg-white/50'"
                            @click="goToModalSlide(index)"
                        ></button>
                    </template>
                </div>


                <!-- Image counter -->
                <div class="text-center text-white mt-4">
                    <span x-text="`${currentModalSlide + 1} / ${totalImages}`"></span>
                </div>
            </div>
        </div>
    </div>
</div>
