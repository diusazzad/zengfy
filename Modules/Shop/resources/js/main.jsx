import React from 'react';
import { createRoot } from 'react-dom/client';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import ShopLandingApp from './ShopLandingApp';

const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      refetchOnWindowFocus: false,
      retry: 1,
    },
  },
});

const container = document.getElementById('react-shop-landing-root');

if (container) {
  const root = createRoot(container);
  root.render(
    <React.StrictMode>
      <QueryClientProvider client={queryClient}>
        <ShopLandingApp />
      </QueryClientProvider>
    </React.StrictMode>
  );
} else {
  console.warn('[Zengfy Shop] Target mount container #react-shop-landing-root not found in DOM.');
}
