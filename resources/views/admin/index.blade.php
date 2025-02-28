<x-admin.layout>
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 2xl:grid-cols-4 gap-4 sm:gap-5 lg:gap-6 mb-12 mt-4">
        <!-- Users Stats -->
        <div class="group bg-white dark:bg-dark-2/50 backdrop-blur-xl rounded-2xl p-5 sm:p-6 transition-all duration-500 shadow-[0_2px_8px_rgb(0,0,0,0.08)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] dark:border-dark-4/50 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 via-blue-400/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 group-hover:scale-110 transition-transform duration-500 shadow-sm">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-blue-500 dark:text-blue-400 transform group-hover:rotate-12 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">მომხმარებლები</p>
                    <p class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent group-hover:scale-110 transition-transform duration-500">{{$users}}</p>
                </div>
            </div>
            <div class="flex items-center justify-between gap-3">
                <button class="flex-1 px-3 sm:px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl hover:from-blue-700 hover:to-blue-600 transition-all duration-300 text-xs sm:text-sm font-medium shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5 focus:ring-2 focus:ring-blue-500/60 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-2">
                    დამატება
                </button>
                <button class="flex-1 px-3 sm:px-4 py-2.5 bg-gradient-to-r from-blue-600/10 to-blue-500/10 text-blue-700 dark:text-blue-300 rounded-xl hover:from-blue-600/20 hover:to-blue-500/20 transition-all duration-300 text-xs sm:text-sm font-medium hover:-translate-y-0.5 focus:ring-2 focus:ring-blue-500/60 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-2">
                    დეტალურად
                </button>
            </div>
        </div>

        <!-- Tests Stats -->
        <div class="group bg-white dark:bg-dark-2/50 backdrop-blur-xl rounded-2xl p-5 sm:p-6 transition-all duration-500 shadow-[0_2px_8px_rgb(0,0,0,0.08)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] dark:border-dark-4/50 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/10 via-emerald-400/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900/30 dark:to-emerald-800/30 group-hover:scale-110 transition-transform duration-500 shadow-sm">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-emerald-500 dark:text-emerald-400 transform group-hover:rotate-12 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">ტესტები</p>
                    <p class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-emerald-600 to-emerald-400 bg-clip-text text-transparent group-hover:scale-110 transition-transform duration-500">{{$tests}}</p>
                </div>
            </div>
            <div class="flex justify-end">
                <button class="px-6 py-2.5 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white rounded-xl hover:from-emerald-700 hover:to-emerald-600 transition-all duration-300 text-xs sm:text-sm font-medium shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-0.5 focus:ring-2 focus:ring-emerald-500/60 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-2">
                    ყველა
                </button>
            </div>
        </div>

        <!-- Questions Stats -->
        <div class="group bg-white dark:bg-dark-2/50 backdrop-blur-xl rounded-2xl p-5 sm:p-6 transition-all duration-500 shadow-[0_2px_8px_rgb(0,0,0,0.08)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] dark:border-dark-4/50 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-violet-500/10 via-violet-400/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-violet-50 to-violet-100 dark:from-violet-900/30 dark:to-violet-800/30 group-hover:scale-110 transition-transform duration-500 shadow-sm">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-violet-500 dark:text-violet-400 transform group-hover:rotate-12 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">კითხვები</p>
                    <p class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-violet-600 to-violet-400 bg-clip-text text-transparent group-hover:scale-110 transition-transform duration-500">{{$questions}}</p>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button class="px-4 py-2.5 bg-gradient-to-r from-violet-600 to-violet-500 text-white rounded-xl hover:from-violet-700 hover:to-violet-600 transition-all duration-300 text-xs sm:text-sm font-medium shadow-lg shadow-violet-500/30 hover:shadow-violet-500/50 hover:-translate-y-0.5 focus:ring-2 focus:ring-violet-500/60 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-2">
                    დამატება
                </button>
                <button class="px-4 py-2.5 bg-gradient-to-r from-violet-600/10 to-violet-500/10 text-violet-700 dark:text-violet-300 rounded-xl hover:from-violet-600/20 hover:to-violet-500/20 transition-all duration-300 text-xs sm:text-sm font-medium hover:-translate-y-0.5 focus:ring-2 focus:ring-violet-500/60 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-2">
                    ყველა
                </button>
            </div>
        </div>

        <!-- Average Score Stats -->
        <div class="group bg-white dark:bg-dark-2/50 backdrop-blur-xl rounded-2xl p-5 sm:p-6 transition-all duration-500 shadow-[0_2px_8px_rgb(0,0,0,0.08)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] dark:border-dark-4/50 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-amber-500/10 via-amber-400/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-br from-amber-50 to-amber-100 dark:from-amber-900/30 dark:to-amber-800/30 group-hover:scale-110 transition-transform duration-500 shadow-sm">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 text-amber-500 dark:text-amber-400 transform group-hover:rotate-12 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">საშუალო ქულა</p>
                    <p class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-amber-600 to-amber-400 bg-clip-text text-transparent group-hover:scale-110 transition-transform duration-500">{{number_format($average_score, 0)}}%</p>
                </div>
            </div>
            <div class="flex justify-end">
                <button class="px-6 py-2.5 bg-gradient-to-r from-amber-600 to-amber-500 text-white rounded-xl hover:from-amber-700 hover:to-amber-600 transition-all duration-300 text-xs sm:text-sm font-medium shadow-lg shadow-amber-500/30 hover:shadow-amber-500/50 hover:-translate-y-0.5 focus:ring-2 focus:ring-amber-500/60 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-2">
                    სტატისტიკა
                </button>
            </div>
        </div>
    </div>

    <livewire:admin-exam-requests />
</x-admin.layout>
