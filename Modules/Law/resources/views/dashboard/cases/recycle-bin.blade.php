@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h1 class="text-xl font-semibold text-gray-900">Recycle Bin - Deleted Cases</h1>
                <a href="{{ route('law.cases.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-md transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Cases
                </a>
            </div>

            <!-- Content -->
            <div class="p-6">
                <!-- Success Alert -->
                @if (session('success'))
                    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md relative"
                        role="alert">
                        {{ session('success') }}
                        <button type="button" class="absolute top-0 right-0 px-4 py-3"
                            onclick="this.parentElement.style.display='none'">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                <!-- Error Alert -->
                @if (session('error'))
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md relative"
                        role="alert">
                        {{ session('error') }}
                        <button type="button" class="absolute top-0 right-0 px-4 py-3"
                            onclick="this.parentElement.style.display='none'">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                @if ($deletedCases->count() > 0)
                    <!-- Table -->
                    <div class="overflow-x-auto shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Case Title</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Client</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Case Type</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Court</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Next Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Deleted Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($deletedCases as $case)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $case->title }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $case->client_name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $case->caseType->name ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $case->court->name ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">{{ $case->formatted_next_date }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $case->deleted_at->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            <div class="flex space-x-2">
                                                <!-- Restore Button -->
                                                <form method="POST" action="{{ route('law.cases.restore', $case->id) }}"
                                                    class="inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-medium rounded transition duration-150 ease-in-out"
                                                        title="Restore Case">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                        </svg>
                                                        Restore
                                                    </button>
                                                </form>

                                                <!-- Delete Forever Button -->
                                                <form method="POST"
                                                    action="{{ route('law.cases.permanent-delete', $case->id) }}"
                                                    class="inline"
                                                    onsubmit="return confirm('Are you sure? This action cannot be undone!')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded transition duration-150 ease-in-out"
                                                        title="Delete Permanently">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Delete Forever
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Count Display -->
                    <div class="mt-4">
                        <p class="text-sm text-gray-500">
                            Total deleted cases: {{ $deletedCases->count() }}
                        </p>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No deleted cases found</h3>
                        <p class="text-gray-500 mb-6">Your recycle bin is empty.</p>
                        <a href="{{ route('law.cases.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition duration-150 ease-in-out">
                            View Active Cases
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
