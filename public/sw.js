/*
 * Zengfy Sovereign PWA Service Worker (v4.0.0)
 * Purges old caches and serves clean white glassmorphic app shell.
 */

const CACHE_VERSION = 'v4';
const STATIC_CACHE = `zengfy-static-${CACHE_VERSION}`;
const ASSETS_CACHE = `zengfy-assets-${CACHE_VERSION}`;
const FONTS_CACHE = `zengfy-fonts-${CACHE_VERSION}`;
const IMAGES_CACHE = `zengfy-images-${CACHE_VERSION}`;

// Core App Shell Assets for Pre-caching
const PRECACHE_ASSETS = [
    '/',
    '/favicon.ico',
    '/robots.txt',
    '/images/logo.png',
    '/build/assets/app-PzI-Dzae.css',
    '/build/assets/app-DbTTI37r.js'
];

// 1. Install Event: Purge old cache immediately & cache new shell
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.keys().then((keys) => {
            return Promise.all(keys.map((k) => caches.delete(k)));
        }).then(() => {
            return caches.open(STATIC_CACHE).then((cache) => {
                console.log('[Zengfy SW v4] Caching fresh white glassmorphic app shell');
                return cache.addAll(PRECACHE_ASSETS).catch((err) => {
                    console.warn('[Zengfy SW v4] Pre-cache partial warning:', err);
                });
            });
        })
    );
    self.skipWaiting();
});

// 2. Activate Event: Claim all clients immediately so new version takes effect without reload
self.addEventListener('activate', (event) => {
    const activeCaches = [STATIC_CACHE, ASSETS_CACHE, FONTS_CACHE, IMAGES_CACHE];
    event.waitUntil(
        caches.keys().then((keys) => {
            return Promise.all(
                keys.map((key) => {
                    if (!activeCaches.includes(key)) {
                        console.log('[Zengfy SW v4] Removing stale cache:', key);
                        return caches.delete(key);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

// 3. Fetch Event: Multi-tiered smart caching strategies
self.addEventListener('fetch', (event) => {
    const request = event.request;

    // Only handle GET requests
    if (request.method !== 'GET') return;

    const url = new URL(request.url);

    // Bypass API calls, WebSocket, and chrome extensions
    if (url.pathname.startsWith('/api/') || url.protocol === 'chrome-extension:' || url.protocol === 'ws:' || url.protocol === 'wss:') {
        return;
    }

    // Bypass authentication & sensitive routes
    if (url.pathname.startsWith('/account') || url.pathname.startsWith('/dashboard') || url.pathname.startsWith('/login') || url.pathname.startsWith('/register')) {
        return;
    }

    // A. HTML NAVIGATION / LANDING PAGE (Network-First ALWAYS for fresh UI)
    if (request.mode === 'navigate') {
        event.respondWith(
            fetch(request)
                .then((networkResponse) => {
                    if (networkResponse && networkResponse.status === 200) {
                        const copy = networkResponse.clone();
                        caches.open(STATIC_CACHE).then((cache) => cache.put(request, copy));
                    }
                    return networkResponse;
                })
                .catch(async () => {
                    const cached = await caches.match(request);
                    return cached || caches.match('/');
                })
        );
        return;
    }

    // B. GOOGLE FONTS STRATEGY (Cache-First)
    if (url.origin === 'https://fonts.googleapis.com' || url.origin === 'https://fonts.gstatic.com') {
        event.respondWith(
            caches.open(FONTS_CACHE).then(async (cache) => {
                const cached = await cache.match(request);
                if (cached) return cached;

                try {
                    const response = await fetch(request);
                    if (response && response.status === 200) {
                        cache.put(request, response.clone());
                    }
                    return response;
                } catch (e) {
                    return cached;
                }
            })
        );
        return;
    }

    // C. VERSIONED STATIC ASSETS STRATEGY (Cache-First)
    if (url.pathname.startsWith('/build/assets/')) {
        event.respondWith(
            caches.open(ASSETS_CACHE).then(async (cache) => {
                const cached = await cache.match(request);
                if (cached) return cached;

                const response = await fetch(request);
                if (response && response.status === 200) {
                    cache.put(request, response.clone());
                }
                return response;
            })
        );
        return;
    }

    // D. IMAGES & MEDIA STRATEGY (Stale-While-Revalidate)
    if (url.pathname.startsWith('/images/') || url.pathname.endsWith('.png') || url.pathname.endsWith('.webp') || url.pathname.endsWith('.jpg')) {
        event.respondWith(
            caches.open(IMAGES_CACHE).then(async (cache) => {
                const cached = await cache.match(request);
                const fetchPromise = fetch(request).then((networkResponse) => {
                    if (networkResponse && networkResponse.status === 200) {
                        cache.put(request, networkResponse.clone());
                    }
                    return networkResponse;
                }).catch(() => cached);

                return cached || fetchPromise;
            })
        );
        return;
    }

    // Default: Network First
    event.respondWith(
        fetch(request)
            .then((networkResponse) => {
                if (networkResponse && networkResponse.status === 200) {
                    const copy = networkResponse.clone();
                    caches.open(STATIC_CACHE).then((cache) => cache.put(request, copy));
                }
                return networkResponse;
            })
            .catch(() => caches.match(request))
    );
});
