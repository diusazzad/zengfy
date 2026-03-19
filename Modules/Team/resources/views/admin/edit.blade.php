@extends('layouts.app')

@section('title', 'টিম মেম্বারের তথ্য আপডেট করুন - ZenGFY')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">টিম মেম্বারের তথ্য আপডেট করুন</h2>
        <a href="{{ route('team.admin.index') }}" class="text-sm font-medium text-primary-600 hover:text-primary-700 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            ফিরে যান
        </a>
    </div>

    @if ($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-lg text-red-700 text-sm">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('team.admin.update', $team) }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-8 space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">নাম <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $team->name) }}" required class="w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 transition-all">
            </div>
            <div>
                <label for="designation" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">পদবী <span class="text-red-500">*</span></label>
                <input type="text" name="designation" id="designation" value="{{ old('designation', $team->designation) }}" required class="w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 transition-all">
            </div>
        </div>

        <div>
            <label for="bio" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">বায়ো (ঐচ্ছিক)</label>
            <textarea name="bio" id="bio" rows="4" class="w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 transition-all">{{ old('bio', $team->bio) }}</textarea>
        </div>

        <div class="flex items-start gap-6">
            @if($team->image_path)
            <div class="shrink-0">
                <p class="text-xs font-bold text-gray-500 mb-2 uppercase">বর্তমান ছবি:</p>
                <img src="{{ $team->image_url }}" alt="{{ $team->name }}" class="w-24 h-24 rounded-lg object-cover border border-gray-200">
            </div>
            @endif
            <div class="grow">
                <label for="image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">নতুন ছবি আপলোড করুন</label>
                <input type="file" name="image" id="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                <p class="mt-2 text-xs text-gray-500 uppercase font-medium">নিচে নতুন ছবি আপলোড করলে পূর্বেরটি মুছে যাবে।</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100 dark:border-gray-700">
            <div>
                <label for="linkedin_url" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">LinkedIn URL</label>
                <input type="url" name="linkedin_url" id="linkedin_url" value="{{ old('linkedin_url', $team->linkedin_url) }}" placeholder="https://linkedin.com/in/..." class="w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 transition-all">
            </div>
            <div>
                <label for="github_url" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">GitHub URL</label>
                <input type="url" name="github_url" id="github_url" value="{{ old('github_url', $team->github_url) }}" placeholder="https://github.com/..." class="w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 transition-all">
            </div>
            <div>
                <label for="twitter_url" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Twitter Profile URL</label>
                <input type="url" name="twitter_url" id="twitter_url" value="{{ old('twitter_url', $team->twitter_url) }}" placeholder="https://twitter.com/..." class="w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 transition-all">
            </div>
             <div>
                <label for="facebook_url" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Facebook Profile URL</label>
                <input type="url" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $team->facebook_url) }}" placeholder="https://facebook.com/..." class="w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 transition-all">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-100 dark:border-gray-700">
            <div>
                <label for="status" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">স্ট্যাটাস</label>
                <select name="status" id="status" class="w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 transition-all">
                    <option value="active" {{ old('status', $team->status) == 'active' ? 'selected' : '' }}>সক্রিয়</option>
                    <option value="inactive" {{ old('status', $team->status) == 'inactive' ? 'selected' : '' }}>নিষ্ক্রিয়</option>
                </select>
            </div>
            <div>
                <label for="order" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ডিসপ্লে অর্ডার</label>
                <input type="number" name="order" id="order" value="{{ old('order', $team->order) }}" class="w-full px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-primary-500 transition-all">
            </div>
        </div>

        <div class="pt-6">
            <button type="submit" class="w-full md:w-auto px-8 py-3 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-lg shadow-lg shadow-primary-500/20 transition-all transform hover:-translate-y-0.5">
                তথ্য আপডেট করুন
            </button>
        </div>
    </form>
</div>
@endsection
