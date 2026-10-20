import React, { useState } from 'react';
import { UserPlus, LogIn } from 'lucide-react';
import { useMockAuthStore } from './mockAuthStore';
import RegisterCard from './RegisterCard';
import LoginCard from './LoginCard';
import UserProfileCard from './UserProfileCard';

export default function AuthHub({ initialMode = 'register' }) {
  const [mode, setMode] = useState(initialMode); // 'register' | 'login'
  const { currentUser } = useMockAuthStore();

  return (
    <div className="w-full max-w-md mx-auto transition-all duration-300">
      
      {/* Top Segmented Mode Switcher (When not logged in) */}
      {!currentUser && (
        <div className="flex items-center justify-center p-1 bg-slate-100/90 rounded-2xl mb-4 border border-slate-200/80 shadow-xs backdrop-blur-md">
          <button
            type="button"
            onClick={() => setMode('register')}
            className={`flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-bold transition-all cursor-pointer ${
              mode === 'register'
                ? 'bg-white text-blue-600 shadow-sm border border-slate-200/50'
                : 'text-slate-600 hover:text-slate-900'
            }`}
          >
            <UserPlus className="w-3.5 h-3.5" />
            <span>নতুন অ্যাকাউন্ট (২টি ধাপ)</span>
          </button>

          <button
            type="button"
            onClick={() => setMode('login')}
            className={`flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl text-xs font-bold transition-all cursor-pointer ${
              mode === 'login'
                ? 'bg-white text-blue-600 shadow-sm border border-slate-200/50'
                : 'text-slate-600 hover:text-slate-900'
            }`}
          >
            <LogIn className="w-3.5 h-3.5" />
            <span>লগইন (Sign In)</span>
          </button>
        </div>
      )}

      {/* Main Authentication Form Card */}
      <div className="w-full">
        {currentUser ? (
          <UserProfileCard />
        ) : mode === 'register' ? (
          <RegisterCard onSwitchToLogin={() => setMode('login')} />
        ) : (
          <LoginCard onSwitchToRegister={() => setMode('register')} />
        )}
      </div>

    </div>
  );
}
