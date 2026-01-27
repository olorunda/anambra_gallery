<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
            
            @media all and (display-mode: standalone) {
                #nprogress {
                    display: none;
                }
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
        {{ $slot }}
    </body>
</html>
