@extends('layouts.app')

@section('title', 'টিম ম্যানেজমেন্ট - ZenGFY')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">টিম মেম্বার লিস্ট</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">আপনার টিমের সব মেম্বারদের এখানে ম্যানেজ করুন।</p>
        </div>
        <a href="{{ route('team.admin.create') }}"
            class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold flex items-center gap-2 transition shadow-lg shadow-blue-600/20">
            <span class="text-xl">+</span> Add Member
        </a>
    </div>

    @if(session('success'))
    <div class="p-4 bg-green-50 border-b border-green-100 text-green-700 text-sm">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 dark:bg-gray-700/50 text-gray-500 dark:text-gray-400 text-xs uppercase tracking-widest font-black">
                <tr>
                    <th class="px-6 py-4">মেম্বার</th>
                    <th class="px-6 py-4">ডেজিগনেশন</th>
                    <th class="px-6 py-4 text-center">স্ট্যাটাস</th>
                    <th class="px-6 py-4 text-right">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($teams as $member)
                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors">
                    <td class="px-6 py-4">
                        <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-gray-900 dark:text-white">{{ $member->name }}</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $member->designation }}</div>
                    </td>
                    <td class="px-6 py-4">
                        @if($member->status == 'active')
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            সক্রিয়
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            নিষ্ক্রিয়
                        </span>
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
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400 italic">
                        কোনো মেম্বার পাওয়া যায়নি।
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
