import React from 'react';
import { createRoot } from 'react-dom/client';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import JournalLandingApp from './JournalLandingApp';

const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      refetchOnWindowFocus: false,
      retry: 1,
    },
  },
});

const container = document.getElementById('react-journal-landing-root');

if (container) {
  const root = createRoot(container);
  root.render(
    <React.StrictMode>
      <QueryClientProvider client={queryClient}>
        <JournalLandingApp />
      </QueryClientProvider>
    </React.StrictMode>
  );
} else {
  console.warn('[Zengfy Journal] Target mount container #react-journal-landing-root not found in DOM.');
}
