<header class="sticky top-0 z-50 flex bg-white drop-shadow-1 dark:bg-dark-2 dark:drop-shadow-none">
    <div class="flex flex-grow items-center justify-between px-3 py-4 shadow-2 sm:px-4 md:px-6 2xl:px-11">
        <div class="flex items-center gap-2 sm:gap-4">
            <!-- Sidebar Toggle -->
            <button @click="toggleSidebar"
                    class="flex h-9 w-9 items-center justify-center rounded-xl hover:bg-gray-100 dark:hover:bg-dark-4 transition-colors">
                <svg class="text-gray-500 dark:text-white" x-show="!sidebarOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg class="text-gray-500 dark:text-white" x-show="sidebarOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Search -->
            <div class="relative hidden sm:block">
                <input type="text"
                       placeholder="Type to search..."
                       @focus="searchOpen = true"
                       @keydown.window.escape="searchOpen = false"
                       @keydown.window.cmd.k.prevent="$refs.searchInput?.focus()"
                       x-ref="searchInput"
                       class="w-[200px] md:w-[250px] lg:w-[400px] rounded-xl border border-gray-300 bg-transparent py-2 pl-10 pr-4 text-sm outline-none focus:border-primary focus-visible:shadow-none dark:border-dark-4 dark:bg-dark-2 dark:text-dark-6">
                <span class="absolute left-3 top-1/2 -translate-y-1/2">
                    <svg class="fill-gray-500 h-[18px] w-[18px] dark:fill-dark-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                    </svg>
                </span>
                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-sm text-gray-400 dark:text-dark-6">⌘K</span>
            </div>
        </div>

        <div class="flex items-center gap-2 sm:gap-3 2xsm:gap-7">
            <ul class="flex items-center gap-2 2xsm:gap-4">
                <!-- Theme Toggle -->
                <li>
                    <button @click="toggleDarkMode"
                            class="flex h-9 w-9 items-center justify-center rounded-xl border-[0.5px] border-gray-300 hover:bg-gray-100 dark:border-dark-4 dark:bg-dark-2 dark:text-dark-6 dark:hover:bg-dark-4 transition-colors">
                        <svg x-show="!darkMode" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"/>
                        </svg>
                        <svg x-show="darkMode" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>
                </li>

                <!-- Notifications -->
                <li>
                    <button class="relative flex h-9 w-9 items-center justify-center rounded-xl border-[0.5px] border-gray-300 hover:bg-gray-100 dark:border-dark-4 dark:bg-dark-2 dark:text-dark-6 dark:hover:bg-dark-4 transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute -right-0.5 -top-0.5 flex h-4 w-4 items-center justify-center rounded-full bg-red-600 text-[8px] font-medium text-white">
                            4
                        </span>
                    </button>
                </li>
            </ul>

            <!-- User Menu -->
            <div x-data="{ dropdownOpen: false }" class="relative">
                <button @click="dropdownOpen = !dropdownOpen" 
                        class="flex items-center gap-2 sm:gap-4">
                    <span class="h-9 w-9 sm:h-10 sm:w-10 rounded-xl">
                        <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?w=100&h=100&fit=crop"
                             alt="User"
                             class="rounded-xl object-cover object-center">
                    </span>
                    <span class="hidden text-right lg:block">
                        <span class="block text-sm font-medium text-black dark:text-white">John Doe</span>
                        <span class="block text-xs text-gray-500 dark:text-dark-6">Admin</span>
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
                     class="absolute right-0 mt-4 flex w-62.5 flex-col rounded-xl border border-gray-200/50 bg-white shadow-lg dark:border-dark-4 dark:bg-dark-2">
                    <ul class="flex flex-col gap-4 px-6 py-5 dark:border-dark-4">
                        <li>
                            <a href="#"
                               class="flex items-center gap-3.5 text-sm font-medium text-gray-700 duration-300 ease-in-out hover:text-primary dark:text-dark-6 dark:hover:text-primary">
                                <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22">
                                    <path d="M11 9.62499C8.42188 9.62499 6.35938 7.59687 6.35938 5.12187C6.35938 2.64687 8.42188 0.618744 11 0.618744C13.5781 0.618744 15.6406 2.64687 15.6406 5.12187C15.6406 7.59687 13.5781 9.62499 11 9.62499ZM11 2.16562C9.28125 2.16562 7.90625 3.50624 7.90625 5.12187C7.90625 6.73749 9.28125 8.07812 11 8.07812C12.7188 8.07812 14.0938 6.73749 14.0938 5.12187C14.0938 3.50624 12.7188 2.16562 11 2.16562Z"/>
                                    <path d="M17.7719 21.4156H4.2281C3.5406 21.4156 2.9906 20.8656 2.9906 20.1781V17.0844C2.9906 13.7156 5.7406 10.9656 9.1094 10.9656H12.925C16.2937 10.9656 19.0437 13.7156 19.0437 17.0844V20.1781C19.0094 20.8312 18.4594 21.4156 17.7719 21.4156ZM4.53748 19.8687H17.4969V17.0844C17.4969 14.575 15.4344 12.5125 12.925 12.5125H9.07498C6.5656 12.5125 4.5031 14.575 4.5031 17.0844V19.8687H4.53748Z"/>
                                </svg>
                                My Profile
                            </a>
                        </li>
                        <li>
                            <a href="#"
                               class="flex items-center gap-3.5 text-sm font-medium text-gray-700 duration-300 ease-in-out hover:text-primary dark:text-dark-6 dark:hover:text-primary">
                                <svg class="fill-current" width="22" height="22" viewBox="0 0 22 22">
                                    <path d="M17.6687 1.44374C17.1187 0.893744 16.4312 0.618744 15.675 0.618744H7.42498C6.25623 0.618744 5.25935 1.58124 5.25935 2.78437V4.12499H4.29685C3.88435 4.12499 3.50623 4.46874 3.50623 4.91562C3.50623 5.36249 3.84998 5.70624 4.29685 5.70624H5.25935V10.2781H4.29685C3.88435 10.2781 3.50623 10.6219 3.50623 11.0687C3.50623 11.4812 3.84998 11.8594 4.29685 11.8594H5.25935V16.4312H4.29685C3.88435 16.4312 3.50623 16.775 3.50623 17.2219C3.50623 17.6687 3.84998 18.0125 4.29685 18.0125H5.25935V19.25C5.25935 20.4187 6.22185 21.4156 7.42498 21.4156H15.675C17.2218 21.4156 18.4937 20.1437 18.5281 18.5969V3.47187C18.4937 2.68124 18.2187 1.95937 17.6687 1.44374Z"/>
                                </svg>
                                Log Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header> 