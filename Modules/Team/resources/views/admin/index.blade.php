@extends('layouts.app')

@section('title', 'টিম ম্যানেজমেন্ট - ZenGFY')

@section('content')
<style>
    /* Custom Responsive Logic: Card on Mobile, Table on Desktop */
    @media (max-width: 767px) {
        .desktop-table { display: none !important; }
        .mobile-cards { display: grid !important; }
    }
    @media (min-width: 768px) {
        .mobile-cards { display: none !important; }
        .desktop-table { display: table !important; }
    }
</style>

<div class="space-y-6 pb-20 md:pb-0">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-black text-gray-900 dark:text-white flex items-center gap-2">
                <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                টিম মেম্বার লিস্ট
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">আপনার সিস্টেমের সকল টিম মেম্বার ম্যানেজ করুন</p>
        </div>
        <a href="{{ route('team.admin.create') }}" 
           class="w-full md:w-auto px-6 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black flex items-center justify-center gap-2 transition-all transform hover:scale-[1.02] active:scale-95 shadow-xl shadow-blue-500/20">
            <span class="text-2xl leading-none">+</span>
            Add New Member
        </a>
    </div>

    @if(session('success'))
    <div class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-100 dark:border-green-800 rounded-2xl text-green-700 dark:text-green-400 text-sm font-bold flex items-center gap-3">
        <span class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-800 flex items-center justify-center">✓</span>
        {{ session('success') }}
    </div>
    @endif

    <!-- Mobile View: Card Layout -->
    <div class="mobile-cards grid grid-cols-1 gap-4 hidden">
        @forelse($teams as $member)
        <div class="bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm relative overflow-hidden group">
            <div class="flex items-start gap-4">
                <div class="relative">
                    <img src="{{ $member->image_url }}" 
                         alt="{{ $member->name }}" 
                         class="w-20 h-20 rounded-2xl object-cover border-2 border-gray-50 dark:border-gray-700">
                    <div class="absolute -bottom-2 -right-2">
                        @if($member->status == 'active')
                        <span class="w-6 h-6 rounded-full bg-green-500 border-4 border-white dark:border-gray-800 flex items-center justify-center" title="Active"></span>
                        @else
                        <span class="w-6 h-6 rounded-full bg-red-500 border-4 border-white dark:border-gray-800 flex items-center justify-center" title="Inactive"></span>
                        @endif
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-black text-gray-900 dark:text-white text-lg truncate">{{ $member->name }}</h3>
                    <p class="text-blue-600 dark:text-blue-400 text-sm font-bold">{{ $member->designation }}</p>
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('team.admin.edit', $member) }}" 
                           class="flex-1 py-2.5 bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-xl text-center text-sm font-bold border border-gray-200 dark:border-gray-600">
                            Edit
                        </a>
                        <form action="{{ route('team.admin.destroy', $member) }}" method="POST" class="flex-1" onsubmit="return confirm('নিশ্চিত তো?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full py-2.5 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-xl text-sm font-bold border border-red-100 dark:border-red-800">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white dark:bg-gray-800 p-10 rounded-3xl text-center text-gray-500 dark:text-gray-400 border-2 border-dashed border-gray-200 dark:border-gray-700">
            কোনো মেম্বার পাওয়া যায়নি।
        </div>
        @endforelse
    </div>

    <!-- Desktop View: Table Layout -->
    <div class="desktop-table bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-xl overflow-hidden hidden w-full">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50/50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 text-[10px] uppercase tracking-[0.2em] font-black italic">
                    <th class="px-8 py-5 text-left">Member Profile</th>
                    <th class="px-8 py-5 text-center">Status</th>
                    <th class="px-8 py-5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-700">
                @forelse($teams as $member)
                <tr class="group hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-all duration-300">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <img src="{{ $member->image_url }}" 
                                 class="w-14 h-14 rounded-2xl object-cover ring-4 ring-gray-50 dark:ring-gray-700 group-hover:ring-blue-100 dark:group-hover:ring-blue-900 transition-all">
                            <div>
                                <div class="text-base font-black text-gray-900 dark:text-white">{{ $member->name }}</div>
                                <div class="text-sm font-bold text-blue-600 dark:text-blue-400">{{ $member->designation }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        @if($member->status == 'active')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black bg-green-100 text-green-700 uppercase tracking-widest">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                            Active
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black bg-gray-100 text-gray-600 uppercase tracking-widest">
                            Offline
                        </span>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex justify-end items-center gap-3">
                            <a href="{{ route('team.admin.edit', $member) }}" 
                               class="p-3 bg-gray-50 dark:bg-gray-700 text-gray-500 hover:bg-blue-600 hover:text-white rounded-xl transition-all shadow-sm" title="সম্পাদনা করুন">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('team.admin.destroy', $member) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-3 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 hover:bg-red-600 hover:text-white rounded-xl transition-all shadow-sm" title="মুছে ফেলুন">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-8 py-20 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-20 h-20 bg-gray-50 dark:bg-gray-700 rounded-full mb-4 flex items-center justify-center text-gray-300 italic">...</div>
                            <p class="text-gray-500 dark:text-gray-400 font-bold">কোনো ডাটা পাওয়া যায়নি</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
