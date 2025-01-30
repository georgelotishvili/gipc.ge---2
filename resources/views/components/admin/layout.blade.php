<x-layout>
    <div class="flex min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg mt-12">
            <div class="flex flex-col h-full">
                <!-- Logo/Header -->
                <div class="p-6 border-b mt-12">
                    <h2 class="text-2xl font-bold text-gray-800">ადმინისტრაცია</h2>
                </div>

                <!-- Navigation Links -->
                <nav>
                    <div class="space-y-2">
                        <a href="{{route('admin.index')}}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition-colors duration-200 group">
                            <svg class="w-6 h-6 text-gray-500 group-hover:text-blue-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span class="ml-3 font-medium">მთავარი</span>
                        </a>

                        <a href="{{route('admin.questions')}}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition-colors duration-200 group">
                            <svg class="w-6 h-6 text-gray-500 group-hover:text-blue-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                            <span class="ml-3 font-medium">ტესტები</span>
                        </a>

                        <a href="{{route('admin.codes')}}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition-colors duration-200 group">
                            <svg class="w-6 h-6 text-gray-500 group-hover:text-blue-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <span class="ml-3 font-medium">დადგენილებები</span>
                        </a>

                        <a href="{{route('admin.videos')}}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition-colors duration-200 group">
                            <svg class="w-6 h-6 text-gray-500 group-hover:text-blue-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <span class="ml-3 font-medium">ვიდეო გაკვეთილები</span>
                        </a>

                        <a href="{{route('admin.users')}}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition-colors duration-200 group">
                            <svg class="w-6 h-6 text-gray-500 group-hover:text-blue-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            <span class="ml-3 font-medium">მომხმარებლები</span>
                        </a>

                        <a href="{{route('admin.index')}}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 rounded-lg transition-colors duration-200 group">
                            <svg class="w-6 h-6 text-gray-500 group-hover:text-blue-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="ml-3 font-medium">პარამეტრები</span>
                        </a>
                    </div>
                </nav>

                <!-- User Profile -->
                <div class="p-4 border-t">
                    <a href="{{ route('profile.show') }}" class="flex items-center space-x-3 hover:bg-gray-50 rounded-lg p-2 transition-colors duration-200">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">ადმინისტრატორი</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="flex-1 py-8 mt-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{ $slot }}
        </div>
    </div>
</div>
</x-layout>
