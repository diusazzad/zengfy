import React from 'react';
import { createRoot } from 'react-dom/client';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import SkillLandingApp from './SkillLandingApp';

const queryClient = new QueryClient({
  defaultOptions: {
    queries: {
      refetchOnWindowFocus: false,
      retry: 1,
    },
  },
});

const container = document.getElementById('react-skill-landing-root');

if (container) {
  const root = createRoot(container);
  root.render(
    <React.StrictMode>
      <QueryClientProvider client={queryClient}>
        <SkillLandingApp />
      </QueryClientProvider>
    </React.StrictMode>
  );
} else {
  console.warn('[Zengfy Skill] Target mount container #react-skill-landing-root not found in DOM.');
}
