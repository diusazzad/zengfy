@auth
<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" @click.outside="open = false" type="button"
        class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
        <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full"
            src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" alt="user photo">
    </button>
    <!-- Dropdown menu -->
    <div x-show="open" x-transition
        class="absolute right-0 z-50 mt-2 my-4 w-56 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
        id="dropdown-user">
        <div class="px-4 py-3" role="none">
            <p class="text-sm text-gray-900 dark:text-white" role="none">
                {{ Auth::user()->name }}
            </p>
            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                {{ Auth::user()->email }}
            </p>
        </div>
        <ul class="py-1" role="none">
            <li>
                <a href="{{ route('profile', Auth::id()) }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem">My Profile</a>
            </li>
            <li>
                <a href="{{ route('account') }}"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem">Account Center</a>
            </li>
            @if(Auth::user()->hasRole('admin'))
                <li>
                    <a href="{{ route('main.admin.verifications.index') }}"
                        class="block px-4 py-2 text-sm text-blue-600 font-bold hover:bg-blue-50 dark:text-blue-400 dark:hover:bg-gray-600"
                        role="menuitem">Verification Requests</a>
                </li>
            @endif
            <li>
                <a href="#settings"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem">Settings</a>
            </li>
            <li>
                <a href="#billing"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                    role="menuitem">Billing</a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                        role="menuitem">Sign out</a>
                </form>
            </li>
        </ul>
    </div>
</div>
@endauth