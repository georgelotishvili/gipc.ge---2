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
    <div class="min-h-screen relative overflow-hidden">
        <div class="relative z-10 pt-8 pb-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500 rounded-3xl mb-6 shadow-2xl">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">რეზიუმეს რედაქტირება</h1>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">განაახლეთ თქვენი პროფესიონალური რეზიუმე</p>
                </div>
            </div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            <div class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 dark:border-gray-700/30 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-500 px-8 py-6 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-white/10 to-transparent"></div>
                    <div class="relative z-10">
                        <h2 class="text-2xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            რეზიუმეს რედაქტირება
                        </h2>
                        <p class="text-blue-100 mt-1">განაახლეთ თქვენი ინფორმაცია</p>
                    </div>
                </div>
                                @if ($errors->any())
                    <div class="m-8 bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/20 dark:to-pink-900/20 border border-red-200 dark:border-red-800/30 text-red-800 dark:text-red-200 px-6 py-4 rounded-2xl backdrop-blur-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-lg font-semibold">გთხოვთ შეასწოროთ შემდეგი შეცდომები:</h3>
                                <ul class="list-disc pl-5 mt-2 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                            </div>
                        </div>
                </div>
            @endif

            @if(session('success'))
                <div class="m-8 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border border-green-200 dark:border-green-800/30 text-green-800 dark:text-green-200 px-6 py-4 rounded-2xl backdrop-blur-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-semibold">წარმატებით განახლდა!</h3>
                            <p class="mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif
                <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-12">
                    @csrf
                    @method('PATCH')
                    <!-- Personal Information Section -->
                    <div class="bg-gradient-to-br from-blue-50/50 via-purple-50/50 to-indigo-50/50 dark:from-blue-900/20 dark:via-purple-900/20 dark:to-indigo-900/20 rounded-3xl p-8 border border-blue-100/50 dark:border-blue-800/30 backdrop-blur-sm mb-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
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
                    <div class="bg-gradient-to-br from-blue-50/50 via-purple-50/50 to-indigo-50/50 dark:from-blue-900/20 dark:via-purple-900/20 dark:to-indigo-900/20 rounded-3xl p-8 border border-blue-100/50 dark:border-blue-800/30 backdrop-blur-sm mb-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
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
                    <div class="bg-gradient-to-br from-blue-50/50 via-purple-50/50 to-indigo-50/50 dark:from-blue-900/20 dark:via-purple-900/20 dark:to-indigo-900/20 rounded-3xl p-8 border border-blue-100/50 dark:border-blue-800/30 backdrop-blur-sm mb-8">
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
                    <div class="bg-gradient-to-br from-blue-50/50 via-purple-50/50 to-indigo-50/50 dark:from-blue-900/20 dark:via-purple-900/20 dark:to-indigo-900/20 rounded-3xl p-8 border border-blue-100/50 dark:border-blue-800/30 backdrop-blur-sm mb-8">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">პროფილის ფოტო</h3>
                                <p class="text-gray-600 dark:text-gray-400">ატვირთეთ თქვენი პროფესიონალური ფოტო</p>
                            </div>
                        </div>
                        <!-- Modern File Upload Area -->
                        <div class="relative">
                            <input type="file" name="image" id="image" accept="image/*" class="hidden" onchange="previewImage(this)">
                            <label for="image" class="cursor-pointer block">
                                <div id="uploadArea" class="border-2 border-dashed border-purple-300 dark:border-purple-600 rounded-2xl hover:border-purple-400 dark:hover:border-purple-500 transition-all duration-300 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-gray-800/70 relative overflow-hidden">
                                    
                                    <!-- Default Upload State -->
                                    <div id="defaultState" class="p-8 text-center">
                                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 via-purple-500 to-indigo-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                        </div>
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">ატვირთეთ ფოტო</h4>
                                        <p class="text-gray-600 dark:text-gray-400 mb-4">დააჭირეთ ან ჩაიტანეთ ფაილი აქ</p>
                                        <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 via-purple-500 to-indigo-500 text-white rounded-xl font-medium hover:from-blue-600 hover:via-purple-600 hover:to-indigo-600 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            აირჩიეთ ფაილი
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-3">მხოლოდ JPG, PNG ან GIF ფორმატები, მაქსიმუმ 2MB</p>
                                    </div>

                                    <!-- Image Preview State -->
                                    <div id="imagePreviewState" class="hidden">
                                        <div class="relative w-full h-64 bg-gradient-to-br from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30">
                                            <img id="previewImg" src="" alt="Preview" class="w-full h-full object-cover">
                                            
                                            <!-- Trash Button -->
                                            <button type="button" onclick="removeImage(event)" class="absolute top-3 right-3 w-10 h-10 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center shadow-lg transition-all duration-200 transform hover:scale-110">
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
    </div>
        <!-- JavaScript for Image Preview -->
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