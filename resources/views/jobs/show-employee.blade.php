<x-layout>
    <!-- Full Screen Container -->
    <div class="min-h-screen relative overflow-hidden">
        <!-- Floating Header -->
        <div class="relative z-10 pt-8 pb-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500 rounded-md mb-6 shadow-2xl transform hover:scale-105 transition-all duration-300">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                        პროფესიონალური პროფილი
                    </h1>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        დეტალური ინფორმაცია კანდიდატის შესახებ
                    </p>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800/30 text-green-800 dark:text-green-200 px-6 py-4 rounded-md backdrop-blur-sm shadow-lg">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-lg font-semibold">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content Container -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="bg-gradient-to-br from-blue-50/50 via-purple-50/50 to-indigo-50/50 dark:from-blue-900/20 dark:via-purple-900/20 dark:to-indigo-900/20 rounded-md p-8 border border-blue-100/50 dark:border-blue-800/30 backdrop-blur-sm">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500 rounded-md flex items-center justify-center mr-4 shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">პროფესიონალური რეზიუმე</h3>
                        <p class="text-gray-600 dark:text-gray-400">კანდიდატის ბარათი</p>
                    </div>
                </div>
                
                <!-- Employee Card - Exact same structure as preview -->
                <div class="bg-white dark:bg-gray-800 rounded-md shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <!-- Card Header with Image -->
                    <div class="relative h-48 sm:h-56 md:h-64 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500">
                        <div class="absolute inset-0 bg-gradient-to-br from-black/10 to-black/30"></div>
                        <div class="absolute bottom-4 left-4 right-4 sm:bottom-6 sm:left-6 sm:right-6">
                            <div class="flex flex-col md:flex-row items-center md:items-end md:space-y-0 md:space-x-6 text-center md:text-left pt-4 md:pt-0">
                                <!-- Profile Image -->
                                <div class="relative flex-shrink-0">
                                    @if($employee->image)
                                        <div class="w-28 h-28 sm:w-32 sm:h-32 md:w-48 md:h-48 bg-white dark:bg-gray-700 rounded-md border-4 border-white dark:border-gray-600 shadow-2xl overflow-hidden ring-4 ring-white/20 dark:ring-gray-600/20">
                                            <img src="{{ asset('storage/' . $employee->image->path) }}" 
                                                 alt="{{ $employee->name }}" 
                                                 class="w-full h-full object-cover object-center">
                                        </div>
                                    @else
                                        <div class="w-28 h-28 sm:w-32 sm:h-32 md:w-48 md:h-48 bg-white dark:bg-gray-700 rounded-md border-4 border-white dark:border-gray-600 shadow-2xl flex items-center justify-center ring-4 ring-white/20 dark:ring-gray-600/20">
                                            <svg class="w-10 h-10 sm:w-14 sm:h-14 md:w-20 md:h-20 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <!-- Name and Position -->
                                <div class="flex-1 text-white">
                                    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold mb-1 sm:mb-2 tracking-tight leading-tight break-words">{{ $employee->name }}</h2>
                                    <p class="text-base sm:text-lg md:text-xl opacity-95 font-medium leading-tight break-words">{{ $employee->position }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Content -->
                    <div class="p-8 space-y-8">
                        <!-- Contact Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                            <div class="flex items-center space-x-3 sm:space-x-4">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-100 dark:bg-blue-900/30 rounded-md flex items-center justify-center shadow-sm">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400">ელ-ფოსტა</p>
                                    <a href="mailto:{{ $employee->email }}" class="font-semibold text-gray-900 dark:text-white text-sm sm:text-base break-words hover:text-blue-600 dark:hover:text-blue-400 transition-colors">{{ $employee->email }}</a>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3 sm:space-x-4">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-green-100 dark:bg-green-900/30 rounded-md flex items-center justify-center shadow-sm">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400">ტელეფონი</p>
                                    @if($employee->phone)
                                        <a href="tel:{{ $employee->phone }}" class="font-semibold text-gray-900 dark:text-white text-sm sm:text-base break-words hover:text-green-600 dark:hover:text-green-400 transition-colors">{{ $employee->phone }}</a>
                                    @else
                                        <p class="font-semibold text-gray-900 dark:text-white text-sm sm:text-base break-words">არ არის მითითებული</p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3 sm:space-x-4">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-purple-100 dark:bg-purple-900/30 rounded-md flex items-center justify-center shadow-sm">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400">ქალაქი</p>
                                    <p class="font-semibold text-gray-900 dark:text-white text-sm sm:text-base break-words">{{ $employee->city ?? 'არ არის მითითებული' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3 sm:space-x-4">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-md flex items-center justify-center shadow-sm">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400">სამუშაო დრო</p>
                                    <p class="font-semibold text-gray-900 dark:text-white text-sm sm:text-base break-words">{{ $employee->worktime->label() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Skills -->
                        <div class="mt-4 sm:mt-6">
                            <h4 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white mb-2 sm:mb-3 flex items-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                უნარები
                            </h4>
                            <div class="flex flex-wrap gap-1.5 sm:gap-2">
                                @foreach(explode(',', $employee->skills) as $skill)
                                    <span class="px-2 py-1 sm:px-3 sm:py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-md text-xs sm:text-sm font-medium">{{ trim($skill) }}</span>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Description -->
                        <div class="mt-4 sm:mt-6">
                            <h4 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white mb-2 sm:mb-3 flex items-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                გამოცდილება
                            </h4>
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-sm sm:text-base">
                                {!! nl2br(e($employee->description)) !!}
                            </p>
                        </div>
                        
                        <!-- Salary -->
                        @if($employee->salary)
                        <div class="flex items-center space-x-2 sm:space-x-3">
                            <div class="w-6 h-6 sm:w-8 sm:h-8 bg-green-100 dark:bg-green-900/30 rounded-md flex items-center justify-center">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">სასურველი ხელფასი</p>
                                <p class="font-medium text-gray-900 dark:text-white text-sm sm:text-base break-words">{{ number_format($employee->salary) }} ₾</p>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Additional Contact Info -->
                        @if($employee->website || $employee->social)
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700/50">
                            @if($employee->website)
                            <div class="flex items-center space-x-3 sm:space-x-4 mb-4">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-purple-100 dark:bg-purple-900/30 rounded-md flex items-center justify-center shadow-sm">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400">ვებსაიტი</p>
                                    <a href="{{ $employee->website }}" target="_blank" class="font-semibold text-gray-900 dark:text-white text-sm sm:text-base break-words hover:text-purple-600 dark:hover:text-purple-400 transition-colors">{{ $employee->website }}</a>
                                </div>
                            </div>
                            @endif
                            
                            @if($employee->social)
                            <div class="flex items-start space-x-3 sm:space-x-4">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-md flex items-center justify-center shadow-sm flex-shrink-0">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h4a1 1 0 011 1v2m4 0V2a1 1 0 011-1h1a2 2 0 012 2v16a2 2 0 01-2 2H5a2 2 0 01-2-2V3a2 2 0 012-2h1a1 1 0 011 1v2"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">სოციალური ქსელები</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(explode(',', $employee->social) as $socialLink)
                                            <a href="{{ trim($socialLink) }}" target="_blank" 
                                               class="inline-flex items-center px-2 py-1 sm:px-3 sm:py-1 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 text-xs sm:text-sm font-medium rounded-md border border-indigo-200 dark:border-indigo-700/50 hover:bg-indigo-100 dark:hover:bg-indigo-900/50 transition-colors duration-200">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                </svg>
                                                <span class="truncate max-w-24 sm:max-w-32">{{ trim($socialLink) }}</span>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif
                        
                        <!-- Posted Date -->
                        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700/50">
                            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                <div class="w-2 h-2 bg-blue-500 rounded-md"></div>
                                <span>გამოქვეყნებულია: {{ $employee->created_at->format('Y-m-d H:i') }} ({{ $employee->created_at->diffForHumans() }})</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                @if(Auth::check() && (Auth::user()->id == $employee->user_id || Auth::user()->is_admin))
                <div class="flex flex-col sm:flex-row gap-4 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700/50">
                    <a href="{{ route('employees.edit', $employee) }}" 
                       class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-500 hover:from-blue-600 hover:via-purple-600 hover:to-indigo-600 text-white font-semibold rounded-md shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        რედაქტირება
                    </a>
                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('დარწმუნებული ხართ?')" 
                                class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-semibold rounded-md shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            წაშლა
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>

        <!-- Back Button -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="flex justify-center">
                <a href="{{ route('jobs') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 hover:from-gray-200 hover:to-gray-300 dark:hover:from-gray-600 dark:hover:to-gray-700 text-gray-700 dark:text-gray-200 rounded-md font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 border border-gray-200/50 dark:border-gray-600/50">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    უკან დაბრუნება
                </a>
            </div>
        </div>
    </div>
</x-layout>