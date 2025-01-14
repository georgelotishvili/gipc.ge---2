<x-admin.layout>
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12 mt-4">
                    <!-- Users Stats -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-center">
                            <div class="p-4 rounded-full bg-blue-100">
                                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-6">
                                <h2 class="font-semibold text-gray-600 text-lg">მომხმარებლები</h2>
                                <p class="text-3xl font-bold text-gray-900">2,453</p>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-between">
                            <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200">დამატება</button>
                            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">დეტალურად</button>
                        </div>
                    </div>

                    <!-- Tests Stats -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-center">
                            <div class="p-4 rounded-full bg-emerald-100">
                                <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                </svg>
                            </div>
                            <div class="ml-6">
                                <h2 class="font-semibold text-gray-600 text-lg">ტესტები</h2>
                                <p class="text-3xl font-bold text-gray-900">156</p>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition-colors duration-200">ყველა</button>
                        </div>
                    </div>

                    <!-- Questions Stats -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-center">
                            <div class="p-4 rounded-full bg-violet-100">
                                <svg class="w-10 h-10 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-6">
                                <h2 class="font-semibold text-gray-600 text-lg">კითხვები</h2>
                                <p class="text-3xl font-bold text-gray-900">3,872</p>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end gap-2">
                            <button class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary transition-colors duration-200">
                                დამატება
                            </button>
                            <button class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg transition-colors duration-200">
                                ყველა
                            </button>
                        </div>
                    </div>

                    <!-- Average Score Stats -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-center">
                            <div class="p-4 rounded-full bg-amber-100">
                                <svg class="w-10 h-10 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            </div>
                            <div class="ml-6">
                                <h2 class="font-semibold text-gray-600 text-lg">საშუალო ქულა</h2>
                                <p class="text-3xl font-bold text-gray-900">76%</p>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200">სტატისტიკა</button>
                        </div>
                    </div>
                </div>
</x-admin.layout>
