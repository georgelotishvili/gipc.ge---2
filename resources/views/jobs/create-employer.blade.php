<x-layout>
    <style>
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        select::-ms-expand { display: none; }
    </style>
    <div class="min-h-screen relative overflow-hidden">
        <!-- Floating Header -->
        <div class="relative z-10 pt-8 pb-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500 rounded-3xl mb-6 shadow-2xl">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3m10-5h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h2"/>
                        </svg>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                        ვაკანსიის შექმნა
                    </h1>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        დაამატეთ ახალი ვაკანსია თქვენი კომპანიისთვის
                    </p>
                </div>
            </div>
        </div>
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <!-- Live Preview Card -->
            <div class="mb-10" x-data="{ showPreview: true }">
                <div class="flex justify-center mb-4">
                    <button type="button" @click="showPreview = !showPreview" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-2xl shadow-lg transform hover:scale-105 transition-all duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span x-text="showPreview ? 'დამალვა' : 'წინასწარი ნახვა'"></span>
                    </button>
                </div>
                <div x-show="showPreview" x-transition class="bg-gradient-to-br from-blue-50/50 via-purple-50/50 to-indigo-50/50 dark:from-blue-900/20 dark:via-purple-900/20 dark:to-indigo-900/20 rounded-3xl p-8 border border-blue-100/50 dark:border-blue-800/30 backdrop-blur-sm">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3m10-5h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h2"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">წინასწარი ნახვა</h3>
                            <p class="text-gray-600 dark:text-gray-400">თქვენი ვაკანსიის ბარათი</p>
                        </div>
                    </div>
                    
                    <!-- Job Posting Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                        <!-- Job Header -->
                        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center space-x-4">
                                    <!-- Company Logo -->
                                    <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-xl border-2 border-gray-200 dark:border-gray-600 overflow-hidden flex items-center justify-center">
                                        <img id="preview-logo" src="" alt="Company Logo" class="w-full h-full object-cover object-center" style="display: none;">
                                        <div id="preview-logo-placeholder" class="w-full h-full flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3m10-5h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h2"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h2 id="preview-name" class="text-lg font-semibold text-gray-900 dark:text-white">კომპანიის სახელი</h2>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">კომპანია</p>
                                    </div>
                                </div>
                                <!-- Salary Badge -->
                                <div class="bg-green-500 text-white px-4 py-2 rounded-xl text-center shadow-lg">
                                    <div class="text-sm font-medium opacity-90">ხელფასი</div>
                                    <div class="text-lg font-bold" id="preview-salary">₾ 0</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Job Content -->
                        <div class="p-6 space-y-6">
                            <!-- Job Position -->
                            <div>
                                <h3 id="preview-position" class="text-2xl font-bold text-gray-900 dark:text-white mb-2">ვაკანსიის პოზიცია</h3>
                                <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span id="preview-address">ქალაქი</span>
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span id="preview-worktime">სრული განაკვეთი</span>
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Job Description -->
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">სამუშაოს აღწერა</h4>
                                <p id="preview-description" class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                    აქ გამოჩნდება ვაკანსიის აღწერა...
                                </p>
                            </div>
                            
                            <!-- Required Skills -->
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">საჭირო უნარები</h4>
                                <div id="preview-skills" class="flex flex-wrap gap-2">
                                    <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-full text-sm font-medium">AutoCAD</span>
                                    <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-full text-sm font-medium">Revit</span>
                                    <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-full text-sm font-medium">SketchUp</span>
                                </div>
                            </div>
                            
                            <!-- Contact Information -->
                            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4">
                                <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">საკონტაქტო ინფორმაცია</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">ელ-ფოსტა</p>
                                            <p id="preview-email" class="font-medium text-gray-900 dark:text-white">email@example.com</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">ტელეფონი</p>
                                            <p id="preview-phone" class="font-medium text-gray-900 dark:text-white">+995 555 123 456</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Apply Button -->
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                <button class="w-full bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-500 hover:from-blue-600 hover:via-purple-600 hover:to-indigo-600 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                                    განაცხადის გაგზავნა
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main Form -->
            <div class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/30 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-500 px-8 py-6 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent"></div>
                    <div class="relative z-10">
                        <h2 class="text-2xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3m10-5h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h2"/>
                            </svg>
                            ვაკანსიის ფორმა
                        </h2>
                        <p class="text-blue-100 mt-1">შეავსეთ ვაკანსიის დეტალები</p>
                    </div>
                </div>
                <div class="p-8">
                    @if ($errors->any())
                        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30 text-red-800 dark:text-red-200 px-4 py-3 rounded-xl mb-6">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('employers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        
                        <!-- Company Information Section -->
                        <div class="bg-gradient-to-br from-blue-50/50 via-purple-50/50 to-indigo-50/50 dark:from-blue-900/20 dark:via-purple-900/20 dark:to-indigo-900/20 rounded-3xl p-8 border border-blue-100/50 dark:border-blue-800/30 backdrop-blur-sm">
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3m10-5h2a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h2"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">კომპანიის ინფორმაცია</h3>
                                    <p class="text-gray-600 dark:text-gray-400">შეიყვანეთ კომპანიის ძირითადი მონაცემები</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="group">
                                    <div class="relative">
                                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" placeholder="კომპანიის სახელი" required>
                                        <label for="name" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-blue-600 dark:peer-focus:text-blue-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none text-sm font-medium">
                                            <span class="flex items-center">
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
                                
                                <div class="group">
                                    <div class="relative">
                                        <input type="text" name="address" id="address" value="{{ old('address') }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" placeholder="მისამართი" required>
                                        <label for="address" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-blue-600 dark:peer-focus:text-blue-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none text-sm font-medium">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                მისამართი *
                                            </span>
                                        </label>
                                    </div>
                                    @error('address')
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
                                        <input type="url" name="website" id="website" placeholder="ვებსაიტი (არასავალდებულო)" value="{{ old('website') }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm">
                                        <label for="website" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-blue-600 dark:peer-focus:text-blue-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none text-sm font-medium">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                                </svg>
                                                ვებსაიტი (არასავალდებულო)
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Logo Upload Section -->
                            <div class="mt-8">
                                <div class="group">
                                    <div class="relative">
                                        <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="previewLogo(this)">
                                        <label for="image" class="cursor-pointer block">
                                            <!-- Default Upload State -->
                                            <div id="defaultUploadState" class="border-2 border-dashed border-blue-300 dark:border-blue-600 rounded-2xl hover:border-blue-400 dark:hover:border-blue-500 transition-all duration-300 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-gray-800/70 p-8 text-center">
                                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                                <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">კომპანიის ლოგო</h4>
                                                <p class="text-gray-600 dark:text-gray-400 mb-6 text-lg">დააჭირეთ ან ჩაიტანეთ ფაილი აქ</p>
                                                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-500 text-white rounded-xl font-medium hover:from-blue-600 hover:via-purple-600 hover:to-indigo-600 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    აირჩიეთ ლოგო
                                                </div>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-4">მხოლოდ JPG, PNG ან GIF ფორმატები, მაქსიმუმ 2MB</p>
                                            </div>
                                            
                                            <!-- Image Preview State -->
                                            <div id="imagePreviewState" class="hidden border-2 border-blue-300 dark:border-blue-600 rounded-2xl bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm overflow-hidden">
                                                <div class="relative">
                                                    <!-- Preview Image -->
                                                    <div class="relative w-full h-64 bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30">
                                                        <img id="previewImg" src="" alt="Logo Preview" class="w-full h-full object-contain">
                                                        
                                                        <!-- Remove Button -->
                                                        <button type="button" onclick="removeLogo(event)" class="absolute top-3 right-3 w-10 h-10 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center shadow-lg transition-all duration-200 transform hover:scale-110">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                        
                                                        <!-- File Info Overlay -->
                                                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                                                            <p id="fileName" class="text-white font-medium text-sm"></p>
                                                            <p id="fileSize" class="text-white/80 text-xs"></p>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Change Image Button -->
                                                    <div class="p-4 text-center">
                                                        <button type="button" onclick="document.getElementById('image').click()" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-500 text-white rounded-xl font-medium hover:from-blue-600 hover:via-purple-600 hover:to-indigo-600 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                            </svg>
                                                            სხვა ლოგოს არჩევა
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Job Details Section -->
                        <div class="bg-gradient-to-br from-blue-50/50 via-purple-50/50 to-indigo-50/50 dark:from-blue-900/20 dark:via-purple-900/20 dark:to-indigo-900/20 rounded-3xl p-8 border border-blue-100/50 dark:border-blue-800/30 backdrop-blur-sm">
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">ვაკანსიის დეტალები</h3>
                                    <p class="text-gray-600 dark:text-gray-400">აღწერეთ ვაკანსიის პოზიცია და მოთხოვნები</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="group">
                                    <div class="relative">
                                        <input type="text" name="position" id="position" value="{{ old('position') }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" placeholder="პოზიცია" required>
                                        <label for="position" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-blue-600 dark:peer-focus:text-blue-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none text-sm font-medium">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H8a2 2 0 01-2-2V8a2 2 0 012-2V6"/>
                                                </svg>
                                                პოზიცია *
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
                                        <select name="worktime" id="worktime" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-300 text-gray-900 dark:text-white appearance-none cursor-pointer backdrop-blur-sm peer">
                                            <option value="">აირჩიეთ სამუშაო დრო</option>
                                            @foreach(\App\Enums\WorkTimeType::cases() as $workTimeType)
                                                <option value="{{ $workTimeType->value }}" {{ old('worktime') == $workTimeType->value ? 'selected' : '' }}>
                                                    {{ $workTimeType->label() }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="worktime" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-blue-600 dark:peer-focus:text-blue-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not([value=''])]:-translate-y-1 peer-[:not([value=''])]:scale-75 pointer-events-none text-sm font-medium">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                სამუშაო დრო *
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
                                        <input type="number" step="0.01" name="salary" id="salary" value="{{ old('salary') }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" placeholder="ხელფასი" required>
                                        <label for="salary" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-blue-600 dark:peer-focus:text-blue-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none text-sm font-medium">
                                            <span class="flex items-center">
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
                            
                            <div class="mt-8 space-y-8">
                                <div class="group">
                                    <div class="relative">
                                        <textarea name="description" id="description" rows="6" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-4 focus:ring-indigo-500/20 dark:focus:ring-indigo-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm resize-none" placeholder="სამუშაოს აღწერა" required>{{ old('description') }}</textarea>
                                        <label for="description" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-indigo-600 dark:peer-focus:text-indigo-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none text-sm font-medium">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                სამუშაოს აღწერა *
                                            </span>
                                        </label>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 ml-6">აღწერეთ ვაკანსიის პოზიცია, მოთხოვნები და პასუხისმგებლობები</p>
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
                                        <input type="text" name="skills" id="skills" value="{{ old('skills') }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-4 focus:ring-indigo-500/20 dark:focus:ring-indigo-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" placeholder="საჭირო უნარები" required>
                                        <label for="skills" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-indigo-600 dark:peer-focus:text-indigo-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none text-sm font-medium">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                                </svg>
                                                საჭირო უნარები *
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
                        <div class="bg-gradient-to-br from-blue-50/50 via-purple-50/50 to-indigo-50/50 dark:from-blue-900/20 dark:via-purple-900/20 dark:to-indigo-900/20 rounded-3xl p-8 border border-blue-100/50 dark:border-blue-800/30 backdrop-blur-sm">
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">საკონტაქტო ინფორმაცია</h3>
                                    <p class="text-gray-600 dark:text-gray-400">როგორ შეგვიძლია დაგიკავშირდეთ</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="group">
                                    <div class="relative">
                                        <input type="email" name="email" id="email" placeholder="ელ-ფოსტა" value="{{ old('email') }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-green-500 dark:focus:border-green-400 focus:ring-4 focus:ring-green-500/20 dark:focus:ring-green-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" required>
                                        <label for="email" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-green-600 dark:peer-focus:text-green-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none text-sm font-medium">
                                            <span class="flex items-center">
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
                                        <input type="text" name="phone" id="phone" placeholder="ტელეფონი" value="{{ old('phone') }}" class="w-full px-6 pt-6 pb-2 bg-white/70 dark:bg-gray-800/70 border-2 border-gray-200 dark:border-gray-700 rounded-2xl focus:border-green-500 dark:focus:border-green-400 focus:ring-4 focus:ring-green-500/20 dark:focus:ring-green-400/20 transition-all duration-300 text-gray-900 dark:text-white placeholder-transparent peer backdrop-blur-sm" required>
                                        <label for="phone" class="absolute left-6 top-2 text-gray-500 dark:text-gray-400 transition-all duration-300 peer-focus:text-green-600 dark:peer-focus:text-green-400 peer-focus:-translate-y-1 peer-focus:scale-75 peer-[:not(:placeholder-shown)]:-translate-y-1 peer-[:not(:placeholder-shown)]:scale-75 pointer-events-none text-sm font-medium">
                                            <span class="flex items-center">
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
                                ვაკანსიის შექმნა
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Live Preview Update Function
        function updateEmployerPreview() {
            // Name
            const nameInput = document.getElementById('name');
            const previewName = document.getElementById('preview-name');
            if (nameInput && previewName) {
                previewName.textContent = nameInput.value || 'კომპანიის სახელი';
            }
            // Position
            const positionInput = document.getElementById('position');
            const previewPosition = document.getElementById('preview-position');
            if (positionInput && previewPosition) {
                previewPosition.textContent = positionInput.value || 'ვაკანსიის პოზიცია';
            }
            // Email
            const emailInput = document.getElementById('email');
            const previewEmail = document.getElementById('preview-email');
            if (emailInput && previewEmail) {
                previewEmail.textContent = emailInput.value || 'email@example.com';
            }
            // Phone
            const phoneInput = document.getElementById('phone');
            const previewPhone = document.getElementById('preview-phone');
            if (phoneInput && previewPhone) {
                previewPhone.textContent = phoneInput.value || '+995 555 123 456';
            }
            // Address
            const addressInput = document.getElementById('address');
            const previewAddress = document.getElementById('preview-address');
            if (addressInput && previewAddress) {
                previewAddress.textContent = addressInput.value || 'ქალაქი';
            }
            // Worktime
            const worktimeSelect = document.getElementById('worktime');
            const previewWorktime = document.getElementById('preview-worktime');
            if (worktimeSelect && previewWorktime) {
                const selectedOption = worktimeSelect.options[worktimeSelect.selectedIndex];
                previewWorktime.textContent = selectedOption ? selectedOption.text : 'სრული განაკვეთი';
            }
            // Skills
            const skillsInput = document.getElementById('skills');
            const previewSkills = document.getElementById('preview-skills');
            if (skillsInput && previewSkills) {
                const skills = skillsInput.value.split(',').map(skill => skill.trim()).filter(skill => skill);
                if (skills.length > 0) {
                    previewSkills.innerHTML = skills.map(skill =>
                        `<span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-full text-sm font-medium">${skill}</span>`
                    ).join('');
                } else {
                    previewSkills.innerHTML = `
                        <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-full text-sm font-medium">AutoCAD</span>
                        <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-full text-sm font-medium">Revit</span>
                        <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded-full text-sm font-medium">SketchUp</span>
                    `;
                }
            }
            // Description
            const descriptionInput = document.getElementById('description');
            const previewDescription = document.getElementById('preview-description');
            if (descriptionInput && previewDescription) {
                previewDescription.textContent = descriptionInput.value || 'აქ გამოჩნდება ვაკანსიის აღწერა...';
            }
            // Salary
            const salaryInput = document.getElementById('salary');
            const previewSalary = document.getElementById('preview-salary');
            if (salaryInput && previewSalary) {
                previewSalary.textContent = salaryInput.value && parseFloat(salaryInput.value) > 0 ? `₾ ${parseFloat(salaryInput.value).toLocaleString()}` : '₾ 0';
            }
        }
        // Logo Preview
        function previewLogo(input) {
            const defaultUploadState = document.getElementById('defaultUploadState');
            const imagePreviewState = document.getElementById('imagePreviewState');
            const previewImg = document.getElementById('previewImg');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            
            // Update preview card logo
            const previewLogo = document.getElementById('preview-logo');
            const previewLogoPlaceholder = document.getElementById('preview-logo-placeholder');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                // Hide default state and show preview
                defaultUploadState.classList.add('hidden');
                imagePreviewState.classList.remove('hidden');
                
                // Display file info
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                
                // Create preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    
                    // Update preview card logo
                    if (previewLogo && previewLogoPlaceholder) {
                        previewLogo.src = e.target.result;
                        previewLogo.style.display = 'block';
                        previewLogoPlaceholder.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            } else {
                // Show default state and hide preview
                defaultUploadState.classList.remove('hidden');
                imagePreviewState.classList.add('hidden');
                
                // Clear preview image
                previewImg.src = '';
                
                // Update preview card logo
                if (previewLogo && previewLogoPlaceholder) {
                    previewLogo.style.display = 'none';
                    previewLogoPlaceholder.style.display = 'flex';
                }
            }
        }
        
        // Remove Logo
        function removeLogo(event) {
            event.preventDefault();
            event.stopPropagation();
            
            const input = document.getElementById('image');
            const defaultUploadState = document.getElementById('defaultUploadState');
            const imagePreviewState = document.getElementById('imagePreviewState');
            
            // Clear the input
            input.value = '';
            
            // Show default state and hide preview
            defaultUploadState.classList.remove('hidden');
            imagePreviewState.classList.add('hidden');
            
            // Clear preview image
            document.getElementById('previewImg').src = '';
            
            // Update preview card logo
            const previewLogo = document.getElementById('preview-logo');
            const previewLogoPlaceholder = document.getElementById('preview-logo-placeholder');
            if (previewLogo && previewLogoPlaceholder) {
                previewLogo.style.display = 'none';
                previewLogoPlaceholder.style.display = 'flex';
            }
        }
        
        // Format File Size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = ['name', 'position', 'email', 'phone', 'address', 'skills', 'description', 'salary'];
            inputs.forEach(inputId => {
                const element = document.getElementById(inputId);
                if (element) {
                    element.addEventListener('input', updateEmployerPreview);
                }
            });
            const worktimeSelect = document.getElementById('worktime');
            if (worktimeSelect) {
                worktimeSelect.addEventListener('change', updateEmployerPreview);
            }
            const logoInput = document.getElementById('image');
            if (logoInput) {
                logoInput.addEventListener('change', function() { updateLogoPreview(this); });
            }
            updateEmployerPreview();
        });
    </script>
</x-layout>