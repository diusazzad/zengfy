import React from 'react';
import { createRoot } from 'react-dom/client';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import SocialLandingApp from './SocialLandingApp';

const queryClient = new QueryClient({
    defaultOptions: {
        queries: {
            staleTime: 1000 * 60 * 5, // 5 mins
            retry: 1,
            refetchOnWindowFocus: false,
        },
    },
});

export function initSocialLanding() {
    const landingRootEl = document.getElementById('react-social-landing-root');
    if (landingRootEl && !landingRootEl.dataset.reactMounted) {
        landingRootEl.dataset.reactMounted = 'true';
        const root = createRoot(landingRootEl);
        root.render(
            <React.StrictMode>
                <QueryClientProvider client={queryClient}>
                    <SocialLandingApp />
                </QueryClientProvider>
            </React.StrictMode>
        );
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSocialLanding);
} else {
    initSocialLanding();
}