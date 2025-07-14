<div class="min-h-screen flex flex-col justify-center items-center p-4 sm:p-6 lg:p-8 bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-200 dark:bg-blue-900/20 rounded-full blur-3xl opacity-30"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-200 dark:bg-purple-900/20 rounded-full blur-3xl opacity-30"></div>
    </div>

    <!-- Theme toggle and language switcher -->
    <div class="absolute top-2 right-2 sm:top-4 sm:right-4 z-10 flex items-center space-x-1 sm:space-x-2 p-1 sm:p-2">
        <x-language-switcher />
        <button onclick="toggleTheme()" class="p-1.5 sm:p-2 rounded-lg bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border border-gray-200 dark:border-gray-700 hover:bg-white dark:hover:bg-gray-800 transition-all duration-200 shadow-sm">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-600 dark:text-gray-400 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path>
            </svg>
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-600 dark:text-gray-400 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
        </button>
    </div>

    <div class="relative z-10">
        {{ $logo }}
    </div>

    <div class="w-full max-w-sm sm:max-w-md lg:max-w-lg mt-4 sm:mt-6 px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-10 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-xl overflow-hidden rounded-xl sm:rounded-2xl border border-white/20 dark:border-gray-700/50 relative z-10">
        {{ $slot }}
    </div>
</div>
