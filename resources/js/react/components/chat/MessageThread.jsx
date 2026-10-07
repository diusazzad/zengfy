import React, { useState, useEffect, useRef } from 'react';
import { useQuery, useQueryClient } from '@tanstack/react-query';
import { ArrowLeft, Send, CheckCircle2, Loader2, Sparkles, AlertCircle, CheckCheck } from 'lucide-react';
import { apiRequest } from '../../lib/api';
import { useChatStore } from '../../store/useChatStore';
import { cn } from '../../utils/cn';

export default function MessageThread({ conversation, onBack }) {
    if (!conversation) return null;

    const queryClient = useQueryClient();
    const { closeActiveConversation } = useChatStore();

    const [inputMessage, setInputMessage] = useState('');
    const [messagesList, setMessagesList] = useState([]);
    const [isSending, setIsSending] = useState(false);
    const [partnerIsTyping, setPartnerIsTyping] = useState(false);
    const [currentUserId, setCurrentUserId] = useState(null);

    const messagesEndRef = useRef(null);
    const typingTimeoutRef = useRef(null);
    const inputRef = useRef(null);

    const partner = conversation.partner || { name: 'Citizen', handle: 'user' };

    // Auto-scroll to bottom
    const scrollToBottom = (smooth = true) => {
        messagesEndRef.current?.scrollIntoView({ behavior: smooth ? 'smooth' : 'auto' });
    };

    // 1. Fetch initial message history
    const { data: messagesData, isLoading, isError } = useQuery({
        queryKey: ['messages', conversation.id],
        queryFn: async () => {
            const res = await apiRequest(`/api/v1/conversations/${conversation.id}/messages?per_page=50`);
            return res?.data || [];
        },
    });

    // Sync initial messages (server sends descending, reverse for chronological chat flow)
    useEffect(() => {
        if (messagesData) {
            const sorted = [...messagesData].reverse();
            setMessagesList(sorted);
            setTimeout(() => scrollToBottom(false), 50);
        }
    }, [messagesData]);

    // Focus input on load
    useEffect(() => {
        inputRef.current?.focus();
    }, [conversation.id]);

    // 2. Mark as read on mount
    useEffect(() => {
        apiRequest(`/api/v1/conversations/${conversation.id}/read`, { method: 'POST' }).catch(() => {});
        queryClient.invalidateQueries({ queryKey: ['conversations'] });
    }, [conversation.id]);

    // 3. Connect to Laravel Reverb WebSockets via window.Echo
    useEffect(() => {
        if (typeof window.initEcho === 'function') {
            window.initEcho();
        }

        const echo = window.Echo;
        if (!echo) {
            console.warn('[Zengfy Chat] Echo instance not available, real-time fallback active');
            return;
        }

        const channelName = `chat.${conversation.id}`;
        
        try {
            const channel = echo.private ? echo.private(channelName) : echo.channel(channelName);

            // Listen for new incoming messages
            channel.listen('.message.sent', (event) => {
                const incomingMessage = event.message || event;
                if (!incomingMessage || !incomingMessage.id) return;

                setMessagesList((prev) => {
                    if (prev.some((m) => m.id === incomingMessage.id)) return prev;
                    return [...prev, incomingMessage];
                });

                setPartnerIsTyping(false);
                setTimeout(scrollToBottom, 50);
                queryClient.invalidateQueries({ queryKey: ['conversations'] });
            });

            // Listen for typing events
            channel.listen('.user.typing', (event) => {
                if (event.user && event.user.id !== currentUserId) {
                    setPartnerIsTyping(Boolean(event.is_typing));

                    if (typingTimeoutRef.current) clearTimeout(typingTimeoutRef.current);
                    if (event.is_typing) {
                        typingTimeoutRef.current = setTimeout(() => {
                            setPartnerIsTyping(false);
                        }, 3000);
                    }
                    setTimeout(scrollToBottom, 50);
                }
            });

            return () => {
                if (typingTimeoutRef.current) clearTimeout(typingTimeoutRef.current);
                echo.leave(channelName);
            };
        } catch (e) {
            console.error('[Zengfy Chat] Error setting up Echo listener', e);
        }
    }, [conversation.id, currentUserId]);

    // 4. Send Message Handler
    const handleSendMessage = async (e) => {
        if (e) e.preventDefault();
        const text = inputMessage.trim();
        if (!text || isSending) return;

        setInputMessage('');
        setIsSending(true);

        const tempId = `temp-${Date.now()}`;
        const optimisticMessage = {
            id: tempId,
            conversation_id: conversation.id,
            body: text,
            message_type: 'text',
            created_at: new Date().toISOString(),
            sender_id: currentUserId,
            is_optimistic: true,
        };

        setMessagesList((prev) => [...prev, optimisticMessage]);
        setTimeout(scrollToBottom, 30);

        try {
            const res = await apiRequest(`/api/v1/conversations/${conversation.id}/messages`, {
                method: 'POST',
                body: JSON.stringify({
                    body: text,
                    message_type: 'text',
                }),
            });

            const confirmedMessage = res?.data;
            if (confirmedMessage) {
                setMessagesList((prev) =>
                    prev.map((m) => (m.id === tempId ? confirmedMessage : m))
                );
            }

            queryClient.invalidateQueries({ queryKey: ['conversations'] });
        } catch (err) {
            console.error('[Zengfy Chat] Send message failed', err);
            setMessagesList((prev) =>
                prev.map((m) => (m.id === tempId ? { ...m, failed: true } : m))
            );
        } finally {
            setIsSending(false);
            setTimeout(scrollToBottom, 50);
        }
    };

    // Keyboard Handler: Enter to send, Shift+Enter for new line
    const handleKeyDown = (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            handleSendMessage();
        }
    };

    // Input Change with Debounced Typing Broadcast
    const handleInputChange = (e) => {
        setInputMessage(e.target.value);

        if (!typingTimeoutRef.current) {
            apiRequest(`/api/v1/conversations/${conversation.id}/typing`, {
                method: 'POST',
                body: JSON.stringify({ is_typing: true }),
            }).catch(() => {});

            typingTimeoutRef.current = setTimeout(() => {
                typingTimeoutRef.current = null;
            }, 2500);
        }
    };

    const formatBubbleTime = (isoString) => {
        if (!isoString) return '';
        try {
            const date = new Date(isoString);
            return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        } catch {
            return '';
        }
    };

    return (
        <div className="flex flex-col h-full bg-[#121A29]">
            {/* Thread Header */}
            <div className="flex items-center justify-between px-4 py-3 border-b border-white/10 bg-[#0B0F17]/60">
                <div className="flex items-center gap-2.5">
                    <button
                        type="button"
                        onClick={onBack || closeActiveConversation}
                        className="p-1 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 transition-colors cursor-pointer"
                        title="Back to conversations"
                    >
                        <ArrowLeft className="w-5 h-5" />
                    </button>

                    <div className="relative">
                        {partner.avatar ? (
                            <img
                                src={partner.avatar}
                                alt={partner.name}
                                className="w-9 h-9 rounded-xl object-cover border border-white/10"
                            />
                        ) : (
                            <div className="w-9 h-9 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-xs font-bold text-white">
                                {partner.name?.substring(0, 2).toUpperCase() || 'CZ'}
                            </div>
                        )}
                        {partner.verified_badge && (
                            <span className="absolute -bottom-1 -right-1 w-3.5 h-3.5 rounded-full bg-blue-500 border border-[#121A29] flex items-center justify-center text-[8px] text-white">
                                ✓
                            </span>
                        )}
                    </div>

                    <div>
                        <h4 className="text-xs font-bold text-white flex items-center gap-1">
                            <span>{partner.name}</span>
                            {partner.verified_badge && (
                                <CheckCircle2 className="w-3 h-3 text-blue-400 shrink-0" />
                            )}
                        </h4>
                        <p className="text-[10px] text-gray-400">
                            {partnerIsTyping ? (
                                <span className="text-cyan-400 font-semibold animate-pulse">Citizen is typing...</span>
                            ) : (
                                `@{${partner.handle || 'citizen'}}`
                            )}
                        </p>
                    </div>
                </div>

                <div className="flex items-center gap-1.5 text-[10px] font-semibold text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-full border border-emerald-500/20">
                    <span className="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping" />
                    <span>Reverb Live</span>
                </div>
            </div>

            {/* Messages Scroll Area */}
            <div className="flex-1 overflow-y-auto p-4 space-y-3">
                {isLoading && (
                    <div className="p-8 text-center space-y-2">
                        <Loader2 className="w-6 h-6 animate-spin text-blue-400 mx-auto" />
                        <p className="text-xs text-gray-400">Loading conversation history...</p>
                    </div>
                )}

                {isError && (
                    <div className="p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 text-center text-xs text-rose-300">
                        Failed to load conversation history.
                    </div>
                )}

                {!isLoading && messagesList.length === 0 && (
                    <div className="p-8 text-center space-y-2">
                        <div className="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-gray-400 mx-auto">
                            💬
                        </div>
                        <p className="text-xs font-bold text-white">Say hello to {partner.name}!</p>
                        <p className="text-[11px] text-gray-400">
                            This is an end-to-end sovereign conversation.
                        </p>
                    </div>
                )}

                {messagesList.map((msg) => {
                    const isSender = msg.sender_id ? msg.sender_id !== partner.id : Boolean(msg.is_optimistic);

                    return (
                        <div
                            key={msg.id}
                            className={cn('flex flex-col', isSender ? 'items-end' : 'items-start')}
                        >
                            <div
                                className={cn(
                                    'max-w-[78%] rounded-2xl px-3.5 py-2.5 text-xs shadow-md selection:bg-white selection:text-blue-900',
                                    isSender
                                        ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-tr-none'
                                        : 'bg-[#1E293B] border border-white/10 text-gray-200 rounded-tl-none',
                                    msg.failed && 'border border-rose-500/50 bg-rose-950/40 text-rose-200'
                                )}
                            >
                                <p className="whitespace-pre-wrap leading-relaxed">{msg.body}</p>
                            </div>
                            <div className="flex items-center gap-1 mt-1 px-1 text-[9px] text-gray-500">
                                <span>{formatBubbleTime(msg.created_at)}</span>
                                {isSender && !msg.failed && !msg.is_optimistic && (
                                    <CheckCheck className="w-3 h-3 text-cyan-400" />
                                )}
                                {msg.failed && (
                                    <span className="text-rose-400 flex items-center gap-0.5">
                                        <AlertCircle className="w-2.5 h-2.5" /> Failed
                                    </span>
                                )}
                                {msg.is_optimistic && !msg.failed && (
                                    <span className="text-blue-400">Sending...</span>
                                )}
                            </div>
                        </div>
                    );
                })}

                {/* Partner Typing Indicator */}
                {partnerIsTyping && (
                    <div className="flex items-start">
                        <div className="bg-[#1E293B] border border-white/10 rounded-2xl rounded-tl-none px-3.5 py-2.5 text-xs text-gray-400 flex items-center gap-1.5 shadow-md animate-pulse">
                            <span className="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-bounce" />
                            <span className="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-bounce delay-100" />
                            <span className="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-bounce delay-200" />
                        </div>
                    </div>
                )}

                <div ref={messagesEndRef} />
            </div>

            {/* Input Bar with Enter to Send */}
            <form onSubmit={handleSendMessage} className="p-3 border-t border-white/10 bg-[#0B0F17]/60">
                <div className="flex items-center gap-2">
                    <input
                        ref={inputRef}
                        type="text"
                        value={inputMessage}
                        onChange={handleInputChange}
                        onKeyDown={handleKeyDown}
                        placeholder={`Message ${partner.name}... (Press Enter)`}
                        className="flex-1 bg-[#0B0F17] border border-white/10 rounded-xl px-3.5 py-2.5 text-xs text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all"
                    />
                    <button
                        type="submit"
                        disabled={!inputMessage.trim() || isSending}
                        className="p-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white disabled:opacity-40 transition-colors shadow-md shadow-blue-600/30 cursor-pointer"
                        title="Send message"
                    >
                        <Send className="w-4 h-4" />
                    </button>
                </div>
            </form>
        </div>
    );
}
