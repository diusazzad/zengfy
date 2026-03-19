const CACHE_NAME = 'zengfy-cache-v2';
const ASSETS_TO_CACHE = [
    '/',
    '/favicon.ico',
    '/robots.txt'
    // Note: Do NOT hardcode volatile image paths here. A single 404 will fail the ENTIRE install process.
];

// Install Event - Cache critical offline assets
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            console.log('[Service Worker] Caching critical app shell');
            return cache.addAll(ASSETS_TO_CACHE);
        })
    );
    self.skipWaiting();
});

// Activate Event - Clean up old caches
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keyList) => {
            return Promise.all(keyList.map((key) => {
                if (key !== CACHE_NAME) {
                    console.log('[Service Worker] Removing old cache:', key);
                    return caches.delete(key);
                }
            }));
        })
    );
    self.clients.claim();
});

// Fetch Event - Stale-While-Revalidate with strict offline fallback
self.addEventListener('fetch', (event) => {
    if (event.request.method !== 'GET') return;
    
    // Ignore API requests and browser extension requests
    if (event.request.url.includes('/api/') || event.request.url.startsWith('chrome-extension')) {
        return;
    }

    event.respondWith(
        caches.match(event.request).then((cachedResponse) => {
            const networkFetch = fetch(event.request).then((networkResponse) => {
                // Only cache valid OK responses
                if (networkResponse && networkResponse.status === 200 && networkResponse.type === 'basic') {
                    const responseToCache = networkResponse.clone();
                    caches.open(CACHE_NAME).then((cache) => {
                        cache.put(event.request, responseToCache);
                    });
                }
                return networkResponse;
            }).catch((error) => {
                console.log('[Service Worker] Network request failed / Offline', error);
                // Return a custom offline HTML here if needed, or bubble up undefined
            });

            // Return cached response instantly if available, otherwise wait for network
            // If BOTH fail (e.g., offline & not cached), this returns a generic Response to prevent crash
            return cachedResponse || networkFetch.then(res => res || new Response("Offline Mode", { status: 503, statusText: "Offline" }));
        })
    );
});
