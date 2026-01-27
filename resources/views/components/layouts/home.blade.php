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
        <link rel="manifest" href="{{asset('manifest.json')}}">

        <!-- Icons -->
        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{asset('imageMapResizer.min.js')}}"></script>

        <style>
            @media all and (display-mode: standalone) {
                #nprogress {
                    display: none;
                }
            }
        </style>

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
