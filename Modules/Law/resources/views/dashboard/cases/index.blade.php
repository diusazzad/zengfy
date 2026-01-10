@extends('layouts.app')

@section('title', 'My Cases')

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <p class="text-sm font-semibold text-cyan-700">Cases</p>
                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Your case library</h1>
                <p class="text-sm text-slate-500">{{ $storeCases->count() }} cases found</p>
            </div>
            <button onclick="window.location.href='{{ route('law.cases.create') }}'"
                class="inline-flex items-center gap-2 rounded-xl bg-cyan-600 px-4 py-2 text-sm font-semibold text-white shadow-md shadow-cyan-200 transition hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" />
                </svg>
                <span class="hidden sm:inline">New case</span>
            </button>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex overflow-x-auto gap-2 px-4 pb-3 pt-4 scrollbar-hide">
                @foreach (['active' => 'Active', 'pending' => 'Pending', 'decided' => 'Decided', 'archived' => 'Archived'] as $key => $label)
                    <a href="{{ route('law.cases.index', ['filter' => $key]) }}"
                        class="flex-shrink-0 px-4 py-2 rounded-full text-sm font-semibold transition {{ request('filter') == $key ? 'bg-cyan-600 text-white shadow-md shadow-cyan-200' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <div class="px-4 pb-4">
                <form method="GET" action="{{ route('law.cases.index') }}">
                    <div class="relative">
                        <input type="text" name="custom" placeholder="Search cases..."
                            class="w-full pl-10 pr-24 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-cyan-100 focus:border-cyan-500"
                            value="{{ request('custom') }}">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <button type="submit"
                            class="absolute inset-y-0 right-0 my-1 mr-1 inline-flex items-center gap-1 rounded-lg bg-cyan-600 px-3 text-sm font-semibold text-white shadow-sm hover:bg-cyan-700">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m21 21-4.35-4.35"></path>
                                <circle cx="11" cy="11" r="7"></circle>
                            </svg>
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="flex items-center gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if ($storeCases->isEmpty())
            <div class="text-center py-12 bg-white rounded-2xl border border-slate-200 shadow-sm">
                <div class="mx-auto w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 mb-2">No cases found</h3>
                <p class="text-slate-600 mb-6">You don't have any cases assigned yet.</p>
                <a href="{{ route('law.cases.create') }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white shadow-md hover:bg-cyan-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4" />
                    </svg>
                    Create first case
                </a>
            </div>
        @else
            <div class="space-y-4">
                <div class="space-y-2 md:hidden">
                    @foreach ($storeCases as $case)
                        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm p-3">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <div class="flex-1">
                                    <h3 class="text-sm font-bold text-slate-900">{{ $case->case_title ?? 'Untitled case' }}</h3>
                                    <p class="text-xs text-slate-500">Court case #: {{ $case->court_case_number ?? 'N/A' }}</p>
                                </div>
                                <span
                                    class="inline-flex items-center px-2 py-1 rounded-full text-[11px] font-semibold bg-slate-100 text-slate-700">
                                    {{ ucfirst($case->status ?? 'pending') }}
                                </span>
                            </div>
                            <div class="space-y-2 text-xs text-slate-600 mb-3">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $case->court?->name ?? 'N/A' }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                    {{ $case->client_name ?? 'N/A' }} vs {{ $case->opponent_name ?? 'N/A' }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3a4 4 0 118 0v4m-4 6v6m-4-6v6m8-6v6"></path>
                                    </svg>
                                    Next: {{ $case->formatted_next_date ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-2 text-sm font-semibold">
                                <a href="{{ route('law.cases.show', $case->id) }}"
                                    class="rounded-lg bg-cyan-50 px-3 py-2 text-cyan-700 text-center hover:bg-cyan-100">View</a>
                                <a href="{{ route('law.cases.edit', $case->id) }}"
                                    class="rounded-lg bg-slate-50 px-3 py-2 text-slate-700 text-center hover:bg-slate-100">Edit</a>
                                <a href="{{ route('law.cases.print', $case->id) }}"
                                    class="rounded-lg bg-slate-50 px-3 py-2 text-slate-700 text-center hover:bg-slate-100 col-span-2">Print</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="hidden md:block rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-slate-50 text-slate-700 font-semibold">
                                <tr>
                                    <th class="px-4 py-3 text-left">Case</th>
                                    <th class="px-4 py-3 text-left">Parties</th>
                                    <th class="px-4 py-3 text-left">Court</th>
                                    <th class="px-4 py-3 text-left">Stage</th>
                                    <th class="px-4 py-3 text-left">Next Date</th>
                                    <th class="px-4 py-3 text-left">Status</th>
                                    <th class="px-4 py-3 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach ($storeCases as $case)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="px-4 py-3">
                                            <div class="font-bold text-slate-900">{{ $case->case_title ?? 'Untitled case' }}</div>
                                            <div class="text-xs text-slate-500">Court case #:
                                                {{ $case->court_case_number ?? 'N/A' }}</div>
                                            <div class="text-xs text-slate-500">Office file #:
                                                {{ $case->office_file_number ?? 'N/A' }}</div>
                                        </td>
                                        <td class="px-4 py-3 text-slate-800">{{ $case->client_name ?? 'N/A' }} vs
                                            {{ $case->opponent_name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-slate-800">{{ $case->court?->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3">
                                            <span
                                                class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                                {{ $case->caseStage?->name ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-slate-800">{{ $case->formatted_next_date ?? 'N/A' }}</td>
                                        <td class="px-4 py-3">
                                            <span
                                                class="inline-flex items-center rounded-full bg-cyan-50 px-3 py-1 text-xs font-semibold text-cyan-700">
                                                {{ ucfirst($case->status ?? 'pending') }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-3 text-sm font-semibold">
                                                <a href="{{ route('law.cases.show', $case->id) }}"
                                                    class="text-cyan-700 hover:text-cyan-900">View</a>
                                                <a href="{{ route('law.cases.edit', $case->id) }}"
                                                    class="text-amber-700 hover:text-amber-900">Edit</a>
                                                <a href="{{ route('law.cases.print', $case->id) }}"
                                                    class="text-slate-700 hover:text-slate-900">Print</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>
@endsection