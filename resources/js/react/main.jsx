import React from 'react';
import { createRoot } from 'react-dom/client';
import { QueryProvider } from './providers/QueryProvider';
import FeedStream from './components/social/FeedStream';
import AccountHub from './components/account/AccountHub';
import ChatDrawer from './components/chat/ChatDrawer';

// Safe DOM initialization
function initReactRoots() {
    // 1. Social Feed Root Mount
    const feedRootEl = document.getElementById('react-feed-root');
    if (feedRootEl && !feedRootEl.dataset.reactMounted) {
        feedRootEl.dataset.reactMounted = 'true';
        const fallback = document.getElementById('blade-feed-fallback');
        if (fallback) fallback.style.display = 'none';

        const root = createRoot(feedRootEl);
        root.render(
            <React.StrictMode>
                <QueryProvider>
                    <FeedStream />
                </QueryProvider>
            </React.StrictMode>
        );
    }

    // 2. Sovereign Account Hub Root Mount
    const accountRootEl = document.getElementById('react-account-root');
    if (accountRootEl && !accountRootEl.dataset.reactMounted) {
        accountRootEl.dataset.reactMounted = 'true';
        let initialUser = null;
        let initialDevices = [];
        let initialApps = [];

        try {
            if (accountRootEl.dataset.user) {
                initialUser = JSON.parse(accountRootEl.dataset.user);
            }
            if (accountRootEl.dataset.devices) {
                initialDevices = JSON.parse(accountRootEl.dataset.devices);
            }
            if (accountRootEl.dataset.apps) {
                initialApps = JSON.parse(accountRootEl.dataset.apps);
            }
        } catch (e) {
            console.warn('[Zengfy React] Failed to parse SSR JSON dataset:', e);
        }

        const fallback = document.getElementById('blade-account-fallback');
        if (fallback) fallback.style.display = 'none';

        const root = createRoot(accountRootEl);
        root.render(
            <React.StrictMode>
                <QueryProvider>
                    <AccountHub 
                        initialUser={initialUser}
                        initialDevices={initialDevices}
                        initialApps={initialApps}
                    />
                </QueryProvider>
            </React.StrictMode>
        );
    }

    // 3. Floating Real-time Chat Drawer Root Mount
    let chatRootEl = document.getElementById('react-chat-root');
    if (!chatRootEl && (feedRootEl || accountRootEl || document.querySelector('[data-realtime="true"]'))) {
        chatRootEl = document.createElement('div');
        chatRootEl.id = 'react-chat-root';
        document.body.appendChild(chatRootEl);
    }

    if (chatRootEl && !chatRootEl.dataset.reactMounted) {
        chatRootEl.dataset.reactMounted = 'true';
        const root = createRoot(chatRootEl);
        root.render(
            <React.StrictMode>
                <QueryProvider>
                    <ChatDrawer />
                </QueryProvider>
            </React.StrictMode>
        );
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initReactRoots);
} else {
    initReactRoots();
}
