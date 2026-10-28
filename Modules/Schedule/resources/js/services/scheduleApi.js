/**
 * Schedule Landing Data Fetcher (0ms SSR Hydration + REST API Fallback)
 */

export async function fetchScheduleData() {
  // 1. Check for SSR data embedded in DOM mount node
  const mountNode = document.getElementById('schedule-app') || document.getElementById('react-schedule-landing-root');
  if (mountNode) {
    const rawData = mountNode.getAttribute('data-initial-data');
    if (rawData) {
      try {
        const parsed = JSON.parse(rawData);
        if (parsed && typeof parsed === 'object') {
          return parsed;
        }
      } catch (err) {
        console.warn('[Zengfy Schedule] Failed to parse initial SSR data:', err);
      }
    }
  }

  // 2. Fetch from Public REST API
  const response = await fetch('/api/v1/schedule/landing', {
    headers: {
      'Accept': 'application/json',
    },
  });

  if (!response.ok) {
    throw new Error(`Failed to fetch Schedule landing data: HTTP ${response.status}`);
  }

  const json = await response.json();
  return json.data;
}

export const fetchScheduleLandingData = fetchScheduleData;
