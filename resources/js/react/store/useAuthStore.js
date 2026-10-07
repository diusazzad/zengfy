import { create } from 'zustand';
import api from '../api/client';

export const useAuthStore = create((set, get) => ({
    user: null,
    token: localStorage.getItem('zengfy_token') || null,
    isAuthenticated: false,
    isLoading: true,

    setAuth: (user, token) => {
        if (token) {
            localStorage.setItem('zengfy_token', token);
        }
        set({ user, token, isAuthenticated: !!user, isLoading: false });
    },

    clearAuth: () => {
        localStorage.removeItem('zengfy_token');
        set({ user: null, token: null, isAuthenticated: false, isLoading: false });
    },

    checkAuth: async () => {
        set({ isLoading: true });
        try {
            const res = await api.get('/auth/check');
            if (res.success && res.data?.authenticated) {
                set({
                    user: res.data.user,
                    isAuthenticated: true,
                    isLoading: false,
                });
                return res.data.user;
            } else {
                set({ user: null, isAuthenticated: false, isLoading: false });
                return null;
            }
        } catch (error) {
            set({ user: null, isAuthenticated: false, isLoading: false });
            return null;
        }
    },
}));
