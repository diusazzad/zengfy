import React from 'react';
import { createRoot } from 'react-dom/client';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import LawLandingApp from './LawLandingApp';

const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      refetchOnWindowFocus: false,
      retry: 1,
    },
  },
});

const container = document.getElementById('react-law-landing-root');

if (container) {
  const root = createRoot(container);
  root.render(
    <React.StrictMode>
      <QueryClientProvider client={queryClient}>
        <LawLandingApp />
      </QueryClientProvider>
    </React.StrictMode>
  );
} else {
  console.warn('[Zengfy Law] Target mount container #react-law-landing-root not found in DOM.');
}
