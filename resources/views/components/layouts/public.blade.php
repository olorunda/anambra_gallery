<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Anambra State' }}</title>

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

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{asset('imageMapResizer.min.js')}}"></script>
    <style>
        body {
            font-family: 'Karla', sans-serif;
        }
        @media all and (display-mode: standalone) {
            #nprogress {
                display: none;
            }
        }
    </style>
    @stack('styles')
    
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

        <header class="flex items-start justify-between mb-8">
            <a href="{{route('home')}}" wire:navigate><img alt="Anambra State Emblem" class="h-20 w-20 cursor-pointer" src="{{asset('logo.png')}}"/></a>
            <div class="text-center">
                <h1 class="font-display text-4xl md:text-5xl font-bold">@yield('header_title', $header_title ?? '')</h1>
                <p class="mt-2 text-lg text-text-light/80 dark:text-text-dark/80">
                    @yield('header_subtitle', $header_subtitle ?? '')
                </p>
            </div>
            <div class="w-20"></div>
        </header>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    @stack('scripts')
</body>
</html>
