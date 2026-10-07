import React from 'react';
import { MessageSquare, X, Minus, Sparkles, ShieldCheck } from 'lucide-react';
import { useChatStore } from '../../store/useChatStore';
import ConversationList from './ConversationList';
import MessageThread from './MessageThread';
import { cn } from '../../utils/cn';

export default function ChatDrawer() {
    const { isOpen, setIsOpen, toggleChat, activeConversation, closeActiveConversation, unreadTotal } = useChatStore();

    return (
        <>
            {/* Floating Trigger Launcher Button with Glow and Pulsing Unread Badge */}
            <div className="fixed bottom-6 right-6 z-40">
                <button
                    type="button"
                    onClick={toggleChat}
                    className="relative w-14 h-14 rounded-2xl bg-gradient-to-tr from-blue-600 via-indigo-600 to-cyan-500 text-white flex items-center justify-center shadow-2xl shadow-blue-600/40 hover:scale-105 active:scale-95 transition-all cursor-pointer group border border-white/20"
                    aria-label="Toggle Zengfy Chat"
                >
                    <MessageSquare className="w-6 h-6 transition-transform group-hover:scale-110 drop-shadow" />

                    {/* Unread Counter Badge */}
                    {unreadTotal > 0 && (
                        <span className="absolute -top-1.5 -right-1.5 px-1.5 py-0.5 min-w-[20px] h-5 rounded-full bg-rose-500 border-2 border-[#0B0F17] flex items-center justify-center text-[10px] font-black text-white shadow-lg shadow-rose-500/50 animate-bounce">
                            {unreadTotal > 9 ? '9+' : unreadTotal}
                        </span>
                    )}

                    {/* Ambient Glow */}
                    <div className="absolute inset-0 rounded-2xl bg-blue-500/20 blur-lg -z-10 group-hover:bg-cyan-500/30 transition-colors" />
                </button>
            </div>

            {/* Floating Chat Drawer Window with Smooth Transition Animations */}
            {isOpen && (
                <div
                    className={cn(
                        'fixed z-50 transition-all duration-300 ease-out',
                        'bottom-24 right-4 sm:right-6 w-[92vw] sm:w-[380px] md:w-[410px] h-[560px] max-h-[82vh]',
                        'bg-[#121A29] border border-white/10 rounded-3xl shadow-2xl flex flex-col overflow-hidden backdrop-blur-2xl',
                        'animate-in fade-in slide-in-from-bottom-8 zoom-in-95'
                    )}
                >
                    {/* Top Main Window Header */}
                    <div className="flex items-center justify-between px-4 py-3.5 bg-[#0B0F17]/90 border-b border-white/10 select-none">
                        <div className="flex items-center gap-2.5">
                            <div className="w-8 h-8 rounded-xl bg-blue-600/20 border border-blue-500/30 text-blue-400 flex items-center justify-center">
                                <Sparkles className="w-4 h-4 text-cyan-400" />
                            </div>
                            <div>
                                <h3 className="text-xs font-bold text-white leading-tight">Zengfy Secure Chat</h3>
                                <p className="text-[10px] text-gray-400 flex items-center gap-1">
                                    <ShieldCheck className="w-3 h-3 text-emerald-400" />
                                    <span>256-Bit Encrypted WebSockets</span>
                                </p>
                            </div>
                        </div>

                        <div className="flex items-center gap-1">
                            <button
                                type="button"
                                onClick={() => setIsOpen(false)}
                                className="p-1.5 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 transition-colors cursor-pointer"
                                title="Minimize"
                            >
                                <Minus className="w-4 h-4" />
                            </button>
                            <button
                                type="button"
                                onClick={() => {
                                    setIsOpen(false);
                                    closeActiveConversation();
                                }}
                                className="p-1.5 rounded-lg text-gray-400 hover:text-white hover:bg-white/5 transition-colors cursor-pointer"
                                title="Close"
                            >
                                <X className="w-4 h-4" />
                            </button>
                        </div>
                    </div>

                    {/* Chat Body */}
                    <div className="flex-1 overflow-hidden relative">
                        {activeConversation ? (
                            <MessageThread
                                conversation={activeConversation}
                                onBack={closeActiveConversation}
                            />
                        ) : (
                            <ConversationList />
                        )}
                    </div>
                </div>
            )}
        </>
    );
}
