import axios from 'axios';

const api = axios.create({
    baseURL: '/api/v1',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    },
    withCredentials: true, // Crucial for cross-subdomain SSO session cookies
});

// Request interceptor: attach CSRF token and Bearer token
api.interceptors.request.use(
    (config) => {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (csrfToken) {
            config.headers['X-CSRF-TOKEN'] = csrfToken;
        }

        const token = localStorage.getItem('zengfy_token');
        if (token) {
            config.headers['Authorization'] = `Bearer ${token}`;
        }

        return config;
    },
    (error) => Promise.reject(error)
);

// Response interceptor: handle 401s or rate limits gracefully
api.interceptors.response.use(
    (response) => response.data,
    (error) => {
        if (error.response?.status === 401) {
            // Unauthenticated state
            localStorage.removeItem('zengfy_token');
        }
        return Promise.reject(error.response?.data || error);
    }
);

export default api;
