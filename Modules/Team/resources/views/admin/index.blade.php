@extends('layouts.app')

@section('title', 'টিম ম্যানেজমেন্ট - ZenGFY')

@section('content')
<style>
    /* High-reliability responsive toggles */
    @media (max-width: 767px) {
        .responsive-table-view { display: none !important; }
        .responsive-card-view { display: block !important; }
    }
    @media (min-width: 768px) {
        .responsive-table-view { display: block !important; }
        .responsive-card-view { display: none !important; }
    }
</style>

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-6">
        <div class="text-center sm:text-left">
            <h2 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight">টিম মেম্বার লিস্ট</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">আপনার টিমের সব মেম্বারদের এখানে ম্যানেজ করুন।</p>
        </div>
        <a href="{{ route('team.admin.create') }}"
            class="group px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black flex items-center justify-center gap-3 transition-all shadow-xl shadow-blue-600/20 w-full sm:w-auto transform hover:scale-[1.02] active:scale-[0.98]">
            <span class="text-2xl group-hover:rotate-90 transition-transform">+</span> 
            <span>Add New Member</span>
        </a>
    </div>

    @if(session('success'))
    <div class="p-4 bg-green-50 border-b border-green-100 text-green-700 text-sm font-bold text-center">
        {{ session('success') }}
    </div>
    @endif

    {{-- Mobile Card Layout (Visible ONLY on screens smaller than md) --}}
    <div class="responsive-card-view md:hidden block bg-gray-50/30 dark:bg-gray-900/10 p-4 space-y-4">
        @forelse($teams as $member)
        <div class="bg-white dark:bg-gray-800 p-6 rounded-[2rem] shadow-sm border border-gray-100 dark:border-gray-700">
            <div class="flex items-center gap-5 mb-6">
                <div class="relative group">
                    <img src="{{ $member->image_url }}" alt="{{ $member->name }}" 
                        class="w-16 h-16 rounded-[1.25rem] object-cover border-4 border-blue-50 dark:border-gray-700 shadow-sm transition-transform group-hover:scale-105">
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-lg font-black text-gray-900 dark:text-white leading-tight mb-1 truncate">{{ $member->name }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 font-semibold">{{ $member->designation }}</p>
                </div>
                <div class="shrink-0">
                     @if($member->status == 'active')
                        <span class="px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider bg-green-100 text-green-700 ring-4 ring-green-50">Active</span>
                    @else
                        <span class="px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider bg-red-100 text-red-700 ring-4 ring-red-50">Inactive</span>
                    @endif
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-3 pt-5 border-t border-gray-100 dark:border-gray-700">
                <a href="{{ route('team.admin.edit', $member) }}"
                    class="flex items-center justify-center gap-2 py-4 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-2xl font-bold text-sm transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit
                </a>
                <form action="{{ route('team.admin.destroy', $member) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="w-full">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="w-full flex items-center justify-center gap-2 py-4 bg-red-50 text-red-600 hover:bg-red-100 rounded-2xl font-bold text-sm transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="px-6 py-16 text-center bg-white rounded-[2rem] border border-dashed border-gray-200">
             <div class="text-4xl mb-4">🔍</div>
             <p class="text-gray-500 font-bold">কোনো মেম্বার পাওয়া যায়নি।</p>
        </div>
        @endforelse
    </div>

    {{-- Desktop Table Layout (Visible ONLY on md and up) --}}
    <div class="responsive-table-view hidden md:block overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 text-xs uppercase tracking-widest font-black hidden md:table-header-group">
                <tr>
                    <th class="px-6 py-4">মেম্বার</th>
                    <th class="px-6 py-4">ডেজিগনেশন</th>
                    <th class="px-6 py-4 text-center">স্ট্যাটাস</th>
                    <th class="px-6 py-4 text-right">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @foreach($teams as $member)
                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors">
                    <td class="px-6 py-4">
                        <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $member->name }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $member->designation }}</div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($member->status == 'active')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">সক্রিয়</span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">নিষ্ক্রিয়</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-2 flex justify-end items-center">
                        <a href="{{ route('team.admin.edit', $member) }}"
                            class="p-2 bg-yellow-50 text-yellow-600 hover:bg-yellow-100 rounded-lg transition" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form action="{{ route('team.admin.destroy', $member) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg transition" title="Delete">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
