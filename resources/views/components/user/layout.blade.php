<x-layout>
    <div  class="flex min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 dark:bg-dark">

    <button @click="sidebarOpen = !sidebarOpen" class="absolute top-44 left-0 max-lg:block hidden text-primary-600" :class="{ 'right-2': sidebarOpen }">
        <svg :class="{ 'rotate-180': sidebarOpen }" class="w-12 h-12 text-gray-500 group-hover:text-primary-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>
        @auth
        <x-workspace-sidebar />
        @endauth
        <!-- Using the admin sidebar component -->
        
        <!-- Main Content -->
        <div class="flex-1 py-8 mt-16 dark:bg-dark">
            <div class="w-full px-4 sm:px-6 lg:px-12">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-layout>
