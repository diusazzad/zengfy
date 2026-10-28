import { create } from 'zustand';
import { persist } from 'zustand/middleware';

const DEFAULT_USERS = [
  {
    id: 'user-demo-1',
    fullName: 'সাজ্জাদ হোসেন (Demo)',
    dateOfBirth: '1998-05-15',
    gender: 'male',
    email: 'demo@zengfy.com',
    password: 'Password123',
    status: 'ACTIVE',
    trustTier: 'Tier 1: Verified Citizen',
    emailVerifiedAt: '2026-10-15T10:00:00Z',
    createdAt: '2026-10-15T10:00:00Z'
  }
];

export const useMockAuthStore = create(
  persist(
    (set, get) => ({
      currentUser: null,
      registeredUsers: DEFAULT_USERS,
      simulatedInbox: [], // simulated email messages sent
      isLoading: false,
      lastError: null,

      // Clear any active error message
      clearError: () => set({ lastError: null }),

      // 1. Day 0 Progressive Registration (Step 1: Name, DOB, Gender -> Step 2: Email, Password)
      register: async ({ fullName, dateOfBirth, gender, email, password }) => {
        set({ isLoading: true, lastError: null });

        // Simulate 750ms network handshake
        await new Promise((r) => setTimeout(r, 750));

        const normalizedEmail = email.trim().toLowerCase();
        const existing = get().registeredUsers.find(
          (u) => u.email.toLowerCase() === normalizedEmail
        );

        if (existing) {
          set({
            isLoading: false,
            lastError: 'এই ইমেইল ঠিকানাটি দিয়ে ইতিমধ্যে একটি একাউন্ট খোলা হয়েছে।'
          });
          return { success: false, error: 'Duplicate email' };
        }

        const newUser = {
          id: 'user-' + Date.now().toString(36),
          fullName: fullName.trim(),
          dateOfBirth: dateOfBirth || null,
          gender: gender || 'other',
          email: normalizedEmail,
          password: password, // In mock we store; in real backend Argon2id is used
          status: 'PENDING_VERIFICATION',
          trustTier: 'Tier 0: Guest Member',
          emailVerifiedAt: null,
          createdAt: new Date().toISOString()
        };

        const verificationToken = 'mock-tok-' + Math.random().toString(36).substring(2, 12);
        const emailMessage = {
          id: 'mail-' + Date.now().toString(36),
          userId: newUser.id,
          to: newUser.email,
          subject: 'Zengfy ইমেইল যাচাইকরণ লিংক (Verify Your Email)',
          token: verificationToken,
          sentAt: new Date().toLocaleTimeString('bn-BD', { hour: '2-digit', minute: '2-digit' })
        };

        set((state) => ({
          isLoading: false,
          currentUser: newUser,
          registeredUsers: [newUser, ...state.registeredUsers],
          simulatedInbox: [emailMessage, ...state.simulatedInbox]
        }));

        return { success: true, user: newUser, token: verificationToken };
      },

      // 2. Login Flow
      login: async ({ email, password }) => {
        set({ isLoading: true, lastError: null });

        await new Promise((r) => setTimeout(r, 700));

        const normalizedEmail = email.trim().toLowerCase();
        const user = get().registeredUsers.find(
          (u) => u.email.toLowerCase() === normalizedEmail
        );

        if (!user) {
          set({
            isLoading: false,
            lastError: 'এই ইমেইল ঠিকানায় কোনো একাউন্ট পাওয়া যায়নি। অনুগ্রহ করে সঠিক তথ্য দিন।'
          });
          return { success: false };
        }

        if (user.password !== password) {
          set({
            isLoading: false,
            lastError: 'প্রদত্ত পাসওয়ার্ডটি সঠিক নয়। পুনরায় চেষ্টা করুন।'
          });
          return { success: false };
        }

        set({
          isLoading: false,
          currentUser: user,
          lastError: null
        });

        return { success: true, user };
      },

      // 3. Verify Email Action
      verifyEmail: async (userId) => {
        set({ isLoading: true });
        await new Promise((r) => setTimeout(r, 600));

        set((state) => {
          const updatedUsers = state.registeredUsers.map((u) => {
            if (u.id === userId) {
              return {
                ...u,
                status: 'ACTIVE',
                trustTier: 'Tier 1: Verified Citizen',
                emailVerifiedAt: new Date().toISOString()
              };
            }
            return u;
          });

          const updatedCurrent =
            state.currentUser?.id === userId
              ? {
                  ...state.currentUser,
                  status: 'ACTIVE',
                  trustTier: 'Tier 1: Verified Citizen',
                  emailVerifiedAt: new Date().toISOString()
                }
              : state.currentUser;

          // Remove the verification email from simulated inbox
          const updatedInbox = state.simulatedInbox.filter((m) => m.userId !== userId);

          return {
            isLoading: false,
            registeredUsers: updatedUsers,
            currentUser: updatedCurrent,
            simulatedInbox: updatedInbox
          };
        });

        return { success: true };
      },

      // 4. Logout Action
      logout: () => {
        set({ currentUser: null, lastError: null });
      },

      // 5. Dismiss Inbox Message
      dismissInboxItem: (id) => {
        set((state) => ({
          simulatedInbox: state.simulatedInbox.filter((m) => m.id !== id)
        }));
      },

      // 6. Reset all demo data to default
      resetToDefaults: () => {
        set({
          currentUser: null,
          registeredUsers: DEFAULT_USERS,
          simulatedInbox: [],
          lastError: null,
          isLoading: false
        });
      }
    }),
    {
      name: 'zengfy-mock-auth-storage'
    }
  )
);
