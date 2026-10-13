/**
 * Habit Landing Data Fetcher (0ms SSR Hydration + REST API Fallback)
 */

export async function fetchHabitData() {
  // 1. Check for SSR data embedded in DOM mount node
  const mountNode = document.getElementById('habit-app') || document.getElementById('react-habit-landing-root');
  if (mountNode) {
    const rawData = mountNode.getAttribute('data-initial-data');
    if (rawData) {
      try {
        const parsed = JSON.parse(rawData);
        if (parsed && typeof parsed === 'object') {
          return parsed;
        }
      } catch (err) {
        console.warn('[Zengfy Habit] Failed to parse initial SSR data:', err);
      }
    }
  }

  // 2. Fetch from Public REST API
  const response = await fetch('/api/v1/habit/landing', {
    headers: {
      'Accept': 'application/json',
    },
  });

  if (!response.ok) {
    throw new Error(`Failed to fetch Habit landing data: HTTP ${response.status}`);
  }

  const json = await response.json();
  return json.data;
}

export const fetchHabitLandingData = fetchHabitData;
