<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Anambra State Information</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
        <style>
            .map-highlight {
                fill: #fef08a;
            }
        </style>
        <script>
          tailwind.config = {
            darkMode: "class",
            theme: {
              extend: {
                colors: {
                  primary: "#facc15", // yellow-400
                  "background-light": "#f3f4f6", // gray-100
                  "background-dark": "#1f2937", // gray-800
                },
                fontFamily: {
                  display: ["Roboto", "sans-serif"],
                },
                borderRadius: {
                  DEFAULT: "1rem", // 16px
                },
              },
            },
          };
        </script>
    </head>
    <body class="font-display bg-background-light dark:bg-background-dark">
        <div class="relative min-h-screen w-full flex items-center justify-center p-4 sm:p-6 lg:p-8">
            <div class="absolute inset-0 z-0">
                <img alt="Aerial view of a city in Anambra" class="h-full w-full object-cover blur-sm" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAvwlVhyt2UbEBfP6VMV3Gjq9IJfMdCEG27imFtsRWFaBKpRJkKO2fMBm6D2kUXMk9v4P57g_o1EhCq7hKcNkLUVf_5WNPKM4Eq2PSNkkLlT-V534G52fn_7ZYFX3OYm01jFs5UZwNJjNyJ7CNnAuEKuWoYNUIkpjn6cO2v8yaxykAjNPLIsHuaXWIJVpA4af_RqWg79yNUm2EvDwl8or2KKKigNSKrkuoq1K_sDwdK9u-QteZditUNjceGl20UBS9OZzPvcVlAKpX5" />
                <div class="absolute inset-0 bg-black/50"></div>
            </div>
            <div class="relative z-10 w-full max-w-7xl rounded-2xl bg-black/40 backdrop-blur-lg p-6 sm:p-8 md:p-12 text-white shadow-2xl">
                <header class="flex flex-col sm:flex-row justify-between items-center mb-8">
                    <h1 class="text-6xl sm:text-7xl md:text-8xl font-bold tracking-wider opacity-30">ANAMBRA</h1>
                    <img alt="Anambra State Seal" class="h-16 w-16 sm:h-20 sm:w-20 mt-4 sm:mt-0" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCCSa2pnsJ_OX4IR38KZWKQINPi8zpXlixHs6t3YHpMdVPi0VXuMfWV7DAZwXLrfw_1ZyRyF5Yf9q-qeNMtAkliR7ctqolYR9R43Edvg77J8gs6m1GIzi8xNbNG5YKKp__IZzsWgUVFY23DHjmWW1KNor5ZJhRlxmtWtMNdM587nhs2y8E85xv_AwgNoXB7AjGMTN9VNgLKT03-H0oV01FGxhwd1H_hzZMri0kgUiao9YDLKnxdm1J3WWiSAYkZMUwvC7BCwFyM6QrB" />
                </header>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="flex flex-col justify-between">
                        <div>
                            <svg class="w-full h-auto" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
                                <g class="dark:fill-gray-200 text-xs text-gray-800 dark:text-gray-900 font-sans" fill="#f9fafb" stroke="black" stroke-width="2">
                                    <path class="map-highlight" d="M125.1 123.6L99 146.9l-22.1 48.6-1.8 33.3-1.8 19.8-11.4 12.2 12.2-2.7 16-16.9 14.8-11.4 15.1 4.5 9-18.3 14.2-24.8 19.5-23.7L194.2 92l-43-3.6-26.1 35.2z"></path>
                                    <text text-anchor="middle" x="95" y="165">Anambra</text>
                                    <text text-anchor="middle" x="95" y="178">West</text>
                                    <path d="M228.6 86.9l-34.4 5.1-30.8 69.1-14.2 24.8-9 18.3 18.3 11.4 17.5-12.2 30.5-5.4 14.8-31.4 10.5 11.4 34.1-15.1 13.9-63.5-31.2-18.3z"></path>
                                    <text text-anchor="middle" x="210" y="170">Anambra</text>
                                    <text text-anchor="middle" x="210" y="183">East</text>
                                    <path d="M228.6 86.9l31.2 18.3 35.5-1.5 14.2 4.5 16-20.9-46.5-28-26.4 3.9-24 23.7z"></path>
                                    <text text-anchor="middle" x="280" y="80">Ayamelum</text>
                                    <path d="M285.3 108.2l-34.1 15.1-10.5-11.4-14.8 31.4-30.5 5.4 1.8 30.5 45.4 1.8 28.3 43 32.6-18.9 2.1-41.5-1.5-37.4-18.9-18z"></path>
                                    <text text-anchor="middle" x="260" y="180">Awka</text>
                                    <text text-anchor="middle" x="260" y="193">North</text>
                                    <path d="M228.1 224.2l-45.4-1.8-1.8-30.5-17.5 12.2L148 245.8l-12.8 31.7 16 11.4 17.2-1.8 16.6-18.3 16.9 11.4 22.8 1.8 11.4-37.4-6.3-17.5 16-11.1z"></path>
                                    <text text-anchor="middle" x="195" y="240">Oyi</text>
                                    <path transform="rotate(-30 220 230)">
                                        <text text-anchor="middle" x="220" y="230">Derukota</text>
                                    </path>
                                    <path d="M148 245.8l-15.4-13.9-10.2 13.9-20.9 5.4-8.7 18.3 12.2 14.2 16 2.7 17.5-16.9 19.8-1.8 12.8-31.7z"></path>
                                    <text text-anchor="middle" x="100" y="260">Onitsha</text>
                                    <text text-anchor="middle" x="100" y="273">North</text>
                                    <path d="M216.7 259.4l-11.4 37.4-22.8-1.8-16.9-11.4-16.6 18.3-17.2 1.8-16-11.4 2.7 21.2 21.8 27.8 25.1-1.8 20.3-21.8 12.8-2.7 33.5 1.8 23.7-22.8-16.6-32.6z"></path>
                                    <text text-anchor="middle" x="190" y="295">Njikoka</text>
                                    <path d="M122.3 286.7l-12.2-14.2-16-2.7-17.5 16.9 1.8 23.7 16.9 14.5 18.3-4.5 20.3-13.6-11.7-20.1z"></path>
                                    <text text-anchor="middle" x="100" y="305">Idemili</text>
                                    <text text-anchor="middle" x="100" y="318">North</text>
                                    <path d="M309 220.1l-2.1 41.5-32.6 18.9-16 11.1 6.3 17.5 11.4 20.3 35.5-1.8 16.6 20.9 28.3 1.8 21.2-13.3 5.4-44.3-18.3-36.4-55.6-36.4z"></path>
                                    <text text-anchor="middle" x="320" y="265">Awka</text>
                                    <text text-anchor="middle" x="320" y="278">South</text>
                                    <path d="M380.5 289.8l-16.6-20.9-35.5 1.8-11.4-20.3-23.7 22.8-33.5-1.8 1.8 26.1 11.1 10.5 28.3 4.5 22.8 14.2 26.4 1.8 28.3-18.9z"></path>
                                    <text text-anchor="middle" x="330" y="325">Aguta</text>
                                    <path d="M414.8 268.3l-28.3-1.8-16.6 20.9-5.1 27.5 26.4 1.8 28.3-18.9-5.7-29.5z"></path>
                                    <text text-anchor="middle" x="400" y="275">Orumba</text>
                                    <text text-anchor="middle" x="400" y="288">North</text>
                                    <path d="M410.3 313.3l-26.4-1.8-28.3 18.9-22.8-14.2-28.3-4.5 4.5 35.8 42.1 12.2 41.2-5.4 17.5-41z"></path>
                                    <text text-anchor="middle" x="390" y="340">Orumba</text>
                                    <text text-anchor="middle" x="390" y="353">South</text>
                                    <path d="M132.2 324l-20.3 13.6-18.3 4.5-16.9-14.5-1.8-23.7 13.9 14.2 22.8-12.8 18.6-21.2 2.7 20.3-0.7 20.1z"></path>
                                    <text text-anchor="middle" x="100" y="340">Idemili</text>
                                    <text text-anchor="middle" x="100" y="353">South</text>
                                    <path d="M214.9 332.6l-1.8-26.1 33.5 1.8-12.8 2.7-20.3 21.8 1.4 20.6 13.6 12.2 16-16.3 10.5 10.5-2.7 21.2-22.8 11.4-31.7-18.3-11.1-23.7z"></path>
                                    <text text-anchor="middle" x="210" y="350">Nnewi</text>
                                    <text text-anchor="middle" x="210" y="363">South</text>
                                    <path d="M134.9 344.3l-22.8 12.8-13.9-14.2-20.3 2.7-1.8 26.4 28.3 28.3 28.9-18.6 11.7-20.3-10.8-17.1z"></path>
                                    <text text-anchor="middle" x="80" y="380">Ogbaru</text>
                                    <path d="M204.3 400.9l2.7-21.2-10.5-10.5-16 16.3-13.6-12.2-25.1 1.8-21.8-27.8 11.1 23.7 31.7 18.3 22.8-11.4z"></path>
                                    <text text-anchor="middle" x="160" y="385">Ihiala</text>
                                </g>
                            </svg>
                        </div>
                        <div class="mt-8 text-center lg:text-left">
                            <h2 class="text-3xl font-semibold text-white/90">Tap below to learn more about Anambra</h2>
                            <a class="mt-6 inline-flex items-center gap-2 rounded-full bg-primary px-6 py-3 text-sm font-bold text-gray-900 shadow-lg transition-transform hover:scale-105" href="{{ route('about') }}">
                                About Anambra
                                <span class="material-icons-outlined">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                    <div class="rounded-xl bg-white/10 p-6 sm:p-8 backdrop-blur-sm border border-white/20">
                        <h3 class="text-3xl font-bold text-white mb-4">Anambra West</h3>
                        <div class="space-y-4 text-white/80">
                            <p>
                                Ihiala is a city in Nigeria, located in the southern part of Anambra State and within the region known as Igboland.
                            </p>
                            <p>
                                It has long served as the local administrative capital of Ihiala Local Government Area. The Local Government Area has a population of about 430,800.
                            </p>
                            <p>
                               Ihiala is the largest city in Ihiala Localike Amorka, Azia, Lilu, Okija, Mbosi, Isseke, Orsumoghu, Ubuluisuzor and Uli. [3] It lies in the agricultural belt of the state. Ihiala falls under the Anambra South senatorial district in Anambra State, Nigeria.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
