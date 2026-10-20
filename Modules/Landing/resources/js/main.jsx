import React from 'react';
import { createRoot } from 'react-dom/client';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import EcosystemLandingApp from './EcosystemLandingApp';

const queryClient = new QueryClient({
    defaultOptions: {
        queries: {
            staleTime: 1000 * 60 * 5,
            retry: 1,
            refetchOnWindowFocus: false,
        },
    },
});

export function initLandingApp() {
    const rootEl = document.getElementById('react-ecosystem-landing-root');
    if (rootEl && !rootEl.dataset.reactMounted) {
        rootEl.dataset.reactMounted = 'true';
        const fallback = document.getElementById('blade-landing-fallback');
        if (fallback) fallback.style.display = 'none';

        const root = createRoot(rootEl);
        root.render(
            <React.StrictMode>
                <QueryClientProvider client={queryClient}>
                    <EcosystemLandingApp />
                </QueryClientProvider>
            </React.StrictMode>
        );
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initLandingApp);
} else {
    initLandingApp();
}