@extends('layouts.app')

@section('title', 'Lawyer Dashboard')

@section('content')
    <div x-data="{ openCase: null }" class="space-y-6">

        <div class="flex flex-wrap items-start justify-between gap-3">
            <div>
                <p class="text-sm font-semibold text-cyan-700">Dashboard</p>
                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Your cases at a glance</h1>
                <p class="text-sm text-slate-500">Tap a widget to filter or open any case for full details.</p>
            </div>
            <div class="flex flex-col items-end gap-2 text-sm text-slate-600">
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-green-800">
                        <span class="h-2 w-2 rounded-full bg-green-500"></span> Active: {{ $activeCount ?? 0 }}
                    </span>
                    <span
                        class="hidden sm:inline-flex items-center gap-1 rounded-full bg-amber-100 px-3 py-1 text-amber-800">
                        <span class="h-2 w-2 rounded-full bg-amber-500"></span> Pending: {{ $pendingCount ?? 0 }}
                    </span>
                </div>
                @php
                    $user = auth()->user();
                @endphp
                <div class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 shadow-sm">
                    <span class="text-xs font-semibold uppercase tracking-wide text-slate-500">Plan</span>
                    <span class="text-sm font-bold text-slate-900">{{ ucfirst($user?->plan ?? 'basic') }}</span>
                    <span
                        class="inline-flex items-center rounded-full px-2 py-1 text-[11px] font-semibold
                            {{ ($user?->account_status ?? '') === 'active' ? 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200' : 'bg-amber-50 text-amber-700 ring-1 ring-amber-200' }}">
                        {{ $user?->account_status ?? 'pending' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Widget Buttons -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
            <a href="{{ route('law.cases.index', ['filter' => 'today']) }}"
                class="flex flex-col gap-1 rounded-2xl border border-blue-100 bg-gradient-to-br from-blue-50 to-blue-100 px-3 py-3 text-blue-900 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
                <span class="text-lg font-extrabold leading-none">{{ $todayCount ?? 0 }}</span>
                <span class="text-xs font-semibold">Today</span>
            </a>
            <a href="{{ route('law.cases.index', ['filter' => 'tomorrow']) }}"
                class="flex flex-col gap-1 rounded-2xl border border-emerald-100 bg-gradient-to-br from-emerald-50 to-emerald-100 px-3 py-3 text-emerald-900 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
                <span class="text-lg font-extrabold leading-none">{{ $tomorrowCount ?? 0 }}</span>
                <span class="text-xs font-semibold">Tomorrow</span>
            </a>
            <a href="{{ route('law.cases.index', ['filter' => 'week']) }}"
                class="flex flex-col gap-1 rounded-2xl border border-amber-100 bg-gradient-to-br from-amber-50 to-amber-100 px-3 py-3 text-amber-900 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
                <span class="text-lg font-extrabold leading-none">{{ $weekCount ?? 0 }}</span>
                <span class="text-xs font-semibold">Week</span>
            </a>
            <a href="{{ route('law.cases.index', ['filter' => 'month']) }}"
                class="flex flex-col gap-1 rounded-2xl border border-indigo-100 bg-gradient-to-br from-indigo-50 to-indigo-100 px-3 py-3 text-indigo-900 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
                <span class="text-lg font-extrabold leading-none">{{ $monthCount ?? 0 }}</span>
                <span class="text-xs font-semibold">Month</span>
            </a>
            <a href="{{ route('law.cases.index', ['filter' => 'active']) }}"
                class="flex flex-col gap-1 rounded-2xl border border-cyan-100 bg-gradient-to-br from-cyan-50 to-cyan-100 px-3 py-3 text-cyan-900 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
                <span class="text-lg font-extrabold leading-none">{{ $activeCount ?? 0 }}</span>
                <span class="text-xs font-semibold">Active</span>
            </a>
            <a href="{{ route('law.cases.index', ['filter' => 'pending']) }}"
                class="flex flex-col gap-1 rounded-2xl border border-rose-100 bg-gradient-to-br from-rose-50 to-rose-100 px-3 py-3 text-rose-900 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
                <span class="text-lg font-extrabold leading-none">{{ $pendingCount ?? 0 }}</span>
                <span class="text-xs font-semibold">Pending</span>
            </a>
            <a href="{{ route('law.cases.recycle-bin') }}"
                class="flex flex-col gap-1 rounded-2xl border border-slate-200 bg-gradient-to-br from-slate-50 to-slate-100 px-3 py-3 text-slate-800 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
                <span class="text-lg font-extrabold leading-none">{{ $archivedCount ?? 0 }}</span>
                <span class="text-xs font-semibold">Recycle Bin</span>
            </a>
            <a href="{{ route('law.cases.index') }}"
                class="flex flex-col gap-1 rounded-2xl border border-gray-200 bg-gradient-to-br from-gray-50 to-gray-100 px-3 py-3 text-gray-900 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg">
                <span class="text-lg font-extrabold leading-none">{{ $totalCount ?? 0 }}</span>
                <span class="text-xs font-semibold">Total</span>
            </a>
        </div>

        <!-- Cases List -->
        <div class="space-y-3">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 sm:text-xl">Your Cases</h3>
                    <p class="text-xs text-slate-500">Sorted by newest first. Color shows urgency.</p>
                </div>
                <a href="{{ route('law.cases.create') }}"
                    class="inline-flex items-center gap-2 rounded-full bg-cyan-600 px-4 py-2 text-sm font-semibold text-white shadow-md shadow-cyan-200 transition hover:bg-cyan-700">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14"></path>
                        <path d="M5 12h14"></path>
                    </svg>
                    New case
                </a>
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                @if (isset($errorMessage))
                    <p class="py-8 text-center text-sm font-medium text-red-600">{{ $errorMessage }}</p>
                @elseif ($cases->isEmpty())
                    <p class="py-8 text-center text-sm text-slate-500">No cases assigned to you.</p>
                @else
                    <div class="divide-y divide-slate-100">
                        @foreach ($cases as $case)
                            <a href="{{ route('law.cases.show', $case->id) }}" class="block">
                                <div class="flex flex-col gap-3 px-4 py-3 sm:px-6 sm:py-4 hover:bg-slate-50 transition">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                                        <div class="flex items-start gap-2">
                                            <div
                                                class="h-10 w-10 shrink-0 rounded-xl bg-gradient-to-br from-indigo-500 to-cyan-500 text-white shadow-md flex items-center justify-center text-sm font-extrabold">
                                                {{ strtoupper(substr($case->display_case_title, 0, 2)) }}
                                            </div>
                                            <div>
                                                <h4 class="text-base font-bold text-slate-900 sm:text-lg">
                                                    {{ $case->display_case_title }}
                                                </h4>
                                                <p class="text-xs font-medium text-slate-500">{{ $case->display_court }}</p>
                                            </div>
                                        </div>
                                        <span
                                            class="inline-flex items-center gap-2 self-start rounded-full bg-white px-3 py-1 text-xs font-semibold text-slate-700 ring-1 ring-slate-200">
                                            <span
                                                class="h-2 w-2 rounded-full {{ str_contains($case->color_class ?? '', 'red') ? 'bg-red-500' : (str_contains($case->color_class ?? '', 'yellow') ? 'bg-amber-500' : 'bg-emerald-500') }}"></span>
                                            {{ $case->display_stage }}
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3 text-xs sm:grid-cols-4 sm:text-sm text-slate-700">
                                        <span class="flex flex-col rounded-xl bg-slate-50 px-3 py-2">
                                            <span class="text-[11px] uppercase tracking-wide text-slate-500">Prev Date</span>
                                            <span class="font-semibold text-slate-900">{{ $case->display_prev_dt }}</span>
                                        </span>
                                        <span class="flex flex-col rounded-xl bg-slate-50 px-3 py-2">
                                            <span class="text-[11px] uppercase tracking-wide text-slate-500">Next Date</span>
                                            <span class="font-semibold text-slate-900">{{ $case->display_next_dt }}</span>
                                        </span>
                                        <span class="flex flex-col rounded-xl bg-slate-50 px-3 py-2">
                                            <span class="text-[11px] uppercase tracking-wide text-slate-500">Court</span>
                                            <span class="font-semibold text-slate-900">{{ $case->display_court }}</span>
                                        </span>
                                        <span class="flex flex-col rounded-xl bg-slate-50 px-3 py-2">
                                            <span class="text-[11px] uppercase tracking-wide text-slate-500">Status</span>
                                            <span
                                                class="font-semibold capitalize text-slate-900">{{ $filter === 'archived' ? 'Archived' : ($case->status ?? 'Active') }}</span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection