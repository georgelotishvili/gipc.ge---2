<x-layout>
    <style>
        /* Hide default select arrow across all browsers */
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        
        select::-ms-expand {
            display: none;
        }
        
        select::-webkit-select-placeholder {
            display: none;
        }
        
        select::-webkit-select-arrow {
            display: none;
        }
    </style>
    
    <!-- Clean Form Container -->
    <div class="min-h-screen transition-colors duration-200">
        <!-- Simple Header -->
        <div class="border-b border-gray-200 dark:border-gray-700">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-md mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                        ვაკანსიის რედაქტირება
                    </h1>
                    <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        შეცვალეთ თქვენი ვაკანსიის ინფორმაცია
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Form Container -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            @if ($errors->any())
                <div class="mb-8 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30 text-red-800 dark:text-red-200 px-6 py-4 rounded-md">
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

            @if (session('success'))
                <div class="mb-8 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800/30 text-green-800 dark:text-green-200 px-6 py-4 rounded-md">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif
                
            <form action="{{ route('employers.update', $employer) }}" method="POST" enctype="multipart/form-data" class="space-y-8" x-data="{ showPreview: false }">
                @csrf
                @method('PATCH')
                
                <!-- Preview Toggle Button -->
                <div class="flex justify-center mb-8">
                    <button type="button" @click="showPreview = !showPreview" 
                        class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow-sm transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span x-text="showPreview ? 'დამალვა' : 'წინასწარი ნახვა'"></span>
                    </button>
                </div>

                <!-- Live Preview Section -->
                <div x-show="showPreview" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="mb-8">
                    <div class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-blue-900/20 dark:via-indigo-900/20 dark:to-purple-900/20 rounded-md p-8 border border-blue-200 dark:border-blue-800/30">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500 rounded-md flex items-center justify-center mr-4 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3m10-5h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h2"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">წინასწარი ნახვა</h3>
                                <p class="text-gray-600 dark:text-gray-400">თქვენი ვაკანსიის ბარათი</p>
                            </div>
                        </div>
                        
                        <!-- Employer Card - Matching Show Page -->
                        <div class="bg-white dark:bg-gray-800/50 rounded-md shadow-lg border border-gray-100 dark:border-gray-700/50 backdrop-blur-sm overflow-hidden">
                            <!-- Name and Position -->
                            <div class="p-6 border-b border-gray-100 dark:border-gray-700/50">
                                <h1 id="preview-position" class="text-3xl font-bold text-gray-900 dark:text-white">{{ $employer->position }}</h1>
                                <p id="preview-name" class="text-lg text-gray-600 dark:text-gray-400">{{ $employer->name }}</p>
                            </div>

                            <!-- Company Logo/Image -->
                            <div class="p-6">
                                <div class="bg-white dark:bg-gray-800 rounded-md p-2 shadow-lg border border-gray-100 dark:border-gray-700 inline-block">
                                    <img id="preview-logo" src="{{ $employer->image ? $employer->image->url : '' }}" alt="Company Logo" class="w-24 h-24 object-cover rounded-md" style="display: {{ $employer->image ? 'block' : 'none' }};">
                                    <div id="preview-logo-placeholder" class="w-24 h-24 bg-gray-200 dark:bg-gray-700 rounded-md flex items-center justify-center" style="display: {{ $employer->image ? 'none' : 'flex' }};">
                                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3m10-5h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h2"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Job Details -->
                            <div class="p-6">
                                <!-- Job Highlights -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-md">
                                        <div class="flex items-center gap-3">
                                            <div class="p-3 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">ლოკაცია</p>
                                                <p id="preview-address" class="font-medium text-gray-900 dark:text-gray-100">{{ $employer->city }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-md">
                                        <div class="flex items-center gap-3">
                                            <div class="p-3 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">სამუშაო დრო</p>
                                                <p id="preview-worktime" class="font-medium text-gray-900 dark:text-gray-100">{{ $employer->worktime ? $employer->worktime->label() : 'სრული განაკვეთი' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-md">
                                        <div class="flex items-center gap-3">
                                            <div class="p-3 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-md">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">ანაზღაურება</p>
                                                <p id="preview-salary" class="font-medium text-gray-900 dark:text-gray-100">{{ $employer->salary ? $employer->salary . ' ₾' : '0 ₾' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Job Description -->
                                <div class="mb-8">
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">აღწერა</h2>
                                    <div class="prose prose-blue max-w-none dark:prose-invert">
                                        <p id="preview-description" class="text-gray-700 dark:text-gray-300">{{ $employer->description ?: 'აქ გამოჩნდება ვაკანსიის აღწერა...' }}</p>
                                    </div>
                                </div>

                                <!-- Required Skills -->
                                <div class="mb-8">
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">საჭირო უნარები</h2>
                                    <div id="preview-skills" class="flex flex-wrap gap-2">
                                        @if($employer->skills)
                                            @foreach(explode(',', $employer->skills) as $skill)
                                                <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-md text-sm font-medium">{{ trim($skill) }}</span>
                                            @endforeach
                                        @else
                                            <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-md text-sm font-medium">AutoCAD</span>
                                            <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-md text-sm font-medium">Revit</span>
                                            <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-md text-sm font-medium">SketchUp</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-md p-6">
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">საკონტაქტო ინფორმაცია</h2>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-md flex items-center justify-center">
                                                <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">ელ-ფოსტა</p>
                                                <p id="preview-email" class="font-medium text-gray-900 dark:text-white">{{ $employer->email }}</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-md flex items-center justify-center">
                                                <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">ტელეფონი</p>
                                                <p id="preview-phone" class="font-medium text-gray-900 dark:text-white">{{ $employer->phone }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Company Information Section -->
                <div class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-blue-900/20 dark:via-indigo-900/20 dark:to-purple-900/20 rounded-md p-8 border border-blue-200 dark:border-blue-800/30">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-600 rounded-md flex items-center justify-center mr-4 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3m10-5h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h2"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">კომპანიის ინფორმაცია</h3>
                            <p class="text-gray-600 dark:text-gray-400">შეიყვანეთ თქვენი კომპანიის ძირითადი მონაცემები</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Company Name -->
                        <div class="group">
                            <div class="relative">
                                <input type="text" name="name" id="name" value="{{ old('name', $employer->name) }}" 
                                    class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-md focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" 
                                    placeholder="კომპანიის სახელი" required>
                                <label for="name" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-blue-600 dark:peer-focus:text-blue-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                    <span class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3m10-5h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h2"/>
                                        </svg>
                                        კომპანიის სახელი *
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

                        <!-- Job Position -->
                        <div class="group">
                            <div class="relative">
                                <input type="text" name="position" id="position" value="{{ old('position', $employer->position) }}" 
                                    class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-md focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" 
                                    placeholder="ვაკანსიის პოზიცია" required>
                                <label for="position" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-blue-600 dark:peer-focus:text-blue-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                    <span class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"/>
                                        </svg>
                                        ვაკანსიის პოზიცია *
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

                        <!-- City -->
                        <div class="group">
                            <div class="relative">
                                <input type="text" name="city" id="city" value="{{ old('city', $employer->city) }}" 
                                    class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-md focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" 
                                    placeholder="ქალაქი" required>
                                <label for="city" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-blue-600 dark:peer-focus:text-blue-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                    <span class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        ქალაქი *
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

                        <!-- Salary -->
                        <div class="group">
                            <div class="relative">
                                <input type="number" name="salary" id="salary" value="{{ old('salary', $employer->salary) }}" 
                                    class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-md focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" 
                                    placeholder="ხელფასი" required>
                                <label for="salary" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-blue-600 dark:peer-focus:text-blue-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                    <span class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                        </svg>
                                        ხელფასი (₾) *
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

                    <!-- Work Time -->
                    <div class="mt-8">
                        <div class="group">
                            <div class="relative">
                                <select name="worktime" id="worktime" 
                                    class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-md focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-300 text-gray-900 dark:text-white backdrop-blur-sm appearance-none" 
                                    required>
                                    <option value="">აირჩიეთ სამუშაო დრო</option>
                                    @foreach(\App\Enums\WorkTimeType::cases() as $worktime)
                                        <option value="{{ $worktime->value }}" {{ old('worktime', $employer->worktime?->value) == $worktime->value ? 'selected' : '' }}>
                                            {{ $worktime->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="worktime" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-blue-600 dark:peer-focus:text-blue-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                    <span class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        სამუშაო დრო *
                                    </span>
                                </label>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-6 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
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
                    </div>
                </div>

                <!-- Job Details Section -->
                <div class="bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50 dark:from-green-900/20 dark:via-emerald-900/20 dark:to-teal-900/20 rounded-md p-8 border border-green-200 dark:border-green-800/30">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-600 via-emerald-600 to-teal-600 rounded-md flex items-center justify-center mr-4 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">ვაკანსიის დეტალები</h3>
                            <p class="text-gray-600 dark:text-gray-400">შეიყვანეთ ვაკანსიის აღწერა და საჭირო უნარები</p>
                        </div>
                    </div>

                    <!-- Job Description -->
                    <div class="mb-8">
                        <div class="group">
                            <div class="relative">
                                <textarea name="description" id="description" rows="6" 
                                    class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-md focus:border-green-500 dark:focus:border-green-400 focus:ring-4 focus:ring-green-500/20 dark:focus:ring-green-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm resize-none" 
                                    placeholder="ვაკანსიის აღწერა" required>{{ old('description', $employer->description) }}</textarea>
                                <label for="description" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-green-600 dark:peer-focus:text-green-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                    <span class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        ვაკანსიის აღწერა *
                                    </span>
                                </label>
                            </div>
                            @error('description')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Required Skills -->
                    <div class="mb-8">
                        <div class="group">
                            <div class="relative">
                                <input type="text" name="skills" id="skills" value="{{ old('skills', $employer->skills) }}" 
                                    class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-md focus:border-green-500 dark:focus:border-green-400 focus:ring-4 focus:ring-green-500/20 dark:focus:ring-green-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" 
                                    placeholder="საჭირო უნარები (მძიმით გამოყოფილი)" required>
                                <label for="skills" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-green-600 dark:peer-focus:text-green-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                    <span class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                        </svg>
                                        საჭირო უნარები *
                                    </span>
                                </label>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">მაგალითი: AutoCAD, Revit, SketchUp, Project Management</p>
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
                <div class="bg-gradient-to-br from-purple-50 via-pink-50 to-rose-50 dark:from-purple-900/20 dark:via-pink-900/20 dark:to-rose-900/20 rounded-md p-8 border border-purple-200 dark:border-purple-800/30">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-600 via-pink-600 to-rose-600 rounded-md flex items-center justify-center mr-4 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">საკონტაქტო ინფორმაცია</h3>
                            <p class="text-gray-600 dark:text-gray-400">შეიყვანეთ საკონტაქტო მონაცემები</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Email -->
                        <div class="group">
                            <div class="relative">
                                <input type="email" name="email" id="email" value="{{ old('email', $employer->email) }}" 
                                    class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-md focus:border-purple-500 dark:focus:border-purple-400 focus:ring-4 focus:ring-purple-500/20 dark:focus:ring-purple-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" 
                                    placeholder="ელ-ფოსტა" required>
                                <label for="email" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-purple-600 dark:peer-focus:text-purple-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
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

                        <!-- Phone -->
                        <div class="group">
                            <div class="relative">
                                <input type="tel" name="phone" id="phone" value="{{ old('phone', $employer->phone) }}" 
                                    class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-md focus:border-purple-500 dark:focus:border-purple-400 focus:ring-4 focus:ring-purple-500/20 dark:focus:ring-purple-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" 
                                    placeholder="ტელეფონი" required>
                                <label for="phone" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-purple-600 dark:peer-focus:text-purple-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none">
                                    <span class="flex items-center text-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        ტელეფონი *
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
                    </div>
                </div>

                <!-- Logo Upload Section -->
                <div class="bg-gradient-to-br from-indigo-50 via-blue-50 to-cyan-50 dark:from-indigo-900/20 dark:via-blue-900/20 dark:to-cyan-900/20 rounded-md p-8 border border-indigo-200 dark:border-indigo-800/30">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-600 via-blue-600 to-cyan-600 rounded-md flex items-center justify-center mr-4 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">კომპანიის ლოგო</h3>
                            <p class="text-gray-600 dark:text-gray-400">ატვირთეთ თქვენი კომპანიის ლოგო</p>
                        </div>
                    </div>

                    <div class="group">
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
                                    class="border-2 border-dashed rounded-md transition-all duration-500 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm relative overflow-hidden group"
                                    :class="{
                                        'border-blue-400 dark:border-blue-500 bg-blue-50/50 dark:bg-blue-900/20': isDragging,
                                        'border-blue-300 dark:border-blue-600 hover:border-blue-400 dark:hover:border-blue-500 hover:bg-white/70 dark:hover:bg-gray-800/70': !isDragging && !isUploading && !hasImage,
                                        'border-green-400 dark:border-green-500 bg-green-50/50 dark:bg-green-900/20': hasImage && !isUploading,
                                        'border-purple-400 dark:border-purple-500 bg-purple-50/50 dark:bg-purple-900/20': isUploading
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
                                        class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-indigo-500/20 dark:from-blue-400/20 dark:to-indigo-400/20 backdrop-blur-sm z-10 flex items-center justify-center">
                                        <div class="text-center">
                                            <div class="w-20 h-20 bg-white/90 dark:bg-gray-800/90 rounded-md flex items-center justify-center mx-auto mb-4 shadow-2xl animate-bounce">
                                                <svg class="w-10 h-10 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <p class="text-lg font-semibold text-blue-700 dark:text-blue-300">ჩაიტანეთ ლოგო აქ</p>
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
                                        class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-indigo-500/20 dark:from-purple-400/20 dark:to-indigo-400/20 backdrop-blur-sm z-10 flex items-center justify-center">
                                        <div class="text-center">
                                            <div class="w-20 h-20 bg-white/90 dark:bg-gray-800/90 rounded-md flex items-center justify-center mx-auto mb-4 shadow-2xl">
                                                <!-- Spinning Loader -->
                                                <div class="w-10 h-10 border-4 border-purple-200 dark:border-purple-700 border-t-purple-600 dark:border-t-purple-400 rounded-md animate-spin"></div>
                                            </div>
                                            <p class="text-lg font-semibold text-purple-700 dark:text-purple-300">მიმდინარეობს ატვირთვა...</p>
                                            <p class="text-sm text-purple-600 dark:text-purple-400 mt-1" x-text="uploadProgress + '%'"></p>
                                        </div>
                                    </div>
                                        
                                    <!-- Default Upload State -->
                                    <div 
                                        x-show="!hasImage && !isUploading && !isDragging" 
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        class="p-8 text-center">
                                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500 rounded-md flex items-center justify-center mx-auto mb-6 shadow-lg group-hover:shadow-2xl group-hover:scale-110 transition-all duration-300">
                                            <svg class="w-8 h-8 text-white group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">კომპანიის ლოგო</h4>
                                        <p class="text-gray-600 dark:text-gray-400 mb-6 text-lg">დააჭირეთ ან ჩაიტანეთ ფაილი აქ</p>
                                        <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-500 text-white rounded-md font-medium hover:from-blue-600 hover:via-purple-600 hover:to-indigo-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 group-hover:animate-pulse">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            აირჩიეთ ლოგო
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-4">მხოლოდ JPG, PNG ან GIF ფორმატები, მაქსიმუმ 2MB</p>
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
                                        class="relative w-full h-64 bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-md overflow-hidden">
                                        <img 
                                            :src="imagePreview" 
                                            alt="Logo Preview" 
                                            class="w-full h-full object-contain transition-all duration-500 hover:scale-105">
                                            
                                        <!-- Success Badge -->
                                        <div class="absolute top-3 left-3 bg-green-500 text-white px-3 py-1 rounded-md text-xs font-medium flex items-center animate-pulse">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            ატვირთული
                                        </div>
                                            
                                        <!-- Remove Button -->
                                        <button 
                                            type="button" 
                                            @click="removeImage()" 
                                            class="absolute top-3 right-3 w-10 h-10 bg-red-500 hover:bg-red-600 text-white rounded-md flex items-center justify-center shadow-lg transition-all duration-300 transform hover:scale-110 hover:rotate-12 group">
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
                                                class="px-4 py-2 bg-white/90 dark:bg-gray-800/90 text-gray-900 dark:text-white rounded-md font-medium hover:bg-white dark:hover:bg-gray-800 transition-all duration-200 transform hover:scale-105">
                                                შეცვლა
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center pt-8">
                    <button type="submit" 
                        class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 hover:from-blue-700 hover:via-purple-700 hover:to-indigo-700 text-white font-semibold rounded-md shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        ვაკანსიის განახლება
                    </button>
                    
                    <a href="{{ route('jobs') }}" 
                        class="inline-flex items-center justify-center px-8 py-4 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-semibold rounded-md shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        გაუქმება
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Alpine.js File Upload Component -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('fileUpload', () => ({
                isDragging: false,
                isUploading: false,
                hasImage: {{ $employer->image ? 'true' : 'false' }},
                imagePreview: '{{ $employer->image ? $employer->image->url : "" }}',
                fileName: '{{ $employer->image ? basename($employer->image->url) : "" }}',
                fileSize: '',
                uploadProgress: 0,

                init() {
                    if (this.hasImage) {
                        this.fileSize = this.formatFileSize(0); // We don't have actual file size for existing images
                    }
                },

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
                            
                            setTimeout(() => {
                                this.isUploading = false;
                                this.hasImage = true;
                                this.imagePreview = URL.createObjectURL(file);
                                this.fileName = file.name;
                                this.fileSize = this.formatFileSize(file.size);
                                this.updatePreview();
                            }, 500);
                        }
                    }, 100);
                },

                removeImage() {
                    this.hasImage = false;
                    this.imagePreview = '';
                    this.fileName = '';
                    this.fileSize = '';
                    
                    // Clear the file input
                    const fileInput = document.getElementById('image');
                    if (fileInput) {
                        fileInput.value = '';
                    }
                    
                    this.updatePreview();
                },

                formatFileSize(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                },

                updatePreview() {
                    // Update preview elements
                    const previewLogo = document.getElementById('preview-logo');
                    const previewLogoPlaceholder = document.getElementById('preview-logo-placeholder');
                    
                    if (this.hasImage && previewLogo && previewLogoPlaceholder) {
                        previewLogo.src = this.imagePreview;
                        previewLogo.style.display = 'block';
                        previewLogoPlaceholder.style.display = 'none';
                    } else if (previewLogo && previewLogoPlaceholder) {
                        previewLogo.style.display = 'none';
                        previewLogoPlaceholder.style.display = 'flex';
                    }
                }
            }));
        });
    </script>
</x-layout>
