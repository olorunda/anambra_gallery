const CACHE_NAME = 'anambra-gallery-v1';
const OFFLINE_PAGE = '/offline.html';
const FALLBACK_IMAGE = '/images/fallback.png';

// Cache everything aggressively for offline experience
const CACHE_URLS = [
  '/',
  '/offline.html',
  '/manifest.json',
  '/favicon.ico',
  '/favicon.svg',
  '/apple-touch-icon.png'
];

// Install event - cache essential resources
self.addEventListener('install', event => {
  console.log('[SW] Installing service worker...');
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        console.log('[SW] Caching essential resources');
        return cache.addAll(CACHE_URLS);
      })
      .then(() => {
        console.log('[SW] Installation complete');
        return self.skipWaiting();
      })
      .catch(error => {
        console.error('[SW] Installation failed:', error);
      })
  );
});

// Activate event - clean up old caches
self.addEventListener('activate', event => {
  console.log('[SW] Activating service worker...');
  event.waitUntil(
    caches.keys()
      .then(cacheNames => {
        return Promise.all(
          cacheNames.map(cacheName => {
            if (cacheName !== CACHE_NAME) {
              console.log('[SW] Deleting old cache:', cacheName);
              return caches.delete(cacheName);
            }
          })
        );
      })
      .then(() => {
        console.log('[SW] Activation complete');
        return self.clients.claim();
      })
  );
});

// Fetch event - aggressive caching strategy
self.addEventListener('fetch', event => {
  const request = event.request;
  const url = new URL(request.url);

  // Skip non-GET requests
  if (request.method !== 'GET') {
    return;
  }

  // Skip Chrome extensions and other non-http(s) requests
  if (!request.url.startsWith('http')) {
    return;
  }

  // Handle navigation requests (HTML pages)
  if (request.mode === 'navigate') {
    event.respondWith(handleNavigationRequest(request));
    return;
  }

  // Handle static assets (CSS, JS, images, fonts)
  if (isStaticAsset(request)) {
    event.respondWith(handleStaticAsset(request));
    return;
  }

  // Handle API requests
  if (isApiRequest(request)) {
    event.respondWith(handleApiRequest(request));
    return;
  }

  // Default: cache first with network fallback
  event.respondWith(
    caches.match(request)
      .then(cachedResponse => {
        if (cachedResponse) {
          // Update cache in background
          fetchAndCache(request);
          return cachedResponse;
        }
        return fetchAndCache(request);
      })
      .catch(() => {
        // Return offline page for navigation requests
        if (request.mode === 'navigate') {
          return caches.match(OFFLINE_PAGE);
        }
        return new Response('Offline', { status: 503 });
      })
  );
});

// Handle navigation requests (HTML pages)
async function handleNavigationRequest(request) {
  const url = new URL(request.url);

  // Skip caching for admin routes - always fetch from network
  if (isAdminRoute(request)) {
    console.log('[SW] Admin route detected, bypassing cache:', url.pathname);
    try {
      return await fetch(request);
    } catch (error) {
      console.log('[SW] Admin route network failed:', error);
      throw error; // Don't serve offline page for admin routes
    }
  }

  try {
    // Try cache first for aggressive offline (non-admin routes only)
    const cachedResponse = await caches.match(request);
    if (cachedResponse) {
      // Update cache in background
      fetchAndCacheNavigation(request);
      return cachedResponse;
    }

    // Try network
    const networkResponse = await fetch(request);
    if (networkResponse.ok) {
      // Cache the page
      const cache = await caches.open(CACHE_NAME);
      cache.put(request, networkResponse.clone());
      return networkResponse;
    }

    throw new Error('Network response not ok');
  } catch (error) {
    console.log('[SW] Navigation request failed, serving offline page:', error);
    return caches.match(OFFLINE_PAGE) ||
           new Response('Offline', {
             status: 503,
             headers: { 'Content-Type': 'text/html' }
           });
  }
}

// Handle static assets with cache-first strategy
async function handleStaticAsset(request) {
  try {
    const cachedResponse = await caches.match(request);
    if (cachedResponse) {
      return cachedResponse;
    }

    const networkResponse = await fetch(request);
    if (networkResponse.ok) {
      const cache = await caches.open(CACHE_NAME);
      cache.put(request, networkResponse.clone());
      return networkResponse;
    }

    throw new Error('Network response not ok');
  } catch (error) {
    console.log('[SW] Static asset failed:', error);

    // Return fallback for images
    if (request.destination === 'image') {
      return caches.match(FALLBACK_IMAGE) ||
             new Response('Image unavailable', { status: 503 });
    }

    return new Response('Asset unavailable', { status: 503 });
  }
}

// Handle API requests with network-first, then cache
async function handleApiRequest(request) {
  try {
    const networkResponse = await fetch(request);
    if (networkResponse.ok) {
      const cache = await caches.open(CACHE_NAME);
      cache.put(request, networkResponse.clone());
      return networkResponse;
    }

    throw new Error('Network response not ok');
  } catch (error) {
    console.log('[SW] API request failed, trying cache:', error);
    const cachedResponse = await caches.match(request);
    if (cachedResponse) {
      return cachedResponse;
    }

    return new Response(
      JSON.stringify({ error: 'Service unavailable offline' }),
      {
        status: 503,
        headers: { 'Content-Type': 'application/json' }
      }
    );
  }
}

// Background fetch and cache
async function fetchAndCache(request) {
  try {
    const networkResponse = await fetch(request);
    if (networkResponse.ok) {
      const cache = await caches.open(CACHE_NAME);
      cache.put(request, networkResponse.clone());
    }
    return networkResponse;
  } catch (error) {
    console.log('[SW] Background fetch failed:', error);
    throw error;
  }
}

// Background fetch and cache for navigation
async function fetchAndCacheNavigation(request) {
  try {
    const networkResponse = await fetch(request);
    if (networkResponse.ok) {
      const cache = await caches.open(CACHE_NAME);
      cache.put(request, networkResponse.clone());
    }
  } catch (error) {
    console.log('[SW] Background navigation fetch failed:', error);
  }
}

// Check if request is for static assets
function isStaticAsset(request) {
  const url = new URL(request.url);
  const pathname = url.pathname;

  // Check file extensions
  const staticExtensions = [
    '.css', '.js', '.png', '.jpg', '.jpeg', '.gif', '.svg', '.webp',
    '.woff', '.woff2', '.ttf', '.otf', '.eot', '.ico', '.pdf'
  ];

  return staticExtensions.some(ext => pathname.endsWith(ext)) ||
         pathname.startsWith('/build/') ||
         pathname.startsWith('/storage/') ||
         pathname.startsWith('/images/') ||
         pathname.startsWith('/css/') ||
         pathname.startsWith('/js/');
}

// Check if request is for API endpoints
function isApiRequest(request) {
  const url = new URL(request.url);
  return url.pathname.startsWith('/api/') ||
         url.pathname.startsWith('/livewire/') ||
         request.headers.get('X-Requested-With') === 'XMLHttpRequest';
}

// Check if request is for admin routes
function isAdminRoute(request) {
  const url = new URL(request.url);
  return url.pathname.startsWith('/admin');
}

// Handle messages from main thread
self.addEventListener('message', event => {
  if (event.data && event.data.type === 'SKIP_WAITING') {
    self.skipWaiting();
  }
});

console.log('[SW] Service worker loaded');
