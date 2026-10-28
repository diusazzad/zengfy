import React from 'react';
import { Mail, ExternalLink, CheckCircle2, X } from 'lucide-react';
import { useMockAuthStore } from './mockAuthStore';

export default function SimulatedInboxBanner() {
  const { simulatedInbox, verifyEmail, dismissInboxItem, isLoading } = useMockAuthStore();

  if (!simulatedInbox || simulatedInbox.length === 0) return null;

  const latestMail = simulatedInbox[0];

  return (
    <div className="mb-6 p-4 rounded-2xl bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200/80 shadow-sm animate-in fade-in slide-in-from-top-4 duration-300">
      <div className="flex items-start justify-between gap-3">
        <div className="flex items-start gap-3">
          <div className="w-9 h-9 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-xs">
            <Mail className="w-4 h-4" />
          </div>
          <div>
            <div className="flex items-center gap-2">
              <span className="text-[11px] font-black uppercase tracking-wider text-blue-700 bg-blue-100/80 px-2 py-0.5 rounded-md">
                সিমুলেটেড ইনবক্স টেস্ট
              </span>
              <span className="text-[10px] text-slate-400 font-mono">{latestMail.sentAt}</span>
            </div>
            <h4 className="text-xs font-bold text-slate-900 mt-1">{latestMail.subject}</h4>
            <p className="text-[11px] text-slate-600 mt-0.5 leading-relaxed">
              প্রাপক: <span className="font-semibold text-slate-800">{latestMail.to}</span>
            </p>
          </div>
        </div>

        <button
          onClick={() => dismissInboxItem(latestMail.id)}
          className="text-slate-400 hover:text-slate-600 p-1 rounded-lg transition-colors"
          title="বন্ধ করুন"
        >
          <X className="w-4 h-4" />
        </button>
      </div>

      <div className="mt-3.5 pt-3 border-t border-blue-200/60 flex items-center justify-between flex-wrap gap-2">
        <span className="text-[11px] text-blue-900/80 font-medium">
          💡 কোনো আসল ইমেইল না পাঠিয়েই টেস্ট করতে লিংকে ক্লিক করুন:
        </span>
        <button
          onClick={() => verifyEmail(latestMail.userId)}
          disabled={isLoading}
          className="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-blue-600 hover:bg-blue-700 active:scale-95 text-white text-xs font-bold shadow-xs hover:shadow-md transition-all cursor-pointer disabled:opacity-50"
        >
          <CheckCircle2 className="w-3.5 h-3.5" />
          <span>ভেরিফাই করুন (Verify Email)</span>
          <ExternalLink className="w-3 h-3 ml-0.5 opacity-80" />
        </button>
      </div>
    </div>
  );
}
