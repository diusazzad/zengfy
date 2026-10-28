import React, { useState, useRef } from 'react';
import { X, Image as ImageIcon, MapPin, Loader2, Sparkles, Send, UploadCloud } from 'lucide-react';
import { useQueryClient } from '@tanstack/react-query';
import { useSocialStore } from '../store/useSocialStore';
import { apiRequest } from '@/lib/api';
import { cn } from '@/utils/cn';

export default function CreatePostModal() {
    const { isCreateModalOpen, closeCreateModal, filterWard } = useSocialStore();
    const queryClient = useQueryClient();

    const [content, setContent] = useState('');
    const [wardCode, setWardCode] = useState(filterWard || 'WARD-DHAKA-19');
    const [postType, setPostType] = useState('standard');
    const [visibility, setVisibility] = useState('public');
    const [selectedFiles, setSelectedFiles] = useState([]);
    const [filePreviews, setFilePreviews] = useState([]);
    const [isSubmitting, setIsSubmitting] = useState(false);
    const [errorMessage, setErrorMessage] = useState('');
    const [isDragging, setIsDragging] = useState(false);

    const fileInputRef = useRef(null);

    if (!isCreateModalOpen) return null;

    const handleFiles = (files) => {
        if (!files || files.length === 0) return;
        const validFiles = Array.from(files).filter(f => f.type.startsWith('image/'));
        if (validFiles.length === 0) return;

        const combined = [...selectedFiles, ...validFiles].slice(0, 4);
        setSelectedFiles(combined);

        const newPreviews = combined.map((f) => URL.createObjectURL(f));
        setFilePreviews(newPreviews);
    };

    const handleDrop = (e) => {
        e.preventDefault();
        e.stopPropagation();
        setIsDragging(false);
        if (e.dataTransfer?.files) {
            handleFiles(e.dataTransfer.files);
        }
    };

    const handleDragOver = (e) => {
        e.preventDefault();
        e.stopPropagation();
        setIsDragging(true);
    };

    const handleDragLeave = (e) => {
        e.preventDefault();
        e.stopPropagation();
        setIsDragging(false);
    };

    const handleRemoveFile = (index) => {
        const nextFiles = selectedFiles.filter((_, idx) => idx !== index);
        const nextPreviews = filePreviews.filter((_, idx) => idx !== index);
        setSelectedFiles(nextFiles);
        setFilePreviews(nextPreviews);
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setErrorMessage('');

        if (!content.trim() && selectedFiles.length === 0) {
            setErrorMessage('Please write something or attach a photo before posting.');
            return;
        }

        setIsSubmitting(true);

        try {
            const formData = new FormData();
            formData.append('content', content.trim());
            formData.append('ward_code', wardCode);
            formData.append('post_type', postType);
            formData.append('visibility', visibility);

            selectedFiles.forEach((file) => {
                formData.append('photos[]', file);
            });

            await apiRequest('/api/v1/posts', {
                method: 'POST',
                body: formData,
            });

            queryClient.invalidateQueries({ queryKey: ['feed'] });

            setContent('');
            setSelectedFiles([]);
            setFilePreviews([]);
            closeCreateModal();
        } catch (err) {
            console.error('Post creation failed', err);
            setErrorMessage(err?.message || 'Failed to create post. Please try again.');
        } finally {
            setIsSubmitting(false);
        }
    };

    return (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-xl animate-in fade-in duration-200">
            <div className="bg-[#121A29] border border-white/[0.08] w-full max-w-xl rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
                {/* Header (Glassmorphic Shell) */}
                <div className="flex items-center justify-between px-6 py-4 border-b border-white/[0.08] bg-[#0B0F17]/85 backdrop-blur-xl">
                    <div className="flex items-center gap-2.5">
                        <div className="w-8 h-8 rounded-xl bg-blue-600/20 text-blue-400 flex items-center justify-center">
                            <Sparkles className="w-4 h-4" />
                        </div>
                        <div>
                            <h2 className="text-sm font-bold text-gray-100">Create Citizen Post</h2>
                            <p className="text-[10px] text-gray-400">Post directly to your hyperlocal feed</p>
                        </div>
                    </div>
                    <button
                        type="button"
                        onClick={closeCreateModal}
                        disabled={isSubmitting}
                        className="text-gray-400 hover:text-white p-1 rounded-lg hover:bg-white/5 active:scale-95 transition-all cursor-pointer"
                    >
                        <X className="w-5 h-5" />
                    </button>
                </div>

                {/* Form */}
                <form onSubmit={handleSubmit} className="p-6 flex-1 overflow-y-auto space-y-4">
                    {errorMessage && (
                        <div className="p-3 rounded-xl bg-rose-500/10 border border-rose-500/20 text-xs text-rose-300">
                            {errorMessage}
                        </div>
                    )}

                    {/* Textarea */}
                    <div>
                        <textarea
                            rows={4}
                            value={content}
                            onChange={(e) => setContent(e.target.value)}
                            placeholder="Share an update, civic issue, or question with your ward community..."
                            className="w-full bg-[#0B0F17] border border-white/[0.08] focus:border-white/[0.18] rounded-xl p-4 text-sm text-gray-100 placeholder-gray-500 focus:outline-none transition-all resize-none"
                            autoFocus
                        />
                    </div>

                    {/* Drag and Drop Zone */}
                    <div
                        onDrop={handleDrop}
                        onDragOver={handleDragOver}
                        onDragLeave={handleDragLeave}
                        onClick={() => fileInputRef.current?.click()}
                        className={cn(
                            'border-2 border-dashed rounded-xl p-4 text-center cursor-pointer transition-all flex flex-col items-center justify-center gap-2',
                            isDragging
                                ? 'border-cyan-400 bg-cyan-950/20 text-cyan-300'
                                : 'border-white/[0.08] hover:border-blue-500/50 bg-[#0B0F17]/60 text-gray-400 hover:text-gray-300'
                        )}
                    >
                        <UploadCloud className="w-6 h-6 text-cyan-400 animate-pulse" />
                        <div className="text-xs">
                            <span className="font-bold text-gray-100">Drag & drop photos</span> or <span className="text-blue-400 underline">browse</span>
                        </div>
                        <p className="text-[10px] text-gray-500">Supports JPG, PNG, WebP up to 4 images (Max 15MB)</p>
                    </div>

                    {/* Previews Grid */}
                    {filePreviews.length > 0 && (
                        <div className="grid grid-cols-2 sm:grid-cols-4 gap-2">
                            {filePreviews.map((src, idx) => (
                                <div key={idx} className="relative aspect-square rounded-xl overflow-hidden border border-white/[0.08] group bg-black/40">
                                    <img src={src} alt="Upload preview" className="w-full h-full object-cover" />
                                    <button
                                        type="button"
                                        onClick={(e) => {
                                            e.stopPropagation();
                                            handleRemoveFile(idx);
                                        }}
                                        className="absolute top-1 right-1 p-1 bg-black/70 hover:bg-rose-600 text-white rounded-md active:scale-95 transition-all cursor-pointer"
                                    >
                                        <X className="w-3.5 h-3.5" />
                                    </button>
                                </div>
                            ))}
                        </div>
                    )}

                    {/* Controls Row */}
                    <div className="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                        <div>
                            <label className="block text-xs font-semibold text-gray-400 mb-1">Post Type</label>
                            <select
                                value={postType}
                                onChange={(e) => setPostType(e.target.value)}
                                className="w-full bg-[#0B0F17] border border-white/[0.08] rounded-xl px-3 py-2 text-xs text-gray-200 focus:outline-none focus:border-blue-500"
                            >
                                <option value="standard">Standard Post</option>
                                <option value="hyperlocal_notice">Civic Emergency Notice</option>
                                <option value="announcement">Public Announcement</option>
                            </select>
                        </div>

                        <div>
                            <label className="block text-xs font-semibold text-gray-400 mb-1">Ward Location</label>
                            <div className="relative">
                                <MapPin className="w-3.5 h-3.5 absolute left-2.5 top-2.5 text-gray-400" />
                                <input
                                    type="text"
                                    value={wardCode}
                                    onChange={(e) => setWardCode(e.target.value)}
                                    placeholder="WARD-DHAKA-19"
                                    className="w-full bg-[#0B0F17] border border-white/[0.08] rounded-xl pl-8 pr-3 py-2 text-xs text-gray-200 focus:outline-none focus:border-blue-500"
                                />
                            </div>
                        </div>

                        <div>
                            <label className="block text-xs font-semibold text-gray-400 mb-1">Audience</label>
                            <select
                                value={visibility}
                                onChange={(e) => setVisibility(e.target.value)}
                                className="w-full bg-[#0B0F17] border border-white/[0.08] rounded-xl px-3 py-2 text-xs text-gray-200 focus:outline-none focus:border-blue-500"
                            >
                                <option value="public">Public (All Citizens)</option>
                                <option value="friends_only">Verified Friends Only</option>
                            </select>
                        </div>
                    </div>

                    <input
                        type="file"
                        ref={fileInputRef}
                        onChange={(e) => handleFiles(e.target.files)}
                        accept="image/jpeg,image/png,image/webp,image/gif"
                        multiple
                        className="hidden"
                    />

                    {/* Submit Bar with Submit Animation */}
                    <div className="flex items-center justify-between pt-4 border-t border-white/[0.08]">
                        <button
                            type="button"
                            onClick={() => fileInputRef.current?.click()}
                            className="inline-flex items-center gap-2 px-3 py-2 rounded-xl text-xs font-semibold text-gray-300 hover:text-white bg-white/5 hover:bg-white/10 border border-white/[0.08] active:scale-95 transition-all cursor-pointer"
                        >
                            <ImageIcon className="w-4 h-4 text-cyan-400" />
                            <span>Add Photo ({selectedFiles.length}/4)</span>
                        </button>

                        <div className="flex items-center gap-2">
                            <button
                                type="button"
                                onClick={closeCreateModal}
                                disabled={isSubmitting}
                                className="px-4 py-2 rounded-xl text-xs font-semibold text-gray-400 hover:text-white hover:bg-white/5 active:scale-95 transition-all cursor-pointer"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                disabled={isSubmitting}
                                className="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-lg shadow-blue-600/30 active:scale-95 transition-all disabled:opacity-50 cursor-pointer"
                            >
                                {isSubmitting ? (
                                    <>
                                        <Loader2 className="w-4 h-4 animate-spin" />
                                        <span>Publishing to Ward...</span>
                                    </>
                                ) : (
                                    <>
                                        <Send className="w-4 h-4" />
                                        <span>Publish Post</span>
                                    </>
                                )}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    );
}
