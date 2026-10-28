import { create } from 'zustand';

export const useSocialStore = create((set) => ({
    filterWard: null,
    isCreateModalOpen: false,
    selectedPostForMedia: null,
    likedPosts: {}, // { [postId]: { liked: boolean, count: number } }

    setFilterWard: (ward) => set({ filterWard: ward }),
    openCreateModal: () => set({ isCreateModalOpen: true }),
    closeCreateModal: () => set({ isCreateModalOpen: false }),
    openMediaLightbox: (post) => set({ selectedPostForMedia: post }),
    closeMediaLightbox: () => set({ selectedPostForMedia: null }),

    setPostLikedState: (postId, liked, count) =>
        set((state) => ({
            likedPosts: {
                ...state.likedPosts,
                [postId]: { liked, count },
            },
        })),
}));
