import { create } from 'zustand';

export const useChatStore = create((set) => ({
    isOpen: false,
    activeConversation: null, // conversation object
    unreadTotal: 0,
    typingUsers: {}, // { [conversationId]: { [userId]: boolean } }

    setIsOpen: (isOpen) => set({ isOpen }),
    toggleChat: () => set((state) => ({ isOpen: !state.isOpen })),
    setActiveConversation: (conversation) => set({ activeConversation: conversation }),
    closeActiveConversation: () => set({ activeConversation: null }),
    setUnreadTotal: (count) => set({ unreadTotal: count }),
    
    setUserTyping: (conversationId, userId, isTyping) =>
        set((state) => ({
            typingUsers: {
                ...state.typingUsers,
                [conversationId]: {
                    ...(state.typingUsers[conversationId] || {}),
                    [userId]: isTyping,
                },
            },
        })),
}));
