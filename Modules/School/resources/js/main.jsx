import React from 'react';
import { createRoot } from 'react-dom/client';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import SchoolLandingApp from './SchoolLandingApp';

const queryClient = new QueryClient({
    defaultOptions: {
        queries: {
            staleTime: 1000 * 60 * 5, // 5 mins
            retry: 1,
            refetchOnWindowFocus: false,
        },
    },
});

export function initSchoolLanding() {
    const landingRootEl = document.getElementById('react-school-landing-root');
    if (landingRootEl && !landingRootEl.dataset.reactMounted) {
        landingRootEl.dataset.reactMounted = 'true';
        const root = createRoot(landingRootEl);
        root.render(
            <React.StrictMode>
                <QueryClientProvider client={queryClient}>
                    <SchoolLandingApp />
                </QueryClientProvider>
            </React.StrictMode>
        );
    }
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSchoolLanding);
} else {
    initSchoolLanding();
}
