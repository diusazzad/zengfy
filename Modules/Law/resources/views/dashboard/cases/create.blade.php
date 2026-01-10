<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Case - Digital Lawyer Diary</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @vite('resources/css/app.css')
    <style>
        .modal-content {
            transform: scale(0.7);
            transition: transform 0.3s ease-in-out;
        }

        .modal-content.show {
            transform: scale(1);
        }

        .input-focus {
            transition: all 0.3s ease;
        }

        .input-focus:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        .combobox-button {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 3rem;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            color: #9ca3af;
            transition: all 0.2s ease;
        }

        .combobox-button:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .combobox-button.active {
            color: #374151;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">

    <div class="container mx-auto p-8 max-w-3xl">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-8 text-center">Create New Case</h1>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8 rounded-lg shadow-sm" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded-lg shadow-sm" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('law.cases.store') }}" method="POST" class="bg-white p-8 rounded-xl shadow-lg space-y-6">
            @csrf

            <!-- Office File Number -->
            <div class="space-y-2">
                <label for="case_no" class="block text-base font-semibold text-gray-700">Office File Number</label>
                <input type="text" name="case_no" id="case_no"
                    class="input-focus flex w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    placeholder="e.g., 12345-A" value="{{ old('case_no') }}" style="height: 3rem;">
            </div>

            <!-- Court Case Number -->
            <div class="space-y-2">
                <label for="court_case_number" class="block text-base font-semibold text-gray-700">Court Case
                    Number</label>
                <input type="text" name="court_case_number" id="court_case_number"
                    class="input-focus flex w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    placeholder="e.g., 6789" value="{{ old('court_case_number') }}" style="height: 3rem;">
            </div>

            <!-- Case Title -->
            <div class="space-y-2">
                <label for="case_title" class="block text-base font-semibold text-gray-700">Case Title</label>
                <input type="text" name="case_title" id="case_title"
                    class="input-focus flex w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    placeholder="e.g., John Doe v. Jane Doe" value="{{ old('case_title') }}" style="height: 3rem;">
            </div>

            <!-- Case Type with Modal Search -->
            <div class="space-y-2">
                <label for="case_type_search" class="block text-base font-semibold text-gray-700">Case Type</label>
                <button type="button" id="case_type_search" class="combobox-button w-full" role="combobox"
                    aria-expanded="false" aria-haspopup="dialog">
                    Type to search or create new case type
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="h-4 w-4 opacity-50">
                        <path d="m7 15 5 5 5-5"></path>
                        <path d="m7 9 5-5 5 5"></path>
                    </svg>
                </button>
                <input type="hidden" name="case_type" id="case_type_id" value="{{ old('case_type') }}">
            </div>

            <!-- Case Stage with Modal Search -->
            <div class="space-y-2">
                <label for="case_stage_search" class="block text-base font-semibold text-gray-700">Case Stage</label>
                <button type="button" id="case_stage_search" class="combobox-button w-full" role="combobox"
                    aria-expanded="false" aria-haspopup="dialog">
                    Type to search or create new case stage
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="h-4 w-4 opacity-50">
                        <path d="m7 15 5 5 5-5"></path>
                        <path d="m7 9 5-5 5 5"></path>
                    </svg>
                </button>
                <input type="hidden" name="case_stage" id="case_stage_id" value="{{ old('case_stage') }}">
            </div>

            <!-- Court with Modal Search -->
            <div class="space-y-2">
                <label for="court_search" class="block text-base font-semibold text-gray-700">Court</label>
                <button type="button" id="court_search" class="combobox-button w-full" role="combobox"
                    aria-expanded="false" aria-haspopup="dialog">
                    Type to search or create new court
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="h-4 w-4 opacity-50">
                        <path d="m7 15 5 5 5-5"></path>
                        <path d="m7 9 5-5 5 5"></path>
                    </svg>
                </button>
                <input type="hidden" name="court_id" id="court_id" value="{{ old('court_id') }}">
            </div>

            <!-- Opening Date -->
            <div class="space-y-2">
                <label for="opening_date" class="block text-base font-semibold text-gray-700">Opening Date</label>
                <button type="button" id="opening_date_button" class="combobox-button w-full" aria-haspopup="dialog">
                    {{ old('opening_date') ?: 'Pick a date' }}
                </button>
                <input type="hidden" name="opening_date" id="opening_date" value="{{ old('opening_date') }}">
            </div>

            <!-- Previous Date -->
            <div class="space-y-2">
                <label for="previous_date" class="block text-base font-semibold text-gray-700">Previous Date</label>
                <button type="button" id="previous_date_button" class="combobox-button w-full" aria-haspopup="dialog">
                    {{ old('previous_date') ?: 'Pick a date' }}
                </button>
                <input type="hidden" name="previous_date" id="previous_date" value="{{ old('previous_date') }}">
            </div>

            <!-- Next Date -->
            <div class="space-y-2">
                <label for="next_date" class="block text-base font-semibold text-gray-700">Next Date</label>
                <button type="button" id="next_date_button" class="combobox-button w-full" aria-haspopup="dialog">
                    {{ old('next_date') ?: 'Pick a date' }}
                </button>
                <input type="hidden" name="next_date" id="next_date" value="{{ old('next_date') }}">
            </div>

            <!-- Client Name -->
            <div class="space-y-2">
                <label for="client_name" class="block text-base font-semibold text-gray-700">Client Name</label>
                <input type="text" name="client_name" id="client_name"
                    class="input-focus flex w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    placeholder="e.g., John Doe" value="{{ old('client_name') }}" style="height: 3rem;">
            </div>

            <!-- Opponent Name -->
            <div class="space-y-2">
                <label for="opponent_name" class="block text-base font-semibold text-gray-700">Opponent Name</label>
                <input type="text" name="opponent_name" id="opponent_name"
                    class="input-focus flex w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    placeholder="e.g., Jane Doe" value="{{ old('opponent_name') }}" style="height: 3rem;">
            </div>

            <!-- Opponent Lawyer -->
            <div class="space-y-2">
                <label for="opponent_lawyer" class="block text-base font-semibold text-gray-700">Opponent Lawyer
                    (Optional)</label>
                <input type="text" name="opponent_lawyer" id="opponent_lawyer"
                    class="input-focus flex w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    placeholder="e.g., Lawyer Name" value="{{ old('opponent_lawyer') }}" style="height: 3rem;">
            </div>

            <!-- Case Fee -->
            <div class="space-y-2">
                <label for="case_fee" class="block text-base font-semibold text-gray-700">Case Fee (Optional)</label>
                <input type="number" name="case_fee" id="case_fee"
                    class="input-focus flex w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    placeholder="e.g., 5000" value="{{ old('case_fee') }}" min="0" style="height: 3rem;">
            </div>

            <!-- Payment History (Notes) -->
            <div class="space-y-2">
                <label for="payment_history" class="block text-base font-semibold text-gray-700">Notes
                    (Optional)</label>
                <textarea name="payment_history" id="payment_history"
                    class="input-focus flex min-h-[80px] w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    placeholder="e.g., Important notes">{{ old('payment_history') }}</textarea>
            </div>

            <!-- Status -->
            <div class="space-y-2">
                <label for="status" class="block text-base font-semibold text-gray-700">Status</label>
                <select name="status" id="status"
                    class="input-focus flex w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    style="height: 3rem;">
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="decided" {{ old('status') == 'decided' ? 'selected' : '' }}>Decided</option>
                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200">Create
                    Case</button>
            </div>
        </form>
    </div>

    <!-- Case Type Modal -->
    <div id="caseTypeModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl p-6 w-full max-w-lg modal-content">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Select or Add Case Type</h2>
                <button id="closeCaseTypeModal"
                    class="text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
            </div>
            <input type="text" id="case_type_modal_search"
                class="w-full border border-gray-300 rounded-lg shadow-sm p-3 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                placeholder="Search or type new case type">
            <div id="case_type_results" class="mt-4 max-h-60 overflow-y-auto bg-gray-50 rounded-lg p-2"></div>
            <button id="addCaseType"
                class="mt-4 w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 transition duration-200 hidden">Add
                New Case Type</button>
        </div>
    </div>

    <!-- Case Stage Modal -->
    <div id="caseStageModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl p-6 w-full max-w-lg modal-content">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Select or Add Case Stage</h2>
                <button id="closeCaseStageModal"
                    class="text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
            </div>
            <input type="text" id="case_stage_modal_search"
                class="w-full border border-gray-300 rounded-lg shadow-sm p-3 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                placeholder="Search or type new case stage">
            <div id="case_stage_results" class="mt-4 max-h-60 overflow-y-auto bg-gray-50 rounded-lg p-2"></div>
            <button id="addCaseStage"
                class="mt-4 w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 transition duration-200 hidden">Add
                New Case Stage</button>

        </div>
    </div>

    <!-- Court Modal -->
    <div id="courtModal" class="fixed inset-0 bg-gray-900 bg-opacity-60 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl p-6 w-full max-w-lg modal-content">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Select or Add Court</h2>
                <button id="closeCourtModal"
                    class="text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
            </div>
            <input type="text" id="court_modal_search"
                class="w-full border border-gray-300 rounded-lg shadow-sm p-3 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                placeholder="Search or type new court">
            <div id="court_results" class="mt-4 max-h-60 overflow-y-auto bg-gray-50 rounded-lg p-2"></div>
            <button id="addCourt"
                class="mt-4 w-full bg-green-600 text-white py-3 px-4 rounded-lg hover:bg-green-700 transition duration-200 hidden">Add
                New Court</button>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Flatpickr for dates
            const dateConfig = {
                dateFormat: "Y-m-d",
                allowInput: false
            };
            flatpickr("#opening_date", dateConfig);
            flatpickr("#previous_date", dateConfig);
            flatpickr("#next_date", dateConfig);

            // Date picker buttons
            $('#opening_date_button').on('click', function () {
                $('#opening_date').get(0).flatpickr().open();
            });
            $('#previous_date_button').on('click', function () {
                $('#previous_date').get(0).flatpickr().open();
            });
            $('#next_date_button').on('click', function () {
                $('#next_date').get(0).flatpickr().open();
            });

            // Update button text when date is selected
            $('#opening_date').on('change', function () {
                $('#opening_date_button').text($(this).val() || 'Pick a date').addClass('active');
            });
            $('#previous_date').on('change', function () {
                $('#previous_date_button').text($(this).val() || 'Pick a date').addClass('active');
            });
            $('#next_date').on('change', function () {
                $('#next_date_button').text($(this).val() || 'Pick a date').addClass('active');
            });

            // Case Type Modal
            $('#case_type_search').on('click', function () {
                $('#caseTypeModal').removeClass('hidden');
                $('.modal-content').addClass('show');
                $('#case_type_modal_search').val('');
                $('#case_type_results').empty();
                $('#addCaseType').addClass('hidden');
                $('#case_type_modal_search').focus();

                // Load all case types
                $.ajax({
                    url: "{{ route('law.case-types.search') }}",
                    data: {
                        query: ''
                    },
                    success: function (data) {
                        let results = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                results +=
                                    `<div class="p-3 hover:bg-indigo-50 cursor-pointer text-gray-700 rounded-lg transition-colors" data-id="${item.id}">${item.name}</div>`;
                            });
                            $('#addCaseType').addClass('hidden');
                        } else {
                            results =
                                '<div class="p-3 text-gray-500">No case types found</div>';
                            $('#addCaseType').removeClass('hidden');
                        }
                        $('#case_type_results').html(results);
                    },
                    error: function () {
                        $('#case_type_results').html(
                            '<div class="p-3 text-red-500">Failed to load case types</div>');
                    }
                });
            });

            $('#closeCaseTypeModal').on('click', function () {
                $('.modal-content').removeClass('show');
                setTimeout(() => $('#caseTypeModal').addClass('hidden'), 300);
            });

            $('#case_type_modal_search').on('input', function () {
                const query = $(this).val();
                $.ajax({
                    url: "{{ route('law.case-types.search') }}",
                    data: {
                        query: query
                    },
                    success: function (data) {
                        let results = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                results +=
                                    `<div class="p-3 hover:bg-indigo-50 cursor-pointer text-gray-700 rounded-lg transition-colors" data-id="${item.id}">${item.name}</div>`;
                            });
                            $('#addCaseType').addClass('hidden');
                        } else {
                            results =
                                '<div class="p-3 text-gray-500">No case types found</div>';
                            $('#addCaseType').removeClass('hidden');
                        }
                        $('#case_type_results').html(results);
                    },
                    error: function () {
                        $('#case_type_results').html(
                            '<div class="p-3 text-red-500">Failed to load case types</div>');
                    }
                });
            });

            $('#case_type_results').on('click', 'div[data-id]', function () {
                const selectedText = $(this).text();
                const selectedId = $(this).data('id');
                $('#case_type_search').text(selectedText).addClass('active');
                $('#case_type_id').val(selectedId);
                $('.modal-content').removeClass('show');
                setTimeout(() => $('#caseTypeModal').addClass('hidden'), 300);
            });

            $('#addCaseType').on('click', function () {
                const name = $('#case_type_modal_search').val();
                if (name) {
                    $.ajax({
                        url: "{{ route('law.case-types.add') }}",
                        method: 'POST',
                        data: {
                            name: name,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (data) {
                            $('#case_type_search').text(data.name).addClass('active');
                            $('#case_type_id').val(data.id);
                            $('.modal-content').removeClass('show');
                            setTimeout(() => $('#caseTypeModal').addClass('hidden'), 300);
                        },
                        error: function () {
                            alert('Failed to add case type. Please try again.');
                        }
                    });
                }
            });

            // Case Stage Modal
            $('#case_stage_search').on('click', function () {
                $('#caseStageModal').removeClass('hidden');
                $('.modal-content').addClass('show');
                $('#case_stage_modal_search').val('');
                $('#case_stage_results').empty();
                $('#addCaseStage').addClass('hidden');
                $('#case_stage_modal_search').focus();

                // Load all case stages
                $.ajax({
                    url: "{{ route('law.case-stages.search') }}",
                    data: {
                        query: ''
                    },
                    success: function (data) {
                        let results = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                results +=
                                    `<div class="p-3 hover:bg-indigo-50 cursor-pointer text-gray-700 rounded-lg transition-colors" data-id="${item.id}">${item.name}</div>`;
                            });
                            $('#addCaseStage').addClass('hidden');
                        } else {
                            results =
                                '<div class="p-3 text-gray-500">No case stages found</div>';
                            $('#addCaseStage').removeClass('hidden');
                        }
                        $('#case_stage_results').html(results);
                    },
                    error: function () {
                        $('#case_stage_results').html(
                            '<div class="p-3 text-red-500">Failed to load case stages</div>'
                        );
                    }
                });
            });

            $('#closeCaseStageModal').on('click', function () {
                $('.modal-content').removeClass('show');
                setTimeout(() => $('#caseStageModal').addClass('hidden'), 300);
            });

            $('#case_stage_modal_search').on('input', function () {
                const query = $(this).val();
                $.ajax({
                    url: "{{ route('law.case-stages.search') }}",
                    data: {
                        query: query
                    },
                    success: function (data) {
                        let results = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                results +=
                                    `<div class="p-3 hover:bg-indigo-50 cursor-pointer text-gray-700 rounded-lg transition-colors" data-id="${item.id}">${item.name}</div>`;
                            });
                            $('#addCaseStage').addClass('hidden');
                        } else {
                            results =
                                '<div class="p-3 text-gray-500">No case stages found</div>';
                            $('#addCaseStage').removeClass('hidden');
                        }
                        $('#case_stage_results').html(results);
                    },
                    error: function () {
                        $('#case_stage_results').html(
                            '<div class="p-3 text-red-500">Failed to load case stages</div>'
                        );
                    }
                });
            });

            $('#case_stage_results').on('click', 'div[data-id]', function () {
                const selectedText = $(this).text();
                const selectedId = $(this).data('id');
                $('#case_stage_search').text(selectedText).addClass('active');
                $('#case_stage_id').val(selectedId);
                $('.modal-content').removeClass('show');
                setTimeout(() => $('#caseStageModal').addClass('hidden'), 300);
            });

            $('#addCaseStage').on('click', function () {
                const name = $('#case_stage_modal_search').val();
                if (name) {
                    $.ajax({
                        url: "{{ route('law.case-stages.add') }}",
                        method: 'POST',
                        data: {
                            name: name,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (data) {
                            $('#case_stage_search').text(data.name).addClass('active');
                            $('#case_stage_id').val(data.id);
                            $('.modal-content').removeClass('show');
                            setTimeout(() => $('#caseStageModal').addClass('hidden'), 300);
                        },
                        error: function () {
                            alert('Failed to add case stage. Please try again.');
                        }
                    });
                }
            });

            // Court Modal
            $('#court_search').on('click', function () {
                $('#courtModal').removeClass('hidden');
                $('.modal-content').addClass('show');
                $('#court_modal_search').val('');
                $('#court_results').empty();
                $('#addCourt').addClass('hidden');
                $('#court_modal_search').focus();

                // Load all courts
                $.ajax({
                    url: "{{ route('law.courts.search') }}",
                    data: {
                        query: ''
                    },
                    success: function (data) {
                        let results = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                results +=
                                    `<div class="p-3 hover:bg-indigo-50 cursor-pointer text-gray-700 rounded-lg transition-colors" data-id="${item.id}">${item.name}</div>`;
                            });
                            $('#addCourt').addClass('hidden');
                        } else {
                            results = '<div class="p-3 text-gray-500">No courts found</div>';
                            $('#addCourt').removeClass('hidden');
                        }
                        $('#court_results').html(results);
                    },
                    error: function () {
                        $('#court_results').html(
                            '<div class="p-3 text-red-500">Failed to load courts</div>');
                    }
                });
            });

            $('#closeCourtModal').on('click', function () {
                $('.modal-content').removeClass('show');
                setTimeout(() => $('#courtModal').addClass('hidden'), 300);
            });

            $('#court_modal_search').on('input', function () {
                const query = $(this).val();
                $.ajax({
                    url: "{{ route('law.courts.search') }}",
                    data: {
                        query: query
                    },
                    success: function (data) {
                        let results = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                results +=
                                    `<div class="p-3 hover:bg-indigo-50 cursor-pointer text-gray-700 rounded-lg transition-colors" data-id="${item.id}">${item.name}</div>`;
                            });
                            $('#addCourt').addClass('hidden');
                        } else {
                            results = '<div class="p-3 text-gray-500">No courts found</div>';
                            $('#addCourt').removeClass('hidden');
                        }
                        $('#court_results').html(results);
                    },
                    error: function () {
                        $('#court_results').html(
                            '<div class="p-3 text-red-500">Failed to load courts</div>');
                    }
                });
            });

            $('#court_results').on('click', 'div[data-id]', function () {
                const selectedText = $(this).text();
                const selectedId = $(this).data('id');
                $('#court_search').text(selectedText).addClass('active');
                $('#court_id').val(selectedId);
                $('.modal-content').removeClass('show');
                setTimeout(() => $('#courtModal').addClass('hidden'), 300);
            });

            $('#addCourt').on('click', function () {
                const name = $('#court_modal_search').val();
                if (name) {
                    $.ajax({
                        url: "{{ route('law.courts.add') }}",
                        method: 'POST',
                        data: {
                            name: name,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (data) {
                            $('#court_search').text(data.name).addClass('active');
                            $('#court_id').val(data.id);
                            $('.modal-content').removeClass('show');
                            setTimeout(() => $('#courtModal').addClass('hidden'), 300);
                        },
                        error: function () {
                            alert('Failed to add court. Please try again.');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>