@extends('layouts.app')

@section('content')
    <div class="space-y-8 max-w-3xl mx-auto py-8">
        <!-- Case Title & Actions -->
        <div
            class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-2xl shadow-xl p-7 border border-blue-200 flex justify-between items-center m-4 transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl">
            <div>
                <h1 class="text-2xl font-bold text-blue-900 mb-2 flex items-center gap-3">
                    <span class="font-normal text-blue-700">{{ $case->case_title }}</span>
                    <span class="
                px-3 py-1 rounded-full text-xs font-semibold
                @if ($case->status === 'pending') bg-yellow-100 text-yellow-700
                @elseif($case->status === 'active') bg-green-100 text-green-700
                @elseif($case->status === 'decided') bg-blue-100 text-blue-700
                @elseif($case->status === 'archived') bg-gray-200 text-gray-700
                @else bg-gray-100 text-gray-700 @endif
            ">
                        {{ ucfirst($case->status) }}
                    </span>
                </h1>
                <div class="text-gray-700 space-y-1">
                    <div>Judge: <span class="font-semibold text-blue-700">{{ $case->court }}</span></div>
                    <div>Stage: <span class="font-semibold text-blue-700">{{ $case->case_stage }}</span></div>
                    <div>Next Date: <span class="font-semibold text-blue-700">{{ $case->formatted_next_date }}</span></div>
                </div>
            </div>
            <!-- Actions Dropdown -->
            <div class="relative">
                <button id="caseActionsBtn"
                    class="inline-flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 hover:bg-blue-200 focus:outline-none shadow transition-all duration-300 hover:scale-110">
                    <svg class="w-7 h-7 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="5" r="1.5" />
                        <circle cx="12" cy="12" r="1.5" />
                        <circle cx="12" cy="19" r="1.5" />
                    </svg>
                </button>
                <div id="caseActionsMenu"
                    class="hidden absolute right-0 mt-2 w-48 bg-white border border-blue-100 rounded-xl shadow-xl z-30 overflow-hidden">
                    <a href="{{ route('law.cases.edit', $case->id) }}"
                        class="block px-5 py-3 hover:bg-blue-50 transition">✏️
                        Edit</a>

                    <a href="{{ route('law.cases.download', $case->id) }}"
                        class="block px-5 py-3 hover:bg-blue-50 transition" target="_blank" rel="noopener">
                        ⬇️ Download
                    </a>
                    <a href="{{ route('law.cases.share.public', $case->id) }}"
                        class="block px-5 py-3 hover:bg-blue-50 transition">🔗
                        Share</a>
                    <a href="{{ route('law.cases.history', $case->id) }}"
                        class="block px-5 py-3 hover:bg-blue-50 transition">🕑
                        History</a>
                    <form action="{{ route('law.cases.destroy', $case->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full text-left block px-5 py-3 text-red-600 hover:bg-red-50 transition">🗑️
                            Delete</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Case Details Dropdown -->
        <div class="bg-white rounded-2xl border border-blue-100 overflow-hidden px-7 py-6 shadow m-4 cursor-pointer group"
            onclick="toggleDropdown('caseDetailsDropdown')">
            <div class="flex items-center justify-between w-full">
                <span class="font-semibold text-lg text-blue-800">Case Details</span>
                <svg class="w-6 h-6 group-hover:text-blue-600 transition" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div id="caseDetailsDropdown" class="hidden mt-4 text-gray-700">
                <div class="grid grid-cols-2 gap-x-8 gap-y-3">
                    <div class="font-medium text-blue-900">Office file number:</div>
                    <div class="text-blue-700">{{ $case->office_file_number }}</div>

                    <div class="font-medium text-blue-900">Case Type:</div>
                    <div class="text-blue-700">{{ $case->case_type }}</div>

                    <div class="font-medium text-blue-900">Case No:</div>
                    <div class="text-blue-700">{{ $case->case_no }}</div>

                    <div class="font-medium text-blue-900">Opponent Name:</div>
                    <div class="text-blue-700">{{ $case->opponent_name }}</div>

                    <div class="font-medium text-blue-900">Opponent Lawyer:</div>
                    <div class="text-blue-700">{{ $case->opponent_lawyer }}</div>
                </div>
            </div>
        </div>

        <!-- Contact Information Dropdown -->
        <div class="bg-white rounded-2xl border border-blue-100 overflow-hidden px-7 py-6 shadow m-4 cursor-pointer group"
            onclick="toggleDropdown('contactInfoDropdown')">
            <div class="flex items-center justify-between w-full">
                <span class="font-semibold text-lg text-blue-800">Contact Information</span>
                <svg class="w-6 h-6 group-hover:text-blue-600 transition" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div id="contactInfoDropdown" class="hidden mt-4 text-gray-700">
                <div class="grid grid-cols-2 gap-x-8 gap-y-3">
                    <div class="font-medium text-blue-900">Client Name:</div>
                    <div class="text-blue-700">{{ $case->client_name }}</div>

                    <div class="font-medium text-blue-900">Phone:</div>
                    <div class="text-blue-700">{{ $case->client_phone ?? 'N/A' }}</div>

                    <div class="font-medium text-blue-900">Email:</div>
                    <div class="text-blue-700">{{ $case->client_email ?? 'N/A' }}</div>
                </div>
            </div>
        </div>

        <!-- Additional Information Dropdown -->
        <div class="bg-white rounded-2xl border border-blue-100 overflow-hidden px-7 py-6 shadow m-4 cursor-pointer group"
            onclick="toggleDropdown('additionalInfoDropdown')">
            <div class="flex items-center justify-between w-full">
                <span class="font-semibold text-lg text-blue-800">Additional Information</span>
                <svg class="w-6 h-6 group-hover:text-blue-600 transition" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <div id="additionalInfoDropdown" class="hidden mt-4 text-gray-700">
                <div class="grid grid-cols-2 gap-x-8 gap-y-3">
                    <div class="font-medium text-blue-900">Case Fee:</div>
                    <div class="text-blue-700">{{ $case->case_fee }}</div>

                    <div class="font-medium text-blue-900">Notes:</div>
                    <div class="text-blue-700">{{ $case->notes ?: 'N/A' }}</div>
                </div>
            </div>
        </div>


    </div>

    <script>
        // dropdown for case details
        function toggleDropdown(id) {
            const el = document.getElementById(id);
            if (el) el.classList.toggle('hidden');
        }


        // Dropdown toggle logic
        document.querySelectorAll('[data-target]').forEach(el => {
            el.addEventListener('click', function (e) {
                const targetId = this.getAttribute('data-target');
                if (!targetId) return;
                const target = document.getElementById(targetId);
                if (target) target.classList.toggle('hidden');
            });
        });

        // Actions dropdown logic
        const actionsBtn = document.getElementById('caseActionsBtn');
        const actionsMenu = document.getElementById('caseActionsMenu');
        if (actionsBtn && actionsMenu) {
            actionsBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                actionsMenu.classList.toggle('hidden');
            });
            document.addEventListener('click', function () {
                actionsMenu.classList.add('hidden');
            });
        }
    </script>
@endsection