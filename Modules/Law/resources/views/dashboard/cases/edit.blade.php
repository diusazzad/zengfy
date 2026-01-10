@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="caseForm()">
        <div class="space-y-6">
            <!-- Header -->
            <div class="flex justify-between items-center">
                <h2 class="text-3xl font-bold text-blue-600 flex items-center">
                    <i class="fas fa-edit mr-3"></i>Edit Case
                </h2>
                <a href="{{ route('law.cases.show', $case->id) }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Case
                </a>
            </div>

            <!-- Main Form Card -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="bg-blue-600 px-6 py-4">
                    <h5 class="text-lg font-semibold text-white">Case Information</h5>
                </div>
                <div class="p-6">
                    <form action="{{ route('law.cases.update', $case->id) }}" method="POST" @submit="submitForm">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Basic Information -->
                            <div class="space-y-6">
                                <h6 class="text-lg font-medium text-gray-500 border-b border-gray-200 pb-2">Basic Information</h6>

                                <div>
                                    <label for="case_type" class="block text-sm font-medium text-gray-700 mb-2">
                                        Case Type <span class="text-red-500">*</span>
                                    </label>
                                    <select name="case_type" id="case_type"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('case_type') border-red-500 @enderror">
                                        <option value="">Select Case Type</option>
                                        @foreach ($caseTypes as $type)
                                            <option value="{{ $type->id }}"
                                                {{ old('case_type', $case->case_type_id) == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('case_type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="case_no" class="block text-sm font-medium text-gray-700 mb-2">
                                        Case Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="case_no" id="case_no"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('case_no') border-red-500 @enderror"
                                        value="{{ old('case_no', $case->court_case_number) }}"
                                        placeholder="Enter case number">
                                    @error('case_no')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="case_title" class="block text-sm font-medium text-gray-700 mb-2">
                                        Case Title <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="case_title" id="case_title"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('case_title') border-red-500 @enderror"
                                        value="{{ old('case_title', $case->case_title) }}"
                                        placeholder="Enter case title">
                                    @error('case_title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="case_stage" class="block text-sm font-medium text-gray-700 mb-2">
                                        Case Stage <span class="text-red-500">*</span>
                                    </label>
                                    <select name="case_stage" id="case_stage"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('case_stage') border-red-500 @enderror">
                                        <option value="">Select Case Stage</option>
                                        @foreach ($caseStages as $stage)
                                            <option value="{{ $stage->id }}"
                                                {{ old('case_stage', $case->case_stage_id) == $stage->id ? 'selected' : '' }}>
                                                {{ $stage->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('case_stage')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="court_id" class="block text-sm font-medium text-gray-700 mb-2">
                                        Court <span class="text-red-500">*</span>
                                    </label>
                                    <select name="court_id" id="court_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('court_id') border-red-500 @enderror">
                                        <option value="">Select Court</option>
                                        @foreach ($courts as $court)
                                            <option value="{{ $court->id }}"
                                                {{ old('court_id', $case->court_id) == $court->id ? 'selected' : '' }}>
                                                {{ $court->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('court_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                    <select name="status" id="status"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                                        <option value="pending" {{ old('status', $case->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="active" {{ old('status', $case->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="decided" {{ old('status', $case->status) == 'decided' ? 'selected' : '' }}>Decided</option>
                                        <option value="archived" {{ old('status', $case->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Parties & Financial Information -->
                            <div class="space-y-6">
                                <h6 class="text-lg font-medium text-gray-500 border-b border-gray-200 pb-2">Parties & Financial Information</h6>

                                <div>
                                    <label for="client_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Client Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="client_name" id="client_name"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('client_name') border-red-500 @enderror"
                                        value="{{ old('client_name', $case->client_name) }}"
                                        placeholder="Enter client name">
                                    @error('client_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="opponent_name" class="block text-sm font-medium text-gray-700 mb-2">
                                        Opponent Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="opponent_name" id="opponent_name"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('opponent_name') border-red-500 @enderror"
                                        value="{{ old('opponent_name', $case->opponent_name) }}"
                                        placeholder="Enter opponent name">
                                    @error('opponent_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="opponent_lawyer" class="block text-sm font-medium text-gray-700 mb-2">Opponent Lawyer</label>
                                    <input type="text" name="opponent_lawyer" id="opponent_lawyer"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('opponent_lawyer') border-red-500 @enderror"
                                        value="{{ old('opponent_lawyer', $case->opponent_lawyer) }}"
                                        placeholder="Enter opponent lawyer name">
                                    @error('opponent_lawyer')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="case_fee" class="block text-sm font-medium text-gray-700 mb-2">Case Fee</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-2 text-gray-500">৳</span>
                                        <input type="number" name="case_fee" id="case_fee"
                                            class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('case_fee') border-red-500 @enderror"
                                            value="{{ old('case_fee', $case->case_fee) }}" min="0"
                                            step="0.01" placeholder="0.00">
                                    </div>
                                    @error('case_fee')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="previous_date" class="block text-sm font-medium text-gray-700 mb-2">Previous Date</label>
                                    <input type="text" name="previous_date" id="previous_date"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('previous_date') border-red-500 @enderror"
                                        value="{{ old('previous_date', $case->formatted_previous_date) }}"
                                        placeholder="Select date">
                                    <small class="text-sm text-gray-500">Select previous hearing date</small>
                                    @error('previous_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="next_date" class="block text-sm font-medium text-gray-700 mb-2">Next Date</label>
                                    <input type="text" name="next_date" id="next_date"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('next_date') border-red-500 @enderror"
                                        value="{{ old('next_date', $case->formatted_next_date) }}"
                                        placeholder="Select date">
                                    <small class="text-sm text-gray-500">Select next hearing date</small>
                                    @error('next_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Payment History -->
                        <div class="mt-8">
                            <h6 class="text-lg font-medium text-gray-500 border-b border-gray-200 pb-2 mb-6">Additional Notes</h6>
                            <div>
                                <label for="payment_history" class="block text-sm font-medium text-gray-700 mb-2">Payment History / Notes</label>
                                <textarea name="payment_history" id="payment_history" rows="4"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('payment_history') border-red-500 @enderror"
                                    placeholder="Enter payment history or additional notes...">{{ old('payment_history', $case->notes) }}</textarea>
                                @error('payment_history')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="mt-8 flex justify-end space-x-3">
                            <a href="{{ route('law.cases.show', $case->id) }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                <i class="fas fa-times mr-2"></i>Cancel
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                    :disabled="submitting"
                                    :class="{ 'opacity-50 cursor-not-allowed': submitting }">
                                <i class="fas fa-save mr-2"></i>
                                <span x-text="submitting ? 'Updating...' : 'Update Case'"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            function caseForm() {
                return {
                    submitting: false,
                    
                    init() {
                        // Initialize Flatpickr for date inputs
                        flatpickr("#previous_date", {
                            dateFormat: "d-m-Y",
                            allowInput: true,
                            clickOpens: true
                        });
                        
                        flatpickr("#next_date", {
                            dateFormat: "d-m-Y",
                            allowInput: true,
                            clickOpens: true,
                            minDate: "today"
                        });
                    },
                    
                    submitForm(event) {
                        this.submitting = true;
                        // Form will submit normally, this just handles the loading state
                    }
                }
            }
        </script>
    @endpush
@endsection
