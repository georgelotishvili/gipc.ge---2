<x-admin.layout>
    <div class="bg-white dark:bg-dark-2 rounded-2xl shadow-lg p-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">მომხმარებლები</h2>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
            @foreach($users as $user)
                <div class="group bg-white dark:bg-dark-2/50 backdrop-blur-xl rounded-2xl p-5 sm:p-6 transition-all duration-500 
                            shadow-[0_4px_12px_rgb(0,0,0,0.1)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.12)] 
                            dark:shadow-[0_4px_12px_rgb(0,0,0,0.2)] dark:hover:shadow-[0_8px_30px_rgb(0,0,0,0.3)]
                            relative overflow-hidden border border-gray-100/20 dark:border-white/[0.05]">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 via-blue-400/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <div class="absolute inset-0 bg-gradient-to-b from-white/50 to-transparent dark:from-white/[0.02] pointer-events-none"></div>
                    
                    <div class="flex items-center justify-between mb-6 relative">
                        <div class="flex items-center">
                            <div class="p-3 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 group-hover:scale-110 transition-transform duration-500 shadow-sm">
                                <span class="text-2xl font-bold text-blue-500 dark:text-blue-400 transform group-hover:rotate-12 transition-transform duration-500">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs font-medium text-gray-400 dark:text-gray-500 mb-1">ID: #{{ $user->id }}</p>
                            <p class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent group-hover:scale-110 transition-transform duration-500">
                                {{ $user->name }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-6 relative">
                        <p class="text-base text-gray-600 dark:text-gray-300 font-medium">{{ $user->email }}</p>
                        <div class="flex items-center mt-2">
                            <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $user->created_at ? $user->created_at->format('d.m.Y') : 'N/A' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-3 relative">
                        <button class="flex-1 px-3 sm:px-4 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl hover:from-blue-700 hover:to-blue-600 transition-all duration-300 text-xs sm:text-sm font-medium shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5 focus:ring-2 focus:ring-blue-500/60 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-2">
                            რედაქტირება
                        </button>
                        <button class="flex-1 px-3 sm:px-4 py-2.5 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-xl hover:from-red-700 hover:to-red-600 transition-all duration-300 text-xs sm:text-sm font-medium shadow-lg shadow-red-500/30 hover:shadow-red-500/50 hover:-translate-y-0.5 focus:ring-2 focus:ring-red-500/60 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-2">
                            წაშლა
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $users->links() }}
        </div>
    </div>
</x-admin.layout>
