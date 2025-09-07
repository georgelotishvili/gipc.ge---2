<x-layout>
    <style>
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        select::-ms-expand { display: none; }
        select::-webkit-select-placeholder { display: none; }
        select::-webkit-select-arrow { display: none; }
    </style>
    <!-- Clean Form Container -->
    <div class="min-h-screen transition-colors duration-200">
        <!-- Simple Header -->
        <div class="border-b border-gray-200 dark:border-gray-700">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-2xl mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">რეზიუმეს რედაქტირება</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">განაახლეთ თქვენი პროფესიონალური რეზიუმე</p>
                </div>
            </div>
        </div>

        <!-- Main Form Container -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if ($errors->any())
                <div class="mb-8 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30 text-red-800 dark:text-red-200 px-6 py-4 rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold">გთხოვთ შეასწოროთ შემდეგი შეცდომები:</h3>
                            <ul class="list-disc pl-5 mt-2 space-y-1 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-8 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800/30 text-green-800 dark:text-green-200 px-6 py-4 rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold">წარმატებით განახლდა!</h3>
                            <p class="mt-1 text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Preview Toggle -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">წინასწარი ნახვა</h3>
                        <p class="text-gray-600 dark:text-gray-400">თქვენი რეზიუმეს ბარათი</p>
                    </div>
                </div>
                    
                <!-- Employee Card - Matching Show Page -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <!-- Card Header with Image -->
                    <div class="relative h-48 sm:h-56 md:h-64 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500">
                        <div class="absolute inset-0 bg-gradient-to-br from-black/10 to-black/30"></div>
                        <div class="absolute bottom-4 left-4 right-4 sm:bottom-6 sm:left-6 sm:right-6">
                            <div class="flex flex-col md:flex-row items-center md:items-end md:space-y-0 md:space-x-6 text-center md:text-left pt-4 md:pt-0">
                                <!-- Profile Image -->
                                <div class="relative flex-shrink-0">
                                    <div class="w-28 h-28 sm:w-32 sm:h-32 md:w-48 md:h-48 bg-white dark:bg-gray-700 rounded-full border-4 border-white dark:border-gray-600 shadow-2xl overflow-hidden ring-4 ring-white/20 dark:ring-gray-600/20">
                                        <img id="preview-image" src="{{ $employee->image ? asset('storage/' . $employee->image->path) : '' }}" alt="Profile" class="w-full h-full object-cover object-center" style="display: {{ $employee->image ? 'block' : 'none' }};">
                                        <div id="preview-image-placeholder" class="w-full h-full flex items-center justify-center" style="display: {{ $employee->image ? 'none' : 'flex' }};">
                                            <svg class="w-10 h-10 sm:w-14 sm:h-14 md:w-20 md:h-20 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <!-- Name and Position -->
                                <div class="flex-1 text-white">
                                    <h2 id="preview-name" class="text-xl sm:text-2xl md:text-3xl font-bold mb-1 sm:mb-2 tracking-tight leading-tight break-words">{{ $employee->name }}</h2>
                                    <p id="preview-position" class="text-base sm:text-lg md:text-xl opacity-95 font-medium leading-tight break-words">{{ $employee->position }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Content -->
                    <div class="p-8 space-y-8">
                        <!-- Contact Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                            <div class="flex items-center space-x-3 sm:space-x-4">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center shadow-sm">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400">ელ-ფოსტა</p>
                                    <p id="preview-email" class="font-semibold text-gray-900 dark:text-white text-sm sm:text-base break-words hover:text-blue-600 dark:hover:text-blue-400 transition-colors">{{ $employee->email }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3 sm:space-x-4">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center shadow-sm">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400">ტელეფონი</p>
                                    <p id="preview-phone" class="font-semibold text-gray-900 dark:text-white text-sm sm:text-base break-words hover:text-green-600 dark:hover:text-green-400 transition-colors">{{ $employee->phone ?? 'არ არის მითითებული' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3 sm:space-x-4">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center shadow-sm">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400">ქალაქი</p>
                                    <p id="preview-city" class="font-semibold text-gray-900 dark:text-white text-sm sm:text-base break-words">{{ $employee->city ?? 'არ არის მითითებული' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3 sm:space-x-4">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center shadow-sm">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400">სამუშაო დრო</p>
                                    <p id="preview-worktime" class="font-semibold text-gray-900 dark:text-white text-sm sm:text-base break-words">{{ $employee->worktime->label() }}</p>
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
                            <div class="flex flex-wrap gap-2">
                                <div id="preview-skills">
                                    @if($employee->skills)
                                        @foreach(explode(',', $employee->skills) as $skill)
                                            <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-full text-sm font-medium">{{ trim($skill) }}</span>
                                        @endforeach
                                    @else
                                        <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-full text-sm font-medium">AutoCAD</span>
                                        <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-full text-sm font-medium">Revit</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Experience -->
                        <div class="mt-4 sm:mt-6">
                            <h4 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white mb-2 sm:mb-3 flex items-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                გამოცდილება
                            </h4>
                            <p id="preview-description" class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $employee->description ?? 'არ არის მითითებული' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PATCH')
                
                <!-- Personal Information Section -->
                <div class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-blue-900/20 dark:via-indigo-900/20 dark:to-purple-900/20 rounded-2xl p-8 border border-blue-200 dark:border-blue-800/30">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">პირადი ინფორმაცია</h3>
                            <p class="text-gray-600 dark:text-gray-400">შეიყვანეთ თქვენი ძირითადი მონაცემები</p>
                        </div>
                    </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div class="group">
                                <div class="relative">
                                    <input type="text" name="name" id="name" value="{{ old('name', $employee->name) }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" placeholder="სახელი და გვარი" required>
                                    <label for="name" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-blue-600 dark:peer-focus:text-blue-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                        <span class="flex items-center text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            სახელი და გვარი *
                                        </span>
                                    </label>
                                </div>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="group">
                                <div class="relative">
                                    <input type="text" name="position" id="position" value="{{ old('position', $employee->position) }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" placeholder="სასურველი პოზიცია" required>
                                    <label for="position" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-blue-600 dark:peer-focus:text-blue-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                        <span class="flex items-center text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"/>
                                            </svg>
                                            სასურველი პოზიცია *
                                        </span>
                                    </label>
                                </div>
                                @error('position')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="group">
                                <div class="relative">
                                    <input type="text" name="city" id="city" value="{{ old('city', $employee->city) }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" placeholder="ქალაქი">
                                    <label for="city" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-blue-600 dark:peer-focus:text-blue-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                        <span class="flex items-center text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            ქალაქი
                                        </span>
                                    </label>
                                </div>
                                @error('city')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="group">
                                <div class="relative">
                                    <select name="worktime" id="worktime" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-300 text-gray-900 dark:text-white appearance-none cursor-pointer backdrop-blur-sm peer [&::-ms-expand]:hidden [&::-webkit-select-placeholder]:hidden [&::-webkit-select-arrow]:hidden">
                                        <option value="">აირჩიეთ სამუშაო დრო</option>
                                        @foreach(\App\Enums\WorkTimeType::cases() as $workTimeType)
                                            <option value="{{ $workTimeType->value }}" {{ old('worktime', $employee->worktime) == $workTimeType->value ? 'selected' : '' }}>
                                                {{ $workTimeType->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="worktime" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-blue-600 dark:peer-focus:text-blue-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not([value=''])]:-translate-y-1 peer-[:not([value=''])]:scale-75 pointer-events-none">
                                        <span class="flex items-center text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            სასურველი სამუშაო დრო
                                        </span>
                                    </label>
                                </div>
                                @error('worktime')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="group">
                                <div class="relative">
                                    <input type="number" step="0.01" name="salary" id="salary" value="{{ old('salary', $employee->salary) }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" placeholder="სასურველი ხელფასი">
                                    <label for="salary" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-blue-600 dark:peer-focus:text-blue-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                        <span class="flex items-center text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                            </svg>
                                            სასურველი ხელფასი (არასავალდებულო)
                                        </span>
                                    </label>
                                </div>
                                @error('salary')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                <!-- Experience & Skills Section -->
                <div class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-indigo-900/20 dark:via-purple-900/20 dark:to-pink-900/20 rounded-2xl p-8 border border-indigo-200 dark:border-indigo-800/30">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">გამოცდილება და უნარები</h3>
                            <p class="text-gray-600 dark:text-gray-400">აღწერეთ თქვენი პროფესიონალური უნარები</p>
                        </div>
                    </div>
                    <div class="space-y-8">
                            <div class="group">
                                <div class="relative">
                                    <textarea name="description" id="description" rows="8" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-4 focus:ring-indigo-500/20 dark:focus:ring-indigo-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm resize-none" placeholder="თქვენი გამოცდილება და კვალიფიკაცია" required>{{ old('description', $employee->description) }}</textarea>
                                    <label for="description" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-indigo-600 dark:peer-focus:text-indigo-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                        <span class="flex items-center text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            თქვენი გამოცდილება და კვალიფიკაცია *
                                        </span>
                                    </label>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 ml-6">აღწერეთ თქვენი სამუშაო გამოცდილება, პროექტები და მიღწევები</p>
                                @error('description')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="group">
                                <div class="relative">
                                    <input type="text" name="skills" id="skills" value="{{ old('skills', $employee->skills) }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-4 focus:ring-indigo-500/20 dark:focus:ring-indigo-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" placeholder="უნარები" required>
                                    <label for="skills" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-indigo-600 dark:peer-focus:text-indigo-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                        <span class="flex items-center text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                            </svg>
                                            უნარები *
                                        </span>
                                    </label>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 ml-6">მძიმით გამოყოფილი უნარები (მაგ: AutoCAD, Revit, SketchUp)</p>
                                @error('skills')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>
                <!-- Contact Information Section -->
                <div class="bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 dark:from-green-900/20 dark:via-emerald-900/20 dark:to-teal-900/20 rounded-2xl p-8 border border-green-200 dark:border-green-800/30">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-600 via-emerald-600 to-teal-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">საკონტაქტო ინფორმაცია</h3>
                            <p class="text-gray-600 dark:text-gray-400">როგორ შეგვიძლია დაგიკავშირდეთ</p>
                        </div>
                    </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div class="group">
                                <div class="relative">
                                    <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-green-500 dark:focus:border-green-400 focus:ring-4 focus:ring-green-500/20 dark:focus:ring-green-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" placeholder="ელ-ფოსტა" required>
                                    <label for="email" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-green-600 dark:peer-focus:text-green-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                        <span class="flex items-center text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                            ელ-ფოსტა *
                                        </span>
                                    </label>
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="group">
                                <div class="relative">
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $employee->phone) }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-green-500 dark:focus:border-green-400 focus:ring-4 focus:ring-green-500/20 dark:focus:ring-green-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" placeholder="ტელეფონი">
                                    <label for="phone" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-green-600 dark:peer-focus:text-green-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                        <span class="flex items-center text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                            ტელეფონი
                                        </span>
                                    </label>
                                </div>
                                @error('phone')
                                    <p class="text-red-500 text-sm mt-2 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="group">
                                <div class="relative">
                                    <input type="url" name="website" id="website" value="{{ old('website', $employee->website) }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-green-500 dark:focus:border-green-400 focus:ring-4 focus:ring-green-500/20 dark:focus:ring-green-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" placeholder="პორტფოლიო/ვებსაიტი">
                                    <label for="website" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-green-600 dark:peer-focus:text-green-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                        <span class="flex items-center text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                            </svg>
                                            პორტფოლიო/ვებსაიტი (არასავალდებულო)
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="group">
                                <div class="relative">
                                    <input type="text" name="social" id="social" value="{{ old('social', $employee->social) }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-green-500 dark:focus:border-green-400 focus:ring-4 focus:ring-green-500/20 dark:focus:ring-green-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" placeholder="სოციალური ქსელები">
                                    <label for="social" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-green-600 dark:peer-focus:text-green-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                        <span class="flex items-center text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h4a1 1 0 011 1v2m4 0V2a1 1 0 011-1h1a2 2 0 012 2v16a2 2 0 01-2 2H5a2 2 0 01-2-2V3a2 2 0 012-2h1a1 1 0 011 1v2"/>
                                            </svg>
                                            სოციალური ქსელები (არასავალდებულო)
                                        </span>
                                    </label>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 ml-6">მძიმით გამოყოფილი (მაგ: LinkedIn, Facebook)</p>
                            </div>
                        </div>
                    </div>
                <!-- File Upload Section -->
                <div class="bg-gradient-to-br from-purple-50 via-pink-50 to-rose-50 dark:from-purple-900/20 dark:via-pink-900/20 dark:to-rose-900/20 rounded-2xl p-8 border border-purple-200 dark:border-purple-800/30">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-600 via-pink-600 to-rose-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">პროფილის ფოტო</h3>
                            <p class="text-gray-600 dark:text-gray-400">ატვირთეთ თქვენი პროფესიონალური ფოტო</p>
                        </div>
                    </div>
                        <!-- Enhanced File Upload Area with Animations -->
                        <div class="relative" x-data="fileUpload()">
                            <input type="file" name="image" id="image" accept="image/*" 
                                class="hidden" 
                                @change="handleFileSelect($event)"
                                @dragover.prevent="isDragging = true"
                                @dragleave.prevent="isDragging = false"
                                @drop.prevent="handleFileDrop($event)">
                            
                            <!-- Upload Area with Enhanced Animations -->
                            <label for="image" class="cursor-pointer block">
                                <div 
                                    id="uploadArea" 
                                    class="border-2 border-dashed rounded-2xl transition-all duration-500 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm relative overflow-hidden group"
                                    :class="{
                                        'border-purple-400 dark:border-purple-500 bg-purple-50/50 dark:bg-purple-900/20': isDragging,
                                        'border-purple-300 dark:border-purple-600 hover:border-purple-400 dark:hover:border-purple-500 hover:bg-white/70 dark:hover:bg-gray-800/70': !isDragging && !isUploading && !hasImage,
                                        'border-green-400 dark:border-green-500 bg-green-50/50 dark:bg-green-900/20': hasImage && !isUploading,
                                        'border-blue-400 dark:border-blue-500 bg-blue-50/50 dark:bg-blue-900/20': isUploading
                                    }"
                                    @dragover.prevent="isDragging = true"
                                    @dragleave.prevent="isDragging = false"
                                    @drop.prevent="handleFileDrop($event)">
                                        
                                    <!-- Drag Overlay -->
                                    <div 
                                        x-show="isDragging" 
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-pink-500/20 dark:from-purple-400/20 dark:to-pink-400/20 backdrop-blur-sm z-10 flex items-center justify-center">
                                        <div class="text-center">
                                            <div class="w-20 h-20 bg-white/90 dark:bg-gray-800/90 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-2xl animate-bounce">
                                                <svg class="w-10 h-10 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                </svg>
                                            </div>
                                            <p class="text-lg font-semibold text-purple-700 dark:text-purple-300">ჩაიტანეთ ფაილი აქ</p>
                                        </div>
                                    </div>

                                    <!-- Loading State -->
                                    <div 
                                        x-show="isUploading" 
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-indigo-500/20 dark:from-blue-400/20 dark:to-indigo-400/20 backdrop-blur-sm z-10 flex items-center justify-center">
                                        <div class="text-center">
                                            <div class="w-20 h-20 bg-white/90 dark:bg-gray-800/90 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-2xl">
                                                <!-- Spinning Loader -->
                                                <div class="w-10 h-10 border-4 border-blue-200 dark:border-blue-700 border-t-blue-600 dark:border-t-blue-400 rounded-full animate-spin"></div>
                                            </div>
                                            <p class="text-lg font-semibold text-blue-700 dark:text-blue-300">მიმდინარეობს ატვირთვა...</p>
                                            <p class="text-sm text-blue-600 dark:text-blue-400 mt-1" x-text="uploadProgress + '%'"></p>
                                        </div>
                                    </div>
                                        
                                    <!-- Default Upload State -->
                                    <div 
                                        x-show="!hasImage && !isUploading && !isDragging" 
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        class="p-8 text-center">
                                        <div class="w-16 h-16 bg-gradient-to-br from-purple-600 via-pink-600 to-rose-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:shadow-2xl group-hover:scale-110 transition-all duration-300">
                                            <svg class="w-8 h-8 text-white group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                        </div>
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors duration-300">ატვირთეთ ფოტო</h4>
                                        <p class="text-gray-600 dark:text-gray-400 mb-4">დააჭირეთ ან ჩაიტანეთ ფაილი აქ</p>
                                        <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 via-pink-600 to-rose-600 text-white rounded-xl font-medium hover:from-purple-700 hover:via-pink-700 hover:to-rose-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 group-hover:animate-pulse">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            აირჩიეთ ფაილი
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-3">მხოლოდ JPG, PNG ან GIF ფორმატები, მაქსიმუმ 2MB</p>
                                    </div>

                                    <!-- Image Preview State -->
                                    <div 
                                        x-show="hasImage && !isUploading" 
                                        x-transition:enter="transition ease-out duration-500"
                                        x-transition:enter-start="opacity-0 scale-95 rotate-2"
                                        x-transition:enter-end="opacity-100 scale-100 rotate-0"
                                        x-transition:leave="transition ease-in duration-300"
                                        x-transition:leave-start="opacity-100 scale-100 rotate-0"
                                        x-transition:leave-end="opacity-0 scale-95 -rotate-2"
                                        class="relative w-full h-64 bg-gradient-to-br from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30 rounded-xl overflow-hidden">
                                        <img 
                                            :src="imagePreview" 
                                            alt="Preview" 
                                            class="w-full h-full object-cover transition-all duration-500 hover:scale-105">
                                            
                                        <!-- Success Badge -->
                                        <div class="absolute top-3 left-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-medium flex items-center animate-pulse">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            ატვირთული
                                        </div>
                                            
                                        <!-- Trash Button -->
                                        <button 
                                            type="button" 
                                            @click="removeImage()" 
                                            class="absolute top-3 right-3 w-10 h-10 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center shadow-lg transition-all duration-300 transform hover:scale-110 hover:rotate-12 group">
                                            <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                            
                                        <!-- File Info Overlay -->
                                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent p-4">
                                            <p class="text-white font-medium text-sm" x-text="fileName"></p>
                                            <p class="text-white/80 text-xs" x-text="fileSize"></p>
                                        </div>

                                        <!-- Hover Overlay -->
                                        <div class="absolute inset-0 bg-black/0 hover:bg-black/20 transition-all duration-300 flex items-center justify-center opacity-0 hover:opacity-100">
                                            <button 
                                                type="button" 
                                                @click="document.getElementById('image').click()" 
                                                class="px-4 py-2 bg-white/90 dark:bg-gray-800/90 text-gray-900 dark:text-white rounded-lg font-medium hover:bg-white dark:hover:bg-gray-800 transition-all duration-200 transform hover:scale-105">
                                                შეცვლა
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        
                        <!-- Current Image Display -->
                        @if($employee->image)
                            <div class="mt-6 text-center">
                                <img src="{{ asset('storage/' . optional($employee->image()->latest()->first())->path) }}" alt="Current profile" class="h-20 w-auto object-contain rounded mx-auto shadow-lg">
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">მიმდინარე სურათი (latest here also)</p>
                            </div>
                        @endif
                        @error('image')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
            <!-- Submit Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-end gap-6 pt-8 border-t border-gray-200/50 dark:border-gray-700/50">
                <a href="{{ route('jobs') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 hover:from-gray-200 hover:to-gray-300 dark:hover:from-gray-600 dark:hover:to-gray-700 text-gray-700 dark:text-gray-200 rounded-2xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 border border-gray-200/50 dark:border-gray-600/50">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    გაუქმება
                </a>
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-10 py-4 bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-500 hover:from-blue-600 hover:via-purple-600 hover:to-indigo-600 text-white rounded-2xl font-bold text-lg transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    განახლება
                </button>
            </div>
            </form>
        </div>
    </div>
        <!-- JavaScript for Image Preview -->
    <script>
        // Alpine.js File Upload Component
        document.addEventListener('alpine:init', () => {
            Alpine.data('fileUpload', () => ({
                isDragging: false,
                isUploading: false,
                hasImage: false,
                imagePreview: '',
                fileName: '',
                fileSize: '',
                uploadProgress: 0,

                handleFileSelect(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.processFile(file);
                    }
                },

                handleFileDrop(event) {
                    this.isDragging = false;
                    const file = event.dataTransfer.files[0];
                    if (file) {
                        this.processFile(file);
                    }
                },

                processFile(file) {
                    // Validate file type
                    if (!file.type.startsWith('image/')) {
                        alert('გთხოვთ აირჩიოთ სურათის ფაილი');
                        return;
                    }

                    // Validate file size (2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('ფაილი ძალიან დიდია. მაქსიმუმ 2MB');
                        return;
                    }

                    this.isUploading = true;
                    this.uploadProgress = 0;

                    // Simulate upload progress
                    const progressInterval = setInterval(() => {
                        this.uploadProgress += Math.random() * 30;
                        if (this.uploadProgress >= 100) {
                            this.uploadProgress = 100;
                            clearInterval(progressInterval);
                            
                            // Complete upload
                            setTimeout(() => {
                                this.isUploading = false;
                                this.hasImage = true;
                                this.fileName = file.name;
                                this.fileSize = this.formatFileSize(file.size);
                                
                                // Create preview
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    this.imagePreview = e.target.result;
                                    this.updatePreview();
                                };
                                reader.readAsDataURL(file);
                            }, 500);
                        }
                    }, 100);
                },

                removeImage() {
                    this.hasImage = false;
                    this.imagePreview = '';
                    this.fileName = '';
                    this.fileSize = '';
                    
                    // Clear file input
                    const fileInput = document.getElementById('image');
                    if (fileInput) {
                        fileInput.value = '';
                    }
                    
                    this.updatePreview();
                },

                formatFileSize(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                },

                updatePreview() {
                    // Update preview image
                    const previewImage = document.getElementById('preview-image');
                    const previewImagePlaceholder = document.getElementById('preview-image-placeholder');
                    
                    if (this.hasImage && previewImage && previewImagePlaceholder) {
                        previewImage.src = this.imagePreview;
                        previewImage.style.display = 'block';
                        previewImagePlaceholder.style.display = 'none';
                    } else if (previewImage && previewImagePlaceholder) {
                        previewImage.style.display = 'none';
                        previewImagePlaceholder.style.display = 'flex';
                    }
                }
            }));
        });
    </script>

    <script>
        function previewImage(input) {
            const defaultState = document.getElementById('defaultState');
            const imagePreviewState = document.getElementById('imagePreviewState');
            const previewImg = document.getElementById('previewImg');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                // Hide default state and show preview
                defaultState.classList.add('hidden');
                imagePreviewState.classList.remove('hidden');
                
                // Display file info
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                
                // Create preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        function removeImage(event) {
            event.preventDefault();
            event.stopPropagation();
            
            const input = document.getElementById('image');
            const defaultState = document.getElementById('defaultState');
            const imagePreviewState = document.getElementById('imagePreviewState');
            
            // Clear the input
            input.value = '';
            
            // Show default state and hide preview
            defaultState.classList.remove('hidden');
            imagePreviewState.classList.add('hidden');
            
            // Clear preview image
            document.getElementById('previewImg').src = '';
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }

        // Drag and drop functionality
        document.addEventListener('DOMContentLoaded', function() {
            const uploadArea = document.getElementById('uploadArea');
            const input = document.getElementById('image');

            // Drag and drop functionality
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, unhighlight, false);
            });

            function highlight(e) {
                uploadArea.classList.add('border-purple-400', 'dark:border-purple-500', 'bg-purple-50/50', 'dark:bg-purple-900/20');
            }

            function unhighlight(e) {
                uploadArea.classList.remove('border-purple-400', 'dark:border-purple-500', 'bg-purple-50/50', 'dark:bg-purple-900/20');
            }

            uploadArea.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if (files.length > 0) {
                    input.files = files;
                    previewImage(input);
                }
            }

            // Check if there are validation errors and show preview if image was selected
            @if($errors->any() && old('image'))
                // If there are errors and an image was previously selected, show the preview
                const fileInput = document.getElementById('image');
                if (fileInput.files.length > 0) {
                    previewImage(fileInput);
                }
            @endif

            // Auto-refresh page after successful update to show new image
            @if(session('success'))
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            @endif
        });
    </script>
</x-layout>