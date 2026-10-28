import React from 'react';
import { createRoot } from 'react-dom/client';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import POSLandingApp from './POSLandingApp';

const queryClient = new QueryClient({
    defaultOptions: {
        queries: {
            staleTime: 1000 * 60 * 5, // 5 mins
            retry: 1,
            refetchOnWindowFocus: false,
        },
    },
});

export function initPOSLanding() {
    const landingRootEl = document.getElementById('react-pos-landing-root');
    if (landingRootEl && !landingRootEl.dataset.reactMounted) {
        landingRootEl.dataset.reactMounted = 'true';
        const root = createRoot(landingRootEl);
        root.render(
            <React.StrictMode>
                <QueryClientProvider client={queryClient}>
                    <POSLandingApp />
                </QueryClientProvider>
            </React.StrictMode>
        );
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPOSLanding);
} else {
    initPOSLanding();
}