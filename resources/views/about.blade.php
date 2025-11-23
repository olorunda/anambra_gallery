@extends('layouts.app')

@section('header_title','Explore Anambra State')
@section('header_subtitle','Select what aspect of Anambra State you wish to explore')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <a class="group block overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300" href="{{route('executive-council')}}">
                    <div class="relative">
                        <img alt="Anambra State Executive Council members posing for a photo" class="w-full min-h-[600px] object-cover group-hover:scale-105 transition-transform duration-300" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDBQSyFQcwXbnoEshEdFM35g4dBQEEv18z1dXhQllVRo49EEv3nSaWJ_Fve2yi11G_mfLm0rQ0n1G7Yr4gNSIbpFOle7kfG6X6zbqSOgZ2tCYeUUt6KdeEzLcZhplhLjxA7RKm1NrP-Dd2HIsvm8KTzauHMf3FShPWsc50STkcn9R58KxG9ug_gAJ9pBBWOXTyAR4Qb3Dv9oIjVw5pwNILjPes0r2_Vba3Vw2WNcxBLPY0LSwyGgrzaL7F1x3RLcIH8EiikgPMr5xeP"/>
                        <div class="absolute bottom-0 left-0 w-full h-2/3 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6 text-white">
                            <h2 class="font-display text-2xl font-bold mb-1">Anambra State Executive Council</h2>
                            <p class="text-gray-200">Lorem ipsum dolor sit amet consectetur. Est tempus.</p>
                        </div>
                    </div>
                </a>
                <a class="group block overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300" href="{{ route('achievements') }}">
                    <div class="relative">
                        <img alt="A modern building under construction in Anambra State" class="w-full min-h-[600px] object-cover group-hover:scale-105 transition-transform duration-300" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC9zqCyfDw9IwtB106oy8avXFTx9obWrPfXAzvQbBbkiGHUkWXwPLROYrtwznKg9eMkliyaP4uUc9Bn2ES0fGPMMed65FkLr_LRVqtvpeJ2lwipR3PTLUH149UXe-0atWjuU_S4NrXjDHzgyLMWkrNEWQPMeMiairDbAKTt072TiEy1Hkf5IocA9NbwAOeaADt_UDo8VK5-s3sWp5ktB9dbAjhMUzdWNZ8KmZVQ_60kycKMMMAnJ3IGD3GnPisVvo-XJx_7tmMu-I5U"/>
                        <div class="absolute bottom-0 left-0 w-full h-2/3 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6 text-white">
                            <h2 class="font-display text-2xl font-bold mb-1">Achievements</h2>
                            <p class="text-gray-200">Lorem ipsum dolor sit amet consectetur. Est tempus.</p>
                        </div>
                    </div>
                </a>
                <a class="group block overflow-hidden rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300" href="{{ route('history-culture') }}">
                    <div class="relative">
                        <img alt="Two ornate, traditional Igbo pottery vases" class="w-full min-h-[600px] object-cover group-hover:scale-105 transition-transform duration-300" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD4gzp2T9wI4Mfcevr_XgQ0NqSUVTYzsEvuwbtP41T7SdsIr-LqKdjO8viCTW1jxxp4D3UCrMc-YhBTroKeaoEuYc-tkIeCzb9479QM9W-0A8gC-1lIbt1ss67bQGH-MGgi9tWARah7T2a5J19QDnYTrQL1HU-w2AyDoZSdSRmDGl9rQZk_z2l79tfyw1WtG0AdwLukp1tox_WQn5d4q1_I-tZR35ed277E-IdWzlh8HmK3VKNfGxGYh9dw4DwcjGFLuwpMFCQu60Kp"/>
                        <div class="absolute bottom-0 left-0 w-full h-2/3 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6 text-white">
                            <h2 class="font-display text-2xl font-bold mb-1">History & Culture</h2>
                            <p class="text-gray-200">Lorem ipsum dolor sit amet consectetur. Est tempus.</p>
                        </div>
                    </div>
                </a>
            </div>
@endsection
