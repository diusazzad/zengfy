@extends('layouts.app')

@section('title', isset($team) ? 'Update Member - Admin' : 'New Member - Admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-in slide-in-from-bottom-4 duration-500">
    <!-- Breadcrumb & Header -->
    <div class="flex items-center justify-between">
        <div>
            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li class="inline-flex items-center text-xs font-bold text-gray-400 uppercase tracking-tighter cursor-default">
                        <a href="{{ route('team.admin.index') }}" class="hover:text-blue-600">Team</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <span class="mx-2 text-gray-400">/</span>
                            <span class="text-xs font-bold text-gray-900 dark:text-white uppercase tracking-tighter">
                                {{ isset($team) ? 'Update info' : 'New Creation' }}
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">
                {{ isset($team) ? 'Update Member' : 'Add New Member' }}
            </h1>
        </div>
        <a href="{{ route('team.admin.index') }}" class="px-5 py-2.5 bg-gray-50 dark:bg-gray-800 text-gray-600 dark:text-gray-400 font-bold rounded-xl border border-gray-100 dark:border-gray-700 hover:bg-gray-100 transition-all flex items-center gap-2 text-sm shadow-sm group">
            <span class="group-hover:-translate-x-1 transition-transform">&larr;</span> 
            Back to List
        </a>
    </div>

    @if ($errors->any())
    <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800 rounded-2xl text-red-700 dark:text-red-400 text-sm font-bold flex items-center gap-3 shadow-md">
        <span class="w-8 h-8 rounded-full bg-red-100 dark:bg-red-800 flex items-center justify-center">!</span>
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ isset($team) ? route('team.admin.update', $team) : route('team.admin.store') }}" 
          method="POST" enctype="multipart/form-data" 
          class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-xl overflow-hidden">
        @csrf
        @if(isset($team)) @method('PUT') @endif
        
        <div class="p-8 space-y-8">
            <!-- Basic Info Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label for="name" class="text-xs font-black uppercase text-gray-400 tracking-widest pl-1">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $team->name ?? '') }}" required 
                           class="w-full px-5 py-4 rounded-2xl border border-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all placeholder:text-gray-300 font-bold">
                </div>
                <div class="space-y-2">
                    <label for="designation" class="text-xs font-black uppercase text-gray-400 tracking-widest pl-1">Professional Role <span class="text-red-500">*</span></label>
                    <input type="text" name="designation" id="designation" value="{{ old('designation', $team->designation ?? '') }}" required 
                           class="w-full px-5 py-4 rounded-2xl border border-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all placeholder:text-gray-300 font-bold">
                </div>
            </div>

            <div class="space-y-2">
                <label for="bio" class="text-xs font-black uppercase text-gray-400 tracking-widest pl-1">Short Biography</label>
                <textarea name="bio" id="bio" rows="3" 
                          class="w-full px-5 py-4 rounded-2xl border border-gray-100 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all placeholder:text-gray-300 font-medium">{{ old('bio', $team->bio ?? '') }}</textarea>
            </div>

            <!-- Image Upload Section -->
            <div class="flex flex-col md:flex-row items-center gap-8 py-4 px-6 bg-gray-50/50 dark:bg-gray-700/30 rounded-3xl border border-dashed border-gray-200 dark:border-gray-600">
                @if(isset($team) && $team->image_path)
                <div class="shrink-0 relative group">
                    <img src="{{ $team->image_url }}" class="w-32 h-32 rounded-2xl object-cover shadow-lg border-4 border-white dark:border-gray-800 transition-transform group-hover:scale-105">
                    <div class="absolute -top-2 -right-2 bg-blue-600 text-white text-[10px] font-black px-2 py-1 rounded-lg uppercase">Current</div>
                </div>
                @else
                <div class="w-32 h-32 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-300 border border-gray-200 dark:border-gray-700 italic text-xs text-center p-4">
                    Photo placeholder
                </div>
                @endif
                <div class="grow space-y-3 text-center md:text-left">
                    <h3 class="text-sm font-black text-gray-800 dark:text-white">Profile Identity</h3>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-tight">Recommended: Square 512x512px. Max 2MB.</p>
                    <input type="file" name="image" id="image" 
                           class="w-full text-xs text-gray-500 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-black file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
                </div>
            </div>

            <!-- Social & Meta -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border-t border-gray-50 dark:border-gray-700 pt-8">
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase text-gray-400 tracking-widest pl-1">Social Networks (URLs)</label>
                    <div class="space-y-4">
                        <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $team->linkedin_url ?? '') }}" placeholder="LinkedIn URL" class="w-full px-5 py-3.5 rounded-2xl border border-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500/50 text-sm font-bold">
                        <input type="url" name="github_url" value="{{ old('github_url', $team->github_url ?? '') }}" placeholder="GitHub URL" class="w-full px-5 py-3.5 rounded-2xl border border-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500/50 text-sm font-bold">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-black uppercase text-gray-400 tracking-widest pl-1">Display Controls</label>
                    <div class="grid grid-cols-2 gap-4">
                        <select name="status" class="w-full px-5 py-3.5 rounded-2xl border border-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500/50 text-sm font-black uppercase tracking-widest">
                            <option value="active" {{ old('status', $team->status ?? 'active') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $team->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <input type="number" name="order" value="{{ old('order', $team->order ?? 0) }}" placeholder="Order" class="w-full px-5 py-3.5 rounded-2xl border border-gray-50 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500/50 text-sm font-black text-center">
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="bg-gray-50 dark:bg-gray-800/50 p-8 border-t border-gray-100 dark:border-gray-700 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-xs text-gray-400 font-bold uppercase italic">* Finalize all fields before saving changes.</p>
            <button type="submit" class="w-full md:w-auto px-10 py-5 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-2xl shadow-xl shadow-blue-500/30 transition-all transform hover:-translate-y-1 active:scale-95 text-lg">
                {{ isset($team) ? 'Confirm Changes' : 'Launch New Profile' }}
            </button>
        </div>
    </form>
</div>
@endsection
