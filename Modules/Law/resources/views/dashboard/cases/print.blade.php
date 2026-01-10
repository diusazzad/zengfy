@extends('layouts.app')

@section('title', 'Print Cases')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header Section -->
        <div class="bg-white shadow-sm border-b">
            <div class="px-4 py-6">
                <div class="flex items-center justify-between">
                    <h1 class="text-lg font-semibold">Print Cases</h1>
                    <button onclick="printPage()"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">
                        Print PDF
                    </button>
                </div>
            </div>
        </div>

        <!-- Cases Section -->
        <div class="p-6">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6 text-center">Cases Report</h2>
                    
                    @if($cases->count() > 0)
                        @foreach($cases as $case)
                            <div class="mb-8 p-4 border-b last:border-b-0">
                                <h3 class="text-lg font-semibold mb-3">Case #{{ $case->id }}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="mb-2"><strong>Client Name:</strong> {{ $case->client_name ?? 'N/A' }}</p>
                                        <p class="mb-2"><strong>Case Type:</strong> {{ $case->caseType->name ?? 'N/A' }}</p>
                                        <p class="mb-2"><strong>Case Stage:</strong> {{ $case->caseStage->name ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="mb-2"><strong>Court:</strong> {{ $case->court->name ?? 'N/A' }}</p>
                                        <p class="mb-2"><strong>Created:</strong> {{ $case->created_at->format('M d, Y') }}</p>
                                        <p class="mb-2"><strong>Status:</strong> {{ $case->status ?? 'Active' }}</p>
                                    </div>
                                </div>
                                @if($case->description)
                                    <div class="mt-3">
                                        <p><strong>Description:</strong></p>
                                        <p class="text-gray-700 mt-1">{{ $case->description }}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        
                        <div class="mt-6 text-center text-sm text-gray-500">
                            <p>Total Cases: {{ $cases->count() }}</p>
                            <p>Generated on: {{ now()->format('M d, Y \a\t g:i A') }}</p>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">No cases found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function printPage() {
            window.print();
        }
    </script>
@endsection