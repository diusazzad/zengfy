/**
 * NGO Landing Data Fetcher (0ms SSR Hydration + REST API Fallback)
 */

export async function fetchNGOData() {
  // 1. Check for SSR data embedded in DOM mount node
  const mountNode = document.getElementById('react-ngo-landing-root');
  if (mountNode) {
    const rawData = mountNode.getAttribute('data-initial-data');
    if (rawData) {
      try {
        const parsed = JSON.parse(rawData);
        if (parsed && typeof parsed === 'object') {
          return parsed;
        }
      } catch (err) {
        console.warn('[Zengfy NGO] Failed to parse initial SSR data:', err);
      }
    }
  }

  // 2. Fetch from Public REST API
  const response = await fetch('/api/v1/ngo/landing', {
    headers: {
      'Accept': 'application/json',
    },
  });

  if (!response.ok) {
    throw new Error(`Failed to fetch NGO landing data: HTTP ${response.status}`);
  }

  const json = await response.json();
  return json.data;
}
