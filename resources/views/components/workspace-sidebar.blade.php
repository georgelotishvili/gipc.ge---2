<aside class="fixed left-0 top-20 z-40 h-[calc(100vh-5rem)] overflow-y-auto bg-white bg-gradient-to-b from-white to-gray-50 shadow-sm border-r border-gray-100 dark:bg-gradient-to-b dark:from-gray-900 dark:to-gray-950 dark:border-gray-800"
       :class="{ 
           '-translate-x-full lg:translate-x-0': !sidebarOpen,
           'w-64': sidebarOpen,
           'w-16': !sidebarOpen,
           'shadow-lg': sidebarOpen && window.innerWidth < 1024
       }" x-cloak>

    <!-- Navigation Menu -->
    <nav class="h-full flex flex-col justify-between">
        <!-- Expanded Menu -->
        <div x-show="sidebarOpen" class="py-6 px-4">
            <div class="space-y-1.5">
                <!-- Close button for small screens -->
                <button @click="sidebarOpen = false" 
                        class="lg:hidden mb-4 w-full flex items-center justify-between p-2.5 rounded-lg text-gray-700 font-medium hover:bg-white hover:shadow-sm dark:text-gray-300 dark:hover:bg-gray-800">
                    <span>დახურვა</span>
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <a href="{{ route('workspace') }}" 
                   class="group flex items-center rounded-lg p-2.5 text-gray-700 font-medium hover:bg-white hover:shadow-sm dark:text-gray-300 dark:hover:bg-gray-800 {{ Route::is('workspace') ? 'bg-white shadow-sm text-primary-600 dark:bg-gray-800 dark:text-primary-400 dark:shadow-none' : '' }}">
                    <div class="flex items-center justify-center h-8 w-8 {{ Route::is('workspace') ? 'text-primary-600 bg-primary-50 dark:bg-gray-700 dark:text-primary-400' : 'text-gray-500 bg-gray-100 group-hover:text-primary-600 group-hover:bg-primary-50 dark:bg-gray-700 dark:text-gray-400 dark:group-hover:text-primary-400' }} rounded-md transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <span class="ml-3">მთავარი</span>
                </a>

                <a href="" 
                   class="group flex items-center rounded-lg p-2.5 text-gray-700 font-medium hover:bg-white hover:shadow-sm dark:text-gray-300 dark:hover:bg-gray-800 {{ Route::is('admin.questions') ? 'bg-white shadow-sm text-primary-600 dark:bg-gray-800 dark:text-primary-400 dark:shadow-none' : '' }}">
                    <div class="flex items-center justify-center h-8 w-8 {{ Route::is('admin.questions') ? 'text-primary-600 bg-primary-50 dark:bg-gray-700 dark:text-primary-400' : 'text-gray-500 bg-gray-100 group-hover:text-primary-600 group-hover:bg-primary-50 dark:bg-gray-700 dark:text-gray-400 dark:group-hover:text-primary-400' }} rounded-md transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <span class="ml-3">წინასაგამოცდო ტესტირება</span>
                </a>

                <a href="{{ route('test_results') }}" 
                   class="group flex items-center rounded-lg p-2.5 text-gray-700 font-medium hover:bg-white hover:shadow-sm dark:text-gray-300 dark:hover:bg-gray-800 {{ Route::is('test_results') ? 'bg-white shadow-sm text-primary-600 dark:bg-gray-800 dark:text-primary-400 dark:shadow-none' : '' }}">
                    <div class="flex items-center justify-center h-8 w-8 {{ Route::is('test_results') ? 'text-primary-600 bg-primary-50 dark:bg-gray-700 dark:text-primary-400' : 'text-gray-500 bg-gray-100 group-hover:text-primary-600 group-hover:bg-primary-50 dark:bg-gray-700 dark:text-gray-400 dark:group-hover:text-primary-400' }} rounded-md transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <span class="ml-3">ტესტების შედეგები</span>
                </a>

                <a href="{{ route('tutorials') }}" 
                   class="group flex items-center rounded-lg p-2.5 text-gray-700 font-medium hover:bg-white hover:shadow-sm dark:text-gray-300 dark:hover:bg-gray-800 {{ Route::is('tutorials') ? 'bg-white shadow-sm text-primary-600 dark:bg-gray-800 dark:text-primary-400 dark:shadow-none' : '' }}">
                    <div class="flex items-center justify-center h-8 w-8 {{ Route::is('tutorials') ? 'text-primary-600 bg-primary-50 dark:bg-gray-700 dark:text-primary-400' : 'text-gray-500 bg-gray-100 group-hover:text-primary-600 group-hover:bg-primary-50 dark:bg-gray-700 dark:text-gray-400 dark:group-hover:text-primary-400' }} rounded-md transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="ml-3">ვიდეო გაკვეთილები</span>
                </a>

                <a href="{{ route('workspace') }}" 
                   class="group flex items-center rounded-lg p-2.5 text-gray-700 font-medium hover:bg-white hover:shadow-sm dark:text-gray-300 dark:hover:bg-gray-800 {{ Route::is('admin.index') ? 'bg-white shadow-sm text-primary-600 dark:bg-gray-800 dark:text-primary-400 dark:shadow-none' : '' }}">
                    <div class="flex items-center justify-center h-8 w-8 {{ Route::is('admin.index') ? 'text-primary-600 bg-primary-50 dark:bg-gray-700 dark:text-primary-400' : 'text-gray-500 bg-gray-100 group-hover:text-primary-600 group-hover:bg-primary-50 dark:bg-gray-700 dark:text-gray-400 dark:group-hover:text-primary-400' }} rounded-md transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="ml-3">პარამეტრები</span>
                </a>
            </div>
        </div>

        <!-- Collapsed Menu - Refined Icons -->
        <div x-show="!sidebarOpen" class="py-6 px-3 space-y-3">
            <a href="{{ route('workspace') }}" 
               class="flex justify-center items-center {{ Route::is('workspace') ? 'bg-primary-50 text-primary-600 dark:bg-gray-800 dark:text-primary-400' : 'text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800' }} h-10 w-10 rounded-lg">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </a>

            <a href="" 
               class="flex justify-center items-center {{ Route::is('admin.questions') ? 'bg-primary-50 text-primary-600 dark:bg-gray-800 dark:text-primary-400' : 'text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800' }} h-10 w-10 rounded-lg">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </a>

            <a href="{{ route('test_results') }}" 
               class="flex justify-center items-center {{ Route::is('test_results') ? 'bg-primary-50 text-primary-600 dark:bg-gray-800 dark:text-primary-400' : 'text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800' }} h-10 w-10 rounded-lg">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </a>

            <a href="{{ route('tutorials') }}" 
               class="flex justify-center items-center {{ Route::is('tutorials') ? 'bg-primary-50 text-primary-600 dark:bg-gray-800 dark:text-primary-400' : 'text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800' }} h-10 w-10 rounded-lg">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                </svg>
            </a>

            <a href="{{ route('workspace') }}" 
               class="flex justify-center items-center {{ Route::is('admin.index') ? 'bg-primary-50 text-primary-600 dark:bg-gray-800 dark:text-primary-400' : 'text-gray-500 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800' }} h-10 w-10 rounded-lg">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </a>
        </div>

        <!-- Toggle Button - Elegant Design -->
        <div class="p-4 border-t border-gray-100 dark:border-gray-800 bg-gradient-to-r from-gray-50 to-white dark:from-gray-900 dark:to-gray-900">
            <button 
                @click="sidebarOpen = !sidebarOpen"
                class="w-full flex items-center justify-center p-2 rounded-lg text-gray-500 hover:bg-white hover:shadow-sm dark:text-gray-400 dark:hover:bg-gray-800">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h10M4 18h6" x-show="sidebarOpen"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" x-show="!sidebarOpen"></path>
                </svg>
                <span class="ml-3 font-medium" x-show="sidebarOpen">დახურვა</span>
            </button>
        </div>
    </nav>
</aside>

<!-- Simple mobile overlay -->
<div 
    x-show="sidebarOpen" 
    @click="sidebarOpen = false" 
    class="fixed inset-0 z-30 bg-gray-900 bg-opacity-50 backdrop-blur-sm lg:hidden transition-opacity duration-300"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    x-cloak></div>

<!-- Mobile menu button (visible when sidebar is closed) -->
<button 
    @click="sidebarOpen = true" 
    class="fixed left-4 bottom-4 z-30 lg:hidden p-3 rounded-full bg-primary-600 text-white shadow-lg shadow-primary-600/20 hover:bg-primary-700 transition-colors"
    x-show="!sidebarOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-4"
    x-cloak>
    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
    </svg>
</button>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>