import React from 'react';
import { createRoot } from 'react-dom/client';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import ScheduleLandingApp from './ScheduleLandingApp';

const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      refetchOnWindowFocus: false,
      staleTime: 1000 * 60 * 5,
    },
  },
});

document.addEventListener('DOMContentLoaded', () => {
  const mountNode = document.getElementById('schedule-app') || document.getElementById('react-schedule-landing-root');
  if (mountNode) {
    const root = createRoot(mountNode);
    root.render(
      <React.StrictMode>
        <QueryClientProvider client={queryClient}>
          <ScheduleLandingApp />
        </QueryClientProvider>
      </React.StrictMode>
    );
  }
});
