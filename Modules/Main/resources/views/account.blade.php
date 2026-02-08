<x-main::layouts.app>
    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="min-w-0 flex-1">
                <h2
                    class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
                    Account Settings
                </h2>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Manage your profile, security, and connected apps.
                </p>
            </div>
            <div class="mt-4 flex md:ml-4 md:mt-0">
                <a href="{{ route('profile', Auth::id()) }}"
                    class="inline-flex items-center rounded-xl bg-blue-600 px-4 py-2 text-sm font-bold text-white shadow-lg shadow-blue-500/20 hover:bg-blue-700 transition">
                    View My Profile
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl flex items-center gap-3">
                <span class="text-xl">✅</span>
                <p class="font-bold">{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl">
                <div class="flex items-center gap-3 mb-2">
                    <span class="text-xl">⚠️</span>
                    <p class="font-bold">Please fix the following issues:</p>
                </div>
                <ul class="list-disc list-inside text-sm font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <!-- Tabs (Visual only for now) -->
            <div class="border-b border-gray-200 dark:border-gray-700">
                <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                    <a href="#"
                        class="border-blue-500 text-blue-600 dark:text-blue-400 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium"
                        aria-current="page">General</a>
                    <a href="#"
                        class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">Security</a>
                    <a href="#"
                        class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">Billing</a>
                    <a href="#"
                        class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">Notifications</a>
                </nav>
            </div>

            <div class="p-6 space-y-8">

                <!-- Profile Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Profile Information</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Update your account's profile information and avatar.
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <form action="{{ route('account.update') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-6">
                            @csrf
                            <div class="flex items-center space-x-6">
                                <div class="relative group">
                                    <img class="h-20 w-20 object-cover rounded-full border-4 border-blue-100 shadow-sm transition group-hover:opacity-75"
                                        src="{{ Auth::user()->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0D8ABC&color=fff' }}"
                                        alt="Profile photo" />
                                    <div
                                        class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <input type="file" name="avatar"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900 dark:text-white">Change Avatar</p>
                                    <p class="text-xs text-gray-500 mt-1">JPG, PNG or GIF. Max 2MB.</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">Display
                                        Name</label>
                                    <input type="text" name="name" value="{{ Auth::user()->name }}"
                                        class="mt-1 block w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-3 border font-medium">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">Phone
                                        Number</label>
                                    <input type="text" name="phone" value="{{ Auth::user()->phone }}"
                                        placeholder="+8801..."
                                        class="mt-1 block w-full rounded-xl border-gray-200 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-3 border font-medium">
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-xl shadow-lg shadow-blue-500/20 transition">Save
                                    Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                <hr class="border-gray-100 dark:border-gray-700">

                <!-- Identification Verification -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Identity Verification
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Verify your identity to unlock premium features and legal services.
                        </p>
                    </div>
                    <div class="md:col-span-2 space-y-4">
                        <!-- NID Card -->
                        <div
                            class="p-5 border rounded-2xl {{ Auth::user()->nid_verified ? 'bg-green-50/50 border-green-100' : (Auth::user()->nid_card_path ? 'bg-amber-50/50 border-amber-100' : 'bg-gray-50/50 border-gray-200') }} flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 {{ Auth::user()->nid_verified ? 'bg-green-100 text-green-600' : (Auth::user()->nid_card_path ? 'bg-amber-100 text-amber-600' : 'bg-blue-100 text-blue-600') }} rounded-xl flex items-center justify-center text-2xl shadow-sm">
                                    🪪
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-bold text-gray-900 truncate">National ID (NID)</h4>
                                    <p
                                        class="text-[10px] {{ Auth::user()->nid_verified ? 'text-green-600 font-bold' : (Auth::user()->nid_card_path ? 'text-amber-600 font-bold' : 'text-gray-500') }} leading-none mt-1">
                                        @if(Auth::user()->nid_verified)
                                            ✓ Verified & Secured
                                        @elseif(Auth::user()->nid_card_path)
                                            ⌛ Verification Pending
                                        @else
                                            Not verified yet
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @if(!Auth::user()->nid_verified && !Auth::user()->nid_card_path)
                                <form action="{{ route('account.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="nid_card" id="nid_input" class="hidden"
                                        onchange="this.form.submit()">
                                    <button type="button" onclick="document.getElementById('nid_input').click()"
                                        class="px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm font-bold shadow-sm hover:bg-gray-50 transition active:scale-95">
                                        Upload Card
                                    </button>
                                </form>
                            @elseif(Auth::user()->nid_card_path && !Auth::user()->nid_verified)
                                <span
                                    class="text-amber-700 text-xs font-bold bg-white px-3 py-1.5 rounded-lg border border-amber-200 shadow-sm">In
                                    Review</span>
                            @else
                                <span
                                    class="text-green-700 text-xs font-bold bg-white px-3 py-1.5 rounded-lg border border-green-200 shadow-sm">Verified</span>
                            @endif
                        </div>

                        <!-- School/College ID -->
                        <div
                            class="p-5 border rounded-2xl {{ Auth::user()->school_id_verified ? 'bg-indigo-50/50 border-indigo-100' : (Auth::user()->school_id_path ? 'bg-amber-50/50 border-amber-100' : 'bg-gray-50/50 border-gray-200') }} flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 {{ Auth::user()->school_id_verified ? 'bg-indigo-100 text-indigo-600' : (Auth::user()->school_id_path ? 'bg-amber-100 text-amber-600' : 'bg-blue-100 text-blue-600') }} rounded-xl flex items-center justify-center text-2xl shadow-sm">
                                    🎓
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-bold text-gray-900 truncate">Education ID</h4>
                                    <p
                                        class="text-[10px] {{ Auth::user()->school_id_verified ? 'text-indigo-600 font-bold' : (Auth::user()->school_id_path ? 'text-amber-600 font-bold' : 'text-gray-500') }} leading-none mt-1">
                                        @if(Auth::user()->school_id_verified)
                                            ✓ Verified Student
                                        @elseif(Auth::user()->school_id_path)
                                            ⌛ Review in Progress
                                        @else
                                            For student discounts
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @if(!Auth::user()->school_id_verified && !Auth::user()->school_id_path)
                                <form action="{{ route('account.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="school_id" id="school_input" class="hidden"
                                        onchange="this.form.submit()">
                                    <button type="button" onclick="document.getElementById('school_input').click()"
                                        class="px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm font-bold shadow-sm hover:bg-gray-50 transition active:scale-95">
                                        Upload ID
                                    </button>
                                </form>
                            @elseif(Auth::user()->school_id_path && !Auth::user()->school_id_verified)
                                <span
                                    class="text-amber-700 text-xs font-bold bg-white px-3 py-1.5 rounded-lg border border-amber-200 shadow-sm">Pending</span>
                            @else
                                <span
                                    class="text-indigo-700 text-xs font-bold bg-white px-3 py-1.5 rounded-lg border border-indigo-200 shadow-sm">Verified</span>
                            @endif
                        </div>
                    </div>
                </div>

                <hr class="border-gray-100 dark:border-gray-700">

                <!-- Security Section -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Connected Accounts</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Your security and login methods.
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <div
                            class="bg-blue-50/30 border border-blue-100 rounded-2xl p-5 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 bg-white rounded-lg p-2 shadow-sm border border-blue-50/50">
                                    <svg viewBox="0 0 24 24" aria-hidden="true" fill="currentColor">
                                        <path
                                            d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .533 5.333.533 12S5.867 24 12.48 24c3.44 0 6.04-1.133 8.08-3.253 2.053-2.12 2.64-5.387 2.64-7.947 0-.547-.053-1.08-.107-1.48H12.48z"
                                            fill="#EA4335" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-bold text-gray-900">Google Workspace</p>
                                    <p class="text-xs text-blue-600 truncate">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Primary
                                Login</span>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-200 dark:border-gray-700">

                <!-- Danger Zone -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <h3 class="text-lg font-medium leading-6 text-red-600">Danger Zone</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Irreversible actions for your account.
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <button type="button"
                            class="rounded-md bg-red-50 px-3 py-2 text-sm font-semibold text-red-600 shadow-sm hover:bg-red-100 border border-red-200">
                            Delete Account
                        </button>
                    </div>
                </div>


            </div>

            <!-- Footer Actions -->
            <div class="bg-gray-50 dark:bg-gray-700/30 px-6 py-3 flex text-right sm:px-6 justify-end">
                <button type="button"
                    class="inline-flex justify-center rounded-md bg-blue-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                    Save Changes
                </button>
            </div>
        </div>
    </div>
</x-main::layouts.app>