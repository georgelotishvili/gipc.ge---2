<x-layout>
    <div  class="flex min-h-screen">
        @auth
        <x-workspace-sidebar />
        @endauth
        <!-- Using the admin sidebar component -->
        
        <!-- Main Content -->
        <div class="flex-1 py-8 dark:bg-dark">
            <div class="w-full px-4 sm:px-6 lg:px-12">
                {{ $slot }}
            </div>
        </div>
    </div>
</x-layout>
