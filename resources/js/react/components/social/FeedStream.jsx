import React, { useState, useEffect, useRef } from 'react';
import { useInfiniteQuery } from '@tanstack/react-query';
import { PlusCircle, RefreshCw, AlertCircle, Loader2, Sparkles, X } from 'lucide-react';
import PostCard from './PostCard';
import CreatePostModal from './CreatePostModal';
import { useSocialStore } from '../../store/useSocialStore';
import { apiRequest } from '../../lib/api';
import { cn } from '../../utils/cn';

export default function FeedStream({ initialWard = null }) {
    const { filterWard, setFilterWard, openCreateModal } = useSocialStore();
    const [selectedLightboxImage, setSelectedLightboxImage] = useState(null);

    // Read initial filter from URL (?filter=world|friends|community|nearby)
    const getInitialFilter = () => {
        try {
            const params = new URLSearchParams(window.location.search);
            const f = params.get('filter');
            if (f === 'friends' || f === 'community' || f === 'nearby') return f;
            if (f === 'ward') return 'nearby';
            return 'world';
        } catch {
            return 'world';
        }
    };

    const [activeFilter, setActiveFilter] = useState(getInitialFilter);
    const currentWard = filterWard || initialWard || 'WARD-DHAKA-19';
    const loadMoreTriggerRef = useRef(null);

    // Sync filter change to URL and broadcast to navigation shells
    const handleFilterChange = (filter) => {
        setActiveFilter(filter);
        try {
            const url = new URL(window.location.href);
            url.searchParams.set('filter', filter);
            window.history.replaceState({}, '', url.toString());
            window.dispatchEvent(new CustomEvent('zengfy:filter-changed', { detail: { filter } }));
        } catch {}
    };

    // Listen to popstate (e.g. browser back/forward) & external custom filter event
    useEffect(() => {
        const onPopState = () => {
            const params = new URLSearchParams(window.location.search);
            const f = params.get('filter');
            if (f === 'friends' || f === 'community' || f === 'nearby') setActiveFilter(f);
            else if (f === 'ward') setActiveFilter('nearby');
            else setActiveFilter('world');
        };

        const onExternalFilter = (e) => {
            const f = e.detail?.filter;
            if (f && (f === 'world' || f === 'friends' || f === 'community' || f === 'nearby')) {
                handleFilterChange(f);
            }
        };

        window.addEventListener('popstate', onPopState);
        window.addEventListener('zengfy:switch-filter', onExternalFilter);
        return () => {
            window.removeEventListener('popstate', onPopState);
            window.removeEventListener('zengfy:switch-filter', onExternalFilter);
        };
    }, []);

    // Infinite Query for 4 Dynamic Streams
    const {
        data,
        fetchNextPage,
        hasNextPage,
        isFetchingNextPage,
        isLoading,
        isError,
        error,
        refetch,
        isRefetching,
    } = useInfiniteQuery({
        queryKey: ['feed', activeFilter, currentWard],
        queryFn: async ({ pageParam = null }) => {
            let endpoint = `/api/v1/feed?filter=${encodeURIComponent(activeFilter)}&per_page=15`;
            if (activeFilter === 'nearby' && currentWard) {
                endpoint = `/api/v1/feed?filter=nearby&ward_code=${encodeURIComponent(currentWard)}&per_page=15`;
            }

            if (pageParam) {
                endpoint += `&cursor=${encodeURIComponent(pageParam)}`;
            }

            return await apiRequest(endpoint);
        },
        getNextPageParam: (lastPage) => lastPage?.meta?.next_cursor || undefined,
        initialPageParam: null,
    });

    // Auto-fetch next page when bottom observer triggers
    useEffect(() => {
        if (!hasNextPage || isFetchingNextPage) return;

        const observer = new IntersectionObserver(
            (entries) => {
                if (entries[0].isIntersecting) {
                    fetchNextPage();
                }
            },
            { threshold: 0.2 }
        );

        const currentTrigger = loadMoreTriggerRef.current;
        if (currentTrigger) {
            observer.observe(currentTrigger);
        }

        return () => {
            if (currentTrigger) observer.unobserve(currentTrigger);
        };
    }, [hasNextPage, isFetchingNextPage, fetchNextPage]);

    const posts = data?.pages?.flatMap((page) => page?.data || []) || [];

    const getEmptyStateMessage = () => {
        switch (activeFilter) {
            case 'friends':
                return {
                    title: 'No friends updates yet',
                    desc: 'Follow verified citizens or connect with friends to see their personal updates and photos here.',
                    icon: '👥',
                };
            case 'community':
                return {
                    title: 'No civic community posts yet',
                    desc: 'Be the first to post a neighborhood notice, civic forum update, or community announcement.',
                    icon: '🏛️',
                };
            case 'nearby':
                return {
                    title: `No updates in ${currentWard} yet`,
                    desc: 'Share what is happening right now in your ward or hyperlocal vicinity!',
                    icon: '📍',
                };
            default:
                return {
                    title: 'No citizen posts found in this feed',
                    desc: 'Be the first verified citizen to post an announcement or update to the timeline!',
                    icon: '🌱',
                };
        }
    };

    const emptyInfo = getEmptyStateMessage();

    return (
        <div className="space-y-6">
            {/* Control Bar: 4 Dynamic Stream Switcher Pills */}
            <div className="bg-[#121A29] border border-white/[0.08] hover:border-white/[0.18] transition-colors rounded-2xl p-3 sm:p-4 shadow-xl flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-4">
                <div className="flex items-center gap-1 sm:gap-1.5 p-1 bg-[#0B0F17]/85 rounded-xl border border-white/[0.06] w-full sm:w-auto overflow-x-auto no-scrollbar">
                    <button
                        type="button"
                        onClick={() => handleFilterChange('world')}
                        className={cn(
                            'flex-1 sm:flex-initial px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all cursor-pointer whitespace-nowrap active:scale-95',
                            activeFilter === 'world'
                                ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/20'
                                : 'text-gray-400 hover:text-gray-200 hover:bg-white/[0.05] border border-transparent'
                        )}
                    >
                        🌍 World
                    </button>
                    <button
                        type="button"
                        onClick={() => handleFilterChange('friends')}
                        className={cn(
                            'flex-1 sm:flex-initial px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all cursor-pointer whitespace-nowrap active:scale-95',
                            activeFilter === 'friends'
                                ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/20'
                                : 'text-gray-400 hover:text-gray-200 hover:bg-white/[0.05] border border-transparent'
                        )}
                    >
                        👥 Friends
                    </button>
                    <button
                        type="button"
                        onClick={() => handleFilterChange('community')}
                        className={cn(
                            'flex-1 sm:flex-initial px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all cursor-pointer whitespace-nowrap active:scale-95',
                            activeFilter === 'community'
                                ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/20'
                                : 'text-gray-400 hover:text-gray-200 hover:bg-white/[0.05] border border-transparent'
                        )}
                    >
                        🏛️ Community
                    </button>
                    <button
                        type="button"
                        onClick={() => handleFilterChange('nearby')}
                        className={cn(
                            'flex-1 sm:flex-initial px-3.5 py-1.5 rounded-xl text-xs font-bold transition-all cursor-pointer whitespace-nowrap active:scale-95',
                            activeFilter === 'nearby'
                                ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg shadow-blue-500/20'
                                : 'text-gray-400 hover:text-gray-200 hover:bg-white/[0.05] border border-transparent'
                        )}
                    >
                        📍 Nearby
                    </button>
                </div>

                <div className="flex items-center gap-2.5 w-full sm:w-auto justify-end">
                    <button
                        type="button"
                        onClick={() => refetch()}
                        disabled={isRefetching}
                        className="p-2.5 rounded-xl bg-white/[0.04] hover:bg-white/[0.08] border border-white/[0.08] text-gray-300 hover:text-white transition-all active:scale-95 cursor-pointer"
                        title="Refresh feed"
                    >
                        <RefreshCw className={cn('w-4 h-4', isRefetching && 'animate-spin text-blue-400')} />
                    </button>

                    <button
                        type="button"
                        onClick={openCreateModal}
                        className="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-lg shadow-blue-500/20 active:scale-95 transition-all cursor-pointer"
                    >
                        <PlusCircle className="w-4 h-4" />
                        <span>Create Post</span>
                    </button>
                </div>
            </div>

            {/* Quick Share Trigger (Linear Obsidian Surface) */}
            <div
                onClick={openCreateModal}
                className="bg-[#121A29] border border-white/[0.08] hover:border-white/[0.18] transition-colors rounded-2xl p-4 shadow-xl cursor-pointer group flex items-center gap-3.5 active:scale-[0.99]"
            >
                <div className="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-md shadow-blue-500/20 shrink-0">
                    ✍️
                </div>
                <div className="flex-1 bg-[#0B0F17] border border-white/[0.08] rounded-xl px-4 py-2.5 text-xs text-gray-400 group-hover:text-gray-300 group-hover:border-white/[0.18] transition-colors">
                    What's happening in your ward or area today? Click to share...
                </div>
                <button
                    type="button"
                    className="px-3.5 py-2 rounded-xl bg-blue-600/20 text-blue-400 group-hover:bg-blue-600 group-hover:text-white text-xs font-bold transition-all hidden sm:inline-flex items-center gap-1.5 active:scale-95"
                >
                    <Sparkles className="w-3.5 h-3.5" />
                    <span>Post</span>
                </button>
            </div>

            {/* Shimmering Skeleton State */}
            {isLoading && (
                <div className="space-y-4">
                    {[1, 2, 3].map((n) => (
                        <div key={n} className="bg-[#121A29] border border-white/[0.08] rounded-2xl p-5 shadow-xl relative overflow-hidden space-y-4">
                            <div className="flex items-center gap-3">
                                <div className="w-11 h-11 bg-white/10 rounded-xl animate-pulse" />
                                <div className="space-y-2 flex-1">
                                    <div className="w-32 h-3.5 bg-white/10 rounded animate-pulse" />
                                    <div className="w-20 h-2.5 bg-white/5 rounded animate-pulse" />
                                </div>
                            </div>
                            <div className="space-y-2">
                                <div className="w-full h-3 bg-white/10 rounded animate-pulse" />
                                <div className="w-4/5 h-3 bg-white/10 rounded animate-pulse" />
                            </div>
                            <div className="h-8 bg-white/5 rounded-xl animate-pulse" />
                        </div>
                    ))}
                </div>
            )}

            {/* Error State */}
            {isError && !isLoading && (
                <div className="bg-[#121A29] border border-rose-500/20 rounded-2xl p-6 text-center shadow-xl space-y-3">
                    <AlertCircle className="w-8 h-8 text-rose-400 mx-auto" />
                    <h3 className="text-sm font-bold text-gray-100">Unable to load timeline stream</h3>
                    <p className="text-xs text-gray-400">{error?.message || 'A network error occurred while connecting to the feed.'}</p>
                    <button
                        type="button"
                        onClick={() => refetch()}
                        className="px-4 py-2 rounded-xl text-xs font-bold bg-white/10 hover:bg-white/15 text-white active:scale-95 transition-all cursor-pointer"
                    >
                        Try Again
                    </button>
                </div>
            )}

            {/* Empty State */}
            {!isLoading && !isError && posts.length === 0 && (
                <div className="bg-[#121A29] border border-white/[0.08] rounded-2xl p-10 text-center shadow-xl space-y-3">
                    <div className="w-12 h-12 rounded-2xl bg-white/5 text-gray-400 mx-auto flex items-center justify-center text-xl">
                        {emptyInfo.icon}
                    </div>
                    <h3 className="text-base font-bold text-gray-100">{emptyInfo.title}</h3>
                    <p className="text-xs text-gray-400 max-w-sm mx-auto">
                        {emptyInfo.desc}
                    </p>
                    <button
                        type="button"
                        onClick={openCreateModal}
                        className="px-5 py-2.5 rounded-xl text-xs font-bold bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white shadow-lg shadow-blue-500/20 active:scale-95 transition-all cursor-pointer inline-flex items-center gap-2"
                    >
                        <PlusCircle className="w-4 h-4" />
                        <span>Publish First Post</span>
                    </button>
                </div>
            )}

            {/* Posts Stream */}
            {!isLoading && posts.length > 0 && (
                <div className="space-y-5">
                    {posts.map((post) => (
                        <PostCard
                            key={post.id}
                            post={post}
                            onImageClick={(url) => setSelectedLightboxImage(url)}
                        />
                    ))}

                    {/* Infinite Scroll Trigger & Loader */}
                    <div ref={loadMoreTriggerRef} className="py-4 text-center">
                        {isFetchingNextPage ? (
                            <div className="inline-flex items-center gap-2.5 px-5 py-2.5 rounded-xl bg-[#121A29] border border-white/[0.08] shadow-lg text-xs font-bold text-gray-100">
                                <Loader2 className="w-4 h-4 animate-spin text-blue-400" />
                                <span>Loading more updates...</span>
                            </div>
                        ) : hasNextPage ? (
                            <button
                                type="button"
                                onClick={() => fetchNextPage()}
                                className="px-5 py-2.5 rounded-xl text-xs font-bold text-gray-300 hover:text-white bg-white/5 hover:bg-white/10 border border-white/[0.08] active:scale-95 transition-all cursor-pointer"
                            >
                                Load More Posts
                            </button>
                        ) : (
                            <p className="text-xs text-gray-500 font-medium italic">
                                ✨ You have reached the end of the timeline feed
                            </p>
                        )}
                    </div>
                </div>
            )}

            {/* Image Lightbox Modal */}
            {selectedLightboxImage && (
                <div
                    onClick={() => setSelectedLightboxImage(null)}
                    className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/85 backdrop-blur-xl animate-in fade-in cursor-zoom-out"
                >
                    <div className="relative max-w-4xl max-h-[90vh]">
                        <img
                            src={selectedLightboxImage}
                            alt="Full preview"
                            className="w-full h-full object-contain rounded-2xl shadow-2xl border border-white/[0.08]"
                        />
                        <button
                            type="button"
                            onClick={() => setSelectedLightboxImage(null)}
                            className="absolute top-3 right-3 p-2 rounded-full bg-black/60 text-white hover:bg-rose-600 active:scale-95 transition-all cursor-pointer"
                        >
                            <X className="w-5 h-5" />
                        </button>
                    </div>
                </div>
            )}

            {/* Create Post Modal */}
            <CreatePostModal />
        </div>
    );
}
