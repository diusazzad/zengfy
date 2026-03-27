@extends('team::layouts.admin')

@section('title', 'Edit Member - ' . $team->name)

@section('content')
<div class="max-w-4xl mx-auto animate-in slide-in-from-bottom duration-500">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <a href="{{ route('team.admin.index') }}" class="group flex items-center text-xs font-bold text-gray-500 uppercase tracking-widest hover:text-blue-600 transition-colors mb-2">
                <svg class="w-4 h-4 mr-1 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to List
            </a>
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Edit Member: {{ $team->name }}</h1>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('team.admin.update', $team) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-3xl border border-gray-100 shadow-xl overflow-hidden">
            <!-- Form Section: Basic Info -->
            <div class="p-8 border-b border-gray-50">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="name" class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $team->name) }}" required
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-gray-900 placeholder-gray-300">
                    </div>

                    <div class="space-y-2">
                        <label for="designation" class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Designation</label>
                        <input type="text" name="designation" id="designation" value="{{ old('designation', $team->designation) }}" required
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-gray-900 placeholder-gray-300">
                    </div>
                </div>
            </div>

            <!-- Form Section: Bio & Image -->
            <div class="p-8 border-b border-gray-50 bg-gray-50/30">
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label for="bio" class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Short Bio</label>
                        <textarea name="bio" id="bio" rows="3" 
                                  class="w-full px-5 py-4 bg-white border border-gray-100 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-gray-900 placeholder-gray-300">{{ old('bio', $team->bio) }}</textarea>
                    </div>

                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        <div class="w-full md:w-32 shrink-0">
                            <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1 block mb-2">Current Image</label>
                            <img src="{{ $team->image_url }}" class="w-32 h-32 rounded-2xl object-cover bg-gray-100 border border-gray-200 shadow-sm">
                        </div>
                        <div class="flex-grow space-y-2">
                            <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Change Image</label>
                            <div class="px-6 pt-5 pb-6 border-2 border-gray-200 border-dashed rounded-3xl hover:border-blue-400 transition-colors bg-white group">
                                <div class="space-y-1 text-center">
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-black text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload new file</span>
                                            <input id="image" name="image" type="file" class="sr-only">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, WEBP up to 2MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Section: Social & Settings -->
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="space-y-2">
                        <label for="linkedin_url" class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" id="linkedin_url" value="{{ old('linkedin_url', $team->linkedin_url) }}"
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-gray-900">
                    </div>
                    <div class="space-y-2">
                        <label for="github_url" class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">GitHub URL</label>
                        <input type="url" name="github_url" id="github_url" value="{{ old('github_url', $team->github_url) }}"
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-gray-900">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="status" class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Display Status</label>
                        <select name="status" id="status" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-gray-900 appearance-none">
                            <option value="active" {{ $team->status == 'active' ? 'selected' : '' }}>Active (Visible)</option>
                            <option value="inactive" {{ $team->status == 'inactive' ? 'selected' : '' }}>Inactive (Hidden)</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label for="order" class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-1">Display Order</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $team->order) }}"
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all font-bold text-gray-900">
                    </div>
                </div>
            </div>

            <!-- Footer Action -->
            <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('team.admin.index') }}" class="px-8 py-4 bg-white border border-gray-200 text-gray-500 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-gray-100 transition-all active:scale-95">Cancel</a>
                <button type="submit" class="px-8 py-4 bg-green-600 text-white rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-green-700 shadow-lg shadow-green-500/25 transition-all active:scale-95">Update Member</button>
            </div>
        </div>
    </form>
</div>
@endsection
