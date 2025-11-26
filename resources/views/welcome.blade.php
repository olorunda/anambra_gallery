<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Anambra State Information</title>

        <!-- PWA Meta Tags -->
        <meta name="theme-color" content="#1f2937">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="apple-mobile-web-app-title" content="Anambra Gallery">
        <meta name="msapplication-TileColor" content="#1f2937">
        <meta name="msapplication-tap-highlight" content="no">

        <!-- PWA Manifest -->
        <link rel="manifest" href="/manifest.json">

        <!-- Icons -->
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
        <script src="{{asset('imageMapResizer.min.js')}}"></script>

        <style>
            .map-highlight {
                fill: #fef08a;
            }

            /* Image map area styling */
            area {
                cursor: pointer;
                transition: all 0.3s ease;
            }

            /* Create overlay for visual effects */
            .map-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
                z-index: 10;
            }

            .map-container {
                position: relative;
                display: inline-block;
            }

            /* Hover effect overlay */
            .area-hover-overlay {
                position: absolute;
                background-color: rgba(250, 204, 21, 0.3); /* primary color with transparency */
                border: 2px solid #facc15;
                border-radius: 4px;
                pointer-events: none;
                opacity: 0;
                transition: opacity 0.2s ease-in-out;
                z-index: 5;
            }

            /* Selected effect overlay */
            .area-selected-overlay {
                position: absolute;
                background-color: rgba(250, 204, 21, 0.5); /* primary color with more opacity */
                border: 3px solid #facc15;
                border-radius: 4px;
                pointer-events: none;
                opacity: 0;
                transition: opacity 0.3s ease-in-out;
                z-index: 6;
                box-shadow: 0 0 10px rgba(250, 204, 21, 0.6);
            }

            /* Active states */
            .area-hover-overlay.active {
                opacity: 1;
            }

            .area-selected-overlay.active {
                opacity: 1;
            }

            /* Pulse animation for selected areas */
            .area-selected-overlay.active {
                animation: pulse-glow 2s infinite;
            }

            @keyframes pulse-glow {
                0%, 100% {
                    box-shadow: 0 0 10px rgba(250, 204, 21, 0.6);
                }
                50% {
                    box-shadow: 0 0 20px rgba(250, 204, 21, 0.8);
                }
            }

            /* Call-to-action effects */
            .map-cta-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
                z-index: 2;
                background: radial-gradient(circle, transparent 60%, rgba(250, 204, 21, 0.1) 100%);
                animation: subtle-pulse 3s infinite;
            }

            .map-instruction {
                position: absolute;
                top: -40px;
                left: 50%;
                transform: translateX(-50%);
                background: rgba(250, 204, 21, 0.9);
                color: #1f2937;
                padding: 8px 16px;
                border-radius: 20px;
                font-size: 14px;
                font-weight: 600;
                white-space: nowrap;
                animation: bounce-fade 4s infinite;
                z-index: 15;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            }

            .map-instruction::after {
                content: '';
                position: absolute;
                top: 100%;
                left: 50%;
                transform: translateX(-50%);
                width: 0;
                height: 0;
                border-left: 8px solid transparent;
                border-right: 8px solid transparent;
                border-top: 8px solid rgba(250, 204, 21, 0.9);
            }

            .map-border-glow {
                position: absolute;
                top: -4px;
                left: -4px;
                right: -4px;
                bottom: -4px;
                border: 2px solid rgba(250, 204, 21, 0.4);
                border-radius: 12px;
                pointer-events: none;
                z-index: 3;
                animation: border-pulse 2.5s infinite;
            }

            @keyframes subtle-pulse {
                0%, 100% {
                    opacity: 0.3;
                    transform: scale(1);
                }
                50% {
                    opacity: 0.6;
                    transform: scale(1.02);
                }
            }

            @keyframes bounce-fade {
                0%, 20%, 50%, 80%, 100% {
                    transform: translateX(-50%) translateY(0);
                    opacity: 0.8;
                }
                10% {
                    transform: translateX(-50%) translateY(-5px);
                    opacity: 1;
                }
                40% {
                    transform: translateX(-50%) translateY(-3px);
                    opacity: 0.9;
                }
            }

            @keyframes border-pulse {
                0%, 100% {
                    border-color: rgba(250, 204, 21, 0.2);
                    box-shadow: 0 0 0 0 rgba(250, 204, 21, 0.4);
                }
                50% {
                    border-color: rgba(250, 204, 21, 0.6);
                    box-shadow: 0 0 0 4px rgba(250, 204, 21, 0.1);
                }
            }

            /* Hide call-to-action after first interaction */
            .map-container.interacted .map-cta-overlay,
            .map-container.interacted .map-instruction,
            .map-container.interacted .map-border-glow {
                display: none;
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

        <!-- Service Worker Registration -->
        <script>
        if ('serviceWorker' in navigator) {
          window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js')
              .then((registration) => {
                console.log('[SW] Service Worker registered successfully:', registration.scope);

                // Handle updates
                registration.addEventListener('updatefound', () => {
                  const newWorker = registration.installing;
                  newWorker.addEventListener('statechange', () => {
                    if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                      // New content is available, refresh the page
                      console.log('[SW] New content available, reloading...');
                      window.location.reload();
                    }
                  });
                });
              })
              .catch((error) => {
                console.log('[SW] Service Worker registration failed:', error);
              });
          });

          // Listen for messages from service worker
          navigator.serviceWorker.addEventListener('message', (event) => {
            if (event.data && event.data.type === 'SW_UPDATE') {
              window.location.reload();
            }
          });
        }
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
                    <img src="{{asset('img_1.png')}}" >
                    <!-- Image Map Generated by http://www.image-map.net/ -->
                    <map name="image-map">
                        <area target="" alt="Ayamelum" title="Ayamelum" href="http://ayamelum" coords="619,8,581,41,570,92,551,130,527,202,488,244,465,329,566,288,598,258,623,320,651,350,673,328,757,291,792,233,803,129,888,107,951,53,969,11" shape="poly">
                        <area target="" alt="Anambra East" title="Anambra East" href="http://anambra.east" coords="595,278,451,347,426,427,368,471,332,530,280,576,279,662,366,676,372,627,436,561,480,522,535,501,638,481,647,426,625,388,651,363,621,341" shape="poly">
                        <area target="" alt="Oyi" title="Oyi" href="http://oyi" coords="639,493,547,505,514,525,478,531,376,643,373,733,383,745,554,696,600,651" shape="poly">
                        <area target="" alt="Derukota" title="Derukota" href="http://derukota" coords="648,490,627,570,606,651,563,702,571,708,627,663,721,606,711,554" shape="poly">
                        <area target="" alt="Awka North" title="Awka North" href="http://awka.north" coords="762,302,664,358,632,386,654,418,648,482,717,547,725,600,794,596,824,575,883,589,972,619,977,567,976,548,1023,529,994,512,971,454,933,391,887,339" shape="poly">
                        <area target="" alt="Awka South" title="Awka South" href="http://awka.south" coords="743,614,804,601,839,588,906,608,978,630,994,669,990,691,1003,708,951,763,906,802,858,811,820,784,781,758,782,702" shape="poly">
                        <area target="" alt="Nijikoka" title="Nijikoka" href="http://nijikoka" coords="723,611,577,713,614,732,639,766,665,786,708,789,729,774,733,747,772,742,773,690,741,636,738,617" shape="poly">
                        <area target="" alt="Onisha North" title="Onisha North" href="http://onisha.north" coords="246,702,284,680,366,687,367,735,373,747,370,769,324,795,321,811,308,811,294,786,232,780,226,771" shape="poly">
                        <area target="" alt="Beside Onisha North" title="Beside Onisha North" href="http://beside_onisha" coords="221,779,180,859,264,866,274,825,289,795" shape="poly">
                        <area target="" alt="Ogbaru" title="Ogbaru" href="http://ogbaru" coords="182,875,267,875,331,1025,325,1043,353,1082,323,1148,272,1185,291,1313,273,1351,12,1351,30,1337,38,1293,39,1236,112,1145,146,1060,167,1007,160,924" shape="poly">
                        <area target="" alt="Idemili North" title="Idemili North" href="http://idemili.north" coords="383,754,556,703,577,721,626,752,659,796,665,827,530,839,512,827,464,828,328,810,336,796,376,778" shape="poly">
                        <area target="" alt="Idemili South" title="Idemili South" href="http://idemili.south" coords="294,797,286,825,271,849,275,871,322,906,382,916,445,901,502,869,579,943,628,950,663,848,663,836,531,844,508,834,461,836,329,816,302,818" shape="poly">
                        <area target="" alt="Anambra West" title="Anambra West" href="http://anambra.west" coords="87,129,170,136,252,107,321,98,361,80,374,48,380,9,609,4,576,36,566,81,543,84,521,118,544,132,540,143,531,145,520,198,497,206,481,231,474,284,448,329,433,367,435,392,410,421,360,462,323,525,280,554,270,576,262,612,275,674,243,694,221,642,196,602,188,539,180,474,177,427,142,327,145,249,137,207" shape="poly">
                        <area target="" alt="Ihiala" title="Ihiala" href="http://ihiala" coords="354,1089,324,1154,279,1191,297,1311,281,1354,431,1352,449,1294,671,1185,668,1163,604,1146,474,1117,478,1157,455,1167,405,1135" shape="poly">
                        <area target="" alt="Orumba North" title="Orumba North" href="http:/orumba.north" coords="996,658,1001,678,997,694,1010,709,959,770,909,811,860,820,797,892,905,919,952,986,1063,938,1226,930,1211,898,1215,874,1190,840,1145,808,1128,777,1134,738,1139,719,1104,687,1079,646,1057,661" shape="poly">
                        <area target="" alt="Orumba South" title="Orunmba SOuth" href="http:/orumba.south" coords="1340,989,1302,955,1257,944,1235,935,1069,942,956,994,985,1056,1003,1091,1023,1116,1054,1120,1092,1142,1105,1140,1145,1140,1190,1153,1190,1087,1197,1046,1229,1011,1302,999" shape="poly">
                        <area target="" alt="Nnewi South" title="Nnewi South" href="http://nnewi.south" coords="501,877,449,905,451,941,435,1008,442,1070,469,1103,538,1055,583,992,601,956,579,950" shape="poly">
                        <area target="" alt="Aguta" title="Aguta" href="http://aguta" coords="793,900,901,925,949,990,988,1074,1020,1123,1048,1131,1088,1150,1102,1150,1077,1177,1053,1184,956,1144,868,1113,826,1108,803,1110,819,1062,779,1028,681,995,665,966,689,963,708,942,743,937" shape="poly">
                        <area target="" alt="Nnewi South" title="Nnewi South" href="http://nnewi.south2" coords="606,956,563,1039,475,1103,577,1133,604,1140,670,1152,791,1113,811,1060,756,1030,681,1001,657,968" shape="poly">
                        <area target="" alt="Beside Awka South" title="Beside Awka South" href="http://beside.awka.south" coords="665,797,671,830,670,844,648,900,634,952,659,960,684,954,698,937,740,929,788,893,849,818,817,788,776,766,773,752,737,759,734,779,715,797" shape="poly">
                        <area target="" alt="Beside Udemili South" title="Beside Udemili South" href="http://beside.udemili.south" coords="277,885,311,907,375,925,439,910,443,937,432,996,431,1050,444,1085,464,1106,473,1152,455,1159,402,1127,357,1084,332,1042,337,1028" shape="poly">
                    </map>

                </header>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="flex flex-col justify-between">
                        <div class="map-container">
                            <!-- Image Map Generated by http://www.image-map.net/ -->
                            <img src="{{asset('img.png')}}" usemap="#image-map" id="anambra-map">
                            <!-- Call-to-action elements -->
                            <div class="map-cta-overlay"></div>
                            <div class="map-instruction">Click on any area to explore</div>
                            <div class="map-border-glow"></div>
                            <!-- Interactive overlays -->
                            <div class="map-overlay">
                                <div class="area-hover-overlay" id="hover-overlay"></div>
                                <div class="area-selected-overlay" id="selected-overlay"></div>
                            </div>

                            <map name="image-map">
                                <area target="" alt="Ayamelum" title="Ayamelum" href="http://ayamelum" coords="619,8,581,41,570,92,551,130,527,202,488,244,465,329,566,288,598,258,623,320,651,350,673,328,757,291,792,233,803,129,888,107,951,53,969,11" shape="poly">
                                <area target="" alt="Anambra East" title="Anambra East" href="http://anambra.east" coords="595,278,451,347,426,427,368,471,332,530,280,576,279,662,366,676,372,627,436,561,480,522,535,501,638,481,647,426,625,388,651,363,621,341" shape="poly">
                                <area target="" alt="Oyi" title="Oyi" href="http://oyi" coords="639,493,547,505,514,525,478,531,376,643,373,733,383,745,554,696,600,651" shape="poly">
                                <area target="" alt="Derukota" title="Derukota" href="http://derukota" coords="648,490,627,570,606,651,563,702,571,708,627,663,721,606,711,554" shape="poly">
                                <area target="" alt="Awka North" title="Awka North" href="http://awka.north" coords="762,302,664,358,632,386,654,418,648,482,717,547,725,600,794,596,824,575,883,589,972,619,977,567,976,548,1023,529,994,512,971,454,933,391,887,339" shape="poly">
                                <area target="" alt="Awka South" title="Awka South" href="http://awka.south" coords="743,614,804,601,839,588,906,608,978,630,994,669,990,691,1003,708,951,763,906,802,858,811,820,784,781,758,782,702" shape="poly">
                                <area target="" alt="Nijikoka" title="Nijikoka" href="http://nijikoka" coords="723,611,577,713,614,732,639,766,665,786,708,789,729,774,733,747,772,742,773,690,741,636,738,617" shape="poly">
                                <area target="" alt="Onisha North" title="Onisha North" href="http://onisha.north" coords="246,702,284,680,366,687,367,735,373,747,370,769,324,795,321,811,308,811,294,786,232,780,226,771" shape="poly">
                                <area target="" alt="Beside Onisha North" title="Beside Onisha North" href="http://beside_onisha" coords="221,779,180,859,264,866,274,825,289,795" shape="poly">
                                <area target="" alt="Ogbaru" title="Ogbaru" href="http://ogbaru" coords="182,875,267,875,331,1025,325,1043,353,1082,323,1148,272,1185,291,1313,273,1351,12,1351,30,1337,38,1293,39,1236,112,1145,146,1060,167,1007,160,924" shape="poly">
                                <area target="" alt="Idemili North" title="Idemili North" href="http://idemili.north" coords="383,754,556,703,577,721,626,752,659,796,665,827,530,839,512,827,464,828,328,810,336,796,376,778" shape="poly">
                                <area target="" alt="Idemili South" title="Idemili South" href="http://idemili.south" coords="294,797,286,825,271,849,275,871,322,906,382,916,445,901,502,869,579,943,628,950,663,848,663,836,531,844,508,834,461,836,329,816,302,818" shape="poly">
                                <area target="" alt="Anambra West" title="Anambra West" href="http://anambra.west" coords="87,129,170,136,252,107,321,98,361,80,374,48,380,9,609,4,576,36,566,81,543,84,521,118,544,132,540,143,531,145,520,198,497,206,481,231,474,284,448,329,433,367,435,392,410,421,360,462,323,525,280,554,270,576,262,612,275,674,243,694,221,642,196,602,188,539,180,474,177,427,142,327,145,249,137,207" shape="poly">
                                <area target="" alt="Ihiala" title="Ihiala" href="http://ihiala" coords="354,1089,324,1154,279,1191,297,1311,281,1354,431,1352,449,1294,671,1185,668,1163,604,1146,474,1117,478,1157,455,1167,405,1135" shape="poly">
                                <area target="" alt="Orumba North" title="Orumba North" href="http://orumba.north" coords="996,658,1001,678,997,694,1010,709,959,770,909,811,860,820,797,892,905,919,952,986,1063,938,1226,930,1211,898,1215,874,1190,840,1145,808,1128,777,1134,738,1139,719,1104,687,1079,646,1057,661" shape="poly">
                                <area target="" alt="Orumba South" title="Orumba South" href="http://orumba.south" coords="1340,989,1302,955,1257,944,1235,935,1069,942,956,994,985,1056,1003,1091,1023,1116,1054,1120,1092,1142,1105,1140,1145,1140,1190,1153,1190,1087,1197,1046,1229,1011,1302,999" shape="poly">
                                <area target="" alt="Nnewi South" title="Nnewi South" href="http://nnewi.south" coords="501,877,449,905,451,941,435,1008,442,1070,469,1103,538,1055,583,992,601,956,579,950" shape="poly">
                                <area target="" alt="Aguta" title="Aguta" href="http://aguta" coords="793,900,901,925,949,990,988,1074,1020,1123,1048,1131,1088,1150,1102,1150,1077,1177,1053,1184,956,1144,868,1113,826,1108,803,1110,819,1062,779,1028,681,995,665,966,689,963,708,942,743,937" shape="poly">
                                <area target="" alt="Nnewi South" title="Nnewi South" href="http://nnewi.south2" coords="606,956,563,1039,475,1103,577,1133,604,1140,670,1152,791,1113,811,1060,756,1030,681,1001,657,968" shape="poly">
                                <area target="" alt="Beside Awka South" title="Beside Awka South" href="http://beside.awka.south" coords="665,797,671,830,670,844,648,900,634,952,659,960,684,954,698,937,740,929,788,893,849,818,817,788,776,766,773,752,737,759,734,779,715,797" shape="poly">
                                <area target="" alt="Beside Udemili South" title="Beside Udemili South" href="http://beside.udemili.south" coords="277,885,311,907,375,925,439,910,443,937,432,996,431,1050,444,1085,464,1106,473,1152,455,1159,402,1127,357,1084,332,1042,337,1028" shape="poly">
                            </map>
                    </div>
                        <div class="mt-8 text-center lg:text-left">
                            <h2 class="text-3xl font-semibold text-white/90">Tap below to learn more about Anambra</h2>
                            <a class="mt-6 inline-flex items-center gap-2 rounded-full bg-primary px-6 py-3 text-sm font-bold text-gray-900 shadow-lg transition-transform hover:scale-105" href="{{ route('about') }}">
                                About Anambra
                                <span class="material-icons-outlined">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                    <div class="area-description rounded-xl bg-white/10 p-6 sm:p-8 backdrop-blur-sm border border-white/20">
                        <h3 class="text-3xl font-bold text-white mb-4">Anambra West</h3>
                        <div class="space-y-4 text-white/80">
                            <p>
                                Anambra West is a Local Government Area in Anambra State, Nigeria. It is located in the western part of the state and is known for its agricultural activities and riverine communities along the Niger River.
                            </p>
                            <p class="text-sm text-white/60 italic">
                                Click on any area of the map above to learn more about different local government areas in Anambra State.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Area descriptions data
            const areaDescriptions = {
                'ayamelum': {
                    title: 'Ayamelum',
                    description: 'Ayamelum is a Local Government Area in Anambra State, Nigeria. It is known for its agricultural activities and is one of the newer local government areas in the state. The area is predominantly rural with farming as the main economic activity.'
                },
                'anambra-east': {
                    title: 'Anambra East',
                    description: 'Anambra East is a Local Government Area in Anambra State, Nigeria. It is home to several communities and is known for its rich cultural heritage. The area has significant agricultural potential and is developing rapidly.'
                },
                'oyi': {
                    title: 'Oyi',
                    description: 'Oyi is a Local Government Area in Anambra State, Nigeria. It is an important area for agriculture and has several communities that contribute to the state\'s economy. The area is known for its peaceful environment.'
                },
                'awka-north': {
                    title: 'Awka North',
                    description: 'Awka North is a Local Government Area in Anambra State, Nigeria. It is part of the greater Awka area and serves as an important administrative region. The area is known for its educational institutions and urban development.'
                },
                'awka-south': {
                    title: 'Awka South',
                    description: 'Awka South is a Local Government Area in Anambra State, Nigeria. It contains part of Awka, the state capital, and is a major administrative and commercial center. The area is highly developed with modern infrastructure.'
                },
                'nijikoka': {
                    title: 'Njikoka',
                    description: 'Njikoka is a Local Government Area in Anambra State, Nigeria. It is known for its educational institutions and residential areas. The area has a mix of urban and rural communities.'
                },
                'onisha-north': {
                    title: 'Onitsha North',
                    description: 'Onitsha North is a Local Government Area in Anambra State, Nigeria. It is part of the commercial hub of Onitsha and contains the famous Onitsha Main Market, one of the largest markets in West Africa.'
                },
                'ogbaru': {
                    title: 'Ogbaru',
                    description: 'Ogbaru is a Local Government Area in Anambra State, Nigeria. It is located along the Niger River and is known for its fishing and agricultural activities. The area has several riverine communities.'
                },
                'idemili-north': {
                    title: 'Idemili North',
                    description: 'Idemili North is a Local Government Area in Anambra State, Nigeria. It is an important commercial and residential area with several towns and communities. The area is known for its business activities.'
                },
                'idemili-south': {
                    title: 'Idemili South',
                    description: 'Idemili South is a Local Government Area in Anambra State, Nigeria. It includes several important towns and is known for its commercial activities and cultural heritage.'
                },
                'anambra-west': {
                    title: 'Anambra West',
                    description: 'Anambra West is a Local Government Area in Anambra State, Nigeria. It is located in the western part of the state and is known for its agricultural activities and riverine communities along the Niger River.'
                },
                'ihiala': {
                    title: 'Ihiala',
                    description: 'Ihiala is a city in Nigeria, located in the southern part of Anambra State and within the region known as Igboland. It has long served as the local administrative capital of Ihiala Local Government Area. The Local Government Area has a population of about 430,800. Ihiala is the largest city in Ihiala Local Government Area which includes towns like Amorka, Azia, Lilu, Okija, Mbosi, Isseke, Orsumoghu, Ubuluisuzor and Uli. It lies in the agricultural belt of the state. Ihiala falls under the Anambra South senatorial district in Anambra State, Nigeria.'
                },
                'orumba-north': {
                    title: 'Orumba North',
                    description: 'Orumba North is a Local Government Area in Anambra State, Nigeria. It is known for its agricultural activities and traditional communities. The area has several towns and villages with rich cultural heritage.'
                },
                'orumba-south': {
                    title: 'Orumba South',
                    description: 'Orumba South is a Local Government Area in Anambra State, Nigeria. It is primarily an agricultural area with several communities engaged in farming activities. The area is known for its peaceful environment.'
                },
                'nnewi-south': {
                    title: 'Nnewi South',
                    description: 'Nnewi South is a Local Government Area in Anambra State, Nigeria. It is part of the greater Nnewi area, which is known as an industrial and commercial hub. The area contributes significantly to the state\'s economy.'
                },
                'aguta': {
                    title: 'Aguata',
                    description: 'Aguata is a Local Government Area in Anambra State, Nigeria. It is one of the largest local government areas in the state and includes several important towns. The area is known for its commercial activities and cultural significance.'
                },
                'derukota': {
                    title: 'Derukota',
                    description: 'Derukota is a Local Government Area in Anambra State, Nigeria. It is one of the largest local government areas in the state and includes several important towns. The area is known for its commercial activities and cultural significance.'
                }
            };

            function updateAreaDescription(areaKey) {
                const area = areaDescriptions[areaKey];
                if (area) {
                    const titleElement = document.querySelector('.area-description h3');
                    const descriptionContainer = document.querySelector('.area-description .space-y-4');

                    if (titleElement && descriptionContainer) {
                        titleElement.textContent = area.title;
                        descriptionContainer.innerHTML = '<p>' + area.description + '</p>';
                    }
                }
            }

            // Global variables for tracking state
            let currentSelectedArea = null;
            let hoverOverlay = null;
            let selectedOverlay = null;

            // Function to calculate bounding box from polygon coordinates
            function getPolygonBounds(coords) {
                const points = coords.split(',').map(Number);
                let minX = Infinity, minY = Infinity, maxX = -Infinity, maxY = -Infinity;

                for (let i = 0; i < points.length; i += 2) {
                    const x = points[i];
                    const y = points[i + 1];
                    minX = Math.min(minX, x);
                    maxX = Math.max(maxX, x);
                    minY = Math.min(minY, y);
                    maxY = Math.max(maxY, y);
                }

                return { minX, minY, maxX, maxY, width: maxX - minX, height: maxY - minY };
            }

            // Function to create clip-path from polygon coordinates
            function createPolygonClipPath(coords, bounds) {
                const points = coords.split(',').map(Number);
                const clipPathPoints = [];

                for (let i = 0; i < points.length; i += 2) {
                    const x = points[i];
                    const y = points[i + 1];
                    // Convert coordinates to percentage relative to bounding box
                    const xPercent = ((x - bounds.minX) / bounds.width) * 100;
                    const yPercent = ((y - bounds.minY) / bounds.height) * 100;
                    clipPathPoints.push(`${xPercent}% ${yPercent}%`);
                }

                return `polygon(${clipPathPoints.join(', ')})`;
            }

            // Function to position overlay on area
            function positionOverlay(overlay, area, mapImg) {
                const coords = area.getAttribute('coords');
                const shape = area.getAttribute('shape');

                if (shape === 'poly' && coords) {
                    const bounds = getPolygonBounds(coords);
                    const mapRect = mapImg.getBoundingClientRect();
                    const mapContainer = mapImg.parentElement;

                    // Use the already scaled coordinates from imageMapResizer
                    // The imageMapResizer library has already updated the coords to match the current image size
                    // So we can use them directly without additional scaling
                    overlay.style.left = bounds.minX + 'px';
                    overlay.style.top = bounds.minY + 'px';
                    overlay.style.width = bounds.width + 'px';
                    overlay.style.height = bounds.height + 'px';

                    // Create and apply the polygon clip-path to match the exact shape
                    const clipPath = createPolygonClipPath(coords, bounds);
                    overlay.style.clipPath = clipPath;
                    overlay.style.webkitClipPath = clipPath; // For older browsers
                }
            }

            // Function to show hover effect
            function showHoverEffect(area) {
                if (!hoverOverlay) return;

                const mapImg = document.getElementById('anambra-map');
                if (mapImg && mapImg.complete) {
                    positionOverlay(hoverOverlay, area, mapImg);
                    hoverOverlay.classList.add('active');
                }
            }

            // Function to hide hover effect
            function hideHoverEffect() {
                if (hoverOverlay) {
                    hoverOverlay.classList.remove('active');
                }
            }

            // Function to show selected effect
            function showSelectedEffect(area) {
                if (!selectedOverlay) return;

                // Remove previous selection
                if (currentSelectedArea) {
                    selectedOverlay.classList.remove('active');
                }

                const mapImg = document.getElementById('anambra-map');
                if (mapImg && mapImg.complete) {
                    positionOverlay(selectedOverlay, area, mapImg);
                    selectedOverlay.classList.add('active');
                    currentSelectedArea = area;
                }
            }

            function setupImageMapListeners() {
                // Get overlay elements
                hoverOverlay = document.getElementById('hover-overlay');
                selectedOverlay = document.getElementById('selected-overlay');

                const areas = document.querySelectorAll('area');
                const mapContainer = document.querySelector('.map-container');

                areas.forEach(area => {
                    // Click handler
                    area.addEventListener('click', function(e) {
                        e.preventDefault();
                        // Hide call-to-action effects after first interaction
                        if (mapContainer) {
                            mapContainer.classList.add('interacted');
                        }
                        const alt = this.getAttribute('alt');
                        const areaKey = alt.toLowerCase().replace(/\s+/g, '-');
                        updateAreaDescription(areaKey);
                        showSelectedEffect(this);
                    });

                    // Mouse enter handler
                    area.addEventListener('mouseenter', function() {
                        // Hide call-to-action effects on first hover too
                        if (mapContainer && !mapContainer.classList.contains('interacted')) {
                            mapContainer.classList.add('interacted');
                        }
                        showHoverEffect(this);
                    });

                    // Mouse leave handler
                    area.addEventListener('mouseleave', function() {
                        hideHoverEffect();
                    });
                });

                // Handle window resize to reposition overlays
                // Use a debounced approach to avoid excessive repositioning during resize
                let resizeTimeout;
                window.addEventListener('resize', function() {
                    clearTimeout(resizeTimeout);
                    resizeTimeout = setTimeout(function() {
                        // Allow imageMapResize to update coordinates first
                        setTimeout(function() {
                            if (currentSelectedArea && selectedOverlay) {
                                const mapImg = document.getElementById('anambra-map');
                                if (mapImg && mapImg.complete) {
                                    positionOverlay(selectedOverlay, currentSelectedArea, mapImg);
                                }
                            }
                        }, 50); // Small delay to ensure imageMapResize has finished
                    }, 100);
                });
            }

            window.onload = function() {
                imageMapResize();
                setupImageMapListeners();
            }
        </script>
    </body>
</html>
