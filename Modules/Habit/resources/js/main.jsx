import React from 'react';
import { createRoot } from 'react-dom/client';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import HabitLandingApp from './HabitLandingApp';

const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      refetchOnWindowFocus: false,
      staleTime: 1000 * 60 * 5,
    },
  },
});

document.addEventListener('DOMContentLoaded', () => {
  const mountNode = document.getElementById('habit-app') || document.getElementById('react-habit-landing-root');
  if (mountNode) {
    const root = createRoot(mountNode);
    root.render(
      <React.StrictMode>
        <QueryClientProvider client={queryClient}>
          <HabitLandingApp />
        </QueryClientProvider>
      </React.StrictMode>
    );
  }
});
