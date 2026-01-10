@extends('layouts.app')

@section('title', 'Courts')

@section('content')
    <div class="space-y-5 max-w-5xl mx-auto">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <p class="text-sm font-semibold text-cyan-700">Courts</p>
                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Manage your court list</h1>
                <p class="text-sm text-slate-500">Add or review courts used across your matters.</p>
            </div>
            <a href="{{ route('cases.court.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-cyan-600 px-4 py-2 text-sm font-semibold text-white shadow-md shadow-cyan-200 transition hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-200">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14"></path>
                    <path d="M5 12h14"></path>
                </svg>
                Add court
            </a>
        </div>

        <div class="flex flex-wrap gap-2 text-xs font-semibold text-slate-700">
            <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1">
                <span class="h-2 w-2 rounded-full bg-cyan-500"></span>
                Total courts: {{ $courts->count() }}
            </span>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-700 font-semibold">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Court Name</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($courts as $court)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-4 py-3 font-semibold text-slate-800">{{ $court->id }}</td>
                                <td class="px-4 py-3 text-slate-700">{{ $court->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-4 py-6 text-center text-slate-500">No courts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="grid grid-cols-1 gap-3 p-4 md:hidden">
                @forelse($courts as $court)
                    <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 shadow-sm">
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Court #{{ $court->id }}</p>
                        <p class="text-base font-bold text-slate-900">{{ $court->name }}</p>
                    </div>
                @empty
                    <p class="text-center text-sm text-slate-500">No courts found.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
