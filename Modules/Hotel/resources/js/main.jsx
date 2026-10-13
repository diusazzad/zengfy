import React from 'react';
import { createRoot } from 'react-dom/client';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import HotelLandingApp from './HotelLandingApp';

const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      refetchOnWindowFocus: false,
      retry: 1,
    },
  },
});

const container = document.getElementById('react-hotel-landing-root');

if (container) {
  const root = createRoot(container);
  root.render(
    <React.StrictMode>
      <QueryClientProvider client={queryClient}>
        <HotelLandingApp />
      </QueryClientProvider>
    </React.StrictMode>
  );
} else {
  console.warn('[Zengfy Hotel] Target mount container #react-hotel-landing-root not found in DOM.');
}
