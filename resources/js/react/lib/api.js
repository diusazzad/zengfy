/**
 * Zengfy API Client
 * Secure fetch wrapper with CSRF & SSO Bearer token handling
 */

export function getCsrfToken() {
    const metaTag = document.querySelector('meta[name="csrf-token"]');
    return metaTag ? metaTag.getAttribute('content') : '';
}

export function getAuthToken() {
    return localStorage.getItem('zengfy_token') || '';
}

export async function apiRequest(endpoint, options = {}) {
    const headers = new Headers(options.headers || {});

    // Ensure CSRF token
    const csrf = getCsrfToken();
    if (csrf && !headers.has('X-CSRF-TOKEN')) {
        headers.set('X-CSRF-TOKEN', csrf);
    }

    // Attach Bearer token if present
    const token = getAuthToken();
    if (token && !headers.has('Authorization')) {
        headers.set('Authorization', `Bearer ${token}`);
    }

    // Default to JSON accept
    if (!headers.has('Accept')) {
        headers.set('Accept', 'application/json');
    }

    // Set Content-Type for JSON payloads (if not FormData)
    if (options.body && !(options.body instanceof FormData) && !headers.has('Content-Type')) {
        headers.set('Content-Type', 'application/json');
    }

    const config = {
        credentials: 'same-origin',
        ...options,
        headers,
    };

    try {
        const response = await fetch(endpoint, config);
        const contentType = response.headers.get('content-type') || '';
        
        let data = null;
        if (contentType.includes('application/json')) {
            data = await response.json();
        } else {
            const text = await response.text();
            try {
                data = JSON.parse(text);
            } catch {
                data = { raw: text };
            }
        }

        if (!response.ok) {
            const errorMsg = data?.message || data?.error || `HTTP ${response.status}: Request failed`;
            const error = new Error(errorMsg);
            error.status = response.status;
            error.data = data;
            throw error;
        }

        return data;
    } catch (err) {
        // Re-throw so TanStack Query or caller can handle
        throw err;
    }
}
