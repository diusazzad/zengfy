const CACHE_NAME = 'zengfy-cache-v1';
const ASSETS_TO_CACHE = [
    '/',
    '/favicon.ico',
    '/robots.txt',
    '/welcome/logo/welcome_logo.jpg',
    '/welcome/logo/Creative%20Cafe%20Meeting.png',
    '/welcome/logo/WomaninDataCenter.png',
    '/welcome/team/mahim.png',
    '/welcome/team/masum.png',
    'https://cdn.tailwindcss.com',
    'https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@300;400;500;600;700&display=swap',
];

// Install Event - Cache assets and skip waiting
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            console.log('[Service Worker] Caching all: app shell and content');
            return cache.addAll(ASSETS_TO_CACHE);
        })
    );
    // Force immediate activation
    self.skipWaiting();
});

// Activate Event - Clean up old caches and claim clients
self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keyList) => {
            return Promise.all(keyList.map((key) => {
                if (key !== CACHE_NAME) {
                    console.log('[Service Worker] Removing old cache', key);
                    return caches.delete(key);
                }
            }));
        })
    );
    // Claim all clients immediately
    self.clients.claim();
});

// Fetch Event - Stale-While-Revalidate Strategy
self.addEventListener('fetch', (event) => {
    // Only handle GET requests
    if (event.request.method !== 'GET') return;

    event.respondWith(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.match(event.request).then((cachedResponse) => {
                const fetchedResponse = fetch(event.request).then((networkResponse) => {
                    // Update cache with new response
                    if (networkResponse.status === 200) {
                        cache.put(event.request, networkResponse.clone());
                    }
                    return networkResponse;
                }).catch(() => {
                    // If network fails, we've already returned cachedResponse (if any)
                });

                // Return cached version if exists, or wait for fetch
                return cachedResponse || fetchedResponse;
            });
        })
    );
});
