@extends('layouts.app')

@section('header_title','Achievements of Anambra State')
@section('header_subtitle','Showcasing major infrastructure projects and developments')

@section('content')
    <a class="inline-flex items-center gap-2 mb-8 text-stone-700 dark:text-stone-300 hover:text-stone-900 dark:hover:text-white transition-colors" href="{{ route('achievements') }}">
        <span class="material-icons">arrow_back</span>
        <span>Return back</span>
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
        <div class="flex flex-col items-center">
            <div class="relative w-full max-w-lg">
                @php
                    $images = $achievement->images->pluck('url')->toArray();
                    $totalImages = count($images);
                @endphp

                <!-- Image Slider Container -->
                <div id="imageSlider" class="relative overflow-hidden">
                    <div id="imageTrack" class="flex transition-transform duration-300 ease-in-out">
                        @foreach($images as $index => $image)
                            <img
                                alt="{{ $achievement->title }} - Image {{ $index + 1 }}"
                                class="w-full h-auto object-cover rounded-xl shadow-lg flex-shrink-0 cursor-pointer"
                                src="{{ $image }}"
                                onclick="openModal({{ $index }})"
                            />
                        @endforeach
                    </div>
                </div>

                <!-- Navigation Arrows -->
                <button id="prevBtn" class="absolute top-1/2 left-4 -translate-y-1/2 bg-button-bg-light dark:bg-button-bg-dark text-button-text-light dark:text-button-text-dark rounded-full p-2.5 shadow-md hover:bg-opacity-80 transition-opacity z-10" onclick="previousImage()">
                    <span class="material-symbols-outlined">chevron_left</span>
                </button>
                <button id="nextBtn" class="absolute top-1/2 right-4 -translate-y-1/2 bg-button-bg-light dark:bg-button-bg-dark text-button-text-light dark:text-button-text-dark rounded-full p-2.5 shadow-md hover:bg-opacity-80 transition-opacity z-10" onclick="nextImage()">
                    <span class="material-symbols-outlined">chevron_right</span>
                </button>

                <!-- Indicator Dots -->
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2 z-10">
                    @for($i = 0; $i < $totalImages; $i++)
                        <button
                            class="w-3 h-3 rounded-full transition-all duration-200 {{ $i === 0 ? 'bg-white' : 'bg-white/50' }}"
                            onclick="goToSlide({{ $i }})"
                            id="dot-{{ $i }}"
                        ></button>
                    @endfor
                </div>
            </div>
            <p class="mt-6 text-sm text-text-light/70 dark:text-text-dark/70">Swipe to view more images</p>
        </div>
        <div class="flex flex-col justify-center">
            <h2 class="font-display text-4xl md:text-5xl font-bold mb-6">{{ $achievement->title }}</h2>
            <p class="text-base leading-relaxed text-text-light/90 dark:text-text-dark/90">
                {{ $achievement->description }}
            </p>
        </div>
    </div>

    <!-- Modal for enlarged image view -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 flex items-center justify-center z-50 hidden">
        <div class="relative max-w-4xl max-h-screen p-4">
            <!-- Close button -->
            <button onclick="closeModal()" class="absolute -top-12 right-0 text-white hover:text-gray-300 z-10">
                <span class="material-symbols-outlined text-4xl">close</span>
            </button>

            <!-- Modal image container -->
            <div class="relative">
                <img id="modalImage" class="max-w-full max-h-screen object-contain rounded-lg" src="" alt="">

                <!-- Modal navigation arrows -->
                <button id="modalPrevBtn" onclick="modalPreviousImage()" class="absolute top-1/2 left-4 -translate-y-1/2 bg-button-bg-light dark:bg-button-bg-dark text-button-text-light dark:text-button-text-dark rounded-full p-3 shadow-lg hover:bg-opacity-80 transition-opacity">
                    <span class="material-symbols-outlined text-xl">chevron_left</span>
                </button>
                <button id="modalNextBtn" onclick="modalNextImage()" class="absolute top-1/2 right-4 -translate-y-1/2 bg-button-bg-light dark:bg-button-bg-dark text-button-text-light dark:text-button-text-dark rounded-full p-3 shadow-lg hover:bg-opacity-80 transition-opacity">
                    <span class="material-symbols-outlined text-xl">chevron_right</span>
                </button>

                <!-- Modal indicator dots -->
                <div id="modalDots" class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2">
                    <!-- Dots will be dynamically generated -->
                </div>
            </div>

            <!-- Image counter -->
            <div class="text-center text-white mt-4">
                <span id="imageCounter">1 / {{ $totalImages }}</span>
            </div>
        </div>
    </div>

    <script>
        // Image slider variables
        let currentSlide = 0;
        let currentModalSlide = 0;
        const images = @json($images);
        const totalImages = images.length;

        // Initialize the slider
        function initSlider() {
            updateSliderPosition();
            updateDots();
            updateNavigationButtons();
        }

        // Update slider position
        function updateSliderPosition() {
            const track = document.getElementById('imageTrack');
            track.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        // Update indicator dots
        function updateDots() {
            for (let i = 0; i < totalImages; i++) {
                const dot = document.getElementById(`dot-${i}`);
                if (dot) {
                    if (i === currentSlide) {
                        dot.className = 'w-3 h-3 rounded-full transition-all duration-200 bg-white';
                    } else {
                        dot.className = 'w-3 h-3 rounded-full transition-all duration-200 bg-white/50';
                    }
                }
            }
        }

        // Update navigation buttons visibility
        function updateNavigationButtons() {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            prevBtn.style.opacity = currentSlide === 0 ? '0.5' : '1';
            nextBtn.style.opacity = currentSlide === totalImages - 1 ? '0.5' : '1';
        }

        // Navigation functions
        function nextImage() {
            if (currentSlide < totalImages - 1) {
                currentSlide++;
                updateSliderPosition();
                updateDots();
                updateNavigationButtons();
            }
        }

        function previousImage() {
            if (currentSlide > 0) {
                currentSlide--;
                updateSliderPosition();
                updateDots();
                updateNavigationButtons();
            }
        }

        function goToSlide(index) {
            currentSlide = index;
            updateSliderPosition();
            updateDots();
            updateNavigationButtons();
        }

        // Modal functions
        function openModal(imageIndex) {
            currentModalSlide = imageIndex;
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');

            modal.classList.remove('hidden');
            modalImage.src = images[currentModalSlide];
            modalImage.alt = `{{ $achievement->title }} - Image ${currentModalSlide + 1}`;

            updateModalDots();
            updateModalCounter();
            updateModalNavigation();
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto'; // Restore scrolling
        }

        function modalNextImage() {
            if (currentModalSlide < totalImages - 1) {
                currentModalSlide++;
                const modalImage = document.getElementById('modalImage');
                modalImage.src = images[currentModalSlide];
                modalImage.alt = `{{ $achievement->title }} - Image ${currentModalSlide + 1}`;
                updateModalDots();
                updateModalCounter();
                updateModalNavigation();
            }
        }

        function modalPreviousImage() {
            if (currentModalSlide > 0) {
                currentModalSlide--;
                const modalImage = document.getElementById('modalImage');
                modalImage.src = images[currentModalSlide];
                modalImage.alt = `{{ $achievement->title }} - Image ${currentModalSlide + 1}`;
                updateModalDots();
                updateModalCounter();
                updateModalNavigation();
            }
        }

        function updateModalDots() {
            const modalDots = document.getElementById('modalDots');
            modalDots.innerHTML = '';

            for (let i = 0; i < totalImages; i++) {
                const dot = document.createElement('button');
                dot.className = `w-3 h-3 rounded-full transition-all duration-200 ${i === currentModalSlide ? 'bg-white' : 'bg-white/50'}`;
                dot.onclick = () => goToModalSlide(i);
                modalDots.appendChild(dot);
            }
        }

        function goToModalSlide(index) {
            currentModalSlide = index;
            const modalImage = document.getElementById('modalImage');
            modalImage.src = images[currentModalSlide];
            modalImage.alt = `{{ $achievement->title }} - Image ${currentModalSlide + 1}`;
            updateModalDots();
            updateModalCounter();
            updateModalNavigation();
        }

        function updateModalCounter() {
            const counter = document.getElementById('imageCounter');
            counter.textContent = `${currentModalSlide + 1} / ${totalImages}`;
        }

        function updateModalNavigation() {
            const modalPrevBtn = document.getElementById('modalPrevBtn');
            const modalNextBtn = document.getElementById('modalNextBtn');

            modalPrevBtn.style.opacity = currentModalSlide === 0 ? '0.5' : '1';
            modalNextBtn.style.opacity = currentModalSlide === totalImages - 1 ? '0.5' : '1';
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            const modal = document.getElementById('imageModal');
            const isModalOpen = !modal.classList.contains('hidden');

            if (isModalOpen) {
                switch(e.key) {
                    case 'ArrowLeft':
                        e.preventDefault();
                        modalPreviousImage();
                        break;
                    case 'ArrowRight':
                        e.preventDefault();
                        modalNextImage();
                        break;
                    case 'Escape':
                        e.preventDefault();
                        closeModal();
                        break;
                }
            } else {
                switch(e.key) {
                    case 'ArrowLeft':
                        e.preventDefault();
                        previousImage();
                        break;
                    case 'ArrowRight':
                        e.preventDefault();
                        nextImage();
                        break;
                }
            }
        });

        // Close modal when clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Initialize slider on page load
        document.addEventListener('DOMContentLoaded', function() {
            initSlider();
        });
    </script>
@endsection
