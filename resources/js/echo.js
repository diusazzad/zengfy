import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

// Connect Echo lazily only when a page explicitly initializes or requests real-time features
window.initEcho = function () {
    if (window.Echo) return window.Echo;

    if (import.meta.env.VITE_REVERB_APP_KEY) {
        try {
            window.Echo = new Echo({
                broadcaster: 'reverb',
                key: import.meta.env.VITE_REVERB_APP_KEY,
                wsHost: import.meta.env.VITE_REVERB_HOST ?? window.location.hostname,
                wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
                wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
                forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
                enabledTransports: ['ws', 'wss'],
            });
        } catch (e) {
            console.warn('[Zengfy Echo] Reverb server not currently reachable, continuing in offline/HTTP mode.');
        }
    }
    return window.Echo;
};

// Check if current page needs immediate WebSocket (e.g. chat, live feed, or emergency views)
if (document.querySelector('[data-realtime="true"]')) {
    window.initEcho();
}
