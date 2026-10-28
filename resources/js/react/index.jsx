import React from 'react';
import { createRoot } from 'react-dom/client';
import { QueryClientProvider } from '@tanstack/react-query';
import { queryClient } from './lib/queryClient';
import FeedStream from './components/social/FeedStream';
import ChatDrawer from './components/chat/ChatDrawer';
import AccountHub from './components/account/AccountHub';

function AppWrapper({ children }) {
    return (
        <QueryClientProvider client={queryClient}>
            {children}
        </QueryClientProvider>
    );
}

// 1. Mount Feed Stream if target root exists
export function initReactFeed() {
    const feedRootEl = document.getElementById('react-feed-root');
    if (feedRootEl && !feedRootEl.dataset.reactMounted) {
        feedRootEl.dataset.reactMounted = 'true';
        const initialWard = feedRootEl.getAttribute('data-ward') || null;

        const root = createRoot(feedRootEl);
        root.render(
            <AppWrapper>
                <FeedStream initialWard={initialWard} />
            </AppWrapper>
        );
    }
}

// 2. Mount Real-Time Floating Chat Drawer
export function initReactChat() {
    let chatRootEl = document.getElementById('react-chat-root');
    
    // Auto-create chat root element if page allows chat
    if (!chatRootEl && (document.querySelector('[data-realtime="true"]') || document.getElementById('react-feed-root') || document.getElementById('react-account-root'))) {
        chatRootEl = document.createElement('div');
        chatRootEl.id = 'react-chat-root';
        document.body.appendChild(chatRootEl);
    }

    if (chatRootEl && !chatRootEl.dataset.reactMounted) {
        chatRootEl.dataset.reactMounted = 'true';
        const root = createRoot(chatRootEl);
        root.render(
            <AppWrapper>
                <ChatDrawer />
            </AppWrapper>
        );
    }
}

// 3. Mount Sovereign Account Hub if target root exists
export function initReactAccount() {
    const accountRootEl = document.getElementById('react-account-root');
    if (accountRootEl && !accountRootEl.dataset.reactMounted) {
        accountRootEl.dataset.reactMounted = 'true';

        let initialUser = null;
        let initialDevices = [];
        let initialApps = [];
        let homeUrl = '/';
        let socialUrl = '/feed';

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
            if (accountRootEl.dataset.homeUrl) {
                homeUrl = accountRootEl.dataset.homeUrl;
            }
            if (accountRootEl.dataset.socialUrl) {
                socialUrl = accountRootEl.dataset.socialUrl;
            }
        } catch (e) {
            console.error('Failed to parse initial account data attributes', e);
        }

        const root = createRoot(accountRootEl);
        root.render(
            <AppWrapper>
                <AccountHub
                    initialUser={initialUser}
                    initialDevices={initialDevices}
                    initialApps={initialApps}
                    homeUrl={homeUrl}
                    socialUrl={socialUrl}
                />
            </AppWrapper>
        );
    }
}

// Auto-run when DOM is loaded
if (typeof window !== 'undefined') {
    const initAll = () => {
        initReactFeed();
        initReactChat();
        initReactAccount();
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAll);
    } else {
        initAll();
    }
}
