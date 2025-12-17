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
        </div>

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
                            Update your account's profile information and email address.
                        </p>
                    </div>
                    <div class="md:col-span-2 space-y-6">
                        <div class="flex items-center space-x-6">
                            <div class="shrink-0">
                                <img class="h-16 w-16 object-cover rounded-full"
                                    src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random"
                                    alt="Current profile photo" />
                            </div>
                            <label class="block">
                                <span class="sr-only">Choose profile photo</span>
                                <input type="file" class="block w-full text-sm text-slate-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-blue-50 file:text-blue-700
                                  hover:file:bg-blue-100
                                " />
                            </label>
                        </div>

                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="name" value="{{ Auth::user()->name }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-2 border">
                            </div>

                            <div>
                                <label for="email"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email
                                    address</label>
                                <input type="email" name="email" id="email" value="{{ Auth::user()->email }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white sm:text-sm p-2 border"
                                    disabled>
                                <p class="mt-1 text-xs text-gray-500">Email cannot be changed for Google accounts.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-200 dark:border-gray-700">

                <!-- Connected Accounts -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Connected Accounts</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            Manage your social login connections.
                        </p>
                    </div>
                    <div class="md:col-span-2">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" aria-hidden="true" fill="currentColor">
                                    <path
                                        d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .533 5.333.533 12S5.867 24 12.48 24c3.44 0 6.04-1.133 8.08-3.253 2.053-2.12 2.64-5.387 2.64-7.947 0-.547-.053-1.08-.107-1.48H12.48z"
                                        fill="#EA4335" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Google</p>
                                    <p class="text-xs text-gray-500">Connected as {{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <span
                                class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Connected</span>
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