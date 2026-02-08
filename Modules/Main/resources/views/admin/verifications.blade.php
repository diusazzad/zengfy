<x-main::layouts.app>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h2
                class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                Pending Identity Verifications
            </h2>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Review and approve or reject user identity documents.
            </p>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl flex items-center gap-3">
                <span class="text-xl">✅</span>
                <p class="font-bold">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl flex items-center gap-3">
                <span class="text-xl">❌</span>
                <p class="font-bold">{{ session('error') }}</p>
            </div>
        @endif

        <div class="space-y-12">
            <!-- NID Verifications -->
            <section>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 border-b pb-2">National ID (NID)
                    Requests</h3>
                @if($pendingNid->isEmpty())
                    <p class="text-gray-500 italic">No pending NID requests.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($pendingNid as $user)
                            <div
                                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 flex flex-col">
                                <div class="flex items-center gap-4 mb-4">
                                    <img class="h-12 w-12 rounded-full"
                                        src="{{ $user->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                                        alt="">
                                    <div>
                                        <h4 class="font-bold text-gray-900 dark:text-white">{{ $user->name }}</h4>
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="mt-auto space-y-3">
                                    <a href="{{ Storage::url($user->nid_card_path) }}" target="_blank"
                                        class="block w-full text-center py-2 px-4 bg-blue-50 text-blue-600 rounded-xl text-sm font-bold border border-blue-100 hover:bg-blue-100 transition">
                                        View Document 📄
                                    </a>
                                    <div class="flex gap-2">
                                        <form action="{{ route('main.admin.verifications.verify', $user->id) }}" method="POST"
                                            class="flex-1">
                                            @csrf
                                            <input type="hidden" name="type" value="nid">
                                            <button type="submit"
                                                class="w-full py-2 px-4 bg-green-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-green-500/20 hover:bg-green-700 transition">
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('main.admin.verifications.reject', $user->id) }}" method="POST"
                                            class="flex-1">
                                            @csrf
                                            <input type="hidden" name="type" value="nid">
                                            <button type="submit"
                                                class="w-full py-2 px-4 bg-red-50 text-red-600 rounded-xl text-sm font-bold border border-red-100 hover:bg-red-100 transition">
                                                Reject
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

            <!-- School ID Verifications -->
            <section>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 border-b pb-2">Education ID Requests
                </h3>
                @if($pendingSchool->isEmpty())
                    <p class="text-gray-500 italic">No pending School ID requests.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($pendingSchool as $user)
                            <div
                                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 flex flex-col">
                                <div class="flex items-center gap-4 mb-4">
                                    <img class="h-12 w-12 rounded-full"
                                        src="{{ $user->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                                        alt="">
                                    <div>
                                        <h4 class="font-bold text-gray-900 dark:text-white">{{ $user->name }}</h4>
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="mt-auto space-y-3">
                                    <a href="{{ Storage::url($user->school_id_path) }}" target="_blank"
                                        class="block w-full text-center py-2 px-4 bg-indigo-50 text-indigo-600 rounded-xl text-sm font-bold border border-indigo-100 hover:bg-indigo-100 transition">
                                        View Document 🎓
                                    </a>
                                    <div class="flex gap-2">
                                        <form action="{{ route('main.admin.verifications.verify', $user->id) }}" method="POST"
                                            class="flex-1">
                                            @csrf
                                            <input type="hidden" name="type" value="school">
                                            <button type="submit"
                                                class="w-full py-2 px-4 bg-indigo-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-indigo-500/20 hover:bg-indigo-700 transition">
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('main.admin.verifications.reject', $user->id) }}" method="POST"
                                            class="flex-1">
                                            @csrf
                                            <input type="hidden" name="type" value="school">
                                            <button type="submit"
                                                class="w-full py-2 px-4 bg-red-50 text-red-600 rounded-xl text-sm font-bold border border-red-100 hover:bg-red-100 transition">
                                                Reject
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-main::layouts.app>