<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Anambra State')</title>

    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#1f2937">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Anambra Gallery">
    <meta name="msapplication-TileColor" content="#1f2937">
    <meta name="msapplication-tap-highlight" content="no">

    <!-- PWA Manifest -->
    <link rel="manifest" href="{{asset('manifest.json')}}">

    <!-- Icons -->
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@400&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#f59e0b", // Not present in the image, but a standard practice to fill.
                        "background-light": "#fefbec",
                        "background-dark": "#1e1e1e",
                        "text-light": "#1c1917",
                        "text-dark": "#e5e5e5",
                        "button-bg-light": "#e5e7eb",
                        "button-bg-dark": "#404040",
                        "button-text-light": "#374151",
                        "button-text-dark": "#d4d4d4",
                    },
                    fontFamily: {
                        display: ["Libre Baskerville", "serif"],
                        body: ["Karla", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.75rem",
                        lg: "1rem",
                        xl: "1.5rem",
                    },
                },
            },
        };
    </script>
    <style>
        body {
            font-family: 'Karla', sans-serif;
        }
    </style>
    @stack('styles')
    @yield('styles')

    <!-- Service Worker Registration -->
    <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => {
        navigator.serviceWorker.register('{{asset("sw.js")}}')
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
    <!-- Navigation -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 min-h-screen flex flex-col">

{{--    <div class="container mx-auto px-4 py-12 md:py-20">--}}
{{--        <header class="text-center mb-12 md:mb-16">--}}
{{--            <img alt="Anambra State Logo" class="w-20 h-20 float-left mb-8"--}}
{{--                 src="https://lh3.googleusercontent.com/aida-public/AB6AXuAbF4HvfCeUv4Pw4Wt0sWmfDhUtk6mxLhILSvvJRxdpl6uMkpKQ-Kw3i2WG3De4AlAbUQ_51PO03Tj4CIxO5VsNk-o78TRHC72re5wnQN1u_01uIgzM_klHCWtGA5u93FKIl-kemiP_jpSBJQd8QdfkKZXroS3qlOJxop3EzO2Wbgu3yUkf-JYHYyNBFYyaG4W8iQ8QT2X3GwdXz20L9_K4z06Mi6-PHn3fBL4bxUM6EnG6pEIk11ztxtVQwdjsiLavyxdTPAn8KFBw"/>--}}
{{--            <h1 class="font-display text-4xl md:text-5xl font-bold text-gray-900 dark:text-gray-100 mb-2">--}}
{{--                @yield('header_title')</h1>--}}
{{--            <p class="text-lg text-gray-600 dark:text-gray-400">--}}
{{--                @yield('header_subtitle')--}}
{{--            </p>--}}
{{--        </header>--}}
        <header class="flex items-start justify-between mb-8">
            <img onclick="window.location='{{route('home')}}'" alt="Anambra State Emblem" class="h-20 w-20" src="{{asset('logo.png')}}"/>
            <div class="text-center">
                <h1 class="font-display text-4xl md:text-5xl font-bold">   @yield('header_title')</h1>
                <p class="mt-2 text-lg text-text-light/80 dark:text-text-dark/80">
                    @yield('header_subtitle')
                </p>
            </div>
            <div class="w-20"></div>
        </header>
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @stack('scripts')
</body>
</html>
