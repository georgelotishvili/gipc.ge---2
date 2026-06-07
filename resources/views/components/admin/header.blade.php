<header class="sticky top-0 z-40 border-b border-gray-200 bg-white/95 backdrop-blur dark:border-slate-700 dark:bg-slate-900/95">
    <div class="flex h-20 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
        <div class="flex min-w-0 flex-1 items-center gap-3">
            <!-- Sidebar Toggle -->
            <button @click="toggleSidebar"
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-md border border-gray-200 text-gray-500 transition-colors hover:bg-gray-100 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">
                <svg x-show="!sidebarOpen" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="sidebarOpen" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Search -->
            <div class="relative hidden w-full max-w-md sm:block">
                <input type="text"
                       placeholder="Type to search..."
                       @focus="searchOpen = true"
                       @keydown.window.escape="searchOpen = false"
                       @keydown.window.cmd.k.prevent="$refs.searchInput?.focus()"
                       x-ref="searchInput"
                       class="h-11 w-full rounded-md border border-gray-300 bg-white py-2 pl-10 pr-12 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100">
                <span class="absolute left-3 top-1/2 -translate-y-1/2">
                    <svg class="fill-gray-500 h-[18px] w-[18px] dark:fill-dark-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                    </svg>
                </span>
                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-sm text-gray-400 dark:text-dark-6">⌘K</span>
            </div>
        </div>

        <div class="flex shrink-0 items-center gap-3">
            <ul class="flex items-center gap-2 2xsm:gap-4">
                <!-- Theme Toggle -->
                <li>
                    <button @click="toggleDarkMode"
                            class="flex h-10 w-10 items-center justify-center rounded-md border border-gray-300 text-gray-600 transition-colors hover:bg-gray-100 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
                        <svg x-show="!darkMode" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/>
                        </svg>
                        <svg x-show="darkMode" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>
                </li>

                <!-- Notifications -->
                {{-- <li>
                    <button class="relative flex h-9 w-9 items-center justify-center rounded-md border-[0.5px] border-gray-300 hover:bg-gray-100 dark:border-dark-4 dark:bg-dark-2 dark:text-dark-6 dark:hover:bg-dark-4 transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute -right-0.5 -top-0.5 flex h-4 w-4 items-center justify-center rounded-md bg-red-600 text-[8px] font-medium text-white">
                            4
                        </span>
                    </button>
                </li> --}}
            </ul>

            <!-- User Menu -->
            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = !dropdownOpen" 
                        class="flex max-w-[260px] items-center gap-3 rounded-md px-2 py-1.5 transition-colors hover:bg-gray-100 dark:hover:bg-slate-800">
                    <x-user-avatar :user="Auth::user()" class="h-10 w-10" icon-class="h-5 w-5" />
                    <span class="hidden min-w-0 text-right lg:block">
                        <span class="block truncate text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                        <span class="block text-xs text-gray-500 dark:text-slate-400">Admin</span>
                    </span>
                    <svg :class="dropdownOpen && 'rotate-180'" class="hidden fill-current sm:block transition-transform duration-200" width="12" height="8" viewBox="0 0 12 8">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.410765 0.910734C0.736202 0.585297 1.26384 0.585297 1.58928 0.910734L6.00002 5.32148L10.4108 0.910734C10.7362 0.585297 11.2638 0.585297 11.5893 0.910734C11.9147 1.23617 11.9147 1.76381 11.5893 2.08924L6.58928 7.08924C6.26384 7.41468 5.7362 7.41468 5.41077 7.08924L0.410765 2.08924C0.0853277 1.76381 0.0853277 1.23617 0.410765 0.910734Z"/>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="dropdownOpen"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     @click.outside="dropdownOpen = false"
                     class="absolute right-0 mt-3 flex w-64 flex-col rounded-md border border-gray-200 bg-white shadow-xl dark:border-slate-700 dark:bg-slate-900">
                    <ul class="flex flex-col gap-1 p-2">
                        <li>
                            <a href="{{ route('profile.show') }}"
                               class="flex items-center gap-3 rounded-md px-3 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50 hover:text-blue-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-blue-400">
                                <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22">
                                    <path d="M11 9.62499C8.42188 9.62499 6.35938 7.59687 6.35938 5.12187C6.35938 2.64687 8.42188 0.618744 11 0.618744C13.5781 0.618744 15.6406 2.64687 15.6406 5.12187C15.6406 7.59687 13.5781 9.62499 11 9.62499ZM11 2.16562C9.28125 2.16562 7.90625 3.50624 7.90625 5.12187C7.90625 6.73749 9.28125 8.07812 11 8.07812C12.7188 8.07812 14.0938 6.73749 14.0938 5.12187C14.0938 3.50624 12.7188 2.16562 11 2.16562Z"/>
                                    <path d="M17.7719 21.4156H4.2281C3.5406 21.4156 2.9906 20.8656 2.9906 20.1781V17.0844C2.9906 13.7156 5.7406 10.9656 9.1094 10.9656H12.925C16.2937 10.9656 19.0437 13.7156 19.0437 17.0844V20.1781C19.0094 20.8312 18.4594 21.4156 17.7719 21.4156ZM4.53748 19.8687H17.4969V17.0844C17.4969 14.575 15.4344 12.5125 12.925 12.5125H9.07498C6.5656 12.5125 4.5031 14.575 4.5031 17.0844V19.8687H4.53748Z"/>
                                </svg>
                                პროფილი
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-left text-sm font-medium text-red-600 transition hover:bg-red-50 dark:hover:bg-red-950/30">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                                    </svg>
                                    გასვლა
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header> 
