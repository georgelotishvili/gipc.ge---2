<aside class="fixed left-0 top-0 z-50 flex h-screen flex-col overflow-y-hidden bg-white ease-linear dark:bg-dark-2"
       :class="{ 
           '-translate-x-full lg:translate-x-0': !sidebarOpen,
           'w-[260px]': sidebarOpen,
           'w-[80px]': !sidebarOpen
       }" x-cloak>
    
    <!-- Logo -->
    <div class="flex h-20 items-center justify-center border-b -mt-2 border-gray-200 dark:border-dark-4">
        <template x-if="sidebarOpen">
            <x-application-logo/>
        </template>
        <template x-if="!sidebarOpen">image.png
            <x-admin.sidebar-logo/>
        </template>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto overflow-x-hidden py-4" x-data="{ active: 'dashboard' }">
        <!-- Menu Group -->
        <div class="mb-6">
            <h3 x-show="sidebarOpen" class="mb-4 ml-4 text-sm font-medium text-gray-500 dark:text-dark-6">MENU</h3>
            <ul class="mb-6 flex flex-col gap-1.5" :class="{ 'items-center': !sidebarOpen }">
                <li>
                    <a href="{{ route('admin.index') }}" wire:navigate
                       class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium duration-100 ease-in-out hover:bg-primary/[0.08] dark:hover:bg-primary/[0.03]
                       {{ Route::is('admin.index') ? 'text-primary-600 bg-primary/[0.08] dark:bg-primary/[0.03] border-r-4 border-primary-600' : 'text-gray-700 dark:text-dark-6' }}">
                               <svg class="w-6 h-6 text-gray-500 group-hover:text-primary-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        <span :class="{ 'opacity-0 hidden': !sidebarOpen }">მთავარი</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.questions') }}" wire:navigate
                       class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium duration-100 ease-in-out hover:bg-primary/[0.08] dark:hover:bg-primary/[0.03]
                       {{ Route::is('admin.questions') ? 'text-primary-600 bg-primary/[0.08] dark:bg-primary/[0.03] border-r-4 border-primary-600' : 'text-gray-700 dark:text-dark-6' }}">
                               <svg class="w-6 h-6 text-gray-500 group-hover:text-primary-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        <span :class="{ 'opacity-0 hidden': !sidebarOpen }">ტესტები</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.codes') }}" wire:navigate
                       class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium duration-100 ease-in-out hover:bg-primary/[0.08] dark:hover:bg-primary/[0.03]
                       {{ Route::is('admin.codes') ? 'text-primary-600 bg-primary/[0.08] dark:bg-primary/[0.03] border-r-4 border-primary-600' : 'text-gray-700 dark:text-dark-6' }}">
                               <svg class="w-6 h-6 text-gray-500 group-hover:text-primary-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        <span :class="{ 'opacity-0 hidden': !sidebarOpen }">დადგენილებები</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.regulations.regulations') }}" wire:navigate
                       class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium duration-100 ease-in-out hover:bg-primary/[0.08] dark:hover:bg-primary/[0.03]
                       {{ Route::is('admin.regulations.regulations') ? 'text-primary-600 bg-primary/[0.08] dark:bg-primary/[0.03] border-r-4 border-primary-600' : 'text-gray-700 dark:text-dark-6' }}">
                               <svg class="w-6 h-6 text-gray-500 group-hover:text-primary-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        <span :class="{ 'opacity-0 hidden': !sidebarOpen }">რეგულაციები</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.courses') }}" wire:navigate
                       class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium duration-100 ease-in-out hover:bg-primary/[0.08] dark:hover:bg-primary/[0.03]
                       {{ Route::is('admin.courses') ? 'text-primary-600 bg-primary/[0.08] dark:bg-primary/[0.03] border-r-4 border-primary-600' : 'text-gray-700 dark:text-dark-6' }}">
                               <svg class="w-6 h-6 text-gray-500 group-hover:text-primary-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        <span :class="{ 'opacity-0 hidden': !sidebarOpen }">ვიდეო გაკვეთილები</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" wire:navigate
                       class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium duration-100 ease-in-out hover:bg-primary/[0.08] dark:hover:bg-primary/[0.03]
                       {{ Route::is('admin.users') ? 'text-primary-600 bg-primary/[0.08] dark:bg-primary/[0.03] border-r-4 border-primary-600' : 'text-gray-700 dark:text-dark-6' }}">
                                <svg class="w-6 h-6 text-gray-500 group-hover:text-primary-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        <span :class="{ 'opacity-0 hidden': !sidebarOpen }">მომხმარებლები</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.commercials') }}" wire:navigate
                       class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium duration-100 ease-in-out hover:bg-primary/[0.08] dark:hover:bg-primary/[0.03]
                       {{ Route::is('admin.commercials') ? 'text-primary-600 bg-primary/[0.08] dark:bg-primary/[0.03] border-r-4 border-primary-600' : 'text-gray-700 dark:text-dark-6' }}">
                                <svg class="w-6 h-6 text-gray-500 group-hover:text-primary-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>
                        <span :class="{ 'opacity-0 hidden': !sidebarOpen }">რეკლამები</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.plans') }}" wire:navigate
                       class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium duration-100 ease-in-out hover:bg-primary/[0.08] dark:hover:bg-primary/[0.03]
                       {{ Route::is('admin.pricing') ? 'text-primary-600 bg-primary/[0.08] dark:bg-primary/[0.03] border-r-4 border-primary-600' : 'text-gray-700 dark:text-dark-6' }}">
                       <svg class="w-6 h-6 text-gray-500 group-hover:text-primary-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M3 11l10 10 8-8-10-10H5a2 2 0 00-2 2v4z" />
                      </svg>
                                 
                        <span :class="{ 'opacity-0 hidden': !sidebarOpen }">ფასები</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.settings') }}" wire:navigate
                       class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium duration-100 ease-in-out hover:bg-primary/[0.08] dark:hover:bg-primary/[0.03]
                       {{ Route::is('admin.settings') ? 'text-primary-600 bg-primary/[0.08] dark:bg-primary/[0.03] border-r-4 border-primary-600' : 'text-gray-700 dark:text-dark-6' }}">
                               <svg class="w-6 h-6 text-gray-500 group-hover:text-primary-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        <span :class="{ 'opacity-0 hidden': !sidebarOpen }">პარამეტრები</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</aside> 

<style>
    [x-cloak] {
        display: none !important;
    }
</style>