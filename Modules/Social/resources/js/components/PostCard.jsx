import React, { useState } from 'react';
import { Heart, MessageCircle, Share2, MapPin, CheckCircle2, ShieldCheck, Image as ImageIcon, Send } from 'lucide-react';
import { apiRequest } from '@/lib/api';
import { useSocialStore } from '../store/useSocialStore';
import { cn } from '@/utils/cn';

export default function PostCard({ post, onImageClick }) {
    if (!post) return null;

    const { likedPosts, setPostLikedState } = useSocialStore();

    // Determine like state
    const storeLikeState = likedPosts[post.id];
    const isLiked = storeLikeState !== undefined ? storeLikeState.liked : Boolean(post.is_liked || post.liked_by_viewer);
    const likesCount = storeLikeState !== undefined ? storeLikeState.count : Number(post.likes_count || 0);

    const [isLikePending, setIsLikePending] = useState(false);
    const [likeHeartPop, setLikeHeartPop] = useState(false);
    const [copiedNotification, setCopiedNotification] = useState(false);

    // Comments Drawer State
    const [showComments, setShowComments] = useState(false);
    const [commentText, setCommentText] = useState('');
    const [commentsCount, setCommentsCount] = useState(Number(post.comments_count || 0));
    const [localComments, setLocalComments] = useState([
        {
            id: 'c1',
            author: 'Ayesha Siddiqua',
            handle: 'ayesha',
            avatar: null,
            verified: true,
            time: '25m ago',
            body: 'Strongly agree with this civic initiative. Ward coordination is much needed here.',
            likes: 4,
        },
    ]);

    // Optimistic Like Handler
    const handleToggleLike = async (e) => {
        e.preventDefault();
        e.stopPropagation();

        if (isLikePending) return;

        const nextLiked = !isLiked;
        const nextCount = nextLiked ? likesCount + 1 : Math.max(0, likesCount - 1);

        // Optimistic UI
        setPostLikedState(post.id, nextLiked, nextCount);
        setLikeHeartPop(true);
        setTimeout(() => setLikeHeartPop(false), 600);

        setIsLikePending(true);

        try {
            const res = await apiRequest(`/api/v1/posts/${post.id}/like`, {
                method: 'POST',
            });
            if (res?.data) {
                setPostLikedState(post.id, res.data.liked, res.data.likes_count);
            }
        } catch (err) {
            console.error('Failed to toggle like on post', post.id, err);
            // Rollback on network failure
            setPostLikedState(post.id, isLiked, likesCount);
        } finally {
            setIsLikePending(false);
        }
    };

    // Share link handler
    const handleShare = (e) => {
        e.preventDefault();
        const shareUrl = `${window.location.origin}/posts/${post.id}`;
        if (navigator.clipboard) {
            navigator.clipboard.writeText(shareUrl).then(() => {
                setCopiedNotification(true);
                setTimeout(() => setCopiedNotification(false), 2500);
            }).catch(() => {});
        }
    };

    // Add Comment Handler
    const handleAddComment = (e) => {
        e.preventDefault();
        const text = commentText.trim();
        if (!text) return;

        const newComment = {
            id: `cmt-${Date.now()}`,
            author: 'You (Citizen)',
            handle: 'citizen',
            avatar: null,
            verified: true,
            time: 'Just now',
            body: text,
            likes: 0,
        };

        setLocalComments((prev) => [newComment, ...prev]);
        setCommentsCount((prev) => prev + 1);
        setCommentText('');
    };

    // Author Details
    const authorName = post.user?.name || post.author?.name || 'Zengfy Citizen';
    const authorHandle = post.user?.handle || post.author?.handle || 'citizen';
    const authorAvatar = post.user?.avatar_url || post.user?.avatar || post.author?.avatar_url || null;
    const isVerified = Boolean(post.user?.verified_badge || post.author?.verified_badge);

    const nameParts = authorName.trim().split(' ');
    const initials = nameParts.length > 1
        ? (nameParts[0][0] + nameParts[nameParts.length - 1][0]).toUpperCase()
        : authorName.substring(0, 2).toUpperCase();

    const mediaList = Array.isArray(post.media) ? post.media : [];

    const formatTime = (isoString) => {
        if (!isoString) return 'Just now';
        try {
            const date = new Date(isoString);
            const now = new Date();
            const diffSec = Math.floor((now - date) / 1000);
            if (diffSec < 60) return 'Just now';
            if (diffSec < 3600) return `${Math.floor(diffSec / 60)}m ago`;
            if (diffSec < 86400) return `${Math.floor(diffSec / 3600)}h ago`;
            return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
        } catch {
            return 'Recently';
        }
    };

    return (
        <article className="bg-[#121A29] border border-white/[0.08] hover:border-white/[0.18] transition-colors rounded-2xl p-5 shadow-xl relative overflow-hidden">
            {/* Header */}
            <div className="flex items-start justify-between gap-3 mb-3.5">
                <div className="flex items-center gap-3 min-w-0">
                    <div className="relative shrink-0">
                        {authorAvatar ? (
                            <img
                                src={authorAvatar}
                                alt={authorName}
                                className="w-11 h-11 rounded-xl object-cover border border-white/10 shadow-md"
                            />
                        ) : (
                            <div className="w-11 h-11 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-sm font-extrabold text-white shadow-md shadow-blue-500/20">
                                {initials}
                            </div>
                        )}
                        {isVerified && (
                            <span
                                className="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-blue-500 border-2 border-[#121A29] flex items-center justify-center text-[9px] text-white font-bold"
                                title="Verified Citizen"
                            >
                                <CheckCircle2 className="w-3 h-3 fill-blue-500 text-white" />
                            </span>
                        )}
                    </div>

                    <div className="min-w-0 flex-1">
                        <div className="flex items-center gap-1.5 flex-wrap">
                            <h3 className="text-sm font-bold text-gray-100 truncate hover:text-blue-400 transition-colors">
                                {authorName}
                            </h3>
                            {isVerified && (
                                <span className="inline-flex items-center gap-0.5 px-1.5 py-0.5 rounded text-[10px] font-bold bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                    Verified
                                </span>
                            )}
                        </div>
                        <div className="flex items-center gap-2 text-xs text-gray-400">
                            <span className="truncate">@{authorHandle}</span>
                            <span>•</span>
                            <span className="shrink-0 text-gray-500">{formatTime(post.created_at)}</span>
                        </div>
                    </div>
                </div>

                <div className="flex items-center gap-2 shrink-0">
                    {(post.post_type === 'hyperlocal_notice' || post.post_type === 'civic_notice') && (
                        <span className="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                            <ShieldCheck className="w-3 h-3" /> Civic Notice
                        </span>
                    )}
                    {post.post_type === 'announcement' && (
                        <span className="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-cyan-500/10 text-cyan-400 border border-cyan-500/20">
                            📢 Announcement
                        </span>
                    )}
                    {post.ward_code && (
                        <span className="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-blue-500/10 text-blue-300 border border-blue-500/20">
                            <MapPin className="w-3 h-3" />
                            {post.ward_code}
                        </span>
                    )}
                </div>
            </div>

            {/* Post Content */}
            {post.content && (
                <div className="text-sm text-gray-300 whitespace-pre-line leading-relaxed mb-4 selection:bg-blue-600 selection:text-white">
                    {post.content}
                </div>
            )}

            {/* Media Gallery */}
            {mediaList.length > 0 && (
                <div
                    className={cn(
                        'mb-4 rounded-xl overflow-hidden grid gap-2 border border-white/5',
                        mediaList.length === 1 ? 'grid-cols-1' :
                        mediaList.length === 2 ? 'grid-cols-2' :
                        'grid-cols-2 md:grid-cols-3'
                    )}
                >
                    {mediaList.map((item, idx) => (
                        <div
                            key={idx}
                            onClick={() => onImageClick ? onImageClick(item.url || item) : null}
                            className="relative group bg-black/40 overflow-hidden aspect-video md:aspect-square cursor-pointer rounded-lg border border-white/5"
                        >
                            <img
                                src={item.url || item}
                                alt="Post media"
                                className="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                loading="lazy"
                            />
                            <div className="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <ImageIcon className="w-6 h-6 text-white drop-shadow" />
                            </div>
                        </div>
                    ))}
                </div>
            )}

            {/* Actions Bar */}
            <div className="flex items-center justify-between pt-3 border-t border-white/[0.08] text-xs">
                {/* Optimistic Like Button with Heartburst animation */}
                <button
                    type="button"
                    onClick={handleToggleLike}
                    disabled={isLikePending}
                    aria-label={isLiked ? 'Unlike post' : 'Like post'}
                    className={cn(
                        'relative flex items-center gap-2 px-3 py-1.5 rounded-lg font-semibold transition-all duration-200 select-none cursor-pointer active:scale-95',
                        isLiked
                            ? 'text-rose-400 bg-rose-500/10 border border-rose-500/20 shadow-sm shadow-rose-500/20'
                            : 'text-gray-400 hover:text-rose-400 hover:bg-white/5'
                    )}
                >
                    <Heart
                        className={cn(
                            'w-4 h-4 transition-transform duration-200',
                            isLiked ? 'fill-rose-500 text-rose-500' : 'text-current',
                            likeHeartPop && 'scale-150 animate-ping'
                        )}
                    />
                    <span className="font-bold">{likesCount}</span>
                </button>

                {/* Comment Drawer Toggle Button */}
                <button
                    type="button"
                    onClick={() => setShowComments(!showComments)}
                    className={cn(
                        'flex items-center gap-2 px-3 py-1.5 rounded-lg font-semibold transition-all duration-200 cursor-pointer active:scale-95',
                        showComments
                            ? 'text-blue-400 bg-blue-500/10 border border-blue-500/20'
                            : 'text-gray-400 hover:text-blue-400 hover:bg-white/5'
                    )}
                >
                    <MessageCircle className="w-4 h-4" />
                    <span>{commentsCount}</span>
                </button>

                {/* Share Button */}
                <div className="relative">
                    <button
                        type="button"
                        onClick={handleShare}
                        className="flex items-center gap-1.5 px-3 py-1.5 rounded-lg font-semibold text-gray-400 hover:text-cyan-400 hover:bg-white/5 transition-all duration-200 active:scale-95 cursor-pointer"
                        title="Copy post link"
                    >
                        <Share2 className="w-4 h-4" />
                        <span className="hidden sm:inline">Share</span>
                    </button>
                    {copiedNotification && (
                        <div className="absolute right-0 -top-8 px-2.5 py-1 bg-cyan-600 text-white font-bold text-[10px] rounded-md shadow-lg shadow-cyan-600/30 whitespace-nowrap animate-bounce">
                            Link copied!
                        </div>
                    )}
                </div>
            </div>

            {/* Expandable Comments Drawer */}
            {showComments && (
                <div className="mt-4 pt-4 border-t border-white/[0.08] space-y-3.5 animate-in fade-in slide-in-from-top-2 duration-200">
                    {/* Add Comment Input */}
                    <form onSubmit={handleAddComment} className="flex items-center gap-2">
                        <div className="w-8 h-8 rounded-lg bg-blue-600/20 text-blue-400 flex items-center justify-center font-bold text-xs shrink-0">
                            ZC
                        </div>
                        <input
                            type="text"
                            value={commentText}
                            onChange={(e) => setCommentText(e.target.value)}
                            placeholder="Write a citizen comment..."
                            className="flex-1 bg-[#0B0F17] border border-white/[0.08] rounded-xl px-3.5 py-2 text-xs text-gray-100 placeholder-gray-500 focus:outline-none focus:border-blue-500 transition-all"
                        />
                        <button
                            type="submit"
                            disabled={!commentText.trim()}
                            className="p-2 rounded-xl bg-blue-600 hover:bg-blue-500 text-white disabled:opacity-40 transition-all shadow-md shadow-blue-600/20 active:scale-95 cursor-pointer"
                            title="Submit comment"
                        >
                            <Send className="w-3.5 h-3.5" />
                        </button>
                    </form>

                    {/* Comments List */}
                    <div className="space-y-2.5 pl-2">
                        {localComments.map((cmt) => (
                            <div key={cmt.id} className="flex items-start gap-2.5 bg-[#0B0F17] rounded-xl p-3 border border-white/[0.06]">
                                <div className="w-7 h-7 rounded-lg bg-gradient-to-tr from-blue-600 to-cyan-600 flex items-center justify-center text-[10px] font-bold text-white shrink-0">
                                    {cmt.author.substring(0, 2).toUpperCase()}
                                </div>
                                <div className="flex-1 min-w-0">
                                    <div className="flex items-center justify-between mb-0.5">
                                        <div className="flex items-center gap-1.5">
                                            <span className="text-xs font-bold text-gray-100 truncate">{cmt.author}</span>
                                            {cmt.verified && (
                                                <CheckCircle2 className="w-3 h-3 text-blue-400 shrink-0" />
                                            )}
                                        </div>
                                        <span className="text-[10px] text-gray-500">{cmt.time}</span>
                                    </div>
                                    <p className="text-xs text-gray-300 leading-relaxed">{cmt.body}</p>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            )}
        </article>
    );
}
