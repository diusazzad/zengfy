@extends('team::layouts.admin')

@section('title', 'Team Management')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <p class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-1">Administration</p>
            <h1 class="text-4xl font-black text-gray-900 tracking-tight">Team Members</h1>
        </div>
        
        <div class="flex items-center gap-3">
            <a href="{{ route('team.admin.index') }}" class="p-3 bg-white text-gray-400 border border-gray-200 rounded-2xl hover:text-blue-600 hover:border-blue-100 transition-all active:scale-95 shadow-sm" title="Refresh">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            </a>
            
            <a href="{{ route('team.admin.create') }}" 
               class="px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-black flex items-center gap-2 transition-all shadow-lg shadow-blue-500/25 active:scale-95 text-sm uppercase tracking-wider">
                <span class="text-xl leading-none">+</span>
                New Member
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Total Members</p>
                <p class="text-2xl font-black text-gray-900 leading-tight">{{ $stats['total'] }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center text-green-600">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Active Now</p>
                <p class="text-2xl font-black text-gray-900 leading-tight">{{ $stats['active'] }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
            </div>
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1">Inactive</p>
                <p class="text-2xl font-black text-gray-900 leading-tight">{{ $stats['inactive'] }}</p>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-5 text-[11px] font-black uppercase text-gray-400 tracking-widest">Team Member</th>
                        <th class="px-6 py-5 text-[11px] font-black uppercase text-gray-400 tracking-widest">Status</th>
                        <th class="px-6 py-5 text-[11px] font-black uppercase text-gray-400 tracking-widest text-center">Order</th>
                        <th class="px-6 py-5 text-right text-[11px] font-black uppercase text-gray-400 tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($teams as $member)
                    <tr class="group hover:bg-blue-50/30 transition-all">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="relative">
                                    <img src="{{ $member->image_url }}" class="w-14 h-14 rounded-2xl object-cover bg-gray-100 border border-gray-200 shadow-sm transition-transform group-hover:scale-105">
                                    @if($member->status == 'active')
                                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></span>
                                    @endif
                                </div>
                                <div>
                                    <div class="text-base font-black text-gray-900 leading-none mb-1">{{ $member->name }}</div>
                                    <div class="text-[11px] font-bold text-blue-600 uppercase tracking-wider">{{ $member->designation }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($member->status == 'active')
                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black bg-green-100 text-green-700 uppercase tracking-widest">Active</span>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black bg-gray-100 text-gray-500 uppercase tracking-widest">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-black text-gray-900 text-center">
                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-50 text-gray-400 text-xs font-bold border border-gray-100">{{ $member->order }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-all translate-x-2 group-hover:translate-x-0">
                                <a href="{{ route('team.admin.edit', $member) }}" class="p-3 bg-white text-blue-600 hover:bg-blue-600 hover:text-white rounded-2xl border border-gray-100 transition-all shadow-sm group/btn" title="Edit Member">
                                    <svg class="w-5 h-5 transition-transform group-hover/btn:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                </a>
                                <form action="{{ route('team.admin.destroy', $member) }}" method="POST" onsubmit="return confirm('পাকাপাকিভাবে মুছে ফেলতে চান?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center justify-center w-10 h-10 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm" title="মুছে ফেলুন">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center gap-4">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center text-gray-200">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                </div>
                                <p class="text-sm font-bold text-gray-400 italic">No team members found in the database.</p>
                                <a href="{{ route('team.admin.create') }}" class="text-blue-600 font-bold hover:underline">Add your first member</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
