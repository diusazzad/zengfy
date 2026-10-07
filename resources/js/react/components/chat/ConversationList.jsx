import React, { useState } from 'react';
import { useQuery } from '@tanstack/react-query';
import { Search, MessageSquare, CheckCircle2, Loader2, UserX } from 'lucide-react';
import { apiRequest } from '../../lib/api';
import { useChatStore } from '../../store/useChatStore';
import { cn } from '../../utils/cn';

export default function ConversationList() {
    const { setActiveConversation } = useChatStore();
    const [searchQuery, setSearchQuery] = useState('');

    const { data, isLoading, isError, refetch } = useQuery({
        queryKey: ['conversations'],
        queryFn: async () => {
            const res = await apiRequest('/api/v1/conversations');
            return res?.data || [];
        },
        refetchInterval: 15000, // Poll every 15s as fallback if sockets reconnecting
    });

    const conversations = Array.isArray(data) ? data : [];

    // Filter by search query
    const filtered = conversations.filter((c) => {
        if (!searchQuery.trim()) return true;
        const q = searchQuery.toLowerCase();
        const partnerName = c.partner?.name?.toLowerCase() || '';
        const partnerHandle = c.partner?.handle?.toLowerCase() || '';
        const lastMsg = c.latest_message?.body?.toLowerCase() || '';
        return partnerName.includes(q) || partnerHandle.includes(q) || lastMsg.includes(q);
    });

    // Format relative time
    const formatTime = (isoString) => {
        if (!isoString) return '';
        try {
            const date = new Date(isoString);
            const now = new Date();
            const diffSec = Math.floor((now - date) / 1000);
            if (diffSec < 60) return 'now';
            if (diffSec < 3600) return `${Math.floor(diffSec / 60)}m`;
            if (diffSec < 86400) return `${Math.floor(diffSec / 3600)}h`;
            return date.toLocaleDateString('en-US', { month: 'numeric', day: 'numeric' });
        } catch {
            return '';
        }
    };

    return (
        <div className="flex flex-col h-full bg-[#121A29]">
            {/* Search Bar */}
            <div className="p-3 border-b border-white/10 bg-[#0B0F17]/40">
                <div className="relative">
                    <Search className="w-4 h-4 absolute left-3 top-2.5 text-gray-400" />
                    <input
                        type="text"
                        value={searchQuery}
                        onChange={(e) => setSearchQuery(e.target.value)}
                        placeholder="Search conversations..."
                        className="w-full bg-[#0B0F17] border border-white/10 rounded-xl pl-9 pr-3 py-2 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-blue-500"
                    />
                </div>
            </div>

            {/* Conversation Rows */}
            <div className="flex-1 overflow-y-auto divide-y divide-white/[0.05]">
                {isLoading && (
                    <div className="p-8 text-center space-y-3">
                        <Loader2 className="w-6 h-6 animate-spin text-blue-400 mx-auto" />
                        <p className="text-xs text-gray-400">Loading secure chats...</p>
                    </div>
                )}

                {isError && (
                    <div className="p-6 text-center space-y-2">
                        <p className="text-xs text-rose-400">Failed to load chat history.</p>
                        <button
                            type="button"
                            onClick={() => refetch()}
                            className="px-3 py-1.5 rounded-lg text-xs font-semibold bg-white/10 text-white hover:bg-white/15"
                        >
                            Retry
                        </button>
                    </div>
                )}

                {!isLoading && !isError && filtered.length === 0 && (
                    <div className="p-8 text-center space-y-2">
                        <div className="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 mx-auto">
                            <MessageSquare className="w-5 h-5" />
                        </div>
                        <p className="text-xs font-bold text-white">No active conversations</p>
                        <p className="text-[11px] text-gray-400">
                            Visit citizen profiles or send messages to start chatting!
                        </p>
                    </div>
                )}

                {!isLoading &&
                    filtered.map((convo) => {
                        const partner = convo.partner || { name: 'Citizen', handle: 'user' };
                        const nameParts = partner.name.trim().split(' ');
                        const initials = nameParts.length > 1
                            ? (nameParts[0][0] + nameParts[nameParts.length - 1][0]).toUpperCase()
                            : partner.name.substring(0, 2).toUpperCase();

                        const hasUnread = Number(convo.unread_count || 0) > 0;

                        return (
                            <div
                                key={convo.id}
                                onClick={() => setActiveConversation(convo)}
                                className={cn(
                                    'flex items-center gap-3 p-3.5 hover:bg-white/5 cursor-pointer transition-colors',
                                    hasUnread && 'bg-blue-500/[0.06]'
                                )}
                            >
                                {/* Avatar */}
                                <div className="relative shrink-0">
                                    {partner.avatar ? (
                                        <img
                                            src={partner.avatar}
                                            alt={partner.name}
                                            className="w-10 h-10 rounded-xl object-cover border border-white/10"
                                        />
                                    ) : (
                                        <div className="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-cyan-600 flex items-center justify-center text-xs font-bold text-white shadow-sm">
                                            {initials}
                                        </div>
                                    )}
                                    {partner.verified_badge && (
                                        <span className="absolute -bottom-1 -right-1 w-3.5 h-3.5 rounded-full bg-blue-500 border border-[#121A29] flex items-center justify-center text-[8px] text-white">
                                            ✓
                                        </span>
                                    )}
                                </div>

                                {/* Body */}
                                <div className="flex-1 min-w-0">
                                    <div className="flex items-center justify-between mb-0.5">
                                        <h4 className="text-xs font-bold text-white truncate flex items-center gap-1">
                                            <span>{partner.name}</span>
                                            {partner.verified_badge && (
                                                <CheckCircle2 className="w-3 h-3 text-blue-400 shrink-0" />
                                            )}
                                        </h4>
                                        <span className="text-[10px] text-gray-500 shrink-0">
                                            {formatTime(convo.latest_message?.created_at || convo.last_message_at)}
                                        </span>
                                    </div>
                                    <div className="flex items-center justify-between gap-2">
                                        <p
                                            className={cn(
                                                'text-xs truncate',
                                                hasUnread ? 'text-gray-100 font-semibold' : 'text-gray-400'
                                            )}
                                        >
                                            {convo.latest_message?.body || 'Started conversation'}
                                        </p>
                                        {hasUnread && (
                                            <span className="px-1.5 py-0.5 rounded-full text-[10px] font-extrabold bg-blue-600 text-white shadow-sm shrink-0">
                                                {convo.unread_count}
                                            </span>
                                        )}
                                    </div>
                                </div>
                            </div>
                        );
                    })}
            </div>
        </div>
    );
}
